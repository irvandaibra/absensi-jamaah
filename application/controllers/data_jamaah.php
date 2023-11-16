<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class data_jamaah extends CI_Controller {
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
		$data['data'] = $this->Main_model->get('data_jamaah')->result();
		$this->load->view('data_jamaah/index', $data);
	}

	function get_data()
    {
        header('Content-Type: application/json');
        $tables = "data_jamaah";
        $search = array('nama_lengkap', 'tgl_lahir', 'tmpt_lahir', 'umur', 'kategori', 'status', );
		// $isWhere = "akses_karyawan.dihapus_pada is NULL";
		$isWhere = null;
		echo $this->Main_model->get_tables($tables,$search,$isWhere);
    }

	public function tambah()
	{
		$data['page'] = 'Tambah';
        // $this->form_validation->set_rules('status', 'Toko', 'trim|required');
        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'trim|required');
        $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'trim|required');
        $this->form_validation->set_rules('tmpt_lahir', 'Tempat Lahir', 'trim|required');
        $this->form_validation->set_rules('umur', 'umur', 'trim|required');
        // $this->form_validation->set_rules('kategori', 'kategori', 'trim|required');
        // $this->form_validation->set_rules('status', 'status', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            // $data['toko'] = $this->Main_model->get('toko')->result();
            // $data['akses_karyawan'] = $this->Main_model->get('karyawan_akses')->result();
            $data['nama_lengkap'] = array(
                'name'  => 'nama_lengkap',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('nama_lengkap'),
            );
            $data['tmpt_lahir'] = array(
                'name'  => 'tmpt_lahir',
                'type'  => 'tmpt_lahir',
                'value' => $this->form_validation->set_value('tmpt_lahir'),
            );
            $data['tgl_lahir'] = array(
                'name'  => 'tgl_lahir',
                'type'  => 'date',
                'value' => $this->form_validation->set_value('tgl_lahir'),
            );
            $data['umur'] = array(
                'name'  => 'umur',
                'type'  => 'number',
                'value' => $this->form_validation->set_value('umur'),
            );
            $data['code_unik'] = array(
                'name'  => 'code_unik',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('code_unik'),
            );
            $data['kategori'] = array(
                'name'  => 'kategori',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('kategori'),
            );
            $data['status'] = array(
                'name'  => 'status',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('status'),
            );
			$this->load->view('data_jamaah/form', $data);

        } else {
            $nama_lengkap = $this->input->post('nama_lengkap', true);
            $tmpt_lahir = $this->input->post('tmpt_lahir', true);
            $tgl_lahir = $this->input->post('tgl_lahir', true);
            
            $tanggal_lahir = new DateTime($tgl_lahir);
            $sekarang = new DateTime();

            $tgl_lahir_formatted = date('Ymd', strtotime($tgl_lahir));

            $kode_unik = $tgl_lahir_formatted . '-' . substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890'), 0, 4);

            $umur = $sekarang->diff($tanggal_lahir)->y;
            $status = $this->input->post('status', true);
            $kategori = $this->input->post('kategori', true);
            // $deskripsi = $this->input->post('deskripsi', true);
            $data = [
                'nama_lengkap' => $nama_lengkap,
                'tmpt_lahir' => $tmpt_lahir,
                'tgl_lahir' => $tgl_lahir,
                'umur' => $umur,
                'status' => $status,
                'kategori' => $kategori,
                'code_unik' => $kode_unik,
            ];
			if ($this->Main_model->insert_data($data, 'data_jamaah')) {
				redirect('data_jamaah', 'refresh');
			} else {
				redirect('salah', 'refresh');
			}
        }
	}

    public function ubah($id)
	{
		$data['page'] = 'Ubah';
		$where = ['id' => $id];
		$row   = $this->Main_model->getwhere('data_jamaah', $where)->row_array();

        if (isset($row['id'])) {
			$this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				$data['row'] = $row;

                $data['nama_lengkap'] = array(
                    'name'  => 'nama_lengkap',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('nama_lengkap', $row['nama_lengkap']),
                );
                $data['tmpt_lahir'] = array(
                    'name'  => 'tmpt_lahir',
                    'type'  => 'tmpt_lahir',
                    'value' => $this->form_validation->set_value('tmpt_lahir', $row['tmpt_lahir']),
                );
                $data['tgl_lahir'] = array(
                    'name'  => 'tgl_lahir',
                    'type'  => 'date',
                    'value' => $this->form_validation->set_value('tgl_lahir', $row['tgl_lahir']),
                );
                $data['umur'] = array(
                    'name'  => 'umur',
                    'type'  => 'number',
                    'value' => $this->form_validation->set_value('umur', $row['umur']),
                );
                $data['code_unik'] = array(
                    'name'  => 'code_unik',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('code_unik', $row['code_unik']),
                );
                $data['kategori'] = array(
                    'name'  => 'kategori',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('kategori', $row['kategori']),
                );
                $data['status'] = array(
                    'name'  => 'status',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('status', $row['status']),
                );
                
				$this->load->view('data_jamaah/form', $data);
			} else {
                $nama_lengkap = $this->input->post('nama_lengkap', true);
                $tmpt_lahir = $this->input->post('tmpt_lahir', true);
                $tgl_lahir = $this->input->post('tgl_lahir', true);
                $tanggal_lahir = new DateTime($tgl_lahir);
                $sekarang = new DateTime();
                
                $kode_unik = $this->input->post('code_unik', true);
                $umur = $sekarang->diff($tanggal_lahir)->y;
                $status = $this->input->post('status', true);
                $kategori = $this->input->post('kategori', true);

                $data = [
                    'nama_lengkap' => $nama_lengkap,
                    'tmpt_lahir' => $tmpt_lahir,
                    'tgl_lahir' => $tgl_lahir,
                    'umur' => $umur,
                    'status' => $status,
                    'kategori' => $kategori,
                    'code_unik' => $kode_unik,
                ];

				$where = array('id' => $row['id']);
				if ($this->Main_model->update_data($where, $data, 'data_jamaah')) {
					redirect('data_jamaah', 'refresh');
				} else {
					redirect('salah', 'refresh');
				}
       		}
        } else {
			redirect('data_jamaah', 'refresh');
		}
	}

    public function hapus($id)
    {
        $where = array('id' => $id);
        $data = ['status_data' => date('0')];
		if ($this->Main_model->update_data($where, $data, 'data_jamaah')) {
			redirect('data_jamaah', 'refresh');
		}
    }



}