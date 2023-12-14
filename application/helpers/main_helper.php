<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
    function Akun($id, $column) {
        $ci =& get_instance();
        $ci->load->database();
        $result = $ci->db->where('id',$id)->get('akun');
        foreach ($result->result() as $c) {
            $stmt= $c->$column;
        return $stmt;
        }
    }

    function Kegiatan_ByAbsensi($id, $column) {
        $ci =& get_instance();
        $ci->load->database();
        $smth = '';
        $result = $ci->db->select('*')
                        ->from('absensi')
                        ->join('daftar_kegiatan', 'absensi.kegiatan_id = absensi.id')
                        ->where('absensi.id',$id)
                        ->get();
        $c = $result->row();
        $stmt= $c->$column;
        $smth= $smth.$stmt;
        return $smth;
    }

    function ChangeDateFormat($format = "Y-m-d", $givenDate=null)
    {
        return date($format, strtotime($givenDate));
    }

	function IDR($nominal) {
        return 'Rp ' . number_format($nominal, 0, ',', '.');
	}

    function chained($id, $table) {
        $ci =& get_instance();
        $ci->load->database();
        $result = $ci->db->where('id',$id)->get($table);
        foreach ($result->result() as $c) {
            $stmt= $c->name;
        return $stmt;
        }
    }