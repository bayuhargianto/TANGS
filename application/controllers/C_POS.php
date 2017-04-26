<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_POS extends MY_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model('M_penjualan');
  }

  function index()
  {
    $this->get_header();
    $this->penjualan_form();
    $this->get_footer();
  }

  function penjualan_form(){
    // $this->get_all_item();
    $where = '';
    $data = array('all_item' => $this->select_config('m_barang', $where));

    $this->load->view('transaksi/penjualan/V_penjualan', $data);
  }

  function get_items(){
    $where = '';
    $q_item = $this->M_penjualan->get_all_item();
    $aktif = 0;
    foreach ($q_item->result() as $row) {
      if ($row->det_promo_status_aktif != '' || $row->promo_status_aktif != '') {
        $aktif = 1;
      } else {
        $aktif = 0;
      }

      $data[] = array(
        'barang_id' => $row->barang_id,
        'm_jenis_barang_id' => $row->m_jenis_barang_id,
        'category_2_id' => $row->m_category_2_id,
        'barang_kode' => $row->barang_kode,
        'barang_nomor' => $row->barang_nomor,
        'barang_nama' => $row->barang_nama,
        'm_satuan_id' => $row->m_satuan_id,
        'brand_id' => $row->m_brand_id,
        'harga_beli' => $row->harga_beli,
        'harga_jual' => $row->harga_jual,
        'harga_jual_pajak' => $row->harga_jual_pajak,
        'stok' => $row->stok,
        'barang_minimum_stok' => $row->barang_minimum_stok,
        'stok_maks' => $row->stok_maks,
        'barang_status_aktif' => $row->barang_status_aktif,
        'barang_create_date' => $row->barang_create_date,
        'barang_create_by' => $row->barang_create_by,
        'barang_update_date' => $row->barang_update_date,
        'barang_update_by' => $row->barang_update_by,
        'barang_revised' => $row->barang_revised,
        'det_promo_status_aktif' => $row->det_promo_status_aktif,
        'promo_nama' => $row->promo_nama,
        'promo_qty' => $row->promo_qty,
        // 'promo_harga' => $row->promo_harga,
        'promo_status_aktif' => $row->promo_status_aktif,
        'aktif' => $aktif
     );
    }
    echo json_encode($data);
  }


  function simpan_transaksi(){

      $qty_s = $this->input->post('item_qty');
      $item_s = $this->input->post('item_id');
      $item_discount = $this->input->post('item_discount');
      $item_discount_percent = $this->input->post('item_discount_percent');

      $discount_s = $this->input->post('item_discount');
      $sales_pay = $this->input->post('sales_pay');
      $sales_type = $this->input->post('sales_type');
      $customer_id = $this->input->post('customer_id');
      $sales_dp = $this->input->post('sales-dp');
      $sales_nama = $this->input->post('sales-nama');
      $sales_nomor_kartu = $this->input->post('sales-nomor-kartu');
      $sales_nama_bank = $this->input->post('sales-nama-bank');
      $sales_nomor_rekening = $this->input->post('sales-nomor-rekening');
      $tgl_jatuh_tempo = $this->input->post('tgl_jatuh_tempo');
      $input_total = $this->input->post('input-total');
      $outlet_id = $this->input->post('outlet_id');
      $sales_discount = $this->input->post('sales_discount');
      $input_cashback = $this->input->post('input-cashback');
      $item_price = $this->input->post('item_price');

      $penjualan_code = "INV_".time();

      $data = array(
                    'penjualan_id' => '',
                    'penjualan_code' => $penjualan_code,
                    'penjualan_date' => date("Y-m-d h:m:s"),
                    'customer' => $customer_id,
                    'branch' => $outlet_id,
                    'penjualan_all_discount' => $sales_discount,
                    'penjualan_total' => $input_total,
                    'penjualan_pajak' => '',
                    'penjualan_all_discount_percent' => '',
                    'penjualan_all_discount_nominal' => $sales_discount,
                    'penjualan_grand_total' => $input_total,
                    'penjualan_payment' => $sales_pay,
                    'penjualan_change' => $input_cashback,
                    'penjualan_payment_method' => $sales_type,
                    'bank_atas_name' => $sales_nama,
                    'bank' => $sales_nama_bank,
                    'bank_number' => $sales_nomor_kartu,
                    'status' => ''
                  );
      $id = $this->create_config('tb_penjualan', $data);

      extract($_POST);

      foreach ($item_s as $row => $value) {
        $item_total[$row] = $item_price[$row]*$qty_s[$row];
        $item_grand_total[$row] = $item_total[$row]-$item_discount[$row];

        $data_detail = array(
                            'penjualan_detail_id' => '',
                            'penjualan'           => $id,
                            'barang'              => $item_s[$row],
                            'barang_qty'          => $qty_s[$row],
                            'barang_price'        => $item_price[$row],
                            'barang_total'        => $item_total[$row],
                            'barang_discount_percent' => $item_discount_percent[$row],
                            'barang_discount_nominal' => $item_discount[$row],
                            'barang_grand_total'      => $item_grand_total[$row]
                            );

        $this->create_config('tb_penjualan_details', $data_detail);
      }
      echo json_encode($id);
  }

	function print_struk($id)
	{
		$where='';

    $where_penjualan_id = "WHERE penjualan_id = '$id'";
    $where_penjualan_id_ =  "WHERE a.penjualan = '$id'";

		$data = array(
			'transaksi' => $this->select_config('tb_penjualan', $where_penjualan_id)->row(),
			'transaksi_detail' => $this->db->query("select a.*, b.* from tb_penjualan_details a
                                               left join m_barang b on b.barang_id = a.barang
                                               $where_penjualan_id_")
	 );

		$this->load->view('transaksi/penjualan/invoice_penjualan', $data);
	}

  function get_customers()
  {
    $where = '';
    $q_member = $this->select_config('m_partner', $where);
    foreach ($q_member->result() as $r_member) {
      $data[] = array(
                      'partner_id' => $r_member->partner_id,
                      'partner_status' =>  $r_member->partner_status,
                      'partner_nama'  => $r_member->partner_nama,
                      'partner_telepon' => $r_member->partner_telepon
                    );
    }

    echo json_encode($data);

  }

}
