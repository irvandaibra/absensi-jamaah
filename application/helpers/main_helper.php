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

    function Toko($id, $column) {
        $ci =& get_instance();
        $ci->load->database();
        $result = $ci->db->where('id',$id)->get('toko');
        foreach ($result->result() as $c) {
            $stmt= $c->$column;
        return $stmt;
        }
    }

    function Diskon($id, $column) {
        $ci =& get_instance();
        $ci->load->database();
        $result = $ci->db->where('id',$id)->get('diskon');
        foreach ($result->result() as $c) {
            $stmt= $c->$column;
        return $stmt;
        }
    }

    function Kategori($id, $column) {
        $ci =& get_instance();
        $ci->load->database();
        $result = $ci->db->where('id',$id)->get('kategori');
        foreach ($result->result() as $c) {
            $stmt= $c->$column;
        return $stmt;
        }
    }

    function Merek($id, $column) {
        $ci =& get_instance();
        $ci->load->database();
        $result = $ci->db->where('id',$id)->get('merek');
        foreach ($result->result() as $c) {
            $stmt= $c->$column;
        return $stmt;
        }
    }

    function Produk($id, $column) {
        $ci =& get_instance();
        $ci->load->database();
        $result = $ci->db->where('id',$id)->get('produk');
        foreach ($result->result() as $c) {
            $stmt= $c->$column;
        return $stmt;
        }
    }

    function TrDetail($id, $column) {
        $ci =& get_instance();
        $ci->load->database();
        $result = $ci->db->where('nomor_struk',$id)->get('transaksi_item');
        foreach ($result->result() as $c) {
            $stmt= $c->$column;
        return $stmt;
        }
    }

    function Akses_Karyawan($id, $column) {
        $ci =& get_instance();
        $ci->load->database();
        $result = $ci->db->where('id',$id)->get('karyawan_akses');
        foreach ($result->result() as $c) {
            $stmt= $c->$column;
        return $stmt;
        }
    }

    function Metode($id, $column) {
        $ci =& get_instance();
        $ci->load->database();
        $result = $ci->db->where('id',$id)->get('metode_pembayaran');
        foreach ($result->result() as $c) {
            $stmt= $c->$column;
        return $stmt;
        }
    }

    function Karyawan_ByShift($id, $column) {
        $ci =& get_instance();
        $ci->load->database();
        $smth = '';
        $result = $ci->db->select('*')
                        ->from('shift')
                        ->join('karyawan_slot', 'shift.id_karyawan_slot = karyawan_slot.id')
                        ->where('shift.id',$id)
                        ->get();
        foreach ($result->result() as $c) {
        $stmt= $c->$column;
        $smth= $smth.$stmt;
        }
        return $smth;
    }

    function Toko_ByShift($id, $column) {
        $ci =& get_instance();
        $ci->load->database();
        $smth = '';
        $result = $ci->db->select('*')
                        ->from('shift')
                        ->join('karyawan_slot', 'shift.id_karyawan_slot = karyawan_slot.id')
                        ->join('toko', 'karyawan_slot.id_toko = toko.id')
                        ->where('shift.id',$id)
                        ->get();
        foreach ($result->result() as $c) {
        $stmt= $c->$column;
        $smth= $smth.$stmt.'<br>';
        }
        return $smth;
    }

    function Produk_ByStruk($id, $column) {
        $ci =& get_instance();
        $ci->load->database();
        $result = $ci->db->select('*')
                        ->from('transaksi_item')
                        ->join('produk', 'transaksi_item.id_produk = produk.id')
                        ->where('transaksi_item.nomor_struk',$id)
                        ->get();
        foreach ($result->result() as $c) {
        $smth= $c->$column;
        }
        return $smth;
    }

    function Kategori_ByStruk($id, $column) {
        $ci =& get_instance();
        $ci->load->database();
        $result = $ci->db->select('*')
                        ->from('transaksi')
                        ->join('transaksi_item', 'transaksi.nomor_struk = transaksi_item.nomor_struk')
                        ->join('produk', 'transaksi_item.id_produk = produk.id')
                        ->join('kategori', 'produk.id_kategori = kategori.id')
                        ->where('transaksi.nomor_struk',$id)
                        ->get();
        foreach ($result->result() as $c) {
        $smth= $c->$column;
        }
        return $smth;
    }

    function Merek_ByStruk($id, $column) {
        $ci =& get_instance();
        $ci->load->database();
        $result = $ci->db->select('*')
                        ->from('transaksi')
                        ->join('transaksi_item', 'transaksi.nomor_struk = transaksi_item.nomor_struk')
                        ->join('produk', 'transaksi_item.id_produk = produk.id')
                        ->join('merek', 'produk.id_merek = merek.id')
                        ->where('transaksi.nomor_struk',$id)
                        ->get();
        foreach ($result->result() as $c) {
        $smth= $c->$column;
        }
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