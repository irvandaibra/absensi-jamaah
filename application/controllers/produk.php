<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Csv;

class produk extends CI_Controller {
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
		// $limit_per_page = 3;
		// $start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		// $total_records = $this->Main_model->count_all('produk');
		// if ($total_records > 0) 
		// {
		// 	$anto["produk"] = $this->Main_model->get_produk($limit_per_page, $start_index);
			
		// 	$config['base_url'] = base_url() . 'produk/index';
		// 	$config['total_rows'] = $total_records;
		// 	$config['per_page'] = $limit_per_page;
		// 	$config["uri_segment"] = 3;
			
		// 	$this->pagination->initialize($config);
			
		// 	$anto["links"] = $this->pagination->create_links();
		// }

        $data['toko'] = $this->Main_model->get_toko()->result();
		$data['totaldata'] = $this->Main_model->getwhere('produk', ['dihapus_pada' => NULL])->num_rows();
		$data['produk'] = $this->Main_model->get('produk')->result();
		$this->load->view('pustaka/produk/index', $data);
	}


	function get_data($id)
	{
        header('Content-Type: application/json');
        $query   = "SELECT kategori.nama_kategori AS nama_kategori, produk.* FROM produk
                   JOIN kategori ON produk.id_kategori = kategori.id";
        $search  = array('nama_kategori','nama_produk','harga_jual','produk.stok');
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

	function get_data_toko($id)
	{
        if ($id = 'semua_toko') {
            $where = ['toko.id_akun' => $this->session->userdata('id')];
            $data = $this->Main_model->get_join_one('produk', 'toko', 'id_toko', 'id', $where)->result();
        } else {
            $data = $this->Main_model->getwhere('produk', array('id_toko' => $id, 'dihapus_pada' => NULL))->result();
        }
        // switch ($id) {
        //     case 'semua_toko':
        //         $where = ['toko.id_akun' => $this->session->userdata('id')];
        //         $data = $this->Main_model->get_join_one('produk', 'toko', 'id_toko', 'id', $where)->result();
        //         break;
        //     default:
        //         $data = $this->Main_model->getwhere('produk', array('id_toko' => $id, 'dihapus_pada' => NULL))->result();
        //         break;
        // }
        // $data = $this->Main_model->getwhere('produk', array('id_toko' => $id, 'dihapus_pada' => NULL))->result();
        echo json_encode($data);
    }

	function get_data_kategori($id)
	{
        // $id = $this->input->post('id_toko', TRUE);
        $data = $this->Main_model->getwhere('kategori', array('id_toko' => $id, 'dihapus_pada' => NULL))->result();
        echo json_encode($data);
    }

	function get_data_merek($id)
	{
        $data = $this->Main_model->getwhere('merek', array('id_toko' => $id, 'dihapus_pada' => NULL))->result();
        echo json_encode($data);
    }

    // public function get_data()
    // {
    //     header('Content-Type: application/json');
    //     $list = $this->Main_model->get_datatables();
    //     $data = array();
    //     $no = $this->input->post('start');
        
    //     foreach ($list as $data) {
    //         $no++;
    //         $row = array();
    //         $row[]  = $data->nama_produk;
    //         $row[]  = Kategori($data->id_kategori, 'nama_kategori');
    //         $row[]  = IDR($data->harga);
    //         $row[]  = $data->stok;
    //         $row[]  = 'ahhh';
    //         $row[]  =  '<a href="'.$data->id.'" class="btn btn-sm btn-primary w-100"> Edit Produk </a>';
    //         $rows[] = $row;
    //     }
    //     $output = array(
    //         "draw" => $this->input->post('draw'),
    //         "recordsTotal" => $this->Main_model->count_all('produk'),
    //         "recordsFiltered" => $this->Main_model->count_filtered(),
    //         "data" => $rows,
    //     );
        
    //     $this->output->set_output(json_encode($output));
    // }

	public function tambah()
	{
        $data['page'] = 'Tambah';
        $this->form_validation->set_rules('id_toko', 'Toko', 'trim|required');
        $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'trim|required');
        $this->form_validation->set_rules('harga_jual', 'Harga', 'trim|required');
        $this->form_validation->set_rules('stok', 'Stok', 'trim|required');
		
        if ($this->form_validation->run() == FALSE) {
            $data['toko'] = $this->Main_model->get_toko()->result();
			$data['kategori'] = $this->Main_model->getwhere('kategori', ['dihapus_pada' => NULL])->result();
			$data['merek'] = $this->Main_model->getwhere('merek', ['dihapus_pada' => NULL])->result();

            $data['id_toko'] = array(
                'name'  => 'id_toko',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('id_toko'),
            );
            $data['foto'] = array(
                'name'  => 'foto',
                'value' => $this->form_validation->set_value('foto'),
            );
            $data['nama_produk'] = array(
                'name'  => 'nama_produk',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('nama_produk'),
            );
            $data['id_kategori'] = array(
                'name'  => 'id_kategori',
                'value' => $this->form_validation->set_value('id_kategori'),
            );
            $data['harga_jual'] = array(
                'name'  => 'harga_jual',
                'type'  => 'number',
                'value' => $this->form_validation->set_value('harga_jual'),
            );
            $data['harga_beli'] = array(
                'name'  => 'harga_beli',
                'type'  => 'number',
                'value' => $this->form_validation->set_value('harga_beli'),
            );
            $data['stok'] = array(
                'name'  => 'stok',
                'type'  => 'number',
                'value' => $this->form_validation->set_value('stok'),
            );
            $data['id_merek'] = array(
                'name'  => 'id_merek',
                'value' => $this->form_validation->set_value('id_merek'),
            );
            $data['deskripsi'] = array(
                'name'  => 'deskripsi',
                'value' => $this->form_validation->set_value('deskripsi'),
            );
			$this->load->view('pustaka/produk/form', $data);
        } else {
            $id_toko 	 = $this->input->post('id_toko', true);
            $nama_produk = $this->input->post('nama_produk', true);
            $id_kategori = $this->input->post('id_kategori', true);
            $harga_jual  = $this->input->post('harga_jual', true);
            $harga_beli  = $this->input->post('harga_beli', true);
            $stok 		 = $this->input->post('stok', true);
            $id_merek 	 = $this->input->post('id_merek', true);
            $deskripsi 	 = $this->input->post('deskripsi', true);
			$submit		 = $this->input->post('submit_type', true);
			if ($submit == 'spesific_o') {
                $data = [
                    'id_toko'     => $id_toko,
                    'nama_produk' => $nama_produk,
                    'id_kategori' => $id_kategori,
                    'harga_jual'  => $harga_jual,
                    'harga_beli'  => $harga_beli,
                    'stok'        => $stok,
                    'id_merek'    => $id_merek,
                    'deskripsi'   => $deskripsi
                ];
                if ($this->Main_model->insert_data($data, 'produk')) {
                    redirect('produk', 'refresh');
                } else {
                    redirect('salah', 'refresh');
                }
			} else if ($submit == 'all_o') {
				$outlet = $this->Main_model->get_toko()->result();
				foreach ($outlet as $key) {
					$this->Main_model->insert_data([
						'id_toko' => $key->id,
                        'nama_produk' => $nama_produk,
                        'id_kategori' => $id_kategori,
                        'harga_jual'  => $harga_jual,
                        'harga_beli'  => $harga_beli,
                        'stok'        => $stok,
                        'id_merek'    => $id_merek,
                        'deskripsi'   => $deskripsi
					], 'produk');
				}
				redirect('produk', 'refresh');
			}
        }
	}

	public function ubah($id)
	{
		$data['page'] = 'Ubah';
		$where = ['id' => $id];
		$row   = $this->Main_model->getwhere('produk', $where)->row_array();

        if (isset($row['id'])) {
			$this->form_validation->set_rules('nama_produk', 'Nama produk', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				$data['row'] = $row;
                $data['toko'] = $this->Main_model->get_toko()->result();
                $data['kategori'] = $this->Main_model->get('kategori')->result();
                $data['merek'] = $this->Main_model->get('merek')->result();
    
                $data['id_toko'] = array(
                    'name'  => 'id_toko',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('id_toko', $row['id_toko']),
                );
                $data['foto'] = array(
                    'name'  => 'foto',
                    'value' => $this->form_validation->set_value('foto', $row['foto']),
                );
                $data['nama_produk'] = array(
                    'name'  => 'nama_produk',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('nama_produk', $row['nama_produk']),
                );
                $data['id_kategori'] = array(
                    'name'  => 'id_kategori',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('id_kategori', $row['id_kategori']),
                );
                $data['harga_jual'] = array(
                    'name'  => 'harga_jual',
                    'type'  => 'number',
                    'value' => $this->form_validation->set_value('harga_jual',  $row['harga_jual']),
                );
                $data['harga_beli'] = array(
                    'name'  => 'harga_beli',
                    'type'  => 'number',
                    'value' => $this->form_validation->set_value('harga_beli',  $row['harga_beli']),
                );
                $data['stok'] = array(
                    'name'  => 'stok',
                    'type'  => 'number',
                    'value' => $this->form_validation->set_value('stok', $row['stok']),
                );
                $data['id_merek'] = array(
                    'name'  => 'id_merek',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('id_merek', $row['id_merek']),
                );
                $data['deskripsi'] = array(
                    'name'  => 'deskripsi',
                    'value' => $this->form_validation->set_value('deskripsi', $row['deskripsi']),
                );
				$this->load->view('pustaka/produk/form', $data);
			} else {
                $id_toko     = $this->input->post('id_toko', true);
                $nama_produk = $this->input->post('nama_produk', true);
                $id_kategori = $this->input->post('id_kategori', true);
                $harga_jual  = $this->input->post('harga_jual', true);
                $harga_beli  = $this->input->post('harga_beli', true);
                $stok 		 = $this->input->post('stok', true);
                $id_merek 	 = $this->input->post('id_merek', true);
                $deskripsi 	 = $this->input->post('deskripsi', true);
				$data = [
                    'id_toko'     => $id_toko,
                    'nama_produk' => $nama_produk,
                    'id_kategori' => $id_kategori,
                    'harga_jual'  => $harga_jual,
                    'harga_beli'  => $harga_beli,
                    'stok'        => $stok,
                    'id_merek'    => $id_merek,
                    'deskripsi'   => $deskripsi,
				];
				$where = array('id' => $row['id']);
				if ($this->Main_model->update_data($where, $data, 'produk')) {
					redirect('produk', 'refresh');
				} else {
					redirect('salah', 'refresh');
				}
       		}
        } else {
			redirect('produk', 'refresh');
		}
	}

    public function hapus($id)
    {
        $where = array('id' => $id);
        $data = ['dihapus_pada' => date('Y-m-d H:i:s')];
		if ($this->Main_model->update_data($where, $data, 'produk')) {
			redirect('produk', 'refresh');
		}
    }

	public function export($id) {
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();

        $where = ['toko.id_akun' => $this->session->userdata('id')];
		$numrow = 2;
		$toko = $this->Main_model->getwhere("toko", $where)->row();

        switch ($id) {
            case 'semua_toko':
                $data_produk = $this->Main_model->read_join_one('toko', 'produk', 'id', 'id_toko', $where, 'produk.id', 'ASC')->result();

                $sheet->setCellValue("A1", "ID Produk");
                $sheet->setCellValue("B1", "Toko");
                $sheet->setCellValue("C1", "Kategori");
                $sheet->setCellValue("D1", "Nama Produk");
                $sheet->setCellValue("E1", "Nama Merek");
                $sheet->setCellValue("F1", "Stok");
                $sheet->setCellValue("G1", "Harga");

                foreach($data_produk as $data){
                    $sheet->setCellValue('A'.$numrow, $data->id);
                    $sheet->setCellValue('B'.$numrow, Toko($data->id_toko, 'nama_toko'));
                    $sheet->setCellValue('C'.$numrow, Kategori($data->id_kategori, 'nama_kategori'));
                    $sheet->setCellValue('D'.$numrow, $data->nama_produk);
                    $sheet->setCellValue('E'.$numrow, Merek($data->id_merek, 'nama_merek'));
                    $sheet->setCellValue('F'.$numrow, $data->stok);
                    $sheet->setCellValue('G'.$numrow, $data->harga_jual);

                    $numrow++;
                }

		        $sheet->setTitle("Produk - ".Akun($this->session->userdata('id'), 'nama_bisnis'));
                header('Content-Disposition: attachment; filename="Produk - '.Akun($this->session->userdata('id'), 'nama_bisnis').'.csv"');
                break;
            default:
		        $data_produk = $this->Main_model->getwhere("produk", ["id_toko" => $id, 'dihapus_pada' => NULL])->result();

                $sheet->setCellValue("A1", "ID Produk");
                $sheet->setCellValue("B1", "Kategori");
                $sheet->setCellValue("C1", "Nama Produk");
                $sheet->setCellValue("D1", "Nama Merek");
                $sheet->setCellValue("E1", "Stok");
                $sheet->setCellValue("F1", "Harga");

                foreach($data_produk as $data){
                    $sheet->setCellValue('A'.$numrow, $data->id);
                    $sheet->setCellValue('B'.$numrow, Kategori($data->id_kategori, 'nama_kategori'));
                    $sheet->setCellValue('C'.$numrow, $data->nama_produk);
                    $sheet->setCellValue('D'.$numrow, Merek($data->id_merek, 'nama_merek'));
                    $sheet->setCellValue('E'.$numrow, $data->stok);
                    $sheet->setCellValue('F'.$numrow, $data->harga_jual);
        
                    $numrow++;
                }
                $sheet->setTitle("Produk - ".$toko->nama_toko);
                header('Content-Disposition: attachment; filename="Produk - '.$toko->nama_toko.'.csv"');
                break;
        }


        header('Content-Type: application/vnd.ms-excel');
        header('Content-Type: application/csv');
        header('Cache-Control: max-age=0');

		$writer = new Csv($spreadsheet);
		$writer->save('php://output');
	}
}