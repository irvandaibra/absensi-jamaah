<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Csv;

class transaksi extends CI_Controller {
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
		$this->load->view('laporan/transaksi/index', $data);
	}

    function get_data($id)
    {
        header('Content-Type: application/json');
        $query  = "SELECT toko.nama_toko AS nama_toko, karyawan_slot.nama_depan, karyawan_slot.nama_belakang, transaksi.* FROM transaksi
                   JOIN shift ON transaksi.id_shift = shift.id
                   JOIN karyawan_slot ON shift.id_karyawan_slot = karyawan_slot.id
				   JOIN toko  ON karyawan_slot.id_toko = toko.id";
        $search = array('transaksi.nomor_struk');
        switch ($id) {
            case 'semua_toko':
                $where = '';
                break;
            default:
                $where = array('karyawan_slot.id_toko' => $id);
                break;
        }
        $isWhere = 'transaksi.dihapus_pada IS NULL';

        echo $this->Main_model->get_tables_query($query,$search,$where,$isWhere);
    }

	function get_data_toko($id)
	{
        if ($id = 'semua_toko') {
            $where = ['toko.id_akun' => $this->session->userdata('id')];
            $data = $this->Main_model->get_join_three('transaksi', 'shift', 'karyawan_slot', 'toko', 'id', 'id_shift', 'id_karyawan_slot', 'id_toko', $where)->result();
        } else {
            $data = $this->Main_model->getwhere('transaksi', array('id_toko' => $id, 'dihapus_pada' => NULL))->result();
        }
        echo json_encode($data);
    }

	function get_jumlahtrans($id)
	{
        switch ($id) {
            case 'semua_toko':
				$where = ['toko.id_akun' => $this->session->userdata('id')];
				$data = $this->Main_model->get_join_three('transaksi', 'shift', 'karyawan_slot', 'toko', 'id', 'id_shift', 'id_karyawan_slot', 'id_toko', $where)->num_rows();
                break;
            default:
				$where = ['toko.id' => $id];
				$data = $this->Main_model->get_join_three('transaksi', 'shift', 'karyawan_slot', 'toko', 'id', 'id_shift', 'id_karyawan_slot', 'id_toko', $where)->num_rows();
                break;
        }
        echo json_encode($data);
    }

	public function detail($id)
	{
		$where = ['nomor_struk' => $id];
		$data['detail_trans'] = $this->Main_model->getwhere('transaksi', $where)->row_array();
		$detail_trans = $this->Main_model->getwhere('transaksi', $where)->row();
		$data['detail'] = $this->Main_model->getwhere('transaksi_item', $where)->result();
		$data['logo_toko'] = Toko_ByShift($detail_trans->id_shift, 'logo');
		$this->load->view('laporan/transaksi/detail', $data);
	}

	public function export_transaksi($id) {
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();

		$sheet->setCellValue('A1', 'Toko');
		$sheet->setCellValue('B1', 'Nomor Struk');
		$sheet->setCellValue('C1', 'Tanggal');
		$sheet->setCellValue('D1', 'Waktu');
		$sheet->setCellValue('E1', 'Kategori');
		$sheet->setCellValue('F1', 'Merek');
		$sheet->setCellValue('G1', 'Produk');
		$sheet->setCellValue('H1', 'Jumlah');
		$sheet->setCellValue('I1', 'Harga');
		$sheet->setCellValue('J1', 'Diskon');
		$sheet->setCellValue('K1', 'Pengembalian');
		$sheet->setCellValue('L1', 'Metode Pembayaran');
		$sheet->setCellValue('M1', 'Dilayani Oleh');

		$toko  = $this->Main_model->getwhere("toko", ['id_akun' => $this->session->userdata('id')])->row();

        switch ($id) {
            case 'semua_toko':
        		header('Content-Disposition: attachment; filename="Transaksi - '.Akun($this->session->userdata('id'), 'nama_bisnis').'.csv"');
				$sheet->setTitle("Transaksi - ".Akun($this->session->userdata('id'), 'nama_bisnis'));
				$where = ['toko.id_akun' => $this->session->userdata('id')];
				$data = $this->Main_model->get_join_three('transaksi', 'shift', 'karyawan_slot', 'toko', 'id', 'id_shift', 'id_karyawan_slot', 'id_toko', $where)->result();
				break;
			default:
				header('Content-Disposition: attachment; filename="Transaksi - '.$toko->nama_toko.'.csv"');
				$sheet->setTitle("Transaksi - ".$toko->nama_toko);
				$where = ['karyawan_slot.id_toko' => $id];
				$data = $this->Main_model->get_join_two('transaksi', 'id_shift', 'karyawan_slot', 'id', 'id_shift', 'id_karyawan_slot', $where)->result();
				break;
		}

		$numrow = 2;
		foreach($data as $data){
			$sheet->setCellValue('A'.$numrow, $toko->nama_toko);
			$sheet->setCellValue('B'.$numrow, $data->nomor_struk);
			$sheet->setCellValue('C'.$numrow, ChangeDateFormat('d-m-Y',$data->waktu));
			$sheet->setCellValue('D'.$numrow, ChangeDateFormat('H:i:s',$data->waktu));
			$sheet->setCellValue('E'.$numrow, Kategori_ByStruk($data->nomor_struk, 'nama_kategori'));
			$sheet->setCellValue('F'.$numrow, Merek_ByStruk($data->nomor_struk, 'nama_merek'));
			$sheet->setCellValue('G'.$numrow, Produk_ByStruk($data->nomor_struk, 'nama_produk'));
			$sheet->setCellValue('H'.$numrow, $data->jumlah);
			$sheet->setCellValue('I'.$numrow, $data->subtotal);
			$sheet->setCellValue('J'.$numrow, Diskon($data->id_diskon, 'nama_diskon'));
			$sheet->setCellValue('K'.$numrow, $data->pengembalian);
			$sheet->setCellValue('L'.$numrow, Metode($data->id_metode_pembayaran, 'nama_pembayaran'));
			$sheet->setCellValue('M'.$numrow, $data->nama_depan.' '.$data->nama_belakang);

			$numrow++;
		}

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Type: application/csv');
        header('Cache-Control: max-age=0');

		$writer = new Csv($spreadsheet);
		$writer->save('php://output');
	}

	public function export_detail_item($id) {
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();

		$sheet->setCellValue('A1', 'Toko');
		$sheet->setCellValue('B1', 'Nomor Struk');
		$sheet->setCellValue('C1', 'Tanggal');
		$sheet->setCellValue('D1', 'Waktu');
		$sheet->setCellValue('E1', 'Kategori');
		$sheet->setCellValue('F1', 'Merek');
		$sheet->setCellValue('G1', 'Produk');
		$sheet->setCellValue('H1', 'Jumlah');
		$sheet->setCellValue('I1', 'Harga');

		$toko  = $this->Main_model->getwhere("toko", ['id_akun' => $this->session->userdata('id')])->row();

        switch ($id) {
            case 'semua_toko':
        		header('Content-Disposition: attachment; filename="Detail Item - '.Akun($this->session->userdata('id'), 'nama_bisnis').'.csv"');
				$sheet->setTitle("Detail Item - ".Akun($this->session->userdata('id'), 'nama_bisnis'));
				$where = ['toko.id_akun' => $this->session->userdata('id')];
				$data = $this->Main_model->get_join_three('transaksi_item', 'shift', 'karyawan_slot', 'toko', 'id', 'id_shift', 'id_karyawan_slot', 'id_toko', $where)->result();
				break;
			default:
				header('Content-Disposition: attachment; filename="Detail Item - '.$toko->nama_toko.'.csv"');
				$sheet->setTitle("Detail Item - ".$toko->nama_toko);
				$where = ['toko.id' => $id];
				$data = $this->Main_model->get_join_three('transaksi_item', 'shift', 'karyawan_slot', 'toko', 'id', 'id_shift', 'id_karyawan_slot', 'id_toko', $where)->result();
				break;
		}

		$numrow = 2;
		foreach($data as $data){
			$sheet->setCellValue('A'.$numrow, $toko->nama_toko);
			$sheet->setCellValue('B'.$numrow, $data->nomor_struk);
			$sheet->setCellValue('C'.$numrow, ChangeDateFormat('d-m-Y',$data->dibuat_pada));
			$sheet->setCellValue('D'.$numrow, ChangeDateFormat('H:i:s',$data->dibuat_pada));
			$sheet->setCellValue('E'.$numrow, Kategori_ByStruk($data->nomor_struk, 'nama_kategori'));
			$sheet->setCellValue('F'.$numrow, Merek_ByStruk($data->nomor_struk, 'nama_merek'));
			$sheet->setCellValue('G'.$numrow, Produk_ByStruk($data->nomor_struk, 'nama_produk'));
			$sheet->setCellValue('H'.$numrow, $data->jumlah);
			$sheet->setCellValue('I'.$numrow, IDR($data->harga_peritem));

			$numrow++;
		}

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Type: application/csv');
        header('Cache-Control: max-age=0');

		$writer = new Csv($spreadsheet);
		$writer->save('php://output');
	}
}