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
			redirect(base_url());
		}
    }

	public function index()
	{
		// $data['chart_data'] = $this->Main_model->getChartData();
		$this->load->view('dashboard');
	}
}