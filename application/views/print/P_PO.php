<html>
  <head>
  <style type="text/css">
    .tb1{
      text-align: center;
      width: 100%;
      padding-bottom: 10px;
      padding-top: 10px;
    }
    .tb2{
      padding-top: 10px;

      width: 50%;
      text-align: center;
    }
    .catatan {
      padding-top: 10px;
    }
    .s {
      float: left;
    }
    .k {
      float: right;
    }
    /*table.tb-border tbody,*/
    table.tb-border tr > td
    {
        border: 1px solid;
    }

    .center{
      text-align: center;
    }
    .border{
      border: 1px solid;
    }
    .no-border
    {
      border: none !important;
    }
  </style>
  <title><?= $title[0]['aplikasi'].' '.$title[0]['title_page'].' - '.$title[0]['title_page2'] ?></title>
  </head>
  <body>
    <table width="100%">
    <tr>
      <td colspan="3" align="center"><b><?= strtoupper($val[0]['cabang']['val2'][0]['text'])?></b></td>
    </tr>
    <tr>
      <td colspan="3" align="center"><?= $val[0]['cabang']['val2'][0]['alamat']?>, <?= $val[0]['cabang']['val2'][0]['kota']['val3'][0]['text']?><br>
      <?php
      for($i=0; $i < count($val[0]['cabang']['val2'][0]['telp']); $i++)
      {
        if($i == count($val[0]['cabang']['val2'][0]['telp'])-1)
        {
          echo $val[0]['cabang']['val2'][0]['telp'][$i];
        }
        else
        {
          echo $val[0]['cabang']['val2'][0]['telp'][$i].', ';
        }
      }
      ?>
      </td>
    </tr>
  </table>
  <table style="width: 100%; margin-top: 20px;">
    <tbody>
      <tr>
        <td style="width: 30%;"></td>
        <td style="text-align: center; font-size: 25px;"><b>ORDER PEMBELIAN</b></td>
        <td rowspan="2" style="width: 30%; padding-left: 50px;">
           No   : <?php echo $val[0]['order_nomor'] ?>
           <br>
           Tgl  : <?php echo $val[0]['order_tanggal'] ?>
        </td>
      </tr>
      <tr>
        <td style="width: 30%; font-size: 22px;"></td>
        <td style="text-align: center;"><b>(PURCHASE ORDER)</b></td>
        <!-- <td style="border: 1px solid;width: 30%;"></td> -->
      </tr>
    </tbody>
  </table>
  <br>
  <table width="100%" border="" cellspacing="0" rules="all" cellpadding="6">
    <tbody>
      <tr>
        <td class="center" style="width: 48%;">SUPPLIER</td>
        <td class="no-border"></td>
        <td class="center" style="width: 48%;">KIRIM KE</td>
      </tr>
      <tr>
        <td valign="top">
          <table style="width: 100%;">
             <tbody>
               <tr>
                 <th style="width: 20%;" valign="top">Nama :</th>
                 <td valign="top" style="white-space:normal !important;word-wrap: break-word; ">
                   <?php echo $val[0]['m_supplier_id']['val2'][0]['text'] ?>
                 </td>
                 <th style="text-align: right;" valign="top">Kode : </th>
                 <td valign="top"><?php echo $val[0]['m_supplier_id']['val2'][0]['id'] ?></td>
               </tr>

               <tr>
                 <th>
                   Telp / Fax :
                 </th>
                 <td valign="top" style="white-space:normal !important;word-wrap: break-word; text-align:left;">
                   <?= $val[0]['m_supplier_id']['val2'][0]['telp'] ?>
                 </td>
               </tr>
             </tbody>
          </table>
        </td>
        <td class="no-border"></td>
        <td valign="top">
          <table style="width: 100%;">
            <tbody>
              <tr>
                <th style="width: 20%;" valign="top">Nama :</th>
                <td valign="top" style="white-space:normal !important;word-wrap: break-word; ">
                  <?php echo $val[0]['order_nama_dikirim'] ?>
                </td>
                <th style="text-align: right;" valign="top">Alamat : </th>
                <td valign="top"><?php echo $val[0]['order_alamat_dikirim'] ?></td>
              </tr>
            </tbody>
          </table>
        </td>
      </tr>
    </tbody>
  </table>
  <br>
  <table width="100%" border="1" cellspacing="0" rules="all" cellpadding="6">
	<tr>
		<th width="5%" scope="col">No.</th>
		<th width="5%" scope="col">Artikel</th>
		<th width="15%" scope="col">Uraian dan Spesifikasi Barang/Jasa</th>
		<th width="5%" scope="col">Qty</th>
		<th width="5%" scope="col">Satuan</th>
		<th width="5%" scope="col">Harga Satuan</th>
    <th width="8%" scope="col">Disc ( % )</th>
    <th width="10%" scope="col">Total</th>
	</tr>
  <?php
      $no = 1;
      foreach ($val2 as $barang => $itemBarang)
      {
        echo '<tr align="left">';
        echo '<td>'.$no.'</td>';
        echo '<td>'.$itemBarang['barang_nomor'].'</td>';
        echo '<td>'.$itemBarang['barang_uraian'].'</td>';
        // echo '<td></td>';
        echo '<td>'.$itemBarang['orderdet_qty'].'</td>';
        echo '<td>'.$itemBarang['satuan_nama'].'</td>';
        echo '<td>
                  <table width="100%">
                    <tr>
                      <td align="left">Rp.</td>
                      <td align="right">'.number_format($itemBarang['orderdet_harga_satuan'],"0", ",", ".").'</td>
                    </tr>
                  </table>
              </td> ';
        $order_totdisc = $itemBarang['orderdet_total'];
        if ($itemBarang['orderdet_disc']>0) {
          $order_totdisc = $itemBarang['orderdet_total']-($itemBarang['orderdet_disc']/100*$itemBarang['orderdet_harga_satuan']*$itemBarang['orderdet_qty']);
        }
        echo '<td>'.$itemBarang['orderdet_disc'].'</td>';

        echo '<td>
                <table width="100%">
                  <tr>
                    <td align="left">Rp.</td>
                    <td align="right">'.number_format($order_totdisc,"0", ",", ".").'</td>
                  </tr>
                </table>
            </td>';

        echo '</tr>';
        $no++;
      }
    ?>
	<tr>
		<td colspan="8"><small>Catatan: Jika tidak sesuai pesanan, barang/jasa akan dikembalikan/dibatalkan untuk
		setiap pengiriman, harap mencantumkan no. PO di surat jalan</small></td>
	</tr>
	<tr>
		<td colspan="6" rowspan="3">
			Terbilang : <?= $val[0]['order_terbilang'] ?> rupiah
		</td>
		<td>Sub Total</td>
    <td><table width="100%">
      <tr>
        <td align="left">Rp.</td>
        <td align="right"><?= number_format($val[0]['order_subtotal'],"0", ",", ".") ?></td>
      </tr>
    </table></td>

	</tr>
	<tr>
		<td>PPN <?= $val[0]['order_ppn'] ?>%</td>
    <td><table width="100%">
      <tr>
        <td align="left">Rp.</td>
        <td align="right"><?= number_format(($val[0]['order_ppn']*$val[0]['order_subtotal']/100),"0", ",", ".") ?></td>
      </tr>
    </table></td>

	</tr>
	<tr>
		<td>TOTAL</td>
    <td><table width="100%">
      <tr>
        <td align="left">Rp.</td>
        <td align="right"><?= number_format($val[0]['order_total'],"0", ",", ".") ?></td>
      </tr>
    </table></td>

	</tr>
