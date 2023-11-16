<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class merek extends CI_Controller {
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
		$this->load->view('pustaka/merek/index', $data);
	}
	
    function get_data($id)
    {
		header('Content-Type: application/json');
		$query  = 'SELECT * FROM merek';
		$search  = array('nama_merek');
        switch ($id) {
            case 'semua_toko':
                $where = '';
                break;
            default:
                $where = array('id_toko' => $id);
                break;
        }
		$isWhere = 'merek.dihapus_pada IS NULL';

        echo $this->Main_model->get_tables_query($query,$search,$where,$isWhere);
    }

	public function tambah()
	{
        $data['page'] = 'Tambah';
        $this->form_validation->set_rules('id_toko', 'Toko', 'trim|required');
        $this->form_validation->set_rules('nama_merek', 'Nama Merek', 'trim|required');
		
        if ($this->form_validation->run() == FALSE) {
			$data['toko'] = $this->Main_model->get_toko()->result();

            $data['id_toko'] = array(
                'name'  => 'id_toko',
                'value' => $this->form_validation->set_value('id_toko'),
            );
            $data['nama_merek'] = array(
                'name'  => 'nama_merek',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('nama_merek'),
            );
			$this->load->view('pustaka/merek/form', $data);
        } else {
			$id_toko 	= $this->input->post('id_toko', true);
			$nama_merek = $this->input->post('nama_merek', true);
			$submit		= $this->input->post('submit_type', true);
			if ($submit == 'spesific_o') {
				$data = [
					'id_toko' 	 => $id_toko,
					'nama_merek' => $nama_merek,
				];
				if ($this->Main_model->insert_data($data, 'merek')) {
					redirect('merek', 'refresh');
				} else {
					redirect('salah', 'refresh');
				}
			} else if ($submit == 'all_o') {
				$outlet = $this->Main_model->get_toko()->result();
				foreach ($outlet as $key) {
					$this->Main_model->insert_data([
						'id_toko' => $key->id,
						'nama_merek' => $nama_merek,
					], 'merek');
				}
				redirect('merek', 'refresh');
			}
        }
	}

	public function ubah($id)
	{
		$data['page'] = 'Ubah';
		$where = ['id' => $id];
		$row   = $this->Main_model->getwhere('merek', $where)->row_array();

        if (isset($row['id'])) {
        $this->form_validation->set_rules('id_toko', 'Toko', 'trim|required');
        $this->form_validation->set_rules('nama_merek', 'Nama Merek', 'trim|required');

			if ($this->form_validation->run() == FALSE) {
				$data['row'] = $row;
				$data['toko'] = $this->Main_model->get_toko()->result();

				$data['id_toko'] = array(
					'name'  => 'id_toko',
					'value' => $this->form_validation->set_value('id_toko', $row['id_toko']),
				);
				$data['nama_merek'] = array(
					'name'  => 'nama_merek',
					'type'  => 'text',
					'value' => $this->form_validation->set_value('nama_merek', $row['nama_merek']),
				);
				$this->load->view('pustaka/merek/form', $data);
			} else {
				$id_toko 	= $this->input->post('id_toko', true);
				$nama_merek = $this->input->post('nama_merek', true);
				$data = [
					'id_toko' 	 => $id_toko,
					'nama_merek' => $nama_merek,
				];
				$where = array('id' => $row['id']);
				if ($this->Main_model->update_data($where, $data, 'merek')) {
					redirect('merek', 'refresh');
				} else {
					redirect('salah', 'refresh');
				}
       		}
        } else {
			redirect('merek', 'refresh');
		}
	}

    public function hapus($id)
    {
        $where = array('id' => $id);
        $data = ['dihapus_pada' => date('Y-m-d H:i:s')];
		if ($this->Main_model->update_data($where, $data, 'merek')) {
			redirect('merek', 'refresh');
		}
    }
}