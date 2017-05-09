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
    // $this->get_header();
    // $this->penjualan_list();
    // $this->get_footer();
  }

  public function view()
  {
    $this->check_session();
    $priv = $this->cekUser(28);
    $data = array(
      'aplikasi'		=> $this->app_name,
      'title_page' 	=> 'Penjualan',
      'title_page2' 	=> 'Point Of Sales',
      'priv_add'		=> $priv['create']
      );
    $this->open_page('transaksi/penjualan/V_penjualan_list', $data);
  }

  function loadData($type)
  {
    $privPenjualan = $this->cekUser(76);
    $priv = $this->cekUser(76);
    $select = 'a.*, b.cabang_nama, c.user_username, d.partner_nama, e.pengiriman_id';
    $table  = 'tb_penjualan a';
		//LIMIT
		$limit = array(
			'start'  => $this->input->get('start'),
			'finish' => $this->input->get('length')
		);

    $where_like['data'][] = array(
			'column' => 'cabang_nama, a.penjualan_code, penjualan_date, penjualan_total, penjualan_payment',
			'param'	 => $this->input->get('search[value]')
		);

    $join['data'][] = array(
      'table' => 'm_cabang b',
      'join'  => 'b.cabang_id = a.branch',
      'type'  => 'left'
    );

    $join['data'][] = array(
      'table' => 's_user c',
      'join'  => 'c.user_id = a.user',
      'type'  => 'left'
    );

    $join['data'][] = array(
      'table' => 'm_partner d',
      'join'  => 'd.partner_id = a.customer',
      'type'  => 'left'
    );

    $join['data'][] = array(
      'table' => 'tb_pengiriman e',
      'join'  => 'e.penjualan_id = a.penjualan_id',
      'type'  => 'left'
    );

    // $query_total = $this->M_penjualan->select_transaction();
    $query_total  = $this->mod->select($select, $table, $join);
    $query        = $this->mod->select($select, $table, $join);
    // $query        = $this->mod->select($select, $table, $join, '', NULL, $where_like, '', $limit);
    // $query = $this->M_penjualan->select_transaction_details();
    $query_filter =  $this->mod->select($select, $table, $join, '', NULL, $where_like, '');
    // echo $this->db->last_query();
    // <a href="'.base_url().'Penjualan/print/'.$val->penjualan_id.'">

    if ($query<>false) {
      $no = $limit['start']+1;
      foreach ($query->result() as $val) {
        $button = '';
          if ($val->pengiriman_id != null) {
            $button = $button.'
  					<button class="btn blue-ebonyclay" type="button" title="">
  						<i class="fa fa-truck text-center"></i>
  					</button>
            ';
          }
					$button = $button.'
					<a href="'.base_url().'Penjualan/penjualan_details/'.$val->penjualan_id.'">
					<button class="btn blue-ebonyclay" type="button" title="Lihat PO">
						<i class="icon-eye text-center"></i>
					</button>
					</a>
					<button class="btn green-jungle" type="button" title="Print Struk Penjualan" onclick="print_struk('.$val->penjualan_id.')">
						<i class="icon-printer text-center"></i>
					</button>';

        $response['data'][] = array(
          $no,
          $val->cabang_nama,
          $val->penjualan_code,
          date("d/m/Y",strtotime($val->penjualan_date)),
          number_format($val->penjualan_total),
          number_format($val->penjualan_payment),
          $button
        );

        $no++;
      }
    }


    $response['recordsTotal'] = 0;
		if ($query_total<>false) {
			$response['recordsTotal'] = $query_total->num_rows();
		}

		$response['recordsFiltered'] = 0;
		if ($query_filter<>false) {
			$response['recordsFiltered'] = $query_filter->num_rows();
		}

    echo json_encode($response);
  }

  function open_page_penjualan()
  {
    $this->get_header();
    $this->penjualan_form();
    $this->get_footer();
  }

  function penjualan_form(){
    // $this->get_all_item();
    $where = '';
    $where_user_id = array('user_id' =>  $this->session->userdata('user_id'));

    $data = array(
        'back_to_pos_list' => "C_POS",
        'all_item' => $this->select_config('m_barang', $where),
        'user'     => $this->select_config('s_user', $where)->row()
      );
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
        'stok_gudang_jumlah' => $row->stok_gudang_jumlah,
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
      $item_book = $this->input->post('item_book');


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
      $status = $this->input->post('item_price');
      $pengiriman = $this->input->post('pengiriman');



      $penjualan_total = $input_total;

      $input_jarak = null;
      $booking_status = null;
      $biaya_pengiriman = null;
      $input_jarak_currency = null;

      if ($item_book!=null) {
        $booking_status = 1;
      }

      if ($pengiriman) {

        $tujuan_pengiriman = $this->input->post('tujuan_pengiriman');
        $input_jarak = $this->input->post('input_jarak');
        $biaya_pengiriman = $this->input->post('input_biaya_currency');

      }
      // echo $booking_status;

      $sales_dp = $this->input->post('sales-dp');
      $tgl_jatuh_tempo = $this->input->post('tgl_jatuh_tempo');

      $user_id = $this->session->userdata('user_id');
      $penjualan_code = "INV_".time();

      $status = '';
      if ($sales_type == 3) {
        $status = 1;
      }

      if ($sales_discount) {
        $penjualan_total = $input_total-$sales_discount;
      }

      if ($biaya_pengiriman) {
        $penjualan_total = $input_total+$biaya_pengiriman;
      }

      $data = array(
                    'penjualan_id'      => '',
                    'penjualan_code'    => $penjualan_code,
                    'penjualan_date'    => date("Y-m-d h:m:s"),
                    'customer'          => $customer_id,
                    'branch'            => $outlet_id,
                    'penjualan_all_discount'  => $sales_discount,
                    'penjualan_total'         => $penjualan_total,
                    'penjualan_pajak'         => '',
                    'penjualan_all_discount_percent' => '',
                    'penjualan_all_discount_nominal' => $sales_discount,
                    'penjualan_biaya_pengiriman'     => $biaya_pengiriman,
                    'penjualan_grand_total'          => $input_total,
                    'penjualan_payment'              => $sales_pay,
                    'penjualan_change'               => $input_cashback,
                    'penjualan_payment_method'       => $sales_type,
                    'bank_atas_name'                 => $sales_nama,
                    'bank'                           => $sales_nama_bank,
                    'bank_number'                    => $sales_nomor_kartu,
                    'user'                           => $user_id,
                    'booking_status'                 => $booking_status,
                    'status'                         => $status
                  );
      $id = $this->create_config('tb_penjualan', $data);

      if ($biaya_pengiriman!=null) {
        $data_pengiriman =  array(
                            'pengiriman_id'       => '',
                            'penjualan_id'        => $id,
                            'penjualan_code'      => $penjualan_code,
                            'penjualan_tanggal'   => date("Y-m-d h:m:s"),
                            'pengiriman_date'     => null,
                            'pengiriman_tujuan'   => $tujuan_pengiriman,
                            'pengiriman_jarak'    => $input_jarak,
                            'pengiriman_biaya'    => $biaya_pengiriman,
                            'pengiriman_tanggal'  => null,
                            'pengiriman_tanggal_sampai' => '',
                            'status'                    => 0
                          );
        $this->create_config('tb_pengiriman', $data_pengiriman);
      }

      // extract($_POST);
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
                            'barang_grand_total'      => $item_grand_total[$row],
                            'booking_status'          => $item_book[$row]
                            );

        $this->create_config('tb_penjualan_details', $data_detail);

        $where_barang_id = array('m_barang_id' => $item_s[$row]);
        // $data_update = "stok_gudang_jumlah = stok_gudang_jumlah - '".$qty_s[$row]."'";
        $stock_gudang_now = $this->select_config_one('t_stok_gudang', 'stok_gudang_jumlah',$where_barang_id);
        if ($stock_gudang_now) {
          $pengurangan = $stock_gudang_now->stok_gudang_jumlah - $qty_s[$row];
          $data_update = array('stok_gudang_jumlah' => $pengurangan);
          $this->update_config('t_stok_gudang', $data_update, $where_barang_id);
        }
      }
      // echo $this->db->last_query();
      if ($sales_type==3) {
          $data_kredit = array(
            'penjualan_id' => $id,
            'penjualan_code'=> $penjualan_code,
            'tanggal_batas'=> $tgl_jatuh_tempo,
            'customer' => $sales_nama,
            'user' => $user_id
          );
          $this->create_config('tb_kredit', $data_kredit);
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

  function penjualan_details($id)
  {
    $this->check_session();
    $priv = $this->cekUser(28);

    $select = 'a.*, b.partner_nama, c.*';

    $table = 'tb_penjualan a';

    $join['data'][] = array(
          'table' => 'm_partner b',
          'join'	=> 'b.partner_id = a.customer',
          'type'	=> 'left'
        );

    $join['data'][] = array(
          'table' => 'tb_pengiriman c',
          'join'	=> 'c.penjualan_id = a.penjualan_id',
          'type'	=> 'left'
        );

    $where['data'][] = array(
      'column' => 'a.penjualan_id',
      'param'  => $id
    );

    $data = array(
      'aplikasi'		  => $this->app_name,
      'title_page' 	  => 'List Penjualan',
      'title_page2' 	=> 'Detil Penjualan',
      'penjualan_id'  => $id,
      'penjualan'     => $this->mod->select($select, $table, $join, $where, NULL, NULL, '')->row()
      );

    $this->open_page('transaksi/penjualan/V_penjualan_details', $data);
  }

  function loadDatadetail($id)
    {
      $privPenjualan = $this->cekUser(76);
      $priv = $this->cekUser(76);
      $select = '*';
  		//LIMIT
  		$limit = array(
  			'start'  => $this->input->get('start'),
  			'finish' => $this->input->get('length')
  		);
      $where_like['data'][] = array(
  			'column' => 'cabang_nama, penjualan_code, penjualan_date, penjualan_total, penjualan_payment',
  			'param'	 => $this->input->get('search[value]')
  		);
      $where = array('penjualan_id' => $id );

      $query_total = $this->M_penjualan->select_transaction_details();
      $query = $this->M_penjualan->select_transaction_details($select, '', NULL, $where, NULL, $where_like, '');
      $query_filter = $this->M_penjualan->select_transaction_details($select, '', NULL, '', NULL, $where_like, '');

      if ($query<>false) {
        $no = $limit['start']+1;
        foreach ($query->result() as $val) {
          $button = '';
          $classdonebook = "blue-ebonyclay";
          if ($val->booking_status==2){$classdonebook="green-jungle";}

          if ($val->booking_status==1 || $val->booking_status==2){
      					$button = $button.'<button class="btn '.$classdonebook.'" type="button" id="btn_'.$val->penjualan_detail_id.'"
                                    data-penjualan-detail-id="" onclick="bookBtn('.$val->penjualan_detail_id.')" href="#modaladd">
                                    <i class="fa fa-book text-center"></i>
                                   </button>';
                }
          $response['data'][] = array(
            $no,
            number_format($val->barang_price),
            $val->barang_nama,
            number_format($val->barang_qty),
            number_format($val->barang_total),
            number_format($val->barang_discount_nominal),
            number_format($val->barang_grand_total),
            $button
          );

          $no++;
        }
      }

      // echo $this->db->last_query();

      $response['recordsTotal'] = 0;
  		if ($query_total<>false) {
  			$response['recordsTotal'] = $query->num_rows();
  		}
      echo json_encode($response);
    }

    function popmodal_form_login()
    {
      $data['action'] = "C_POS/checklogin";
      $this->load->view('transaksi/penjualan/popmodal_check_login', $data);
    }

    function checklogin()
  	{
  		$user = $this->input->post('i_username', TRUE);
  		$pass = md5(base64_decode($this->input->post('i_password', TRUE)));
  		$user_data = $this->mod->check_exist_user($user,$pass);
  		if(!$user_data)
  			{
          $response['status'] = '204';
        }
  		  else {
  			  $response['status'] = '200';
          $response['type_karyawan'] = $user_data->m_type_karyawan_id;
  		  }

  		echo json_encode($response);
  	}

    function booking_popmodal($stok_gudang, $item_id)
    {
      $where_barang_id = "WHERE a.barang_id = '$item_id'";
      $data = array(
                    'barang' => $this->M_penjualan->get_item($where_barang_id)->row(),
                    'action' => "C_POS/booking_storage"
                  );
      $this->load->view('transaksi/penjualan/booking_modal', $data);
    }

    function update_book()
    {
      $penjualan_detail_id = $_POST['id'];
      $where_penjualan_detail_id = array('penjualan_detail_id' => $penjualan_detail_id);
      $data_update = array('booking_status' => 2);
      $this->update_config('tb_penjualan_details', $data_update, $where_penjualan_detail_id);

      echo json_encode($penjualan_detail_id);
    }

    function booking_storage()
    {

    }

}
