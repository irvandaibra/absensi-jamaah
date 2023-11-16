<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class pesanan extends CI_Controller {
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
		$data['data_log'] = $this->Main_model->getwhere('catatan_aktifitas_bank', ['id_akun' => $this->session->userdata('id')])->result();
		$data['produk'] = $this->Main_model->get('produk')->result();
		$data['toko'] = $this->Main_model->get_toko()->result();
		$this->load->view('gudang/pesanan/index', $data);
	}

	public function detail()
	{
		$data ['status'] = "selesai";
		$this->load->view('gudang/pesanan/detail', $data);
	}

	function get_data()
	{
		header('Content-Type: application/json');
		$tables  = 'po';
		$search  = array('id_toko', 'status', 'id_po_item');
		$where   = array('id_toko');
		$isWhere = 'po.dihapus_pada IS NULL';

		echo $this->Main_model->get_tables_where($tables,$search,$where,$isWhere);
    }

	

	function get_item()
	{
        header('Content-Type: application/json');
		$tables = "po_item";
        $search = array('id_produk');
		$isWhere = ".dihapus_pada is NULL";
		$isWhere = null;
		echo $this->Main_model->get_tables($tables,$search,$isWhere);
    }

	// 	public function tambah_item()
	// {
	// 	$data['page'] = 'Tambah';
    //     $this->form_validation->set_rules('id', 'id', 'trim|required');
    //     $this->form_validation->set_rules('id_produk', 'Nama Produk', 'trim|required');
    //     $this->form_validation->set_rules('stok_awal', 'Stok Awal', 'trim|required');
    //     $this->form_validation->set_rules('jumlah', 'jumlah', 'trim|required');

    //     if ($this->form_validation->run() == FALSE) {
           
    //         $data['produk'] = $this->Main_model->get('produk')->result();
	// 		$data['id'] = array(
	// 			'name'  => 'id',
	// 			'type'  => 'number',
	// 			'value' => $this->form_validation->set_value('id'),
	// 		);
    //         $data['id_produk'] = array(
    //             'name'  => 'id_produk',
    //             'type'  => 'number',
    //             'value' => $this->form_validation->set_value('id_produk'),
    //         );
    //         $data['stok_awal'] = array(
    //             'name'  => 'stok_awal',
    //             'type'  => 'number',
    //             'value' => $this->form_validation->set_value('stok_awal'),
    //         );
    //         $data['jumlah'] = array(
    //             'name'  => 'jumlah',
    //             'type'  => 'number',
    //             'value' => $this->form_validation->set_value('jumlah'),
    //         );
	// 		$this->load->view('gudang/pesanan/form', $data);

    //     } else {
    //         $id = $this->input->post('id', true);
    //         $id_produk = $this->input->post('id_produk', true);
    //         $stok_awal = $this->input->post('stok_awal', true);
    //         $jumlah = $this->input->post('jumlah', true);
           
    //         $data = [
    //             'id' => $id,
    //             'id_produk' => $id_produk,
    //             'stok_awal' => $stok_awal,
    //             'jumlah' => $jumlah,
    //         ];
	// 		if ($this->Main_model->insert_data($data, 'po_item')) {
	// 			redirect('pesanan/tambah', 'refresh');
	// 		} else {
	// 			redirect('salah', 'refresh');
	// 		}
    //     }
	// }

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
            $data['pemasok'] = array(
                'name'  => 'pemasok',
                'value' => $this->form_validation->set_value('pemasok'),
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
			$this->load->view('gudang/pesanan/form', $data);
        }  else {
            $id_produk = $this->input->post('id_barang', true);
            $jumlah_produk = $this->input->post('jumlah_produk', true);
            $id_po = 'pny'.date('md').$this->unique_id(3).date('is');
			foreach ($id_produk as $key => $value) {
				$data['produk_byid'] = $this->Main_model->getwhere('produk', ['id' => $key])->result();
				foreach ($data['produk_byid'] as $row) {
					$perhitungan_stok = $row->stok - $jumlah_produk;
					$stok_awal = $row->stok;
					$where = array('id' => $key);
					$data = [
						'stok' => $perhitungan_stok
					];
					$pengurangan_stok = $this->Main_model->update_data($where, $data, 'produk');
				}
				if ($pengurangan_stok) {
						$logged=$this->Main_model->insert_data(array(
						'id_produk'  	   => $key,
						'jumlah' => $jumlah_produk,
						'stok_awal' => $stok_awal,
						'id_po'   => $id_po
					), 'po_item');
				}else{
					redirect('salah', 'refresh');
				}
            }
			if ($logged) {
				$id_toko   = $this->input->post('id_toko', true);
				$catatan 	  = $this->input->post('catatan', true);
				$pemasok 	  = $this->input->post('pemasok', true);
				$id_po_stok = $id_po;
				$data = [
					'id'  		   => '#'.$this->unique_id(8),
					'id_toko'   => $id_toko,
					'catatan'  	   => $catatan,
					'pemasok'  	   => $pemasok,
					'id_po' => $id_po_stok
				];
				if ($this->Main_model->insert_data($data, 'po')) {
					redirect('pesanan', 'refresh');
				} else {
					redirect('salah', 'refresh');
				}
			} else {
				redirect('salah', 'refresh');
			}
        }
	}

	// public function ubah($id)
	// {
	// 	$data['page'] = 'Ubah';
	// 	$where = ['id' => $id];
	// 	$row   = $this->Main_model->getwhere('po', $where)->row_array();

    //     if (isset($row['id'])) {
	// 		$this->form_validation->set_rules('id_toko', 'Toko', 'trim|required');
	// 		if ($this->form_validation->run() == FALSE) {
	// 			$data['row'] = $row;
	// 			$data['toko'] = $this->Main_model->get_toko()->result();
	
	// 			$data['id_toko'] = array(
	// 				'name'  => 'id_toko',
	// 				'value' => $this->form_validation->set_value('id_toko', $row['id_toko']),
	// 			);
	// 			$data['catatan'] = array(
	// 				'name'  => 'catatan',
	// 				'value' => $this->form_validation->set_value('catatan', $row['catatan']),
	// 			);
	// 			$data['id_po_item'] = array(
	// 				'name'  => 'id_po_item',
	// 				'type'  => 'text',
	// 				'value' => $this->form_validation->set_value('id_po_item', $row['id_po_item']),
	// 			);
	// 			$this->load->view('gudang/po/form', $data);
	// 		} else {
	// 			$id_toko 	= $this->input->post('id_toko', true);
	// 			$catatan 	= $this->input->post('catatan', true);
	// 			$id_po_item = $this->input->post('id_po_item', true);
	// 			$data = [
	// 				'id_toko'  	 => $id_toko,
	// 				'catatan'  	 => $catatan,
	// 				'id_po_item' => $id_po_item,
	// 			];
	// 			$where = array('id' => $row['id']);
	// 			if ($this->Main_model->update_data($where, $data, 'po')) {
	// 				redirect('po', 'refresh');
	// 			} else {
	// 				redirect('salah', 'refresh');
	// 			}
    //    		}
    //     } else {
	// 		redirect('po', 'refresh');
	// 	}
	// }

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

    public function get_produk_byid($id) {
		echo $this->Main_model->getwhere_produk($id);
    }
	
	function get_produk_bytoko_id()
    {
        echo $this->Main_model->get_produk_bytoko($this->input->post('id_toko'));
    }
}