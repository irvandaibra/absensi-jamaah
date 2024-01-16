<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class dashboard extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
		$this->load->model('Main_model');
		date_default_timezone_set('Asia/Jakarta');
		$this->load->helper(array('Form', 'Cookie', 'String'));
		if ($this->session->userdata('logged_in') === NULL) {
			if ($this->session->userdata('role') === 'Admin') {
				redirect(base_url());
			}
		}
    }

	public function index()
	{
		// $data['chart_data'] = $this->Main_model->getChartData();
		$data['total_jamaah'] = $this->Main_model->get('data_jamaah')->num_rows();
		$data['total_absensi'] = $this->Main_model->get('absensi')->num_rows();
		$data['total_daftar_kegiatan'] = $this->Main_model->get('daftar_kegiatan')->num_rows();
		$this->load->view('dashboard', $data);
	}
}