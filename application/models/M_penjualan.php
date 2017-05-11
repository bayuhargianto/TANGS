<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_penjualan extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function get_all_item(){
    $query = $this->db->query("SELECT a.*, b.det_promo_status_aktif, c.*,
                              IFNULL(d.stok_gudang_jumlah, 0) AS stok_gudang_jumlah
                              FROM m_barang a
                              LEFT JOIN m_detail_promo b ON b.barang_id = a.barang_id
                              LEFT OUTER JOIN m_promo c ON c.promo_id = b.promo_id
                              LEFT JOIN t_stok_gudang d ON d.m_barang_id = a.barang_id
                              GROUP BY a.barang_id
                               ");
    return $query;
  }

  function get_item($where_barang_id){
    $query = $this->db->query("SELECT a.*, b.det_promo_status_aktif, c.*,
                              IFNULL(d.stok_gudang_jumlah, 0) AS stok_gudang_jumlah
                              FROM m_barang a
                              LEFT JOIN m_detail_promo b ON b.barang_id = a.barang_id
                              LEFT OUTER JOIN m_promo c ON c.promo_id = b.promo_id
                              LEFT JOIN t_stok_gudang d ON d.m_barang_id = a.barang_id
                              $where_barang_id
                               ");
    return $query;
  }

  function select_transaction($where=NULL)
  {
    $this->db->from('tb_penjualan');
    $this->db->select('tb_penjualan.*, m_cabang.cabang_nama, m_partner.partner_nama');
    $this->db->join('m_cabang', 'm_cabang.cabang_id = tb_penjualan.branch', 'left');
    $this->db->join('s_user', 's_user.user_id = tb_penjualan.user', 'left');
    $this->db->join('m_partner', 'm_partner.partner_id = tb_penjualan.customer', 'left');
    if ($where!=NULL) {
      $this->db->where($where);
    }
    // $this->db->group_by('tb_penjualan.penjualan_id');
    $query = $this->db->get();
    return $query;
  }

  function select_transaction_details($select = NULL, $table = NULL, $join = NULL, $where = NULL, $where2 = NULL, $like = NULL, $order = NULL, $limit = NULL)
  {
    $this->db->select('tb_penjualan.*, tb_penjualan_details.*, m_cabang.cabang_nama, m_barang.barang_nama');
    $this->db->from('tb_penjualan');
    $this->db->join('tb_penjualan_details', 'tb_penjualan_details.penjualan = tb_penjualan.penjualan_id', 'left');
    $this->db->join('m_cabang', 'm_cabang.cabang_id = tb_penjualan.branch', 'left');
    $this->db->join('s_user', 's_user.user_id = tb_penjualan.user', 'left');
    $this->db->join('m_partner', 'm_partner.partner_id = tb_penjualan.customer', 'left');
    $this->db->join('m_barang', 'm_barang.barang_id = tb_penjualan_details.barang', 'left');
    if ($where!=NULL) {
      $this->db->where($where);
    }
    $query = $this->db->get();
    return $query;
  }
}
