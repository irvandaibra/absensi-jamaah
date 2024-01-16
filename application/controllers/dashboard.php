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

	   // Rekap Absensi
	    $year = date('Y', strtotime($this->Main_model->get('absensi')->last_row()->tanggal_kegiatan));
	    $data['rekap_hadir'] = $this->Main_model->getwhere('absensi', ['kehadiran' => 'Hadir', "YEAR(tanggal_kegiatan)" => $year])->num_rows();
	    $data['rekap_ijin'] = $this->Main_model->getwhere('absensi', ['kehadiran' => 'Izin', "YEAR(tanggal_kegiatan)" => $year])->num_rows();
	    $data['rekap_alpha'] = $this->Main_model->getwhere('absensi', ['kehadiran' => 'Alpha', "YEAR(tanggal_kegiatan)" => $year])->num_rows();

	   // Kategori	
		$lansia = $this->Main_model->getwhere('data_jamaah', ['kategori' => 'lansia'])->num_rows();
		$percentage = ($lansia / $data['total_jamaah']) * 100;
		$data['kategori_lansia'] = number_format((float)$percentage, 2, '.', '');
		
		$umum = $this->Main_model->getwhere('data_jamaah', ['kategori' => 'umum'])->num_rows();
		$percentage = ($umum / $data['total_jamaah']) * 100;
		$data['kategori_umum'] = number_format((float)$percentage, 2, '.', '');
		
		$remaja = $this->Main_model->getwhere('data_jamaah', ['kategori' => 'remaja'])->num_rows();
		$percentage = ($remaja / $data['total_jamaah']) * 100;
		$data['kategori_remaja'] = number_format((float)$percentage, 2, '.', '');

	   // Status
		$pendatang = $this->Main_model->getwhere('data_jamaah', ['status' => 'pendatang'])->num_rows();
		$percentage = ($pendatang / $data['total_jamaah']) * 100;
		$data['status_pendatang'] = number_format((float)$percentage, 2, '.', '');
		
		$pribumi = $this->Main_model->getwhere('data_jamaah', ['status' => 'pribumi'])->num_rows();
		$percentage = ($pribumi / $data['total_jamaah']) * 100;
		$data['status_pribumi'] = number_format((float)$percentage, 2, '.', '');
		$this->load->view('dashboard', $data);
	}
}