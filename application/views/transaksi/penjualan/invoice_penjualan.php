<?php
/*
$outprint = "Just the test printer";
$printer = printer_open("58 Printer(1)");
printer_set_option($printer, PRINTER_MODE, "RAW");
printer_start_doc($printer, "Tes Printer");
printer_start_page($printer);
printer_write($printer, $outprint);
printer_end_page($printer);
printer_end_doc($printer);
printer_close($printer);
*/
?>
<style type="text/css">
body{
	font-family:"Palatino Linotype", "Book Antiqua", Palatino, serif;
}

@media print{
  .back_to_order{
    display: none;
  }
}

.frame{
	border:1px solid #000;
	width:10%;
	margin-left:auto;
	margin-right:auto;
	padding:10px;
}
table{
	font-size:14px;

}
.header{
	text-align:center;
	font-weight:bold;
	font-size:11px;

}
.header_img{

	width:164px;
	height:79px;
	margin-left:auto;
	margin-right:auto;
	margin-bottom:10px;
}

.back_to_order{
	width:10%;
	margin-left:auto;
	margin-right:auto;
	color:#fff;
	font-weight:bold;
	background:#09F;
	text-align:center;
	border-radius:10px;
	margin-top:10px;
	padding:5px;height:30px;
}
.back_to_order:hover{
	background:#069;
}

.logo-print{
	width: 120px;
	height: auto;
}

</style>

<!-- E:\penting\htdocs\proyek-jsw-master\assets\tangs-logo.jpg -->

<body  onload=print()>
  <div class="header">
<img class="logo-print" src="<?php echo base_url();?>assets/tangs-logo.jpg" alt="">
<span style="font-size:14px;"></span><br>
<span style="font-size:14px;"></span><br>
<span style="font-size:14px;"></span><br>
</div>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding-top: 5;font-size:12px;width:100%;">
	<tr>
		<td><?php echo $transaksi->penjualan_code?></td>
	</tr>
  <tr>
    <td align="right" ><?php echo $transaksi->penjualan_date ?></td>
  </tr>
</table>
<table style="width:100%;">
  <?php
    $no_item = 1;
    $total_price = 0;
		$total_diskon_item = 0;
    foreach ($transaksi_detail->result() as $r_transaksi_detail) {?>
			<tr>
				<td style="text-align:center;width:5%;"><?php echo $no_item; ?></td>
        <td><?php echo $r_transaksi_detail->barang_nama?></td>
				<td style="text-align:center;"><?php echo $r_transaksi_detail->barang_qty?> X <?php echo number_format($r_transaksi_detail->barang_price)?></td>
				<td style="text-align:right;"><?php echo number_format($r_transaksi_detail->barang_price*$r_transaksi_detail->barang_qty)?></td>
      </tr>
      <tr>
        <td style="text-align:center;">&nbsp;</td>
				<td style="text-align:center;">&nbsp;</td>
				<td style="text-align:center;"></td>
				<td style="text-align:right;"><?php echo number_format($r_transaksi_detail->barang_discount_nominal)?></td>
      </tr>
    <?php
		$total_diskon_item = $total_diskon_item + $r_transaksi_detail->barang_discount_nominal;
		$no_item++;} ?>
</table>
<table style="width:100%;">
	<tr>
		<td	><strong>Total</strong></td>
		<td align="right"><strong><?php echo number_format($transaksi->penjualan_total)?></strong></td>
	</tr>
	<tr>
		<td	><strong>Discount All</strong></td>
		<td align="right"><strong><?php echo number_format($transaksi->penjualan_all_discount_nominal)?></strong></td>
	</tr>
	<tr>
		<td	><strong>Total Discount Item</strong></td>
		<td align="right"><strong><?php echo number_format($total_diskon_item)?></strong></td>
	</tr>
	<?php $discount = $transaksi->penjualan_all_discount_nominal + $total_diskon_item;?>
	<tr>
		<td><strong>Total All Discount</strong></td>
		<td align="right"><strong><?php echo number_format($discount)?></strong></td>
	</tr>
	<tr>
		<td><strong>Bayar</strong></td>
		<td align="right"><strong><?php echo number_format($transaksi->penjualan_grand_total)?></strong></td>
	</tr>
</table>
  <div class=""  style="text-align:center;">
		<button type="button" class="back_to_order" onclick="back_to_order()">Back To Order</button>
  </div>
</body>
<script type="text/javascript">
	function back_to_order(){
		window.close();
	}
</script>
