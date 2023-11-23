<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class absenss extends CI_Controller {
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
		$data['data'] = $this->Main_model->get('absensi')->result();
		$this->load->view('absensi/index', $data);
    }

    function get_data()
    {
        header('Content-Type: application/json');
        $tables = "absensi";
        $search = array('kegiatan_id');
		$isWhere = null;
		echo $this->Main_model->get_tables($tables,$search,$isWhere);
    }

}

