<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class daftar_kegiatan extends CI_Controller {
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

		$this->load->view('data_kegiatan/index');
	}

	function get_data()
    {
        header('Content-Type: application/json');
        $tables = "daftar_kegiatan";
        $search = array('nama_kegiatan');
		$isWhere = null;
		echo $this->Main_model->get_tables($tables,$search,$isWhere);
    }

    public function tambah()
	{
		$data['page'] = 'Tambah';
		$this->form_validation->set_rules('nama_kegiatan', 'Nama Kegiatan', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $data['nama_kegiatan'] = array(
                'name'  => 'nama_kegiatan',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('nama_kegiatan'),
            );
           
			$this->load->view('data_kegiatan/form', $data);

        } else {
            $nama_kegiatan = $this->input->post('nama_kegiatan', true);
           
            $data = [
                'nama_kegiatan' => $nama_kegiatan,
               
            ];
			if ($this->Main_model->insert_data($data, 'daftar_kegiatan')) {
				redirect('daftar_kegiatan', 'refresh');
			} else {
				redirect('salah', 'refresh');
			}
        }
	}
}