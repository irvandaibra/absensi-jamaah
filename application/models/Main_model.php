<?php

    class Main_model extends CI_Model
    {
        function __construct()
        {
            parent::__construct();
        }
        
        function get($table)
        {
            return $this->db->get($table);
        }
        
        public function get_produk($limit, $start) {
            $this->db->limit($limit, $start);
            $query = $this->db->get('produk');

            return $query->result();
        }

        function getorder($table, $order)
        {
            return $this->db->order_by($order)->get($table);
        }

        function getwhere($table, $data)
        {
            return $this->db->get_where($table, $data);
        }

        public function getwhere2($table, $where) {
            return $this->db->get_where($table, $where);
        }

        public function import_absens($data){
            $this->db->insert_batch('absensi',$data);
            if($this->db->affected_rows()>0)
            {
                return 1;
            }
            else{
                return 0;
            }
        }

        public function get_jamaah_id_by_nama_lengkap($nama_lengkap)
        {
            $this->db->where('nama_lengkap', $nama_lengkap);
            $query = $this->db->get('data_jamaah');
        
            if ($query->num_rows() > 0) {
                $row = $query->row();
                return $row->id;
            } else {
                return null;
            }
        }
        public function get_toko()
        {
            $data = [
                'id_akun' => $this->session->userdata('id')
            ];
            $this->db->order_by('nama_toko', 'ASC');
            return $this->db->get_where('toko', $data);
        }

        function getwhere_byorder($table, $data, $order)
        {
            $this->db->where($data);
            $this->db->order_by($order);
            return $this->db->get($table);
        }

        function get_all_count($table)
        {
            $this->db->from($table);
            return $this->db->count_all_results();
        }

        public function getwhere_in($table, $where_in, $order_by = '') {
            $this->db->where_in($where_in);
            if ($order_by) {
              $this->db->order_by($order_by);
            }
            return $this->db->get($table);
          }

        function insert_data($data, $table)
        {
            return $this->db->insert($table, $data);
        }


        public function insert_data2($table, $data) {
            $this->db->insert($table, $data);
            return $this->db->insert_id();
        }

        function update_data($where, $data, $table)
        {
            $this->db->where($where);
            return $this->db->update($table, $data);
        }

        function delete_data($where, $table)
        {
            $this->db->where($where);
            return $this->db->delete($table);
        }

        function set_data($where, $field, $table)
        {
            $this->db->where($where);
            $this->db->set($field, $field.'+ 1', FALSE);
            return $this->db->update($table);
        }

        public function get_join_one($table1, $table2, $field1, $field2, $where)
        {
            $this->db->select('*');
            $this->db->from($table1);
            $this->db->join($table2, $table1 . '.' . $field1 . '=' . $table2 . '.' . $field2);
            $this->db->where($where);
            return $this->db->get();
        }

        public function get_join_two($table1, $table2, $table3, $field1, $field2, $field3, $where)
        {
            $this->db->select('*');
            $this->db->from($table1);
            $this->db->join($table2, $table1 . '.' . $field2 . '=' . $table2 . '.' . $field1);
            $this->db->join($table3, $table2 . '.' . $field3 . '=' . $table3 . '.' . $field1);
            $this->db->where($where);
            return $this->db->get();
        }

        public function get_join_three($table1, $table2, $table3, $table4, $field1, $field2, $field3, $field4, $where)
        {
            $this->db->select('*');
            $this->db->from($table1);
            $this->db->join($table2, $table1 . '.' . $field2 . '=' . $table2 . '.' . $field1);
            $this->db->join($table3, $table2 . '.' . $field3 . '=' . $table3 . '.' . $field1);
            $this->db->join($table4, $table3 . '.' . $field4 . '=' . $table4 . '.' . $field1);
            $this->db->where($where);
            return $this->db->get();
        }

        public function read_join_one($table1, $table2, $field1, $field2, $where, $order, $ordering)
        {
            $this->db->select('*');
            $this->db->from($table1);
            $this->db->join($table2, $table1 . '.' . $field1 . '=' . $table2 . '.' . $field2);
            $this->db->where($where);
            $this->db->order_by($order, $ordering);
            return $this->db->get();
        }
        public function read_join_two($table1, $table2, $table3, $field1, $field2, $field3, $where, $id)
        {
            $this->db->select('*');
            $this->db->from($table1);
            $this->db->join($table2, $table1 . '.' . $field1 . '=' . $table2 . '.' . $field2);
            $this->db->join($table3, $table1 . '.' . $field1 . '=' . $table3 . '.' . $field3);
            $this->db->where($where);
            $this->db->order_by($id, 'DESC');
            return $this->db->get();
        }

        public function view_join_one($table1, $table2, $field1, $field2, $order, $ordering)
        {
            $this->db->select('*');
            $this->db->from($table1);
            $this->db->join($table2, $table1 . '.' . $field1 . '=' . $table2 . '.' . $field2);
            $this->db->order_by($order, $ordering);
            return $this->db->get();
        }

        public function view_join_one_where($table1, $table2, $field1, $field2, $order, $ordering, $where)
        {
            $this->db->select('*');
            $this->db->from($table1);
            $this->db->join($table2, $table1 . '.' . $field1 . '=' . $table2 . '.' . $field2);
            $this->db->where($where);
            $this->db->order_by($order, $ordering);
            return $this->db->get();
        }

        public function count_field($where, $table)
        {
            $this->db->select('COUNT(*)');
            $this->db->from($table);
            $this->db->where($where);
            return $this->db->count_all_results();
        }

        public function count_all($table)
        {
            return $this->db->count_all($table);
        }

        public function count_group_by($select, $group_by, $table)
        {
            $this->db->select($select);
            $this->db->from($table);
            $this->db->group_by($group_by);
            return $this->db->get();
        }

        function get_tables($tables,$cari,$iswhere)
        {

            $search = htmlspecialchars($_POST['search']['value']);

            $limit = preg_replace("/[^a-zA-Z0-9.]/", '', "{$_POST['length']}");

            $start = preg_replace("/[^a-zA-Z0-9.]/", '', "{$_POST['start']}"); 
            
            $query = $tables;
            
            if(!empty($iswhere)){
                $sql = $this->db->query("SELECT * FROM ".$query." WHERE ".$iswhere);
            }else{
                $sql = $this->db->query("SELECT * FROM ".$query);
            }

            $sql_count = $sql->num_rows();

            $cari = implode(" LIKE '%".$search."%' OR ", $cari)." LIKE '%".$search."%'";            

            $order_field = $_POST['order'][0]['column']; 

            $order_ascdesc = $_POST['order'][0]['dir']; 
            $order = " ORDER BY ".$_POST['columns'][$order_field]['data']." ".$order_ascdesc;

            if(!empty($iswhere)){
                $sql_data = $this->db->query("SELECT * FROM ".$query." WHERE $iswhere AND (".$cari.")".$order." LIMIT ".$limit." OFFSET ".$start);
            }else{
                $sql_data = $this->db->query("SELECT * FROM ".$query." WHERE (".$cari.")".$order." LIMIT ".$limit." OFFSET ".$start);
            }

            if(isset($search))
            {
                if(!empty($iswhere)){
                    $sql_cari =  $this->db->query("SELECT * FROM ".$query." WHERE $iswhere (".$cari.")");
                }else{
                    $sql_cari =  $this->db->query("SELECT * FROM ".$query." WHERE (".$cari.")");
                }
                $sql_filter_count = $sql_cari->num_rows();
            }else{
                if(!empty($iswhere)){
                    $sql_filter = $this->db->query("SELECT * FROM ".$query."WHERE ".$iswhere);
                }else{
                    $sql_filter = $this->db->query("SELECT * FROM ".$query);
                }
                $sql_filter_count = $sql_filter->num_rows();
            }
            $data = $sql_data->result_array();
            $callback = array(    
                'draw' => $_POST['draw'], 
                'recordsTotal' => $sql_count,    
                'recordsFiltered'=> $sql_filter_count,    
                'data'=> $data
            );
            return json_encode($callback);
        }

        function get_tables_where($tables,$cari,$where,$iswhere)
        {
            $search = htmlspecialchars($_POST['search']['value']);
            $limit  = preg_replace("/[^a-zA-Z0-9.]/", '', "{$_POST['length']}");
            $start  = preg_replace("/[^a-zA-Z0-9.]/", '', "{$_POST['start']}"); 

            $setWhere = array();
            foreach ($where as $key => $value)
            {
                $setWhere[] = $key."='".$value."'";
            }

            $fwhere = implode(' AND ', $setWhere);

            if(!empty($iswhere)){
                $sql = $this->db->query("SELECT * FROM ".$tables." WHERE $iswhere AND ".$fwhere);
            }else{
                $sql = $this->db->query("SELECT * FROM ".$tables." WHERE ".$fwhere);
            }
            $sql_count = $sql->num_rows();

            $query = $tables;
            $cari = implode(" LIKE '%".$search."%' OR ", $cari)." LIKE '%".$search."%'";

            $order_field = $_POST['order'][0]['column']; 

            $order_ascdesc = $_POST['order'][0]['dir']; 
            $order = " ORDER BY ".$_POST['columns'][$order_field]['data']." ".$order_ascdesc;

            if(!empty($iswhere)){
                $sql_data = $this->db->query("SELECT * FROM ".$query." WHERE $iswhere AND ".$fwhere." AND (".$cari.")".$order." LIMIT ".$limit." OFFSET ".$start);
            }else{
                $sql_data = $this->db->query("SELECT * FROM ".$query." WHERE ".$fwhere." AND (".$cari.")".$order." LIMIT ".$limit." OFFSET ".$start);
            }

            if(isset($search))
            {
                if(!empty($iswhere)){
                    $sql_cari =  $this->db->query("SELECT * FROM ".$query." WHERE $iswhere AND ".$fwhere." AND (".$cari.")");
                }else{
                    $sql_cari =  $this->db->query("SELECT * FROM ".$query." WHERE ".$fwhere." AND (".$cari.")");
                }
                $sql_filter_count = $sql_cari->num_rows();
            }else{
                if(!empty($iswhere)){
                    $sql_filter = $this->db->query("SELECT * FROM ".$tables." WHERE $iswhere AND ".$fwhere);
                }else{
                    $sql_filter = $this->db->query("SELECT * FROM ".$tables." WHERE ".$fwhere);
                }
                $sql_filter_count = $sql_filter->num_rows();
            }

            $data = $sql_data->result_array();
            
            $callback = array(    
                'draw' => $_POST['draw'],
                'recordsTotal' => $sql_count,    
                'recordsFiltered'=> $sql_filter_count,    
                'data'=> $data
            );
            return json_encode($callback);
        }

        function get_tables_query($query,$cari,$where,$iswhere)
        {

            $search = htmlspecialchars($_POST['search']['value']);

            $limit = preg_replace("/[^a-zA-Z0-9.]/", '', "{$_POST['length']}");

            $start =preg_replace("/[^a-zA-Z0-9.]/", '', "{$_POST['start']}"); 

            if($where != null)
            {
                $setWhere = array();
                foreach ($where as $key => $value)
                {
                    $setWhere[] = $key."='".$value."'";
                }
                $fwhere = implode(' AND ', $setWhere);

                if(!empty($iswhere))
                {
                    $sql = $this->db->query($query." WHERE  $iswhere AND ".$fwhere);
                    
                }else{
                    $sql = $this->db->query($query." WHERE ".$fwhere);
                }
                $sql_count = $sql->num_rows();
    
                $cari = implode(" LIKE '%".$search."%' OR ", $cari)." LIKE '%".$search."%'";

                $order_field = $_POST['order'][0]['column']; 

                $order_ascdesc = $_POST['order'][0]['dir']; 
                $order = " ORDER BY ".$_POST['columns'][$order_field]['data']." ".$order_ascdesc;
    
                if(!empty($iswhere))
                {
                    $sql_data = $this->db->query($query." WHERE $iswhere AND ".$fwhere." AND (".$cari.")".$order." LIMIT ".$limit." OFFSET ".$start);
                }else{
                    $sql_data = $this->db->query($query." WHERE ".$fwhere." AND (".$cari.")".$order." LIMIT ".$limit." OFFSET ".$start);
                }
                
                if(isset($search))
                {
                    if(!empty($iswhere))
                    {
                        $sql_cari =  $this->db->query($query." WHERE $iswhere AND ".$fwhere." AND (".$cari.")");
                    }else{
                        $sql_cari =  $this->db->query($query." WHERE ".$fwhere." AND (".$cari.")");
                    }
                    $sql_filter_count = $sql_cari->num_rows();
                }else{
                    if(!empty($iswhere))
                    {
                        $sql_filter = $this->db->query($query." WHERE $iswhere AND ".$fwhere);
                    }else{
                        $sql_filter = $this->db->query($query." WHERE ".$fwhere);
                    }
                    $sql_filter_count = $sql_filter->num_rows();
                }
                $data = $sql_data->result_array();

            }else{
                if(!empty($iswhere))
                {
                    $sql = $this->db->query($query." WHERE  $iswhere ");
                }else{
                    $sql = $this->db->query($query);
                }
                $sql_count = $sql->num_rows();
    
                $cari = implode(" LIKE '%".$search."%' OR ", $cari)." LIKE '%".$search."%'";

                $order_field = $_POST['order'][0]['column']; 

                $order_ascdesc = $_POST['order'][0]['dir']; 
                $order = " ORDER BY ".$_POST['columns'][$order_field]['data']." ".$order_ascdesc;
    
                if(!empty($iswhere))
                {                
                    $sql_data = $this->db->query($query." WHERE $iswhere AND (".$cari.")".$order." LIMIT ".$limit." OFFSET ".$start);
                }else{
                    $sql_data = $this->db->query($query." WHERE (".$cari.")".$order." LIMIT ".$limit." OFFSET ".$start);
                }

                if(isset($search))
                {
                    if(!empty($iswhere))
                    {     
                        $sql_cari =  $this->db->query($query." WHERE $iswhere AND (".$cari.")");
                    }else{
                        $sql_cari =  $this->db->query($query." WHERE (".$cari.")");
                    }
                    $sql_filter_count = $sql_cari->num_rows();
                }else{
                    if(!empty($iswhere))
                    {
                        $sql_filter = $this->db->query($query." WHERE $iswhere");
                    }else{
                        $sql_filter = $this->db->query($query);
                    }
                    $sql_filter_count = $sql_filter->num_rows();
                }
                $data = $sql_data->result_array();
            }
            
            $callback = array(    
                'draw' => $_POST['draw'],
                'recordsTotal' => $sql_count,
                'recordsFiltered'=> $sql_filter_count,
                'data'=> $data
            );
            return json_encode($callback);
        }

        public function graph()
	{
		$data = $this->db->query("SELECT * from produk");
		return $data->result();
	}

    function get_provinsi()
    {
        $this->db->order_by('name', 'ASC');
        $query = $this->db->get('provinces');
        return $query->result();
    }

    function get_kabupaten($provinsi_id)
    {
        //ambil data kabupaten berdasarkan id provinsi yang dipilih
        $this->db->where('province_id', $provinsi_id);
        $this->db->order_by('name', 'ASC');
        $query = $this->db->get('regencies');

        $output = '<option value="">-- Pilih Kota/Kabupaten --</option>';

        //looping data
        foreach ($query->result() as $row) {
            $output .= '<option value="' . $row->id . '">' . $row->name . '</option>';
        }
        //return data kabupaten
        return $output;
    }

    function get_kecamatan($kabupaten_id)
    {
        //ambil data kecamatan berdasarkan id kabupaten yang dipilih
        $this->db->where('regency_id', $kabupaten_id);
        $this->db->order_by('name', 'ASC');
        $query = $this->db->get('districts');

        $output = '<option value="">-- Pilih Kecamatan --</option>';

        //looping data
        foreach ($query->result() as $row) {
            $output .= '<option value="' . $row->id . '">' . $row->name . '</option>';
        }
        //return data kecamatan
        return $output;
    }

    function get_desa($kecamatan_id)
    {
        //ambil data desa berdasarkan id kecamatan yang dipilih
        $this->db->where('district_id', $kecamatan_id);
        $this->db->order_by('name', 'ASC');
        $query = $this->db->get('villages');

        $output = '<option value="">-- Pilih Desa --</option>';

        //looping data
        foreach ($query->result() as $row) {
            $output .= '<option value="' . $row->id . '" >' . $row->name . '</option>';
        }
        //return data desa
        return $output;
    }
    
    function getwhere_produk($id)
    {
        $this->db->where('id', $id);
        $this->db->order_by('nama_produk', 'ASC');
        $query = $this->db->get('produk');
        $output= '';
        foreach ($query->result() as $row) {
            $output .= '
            <div class="col-4">
            <input value="' . $row->stok . '" class="form-control" disabled />
            <input type="hidden" value="' . $row->id . '" id="InputId_produk"/>
            </div>
            <div class="col-4">
            <input type="number" id="InputKuantitas" class="form-control" name="kuantitas" min="0" max="'.$row->stok.'"/>
            </div>
            <div class="col-4">
            <input id="InputBarang" value="' . $row->nama_produk . '" class="form-control" disabled />
            </div>
            ';
            }
            return $output;
        }

        function get_produk_bytoko($id_toko)
        {
            $this->db->where('id_toko', $id_toko);
            $this->db->order_by('nama_produk', 'ASC');
            $query = $this->db->get('produk');
            $output = '';
            foreach ($query->result() as $row) {
                $output .= '
                <input type="radio" name="radiobarang" id="' . $row->id . '"
                class="checkbox-modal hide" onchange="pilihBarang(' . $row->id . ')">
                <label for="' . $row->id . '"
                class="d-flex align-items-center mt-3 hover-barang rounded">
                <div style="width: 70px;">
                <img src="https://i.gojekapi.com/darkroom/moka/v2/images/inventory/676454/719977/e323a9c9f8a66311e6a4cd5573b275e9.jpg?w=500&h=500&fit=crop"
                alt="Gambar Produk" class="rounded-circle" style="width: 70px;">
                </div>
                <div class="ms-5">
                <h5>' . $row->nama_produk . '</h5>
                </div>
                </label>
                ';
            }
            return $output;
        }
    }

?>