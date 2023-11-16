<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class bukti_pembayaran extends CI_Controller {
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
		$this->load->view('laporan/bukti_pembayaran/index', $data);
	}

    function get_data($id)
    {
        header('Content-Type: application/json');
        $query  = "SELECT * FROM konfigurasi_pembayaran";
        $search = array('null');
        switch ($id) {
            case 'semua_toko':
                $where = '';
                break;
            default:
                $where = array('id_toko' => $id);
                break;
        }
        $isWhere = null;

        echo $this->Main_model->get_tables_query($query,$search,$where,$isWhere);
    }

	public function detail()
	{
		$this->load->view('laporan/bukti_pembayaran/detail');
	}
}