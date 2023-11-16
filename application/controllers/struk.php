<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class struk extends CI_Controller {
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
       
		$where = ['id' => $this->input->post('id')];
		$row  = $this->Main_model->getwhere('toko', $where)->row_array();
		$data['toko'] = $this->Main_model->get_toko();

        $selected_id = $this->input->post('id');

        if ($selected_id !== null && is_numeric($selected_id)) {
            $where = ['id' => $selected_id];
            $data['selected_row'] = $this->Main_model->getwhere('toko', $where)->row_array();
        } else {
            $data['selected_row'] = null;
        }

		$data['row'] = $row;
		$data['toko'] = $this->Main_model->get_toko()->result();

		$data['id_toko'] = array(
			'name'  => 'id',
			'value' => $this->form_validation->set_value('id', isset($row['id']) ? $row['id'] : ''),
		);
		
		$data['logo'] = array(
			'id'    => 'logo',
			'name'  => 'logo',
			'value' => $this->form_validation->set_value('id', isset($row['id']) ? $row['id'] : ''),
		);
		$data['nama_toko'] = array(
			'id'    => 'nama_toko',
			'name'  => 'nama_toko',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('nama_toko', isset($row['nama_toko']) ? $row['nama_toko'] : ''),
		);
		$data['alamat'] = array(
			'id'    => 'alamat',
			'name'  => 'alamat',
			'value' => $this->form_validation->set_value('alamat', isset($row['alamat']) ? $row['alamat'] : ''),
		);
		$data['provinsi'] = array(
			'id'    => 'provinsi',
			'name'  => 'provinsi',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('provinvi', isset($row['provinvi']) ? $row['provinvi'] : ''),
		);
		$data['kota'] = array(
			'id'    => 'kota',
			'name'  => 'kota',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('kota', isset($row['kota']) ? $row['kota'] : ''),
		);
		$data['kecamatan'] = array(
			'id'    => 'kecamatan',
			'name'  => 'kecamatan',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('kecamatan', isset($row['kecamatan']) ? $row['kecamatan'] : ''),
		);
		$data['kode_pos'] = array(
			'id'    => 'kode_pos',
			'name'  => 'kode_pos',
			'type'  => 'number',
			'value' => $this->form_validation->set_value('kode_pos', isset($row['kode_pos']) ? $row['kode_pos'] : ''),
		);
		$data['telepon'] = array(
			'id'    => 'telepon',
			'name'  => 'telepon',
			'type'  => 'number',
			'value' => $this->form_validation->set_value('telepon', isset($row['telepon']) ? $row['telepon'] : ''),
		);
		$data['link_website'] = array(
			'id'    => 'link_website',
			'name'  => 'link_website',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('link_website', isset($row['link_website']) ? $row['link_website'] : ''),
		);
		$data['link_twitter'] = array(
			'id'    => 'link_twitter',
			'name'  => 'link_twitter',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('link_twitter', isset($row['link_twitter']) ? $row['link_twitter'] : ''),
		);
		$data['link_facebook'] = array(
			'id'    => 'link_facebook',
			'name'  => 'link_facebook',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('link_facebook', isset($row['link_facebook']) ? $row['link_facebook'] : ''),
		);
		$data['link_instagram'] = array(
			'id'    => 'link_instagram',
			'name'  => 'link_instagram',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('link_instagram', isset($row['link_instagram']) ? $row['link_instagram'] : ''),
		);
		$data['catatan'] = array(
			'id'    => 'catatan',
			'name'  => 'catatan',
			'value' => $this->form_validation->set_value('catatan', isset($row['catatan']) ? $row['catatan'] : ''),
		);
		$this->load->view('setting/struk/index', $data);
	}

    function save()
    {
		$logo     	    = $this->input->post('logo', true);
		$nama_toko      = $this->input->post('nama_toko', true);
		$alamat 	    = $this->input->post('alamat', true);
		$provinsi	    = $this->input->post('provinsi', true);
		$kota 		    = $this->input->post('kota', true);
		$kecamatan	    = $this->input->post('kecamatan', true);
		$kode_pos 	    = $this->input->post('kode_pos', true);
		$telepon  	    = $this->input->post('telepon', true);
		$link_website   = $this->input->post('link_website', true);
		$link_twitter   = $this->input->post('link_twitter', true);
		$link_facebook  = $this->input->post('link_facebook', true);
		$link_instagram = $this->input->post('link_instagram', true);
		$catatan 		= $this->input->post('catatan', true);
		$data = [
			'logo'       	  => $logo,
			'nama_toko'       => $nama_toko,
			'alamat'  		  => $alamat,
			'provinsi' 		  => $provinsi,
			'kota'   		  => $kota,
			'kecamatan' 	  => $kecamatan,
			'kode_pos' 		  => $kode_pos,
			'telepon'  		  => $telepon,
			'link_website'    => $link_website,
			'link_twitter'    => $link_twitter,
			'link_facebook'   => $link_facebook,
			'link_instagram'  => $link_instagram,
			'catatan'  		  => $catatan,
		];
		$where = array('id' => $this->input->post('id'));
		if ($this->Main_model->update_data($where, $data, 'toko')) {
			redirect('struk', 'refresh');
		} else {
			redirect('salah', 'refresh');
		}
    }

    // public function get_data()
    // {
    //     $id = $this->input->post('id',TRUE);
    //     $data = $this->Main_model->getwhere('toko', array('id' => $id))->result();
    //     echo json_encode($data);
    // }
}