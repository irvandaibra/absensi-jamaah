<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class toko extends CI_Controller {
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
		$data['totaldata'] = $this->Main_model->getwhere('toko', ['id_akun' => $this->session->userdata('id'), 'dihapus_pada' => NULL])->num_rows();
		$this->load->view('setting/toko/index', $data);
    }
    
	function get_data()
	{
		header('Content-Type: application/json');
		$tables  = 'toko';
		$search  = array('nama_toko', 'alamat', 'telepon', 'status');
		$where   = array('id_akun' => $this->session->userdata('id'));
		$isWhere = 'toko.dihapus_pada IS NULL';

		echo $this->Main_model->get_tables_where($tables,$search,$where,$isWhere);
	}

	public function tambah()
	{
		$data['page'] = 'Tambah';
        $this->form_validation->set_rules('nama_toko', 'Nama Toko', 'trim|required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
        $this->form_validation->set_rules('kode_pos', 'Kode Pos', 'trim|required');
        $this->form_validation->set_rules('telepon', 'Telepon', 'trim|required');
        
        if ($this->form_validation->run() == FALSE) {
            $data['nama_toko'] = array(
                'name'  => 'nama_toko',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('nama_toko'),
            );
            $data['alamat'] = array(
                'name'  => 'alamat',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('alamat'),
            );
            $data['kode_pos'] = array(
                'name'  => 'kode_pos',
                'type'  => 'number',
                'value' => $this->form_validation->set_value('kode_pos'),
            );
            $data['telepon'] = array(
                'name'  => 'telepon',
                'type'  => 'number',
                'value' => $this->form_validation->set_value('telepon'),
            );
            $data['provinces'] = $this->Main_model->get('provinces')->result();
            $this->load->view('setting/toko/form', $data);
        } else {
            $id = $this->unique_id(6);
            $id_akun = $this->session->userdata('id');
            $nama_toko = $this->input->post('nama_toko', true);
            $alamat = $this->input->post('alamat', true);
            $provinsi = $this->input->post('provinsi', true);
            $kota = $this->input->post('kota', true);
            $kecamatan = $this->input->post('kecamatan', true);
            $desa = $this->input->post('desa', true);
            $kode_pos = $this->input->post('kode_pos', true);
            $telepon = $this->input->post('telepon', true);
            $data = [
                'id'   		=> $id,
                'id_akun'   => $id_akun,
                'nama_toko' => $nama_toko,
                'alamat'    => $alamat,
                'provinsi'  => chained($provinsi, 'provinces'),
                'kota'      => chained($kota, 'regencies'),
				'kecamatan' => chained($kecamatan, 'districts'),
				'desa' => chained($desa, 'villages'),
                'kode_pos'  => $kode_pos,
                'telepon'   => $telepon,
            ];
            // $datastruk = [
            //     'id_toko'   => $id,
            //     'nama_toko' => $nama_toko,
            //     'alamat'    => $alamat,
            //     'provinsi'  => $provinsi,
            //     'kota'      => $kota,
			// 	'kecamatan' => $kecamatan,
            //     'kode_pos'  => $kode_pos,
            //     'telepon'   => $telepon,
            // ];
			if ($this->Main_model->insert_data($data, 'toko')) {
                // $this->Main_model->insert_data($datastruk, 'struk');
				redirect('toko', 'refresh');
			}
        }
    }

	public function ubah($id)
	{
		$data['page'] = 'Ubah';
        $where = array('id' => $id);
		$row   = $this->Main_model->getwhere('toko', $where)->row_array();

        if (isset($row['id'])) {
			$this->form_validation->set_rules('nama_toko', 'nama_toko', 'trim|required');
			$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
			$this->form_validation->set_rules('kode_pos', 'kode_pos', 'trim|required');
			$this->form_validation->set_rules('telepon', 'telepon', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				$data['row'] = $row;

                $data['nama_toko'] = array(
                    'id'    => 'nama_toko',
                    'name'  => 'nama_toko',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('nama_toko', $row['nama_toko']),
                );
                $data['alamat'] = array(
                    'id'    => 'alamat',
                    'name'  => 'alamat',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('alamat', $row['alamat']),
                );
                $data['kode_pos'] = array(
                    'id'    => 'kode_pos',
                    'name'  => 'kode_pos',
                    'type'  => 'number',
                    'value' => $this->form_validation->set_value('kode_pos', $row['kode_pos']),
                );
                $data['telepon'] = array(
                    'id'    => 'telepon',
                    'name'  => 'telepon',
                    'type'  => 'number',
                    'value' => $this->form_validation->set_value('telepon', $row['telepon']),
                );
                $data['provinces'] = $this->Main_model->get('provinces')->result();
				$this->load->view('setting/toko/form', $data);
			} else {
                $nama_toko  = $this->input->post('nama_toko', true);
                $alamat     = $this->input->post('alamat', true);
                $provinsi   = $this->input->post('provinsi', true);
                $kota       = $this->input->post('kota', true);
                $kecamatan  = $this->input->post('kecamatan', true);
                $desa  = $this->input->post('desa', true);
                $kode_pos   = $this->input->post('kode_pos', true);
                $telepon    = $this->input->post('telepon', true);
                $data = [
                    'nama_toko' => $nama_toko,
                    'alamat'    => $alamat,
                    'provinsi'  => chained($provinsi, 'provinces'),
                    'kota'      => chained($kota, 'regencies'),
                    'kecamatan' => chained($kecamatan, 'districts'),
                    'desa' => chained($desa, 'villages'),
                    'kode_pos'  => $kode_pos,
                    'telepon'   => $telepon,
                ];
				$where = array('id' => $row['id']);
				if ($this->Main_model->update_data($where, $data, 'toko')) {
					redirect('toko', 'refresh');
				} else {
					redirect('salah', 'refresh');
				}
       		}
        } else {
			redirect('toko', 'refresh');
		}
    }

    public function hapus($id)
    {
        $where = array('id' => $id);
        $data = ['dihapus_pada' => date('Y-m-d H:i:s')];
		if ($this->Main_model->update_data($where, $data, 'toko')) {
			redirect('toko', 'refresh');
		}
    }
    
    public function aktifkan($id)
    {
        $where = array('id' => $id);
        $data = ['status' => 'Aktif'];
		if ($this->Main_model->update_data($where, $data, 'toko')) {
			redirect('toko', 'refresh');
		}
    }

    public function nonaktifkan($id)
    {
        $where = array('id' => $id);
        $data = ['status' => 'Nonaktif'];
		if ($this->Main_model->update_data($where, $data, 'toko')) {
			redirect('toko', 'refresh');
		}
    }

	public function unique_id($unique_id)
	{
		$char = '1234567890987654321';
		$string = '';
		for ($i=0; $i < $unique_id; $i++) {
			$post = rand(0, strlen($char)-1);
			$string .= $char[$post];
		}
		return $string;
	}

    function get_kabupaten()
    {
        if ($this->input->post('provinsi_id')) {
            echo $this->Main_model->get_kabupaten($this->input->post('provinsi_id'));
        }
    }

    function get_kecamatan()
    {
        if ($this->input->post('kabupaten_id')) {
            echo $this->Main_model->get_kecamatan($this->input->post('kabupaten_id'));
        }
    }

    function get_desa()
    {
        if ($this->input->post('kecamatan_id')) {
            echo $this->Main_model->get_desa($this->input->post('kecamatan_id'));
        }
    }
}