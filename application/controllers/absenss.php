<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require FCPATH.'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class absenss extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
		$this->load->model('Main_model');
		date_default_timezone_set('Asia/Jakarta');
		$this->load->helper(['url', 'form', 'html']);
		$this->load->library(['session', 'form_validation']);
		if ($this->session->userdata('logged_in') === NULL) {
            redirect(base_url());
		}
    }

    public function index()
    {
		$data['data'] = $this->Main_model->get('absensi')->result();
		$this->load->view('absensi/index', $data);
    }

    function get_data()
    {
        header('Content-Type: application/json');
        $tables = "absensi";
        $search = array('kegiatan_id');
		$isWhere = null;
		echo $this->Main_model->get_tables($tables,$search,$isWhere);
    }

    public function spreadhseet_format_download()
	{
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="format_absens.xlsx"');
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setCellValue('A1', 'No');
		$sheet->setCellValue('B1', 'Nama Jamaah');
		$sheet->setCellValue('C1', 'Hadir');
		$sheet->setCellValue('D1', 'Izin');
		$sheet->setCellValue('E1', 'Alpha');
		// $sheet->setCellValue('E1', 'Keterangan');

    $data['data'] = $this->Main_model->get('data_jamaah')->result(); 
    $jamaahData = $data['data'];

    $rowNum = 2;

    foreach ($jamaahData as $jamaah) {
        $sheet->setCellValue('A' . $rowNum, $jamaah->id);
        $sheet->setCellValue('B' . $rowNum, $jamaah->nama_lengkap);
        $sheet->setCellValue('C' . $rowNum, ''); // Replace with actual hadir status
        $sheet->setCellValue('D' . $rowNum, ''); // Replace with actual ijin status
        $sheet->setCellValue('E' . $rowNum, ''); // Replace with actual alpha status
        // $sheet->setCellValue('F' . $rowNum, ''); // Replace with additional keterangan

        $rowNum++;
    }

		$writer = new Xlsx($spreadsheet);
		$writer->save("php://output");
	}

  public function spreadsheet_import()
	{
		$upload_file=$_FILES['upload_file']['name'];
		$extension=pathinfo($upload_file,PATHINFO_EXTENSION);
		if($extension=='csv')
		{
			$reader= new \PhpOffice\PhpSpreadsheet\Reader\Csv();
		} else if($extension=='xls')
		{
			$reader= new \PhpOffice\PhpSpreadsheet\Reader\Xls();
		} else
		{
			$reader= new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		}
		$spreadsheet=$reader->load($_FILES['upload_file']['tmp_name']);
		$sheetdata=$spreadsheet->getActiveSheet()->toArray();
		$sheetcount=count($sheetdata);
		if($sheetcount>1)
		{
			$data=array();
			for ($i=1; $i < $sheetcount; $i++) {
        $nama_lengkap = $sheetdata[$i][1];
        $hadir = $sheetdata[$i][2];
        $izin = $sheetdata[$i][3];
        $alpha = $sheetdata[$i][4];

        $alfa = 3;
        $kehadiran = ($hadir !== null && $hadir !== '') ? $hadir : (($izin !== null && $izin !== '') ? $izin : null);

        // Jika kehadiran kosong atau null, gunakan nilai alpha sebagai kehadiran
        if ($kehadiran === null && ($alpha !== null && $alpha !== '')) {
            $kehadiran = $alpha;
        }

        // Jika kehadiran masih kosong atau null, gunakan nilai dari variabel alfa
        if ($kehadiran === null) {
            $kehadiran = $alfa;
        }


				// Get jamaah ID from nama lengkap
				$jamaah_id = $this->Main_model->get_jamaah_id_by_nama_lengkap($nama_lengkap);
				
				// If jamaah ID is not null
				if($jamaah_id) {
					// Add data to array
					$data[]=array(
            'jamaah_id'=>$jamaah_id,
						'kehadiran'=>$kehadiran,
					);
				}
			
			}
			$inserdata=$this->Main_model->import_absens($data);
			if($inserdata)
			{
				$this->session->set_flashdata('message','<div class="alert alert-success">Successfully Added.</div>');
				redirect('absenss');
			} else {
				$this->session->set_flashdata('message','<div class="alert alert-danger">Data Not uploaded. Please Try Again.</div>');
				redirect('absenss');
			}
		}
	}

}