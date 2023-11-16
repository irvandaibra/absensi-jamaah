<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class akun extends CI_Controller {
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
		$data['akun'] = $this->Main_model->getwhere('akun', ['id' => $this->session->userdata('id')])->row_array();
		$this->load->view('setting/akun/index', $data);
	}

	public function akun_admin()
	{
		$data['akun'] = $this->Main_model->getwhere('akun', ['id' => $this->session->userdata('id')])->row_array();
		$this->load->view('setting/akun/akun_admin/index', $data);
	}

	public function akun_kasir()
	{
		// $data['akun'] = $this->Main_model->getwhere('akun', ['id' => $this->session->userdata('id')])->row_array();
		$this->load->view('setting/akun/akun_kasir/index');
	}

	public function tambah_akun_kasir()
	{
		$data['page'] = 'Tambah';
		// $data['akun'] = $this->Main_model->getwhere('akun', ['id' => $this->session->userdata('id')])->row_array();
		$this->load->view('setting/akun/akun_kasir/form', $data);
	}

	public function ubah_akun_kasir()
	{
		$data['page'] = 'Ubah';
		// $data['akun'] = $this->Main_model->getwhere('akun', ['id' => $this->session->userdata('id')])->row_array();
		$this->load->view('setting/akun/akun_kasir/form', $data);
	}
	
	public function ubah_detail_personal()
	{
		$where = ['id' => $this->session->userdata('id')];
		$row   = $this->Main_model->getwhere('akun', $where)->row_array();

        if (isset($row['id'])) {
			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			$this->form_validation->set_rules('telepon', 'Nomor Telepon', 'trim|required');

			if ($this->form_validation->run() == FALSE) {
			
				$data['username'] = array(
					'id'    => 'username',
					'name'  => 'username',
					'type'  => 'text',
					'value' => $this->form_validation->set_value('username', $row['username']),
				);
				$data['telepon'] = array(
					'id'    => 'telepon',
					'name'  => 'telepon',
					'type'  => 'number',
					'value' => $this->form_validation->set_value('telepon', $row['telepon']),
				);
				$data['email'] = array(
					'id'    => 'email',
					'name'  => 'email',
					'type'  => 'email',
					'value' => $this->form_validation->set_value('email', $row['email']),
				);
				$this->load->view('setting/akun/akun_admin/form/ubah_detail_personal', $data);
			} else {
				$username = $this->input->post('username', true);
				$telepon  = $this->input->post('telepon', true);
				$data = [
					'username' => $username,
					'telepon'  => $telepon,
				];
				$where = array('id' => $row['id']);
				if ($this->Main_model->update_data($where, $data, 'akun')) {
					redirect('akun', 'refresh');
				} else {
					redirect('salah', 'refresh');
				}
			}
        }
	}
	
	public function ubah_info_bisnis()
	{
		$where = ['id' => $this->session->userdata('id')];
		$row   = $this->Main_model->getwhere('akun', $where)->row_array();
		$data['value_provinsi'] = $row['provinsi'];
		$data['value_kota'] = $row['kota'];
		$data['value_kecamatan'] = $row['kecamatan'];
		$data['value_desa'] = $row['desa'];
            

        if (isset($row['id'])) {
			$data['provinces'] = $this->Main_model->get('provinces')->result();
			$this->form_validation->set_rules('nama_bisnis', 'Nama Bisnis', 'trim|required');
			$this->form_validation->set_rules('alamat_bisnis', 'Alamat Bisnis', 'trim|required');
			$this->form_validation->set_rules('kode_pos', 'Kode Pos', 'trim|required');

			if ($this->form_validation->run() == FALSE) {
			
				$data['nama_bisnis'] = array(
					'id'    => 'nama_bisnis',
					'name'  => 'nama_bisnis',
					'type'  => 'text',
					'value' => $this->form_validation->set_value('nama_bisnis', $row['nama_bisnis']),
				);
				$data['alamat_bisnis'] = array(
					'id'    => 'alamat_bisnis',
					'name'  => 'alamat_bisnis',
					'type'  => 'text',
					'value' => $this->form_validation->set_value('alamat_bisnis', $row['alamat_bisnis']),
				);
				$data['kode_pos'] = array(
					'id'    => 'kode_pos',
					'name'  => 'kode_pos',
					'type'  => 'number',
					'value' => $this->form_validation->set_value('kode_pos', $row['kode_pos']),
				);
				$this->load->view('setting/akun/akun_admin/form/ubah_info_bisnis', $data);
			} else {
				$nama_bisnis   = $this->input->post('nama_bisnis', true);
				$alamat_bisnis = $this->input->post('alamat_bisnis', true);
				$provinsi  	   = $this->input->post('provinsi', true);
				$kota 		   = $this->input->post('kota', true);
				$kecamatan     = $this->input->post('kecamatan', true);
				$desa     = $this->input->post('desa', true);
				$kode_pos  	   = $this->input->post('kode_pos', true);
				$data = [
					'nama_bisnis'   => $nama_bisnis,
					'alamat_bisnis' => $alamat_bisnis,
					'provinsi'  => chained($provinsi, 'provinces'),
					'kota'      => chained($kota, 'regencies'),
					'kecamatan' => chained($kecamatan, 'districts'),
					'desa' => chained($desa, 'villages'),
					'kode_pos'  	=> $kode_pos,
				];
				$where = array('id' => $row['id']);
				if ($this->Main_model->update_data($where, $data, 'akun')) {
					redirect('akun', 'refresh');
				} else {
					redirect('salah', 'refresh');
				}
			}
        }
	}
	
	public function ubah_npwp()
	{
		$where = ['id' => $this->session->userdata('id')];
		$row   = $this->Main_model->getwhere('akun', $where)->row_array();

        if (isset($row['id'])) {
			$this->form_validation->set_rules('nama_npwp', 'Nama Bisnis', 'trim|required');
			$this->form_validation->set_rules('nomor_npwp', 'Alamat Bisnis', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
			
				$data['nama_npwp'] = array(
					'id'    => 'nama_npwp',
					'name'  => 'nama_npwp',
					'type'  => 'text',
					'value' => $this->form_validation->set_value('nama_npwp', $row['nama_npwp']),
				);
				$data['nomor_npwp'] = array(
					'id'    => 'nomor_npwp',
					'name'  => 'nomor_npwp',
					'type'  => 'text',
					'value' => $this->form_validation->set_value('nomor_npwp', $row['nomor_npwp']),
				);
				$data['foto_npwp'] = array(
					'id'    => 'foto_npwp',
					'name'  => 'foto_npwp',
					'value' => $this->form_validation->set_value('foto_npwp', $row['foto_npwp']),
				);
				$this->load->view('setting/akun/akun_admin/form/ubah_npwp', $data);
			} else {
				$nama_npwp   = $this->input->post('nama_npwp', true);
				$nomor_npwp  = $this->input->post('nomor_npwp', true);
				$foto_npwp   = $this->input->post('foto_npwp', true);
				$data = [
					'nama_npwp'  => $nama_npwp,
					'nomor_npwp' => $nomor_npwp,
					'foto_npwp'  => $foto_npwp,
				];
				$where = array('id' => $row['id']);
				if ($this->Main_model->update_data($where, $data, 'akun')) {
					redirect('akun', 'refresh');
				} else {
					redirect('salah', 'refresh');
				}
			}
        }
	}
	
	public function ubah_password()
	{
		$where = ['id' => $this->session->userdata('id')];
		$row   = $this->Main_model->getwhere('akun', $where)->row_array();

        if (isset($row['id'])) {
			$this->form_validation->set_rules('password', 'Nama Bisnis', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
			
				$data['password'] = array(
					'id'    => 'password',
					'name'  => 'password',
					'value' => $this->form_validation->set_value('password'),
				);
				$data['password_baru'] = array(
					'id'    => 'password_baru',
					'name'  => 'password_baru',
					'value' => $this->form_validation->set_value('password_baru'),
				);
				$data['konfirmasi_password'] = array(
					'id'    => 'konfirmasi_password',
					'name'  => 'konfirmasi_password',
					'value' => $this->form_validation->set_value('konfirmasi_password'),
				);
				$this->load->view('setting/akun/akun_admin/form/ubah_password', $data);
			} else {
				$password   = $this->input->post('password', true);
				$password_baru   = $this->input->post('password_baru', true);
				$konfirmasi_password  = $this->input->post('konfirmasi_password', true);
				$options  = [
				   'cost' => 12,
				];
				if (password_verify($password, $row['password'])) {
					if ($konfirmasi_password == $password_baru) {
						$data = [
							'password'  => password_hash($konfirmasi_password, PASSWORD_DEFAULT, $options),
						];
						$where = array('id' => $row['id']);
						if ($this->Main_model->update_data($where, $data, 'akun')) {
							redirect('akun', 'refresh');
						} else {
							redirect('salah', 'refresh');
						}
					} else {
						redirect('katasandibarudankonfirmasitidakcocok');
					}
				} else {
					redirect('katasanditidakcocok');
				}
			}
        }
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