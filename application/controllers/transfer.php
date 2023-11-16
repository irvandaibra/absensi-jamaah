<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class transfer extends CI_Controller {
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
		$this->load->view('gudang/transfer/index', $data);
	}

	function get_data()
	{
        header('Content-Type: application/json');
        $query   = "SELECT transfer_item.id_produk AS id_produk, transfer.* FROM transfer
                   JOIN transfer_item ON transfer.id_transfer = transfer_item.id";
        $search  = array('id_produk');
		$where   = array('transfer.id_akun' => $this->session->userdata('id'));
		$isWhere = 'transfer.dihapus_pada IS NULL';

        echo $this->Main_model->get_tables_query($query,$search,$where,$isWhere);
    }

	public function detail()
	{
		$data['transfer'] = $this->Main_model->getwhere('transfer', ['id_akun' => $this->session->userdata('id')])->result();
		$this->load->view('gudang/transfer/detail', $data);
	}

	public function tambah()
	{
        $data['page'] = 'Tambah';
        $this->form_validation->set_rules('id_dari_toko', 'Toko', 'trim|required');
        $this->form_validation->set_rules('id_ke_toko', 'Toko', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $data['toko'] = $this->Main_model->get_toko()->result();

            $data['id_dari_toko'] = array(
                'name'  => 'id_dari_toko',
                'value' => $this->form_validation->set_value('id_dari_toko')
            );
            $data['id_ke_toko'] = array(
                'name'  => 'id_ke_toko',
                'value' => $this->form_validation->set_value('id_ke_toko')
            );
            $data['catatan'] = array(
                'name'  => 'catatan',
                'value' => $this->form_validation->set_value('catatan')
            );
            $data['id_transfer_item'] = array(
                'name'  => 'id_transfer_item',
                'value' => $this->form_validation->set_value('id_transfer_item')
            );
			$data['produk'] = $this->Main_model->get('produk')->result();
			$this->load->view('gudang/transfer/form', $data);
        } else {
            $id_produk = $this->input->post('id_barang', true);
            $jumlah_produk = $this->input->post('jumlah_produk', true);
            $id_transfer = 'trn'.date('md').$this->unique_id(3).date('is');
			foreach ($id_produk as $key => $value) {
				
				$data['produk_byid'] = $this->Main_model->getwhere('produk', ['id' => $key])->result();
				foreach ($data['produk_byid'] as $row) {
					// Pengurangan Stok
					$perhitungan_stok = $row->stok - $jumlah_produk;
					$where = array('id' => $key);
					$data = [
						'stok' => $perhitungan_stok
					];
					$pengurangan_stok = $this->Main_model->update_data($where, $data, 'produk');
					// Pindah Produk
					$id_ke_toko   = $this->input->post('id_ke_toko', true);
					$get_by_produk_nama_produk = $this->Main_model->getwhere('produk', ['id_toko' => $id_ke_toko, 'nama_produk' => $row->nama_produk])->result();
					foreach ($get_by_produk_nama_produk as $tambah_stok) {
						if (count($get_by_produk_nama_produk) > 0) {
							$perhitungan_stok_tambah = $tambah_stok->stok + $jumlah_produk;
							$where = array('id_toko' => $id_ke_toko, 'nama_produk' => $row->nama_produk);
							$data = [
								'stok' => $perhitungan_stok_tambah
							];
							$pengurangan_stok = $this->Main_model->update_data($where, $data, 'produk');
						} else {
							$pindah_produk =$this->Main_model->insert_data(array(
								'id_toko' => $id_ke_toko,
								'nama_produk' => $row->nama_produk,
								'id_kategori' => $row->id_kategori,
								'harga_jual' => $row->harga_jual,
								'harga_beli' => $row->harga_beli,
								'avg' => $row->avg,
								'id_merek' => $row->id_merek,
								'deskripsi' => $row->deskripsi,
								'stok' => $jumlah_produk,
							), 'produk');
						}
					}
					
				}
				if ($pengurangan_stok) {
						$logged=$this->Main_model->insert_data(array(
						'id_produk'  	   => $key,
						'jumlah_produk' => $jumlah_produk,
						'id_transfer'   => $id_transfer,
					), 'transfer_item');
				}else{
					redirect('salah', 'refresh');
				}
            }
			if ($logged) {
				$id_akun 	  = $this->session->userdata('id');
				$id_dari_toko = $this->input->post('id_dari_toko', true);
				$id_ke_toko   = $this->input->post('id_ke_toko', true);
				$catatan 	  = $this->input->post('catatan', true);
				$id_transfer_item = $id_transfer;
				$data = [
					'id'  		   => '#'.$this->unique_id(8),
					'id_akun'  	   => $id_akun,
					'id_dari_toko' => $id_dari_toko,
					'id_ke_toko'   => $id_ke_toko,
					'catatan'  	   => $catatan,
					'id_transfer' => $id_transfer_item
				];
				if ($this->Main_model->insert_data($data, 'transfer')) {
					redirect('transfer', 'refresh');
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

    public function input_and_confirm() {
        $this->load->view('gudang/transfer/form');
    }

    public function get_produk_byid($id) {
		echo $this->Main_model->getwhere_produk($id);
    }
	
	function get_produk_bytoko_id()
    {
        echo $this->Main_model->get_produk_bytoko($this->input->post('id_toko'));
    }
}