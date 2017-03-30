<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_laporan extends MY_Controller {
	private $any_error = array();
	// Define Main Table
	public $tbl = '';

	public function __construct() {
        parent::__construct();
	}

	// --------------------------------------------------
	// LAPORAN HARIAN KELUAR BARANG
	public function lhkb(){
		$this->check_session();
		$priv = $this->cekUser(25);
		$data = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> 'Laporan',
			'title_page2' 	=> 'Laporan Harian Keluar Barang',
			'priv_add'		=> $priv['create']
			);
		if($priv['read'] == 1)
		{
			$this->open_page('laporan/V_laporan_harian_keluar_barang', $data);
		}
		else
		{
			$this->load->view('layout/V_404', $data);
		}
	}

	public function cetakPDFlhkb(){
		$this->load->library('pdf');
		$name = 'LHKB '.date('d-m-Y', strtotime($this->input->post('from_tanggal'))).' - '.date('d-m-Y', strtotime($this->input->post('to_tanggal'))).'';
		$select = '*';
		$where['data'][] = array(
			'column' => 'cabang_id',
			'param'	 => $this->input->post('m_cabang_id')
		);
		$where['data'][] = array(
			'column' => 'gudang_id',
			'param'	 => $this->input->post('m_gudang_id')
		);
		$where['data'][] = array(
			'column' => 'kartu_stok_keluar >',
			'param'	 => 0
		);
		$where['data'][] = array(
			'column' => 'kartu_stok_tanggal <=',
			'param'	 => date('Y/m/d H:i:s', strtotime($this->input->post('to_tanggal')))
		);
		$where['data'][] = array(
			'column' => 'kartu_stok_tanggal >=',
			'param'	 =>  date('Y/m/d H:i:s', strtotime($this->input->post('from_tanggal')))
		);
		$query = $this->mod->select($select, 'v_kartu_stok', NULL, $where);
		$response['val'] = array();
		$response['from_tanggal'] = date('d-m-Y', strtotime($this->input->post('from_tanggal')));
		$response['to_tanggal'] = date('d-m-Y', strtotime($this->input->post('to_tanggal')));
		$response['title'][] = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> 'Laporan',
			'title_page2' 	=> 'Laporan Harian Keluar Barang',
		);
 		if ($query<>false) {
			foreach ($query->result() as $val) {
				$departmen = '';
				if($val->kartu_stok_referensi != '')
				{
					if(strpos($val->kartu_stok_referensi, 'BKB') !== false)
					{
						$selectDepartmen = 'departemen_nama';
						$whereDepartmen['data'][] = array(
							'column' =>  'keluar_barang_nomor',
							'param'  =>	 $val->kartu_stok_referensi
						);
						$queryDepartmen = $this->mod->select($selectDepartmen, 'v_bkb', NULL, $whereDepartmen, NULL, NULL, NULL);
						if($queryDepartmen)
						{
							foreach ($queryDepartmen->result() as $row) {
								$departmen = $row->departemen_nama;
							}
						}
					}
				}
				// CARI CABANG
				$hasil1['val2'] = array();
				$where_cabang['data'][] = array(
					'column' => 'cabang_id',
					'param'	 => $val->cabang_id
				);
				$query_cabang = $this->mod->select('*','m_cabang',NULL,$where_cabang);
				if ($query_cabang) {
					foreach ($query_cabang->result() as $val2) {
						// CARI KOTA
						$hasil2['val2'] = array();
						$where_kota['data'][] = array(
							'column' => 'id',
							'param'	 => $val2->cabang_kota
						);
						$query_kota = $this->mod->select('*','regencies',NULL,$where_kota);
						if ($query_kota) {
							foreach ($query_kota->result() as $val3) {
								$hasil2['val3'][] = array(
									'id' 		=> $val3->id,
									'text' 		=> $val3->name,
								);
							}
						}
						// END CARI KOTA
						$hasil1['val2'][] = array(
							'id' 	=> $val2->cabang_id,
							'text' 	=> $val2->cabang_nama,
							'alamat'=> $val2->cabang_alamat,
							'kota'	=> $hasil2,
							'telp'  => json_decode($val2->cabang_telepon)
						);
					}
				}
				// END CARI CABANG
				$response['val'][] = array(
					'tanggal_bkb' 			=> date("d/m/Y", strtotime($val->kartu_stok_tanggal)),
					'referensi_bkb'			=> $val->kartu_stok_referensi,
					'departemen' 			=> $departmen,
					'cabang'				=> $hasil1,
					'barang_kode' 			=> $val->barang_kode,
					'barang_nama' 			=> $val->barang_nama,
					'qty' 					=> $val->kartu_stok_keluar,
					'satuan_nama' 			=> $val->satuan_nama,
					'keterangan' 			=> $val->kartu_stok_keterangan,
				);
			}
		}
		// echo json_encode($response);
		$this->pdf->set_paper('A4', 'landscape');
		$this->pdf->load_view('print/P_lhkb', $response);
		$this->pdf->render();
		$this->pdf->stream($name,array("Attachment"=>false));
	}

	public function loadDatalhkb(){
		$select = '*';
		//LIMIT
		$limit = array(
			'start'  => $this->input->get('start'),
			'finish' => $this->input->get('length')
		);
		$where['data'][] = array(
			'column' => 'cabang_id',
			'param'	 => $this->input->get('id_cabang')
		);
		$where['data'][] = array(
			'column' => 'gudang_id',
			'param'	 => $this->input->get('id_gudang')
		);
		$where['data'][] = array(
			'column' => 'kartu_stok_keluar >',
			'param'	 => 0
		);
		$where['data'][] = array(
			'column' => 'kartu_stok_tanggal <=',
			'param'	 => date ("Y/m/d H:i:s",strtotime($this->input->get('to_tanggal')))
		);
		$where['data'][] = array(
			'column' => 'kartu_stok_tanggal >=',
			'param'	 => date ("Y/m/d H:i:s",strtotime($this->input->get('from_tanggal')))
		);
		//WHERE LIKE
		$where_like['data'][] = array(
			'column' => 'kartu_stok_tanggal, kartu_stok_referensi, kartu_stok_keluar',
			'param'	 => $this->input->get('search[value]')
		);
		//ORDER
		$index_order = $this->input->get('order[0][column]');
		$order['data'][] = array(
			'column' => $this->input->get('columns['.$index_order.'][name]'),
			'type'	 => $this->input->get('order[0][dir]')
		);

		$query_total = $this->mod->select($select, 'v_kartu_stok');
		$query_filter = $this->mod->select($select, 'v_kartu_stok', NULL, $where, NULL, $where_like, $order);
		$query = $this->mod->select($select, 'v_kartu_stok', NULL, $where, NULL, $where_like, $order, $limit);

		$response['data'] = array();
		if ($query<>false) {
			$no = $limit['start']+1;
			foreach ($query->result() as $val) {
				$departmen = '';
				if($val->kartu_stok_referensi != '')
				{
					if(strpos($val->kartu_stok_referensi, 'BKB') !== false)
					{
						$selectDepartmen = 'departemen_nama';
						$whereDepartmen['data'][] = array(
							'column' =>  'keluar_barang_nomor',
							'param'  =>	 $val->kartu_stok_referensi
						);
						$queryDepartmen = $this->mod->select($selectDepartmen, 'v_bkb', NULL, $whereDepartmen, NULL, NULL, NULL);
						if($queryDepartmen)
						{
							foreach ($queryDepartmen->result() as $row) {
								$departmen = $row->departemen_nama;
							}
						}
					}
				}
				$response['data'][] = array(
					$no,
					date("d/m/Y", strtotime($val->kartu_stok_tanggal)),
					$val->kartu_stok_referensi,
					$departmen,
					$val->barang_kode,
					$val->barang_nama,
					$val->kartu_stok_keluar,
					$val->satuan_nama,
					$val->kartu_stok_keterangan,
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
	// end LAPORAN HARIAN KELUAR BARANG
	// --------------------------------------------------

	// --------------------------------------------------
	// LAPORAN SPP BELUM REALISASI
	public function spp_belum_realisasi(){
		$this->check_session();
		$priv = $this->cekUser(62);
		$data = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> 'Laporan',
			'title_page2' 	=> 'Laporan SPP Belum Realisasi',
			'priv_add'		=> $priv['create']
			);
		if($priv['read'] == 1)
		{
			$this->open_page('laporan/V_laporan_spp_belum_realisasi', $data);
		}
		else
		{
			$this->load->view('layout/V_404', $data);
		}
	}

	public function loadDataspp_belum_realisasi(){
		$select = '*';
		//LIMIT
		$limit = array(
			'start'  => $this->input->get('start'),
			'finish' => $this->input->get('length')
		);
		$where['data'][] = array(
			'column' => 'cabang_id',
			'param'	 => $this->input->get('id_cabang')
		);
		$where['data'][] = array(
			'column' => 'gudang_id',
			'param'	 => $this->input->get('id_gudang')
		);
		$where['data'][] = array(
			'column' => 'permintaan_pembelian_tanggal <=',
			'param'	 => date ("Y-m-d H:i:s",strtotime($this->input->get('to_tanggal')))
		);
		$where['data'][] = array(
			'column' => 'permintaan_pembelian_tanggal >=',
			'param'	 => date ("Y-m-d H:i:s",strtotime($this->input->get('from_tanggal')))
		);
		//WHERE LIKE
		$where_like['data'][] = array(
			'column' => 'permintaan_pembelian_nomor, permintaan_pembelian_tanggal, barang_kode, barang_nama, permintaan_pembelian_qty, satuan_nama, permintaan_pembelian_alasan',
			'param'	 => $this->input->get('search[value]')
		);
		//ORDER
		$index_order = $this->input->get('order[0][column]');
		$order['data'][] = array(
			'column' => $this->input->get('columns['.$index_order.'][name]'),
			'type'	 => $this->input->get('order[0][dir]')
		);

		$query_total = $this->mod->select($select, 'v_laporan_spp_belum_realisasi');
		$query_filter = $this->mod->select($select, 'v_laporan_spp_belum_realisasi', NULL, $where, NULL, $where_like, $order);
		$query = $this->mod->select($select, 'v_laporan_spp_belum_realisasi', NULL, $where, NULL, $where_like, $order, $limit);

		$response['data'] = array();
		if ($query<>false) {
			$no = $limit['start']+1;
			foreach ($query->result() as $val) {
				$response['data'][] = array(
					$no,
					$val->permintaan_pembelian_nomor,
					date("d/m/Y", strtotime($val->permintaan_pembelian_tanggal)),
					$val->barang_kode,
					$val->barang_nama,
					$val->permintaan_pembelian_qty,
					$val->satuan_nama,
					$val->permintaan_pembelian_alasan,
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

	public function cetakPDFspp_belum_realisasi($cabang, $gudang, $bulanawal, $tanggalawal, $tahunawal, $bulanakhir, $tanggalakhir, $tahunakhir){
		$this->load->library('pdf');
		$awal = $tanggalawal.'-'.$bulanawal.'-'.$tahunawal;
		$akhir =$tanggalakhir.'-'.$bulanakhir.'-'.$tahunakhir;
		$name = 'SPP Belum Realisasi '.date('d-m-Y', strtotime($awal)).' - '.date('d-m-Y', strtotime($akhir)).'';
		$select = '*';
		$where['data'][] = array(
			'column' => 'cabang_id',
			'param'	 => $cabang
		);
		$where['data'][] = array(
			'column' => 'gudang_id',
			'param'	 => $gudang
		);
		$where['data'][] = array(
			'column' => 'permintaan_pembelian_tanggal >=',
			'param'	 => date ("Y-m-d H:i:s", strtotime($awal))
		);
		$where['data'][] = array(
			'column' => 'permintaan_pembelian_tanggal <=',
			'param'	 => date ("Y-m-d H:i:s", strtotime($akhir))
		);
		$query = $this->mod->select($select, 'v_laporan_spp_belum_realisasi', NULL, $where);
		$response['val'] = array();
		if ($query<>false) {
			$no = 1;
			foreach ($query->result() as $val) {
				$response['data'][] = array(
					'no'							=> $no,
					'permintaan_pembelian_nomor'	=> $val->permintaan_pembelian_nomor,
					'permintaan_pembelian_tanggal'	=> date("d/m/Y", strtotime($val->permintaan_pembelian_tanggal)),
					'barang_kode'					=> $val->barang_kode,
					'barang_nama'					=> $val->barang_nama,
					'permintaan_pembelian_qty'		=> $val->permintaan_pembelian_qty,
					'satuan_nama'					=> $val->satuan_nama,
					'permintaan_pembelian_alasan'	=> $val->permintaan_pembelian_alasan,
				);
				$no++;
			}
		}
		$response['from_tanggal'] = date('d-m-Y', strtotime($awal));
		$response['to_tanggal'] = date('d-m-Y', strtotime($akhir));
		$response['title'][] = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> 'Laporan',
			'title_page2' 	=> 'Laporan SPP Belum Realisasi',
		);
				
		// CARI CABANG
		$hasil1['val2'] = array();
		$where_cabang['data'][] = array(
			'column' => 'cabang_id',
			'param'	 => $cabang
		);
		$query_cabang = $this->mod->select('*','m_cabang',NULL,$where_cabang);
		if ($query_cabang) {
			foreach ($query_cabang->result() as $val2) {
				// CARI KOTA
				$hasil2['val2'] = array();
				$where_kota['data'][] = array(
					'column' => 'id',
					'param'	 => $val2->cabang_kota
				);
				$query_kota = $this->mod->select('*','regencies',NULL,$where_kota);
				if ($query_kota) {
					foreach ($query_kota->result() as $val3) {
						$hasil2['val3'][] = array(
							'id' 		=> $val3->id,
							'text' 		=> $val3->name,
						);
					}
				}
				// END CARI KOTA
				$hasil1['val2'][] = array(
					'id' 	=> $val2->cabang_id,
					'text' 	=> $val2->cabang_nama,
					'alamat'=> $val2->cabang_alamat,
					'kota'	=> $hasil2,
					'telp'  => json_decode($val2->cabang_telepon)
				);
			}
		}
		$response['val'][] = array(
			'cabang'				=> $hasil1,
		);
		// END CARI CABANG
		// echo json_encode($response);
		// $this->pdf->set_paper('A4', 'landscape');
		$this->pdf->load_view('print/P_spp_belum_realisasi', $response);
		$this->pdf->render();
		$this->pdf->stream($name,array("Attachment"=>false));
		// $this->load->view('print/P_spp_belum_realisasi', $response);
	}
	// end LAPORAN SPP BELUM REALISASI
	// --------------------------------------------------

	public function loadDataKartuStokMasuk(){
		$select = '*';
		//LIMIT
		$limit = array(
			'start'  => $this->input->get('start'),
			'finish' => $this->input->get('length')
		);
		$where['data'][] = array(
			'column' => 'cabang_id',
			'param'	 => $this->input->get('id_cabang')
		);
		$where['data'][] = array(
			'column' => 'gudang_id',
			'param'	 => $this->input->get('id_gudang')
		);
		$where['data'][] = array(
			'column' => 'kartu_stok_masuk >',
			'param'	 => 0
		);
		$where['data'][] = array(
			'column' => 'kartu_stok_tanggal <=',
			'param'	 => date ("Y/m/d H:i:s",strtotime($this->input->get('to_tanggal')))
		);
		$where['data'][] = array(
			'column' => 'kartu_stok_tanggal >=',
			'param'	 => date ("Y/m/d H:i:s",strtotime($this->input->get('from_tanggal')))
		);
		//WHERE LIKE
		$where_like['data'][] = array(
			'column' => 'kartu_stok_tanggal, kartu_stok_referensi, kartu_stok_masuk',
			'param'	 => $this->input->get('search[value]')
		);
		//ORDER
		$index_order = $this->input->get('order[0][column]');
		$order['data'][] = array(
			'column' => $this->input->get('columns['.$index_order.'][name]'),
			'type'	 => $this->input->get('order[0][dir]')
		);

		$query_total = $this->mod->select($select, 'v_kartu_stok');
		$query_filter = $this->mod->select($select, 'v_kartu_stok', NULL, $where, NULL, $where_like, $order);
		$query = $this->mod->select($select, 'v_kartu_stok', NULL, $where, NULL, $where_like, $order, $limit);

		$response['data'] = array();
		if ($query<>false) {
			$no = $limit['start']+1;
			foreach ($query->result() as $val) {
				$departmen = '';
				if($val->kartu_stok_referensi != '')
				{
					if(strpos($val->kartu_stok_referensi, 'BKB') !== false)
					{
						$selectDepartmen = 'departemen_nama';
						$whereDepartmen['data'][] = array(
							'column' =>  'keluar_barang_nomor',
							'param'  =>	 $val->kartu_stok_referensi
						);
						$queryDepartmen = $this->mod->select($selectDepartmen, 'v_bkb', NULL, $whereDepartmen, NULL, NULL, NULL);
						if($queryDepartmen)
						{
							$departmen = $queryDepartmen->row_array();
						}
					}
				}
				$response['data'][] = array(
					$no,
					date("d/m/Y", strtotime($val->kartu_stok_tanggal)),
					$val->kartu_stok_referensi,
					$departmen['departemen_nama'],
					$val->barang_kode,
					$val->barang_nama,
					$val->kartu_stok_masuk,
					$val->satuan_nama,
					$val->kartu_stok_keterangan,
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
}
