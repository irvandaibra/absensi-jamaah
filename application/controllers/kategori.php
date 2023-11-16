<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class kategori extends CI_Controller {
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
		$this->load->view('pustaka/kategori/index', $data);
	}

	function get_data($id)
	{
        header('Content-Type: application/json');
        $query   = "SELECT * FROM kategori";
        $search  = array('nama_kategori');
        switch ($id) {
            case 'semua_toko':
                $where = '';
                break;
            default:
                $where = array('kategori.id_toko' => $id);
                break;
        }
		$isWhere = 'kategori.dihapus_pada IS NULL';
		echo $this->Main_model->get_tables_query($query,$search,$where,$isWhere);
    }

	public function tambah()
	{
        $data['page'] = 'Tambah';
        $this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'trim|required');
		
        if ($this->form_validation->run() == FALSE) {
			$data['toko'] = $this->Main_model->get_toko()->result();

            $data['id_toko'] = array(
                'name'  => 'id_toko',
                'value' => $this->form_validation->set_value('id_toko'),
            );
            $data['nama_kategori'] = array(
                'name'  => 'nama_kategori',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('nama_kategori'),
            );
			$this->load->view('pustaka/kategori/form', $data);
        } else {
			$id_toko 	   = $this->input->post('id_toko', true);
			$nama_kategori = $this->input->post('nama_kategori', true);
			$submit		   = $this->input->post('submit_type', true);
			if ($submit == 'spesific_o') {
				$data = [
					'id_toko' => $id_toko,
					'nama_kategori' => $nama_kategori
				];
				if ($this->Main_model->insert_data($data, 'kategori')) {
					redirect('kategori', 'refresh');
				} else {
					redirect('salah', 'refresh');
				}
			} else if ($submit == 'all_o') {
				$outlet = $this->Main_model->get_toko()->result();
				foreach ($outlet as $key) {
					$this->Main_model->insert_data([
						'id_toko' => $key->id,
						'nama_kategori' => $nama_kategori
					], 'kategori');
				}
				redirect('kategori', 'refresh');
			}
        }
	}

	public function ubah($id)
	{
		$data['page'] = 'Ubah';
		$where = ['id' => $id];
		$row   = $this->Main_model->getwhere('kategori', $where)->row_array();

        if (isset($row['id'])) {
			$this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				$data['row'] = $row;
				$data['toko'] = $this->Main_model->get_toko()->result();

				$data['id_toko'] = array(
					'name'  => 'id_toko',
					'value' => $this->form_validation->set_value('id_toko', $row['id_toko']),
				);
				$data['nama_kategori'] = array(
					'name'  => 'nama_kategori',
					'type'  => 'text',
					'value' => $this->form_validation->set_value('nama_kategori', $row['nama_kategori']),
				);
				$this->load->view('pustaka/kategori/form', $data);
			} else {
				$id_toko 	   = $this->input->post('id_toko', true);
				$nama_kategori = $this->input->post('nama_kategori', true);
				$data = [
					'id_toko' => $id_toko,
					'nama_kategori' => $nama_kategori,
				];
				$where = array('id' => $row['id']);
				if ($this->Main_model->update_data($where, $data, 'kategori')) {
					redirect('kategori', 'refresh');
				} else {
					redirect('salah', 'refresh');
				}
       		}
        } else {
			redirect('kategori', 'refresh');
		}
	}

    public function hapus($id)
    {
        $where = array('id' => $id);
        $data = ['dihapus_pada' => date('Y-m-d H:i:s')];
		if ($this->Main_model->update_data($where, $data, 'kategori')) {
			redirect('kategori', 'refresh');
		}
    }

}