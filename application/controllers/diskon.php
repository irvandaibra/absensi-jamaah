<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class diskon extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
		$this->load->model('Main_model');
		date_default_timezone_set('Asia/Jakarta');
		$this->load->helper(['url', 'form', 'html', 'main_helper']);
		$this->load->library(['session', 'form_validation']);
		if ($this->session->userdata('logged_in') === NULL) {
            redirect(base_url());
		}
    }
	
	public function index()
	{
		$data['toko'] = $this->Main_model->get_toko()->result();
		$this->load->view('pustaka/diskon/index', $data);
	}

    function get_data($id)
    {
        header('Content-Type: application/json');
        $query  = "SELECT toko.nama_toko AS nama_toko, diskon.* FROM diskon 
                   JOIN toko ON diskon.id_toko = toko.id";
        $search = array('nama_toko','nama_diskon','jumlah');
        switch ($id) {
            case 'semua_toko':
                $where = '';
                break;
            default:
                $where = array('id_toko' => $id);
                break;
        }
        $isWhere = 'diskon.dihapus_pada IS NULL';

        echo $this->Main_model->get_tables_query($query,$search,$where,$isWhere);
    }

	public function tambah()
	{
        $data['page'] = 'Tambah';
        $this->form_validation->set_rules('id_toko', 'Toko', 'trim|required');
        $this->form_validation->set_rules('nama_diskon', 'Nama Diskon', 'trim|required');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'trim|required');
        $this->form_validation->set_rules('tipe_diskon', 'Tipe Diskon', 'trim|required');
		
        if ($this->form_validation->run() == FALSE) {
			$data['toko'] = $this->Main_model->get_toko()->result();

            $data['id_toko'] = array(
                'name'  => 'id_toko',
                'value' => $this->form_validation->set_value('id_toko'),
            );
            $data['nama_diskon'] = array(
                'name'  => 'nama_diskon',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('nama_diskon'),
            );
            $data['jumlah'] = array(
                'name'  => 'jumlah',
                'type'  => 'number',
                'value' => $this->form_validation->set_value('jumlah'),
            );
            $data['tipe_diskon'] = array(
                'name'  => 'tipe_diskon'
            );
			$this->load->view('pustaka/diskon/form', $data);
        } else {
			$id_toko 	   = $this->input->post('id_toko', true);
			$nama_diskon   = $this->input->post('nama_diskon', true);
			$jumlah 	   = $this->input->post('jumlah', true);
			$tipe_diskon   = $this->input->post('tipe_diskon', true);
			$data = [
				'id_toko' 	  => $id_toko,
                'nama_diskon' => $nama_diskon,
				'jumlah' 	  => $jumlah,
                'tipe_diskon' => $tipe_diskon
            ];
			// if (is_array($id_toko) || is_object($id_toko)) {
			// 	foreach ($id_toko as $key) {
			// 		$this->Main_model->insert_data([
			// 			'id_toko' 	  => $key,
			// 			'nama_diskon' => $nama_diskon,
			// 			'jumlah' 	  => $jumlah,
			// 			'tipe_diskon' => $tipe_diskon
			// 		], 'diskon');
			// 	}
			// }
			if ($this->Main_model->insert_data($data, 'diskon')) {
				redirect('diskon', 'refresh');
			} else {
				redirect('salah', 'refresh');
			}
        }
	}

	public function ubah($id)
	{
		$data['page'] = 'Ubah';
		$where = ['id' => $id];
		$row   = $this->Main_model->getwhere('diskon', $where)->row_array();

        if (isset($row['id'])) {
			$this->form_validation->set_rules('id_toko', 'Toko', 'trim|required');
			$this->form_validation->set_rules('nama_diskon', 'Nama Diskon', 'trim|required');
			$this->form_validation->set_rules('jumlah', 'Jumlah', 'trim|required');
			$this->form_validation->set_rules('tipe_diskon', 'Tipe Diskon', 'trim|required');

			if ($this->form_validation->run() == FALSE) {
				$data['row'] = $row;
				$data['toko'] = $this->Main_model->get_toko()->result();
	
				$data['id_toko'] = array(
					'name'  => 'id_toko',
					'value' => $this->form_validation->set_value('id_toko', $row['id_toko']),
				);
				$data['nama_diskon'] = array(
					'name'  => 'nama_diskon',
					'type'  => 'text',
					'value' => $this->form_validation->set_value('nama_diskon', $row['nama_diskon']),
				);
				$data['jumlah'] = array(
					'name'  => 'jumlah',
					'type'  => 'number',
					'value' => $this->form_validation->set_value('jumlah', $row['jumlah']),
				);
				$data['tipe_diskon'] = array(
					'name'  => 'tipe_diskon',
					'type'  => 'text',
					'value' => $this->form_validation->set_value('tipe_diskon', $row['tipe_diskon']),
				);
				$this->load->view('pustaka/diskon/form', $data);
			} else {
				$id_toko 	   = $this->input->post('id_toko', true);
				$nama_diskon   = $this->input->post('nama_diskon', true);
				$jumlah 	   = $this->input->post('jumlah', true);
				$tipe_diskon   = $this->input->post('tipe_diskon', true);
				$data = [
					'id_toko' => $id_toko,
					'nama_diskon' => $nama_diskon,
					'jumlah' => $jumlah,
					'tipe_diskon' => $tipe_diskon,
				];
				$where = array('id' => $row['id']);
				if ($this->Main_model->update_data($where, $data, 'diskon')) {
					redirect('diskon', 'refresh');
				} else {
					redirect('salah', 'refresh');
				}
       		}
        } else {
			redirect('diskon', 'refresh');
		}
	}

    public function hapus($id)
    {
        $where = array('id' => $id);
        $data = ['dihapus_pada' => date('Y-m-d H:i:s')];
		if ($this->Main_model->update_data($where, $data, 'diskon')) {
			redirect('diskon', 'refresh');
		}
    }

}