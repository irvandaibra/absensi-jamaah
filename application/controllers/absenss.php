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
		$this->load->helper(['url', 'form', 'html', 'main_helper']);
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

		$query = "SELECT DISTINCT absensi.tanggal_kegiatan, daftar_kegiatan.nama_kegiatan FROM absensi
				  JOIN daftar_kegiatan ON absensi.kegiatan_id = daftar_kegiatan.id";
        $search = array('tanggal_kegiatan');
		$where = array('');
        $isWhere = NULL;

        echo $this->Main_model->get_tables_query($query,$search,$where,$isWhere);
    }

	public function input_absensi() {

		$daftar_kegiatan = $this->Main_model->get('daftar_kegiatan')->result();

		$options = array();
		foreach ($daftar_kegiatan as $kegiatan) {
			$options[$kegiatan->id] = $kegiatan->nama_kegiatan;
		}
		
		$kegiatan_id_select = form_dropdown('kegiatan_id', $options, $this->input->post('kegiatan_id'), 'class="form-control select2" id="kegiatan_id"');

		$this->load->view('absensi/input', compact('kegiatan_id_select'));
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
			$kegiatan_id = $this->input->post('kegiatan_id');
			$tanggal_kegiatan =  $this->input->post('tanggal_kegiatan');
			$penerobos =  $this->input->post('penerobos');

			$data=array();
			for ($i=1; $i < $sheetcount; $i++) {
        $nama_lengkap = $sheetdata[$i][1];
        $hadir = $sheetdata[$i][2];
        $izin = $sheetdata[$i][3];
        $alpha = $sheetdata[$i][4];

        $alfa = 3;
        $kehadiran = ($hadir !== null && $hadir !== '') ? $hadir : (($izin !== null && $izin !== '') ? $izin : null);

        if ($kehadiran === null && ($alpha !== null && $alpha !== '')) {
            $kehadiran = $alpha;
        }

        if ($kehadiran === null) {
            $kehadiran = $alfa;
			
        }
				$id_abs = 1;
				$jamaah_id = $this->Main_model->get_jamaah_id_by_nama_lengkap($nama_lengkap);
				if($jamaah_id) {
					$data[]=array(
						'tanggal_kegiatan'=>$tanggal_kegiatan,
						'id_daftar_absens' =>$id_abs,	
						'penerobos'=>$penerobos,
						'kegiatan_id'=>$kegiatan_id,
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

	public function detail_absens($tgl) {
		$absen = $this->Main_model->getwhere('absensi', ['tanggal_kegiatan' => $tgl])->row()->kegiatan_id;
		if(empty($absen)) {
			redirect('absenss');
		} else {
			$data['data'] = Kegiatan_ByAbsensi($absen, "nama_kegiatan");
			$this->load->view('absensi/detail_data', $data);
		}
	}

    function get_detail_data($tgl)
    {
        header('Content-Type: application/json');

		$query = "SELECT data_jamaah.nama_lengkap AS nama, absensi.* FROM absensi
				 JOIN data_jamaah ON absensi.jamaah_id = data_jamaah.id";
        $search = array('kehadiran', 'nama_lengkap');
		$where = array('tanggal_kegiatan' => $tgl);
        $isWhere = null;

        echo $this->Main_model->get_tables_query($query,$search,$where,$isWhere);
    }

	public function print() {
		$data['abesens'] = $this->Main_model->get('daftar_absens')->result();
		$this->load->view('laporan_data', $data);
	}

}