</table>
<p>&nbsp;</p>
<!-- <p>&nbsp;</p><br>
<table width="101%" border="1" cellspacing="0" rules="all" cellpadding="6">
	<tr>
		<th width="5%" scope="col">No.</th>
		<th width="14%" scope="col">Artikel</th>
		<th width="35%" scope="col">Uraian dan Spesifikasi Barang/Jasa</th>
		<th width="5%" scope="col">Qty</th>
		<th width="8%" scope="col">Satuan</th>
		<th width="14%" scope="col">Harga Satuan</th>
		<th width="19%" scope="col">Total</th>
	</tr>
  <?php
      $no = 1;
      foreach ($val2 as $barang => $itemBarang)
      {
        echo '<tr align="left">';
        echo '<td>'.$no.'</td>';
        echo '<td>'.$itemBarang['barang_nomor'].'</td>';
        echo '<td>'.$itemBarang['barang_uraian'].'</td>';
        // echo '<td></td>';
        echo '<td>'.$itemBarang['orderdet_qty'].'</td>';
        echo '<td>'.$itemBarang['satuan_nama'].'</td>';
        echo '<td><table width="100%">
                  <tr>
                  <td align="left">Rp.</td>
                  <td align="right">'.number_format($itemBarang['orderdet_harga_satuan'],"0", ",", ".").'</td>
                  </tr>
              </table></td> ';

        echo '<td><table width="100%">
                <tr>
                  <td align="left">Rp.</td>
                  <td align="right">'.number_format($itemBarang['orderdet_total'],"0", ",", ".").'</td>
                </tr>
              </table></td>';

        echo '</tr>';
        $no++;
      }
    ?>
	<tr>
		<td colspan="7"><small>Catatan: Jika tidak sesuai pesanan, barang/jasa akan dikembalikan/dibatalkan untuk
		setiap pengiriman, harap mencantumkan no. PO di surat jalan</small></td>
	</tr>
	<tr>
		<td colspan="5" rowspan="3">
			Terbilang : <?= $val[0]['order_terbilang'] ?> rupiah
		</td>
		<td>Sub Total</td>
    <td><table width="100%">
      <tr>
        <td align="left">Rp.</td>
        <td align="right"><?= number_format($val[0]['order_subtotal'],"0", ",", ".") ?></td>
      </tr>
    </table></td>

	</tr>
	<tr>
		<td>PPN <?= $val[0]['order_ppn'] ?>%</td>
    <td><table width="100%">
      <tr>
        <td align="left">Rp.</td>
        <td align="right"><?= number_format(($val[0]['order_ppn']*$val[0]['order_subtotal']/100),"0", ",", ".") ?></td>
      </tr>
    </table></td>

	</tr>
	<tr>
		<td>TOTAL</td>
    <td><table width="100%">
      <tr>
        <td align="left">Rp.</td>
        <td align="right"><?= number_format($val[0]['order_total'],"0", ",", ".") ?></td>
      </tr>
    </table></td>

	</tr>
