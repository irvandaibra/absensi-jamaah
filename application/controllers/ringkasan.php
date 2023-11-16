<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ringkasan extends CI_Controller {
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
		$data['toko'] = $this->Main_model->get_toko()->result();
		$this->load->view('gudang/ringkasan/index', $data);
	}

	function get_data($id)
	{
        header('Content-Type: application/json');
        $query  = "SELECT kategori.nama_kategori AS nama_kategori, produk.* FROM produk 
                   JOIN kategori ON produk.id_kategori = kategori.id";
        $search = array('nama_kategori','nama_produk','harga_jual','produk.stok');
        switch ($id) {
            case 'semua_toko':
                $where = '';
                break;
            default:
                $where = array('produk.id_toko' => $id);
                break;
        }
		$isWhere = 'produk.dihapus_pada IS NULL';

        echo $this->Main_model->get_tables_query($query,$search,$where,$isWhere);
    }
}