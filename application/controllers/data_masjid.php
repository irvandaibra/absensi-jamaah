<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class data_masjid extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
		$this->load->model('Main_model');
		date_default_timezone_set('Asia/Jakarta');
		$this->load->helper(['url', 'form', 'html']);
		$this->load->library(['session', 'form_validation']);
		if ($this->session->userdata('logged_in') === NULL) {
            redirect(base_url());
		}
    }

    public function index()
	{

		$this->load->view('data_masjid/index');
	}

	function get_data()
    {
        header('Content-Type: application/json');
        $tables = "data_masjid";
        $search = array('nama_masjid');
		$isWhere = null;
		echo $this->Main_model->get_tables($tables,$search,$isWhere);
    }

    public function tambah()
	{
		$data['page'] = 'Tambah';
		$this->form_validation->set_rules('nama_masjid', 'Nama Masjid', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $data['nama_masjid'] = array(
                'name'  => 'nama_masjid',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('nama_masjid'),
            );
            $data['kyai_kelompok'] = array(
                'name'  => 'kyai_kelompok',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('kyai_kelompok'),
            );
            $data['penrobos'] = array(
                'name'  => 'penrobos',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('penrobos'),
            );
            $data['alamat_masjid'] = array(
                'name'  => 'alamat_masjid',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('alamat_masjid'),
            );
            
           
			$this->load->view('data_masjid/form', $data);

        } else {
            $nama_masjid = $this->input->post('nama_masjid', true);
            $kyai_kelompok = $this->input->post('kyai_kelompok', true);
            $penrobos = $this->input->post('penrobos', true);
            $alamat_masjid = $this->input->post('alamat_masjid', true);
           
            $data = [
                'nama_masjid' => $nama_masjid,
                'kyai_kelompok' => $kyai_kelompok,
                'penrobos' => $penrobos,
                'alamat_masjid' => $alamat_masjid,
               
            ];
			if ($this->Main_model->insert_data($data, 'data_masjid')) {
				redirect('data_masjid', 'refresh');
			} else {
				redirect('salah', 'refresh');
			}
        }
	}

    public function ubah($id)
	{
		$data['page'] = 'Ubah';
		$where = ['id' => $id];
		$row   = $this->Main_model->getwhere('data_masjid', $where)->row_array();

        if (isset($row['id'])) {
			$this->form_validation->set_rules('nama_masjid', 'Nama Lengkap', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				$data['row'] = $row;
                $data['nama_masjid'] = array(
                    'name'  => 'nama_masjid',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('nama_masjid', $row['nama_masjid']),
                );
                
				$this->load->view('data_masjid/form', $data);
			} else {
                $nama_masjid = $this->input->post('nama_masjid', true);
                $data = [
                   
                    'nama_masjid' => $nama_masjid,
                ];

				$where = array('id' => $row['id']);
				if ($this->Main_model->update_data($where, $data, 'data_masjid')) {
					redirect('data_masjid', 'refresh');
				} else {
					redirect('salah', 'refresh');
				}
       		}
        } else {
			redirect('data_masjid', 'refresh');
		}
	}

    public function nonaktif($id)
    {
        $where = array('id' => $id);
        $data = ['status' => date('0')];
		if ($this->Main_model->update_data($where, $data, 'data_masjid')) {
			redirect('data_masjid', 'refresh');
		}
    }

    public function aktif($id)
    {
        $where = array('id' => $id);
        $data = ['status' => date('1')];
		if ($this->Main_model->update_data($where, $data, 'data_masjid')) {
			redirect('data_masjid', 'refresh');
		}
    }
}