</table> -->
<table width="50%" border="0">
  <tr>
    <td width="28%">Tanggal Kirim</td>
    <td width="2%">:</td>
    <td width="70%"><?= $val[0]['order_tanggal'] ?></td>
  </tr>
  <tr>
    <td>Pembayaran</td>
    <td>:</td>
    <td><?php
    if($val[0]['order_pembayaran'] == 0)
    {
      echo 'Tunai';
    }
    else
    {
      echo 'Term of Payment';
    }
    ?></td>
  </tr>
  <?php
    if($val[0]['order_pembayaran'] == 1)
    {
      echo "<tr>
          <td>Term of Payment</td>
          <td>:</td>
          <td>".$val[0]['order_top']." Hari</td>
        </tr>";
    }
    ?>

</table>
<p>&nbsp;</p>
<table width="81%" border="1" cellspacing="0">
  <tr>
    <td width="25%"><div align="center">Disetujui</div></td>
    <td width="25%"><div align="center">Disetujui</div></td>
    <td width="25%"><div align="center">Disetujui</div></td>
    <td width="25%"><div align="center">Disetujui</div></td>
  </tr>
  <tr>
    <td height="8%">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><div align="center">Supplier</div></td>
    <td><div align="center">Direktur</div></td>
    <td><div align="center">Kabag Pembelian</div></td>
    <td><div align="center">Staf Pembelian</div></td>
  </tr>
</table>


  </body>
</html>
