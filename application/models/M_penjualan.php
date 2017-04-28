<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_penjualan extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function get_all_item(){
    $query = $this->db->query("SELECT a.*, b.det_promo_status_aktif, c.* FROM m_barang a
                               LEFT JOIN m_detail_promo b on b.barang_id = a.barang_id
                               LEFT JOIN m_promo c on c.promo_id = b.promo_id");
    return $query;
  }


}
