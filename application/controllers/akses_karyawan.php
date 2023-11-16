<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class akses_karyawan extends CI_Controller {
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
		$data['akses_karyawan'] = $this->Main_model->get('karyawan_akses')->result();
		$this->load->view('karyawan/akses_karyawan/index', $data);
	}

	function get_data()
    {
        header('Content-Type: application/json');
        $tables = "karyawan_akses";
        $search = array('nama_role');
		// $isWhere = "akses_karyawan.dihapus_pada is NULL";
		$isWhere = null;
		echo $this->Main_model->get_tables($tables,$search,$isWhere);
    }

	public function tambah()
	{
		$data['page'] = 'Tambah';
       
        $this->form_validation->set_rules('nama_role', 'Nama role', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
           
            $data['akses_karyawan'] = $this->Main_model->get('karyawan_akses')->result();
            $data['nama_role'] = array(
                'name'  => 'nama_role',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('nama_role'),
            );
			$this->load->view('karyawan/akses_karyawan/form', $data);
        } else {
            $nama_role = $this->input->post('nama_role', true);
            $data = [
                'nama_role' => $nama_role,
            ];
			if ($this->Main_model->insert_data($data, 'karyawan_akses')) {
				redirect('akses_karyawan', 'refresh');
			} else {
				redirect('salah', 'refresh');
			}
        }
	}

	public function ubah($id)
	{
		$data['page'] = 'Ubah';
		$where = ['id' => $id];
		$row   = $this->Main_model->getwhere('karyawan_akses', $where)->row_array();

        if (isset($row['id'])) {
			$this->form_validation->set_rules('nama_role', 'Nama Role', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				$data['row'] = $row;
                
                $data['nama_role'] = array(
                    'name'  => 'nama_role',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('nama_role', $row['nama_role']),
                );
               
				$this->load->view('karyawan/akses_karyawan/form', $data);
			} else {
                $nama_role = $this->input->post('nama_role', true);
                
                $data = [
                    'nama_role' => $nama_role,
                    
                ];
				$where = array('id' => $row['id']);
				if ($this->Main_model->update_data($where, $data, 'karyawan_akses')) {
					redirect('akses_karyawan', 'refresh');
				} else {
					redirect('salah', 'refresh');
				}
       		}
        } else {
			redirect('akses_karyawan', 'refresh');
		}
	}
	public function hapus($id)
    {
        $where = array('id' => $id);
		$data = ['dihapus_pada' => date('Y-m-d H:i:s')];
		if ($this->Main_model->update_data($where, $data, 'karyawan_akses')) {
			redirect('akses_karyawan', 'refresh');
		}
    }

}