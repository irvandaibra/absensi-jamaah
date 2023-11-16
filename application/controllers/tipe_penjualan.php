<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class tipe_penjualan extends CI_Controller {
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
		$this->load->view('pustaka/tipe_penjualan/index', $data);
	}

	function get_data($id)
	{
		header('Content-Type: application/json');
		$query  = 'SELECT * FROM tipe_penjualan';
		$search  = array('nama_tipe', 'status');
        switch ($id) {
            case 'semua_toko':
                $where = '';
                break;
            default:
                $where = array('id_toko' => $id);
                break;
        }
		$isWhere = 'tipe_penjualan.dihapus_pada IS NULL';

        echo $this->Main_model->get_tables_query($query,$search,$where,$isWhere);
	}

	public function tambah()
	{
        $data['page'] = 'Tambah';
        $this->form_validation->set_rules('id_toko', 'Toko', 'trim|required');
        $this->form_validation->set_rules('nama_tipe', 'Nama tipe', 'trim|required');
		
        if ($this->form_validation->run() == FALSE) {
            $data['toko'] = $this->Main_model->get_toko()->result();

            $data['id_toko'] = array(
                'name'  => 'id_toko',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('id_toko'),
            );
            $data['nama_tipe'] = array(
                'name'  => 'nama_tipe',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('nama_tipe'),
            );
            $data['persen_diterima'] = array(
                'name'  => 'persen_diterima',
                'type'  => 'number',
                'value' => $this->form_validation->set_value('persen_diterima'),
            );
			$this->load->view('pustaka/tipe_penjualan/form', $data);
        } else {
            $id_toko 		 = $this->input->post('id_toko', true);
            $nama_tipe	 	 = $this->input->post('nama_tipe', true);
            $persen_diterima = $this->input->post('persen_diterima', true);
			$submit		     = $this->input->post('submit_type', true);
			if ($submit == 'spesific_o') {
                $data = [
                    'id_toko'     	  => $id_toko,
                    'nama_tipe' 	  => $nama_tipe,
                    'persen_diterima' => $persen_diterima,
                ];
                if ($this->Main_model->insert_data($data, 'tipe_penjualan')) {
                    redirect('tipe_penjualan', 'refresh');
                } else {
                    redirect('salah', 'refresh');
                }
			} else if ($submit == 'all_o') {
				$outlet = $this->Main_model->get_toko()->result();
				foreach ($outlet as $key) {
					$this->Main_model->insert_data([
						'id_toko' => $key->id,
                        'nama_tipe' 	  => $nama_tipe,
                        'persen_diterima' => $persen_diterima
					], 'tipe_penjualan');
				}
				redirect('tipe_penjualan', 'refresh');
			}
        }
	}

	public function ubah($id)
	{
		$data['page'] = 'Ubah';
		$where = ['id' => $id];
		$row   = $this->Main_model->getwhere('tipe_penjualan', $where)->row_array();

        if (isset($row['id'])) {
			$this->form_validation->set_rules('nama_tipe', 'Nama tipe_penjualan', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				$data['row'] = $row;
                $data['toko'] = $this->Main_model->get_toko()->result();
    
                $data['id_toko'] = array(
                    'name'  => 'id_toko',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('id_toko', $row['id_toko']),
                );
                $data['nama_tipe'] = array(
                    'name'  => 'nama_tipe',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('nama_tipe', $row['nama_tipe']),
                );
				$this->load->view('pustaka/tipe_penjualan/form', $data);
			} else {
                $id_toko     = $this->input->post('id_toko', true);
                $nama_tipe 	 = $this->input->post('nama_tipe', true);
				$data = [
                    'id_toko'     => $id_toko,
                    'nama_tipe'   => $nama_tipe,
				];
				$where = array('id' => $row['id']);
				if ($this->Main_model->update_data($where, $data, 'tipe_penjualan')) {
					redirect('tipe_penjualan', 'refresh');
				} else {
					redirect('salah', 'refresh');
				}
       		}
        } else {
			redirect('tipe_penjualan', 'refresh');
		}
	}

    public function hapus($id)
    {
        $where = array('id' => $id);
        $data = ['dihapus_pada' => date('Y-m-d H:i:s')];
		if ($this->Main_model->update_data($where, $data, 'tipe_penjualan')) {
			redirect('tipe_penjualan', 'refresh');
		}
    }

    public function aktifkan($id)
    {
        $where = array('id' => $id);
        $data = ['status' => 'Aktif'];
		if ($this->Main_model->update_data($where, $data, 'tipe_penjualan')) {
			redirect('tipe_penjualan', 'refresh');
		}
    }

    public function nonaktifkan($id)
    {
        $where = array('id' => $id);
        $data = ['status' => 'Nonaktif'];
		if ($this->Main_model->update_data($where, $data, 'tipe_penjualan')) {
			redirect('tipe_penjualan', 'refresh');
		}
    }
}