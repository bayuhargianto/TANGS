<div class="modal-header">

</div>
<form id="formLogin" action="<?php echo $action?>">
  <div class="modal-body">
    <div class="form-group">
      <label for="">Username</label>
      <input type="text" name="i_username" value="" class="form-control">
    </div>
    <div class="form-group">
      <label for="">Password</label>
      <input type="password" name="i_password" value="" class="form-control">
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" name="button" class="btn btn-primary" onclick="check_login()">Ok</button>
    <button type="button" name="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
  </div>
</form>

<script type="text/javascript">
  function check_login()
  {
    // if ($("#formLogin").valid() == true) {
    $.ajax({
      type : "POST",
      url  : '<?php echo base_url();?>'+$("#formLogin").attr('action'),
      data : $( "#formLogin" ).serialize(),
      dataType : "json",
      success : function(data){
        if (data.status=='200') {
          $('#modal_login').modal('hide');
          $('#my-modal-disc').modal('show');
          $('#type_karyawan').val(data.type_karyawan);
        } else if (data.status=='204') {

        }
      }
    })
    // }
    // return false;
  }
</script>
