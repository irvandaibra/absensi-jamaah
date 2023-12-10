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
        
        $code_unik = $this->input->get('code_unik');

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

                if ($this->input->post('submit')) {
                    $code_user = $code_unik;
                    $saran = $this->input->post('saran');
    
                    $saran_tanggapan_data = array(
                        'code_user' => $code_user,
                        'saran' => $saran,
                    );
                    if ($this->Main_model->insert_data2('saran_tanggapan', $saran_tanggapan_data)) {
                    } else {
                    }
                }
            } else {
                show_404();            }
        } else {
            echo "Code Unik tidak valid";
        }
    }

    public function saran_tanggapan() { 
        header('Content-Type: application/json');
        $tables = "saran_tanggapan";
        $search = array('code_user');
		$isWhere = null;
		echo $this->Main_model->get_tables($tables,$search,$isWhere);
    }

}