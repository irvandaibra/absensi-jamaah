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
    public function user_index($code_unik = null)
    {
        if ($code_unik === null) {
            $code_unik = $this->uri->segment(4);
        }
        // Mengambil nilai code_unik dari formulir
        $code_unik = $this->input->get('code_unik');

        // Melakukan validasi jika diperlukan
        if (!empty($code_unik)) {
            $where = ['code_unik' => $code_unik];
            $row   = $this->Main_model->getwhere2('data_jamaah', $where)->row_array();
            if (!empty($row)) {
                $tanggal_lahir = $row["tgl_lahir"];
                $tanggal_ditampilkan = date("d F Y", strtotime($tanggal_lahir));
                $row["tgl_lahir_tampil"] = $tanggal_ditampilkan;
                $data['where'] = $where;
                $data['row'] = $row;
    
                $this->load->view('landingpage/user_publik', $data);
            } else {
                // Menangani kasus jika data tidak ditemukan
                show_404(); // Fungsi ini akan menampilkan halaman error 404
            }
        } else {
            // Handle jika code_unik tidak tersedia atau tidak valid
            echo "Code Unik tidak valid";
        }
    }

}