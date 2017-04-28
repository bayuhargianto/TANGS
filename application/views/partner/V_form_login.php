<!-- BEGIN FORM-->
    <form action="#" id="login" class="form-horizontal" method="post" enctype="multipart/form-data">
        <div class="form-body">
            <input type="hidden" class="form-control" name="id_partner" value="<?php echo $id_partner ?>" />
            <div class="form-group">
                <label class="control-label col-md-4">Username
                    <span class="required"> * </span>
                </label>
                <div class="col-md-8">
                    <div class="input-icon right">
                        <i class="fa"></i>
                        <input type="text" class="form-control" name="username" required /> </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4">Password
                    <span class="required"> * </span>
                </label>
                <div class="col-md-8">
                    <div class="input-icon right">
                        <i class="fa"></i>
                        <input type="password" class="form-control" name="password" required /> </div>
                </div>
            </div>
        </div>
        <div class="form-actions">
            <div class="row">
                <div class="col-md-offset-4 col-md-8 text-right">
                    <button type="submit" class="btn green-jungle" id="login">Submit</button>
                </div>
            </div>
        </div>
    </form>

    
    <!-- END FORM-->
    <script type="text/javascript">
        $("#login").submit(function(event){
            $.ajax({
              url: $base_url+'Login/doLogin',
              type: 'POST',
              data: $( "#login" ).serialize(),
              dataType: 'json',
              success: function (data) {
                if (data.status=='200') {
                    var s = <?php echo $s ?>;
                    if (s == 'aktif'){
                      $.ajax({
                        url: '<?php echo base_url();?>Master-Data/Partner/aktifData/',
                        data: 'id='+<?php echo $id_partner ?>,
                        type: 'POST',
                        dataType: 'json',
                        success: function (data) {
                          if (data.status=='200') {
                            alert_success_aktif();
                            searchData();
                             window.location = $base_url+'Master-Data/Partner/';
                          } else if (data.status=='204') {
                            alert_fail_aktif();
                          }
                        }
                      });
                    }else{
                      $.ajax({
                        url: $base_url+'Master-Data/Partner/deleteData/',
                        data: 'id='+<?php echo $id_partner ?>,
                        type: 'POST',
                        dataType: 'json',
                        success: function (data) {
                          if (data.status=='200') {
                            alert_success_nonaktif();
                            searchData();
                             window.location = $base_url+'Master-Data/Partner/';
                          } else if (data.status=='204') {
                            alert_fail_nonaktif();
                          }
                        }
                      });
                    }
                     
                } else if (data.status=='204') {
                    swal({
                      title: "Warning",
                      text: "Username atau Password yang Anda Masukkan Salah !",
                      type: "warning",
                      confirmButtonClass: "btn-raised btn-danger",
                      confirmButtonText: "OK"
                    })
                }
              }
          });
        });
    </script>