<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class penyesuaian extends CI_Controller {
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
		$this->load->view('gudang/penyesuaian/index', $data);
	}

	function get_data($id)
	{
        header('Content-Type: application/json');
        $query   = "SELECT penyesuaian_stok.id_produk AS id_produk, penyesuaian.* FROM penyesuaian
                   JOIN penyesuaian_stok ON penyesuaian.id_penyesuaian = penyesuaian_stok.id";
        $search  = array('id_produk');
		$where   = array('penyesuaian.id_toko' => $id);
		$isWhere = 'penyesuaian.dihapus_pada IS NULL';

        echo $this->Main_model->get_tables_query($query,$search,$where,$isWhere);
    }

	public function tambah()
	{
        $data['page'] = 'Tambah';
        $this->form_validation->set_rules('id_toko', 'Toko', 'trim|required');
		
        if ($this->form_validation->run() == FALSE) {
            $data['toko'] = $this->Main_model->get_toko()->result();

            $data['id_toko'] = array(
                'name'  => 'id_toko',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('id_toko'),
            );
            $data['catatan'] = array(
                'name'  => 'catatan',
                'value' => $this->form_validation->set_value('catatan'),
            );
            $data['id_penyesuaian_stok'] = array(
                'name'  => 'id_penyesuaian_stok',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('id_penyesuaian_stok'),
            );
			$data['produk'] = $this->Main_model->get('produk')->result();
			$this->load->view('gudang/penyesuaian/form', $data);
        } else {
            $id_produk = $this->input->post('id_barang', true);
            $jumlah_produk = $this->input->post('jumlah_produk', true);
            $id_penyesuaian = 'pny'.date('md').$this->unique_id(3).date('is');
			foreach ($id_produk as $key => $value) {
				$data['produk_byid'] = $this->Main_model->getwhere('produk', ['id' => $key])->result();
				foreach ($data['produk_byid'] as $row) {
					$perhitungan_stok = $row->stok - $jumlah_produk;
					$where = array('id' => $key);
					$data = [
						'stok' => $perhitungan_stok
					];
					$pengurangan_stok = $this->Main_model->update_data($where, $data, 'produk');
				}
				if ($pengurangan_stok) {
						$logged=$this->Main_model->insert_data(array(
						'id_produk'  	   => $key,
						'jumlah_produk' => $jumlah_produk,
						'id_penyesuaian'   => $id_penyesuaian
					), 'penyesuaian_stok');
				}else{
					redirect('salah', 'refresh');
				}
            }
			if ($logged) {
				$id_toko   = $this->input->post('id_toko', true);
				$catatan 	  = $this->input->post('catatan', true);
				$id_penyesuaian_stok = $id_penyesuaian;
				$data = [
					'id'  		   => '#'.$this->unique_id(8),
					'id_toko'   => $id_toko,
					'catatan'  	   => $catatan,
					'id_penyesuaian' => $id_penyesuaian_stok
				];
				if ($this->Main_model->insert_data($data, 'penyesuaian')) {
					redirect('penyesuaian', 'refresh');
				} else {
					redirect('salah', 'refresh');
				}
			} else {
				redirect('salah', 'refresh');
			}
        }
	}

	public function unique_id($unique_id)
	{
		$char = 'abcdef0987654321';
		$string = '';
		for ($i=0; $i < $unique_id; $i++) {
			$post = rand(0, strlen($char)-1);
			$string .= $char[$post];
		}
		return $string;
	}

	public function ubah($id)
	{
		$data['page'] = 'Ubah';
		$where = ['id' => $id];
		$row   = $this->Main_model->getwhere('penyesuaian', $where)->row_array();

        if (isset($row['id'])) {
			$this->form_validation->set_rules('id_toko', 'Toko', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				$data['row'] = $row;
				$data['toko'] = $this->Main_model->get_toko()->result();
	
				$data['id_toko'] = array(
					'name'  => 'id_toko',
					'type'  => 'text',
					'value' => $this->form_validation->set_value('id_toko'),
				);
				$data['catatan'] = array(
					'name'  => 'catatan',
					'value' => $this->form_validation->set_value('catatan'),
				);
				$data['id_penyesuaian_stok'] = array(
					'name'  => 'id_penyesuaian_stok',
					'type'  => 'text',
					'value' => $this->form_validation->set_value('id_penyesuaian_stok'),
				);
				$this->load->view('gudang/penyesuaian/form', $data);
			} else {
				$id_toko = $this->input->post('id_toko', true);
				$catatan = $this->input->post('catatan', true);
				$id_penyesuaian_stok = $this->input->post('id_penyesuaian_stok', true);
				$data = [
					'id_toko'  => $id_toko,
					'catatan'  => $catatan,
					'id_penyesuaian_stok' => $id_penyesuaian_stok,
				];
				$where = array('id' => $row['id']);
				if ($this->Main_model->update_data($where, $data, 'penyesuaian')) {
					redirect('penyesuaian', 'refresh');
				} else {
					redirect('salah', 'refresh');
				}
       		}
        } else {
			redirect('penyesuaian', 'refresh');
		}
	}
	public function detail()
	{
		$this->load->view('gudang/penyesuaian/detail');
	}

    public function get_produk_byid($id) {
		echo $this->Main_model->getwhere_produk($id);
    }
	
	function get_produk_bytoko_id()
    {
        echo $this->Main_model->get_produk_bytoko($this->input->post('id_toko'));
    }
}