<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public $admin_granted = false;
	public $logged_in = false;
	public $app_name = 'ERP';

	public function __construct() {
		parent::__construct();
		$this->is_logged_in();
		$this->user_has_access();
		
	}	
	
	/* ====================================
		General Function
	==================================== */

	// Check Session Active
	function is_logged_in() {
	   	$user = $this->session->userdata('logged');
	   	if($user=="")
	   		$this->logged_in = false;
	   	else
	   		$this->logged_in = true;
	}

	function check_session(){
		if(!$this->logged_in)
			redirect('Login');
	}

	// Check if user has level
	function user_has_access(){
		$user_level = $this->session->userdata('level');
		if($user_level!=0)
			$this->admin_granted = true;
		else if($user_level==0)
			$this->admin_granted = false;
	}

	// Check Authorized User
	// function check_authorized($table,$id){
	// 	if ($table == 'mainmenu') {
	// 		$table1 = $table;
	// 		$id1 = 'idmenu';
	// 		$status1 = 'status_menu';
	// 	} else if ($table == 'submenu') {
	// 		$table1 = $table;
	// 		$id1 = 'idsub';
	// 		$status1 = 'status_submenu';
	// 	}
	// 	$select = 'a.*,b.*';
	// 	$tbl =  $table1.' a';
	// 	//JOIN
	// 	$join['data'][] = array(
	// 		'table' => $table1.'_akses b',
	// 		'join'	=> 'b.'.$table1.'_'.$id1.'=a.'.$id1,
	// 		'type'	=> 'inner'
	// 	);
	// 	//WHERE
	// 	$where['data'][] = array(
	// 		'column' => 'b.st_level_user_kode',
	// 		'param'	 => $this->session->userdata('level')
	// 	);
	// 	$where['data'][] = array(
	// 		'column' => 'a.'.$status1,
	// 		'param'	 => 1
	// 	);
	// 	$where['data'][] = array(
	// 		'column' => 'a.'.$id1,
	// 		'param'	 => $id
	// 	);
	// 	//ORDER
	// 	$order['data'][] = array(
	// 		'column' => 'a.index',
	// 		'type'	 => 'ASC'
	// 	);
	// 	$query = $this->mod->select($select,$tbl,NULL,NULL,$order,$join,$where);
	// 	foreach ($query->result() as $row) {
	// 		$data = array(
	// 			'c' => $row->c,
	// 			'r' => $row->r,
	// 			'u' => $row->u,
	// 			'd' => $row->d,
	// 		);
	// 	}
	// 	return $data;
	// }
	function cekUser($idmenu)
	{
		$select = '*';
		$tbl = 's_privilege';
		$where['data'][] = array(
			'column' => 'm_type_karyawan_id',
			'param'	 => $this->session->userdata('type_karyawan_id')
		);
		$where['data'][] = array(
			'column' => 'menu_id',
			'param'	 => $idmenu
		);
		$priv = $this->mod->select($select, $tbl, null, $where)->row_array();
		return $priv;
	}

	// Merge content to header and footer
	function open_page($file_name, $data=null){
		$select = 'a.*,b.*';
		$tbl = 's_menu a';
		//JOIN
		$join['data'][] = array(
			'table' => 's_privilege b',
			'join'	=> 'b.menu_id=a.menu_id',
			'type'	=> 'inner'
		);
		//WHERE
		$where['data'][] = array(
			'column' => 'b.m_type_karyawan_id',
			'param'	 => $this->session->userdata('type_karyawan_id')
		);
		$where['data'][] = array(
			'column' => 'a.menu_type',
			'param'	 => 0
		);
		$where['data'][] = array(
			'column' => 'b.read',
			'param'	 => 1
		);
		//ORDER
		$order['data'][] = array(
			'column' => 'a.menu_index',
			'type'	 => 'ASC'
		);
		$data['mainmenu'] = $this->mod->select($select, $tbl, $join, $where, NULL, NULL, $order, NULL);

		$select2 = 'a.*,b.*';
		$tbl2 = 's_menu a';
		//JOIN
		$join2['data'][] = array(
			'table' => 's_privilege b',
			'join'	=> 'b.menu_id=a.menu_id',
			'type'	=> 'inner'
		);
		//WHERE
		$where2['data'][] = array(
			'column' => 'b.m_type_karyawan_id',
			'param'	 => $this->session->userdata('type_karyawan_id')
		);
		$where2['data'][] = array(
			'column' => 'a.menu_type',
			'param'	 => 1
		);
		$where2['data'][] = array(
			'column' => 'b.read',
			'param'	 => 1
		);
		//ORDER
		$order2['data'][] = array(
			'column' => 'a.menu_index',
			'type'	 => 'ASC'
		);
		$data['submenu'] = $this->mod->select($select2, $tbl2, $join2, $where2, NULL, NULL, $order2, NULL);

		$this->load->view('layout/V_header', $data);
		$this->load->view($file_name);
	}

	// Format indonesian money
	function format_money_id($value){
		$format = "RP ".number_format($value,0,',','.');
		return $format;
	}

	// Format indonesian month
	function format_month_id($bln){
		$Bulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
		$result = $Bulan[(int)$bln-1];		
		return($result);
	}

	// Format Transaction Code
	function format_kode_transaksi($type, $query, $bln = NULL, $thn = NULL){
		if ($bln) {
			$bln = $bln;
		} else {
			$bln = date('m');
		}
		$thn = date('Y');
		if ($query<>false) {
			foreach ($query->result() as $row) {
				$urut = intval($row->id) + 1;
				$seq = sprintf("%05d",$urut);
			}
		} else {
			$seq = sprintf("%05d",1);
		}
		$kode_baru = $type.$thn.$bln.$seq;
		return $kode_baru;
	}

	function insert_kartu_stok($table,$data){
		$insert = $this->mod->insert_data_table($table, NULL, $data);
		if($insert->status) {
			$status = '200';
		} else {
			$status = '204';
		}
		return $status;
	}

	function replaceFormatNumber($value){
		$number = str_replace(',', '', $value);
		return $number;
	}	
	
	/* ====================================
		End General Function
	==================================== */
	
	/* ====================================
		Custom Function
	==================================== */
	
	/* ====================================
		End Custom Function
	==================================== */
}

/* End of file home.php */
/* Location: ./application/controllers/admin/home.php */
