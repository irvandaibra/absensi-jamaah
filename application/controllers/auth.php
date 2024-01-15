<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class auth extends CI_Controller {
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
		if ($this->session->userdata('logged_in') === TRUE) {
			redirect(base_url('dashboard'));
		}
		$this->data['username'] = array(
			'name'	=> 'username',
			'type'	=> 'text',
			'value' => $this->form_validation->set_value('username'),
		);
		$this->data['email'] = array(
			'name'	=> 'email',
			'type'	=> 'email',
			'value' => $this->form_validation->set_value('email'),
		);
		$this->data['password'] = array(
			'name'	=> 'password',
			'type'	=> 'password',
			'value' => $this->form_validation->set_value('password'),
			'minlength'	=> 3,
		);
		$this->load->view('auth/index', $this->data);
	}

	public function register()
	{
		$username = $this->input->post('username', true);
		$email 	  = $this->input->post('email', true);
		$password = $this->input->post('password', true);
		$options  = [
		   'cost' => 12,
		];
		$data = [
			'id' 			=> $this->unique_id(16),
			'username'		=> $username,
			'email' 		=> $email,
			'password' 		=> password_hash($password, PASSWORD_DEFAULT, $options),
			'role'			=> 'Admin',
		];

		$this->Main_model->insert_data($data, 'akun');
		redirect('', 'refresh');
	}

	public function login()
	{
		$password = $this->input->post('password', true);
		$email 	  = $this->input->post('email', true);
		$data  	  = [
		 'email'  => $email,
		];
		$query = $this->Main_model->getwhere('akun', $data);
		$result = $query->row_array();

		if (!empty($result) && password_verify($password, $result['password'])) {
			$data = [
				'logged_in' 	=> TRUE,
				'email'			=> $result['email'],
				'username'		=> $result['username'],
				'role' 			=> $result['role'],
				'id'			=> $result['id'],
			];
			$this->session->set_userdata($data);
			if ($this->session->userdata('role') == 'Admin') {
				redirect('dashboard');
			} else {
				redirect('');
			}
		} else {
			redirect('', 'refresh');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('', 'refresh');
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
}