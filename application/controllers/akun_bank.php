<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class akun_bank extends CI_Controller {
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
		$this->load->view('setting/akun_bank/index', $data);
	}
	
	function get_data()
	{
		header('Content-Type: application/json');
		$tables  = 'bank';
		$search  = array('nama_bank', 'nomor_akun', 'pemegang_akun');
		$where   = array('id_akun' => $this->session->userdata('id'));
		$isWhere = 'bank.dihapus_pada IS NULL';

		echo $this->Main_model->get_tables_where($tables,$search,$where,$isWhere);
	}

	public function tambah()
	{
        $data['page'] = 'Tambah';
		$data['bank'] = array(
			"Bank Central Asia (BCA)",
			"Bank Mandiri",
			"Bank Rakyat Indonesia (BRI)",
			"Bank Negara Indonesia (BNI)",
			"Bank CIMB Niaga",
			"Bank Danamon",
			"Bank Tabungan Negara (BTN)",
			"Bank Permata",
			"Bank OCBC NISP",
			"Bank Panin",
			"Bank Maybank Indonesia",
			"Bank Mega",
			"Bank HSBC Indonesia",
			"Bank Bukopin",
			"Bank UOB Indonesia",
			"Bank Jatim",
			"Bank DKI",
			"Bank Sumut",
			"Bank BRI Syariah",
			"Bank BNI Syariah",
			"Bank Muamalat",
			"Bank Mandiri Syariah",
			"Bank Mega Syariah",
			"Bank BCA Syariah",
			"Bank Victoria Internasional",
			"Bank QNB Indonesia",
			"Bank Mestika",
			"Bank Sinarmas",
			"Bank Woori Saudara",
			"Bank Ganesha",
			"Bank MNC Internasional",
			"Bank Maspion Indonesia",
			"Bank Jateng",
			"Bank Jambi",
			"Bank Kalbar",
			"Bank Kaltimtara",
			"Bank Kalteng",
			"Bank Kalsel",
			"Bank Kalteng",
			"Bank Sumselbabel",
			"Bank Lampung",
			"Bank Sulselbar",
			"Bank Sulteng",
			"Bank Sulut",
			"Bank NTB",
			"Bank Bali",
			"Bank Riau Kepri",
			"Bank Papua",
			"Bank BPD DIY",
			"Bank Aceh",
			"Bank Nagari",
			"Bank Sumsel",
			"Bank Banten",
			"Bank DKI Syariah",
			"Bank BJB",
			"Bank Kaltim",
			"Bank Kalsel",
			"Bank Kaltara",
			"Bank BPD Kalsel",
			"Bank BPD Kaltim",
			"Bank BPD Kaltara",
			"Bank BPD Sumsel",
			"Bank BPD Lampung",
			"Bank BPD Sulsel",
			"Bank BPD Sulteng",
			"Bank BPD Sulut",
			"Bank BPD NTB",
			"Bank BPD Bali",
			"Bank BPD Riau Kepri",
			"Bank BPD Papua",
			"Bank BPD Aceh",
			"Bank BPD Nagari",
			"Bank BPD Jambi",
			"Bank BPD Jatim",
			"Bank BPD Jateng",
			"Bank BPD DKI",
			"Bank BPD Sumut",
			"Bank BPD NTT",
			"Bank BPD Bengkulu",
			"Bank BPD Kalbar",
			"Bank BPD Kepri",
			"Bank BPD Malut",
			"Bank BPD Maluku",
			"Bank BPD Gorontalo",
			"Bank BPD Sulbar",
			"Bank BPD Sulteng",
			"Bank BPD Sultra",
			"Bank BPD Lampung",
			"Bank BPD Banten",
			"Bank BPD Riau",
			"Bank BPD Sulawesi Tenggara",
			"Bank BPD NTT",
			"Bank BPD Bengkulu",
			"Bank BPD Kalbar",
			"Bank BPD Kepri"
		);
        $this->form_validation->set_rules('id_toko', 'Toko', 'trim|required');
        $this->form_validation->set_rules('nama_bank', 'Nama Bank', 'trim|required');
        $this->form_validation->set_rules('nomor_akun', 'Nomor Akun', 'trim|required');
		
        if ($this->form_validation->run() == FALSE) {
            $data['toko'] = $this->Main_model->get_toko()->result();

            $data['id_toko'] = array(
                'name'  => 'id_toko',
                'value' => $this->form_validation->set_value('id_toko'),
            );
            $data['nama_bank'] = array(
                'id'    => 'nama_bank',
                'name'  => 'nama_bank',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('nama_bank'),
            );
            $data['nomor_akun'] = array(
                'id'    => 'nomor_akun',
                'name'  => 'nomor_akun',
                'type'  => 'number',
                'value' => $this->form_validation->set_value('nomor_akun'),
            );
            $data['pemegang_akun'] = array(
                'id'    => 'pemegang_akun',
                'name'  => 'pemegang_akun',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('pemegang_akun'),
            );
			$this->load->view('setting/akun_bank/form', $data);
        } else {
			$id_bank 	   = $this->unique_id(8);
            $id_toko 	   = $this->input->post('id_toko', true);
            $nama_bank	   = $this->input->post('nama_bank', true);
            $nomor_akun    = $this->input->post('nomor_akun', true);
            $pemegang_akun = $this->input->post('pemegang_akun', true);
            $id_akun 	   = $this->session->userdata('id');
            $data = [
				'id' 			=> $id_bank,
				'id_toko' 		=> $id_toko,
				'nama_bank' 	=> $nama_bank,
				'nomor_akun' 	=> $nomor_akun,
				'pemegang_akun' => $pemegang_akun,
				'id_akun' 		=> $id_akun,
            ];
			$data_aktifitas = [
				'id_akun' 		=> $id_akun,
				'id_bank' 		=> $id_bank,
				'nama_bank' 	=> $nama_bank,
				'nomor_akun' 	=> $nomor_akun,
				'pemegang_akun' => $pemegang_akun,
				'id_toko' 		=> $id_toko,
				'aksi' 			=> 'Menambahkan Bank',
			];
			// foreach ($id_toko as $key => $value) { 
				// $this->db->insert('bank', array(
				// 	'id_toko' 		=> $key,
				// 	'nama_bank' 	=> $nama_bank,
				// 	'nomor_akun' 	=> $nomor_akun,
				// 	'pemegang_akun' => $pemegang_akun,
				// 	'id_akun' 		=> $id_akun,
				// ));
				// $this->Main_model->insert_data(array(
				// 	'id_toko' 		=> $key,
				// 	'nama_bank' 	=> $nama_bank,
				// 	'nomor_akun' 	=> $nomor_akun,
				// 	'pemegang_akun' => $pemegang_akun,
				// 	'id_akun' 		=> $id_akun,
				// ), 'bank');
			// }
			if ($this->Main_model->insert_data($data, 'bank')) {
				$this->Main_model->insert_data($data_aktifitas, 'catatan_aktifitas_bank');
				redirect('akun_bank', 'refresh');
			} else {
				redirect('salah', 'refresh');
			}
        }
	}

	public function ubah($id)
	{
        $data['page'] = 'Ubah';
		$data['bank'] = array(
			"Bank Central Asia (BCA)",
			"Bank Mandiri",
			"Bank Rakyat Indonesia (BRI)",
			"Bank Negara Indonesia (BNI)",
			"Bank CIMB Niaga",
			"Bank Danamon",
			"Bank Tabungan Negara (BTN)",
			"Bank Permata",
			"Bank OCBC NISP",
			"Bank Panin",
			"Bank Maybank Indonesia",
			"Bank Mega",
			"Bank HSBC Indonesia",
			"Bank Bukopin",
			"Bank UOB Indonesia",
			"Bank Jatim",
			"Bank DKI",
			"Bank Sumut",
			"Bank BRI Syariah",
			"Bank BNI Syariah",
			"Bank Muamalat",
			"Bank Mandiri Syariah",
			"Bank Mega Syariah",
			"Bank BCA Syariah",
			"Bank Victoria Internasional",
			"Bank QNB Indonesia",
			"Bank Mestika",
			"Bank Sinarmas",
			"Bank Woori Saudara",
			"Bank Ganesha",
			"Bank MNC Internasional",
			"Bank Maspion Indonesia",
			"Bank Jateng",
			"Bank Jambi",
			"Bank Kalbar",
			"Bank Kaltimtara",
			"Bank Kalteng",
			"Bank Kalsel",
			"Bank Kalteng",
			"Bank Sumselbabel",
			"Bank Lampung",
			"Bank Sulselbar",
			"Bank Sulteng",
			"Bank Sulut",
			"Bank NTB",
			"Bank Bali",
			"Bank Riau Kepri",
			"Bank Papua",
			"Bank BPD DIY",
			"Bank Aceh",
			"Bank Nagari",
			"Bank Sumsel",
			"Bank Banten",
			"Bank DKI Syariah",
			"Bank BJB",
			"Bank Kaltim",
			"Bank Kalsel",
			"Bank Kaltara",
			"Bank BPD Kalsel",
			"Bank BPD Kaltim",
			"Bank BPD Kaltara",
			"Bank BPD Sumsel",
			"Bank BPD Lampung",
			"Bank BPD Sulsel",
			"Bank BPD Sulteng",
			"Bank BPD Sulut",
			"Bank BPD NTB",
			"Bank BPD Bali",
			"Bank BPD Riau Kepri",
			"Bank BPD Papua",
			"Bank BPD Aceh",
			"Bank BPD Nagari",
			"Bank BPD Jambi",
			"Bank BPD Jatim",
			"Bank BPD Jateng",
			"Bank BPD DKI",
			"Bank BPD Sumut",
			"Bank BPD NTT",
			"Bank BPD Bengkulu",
			"Bank BPD Kalbar",
			"Bank BPD Kepri",
			"Bank BPD Malut",
			"Bank BPD Maluku",
			"Bank BPD Gorontalo",
			"Bank BPD Sulbar",
			"Bank BPD Sulteng",
			"Bank BPD Sultra",
			"Bank BPD Lampung",
			"Bank BPD Banten",
			"Bank BPD Riau",
			"Bank BPD Sulawesi Tenggara",
			"Bank BPD NTT",
			"Bank BPD Bengkulu",
			"Bank BPD Kalbar",
			"Bank BPD Kepri"
		);
		$where = ['id' => $id];
		$row   = $this->Main_model->getwhere('bank', $where)->row_array();

        if (isset($row['id'])) {
			$this->form_validation->set_rules('id_toko', 'Toko', 'trim|required');
			$this->form_validation->set_rules('nama_bank', 'Nama Bank', 'trim|required');
			$this->form_validation->set_rules('nomor_akun', 'Nomor Akun', 'trim|required');
			
			if ($this->form_validation->run() == FALSE) {
				$data['row'] = $row;
				$data['toko'] = $this->Main_model->get_toko()->result();
	
				$data['id_toko'] = array(
					'name'  => 'id_toko',
					'value' => $this->form_validation->set_value('id_toko', $row['id_toko']),
				);
				$data['nama_bank'] = array(
					'id'    => 'nama_bank',
					'name'  => 'nama_bank',
					'type'  => 'text',
					'value' => $this->form_validation->set_value('nama_bank', $row['nama_bank']),
				);
				$data['nomor_akun'] = array(
					'id'    => 'nomor_akun',
					'name'  => 'nomor_akun',
					'type'  => 'number',
					'value' => $this->form_validation->set_value('nomor_akun', $row['nomor_akun']),
				);
				$data['pemegang_akun'] = array(
					'id'    => 'pemegang_akun',
					'name'  => 'pemegang_akun',
					'type'  => 'text',
					'value' => $this->form_validation->set_value('pemegang_akun', $row['pemegang_akun']),
				);
				$this->load->view('setting/akun_bank/form', $data);
			} else {
				$id_toko 	   = $this->input->post('id_toko', true);
				$nama_bank	   = $this->input->post('nama_bank', true);
				$nomor_akun    = $this->input->post('nomor_akun', true);
				$pemegang_akun = $this->input->post('pemegang_akun', true);
				$id_akun 	   = $this->session->userdata('id');
				$data = [
					'id_toko' 		=> $id_toko,
					'nama_bank' 	=> $nama_bank,
					'nomor_akun' 	=> $nomor_akun,
					'pemegang_akun' => $pemegang_akun,
				];
				$data_aktifitas = [
					'id_akun' 		=> $id_akun,
					'id_bank' 		=> $row['id'],
					'nama_bank' 	=> $nama_bank,
					'nomor_akun' 	=> $nomor_akun,
					'pemegang_akun' => $pemegang_akun,
					'id_toko' 		=> $id_toko,
					'aksi' 			=> 'Mengubah Bank',
				];
				$where = array('id' => $row['id']);
				if ($this->Main_model->update_data($where, $data, 'bank')) {
					$this->Main_model->insert_data($data_aktifitas, 'catatan_aktifitas_bank');
					redirect('akun_bank', 'refresh');
				} else {
					redirect('salah', 'refresh');
				}
       		}
        } else {
			redirect('bank', 'refresh');
		}
	}

    public function hapus($id)
    {
        $where 	 = array('id' => $id);
		$row 	 = $this->Main_model->getwhere('bank', $where)->row_array();
		$id_toko 	   = $row['id_toko'];
		$nama_bank	   = $row['nama_bank'];
		$nomor_akun    = $row['nomor_akun'];
		$pemegang_akun = $row['pemegang_akun'];
		$id_akun 	   = $this->session->userdata('id');
        $data 	 = ['dihapus_pada' => date('Y-m-d H:i:s')];
		$data_aktifitas = [
			'id_akun' 		=> $id_akun,
			'id_bank' 		=> $id,
			'nama_bank' 	=> $nama_bank,
			'nomor_akun' 	=> $nomor_akun,
			'pemegang_akun' => $pemegang_akun,
			'id_toko' 		=> $id_toko,
			'aksi' 			=> 'Menghapus Bank',
		];
		if ($this->Main_model->update_data($where, $data, 'bank')) {
			$this->Main_model->insert_data($data_aktifitas, 'catatan_aktifitas_bank');
			redirect('akun_bank', 'refresh');
		}
    }

	public function unique_id($unique_id)
	{
		$char = '1234567890987654321';
		$string = '';
		for ($i=0; $i < $unique_id; $i++) {
			$post = rand(0, strlen($char)-1);
			$string .= $char[$post];
		}
		return $string;
	}
}