<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Csv;

class slot_karyawan extends CI_Controller {
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
        $data['akses_karyawan'] = $this->Main_model->get('karyawan_akses')->result();
		$data['karyawan'] = $this->Main_model->get('karyawan_slot')->result();
		$this->load->view('karyawan/slot_karyawan/index', $data);
	}

	function get_data($id)
    {
        header('Content-Type: application/json');
        $query   = "SELECT karyawan_akses.nama_role AS nama_role, karyawan_slot.* FROM karyawan_slot
                   JOIN karyawan_akses ON karyawan_slot.id_karyawan_akses = karyawan_akses.id";
        $search  = array('nama_depan','nama_belakang','nomor_telepon');
		$where   = array('karyawan_slot.id_toko' => $id);
		$isWhere = 'karyawan_slot.dihapus_pada is NULL';

        echo $this->Main_model->get_tables_query($query,$search,$where,$isWhere);
    }

	public function tambah()
	{
		$data['page'] = 'Tambah';
        $this->form_validation->set_rules('id_toko', 'Toko', 'trim|required');
        $this->form_validation->set_rules('nama_depan', 'Nama depan', 'trim|required');
        $this->form_validation->set_rules('nama_belakang', 'Nama belakang', 'trim|required');
        $this->form_validation->set_rules('email', 'email', 'trim|required');
        $this->form_validation->set_rules('nomor_telepon', 'nomor telepon', 'trim|required');
        $this->form_validation->set_rules('id_karyawan_akses', 'akses karyawan', 'trim|required');
        $this->form_validation->set_rules('deskripsi', 'deskripsi', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $data['toko'] = $this->Main_model->get('toko')->result();
            $data['akses_karyawan'] = $this->Main_model->get('karyawan_akses')->result();
            $data['nama_depan'] = array(
                'name'  => 'nama_depan',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('nama_depan'),
            );
            $data['nama_belakang'] = array(
                'name'  => 'nama_belakang',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('nama_belakang'),
            );
            $data['email'] = array(
                'name'  => 'email',
                'type'  => 'email',
                'value' => $this->form_validation->set_value('email'),
            );
            $data['nomor_telepon'] = array(
                'name'  => 'nomor_telepon',
                'type'  => 'number',
                'value' => $this->form_validation->set_value('nomor_telepon'),
            );
            $data['id_karyawan_akses'] = array(
                'name'  => 'id_karyawan_akses',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('id_karyawan_akses'),
            );
            $data['id_toko'] = array(
                'name'  => 'id_toko',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('id_toko'),
            );
            $data['deskripsi'] = array(
                'name'  => 'deskripsi',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('deskripsi'),
            );
			$this->load->view('karyawan/slot_karyawan/form', $data);

        } else {
            $nama_depan = $this->input->post('nama_depan', true);
            $nama_belakang = $this->input->post('nama_belakang', true);
            $email = $this->input->post('email', true);
            $nomor_telepon = $this->input->post('nomor_telepon', true);
            $id_toko = $this->input->post('id_toko', true);
            $id_karyawan_akses = $this->input->post('id_karyawan_akses', true);
            $deskripsi = $this->input->post('deskripsi', true);
            $data = [
                'nama_depan' => $nama_depan,
                'nama_belakang' => $nama_belakang,
                'email' => $email,
                'nomor_telepon' => $nomor_telepon,
                'id_toko' => $id_toko,
                'id_karyawan_akses' => $id_karyawan_akses,
                'deskripsi' => $deskripsi,
            ];
			if ($this->Main_model->insert_data($data, 'karyawan_slot')) {
				redirect('slot_karyawan', 'refresh');
			} else {
				redirect('salah', 'refresh');
			}
        }
	}

    public function ubah($id)
	{
		$data['page'] = 'Ubah';
		$where = ['id' => $id];
		$row   = $this->Main_model->getwhere('karyawan_slot', $where)->row_array();

        if (isset($row['id'])) {
			$this->form_validation->set_rules('nama_depan', 'Nama depan', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				$data['row'] = $row;
                $data['toko'] = $this->Main_model->get('toko')->result();
                $data['akses_karyawan'] = $this->Main_model->get('karyawan_akses')->result();
    
                $data['id_toko'] = array(
                    'name'  => 'id_toko',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('id_toko', $row['id_toko']),
                );
                $data['email'] = array(
                    'name'  => 'email',
                    'type'  => 'email',
                    'value' => $this->form_validation->set_value('email', $row['email']),
                );
                $data['nomor_telepon'] = array(
                    'name'  => 'nomor_telepon',
                    'type'  => 'number',
                    'value' => $this->form_validation->set_value('nomor_telepon', $row['nomor_telepon']),
                );
                $data['nama_depan'] = array(
                    'name'  => 'nama_depan',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('nama_depan', $row['nama_depan']),
                );
                $data['nama_belakang'] = array(
                    'name'  => 'nama_belakang',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('nama_belakang', $row['nama_belakang']),
                );
                $data['id_karyawan_akses'] = array(
                    'name'  => 'id_karyawan_akses',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('id_karyawan_akses', $row['id_karyawan_akses']),
                );
                $data['deskripsi'] = array(
                    'name'  => 'deskripsi',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('deskripsi', $row['deskripsi']),
                );
				$this->load->view('karyawan/slot_karyawan/form', $data);
			} else {
                $nama_depan = $this->input->post('nama_depan', true);
                $nama_belakang = $this->input->post('nama_belakang', true);
                $email = $this->input->post('email', true);
               
                $nomor_telepon = $this->input->post('nomor_telepon', true);
                $id_toko = $this->input->post('id_toko', true);
                $id_karyawan_akses = $this->input->post('id_karyawan_akses', true);
                $deskripsi = $this->input->post('deskripsi', true);
                $data = [
                    'nama_depan' => $nama_depan,
                    'nama_belakang' => $nama_belakang,
                    'email' => $email,
                    'nomor_telepon' => $nomor_telepon,
                    'id_toko' => $id_toko,
                    'id_karyawan_akses' => $id_karyawan_akses,
                    'deskripsi' => $deskripsi,
                ];
				$where = array('id' => $row['id']);
				if ($this->Main_model->update_data($where, $data, 'karyawan_slot')) {
					redirect('slot_karyawan', 'refresh');
				} else {
					redirect('salah', 'refresh');
				}
       		}
        } else {
			redirect('slot_karyawan', 'refresh');
		}
	}

    public function hapus($id)
    {
        $where = array('id' => $id);
        $data = ['dihapus_pada' => date('Y-m-d H:i:s')];
		if ($this->Main_model->update_data($where, $data, 'karyawan_slot')) {
			redirect('slot_karyawan', 'refresh');
		}
    }

	public function export() {
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();

		$sheet->setCellValue("A1", "Nama Depan");
		$sheet->setCellValue("B1", "Nama Belakang");
		$sheet->setCellValue("C1", "Role");
		$sheet->setCellValue("D1", "Email");
		$sheet->setCellValue("E1", "No Telepon");
		$sheet->setCellValue("F1", "Toko");
		$sheet->setCellValue("G1", "Status");

        $where = ['toko.id_akun' => $this->session->userdata('id')];
		$karyawan = $this->Main_model->get_join_two('akun', 'toko', 'karyawan_slot', 'id', 'id_akun', 'id_toko', $where)->result();

		$numrow = 2;
		foreach($karyawan as $data){
			$sheet->setCellValue('A'.$numrow, $data->nama_depan);
			$sheet->setCellValue('B'.$numrow, $data->nama_belakang);
			$sheet->setCellValue('C'.$numrow, Akses_Karyawan($data->id_karyawan_akses, 'nama_role'));
			$sheet->setCellValue('D'.$numrow, $data->email);
			$sheet->setCellValue('E'.$numrow, $data->nomor_telepon);
			$sheet->setCellValue('F'.$numrow, Toko($data->id_toko, 'nama_toko'));
			$sheet->setCellValue('G'.$numrow, $data->status);

			$numrow++;
		}

		$sheet->setTitle("Karyawan - ".Akun($this->session->userdata('id'), 'nama_pengguna'));

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Type: application/csv');
        header('Content-Disposition: attachment; filename="Karyawan - '.Akun($this->session->userdata('id'), 'nama_pengguna').'.csv"');
        header('Cache-Control: max-age=0');

		$writer = new Csv($spreadsheet);
		$writer->save('php://output');
	}
    
}