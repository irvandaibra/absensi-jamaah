<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class konfig_pembayaran extends CI_Controller {

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
        $data['toko'] = $this->Main_model->get_toko()->result();
		$data['pembayaran'] = $this->Main_model->get('konfigurasi_pembayaran')->result();
		$this->load->view('pembayaran/konfig_pembayaran/index', $data);
	}

	function get_data($id)
    {
        header('Content-Type: application/json');
        $query   = "SELECT metode_pembayaran.nama_pembayaran AS nama_pembayaran, konfigurasi_pembayaran.* FROM konfigurasi_pembayaran
                   JOIN metode_pembayaran ON konfigurasi_pembayaran.id_metode_pembayaran = metode_pembayaran.id";
        $search  = array('nama_konfigurasi','nama_pembayaran');
		$where   = array('konfigurasi_pembayaran.id_toko' => $id);
		$isWhere = null;

        echo $this->Main_model->get_tables_query($query,$search,$where,$isWhere);
    }

	public function tambah()
	{
		$data['page'] = 'Tambah';
        $this->form_validation->set_rules('nama_konfigurasi', 'Nama Konfigurasi', 'trim|required');
        $this->form_validation->set_rules('id_toko', 'Toko', 'trim|required');
        $this->form_validation->set_rules('id_metode_pembayaran', 'Metode Pembayaran', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $data['toko'] = $this->Main_model->get('toko')->result();
            $data['metode'] = $this->Main_model->get('metode_pembayaran')->result();
            $data['nama_konfigurasi'] = array(
                'name'  => 'nama_konfigurasi',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('nama_konfigurasi'),
            );
            $data['id_toko'] = array(
                'name'  => 'id_toko',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('id_toko'),
            );
            $data['id_metode_pembayaran'] = array(
                'name'  => 'id_metode_pembayaran',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('id_metode_pembayaran'),
            );
			$this->load->view('pembayaran/konfig_pembayaran/form', $data);
        } else {
            $nama_konfigurasi = $this->input->post('nama_konfigurasi', true);
            $id_toko = $this->input->post('id_toko', true);
            $id_metode_pembayaran = $this->input->post('id_metode_pembayaran', true);
            $data = [
                'nama_konfigurasi' => $nama_konfigurasi,
                'id_toko' => $id_toko,
                'id_metode_pembayaran' => $id_metode_pembayaran,
            ];
			if ($this->Main_model->insert_data($data, 'konfigurasi_pembayaran')) {
				redirect('konfig_pembayaran', 'refresh');
			} else {
				redirect('salah', 'refresh');
			}
        }
	}
    public function ubah($id)
	{
		$data['page'] = 'Ubah';
		$where = ['id' => $id];
		$row   = $this->Main_model->getwhere('konfigurasi_pembayaran', $where)->row_array();

        if (isset($row['id'])) {
			$this->form_validation->set_rules('nama_konfigurasi', 'Nama Konfigurasi', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				$data['row'] = $row;
                $data['toko'] = $this->Main_model->get('toko')->result();
                $data['metode'] = $this->Main_model->get('metode_pembayaran')->result();

                $data['nama_konfigurasi'] = array(
                    'name'  => 'nama_konfigurasi',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('nama_konfigurasi', $row['nama_konfigurasi']),
                );
                $data['id_toko'] = array(
                    'name'  => 'id_toko',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('id_toko', $row['id_toko']),
                );
                $data['id_metode_pembayaran'] = array(
                    'name'  => 'id_metode_pembayaran',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('id_metode_pembayaran', $row['id_metode_pembayaran']),
                );
                
				$this->load->view('pembayaran/konfig_pembayaran/form', $data);
			} else {
                $nama_konfigurasi = $this->input->post('nama_konfigurasi', true);
                $id_toko = $this->input->post('id_toko', true);
                $id_metode_pembayaran = $this->input->post('id_metode_pembayaran', true);
                $data = [
                    'nama_konfigurasi' => $nama_konfigurasi,
                    'id_toko' => $id_toko,
                    'id_metode_pembayaran' => $id_metode_pembayaran,
                ];
				$where = array('id' => $row['id']);
				if ($this->Main_model->update_data($where, $data, 'konfigurasi_pembayaran')) {
					redirect('konfig_pembayaran', 'refresh');
				} else {
					redirect('salah', 'refresh');
				}
       		}
        } else {
			redirect('konfig_pembayaran', 'refresh');
		}
	}
    public function hapus($id)
    {
        $where = array('id' => $id);
		$data = ['dihapus_pada' => date('Y-m-d H:i:s')];
		if ($this->Main_model->update_data($where, $data, 'konfigurasi_pembayaran')) {
			redirect('konfig_pembayaran', 'refresh');
		}
    }
}