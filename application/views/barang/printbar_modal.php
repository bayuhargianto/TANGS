<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       <h4 class="modal-title"><?php echo $barang->barang_nama; ?></h4>
</div>
  <div class="modal-body">
    <center>
      <input type="hidden" id="barang_idbar" name="barang_idbar" value="<?php echo $barang->barang_id?>">
      <input type="number" id="print_qtybar" class="form-control" name="" value="">
      <br>
      <img src="<?php echo site_url();?>C_barang/printpricetagbarcode_/<?php echo $barang->barang_kode;?>" id="image_barcode">
    </center>
  </div>
  <div class="modal-footer">
    <button id="btn-print" type="button" class="btn btn-primary">Print</button>
    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
  </div>

<script type="text/javascript">
  // $('#formprint').submit(function(){
  //   $.ajax({
  //          type: "POST",
  //          url: url,
  //          data: $("#idForm").serialize(), // serializes the form's elements.
  //          success: function(data)
  //          {
  //
  //          }
  //        });
  // });

  $('#btn-print').on('click', function(){
    var barang_id = $('#barang_idbar').val();
    var print_qty = $('#print_qtybar').val();

    window.open("<?php echo base_url()?>C_barang/printBarcode/"+barang_id+"/"+print_qty);
    // $('#modal_print_bar').modal('hide');
  });
</script>
