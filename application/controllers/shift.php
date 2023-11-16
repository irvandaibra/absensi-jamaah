<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Csv;

class shift extends CI_Controller {
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
		$this->load->view('laporan/shift/index', $data);
	}

	function get_data($id)
    {
        header('Content-Type: application/json');
        $query   = "SELECT karyawan_slot.*, shift.* FROM shift
                   JOIN karyawan_slot ON shift.id_karyawan_slot = karyawan_slot.id";
        $search  = array('jam_mulai','jam_akhir');
		$where   = array('karyawan_slot.id_toko' => $id);
		$isWhere = 'shift.dihapus_pada is NULL';

        echo $this->Main_model->get_tables_query($query,$search,$where,$isWhere);
    }

	function get_data_toko($id)
	{
        $data = $this->Main_model->getwhere('toko', array('id' => $id, 'dihapus_pada' => NULL))->result();
        echo json_encode($data);
    }

	public function detail($id)
	{
		$data['shift'] = $this->Main_model->getwhere('shift', ['id' => $id])->row_array	();
		$this->load->view('laporan/shift/detail', $data);
	}

	public function export($id_toko) {
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();

		$sheet->setCellValue('A1', 'Nama');
		$sheet->setCellValue('B1', 'Jam Mulai');
		$sheet->setCellValue('C1', 'Jam Akhir');
		$sheet->setCellValue('D1', 'Total Diharapkan');
		$sheet->setCellValue('E1', 'Total Didapat');
		$sheet->setCellValue('F1', 'Perbedaan');

		$where = ["id_toko" => $id_toko];
		$data = $this->Main_model->get_join_one('karyawan_slot', 'shift', 'id', 'id_karyawan_slot', $where)->result();
		$toko = $this->Main_model->getwhere("toko", ["id" => $id_toko])->row();

		$numrow = 2;
		foreach($data as $data){
			$sheet->setCellValue('A'.$numrow, $data->nama_depan.' '.$data->nama_belakang);
			$sheet->setCellValue('B'.$numrow, $data->jam_mulai);
			$sheet->setCellValue('C'.$numrow, $data->jam_akhir);
			$sheet->setCellValue('D'.$numrow, $data->total_diharapkan);
			$sheet->setCellValue('E'.$numrow, $data->total_didapat);
			$sheet->setCellValue('F'.$numrow, $data->IDR($data->total_diharapkan - $data->total_didapat));

			$numrow++;
		}

		$sheet->setTitle("Shift - ".$toko->nama_toko);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Type: application/csv');
        header('Content-Disposition: attachment; filename="Shift - '.$toko->nama_toko.'.csv"');
        header('Cache-Control: max-age=0');

		$writer = new Csv($spreadsheet);
		$writer->save('php://output');
	}
}