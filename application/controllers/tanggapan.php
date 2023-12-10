<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class tanggapan extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
		$this->load->model('Main_model');
		date_default_timezone_set('Asia/Jakarta');
		$this->load->helper(['url', 'form', 'html']);
		$this->load->library(['session', 'form_validation']);
    }

	public function index()
	{
        $this->load->view('tanggapan/index');
    }

    function get_data()
    {
        header('Content-Type: application/json');
        $tables = "saran_tanggapan";
        $search = array('code_user');
		$isWhere = null;
		echo $this->Main_model->get_tables($tables,$search,$isWhere);
    }

    public function respon($id){
	{
        $data['page'] = 'Ubah';
		$where = ['id' => $id];
		$row   = $this->Main_model->getwhere('saran_tanggapan', $where)->row_array();

        if (isset($row['id'])) {
			$this->form_validation->set_rules('tanggapan', 'tanggapan', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				$data['row'] = $row;

                $data['tanggapan'] = array(
                    'name'  => 'tanggapan',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('tanggapan', $row['tanggapan']),
                );
				$this->load->view('tanggapan/form', $data);
			} else {
                $tanggapan = $this->input->post('tanggapan', true);
                $data = [
                    'tanggapan' => $tanggapan,
                ];

				$where = array('id' => $row['id']);
				if ($this->Main_model->update_data($where, $data, 'saran_tanggapan')) {
					redirect('tanggapan', 'refresh');
				} else {
					redirect('', 'refresh');
				}
       		}
        } else {
			redirect('tanggapan', 'refresh');
		}
    }
    }
}