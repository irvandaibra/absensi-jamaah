<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class metode_pembayaran extends CI_Controller {

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
		$data['pembayaran'] = $this->Main_model->get('metode_pembayaran')->result();
		$this->load->view('pembayaran/metode_pembayaran/index', $data);
	}

	function get_data()
    {
        header('Content-Type: application/json');
        $tables = "metode_pembayaran";
        $search = array('nama_pembayaran');
        $isWhere = null;
        echo $this->Main_model->get_tables($tables,$search,$isWhere);
    }

	public function tambah()
	{
		
		$data['page'] = 'Tambah';
        $this->form_validation->set_rules('nama_pembayaran', 'Nama pembayaran', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $data['foto'] = array(
                'name'  => 'foto',
                'value' => $this->form_validation->set_value('foto'),
            );
            $data['nama_pembayaran'] = array(
                'name'  => 'nama_pembayaran',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('nama_pembayaran'),
            );
			$this->load->view('pembayaran/metode_pembayaran/form', $data);
        } else {
            $nama_pembayaran = $this->input->post('nama_pembayaran', true);
            $data = [
                'nama_pembayaran' => $nama_pembayaran,
            ];
			if ($this->Main_model->insert_data($data, 'metode_pembayaran')) {
				redirect('metode_pembayaran', 'refresh');
			} else {
				redirect('salah', 'refresh');
			}
        }
	}

	public function ubah($id)
	{
		$data['page'] = 'Ubah';
		$where = ['id' => $id];
		$row   = $this->Main_model->getwhere('metode_pembayaran', $where)->row_array();

        if (isset($row['id'])) {
			$this->form_validation->set_rules('nama_pembayaran', 'Nama Pembayaran', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
			$data['row'] = $row;

				$data['nama_pembayaran'] = array(
					'name'  => 'nama_pembayaran',
					'type'  => 'text',
					'value' => $this->form_validation->set_value('nama_pembayaran', $row['nama_pembayaran']),
				);
				$data['foto'] = array(
					'name'  => 'foto',
					'value' => $this->form_validation->set_value('foto'),
				);
				$this->load->view('pembayaran/metode_pembayaran/form', $data, $row);
			} else {
				$nama_pembayaran = $this->input->post('nama_pembayaran', true);
				$foto = $this->input->post('foto', true);
				$data = [
					'nama_pembayaran' => $nama_pembayaran,
					'foto' => $foto,
				];
				$where2 = array('id' => $row['id']);
				if ($this->Main_model->update_data($where2, $data, 'metode_pembayaran')) {
					redirect('metode_pembayaran', 'refresh');
				} else {
					redirect('salah', 'refresh');
				}
       		}
        } else {
			redirect('metode_pembayaran', 'refresh');
		}
	}
	public function hapus($id)
    {
        $where = array('id' => $id);
		
		if ($this->Main_model->delete_data($where, 'metode_pembayaran')) {
			redirect('metode_pembayaran', 'refresh');
		}
    }
}