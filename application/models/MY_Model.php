<?php

class MY_Model extends CI_Model {

    // Define Users table
    public $user_table = 's_user a';

    public function __construct() {
        parent::__construct();
    }

    /* ====================================
        General Function
    ==================================== */

    // Check User Exist
    function check_exist_user($username, $password){
        $this->db->select('a.*, b.*, c.*');
        $this->db->from($this->user_table);
        $this->db->join('m_karyawan b','b.karyawan_id = a.m_karyawan_id','inner');
        $this->db->join('m_type_karyawan c','c.type_karyawan_id = b.m_type_karyawan_id','inner');
        $this->db->where('a.user_username = "'.$username.'" AND a.user_password = "'.$password.'"');

        $query = $this->db->get();

        if($query->num_rows() > 0)
            return $query->row();
        else return false;
    }

    // Select data on table
    function select($select = NULL, $table = NULL, $join = NULL, $where = NULL, $where2 = NULL, $like = NULL, $order = NULL, $limit = NULL, $limit1=NULL) {
        $this->db->select($select);
        $this->db->from($table);
        if ($join) {
            for ($i=0; $i<sizeof($join['data']) ; $i++) {
                $this->db->join($join['data'][$i]['table'],$join['data'][$i]['join'],$join['data'][$i]['type']);
            }
        }
        if ($where) {
            for ($i=0; $i<sizeof($where['data']) ; $i++) {
                $this->db->where($where['data'][$i]['column'],$where['data'][$i]['param']);
            }
        }
        if ($where2) {
            $this->db->where($where2);
        }
        if ($like) {
            for ($i=0; $i<sizeof($like['data']) ; $i++) {
                $this->db->like('CONCAT_WS(" ", '.$like['data'][$i]['column'].')',$like['data'][$i]['param']);
            }
        }
        if ($limit) {
            $this->db->limit($limit['finish'],$limit['start']);
        }

        if ($limit1) {
            $this->db->limit($limit1['start']);
        }

        if ($order) {
            for ($i=0; $i<sizeof($order['data']) ; $i++) {
                $this->db->order_by($order['data'][$i]['column'], $order['data'][$i]['type']);
            }
        }

        $query = $this->db->get();
        if($query->num_rows() > 0)
            return $query;
        else
            return false;
    }

    // Insert data on table
    function insert_data_table($table, $where, $data){
        if ($where) {
            for ($i=0; $i<sizeof($where['data']) ; $i++) {
                $this->db->where($where['data'][$i]['column'],$where['data'][$i]['param']);
            }
        }
        $this->db->insert($table, $data);
        $error = $this->db->error();
        $result = new stdclass();
        if ($this->db->affected_rows() > 0 or $error['code']==0){
            $result->status = true;
            $result->output = $this->db->insert_id();
        }
        else{
            $result->status = false;
            // if($error['code'] <> 0)
            $result->output = $error['code'].': '.$error['message'];
        }

        return $result;
    }

    // Update data on table
    function update_data_table($table, $where, $data){
        if ($where) {
            for ($i=0; $i<sizeof($where['data']) ; $i++) {
                $this->db->where($where['data'][$i]['column'],$where['data'][$i]['param']);
            }
        }
        $this->db->update($table, $data);
        $error = $this->db->error();
        $result = new stdclass();
        if ($this->db->affected_rows() > 0 or $error['code']==0){
            $result->status = true;
            $result->output = $this->db->insert_id();
        }
        else{
            $result->status = false;
            $result->output = $error['code'].': '.$error['message'];
        }

        return $result;
    }

    // Delete data on table
    function delete_data_table($table, $where){
        if ($where) {
            for ($i=0; $i<sizeof($where['data']) ; $i++) {
                $this->db->where($where['data'][$i]['column'],$where['data'][$i]['param']);
            }
        }
        $this->db->delete($table);
        $error = $this->db->error();
        $result = new stdclass();
        if ($this->db->affected_rows() > 0 or $error['code']==0){
            $result->status = true;
            // $result->output = $this->db->insert_id();
        }
        else{
            $result->status = false;
            $result->output = $error['code'].': '.$error['message'];
        }

        return $result;
    }
    public function importModel($dataarray) {
      for ($i = 0; $i < count($dataarray); $i++) {
            $data = array(
                // 'barang' => $dataarray[$i]['nama'],
                // 'jumlah' => $dataarray[$i]['tempat_lahir'],
                // 'satuan' => $dataarray[$i]['tanggal_lahir']

                "barang_id"             => $dataarray[$i]['barang_id'],
                "m_category_1_id"       => $dataarray[$i]['m_category_1_id'],
                "m_category_2_id"       => $dataarray[$i]['m_category_2_id'],
                "barcode"               => $dataarray[$i]['barcode'],
                "artikel"               => $dataarray[$i]['artikel'],
                "barang_nama"           => $dataarray[$i]['barang_nama'],
                "brand_id"              => $dataarray[$i]['brand_id'],
                "harga_beli"            => $dataarray[$i]['harga_beli'],
                "harga_jual"            => $dataarray[$i]['harga_jual'],
                "harga_jual_pajak"      => $dataarray[$i]['harga_jual_pajak'],
                "m_satuan_id"           => $dataarray[$i]['m_satuan_id'],
                "stok"                  => $dataarray[$i]['stok'],
                "barang_status_aktif"   => $dataarray[$i]['barang_status_aktif'],
                "barang_create_date"    => $dataarray[$i]['barang_create_date'],
                "barang_create_by"      => $dataarray[$i]['barang_create_by'],
                "barang_update_date"    => $dataarray[$i]['barang_update_date'],
                "barang_update_by"      => $dataarray[$i]['barang_update_by'],
                "barang_revised"        => $dataarray[$i]['barang_revised']
            );
            //ini untuk menambahkan apakah dalam tabel sudah ada data yang sama
            //apabila data sudah ada maka data di-skip
            // saya contohkan kalau ada data nama yang sama maka data tidak dimasukkan
            $this->db->where('barcode', $this->input->post('barcode'));
            if ($cek) {
                $this->db->insert('m_barang', $data);
            }
        }
    }
    /* ====================================
        General Function
    ==================================== */

    public function create_config($table, $data)
    {
      $this->db->insert($table, $data);
      return $this->db->insert_id();
    }

    function select_config($table, $where){
      $query = $this->db->query("SELECT * FROM $table $where");
      return $query;
    }

    function select_config_one($table, $val, $where){
      $this->db->select($val);
      $this->db->where($where);
      $query = $this->db->get($table)->row();
      return $query;
    }

    function update_config($table, $data, $where){
      $this->db->where($where);
      $this->db->update($table,$data);
    }

    function delete_config($table, $where){
      $this->db->where($where);
      $this->db->delete($table);
    }

}
