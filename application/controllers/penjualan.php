<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class penjualan extends CI_Controller {
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
		$this->load->view('laporan/penjualan/index', $data);
	}
}