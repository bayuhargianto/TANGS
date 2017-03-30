<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_pengembalian_barang extends MY_Controller {
	private $any_error = array();
	// Define Main Table
	public $tbl = 't_pengembalian_barang';

	public function __construct() {
        parent::__construct();
	}

	public function index(){
		// $this->view();
	}

	public function view($type){
		$this->check_session();
		if ($type == 1) {
			$priv = $this->cekUser(31);
			$data = array(
				'aplikasi'		=> $this->app_name,
				'title_page' 	=> 'Produksi',
				'title_page2' 	=> 'Pengembalian Barang',
				// 'priv_add'		=> $priv['create']
				);
			// if($priv['read'] == 1)
			// {
				$this->open_page('pengembalian-barang/V_pengembalian_barang', $data);
			// }
			// else
			// {
			// 	$this->load->view('layout/V_404', $data);
			// }
		} else if ($type == 2) {
			$data = array(
				'aplikasi'		=> $this->app_name,
				'title_page' 	=> 'Gudang',
				'title_page2' 	=> 'Pengembalian Barang',
			// 	'priv_add'		=> ''
				);

			$this->open_page('pengembalian-barang/V_pengembalian_barang2', $data);
		}		
	}

	public function loadData($type){
		// $priv = $this->cekUser(31);
		$select = '*';
		//LIMIT
		$limit = array(
			'start'  => $this->input->get('start'),
			'finish' => $this->input->get('length')
		);
		//WHERE LIKE
		$where_like['data'][] = array(
			'column' => 'cabang_nama, pengembalian_barang_nomor, pengembalian_barang_status_nama',
			'param'	 => $this->input->get('search[value]')
		);
		//ORDER
		$index_order = $this->input->get('order[0][column]');
		$order['data'][] = array(
			'column' => $this->input->get('columns['.$index_order.'][name]'),
			'type'	 => $this->input->get('order[0][dir]')
		);

		$query_total = $this->mod->select($select, 'v_pengembalian_barang');
		$query_filter = $this->mod->select($select, 'v_pengembalian_barang', NULL, NULL, NULL, $where_like, $order);
		$query = $this->mod->select($select, 'v_pengembalian_barang', NULL, NULL, NULL, $where_like, $order, $limit);

		$response['data'] = array();
		if ($query<>false) {
			$no = $limit['start']+1;
			foreach ($query->result() as $val) {

				if ($type == 1) {
					$button = '
					<a href="'.base_url().'Produksi/Pengembalian-Barang/Form/'.$val->pengembalian_barang_id.'">
					<button class="btn blue-ebonyclay" type="button" title="Lihat Pengembalian Barang">
						<i class="icon-eye text-center"></i>
					</button>
					</a>
					<a href="'.base_url().'Produksi/Pengembalian-Barang/print-Pengembalian-Barang/'.$val->pengembalian_barang_id.'">
					<button class="btn green-jungle" type="button" title="Print PDF">
						<i class="icon-printer text-center"></i>
					</button>
					</a>';
				} else if ($type == 2) {
					$button = '
					<a href="'.base_url().'Gudang/Pengembalian-Barang/Form/'.$val->pengembalian_barang_id.'">
					<button class="btn blue-ebonyclay" type="button" onclick="checkStatusPengembalian('.$val->pengembalian_barang_id.')"  title="Lihat Pengembalian Barang">
						<i class="icon-eye text-center"></i>
					</button>
					</a>
					<a href="'.base_url().'Gudang/Pengembalian-Barang/print-Pengembalian-Barang/'.$val->pengembalian_barang_id.'">
					<button class="btn green-jungle" type="button" title="Print PDF">
						<i class="icon-printer text-center"></i>
					</button>
					</a>';
				}

				$response['data'][] = array(
					$no,
					$val->cabang_nama,
					$val->pengembalian_barang_nomor,
					$val->pengembalian_barang_status_nama,
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

	public function getForm1($id = null){
		$data = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> 'Produksi',
			'title_page2' 	=> 'Pengembalian Barang',
			'id'			=> $id
		);
		$this->open_page('pengembalian-barang/V_form_pengembalian_barang', $data);
	}

	public function getForm2($id = null){
		$data = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> 'Gudang',
			'title_page2' 	=> 'Pengembalian Barang',
			'id'			=> $id
		);
		$this->open_page('pengembalian-barang/V_form_pengembalian_barang2', $data);
	}

	public function loadDataWhere(){
		$select = '*';
		$where['data'][] = array(
			'column' => 'pengembalian_barang_id',
			'param'	 => $this->input->get('id')
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where);
		if ($query<>false) {

			foreach ($query->result() as $val) {
				// CARI DETAIL
				// $join['data'][] = array(
				// 	'table' => 't_jadwal_produksidet b',
				// 	'join'	=> 'b.jadwal_produksidet_id = a.t_jadwal_produksidet_id',
				// 	'type' 	=> 'left'
				// );
				$join['data'][] = array(
					'table' => 'm_barang d',
					'join'	=> 'd.barang_id = a.m_barang_id',
					'type' 	=> 'left'
				);
				$join['data'][] = array(
					'table' => 'm_satuan b',
					'join'	=> 'b.satuan_id = d.m_satuan_id',
					'type' 	=> 'left'
				);
				$where_det['data'][] = array(
					'column' => 't_pengembalian_barang_id',
					'param'	 => $val->pengembalian_barang_id
				);
				$query_det = $this->mod->select('a.*, b.satuan_nama, d.barang_kode, d.barang_nama', 't_pengembalian_barangdet a', $join, $where_det);
				$response['val2'] = array();
				if ($query_det) {
					foreach ($query_det->result() as $val2) {
						$response['val2'][] = array(
							// 'jadwal_produksi_nomor'					=> $val2->jadwal_produksi_nomor,
							// 't_jadwal_produksidet_id'				=> $val2->t_jadwal_produksidet_id,
							'pengembalian_barangdet_id'				=> $val2->pengembalian_barangdet_id,
							't_pengembalian_barang_id'				=> $val2->t_pengembalian_barang_id,
							'barang_kode'							=> $val2->barang_kode,
							'barang_nama'							=> $val2->barang_nama,
							'satuan_nama'							=> $val2->satuan_nama,
							'pengembalian_barangdet_qty'			=> $val2->pengembalian_barangdet_qty,
							'pengembalian_barangdet_keterangan'		=> $val2->pengembalian_barangdet_keterangan,
						);
					}
				}

				// NO ORDER
				// $where1['data'][] = array(
				// 	'column' => 'jadwal_produksi_id',
				// 	'param'	 => $val->t_jadwal_produksi_id
				// );
				// $query1 = $this->mod->select('*', 't_jadwal_produksi', NULL, $where1);
				// $hasil1['val2'] = array();
				// $hasil2 = '';
				// $hasil3 = '';
				// if ($query1) {
				// 	foreach ($query1->result() as $val2) {
				// 		$hasil1['val2'][] = array(
				// 			'id' 	=> $val2->jadwal_produksi_id,
				// 			'text' 	=> $val2->jadwal_produksi_nomor
				// 		);
				// 		$hasil2 = $val2->jadwal_produksi_shift;
				// 		$hasil3 = $val2->jadwal_produksi_jenis;
				// 	}
				// }

				$where_awal['data'][] = array(
					'column' => 'gudang_id',
					'param'	 => $val->pengembalian_barang_awal
				);
				$query_awal = $this->mod->select('*', 'm_gudang', NULL, $where_awal);
				$hasil1['val2'] = array();
				if ($query_awal) {
					foreach ($query_awal->result() as $val2) {
						$hasil1['val2'][] = array(
							'id' 	=> $val2->gudang_id,
							'text' 	=> $val2->gudang_nama
						);
					}
				}

				$where_akhir['data'][] = array(
					'column' => 'gudang_id',
					'param'	 => $val->pengembalian_barang_awal
				);
				$query_akhir = $this->mod->select('*', 'm_gudang', NULL, $where_akhir);
				$hasil2['val2'] = array();
				if ($query_akhir) {
					foreach ($query_akhir->result() as $val2) {
						$hasil2['val2'][] = array(
							'id' 	=> $val2->gudang_id,
							'text' 	=> $val2->gudang_nama
						);
					}
				}

				$response['val'][] = array(
					'kode' 								=> $val->pengembalian_barang_id,
					'pengembalian_barang_nomor' 		=> $val->pengembalian_barang_nomor,
					'pengembalian_barang_awal' 			=> $hasil1,
					'pengembalian_barang_tujuan' 		=> $hasil2,
					'pengembalian_barang_status'		=> $val->pengembalian_barang_status,
					'pengembalian_barang_created_date'	=> date('d/m/Y', strtotime($val->pengembalian_barang_created_date)),
				);
			}

			echo json_encode($response);
		}
	}

	public function checkStatus(){
		$id = $this->input->get('id');
		$select = '*';
		$where['data'][] = array(
			'column' => 'pengembalian_barang_id',
			'param'	 => $id
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where);
		if ($query<>false) {
			foreach ($query->result() as $row) {
				if ($row->pengembalian_barang_status == 1) {
					$data = $this->general_post_data(3, $id);
					$where['data'][] = array(
						'column' => 'pengembalian_barang_id',
						'param'	 => $id
					);
					$update = $this->mod->update_data_table($this->tbl, $where, $data);
					// INSERT LOG);
					$data_log = array(
						'referensi_id' 									=> $id,
						'pengembalian_baranglog_status_dari' 			=> 1,
						'pengembalian_baranglog_status_ke' 				=> 2,
						'pengembalian_baranglog_status_update_date' 	=> date('Y-m-d H:i:s'),
						'pengembalian_baranglog_status_update_by'		=> $this->session->userdata('user_username'),
					);
					$insert_log = $this->mod->insert_data_table('t_pengembalian_baranglog', NULL, $data_log);

					// CARI DETAIL
					$join['data'][] = array(
						'table' => 't_pengembalian_barang b',
						'join'	=> 'b.pengembalian_barang_id = a.t_pengembalian_barang_id',
						'type' 	=> 'left'
					);
					$where_det['data'][] = array(
						'column' => 'a.t_pengembalian_barang_id',
						'param'	 => $id
					);
					$query_det = $this->mod->select('a.*, b.*', 't_pengembalian_barangdet a', $join, $where_det);
					
					if ($query_det<>false) {
						foreach ($query_det->result() as $val2) {
							// PENGURANGAN STOK GUDANG
							if (@$where_gudang['data']) {
								unset($where_gudang['data']);
							}
							$where_gudang['data'][] = array(
								'column' => 'm_barang_id',
								'param'	 => $val2->m_barang_id
							);
							$where_gudang['data'][] = array(
								'column' => 'm_gudang_id',
								'param'	 => $val2->pengembalian_barang_awal
							);
							$query_gudang = $this->mod->select('*', 't_stok_gudang', NULL, $where_gudang);
							foreach ($query_gudang->result() as $rowStok) {
								// PENGURANGAN KARTU STOK
								if (@$dataKStok['data']) {
									unset($dataKStok['data']);
								}
								$dataKStok = array(
									'm_gudang_id' 				=> $val2->pengembalian_barang_awal,
									'm_barang_id' 				=> $val2->m_barang_id,
									'kartu_stok_tanggal' 		=> date('Y-m-d H:i:s'),
									'kartu_stok_referensi' 		=> $val2->pengembalian_barang_nomor,
									'kartu_stok_saldo' 			=> $rowStok->stok_gudang_jumlah,
									'kartu_stok_masuk' 			=> 0,
									'kartu_stok_keluar' 		=> $val2->pengembalian_barangdet_qty,
									'kartu_stok_penyesuaian'	=> 0,
									'kartu_stok_keterangan' 	=> "Pengembalian Barang Produksi",
									'kartu_stok_created_date'	=> date('Y-m-d H:i:s'),
									'kartu_stok_created_by' 	=> $this->session->userdata('user_username'),
									'kartu_stok_revised' 		=> 0,
								);
								// END PENGURANGAN KARTU STOK
								$insertKStok = $this->mod->insert_data_table('t_kartu_stok', NULL, $dataKStok);
								if (@$whereStok['data']) {
									unset($whereStok['data']);
								}
								if (@$dataStok['data']) {
									unset($dataStok['data']);
								}
								$whereStok['data'][] = array(
									'column' => 'stok_gudang_id',
									'param'	 => $rowStok->stok_gudang_id
								);
								$dataStok = array(
									'stok_gudang_jumlah' 		=> $rowStok->stok_gudang_jumlah - $val2->pengembalian_barangdet_qty,
									'stok_gudang_update_date'	=> date('Y-m-d H:i:s'),
									'stok_gudang_update_by'		=> $this->session->userdata('user_username'),
									'stok_gudang_revised' 		=> $rowStok->stok_gudang_revised + 1,
								);
								$updateStok = $this->mod->update_data_table('t_stok_gudang', $whereStok, $dataStok);
							}
							// END PENGURANGAN STOK GUDANG

							// PENAMBAHAN STOK GUDANG
							if (@$where_gudang2['data']) {
								unset($where_gudang2['data']);
							}
							$where_gudang2['data'][] = array(
								'column' => 'm_barang_id',
								'param'	 => $val2->m_barang_id
							);
							$where_gudang2['data'][] = array(
								'column' => 'm_gudang_id',
								'param'	 => $val2->pengembalian_barang_tujuan
							);
							$query_gudang2 = $this->mod->select('*', 't_stok_gudang', NULL, $where_gudang2);
							if($query_gudang2)
							{
								foreach ($query_gudang2->result() as $rowStok) {
									// PENAMBAHAN KARTU STOK
									if (@$dataKStok['data']) {
										unset($dataKStok['data']);
									}
									$dataKStok2 = array(
										'm_gudang_id' 				=> $val2->pengembalian_barang_tujuan,
										'm_barang_id' 				=> $val2->m_barang_id,
										'kartu_stok_tanggal' 		=> date('Y-m-d H:i:s'),
										'kartu_stok_referensi' 		=> $val2->pengembalian_barang_nomor,
										'kartu_stok_saldo' 			=> $rowStok->stok_gudang_jumlah,
										'kartu_stok_masuk' 			=> $val2->pengembalian_barangdet_qty,
										'kartu_stok_keluar' 		=> 0,
										'kartu_stok_penyesuaian'	=> 0,
										'kartu_stok_keterangan' 	=> "Pengembalian Barang Produksi",
										'kartu_stok_created_date'	=> date('Y-m-d H:i:s'),
										'kartu_stok_created_by' 	=> $this->session->userdata('user_username'),
										'kartu_stok_revised' 		=> 0,
									);
									// END PENAMBAHAN KARTU STOK
									$insertKStok2 = $this->mod->insert_data_table('t_kartu_stok', NULL, $dataKStok2);
									if (@$whereStok['data']) {
										unset($whereStok['data']);
									}
									if (@$dataStok['data']) {
										unset($dataStok['data']);
									}
									$whereStok2['data'][] = array(
										'column' => 'stok_gudang_id',
										'param'	 => $val2->pengembalian_barang_tujuan
									);
									$dataStok2 = array(
										'stok_gudang_jumlah' 		=> $rowStok->stok_gudang_jumlah + $pengembalian_barangdet_qty,
										'stok_gudang_update_date'	=> date('Y-m-d H:i:s'),
										'stok_gudang_update_by'		=> $this->session->userdata('user_username'),
										'stok_gudang_revised' 		=> $rowStok->stok_gudang_revised + 1,
									);
									$updateStok2 = $this->mod->update_data_table('t_stok_gudang', $whereStok2, $dataStok2);
								}
								// END PENAMBAHAN STOK GUDANG
							}
							else
							{
								if (@$dataStok2['data']) {
									unset($dataStok2['data']);
								}
								// $response['val2'] = 'masuk insert';
								$dataStok2 = array(
									'm_gudang_id'				=> $val2->pengembalian_barang_tujuan,
									'm_barang_id'				=> $val2->m_barang_id,
									'stok_gudang_jumlah' 		=> $val2->pengembalian_barangdet_qty,
									'stok_gudang_created_date'	=> date('Y-m-d H:i:s'),
									'stok_gudang_created_by'	=> $this->session->userdata('user_username'),
									'stok_gudang_revised' 		=> 0,
								);
								$insertStok2 = $this->mod->insert_data_table('t_stok_gudang', NULL, $dataStok2);
								if (@$dataKStok2['data']) {
									unset($dataKStok2['data']);
								}
								$dataKStok2 = array(
									'm_gudang_id' 				=> $val2->pengembalian_barang_tujuan,
									'm_barang_id' 				=> $val2->m_barang_id,
									'kartu_stok_tanggal' 		=> date('Y-m-d H:i:s'),
									'kartu_stok_referensi' 		=> $val2->pengembalian_barang_nomor,
									'kartu_stok_saldo' 			=> 0,
									'kartu_stok_masuk' 			=> $val2->pengembalian_barangdet_qty,
									'kartu_stok_keluar' 		=> 0,
									'kartu_stok_penyesuaian'	=> 0,
									'kartu_stok_keterangan' 	=> "Pengembalian Barang Produksi",
									'kartu_stok_created_date'	=> date('Y-m-d H:i:s'),
									'kartu_stok_created_by' 	=> $this->session->userdata('user_username'),
									'kartu_stok_revised' 		=> 0,
								);
								// END PENAMBAHAN KARTU STOK
								$insertKStok2 = $this->mod->insert_data_table('t_kartu_stok', NULL, $dataKStok2);
							}
							
						}
					}

					$response['status'] = '200';
				} else {
					$response['status'] = '204';
				}
			}
		} else {
			$response['status'] = '204';
		}
		echo json_encode($response);
	}

	// public function loadData_select(){
	// 	$param = $this->input->get('q');
	// 	if ($param!=NULL) {
	// 		$param = $this->input->get('q');
	// 	} else {
	// 		$param = "";
	// 	}
	// 	$select = '*';
	// 	$where['data'][] = array(
	// 		'column' => 'ketidaksesuaian_spesifikasi_status <',
	// 		'param'	 => 3
	// 	);
	// 	$where_like['data'][] = array(
	// 		'column' => 'ketidaksesuaian_spesifikasi_nomor',
	// 		'param'	 => $this->input->get('q')
	// 	);
	// 	$order['data'][] = array(
	// 		'column' => 'ketidaksesuaian_spesifikasi_nomor',
	// 		'type'	 => 'ASC'
	// 	);
	// 	$query = $this->mod->select($select, $this->tbl, NULL, $where, NULL, $where_like, $order);
	// 	$response['items'] = array();
	// 	if ($query<>false) {
	// 		foreach ($query->result() as $val) {
	// 			$response['items'][] = array(
	// 				'id'	=> $val->ketidaksesuaian_spesifikasi_id,
	// 				'text'	=> $val->ketidaksesuaian_spesifikasi_nomor
	// 			);
	// 		}
	// 		$response['status'] = '200';
	// 	}

	// 	echo json_encode($response);
	// }

	// Function Insert & Update
	public function postData($type){
		$id = $this->input->post('kode');
		$response['test'] = $type;
		if (strlen($id)>0) {
			// if ($type == 2) {
			// 	//UPDATE
			// 	$data = $this->general_post_data(2, $id);
			// 	$where['data'][] = array(
			// 		'column' => 'ketidaksesuaian_spesifikasi_id',
			// 		'param'	 => $id
			// 	);
			// 	$update = $this->mod->update_data_table($this->tbl, $where, $data);
			// 	if($update->status) {
			// 		$response['status'] = '200';
			// 		// INSERT DETAIL
			// 		for ($i = 0; $i < sizeof($this->input->post('ketidaksesuaian_spesifikasidet_id', TRUE)); $i++) {
			// 			$data_det = $this->general_post_data2(2, $id, $i, $this->input->post('ketidaksesuaian_spesifikasidet_id', TRUE)[$i]);
			// 			if (@$where_det['data']) {
			// 				unset($where_det['data']);
			// 			}
			// 			$where_det['data'][] = array(
			// 				'column' => 'ketidaksesuaian_spesifikasidet_id',
			// 				'param'	 => $this->input->post('ketidaksesuaian_spesifikasidet_id', TRUE)[$i]
			// 			);
			// 			$update_det = $this->mod->update_data_table('t_ketidaksesuaian_spesifikasidet', $where_det, $data_det);
			// 			if($update_det->status) {
			// 				$response['status'] = '200';
			// 			} else {
			// 				$response['status'] = '204';
			// 			}
			// 		}
			// 	} else {
			// 		$response['status'] = '204';
			// 	}
			// }
		} else {
			//INSERT
			$data = $this->general_post_data(1);
			$insert = $this->mod->insert_data_table($this->tbl, NULL, $data);
			if($insert->status) {
				$response['status'] = '200';
				// INSERT DETAIL
				for ($i = 0; $i < sizeof($this->input->post('barang_id', TRUE)); $i++) {
					$data_det = $this->general_post_data2(1, $insert->output, $i);
					$insert_det = $this->mod->insert_data_table('t_pengembalian_barangdet', NULL, $data_det);
					if($insert_det->status) {
						$response['status'] = '200';
					} else {
						$response['status'] = '204';
					}
				}
			} else {
				$response['status'] = '204';
			}
		}
		
		echo json_encode($response);
	}

	public function cetakPDF($id)
	{
		$this->load->library('pdf');
		$name = '';
		$select = 't_pengembalian_barang.*, b.pengembalian_baranglog_status_update_by';
		$join_log['data'][] = array(
			'table' => 't_pengembalian_baranglog b',
			'join'	=> 'b.referensi_id = t_pengembalian_barang.pengembalian_barang_id',
			'type' 	=> 'left'
		);
		$where['data'][] = array(
			'column' => 'pengembalian_barang_id',
			'param'	 => $id
		);
		$query = $this->mod->select($select, $this->tbl, $join_log, $where);
		if ($query<>false) {

			foreach ($query->result() as $val) {
				$join['data'][] = array(
					'table' => 'm_barang d',
					'join'	=> 'd.barang_id = a.m_barang_id',
					'type' 	=> 'left'
				);
				$join['data'][] = array(
					'table' => 'm_satuan b',
					'join'	=> 'b.satuan_id = d.m_satuan_id',
					'type' 	=> 'left'
				);
				$join['data'][] = array(
					'table' => 'm_jenis_barang c',
					'join'	=> 'c.jenis_barang_id = d.m_jenis_barang_id',
					'type' 	=> 'left'
				);
				$where_det['data'][] = array(
					'column' => 't_pengembalian_barang_id',
					'param'	 => $val->pengembalian_barang_id
				);
				$query_det = $this->mod->select('a.*, b.satuan_nama, c.jenis_barang_nama, d.barang_kode, d.barang_nama', 't_pengembalian_barangdet a', $join, $where_det);
				$response['val2'] = array();
				if ($query_det) {
					foreach ($query_det->result() as $val2) {
						$response['val2'][] = array(
							// 'jadwal_produksi_nomor'					=> $val2->jadwal_produksi_nomor,
							// 't_jadwal_produksidet_id'				=> $val2->t_jadwal_produksidet_id,
							'pengembalian_barangdet_id'				=> $val2->pengembalian_barangdet_id,
							't_pengembalian_barang_id'				=> $val2->t_pengembalian_barang_id,
							'barang_kode'							=> $val2->barang_kode,
							'barang_nama'							=> $val2->barang_nama,
							'jenis_barang_nama'						=> $val2->jenis_barang_nama,
							'satuan_nama'							=> $val2->satuan_nama,
							'pengembalian_barangdet_qty'			=> $val2->pengembalian_barangdet_qty,
							'pengembalian_barangdet_keterangan'		=> $val2->pengembalian_barangdet_keterangan,
						);
					}
				}
				// END CARI DETAIL
				// CARI PENYETUJU
				// $hasil4['val2'] = array();
				// $where_penyetuju['data'][] = array(
				// 	'column' => 'karyawan_id',
				// 	'param'	 => $val->ketidaksesuaian_spesifikasi_penyetuju
				// );
				// $query_penyetuju = $this->mod->select('*','m_karyawan',NULL,$where_penyetuju);
				// if ($query_penyetuju) {
				// 	foreach ($query_penyetuju->result() as $val2) {
				// 		$hasil4['val2'][] = array(
				// 			'id' 	=> $val2->karyawan_id,
				// 			'text' 	=> $val2->karyawan_nama
				// 		);
				// 	}
				// }
				// END CARI PENYETUJU
				// CARI PENERIMA
				// $hasil5['val2'] = array();
				// $where_penerima['data'][] = array(
				// 	'column' => 'karyawan_id',
				// 	'param'	 => $val->ketidaksesuaian_spesifikasi_pemeriksa
				// );
				// $query_penerima = $this->mod->select('*','m_karyawan',NULL,$where_penerima);
				// if ($query_penerima) {
				// 	foreach ($query_penerima->result() as $val2) {
				// 		$hasil5['val2'][] = array(
				// 			'id' 	=> $val2->karyawan_id,
				// 			'text' 	=> $val2->karyawan_nama
				// 		);
				// 	}
				// }
				// END CARI PENERIMA
				// CARI OPERATOR
				$hasil1['val2'] = array();
				$where_awal['data'][] = array(
					'column' => 'gudang_id',
					'param'	 => $val->pengembalian_barang_awal
				);
				$query_awal = $this->mod->select('*','m_gudang',null,$where_awal);
				if ($query_awal) {
					foreach ($query_awal->result() as $val3) {
						$hasil1['val2'][] = array(
							'id' 		=> $val3->gudang_id,
							'text' 		=> $val3->gudang_nama
						);
					}
				}
				// END CARI OPERATOR
				// CARI JADWAL PRODUKSI
				$hasil2['val2'] = array();
				$where_tujuan['data'][] = array(
					'column' => 'gudang_id',
					'param'	 => $val->pengembalian_barang_tujuan
				);
				$query_tujuan = $this->mod->select('*','m_gudang',null,$where_tujuan);
				if ($query_tujuan) {
					foreach ($query_tujuan->result() as $val3) {
						$hasil2['val2'][] = array(
							'id' 		=> $val3->gudang_id,
							'text' 		=> $val3->gudang_nama
						);
					}
				}
				// END CARI JADWAL PRODUKSI
				// CARI CABANG
				$hasil7['val2'] = array();
				$where_cabang['data'][] = array(
					'column' => 'cabang_id',
					'param'	 => $val->m_cabang_id
				);
				$query_cabang = $this->mod->select('*','m_cabang',NULL,$where_cabang);
				if ($query_cabang) {
					foreach ($query_cabang->result() as $val2) {
						// CARI KOTA
						$hasil8['val2'] = array();
						$where_kota['data'][] = array(
							'column' => 'id',
							'param'	 => $val2->cabang_kota
						);
						$query_kota = $this->mod->select('*','regencies',NULL,$where_kota);
						if ($query_kota) {
							foreach ($query_kota->result() as $val3) {
								$hasil8['val3'][] = array(
									'id' 		=> $val3->id,
									'text' 		=> $val3->name,
								);
							}
						}
						// END CARI KOTA
						$hasil7['val2'][] = array(
							'id' 	=> $val2->cabang_id,
							'text' 	=> $val2->cabang_nama,
							'alamat'=> $val2->cabang_alamat,
							'kota'	=> $hasil8,
							'telp'  => json_decode($val2->cabang_telepon)
						);
					}
				}
				$name = $val->pengembalian_barang_nomor;
				// END CARI CABANG
				$response['val'][] = array(
					'kode' 									=> $val->pengembalian_barang_id,
					'pengembalian_barang_nomor' 			=> $val->pengembalian_barang_nomor,
					'pengembalian_barang_awal'				=> $hasil1,
					'pengembalian_barang_tujuan' 			=> $hasil2,
					// 'ketidaksesuaian_spesifikasi_ppn' 		=> $val->ketidaksesuaian_spesifikasi_ppn,
					'pengembalian_barang_tanggal'			=> date("d/m/Y",strtotime($val->pengembalian_barang_created_date)),
					// 'pengembalian_barang_hari'				=> date("D",strtotime($val->pengembalian_barang_created_date)),
					// 'ketidaksesuaian_spesifikasi_catatan' 	=> $val->ketidaksesuaian_spesifikasi_catatan,
					// 'ketidaksesuaian_spesifikasi_status' 	=> $val->ketidaksesuaian_spesifikasi_status,
					// 'ketidaksesuaian_spesifikasi_penyetuju' 				=> $hasil4,
					'pengembalian_barang_penerima'		=> $val->pengembalian_baranglog_status_update_by,
					'pengembalian_barang_created_by' 	=> $val->pengembalian_barang_created_by,
					// 'ketidaksesuaian_spesifikasi_operator' 	=> $hasil6,
					'cabang'								=> $hasil7
				);
			}
		}
		$response['title'][] = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> 'Pengembalian Barang',
			'title_page2' 	=> 'Print Pengembalian Barang',
		);
		// echo json_encode($response);
		// $this->pdf->set_paper('A4', 'landscape');
		$this->pdf->load_view('print/P_pengembalian_barang', $response);
		$this->pdf->render();
		$this->pdf->stream($name,array("Attachment"=>false));
	}

	/* Saving $data as array to database */
	function general_post_data($type, $id = null){
		// 1 Insert, 2 Update, 3 Delete / Non Aktif
		// $arrDate = explode('/', $this->input->post('pengembalian_barang_tanggal', TRUE));
		$where['data'][] = array(
			'column' => 'pengembalian_barang_id',
			'param'	 => $id
		);
		$queryRevised = $this->mod->select('pengembalian_barang_revised', $this->tbl, NULL, $where);
		if ($queryRevised) {
			$revised = $queryRevised->row_array();
			$rev = $revised['pengembalian_barang_revised'] + 1;
		}
		if ($type == 1) {
			$pengembalian_barang_nomor = $this->get_kode_transaksi();
			$data = array(
				'm_cabang_id' 							=> $this->session->userdata('cabang_id'),
				'pengembalian_barang_nomor' 			=> $pengembalian_barang_nomor,
				'pengembalian_barang_awal' 				=> $this->input->post('pengembalian_barang_awal', TRUE),
				'pengembalian_barang_tujuan'			=> $this->input->post('pengembalian_barang_tujuan', TRUE),
				'pengembalian_barang_status'			=> 1,
				'pengembalian_barang_created_date'		=> date('Y-m-d H:i:s'),
				'pengembalian_barang_update_date'		=> date('Y-m-d H:i:s'),
				'pengembalian_barang_created_by'		=> $this->session->userdata('user_username'),
				'pengembalian_barang_revised' 			=> 0,
			);
		} else if ($type == 2) {
			// $data = array(
			// 	'ketidaksesuaian_spesifikasi_status' 		=> 3,
			// 	'ketidaksesuaian_spesifikasi_subtotal'	=> $this->input->post('ketidaksesuaian_spesifikasi_subtotal', TRUE),
			// 	'ketidaksesuaian_spesifikasi_ppn' 		=> $this->input->post('ketidaksesuaian_spesifikasi_ppn', TRUE),
			// 	'ketidaksesuaian_spesifikasi_total' 		=> $this->input->post('ketidaksesuaian_spesifikasi_total', TRUE),
			// 	'ketidaksesuaian_spesifikasi_update_date'	=> date('Y-m-d H:i:s'),
			// 	'ketidaksesuaian_spesifikasi_update_by'	=> $this->session->userdata('user_username'),
			// 	'ketidaksesuaian_spesifikasi_revised' 	=> $rev,
			// );
		} else if ($type == 3) {
			$data = array(
				'pengembalian_barang_status'			=> 2,
				// 'pengembalian_barang_status_date'	=> date('Y-m-d H:i:s'),
				'pengembalian_barang_update_date'		=> date('Y-m-d H:i:s'),
				'pengembalian_barang_update_by'			=> $this->session->userdata('user_username'),
				'pengembalian_barang_revised' 			=> $rev,
			);
		} 

		return $data;
	}

	function general_post_data2($type, $idHdr, $seq, $id = null){
		// 1 Insert, 2 Update, 3 Delete / Non Aktif
		if ($type == 1) {
			$data = array(
				't_pengembalian_barang_id' 				=> $idHdr,
				'm_barang_id'							=> $this->input->post('barang_id', TRUE)[$seq],
				'pengembalian_barangdet_qty' 			=> $this->input->post('pengembalian_barangdet_qty', TRUE)[$seq],
				'pengembalian_barangdet_keterangan' 	=> $this->input->post('pengembalian_barangdet_keterangan', TRUE)[$seq],
			);	
		} else if ($type == 2) {
			// $data = array(
			// 	't_ketidaksesuaian_spesifikasi_id' 			=> $idHdr,
			// 	'm_barang_id' 						=> $this->input->post('m_barang_id', TRUE)[$seq],
			// 	'ketidaksesuaian_spesifikasidet_harga_satuan' => $this->input->post('ketidaksesuaian_spesifikasidet_harga_satuan', TRUE)[$seq],
			// 	'ketidaksesuaian_spesifikasidet_potongan' 	=> $this->input->post('ketidaksesuaian_spesifikasidet_potongan', TRUE)[$seq],
			// 	'ketidaksesuaian_spesifikasidet_total'		=> $this->input->post('ketidaksesuaian_spesifikasidet_total', TRUE)[$seq],
			// 	'ketidaksesuaian_spesifikasidet_keterangan'	=> $this->input->post('ketidaksesuaian_spesifikasidet_keterangan', TRUE)[$seq],
			// 	'ketidaksesuaian_spesifikasidet_update_by'	=> $this->session->userdata('user_username'),
			// 	'ketidaksesuaian_spesifikasidet_update_date'	=> date('Y-m-d H:i:s'),
			// 	'ketidaksesuaian_spesifikasidet_revised' 		=> $rev,
			// );
		}

		return $data;
	}

	function get_kode_transaksi(){
		$bln = date('m');
		$thn = date('Y');
		$select = 'MID(pengembalian_barang_nomor,10,5) as id';
		$where['data'][] = array(
			'column' => 'MID(pengembalian_barang_nomor,1,9)',
			'param'	 => 'PBRG'.$thn.''.$bln
		);
		$order['data'][] = array(
			'column' => 'pengembalian_barang_nomor',
			'type'	 => 'DESC'
		);
		$limit = array(
			'start'  => 0,
			'finish' => 1
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where, NULL, NULL, $order, $limit);
		$kode_baru = $this->format_kode_transaksi('PBRG',$query,$bln);
		return $kode_baru;
	}
	/* end Function */

}
