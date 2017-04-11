<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_barang extends MY_Controller {
	private $any_error = array();
	// Define Main Table
	public $tbl = 'm_barang';

	public function __construct() {
        parent::__construct();
        $this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
	}

	public function index(){
		$this->view();
	}

	public function view(){
		$this->check_session();
		$priv = $this->cekUser(9);
		$data = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> 'Barang',
			'title_page2' 	=> 'Master Barang',
			'priv_add'		=> $priv['create'],
			);
		if($priv['read'] == 1)
		{
			$this->open_page('barang/V_barang', $data);
		}
		else
		{
			$this->load->view('layout/V_404', $data);
		}
	}

	public function loadData(){
		$priv = $this->cekUser(9);
		$select = '*';
		//LIMIT
		$limit = array(
			'start'  => $this->input->get('start'),
			'finish' => $this->input->get('length')
		);
		//WHERE LIKE
		$where_like['data'][] = array(
			'column' => 'barang_kode, barang_nama, jenis_barang_nama, barang_minimum_stok, satuan_nama, barang_status_aktif',
			'param'	 => $this->input->get('search[value]')
		);
		//ORDER
		$index_order = $this->input->get('order[0][column]');
		$order['data'][] = array(
			'column' => $this->input->get('columns['.$index_order.'][name]'),
			'type'	 => $this->input->get('order[0][dir]')
		);

		$query_total = $this->mod->select($select, 'v_barang');
		$query_filter = $this->mod->select($select, 'v_barang', NULL, NULL, NULL, $where_like, $order);
		$query = $this->mod->select($select, 'v_barang', NULL, NULL, NULL, $where_like, $order, $limit);

		$response['data'] = array();
		if ($query<>false) {
			$no = $limit['start']+1;
			
			foreach ($query->result() as $val) {
				$button = '';
				if ($val->barang_status_aktif == 'y') {
					$status = '<span class="label bg-green-jungle bg-font-green-jungle"> Aktif </span>';
					if($priv['update'] == 1)
					{
						$button = $button.'<button class="btn blue-ebonyclay" type="button" onclick="openFormBarang('.$val->barang_id.')" title="Edit" data-toggle="modal" href="#modaladd">
											<i class="icon-pencil text-center"></i>
										</button>
								<button class="btn blue-soft" type="button" onclick="openFormValueBarang('.$val->barang_id.')" title="Edit Value" data-toggle="modal" href="#modaladd">
									<i class="icon-notebook text-center"></i>
								</button>';
					}
					if($priv['delete'] == 1)
					{
						$button = $button.'
									<button class="btn red-thunderbird" type="button" onclick="deleteData('.$val->barang_id.')" title="Non Aktifkan">
							<i class="icon-power text-center"></i>
						</button>';
					}
					
				} else {
					$status = '<span class="label bg-red-thunderbird bg-font-red-thunderbird"> Non Aktif </span>';
					if($priv['update'] == 1)
					{
						$button = $button.'<button class="btn blue-ebonyclay" type="button" onclick="openFormBarang('.$val->barang_id.')" title="Edit" data-toggle="modal" href="#modaladd" disabled>
											<i class="icon-pencil text-center"></i>
										</button>
								<button class="btn blue-soft" type="button" onclick="openFormValueBarang('.$val->barang_id.')" title="Edit Value" data-toggle="modal" href="#modaladd" disabled>
									<i class="icon-notebook text-center"></i>
								</button>';

					}
					if($priv['delete'] == 1)
					{
						$button = $button.'<button class="btn green-jungle" type="button" onclick="aktifData('.$val->barang_id.')" title="Aktifkan">
						<i class="icon-power text-center"></i>
						</button>';
					}
					
				}
				$response['data'][] = array(
					$no,
					$val->barang_kode,
					$val->barang_nama,
					$val->jenis_barang_nama,
					number_format($val->barang_minimum_stok, 2, ',', '.'),
					$val->satuan_nama,
					$status,
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

	public function import(){
		ini_set('max_execution_time', 3600);
		if(!isset($_FILES['file'])){
			echo 'PLEASE CHECK AGAIN';
		}else{
			$fileName = str_replace(" ", "_", time().$_FILES['file']['name']);
		 
			$config['upload_path'] = './assets/upload/'; //buat folder dengan nama assets di root folder
			$config['file_name'] = $fileName;
			$config['allowed_types'] = 'xls|xlsx|csv';
			$config['max_size'] = 10000;
			 
			$this->load->library('upload');
			$this->upload->initialize($config);
			 
			if(! $this->upload->do_upload('file') )
			$this->upload->display_errors();
			     
			$media = $this->upload->data('file');
			$inputFileName = './assets/upload/'.$config['file_name'];

			try {
			    $inputFileType = IOFactory::identify($inputFileName);
			    $objReader = IOFactory::createReader($inputFileType);
			    $objPHPExcel = $objReader->load($inputFileName);
			} catch(Exception $e) {
			    die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
			}

			$sheet = $objPHPExcel->getSheet(0);
			$highestRow = $sheet->getHighestRow();
			$highestColumn = $sheet->getHighestColumn();
			 
			for ($row = 2; $row <= $highestRow; $row++){                  //  Read a row of data into an array                 
			    $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
			                                    NULL,
			                                    TRUE,
			                                    FALSE);

			     $data = array(
			 		"barang_id"				=> $this->db->escape_str($rowData[0][0]),
			        "m_jenis_barang_id"		=> $this->db->escape_str($rowData[0][1]),
			        "m_kategori_id"			=> $this->db->escape_str($rowData[0][2]),
			        "barang_kode"			=> ' ',
			        "barang_nomor"			=> ' ',
			        "barang_nama"			=> $this->db->escape_str($rowData[0][5]),
			        "brand_id"				=> $this->db->escape_str($rowData[0][6]),
			        "harga_beli"			=> $this->db->escape_str($rowData[0][7]),
			        "harga_jual"			=> $this->db->escape_str($rowData[0][8]),
			        "harga_jual_pajak"		=> $this->db->escape_str($rowData[0][9]),
			        "m_satuan_id"			=> ' ',
			        "barang_minimum_stok"	=> ' ',
			        "barang_status_aktif"	=> 'y',
			        "barang_create_date"	=> date('Y-m-d H:i:s'),
			        "barang_create_by"		=> $this->session->userdata('user_username'),
			        "barang_update_date"	=> date('Y-m-d H:i:s'),
			        "barang_update_by"		=> $this->session->userdata('user_username'),
			        "barang_revised"		=> 0
			    );
			     
			    $insert = $this->db->query("insert ignore into m_barang values('".implode("', '", $data)."')");
			    delete_files('./assets/');
			}
			redirect('Master-Data/Barang');
		}
	}

	public function getForm(){
 		$this->load->view("barang/V_form_barang");
	}

	public function getFormValue(){
 		$this->load->view("value-barang/V_form_value_barang");
	}

	public function loadDataWhere(){
		$harga_jual = 0;
		$harga_beli = 0;

		$select = '*';
		$where['data'][] = array(
			'column' => 'barang_id',
			'param'	 => $this->input->get('id')
		);

		$query = $this->mod->select($select, $this->tbl, NULL, $where);
		if ($query<>false) {

			foreach ($query->result() as $val) {
				// CARI JENIS BARANG
				$hasil1['val2'] = array();
				$where_type['data'][] = array(
					'column' => 'jenis_barang_id',
					'param'	 => $val->m_jenis_barang_id
				);
				$query_type = $this->mod->select('*','m_jenis_barang',NULL,$where_type);
				foreach ($query_type->result() as $val2) {
					$hasil1['val2'][] = array(
						'id' 	=> $val2->jenis_barang_id,
						'text' 	=> $val2->jenis_barang_nama
					);
				}

				// END CARI JENIS BARANG
				// CARI Satuan
				$hasil2['val2'] = array();
				$where_satuan['data'][] = array(
					'column' => 'satuan_id',
					'param'	 => $val->m_satuan_id
				);
				$query_satuan = $this->mod->select('*','m_satuan',NULL,$where_satuan);
				foreach ($query_satuan->result() as $val2) {
					$hasil2['val2'][] = array(
						'id' 	=> $val2->satuan_id,
						'text' 	=> $val2->satuan_nama
					);
				}


				$query_harga = $this->mod->select('*','m_harga',NULL,$where);
				$response['query'] = $query_harga;
				if ($query_harga) {
					foreach ($query_harga->result() as $val2) {
						$harga_jual 	= $val2->harga_jual;
						$harga_beli 	= $val2->harga_beli;
					}
				}
				// END CARI Satuan
				$response['val'][] = array(
					'kode' 							=> $val->barang_id,
					'barang_kode' 					=> $val->barang_kode,
					'barang_nomor' 					=> $val->barang_nomor,
					'barang_nama' 					=> $val->barang_nama,
					'barang_minimum_stok' 			=> $val->barang_minimum_stok,
					'm_satuan_id'					=> $hasil2,
					'm_jenis_barang_id' 			=> $hasil1,
					'harga_jual' 					=> $harga_jual,
					'harga_beli' 					=> $harga_beli
				);
			}

			echo json_encode($response);
		}
	}

	public function loadDataValueWhere(){
		$select = '*';
		$where['data'][] = array(
			'column' => 'barang_id',
			'param'	 => $this->input->get('id')
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where);
		if ($query<>false) {

			foreach ($query->result() as $val) {
				// CARI JENIS BARANG
				$hasil1['val2'] = array();
				$where_type['data'][] = array(
					'column' => 'jenis_barang_id',
					'param'	 => $val->m_jenis_barang_id
				);
				$query_type = $this->mod->select('*','m_jenis_barang',NULL,$where_type);
				foreach ($query_type->result() as $val2) {
					$hasil1['val2'][] = array(
						'id' 	=> $val2->jenis_barang_id,
						'text' 	=> $val2->jenis_barang_nama
					);
				}
				// END CARI JENIS BARANG
				// CARI Satuan
				$hasil2['val2'] = array();
				$where_satuan['data'][] = array(
					'column' => 'satuan_id',
					'param'	 => $val->m_satuan_id
				);
				$query_satuan = $this->mod->select('*','m_satuan',NULL,$where_satuan);
				foreach ($query_satuan->result() as $val2) {
					$hasil2['val2'][] = array(
						'id' 	=> $val2->satuan_id,
						'text' 	=> $val2->satuan_nama
					);
				}
				// END CARI Satuan
				$response['val'][] = array(
					'kode' 							=> $val->barang_id,
					'barang_kode' 					=> $val->barang_kode,
					'barang_nomor' 					=> $val->barang_nomor,
					'barang_nama' 					=> $val->barang_nama,
					'barang_minimum_stok' 			=> $val->barang_minimum_stok,
					'm_jenis_barang_id' 			=> $hasil1,
					'm_satuan_id'					=> $hasil2,
					'barang_status_aktif' 			=> $val->barang_status_aktif
				);
				// ATRIBUT BARANG
				// CARI ATRIBUT BARANG
				$response['attribut'] = array();
				$response['subattribut'] = array();
				$response['value_attribut'] = array();
				$response['value_subattribut'] = array();

				$where_att['data'][] = array(
					'column' => 'm_barang_id',
					'param'	 => $val->barang_id
				);
				$where_att['data'][] = array(
					'column' => 'atribut_status_aktif',
					'param'	 => 'y'
				);
				$query_att = $this->mod->select('*','m_atribut_barang',NULL,$where_att);
				if ($query_att) {
					foreach ($query_att->result() as $row1) {
						// CARI SUB ATRIBUT
						if (@$where_sub_att['data']) {
							unset($where_sub_att['data']);
						}
						$where_sub_att['data'][] = array(
							'column' => 'm_atribut_id',
							'param'	 => $row1->atribut_id
						);
						$where_sub_att['data'][] = array(
							'column' => 'sub_atribut_status_aktif',
							'param'	 => 'y'
						);
						$query_sub_att = $this->mod->select('*','m_sub_atribut_barang',NULL,$where_sub_att);
						$subattribut = array();
						if ($query_sub_att) {
							foreach ($query_sub_att->result() as $row2) {
								// CHECK VALUE
								if (@$where_value_subatt['data']) {
									unset($where_value_subatt['data']);
								}
								$where_value_subatt['data'][] = array(
									'column' => 'referensi_id',
									'param'	 => $row2->sub_atribut_id
								);
								$where_value_subatt['data'][] = array(
									'column' => 'referensi_type',
									'param'	 => '2'
								);
								$query_value_subatt = $this->mod->select('*','m_value',NULL,$where_value_subatt);
								if ($query_value_subatt) {
									foreach ($query_value_subatt->result() as $rowval) {
										$response['value_subattribut'][] = array(
											'referensi_type' 	=> $rowval->referensi_type,
											'referensi_id' 		=> $rowval->referensi_id,
											'value' 			=> $rowval->value,
										);
									}
									$value_real = 1;
								} else {
									$value_real = 0;
								}
								// CARI SATUAN
								// $hasil1['val2'] = array();
								if (@$where_subSatuan['data']) {
									unset($where_subSatuan['data']);
								}
								$where_subSatuan['data'][] = array(
									'column' => 'satuan_id',
									'param'	 => $row2->sub_atribut_satuan
								);
								$query_subSatuan = $this->mod->select('*','m_satuan',NULL,$where_subSatuan);
								$satuan = '';
								if($query_subSatuan)
								{
									foreach ($query_subSatuan->result() as $val2) {
										$satuan = $val2->satuan_nama;
									}
								}
								// END SATUAN
								$response['subattribut'][] = array(
									'atribut_id' 				=> $row1->atribut_id,
									'sub_atribut_id' 			=> $row2->sub_atribut_id,
									'sub_atribut_jenis' 		=> $row2->sub_atribut_jenis,
									'sub_atribut_nama' 			=> $row2->sub_atribut_nama,
									'sub_atribut_satuan' 		=> $satuan,
									'sub_atribut_default_value'	=> $row2->sub_atribut_default_value,
									'value_real'				=> $value_real
								);
							}
						}
						// END CARI SUB ATRIBUT

						// CHECK VALUE 
						if (@$where_value_att['data']) {
							unset($where_value_att['data']);
						}
						$where_value_att['data'][] = array(
							'column' => 'referensi_id',
							'param'	 => $row1->atribut_id
						);
						$where_value_att['data'][] = array(
							'column' => 'referensi_type',
							'param'	 => '1'
						);
						$query_value_att = $this->mod->select('*','m_value',NULL,$where_value_att);
						if ($query_value_att) {
							foreach ($query_value_att->result() as $rowval) {
								$response['value_attribut'][] = array(
									'referensi_type' 	=> $rowval->referensi_type,
									'referensi_id' 		=> $rowval->referensi_id,
									'value' 			=> $rowval->value,
								);
							}
							$value_real = 1;
						} else {
							$value_real = 0;
						}
						// CARI SATUAN
						// $hasil5['val2'] = array();
						if (@$where_attrSatuan['data']) {
							unset($where_attrSatuan['data']);
						}
						$where_attrSatuan['data'][] = array(
							'column' => 'satuan_id',
							'param'	 => $row1->atribut_satuan
						);
						$query_attrSatuan = $this->mod->select('*','m_satuan',NULL,$where_attrSatuan);
						$attrSatuan = '';
						if($query_attrSatuan)
						{
							foreach ($query_attrSatuan->result() as $val2) {
								$attrSatuan = $val2->satuan_nama;
							}
						}
						// END SATUAN
						$response['attribut'][] = array(
							'atribut_id' 				=> $row1->atribut_id,
							'atribut_jenis' 			=> $row1->atribut_jenis,
							'atribut_nama' 				=> $row1->atribut_nama,
							'atr_satuan' 				=> $row1->atribut_satuan,
							'atribut_satuan' 			=> $attrSatuan,
							'atribut_default_value' 	=> $row1->atribut_default_value,
							'value_real'				=> $value_real
						);

					}
				}
				// END CARI ATRIBUT BARANG
				// END ATRIBUT BARANG
			}

			echo json_encode($response);
		}
	}

	public function loadData_select(){
		$param = $this->input->get('q');
		if ($param!=NULL) {
			$param = $this->input->get('q');
		} else {
			$param = "";
		}
		$select = '*';
		$where['data'][] = array(
			'column' => 'barang_status_aktif',
			'param'	 => 'y'
		);
		$where_like['data'][] = array(
			'column' => 'barang_nama',
			'param'	 => $this->input->get('q')
		);
		$order['data'][] = array(
			'column' => 'barang_nama',
			'type'	 => 'ASC'
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where, NULL, $where_like, $order);
		$response['items'] = array();
		if ($query<>false) {
			foreach ($query->result() as $val) {
				$response['items'][] = array(
					'id'	=> $val->barang_id,
					'text'	=> $val->barang_nama
				);
			}
			$response['status'] = '200';
		}

		echo json_encode($response);
	}

	public function loadData_select2(){
		$param = $this->input->get('q');
		if ($param!=NULL) {
			$param = $this->input->get('q');
		} else {
			$param = "";
		}
		$select = '*';
		$where['data'][] = array(
			'column' => 'barang_status_aktif',
			'param'	 => 'y'
		);
		$where_like['data'][] = array(
			'column' => 'barang_kode',
			'param'	 => $this->input->get('q')
		);
		$order['data'][] = array(
			'column' => 'barang_kode',
			'type'	 => 'ASC'
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where, NULL, $where_like, $order);
		$response['items'] = array();
		if ($query<>false) {
			foreach ($query->result() as $val) {
				$response['items'][] = array(
					'id'	=> $val->barang_id,
					'text'	=> $val->barang_kode
				);
			}
			$response['status'] = '200';
		}

		echo json_encode($response);
	}

	public function loadData_select3(){
		$param = $this->input->get('q');
		if ($param!=NULL) {
			$param = $this->input->get('q');
		} else {
			$param = "";
		}
		$select = 'a.*, b.*';
		$join['data'][] = array(
			'table' => 'm_jenis_barang b',
			'join'	=> 'b.jenis_barang_id = a.m_jenis_barang_id',
			'type'	=> 'left'
		);
		$where['data'][] = array(
			'column' => 'a.barang_status_aktif',
			'param'	 => 'y'
		);
		$where_like['data'][] = array(
			'column' => 'a.barang_nama',
			'param'	 => $this->input->get('q')
		);
		$where_like['data'][] = array(
			'column' => 'b.jenis_barang_nama',
			'param'	 => $this->input->get('q')
		);
		$order['data'][] = array(
			'column' => 'a.barang_nama',
			'type'	 => 'ASC'
		);
		$query = $this->mod->select($select, 'm_barang a', $join, $where, NULL, $where_like, $order);
		$response['items'] = array();
		if ($query<>false) {
			foreach ($query->result() as $val) {
				$response['items'][] = array(
					'id'	=> $val->barang_id,
					'text'	=> $val->barang_nama.' ('.$val->jenis_barang_nama.')'
				);
			}
			$response['status'] = '200';
		}

		echo json_encode($response);
	}

	// Function Insert & Update
	public function postData(){
		$id = $this->input->post('kode');
		if (strlen($id)>0) {
			//UPDATE
			$data = $this->general_post_data(2, $id);
			$where['data'][] = array(
				'column' => 'barang_id',
				'param'	 => $id
			);
			$update = $this->mod->update_data_table($this->tbl, $where, $data);
			$dataharga = $this->general_post_data3(2, null, $id);
			$updateharga = $this->mod->update_data_table('m_harga', $where, $dataharga);
			if($data['barang_status_aktif'] == 'n')
			{
				$updateAttr = $this->nonaktif_atribut($id);
			}
			if($update->status) {
				$response['status'] = '200';
			} else {
				$response['status'] = '204';
			}
		} else {
			//INSERT
			$data = $this->general_post_data(1);
			$insert = $this->mod->insert_data_table($this->tbl, NULL, $data);
			if($insert->status) {
				$data2 = $this->general_post_data3(1, $insert->output);
				$insert = $this->mod->insert_data_table('m_harga', NULL, $data2);
				$response['status'] = '200';
			} else {
				$response['status'] = '204';
			}
		}
		
		echo json_encode($response);
	}

	public function postDataValue(){
		for ($i = 0; $i < sizeof($this->input->post('referensi_id', TRUE)); $i++) { 
			if (@$where['data']) {
				unset($where['data']);
			}
			$where['data'][] = array(
				'column' => 'referensi_type',
				'param'	 => $this->input->post('referensi_type', TRUE)[$i]
			);
			$where['data'][] = array(
				'column' => 'referensi_id',
				'param'	 => $this->input->post('referensi_id', TRUE)[$i]
			);
			$check = $this->mod->select('*', 'm_value', NULL, $where);
			if ($check) {
				$data = $this->general_post_data2($i, 2);
				$update = $this->mod->update_data_table('m_value', $where, $data);
				if($update->status) {
					$response['status'] = '200';
				} else {
					$response['status'] = '204';
				}
			} else {
				$data = $this->general_post_data2($i, 1);
				$insert = $this->mod->insert_data_table('m_value', NULL, $data);
				if($insert->status) {
					$response['status'] = '200';
				} else {
					$response['status'] = '204';
				}
			}
		}

		echo json_encode($response);
	}

	// Function Delete
	public function deleteData(){
		$id = $this->input->post('id');
		$data = $this->general_post_data(3, $id);
		$where['data'][] = array(
			'column' => 'barang_id',
			'param'	 => $id
		);
		$update = $this->mod->update_data_table($this->tbl, $where, $data);
		$updateAttr = $this->nonaktif_atribut($id);
		if($update->status) {
			$response['status'] = '200';
		} else {
			$response['status'] = '204';
		}

		echo json_encode($response);
	}

	public function aktifData(){
		$id = $this->input->post('id');
		$data = $this->general_post_data(4, $id);
		$where['data'][] = array(
			'column' => 'barang_id',
			'param'	 => $id
		);
		$update = $this->mod->update_data_table($this->tbl, $where, $data);
		if($update->status) {
			$response['status'] = '200';
		} else {
			$response['status'] = '204';
		}

		echo json_encode($response);
	}

	/* Saving $data as array to database */
	function general_post_data($type, $id = null){
		// 1 Insert, 2 Update, 3 Delete / Non Aktif
		$where['data'][] = array(
			'column' => 'barang_id',
			'param'	 => $id
		);
		$queryRevised = $this->mod->select('barang_revised', $this->tbl, NULL, $where);
		if ($queryRevised) {
			$revised = $queryRevised->row_array();
			$rev = $revised['barang_revised'] + 1;
		}
		if ($type == 1) {
			$data = array(
				'barang_kode' 					=> $this->input->post('barang_kode', TRUE),
				'barang_nomor' 					=> $this->input->post('barang_nomor', TRUE),
				'barang_nama' 					=> $this->input->post('barang_nama', TRUE),
				'm_jenis_barang_id' 			=> $this->input->post('m_jenis_barang_id', TRUE),
				'm_satuan_id' 					=> $this->input->post('m_satuan_id', TRUE),
				'barang_minimum_stok' 			=> $this->input->post('barang_minimum_stok', TRUE),
				'barang_status_aktif' 			=> $this->input->post('barang_status_aktif', TRUE),
				'barang_create_date' 			=> date('Y-m-d H:i:s'),
				'barang_update_date' 			=> date('Y-m-d H:i:s'),
				'barang_create_by' 				=> $this->session->userdata('user_username'),
				'barang_revised' 				=> 0,
			);
		} else if ($type == 2) {
			$data = array(
				'barang_kode' 					=> $this->input->post('barang_kode', TRUE),
				'barang_nomor' 					=> $this->input->post('barang_nomor', TRUE),
				'barang_nama' 					=> $this->input->post('barang_nama', TRUE),
				'm_jenis_barang_id' 			=> $this->input->post('m_jenis_barang_id', TRUE),
				'm_satuan_id' 					=> $this->input->post('m_satuan_id', TRUE),
				'barang_minimum_stok' 			=> $this->input->post('barang_minimum_stok', TRUE),
				'barang_status_aktif' 			=> $this->input->post('barang_status_aktif', TRUE),
				'barang_update_date' 			=> date('Y-m-d H:i:s'),
				'barang_update_by' 				=> $this->session->userdata('user_username'),
				'barang_revised' 				=> $rev,
			);
		} else if ($type == 3) {
			$data = array(
				'barang_status_aktif' 			=> 'n',
				'barang_update_date' 			=> date('Y-m-d H:i:s'),
				'barang_update_by' 				=> $this->session->userdata('user_username'),
				'barang_revised' 				=> $rev,
			);
		} else if ($type == 4) {
			$data = array(
				'barang_status_aktif' 			=> 'y',
				'barang_update_date' 			=> date('Y-m-d H:i:s'),
				'barang_update_by' 				=> $this->session->userdata('user_username'),
				'barang_revised' 				=> $rev,
			);
		}

		return $data;
	}

	function general_post_data2($seq, $type){
		$where['data'][] = array(
			'column' => 'referensi_type',
			'param'	 => $this->input->post('referensi_type', TRUE)[$seq]
		);
		$where['data'][] = array(
			'column' => 'referensi_id',
			'param'	 => $this->input->post('referensi_id', TRUE)[$seq]
		);
		$queryRevised = $this->mod->select('value_revised', 'm_value', NULL, $where);
		if ($queryRevised) {
			$revised = $queryRevised->row_array();
			$rev = $revised['value_revised'] + 1;
		}
		if ($type == 1) {
			$data = array(
				'referensi_type' 		=> $this->input->post('referensi_type', TRUE)[$seq],
				'referensi_id' 			=> $this->input->post('referensi_id', TRUE)[$seq],
				'value' 				=> $this->input->post('value', TRUE)[$seq],
				'value_create_date'		=> date('Y-m-d H:i:s'),
				'value_create_by' 		=> $this->session->userdata('user_username'),
			);
		} else if ($type == 2) {
			$data = array(
				'referensi_type' 		=> $this->input->post('referensi_type', TRUE)[$seq],
				'referensi_id' 			=> $this->input->post('referensi_id', TRUE)[$seq],
				'value' 				=> $this->input->post('value', TRUE)[$seq],
				'value_update_date'		=> date('Y-m-d H:i:s'),
				'value_update_by' 		=> $this->session->userdata('user_username'),
				'value_revised' 		=> $rev,
			);
		} 

		return $data;
	}
	/* end Function */

	function general_post_data3($type, $idbarang = null, $id = null){
		// 1 Insert, 2 Update, 3 Delete / Non Aktif
		$where['data'][] = array(
			'column' => 'barang_id',
			'param'	 => $id
		);
		$queryRevised = $this->mod->select('barang_revised', $this->tbl, NULL, $where);
		if ($queryRevised) {
			$revised = $queryRevised->row_array();
			$rev = $revised['barang_revised'] + 1;
		}
		if ($type == 1) {
			$data = array(
				'barang_id' 					=> $idbarang,
				'cabang_id' 					=> $this->session->userdata('cabang_id'),
				'harga_jual' 					=> $this->input->post('harga_jual', TRUE),
				'harga_beli' 					=> $this->input->post('harga_beli', TRUE),
				'barang_status_aktif' 			=> $this->input->post('barang_status_aktif', TRUE),
				'barang_create_date' 			=> date('Y-m-d H:i:s'),
				'barang_update_date' 			=> date('Y-m-d H:i:s'),
				'barang_create_by' 				=> $this->session->userdata('user_username'),
				'barang_revised' 				=> 0,
			);
		} else if ($type == 2) {
			$data = array(
				'harga_jual' 					=> $this->input->post('harga_jual', TRUE),
				'harga_beli' 					=> $this->input->post('harga_beli', TRUE),
				'barang_status_aktif' 			=> $this->input->post('barang_status_aktif', TRUE),
				'barang_update_date' 			=> date('Y-m-d H:i:s'),
				'barang_update_by' 				=> $this->session->userdata('user_username'),
				'barang_revised' 				=> $rev,
			);
		} else if ($type == 3) {
			$data = array(
				'barang_status_aktif' 			=> 'n',
				'barang_update_date' 			=> date('Y-m-d H:i:s'),
				'barang_update_by' 				=> $this->session->userdata('user_username'),
				'barang_revised' 				=> $rev,
			);
		} else if ($type == 4) {
			$data = array(
				'barang_status_aktif' 			=> 'y',
				'barang_update_date' 			=> date('Y-m-d H:i:s'),
				'barang_update_by' 				=> $this->session->userdata('user_username'),
				'barang_revised' 				=> $rev,
			);
		}

		return $data;
	}

	function nonaktif_atribut($type_id)
	{
		// select data karyawan
		$tblAttr = 'm_atribut_barang';
		$select = 'atribut_id, atribut_revised';
		$where['data'][] = array(
			'column' => 'm_barang_id',
			'param'	 => $type_id,
		);
		$idAttr = $this->mod->select($select, $tblAttr, NULL, $where);
		// end select
		$dataAttr = array();
		$data = array();
		$i = 0;
		if($idAttr)
		{
			foreach ($idAttr->result_array() as $id) {
				// masukkan data karyawan ke dalam array
				$dataAttr[$i] = array(
					'atribut_id' 				=> $id['atribut_id'],
					'atribut_status_aktif' 		=> 'n',
					'atribut_update_date' 		=> date('Y-m-d H:i:s'),
					'atribut_update_by' 		=> $this->session->userdata('user_username'),
					'atribut_revised' 			=> $id['atribut_revised'] + 1, 
				);
				//
				//select user_revised
				$select = 'sub_atribut_revised';
				if (@$whereSubAttr['data']) {
					unset($whereSubAttr['data']);
				}
				$whereSubAttr['data'][] = array(
					'column' => 'm_atribut_id',
					'param'	 => $id['atribut_id'],
				);
				$revSubAttr = $this->mod->select($select, 'm_sub_atribut_barang', NULL, $whereSubAttr);
				// end select
				// cek jika data ada
				if($revSubAttr)
				{
					// ambil data dan masukkan ke dalam array data
					$revisedSubAttr = $revSubAttr->result_array();
					$data[$i] = array(
					    'm_atribut_id' 					=> $id['atribut_id'] ,
					    'sub_atribut_status_aktif' 		=> 'n',
						'sub_atribut_update_date' 		=> date('Y-m-d H:i:s'),
						'sub_atribut_update_by' 		=> $this->session->userdata('user_username'),
						'sub_atribut_revised' 			=> $revisedSubAttr['sub_atribut_revised'] + 1,
				    );
				}
				$i++;
			}
			$updateAttr = $this->db->update_batch($tblAttr, $dataAttr, 'atribut_id');
			if(count($data) > 0)
			{
				$updateSubAttr = $this->db->update_batch('m_sub_atribut_barang', $data, 'm_atribut_id');
			}
		}

        return true;
	}

}
