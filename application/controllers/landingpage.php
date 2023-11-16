<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class landingpage extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
		$this->load->model('Main_model');
		date_default_timezone_set('Asia/Jakarta');
		$this->load->helper(['url', 'form', 'html']);
		$this->load->library(['session', 'form_validation']);
    }

	public function index()
	{
        $this->load->view('landingpage/index');
    }

	public function user_index()
	{
		$this->load->view('landingpage/user_publik');
	}
}