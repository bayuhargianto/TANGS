<!-- <div class="modal-header">
  <center>

</center>
</div> -->
<?php
$aktif = 0;
if ($barang->det_promo_status_aktif != '' || $barang->promo_status_aktif != '') {
    $aktif = 1;
  } else {
    $aktif = 0;
  }
 ?>
  <div class="modal-body">
    <center>
      <span class="modal-title"><?php echo $barang->barang_nama ?></span>
      <h2>STOK PADA GUDANG HABIS<h2>
    </center>
    <center>
      <button id="btn_booking" type="button" class="btn btn-primary" data-disc="" data-qty="1" data-price="<?php echo $barang->harga_jual_pajak?>"
      data-name="<?php echo $barang->barang_nama?>" data-id="<?php echo $barang->barang_id?>" data-has-promo="<?php echo $aktif?>" data-promo-harga="" data-promo-type=""
      data-status-aktif="" data-stok-gudang="<?php echo $barang->stok_gudang_jumlah?>" data-promo-item-name="<?php echo $barang->promo_nama?>"
      data-promo-gratis="" data-promo-qty="<?php echo $barang->promo_qty?>">
        Booking
      </button>
      <button type="button" class="btn btn-danger" data-dismiss="modal">Tidak</button>
    </center>
  </div>
<script type="text/javascript">
  $("#btn_booking").on('click', function(){
    $.fn.addCart($(this));
    $('#booking_modal').modal('hide');
  });
</script>
