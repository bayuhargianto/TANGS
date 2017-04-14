            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- BEGIN PAGE HEAD-->
                    <div class="page-head">
                        <!-- BEGIN PAGE TITLE -->
                        <div class="page-title">
                            <h1><?php if(isset($title_page)) echo $title_page;?>
                                <small><?php if(isset($title_page2)) echo $title_page2;?></small>
                            </h1>
                        </div>
                        <!-- END PAGE TITLE -->
                        <!-- END PAGE TOOLBAR -->
                    </div>
                    <!-- END PAGE HEAD-->
                    <!-- BEGIN PAGE BREADCRUMB -->
                    <ul class="page-breadcrumb breadcrumb">
                        <li>
                            <a href="<?php echo base_url();?>"> Dashboard </a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <a href="#"> Master Data </a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <span class="active"><?php if(isset($title_page)) echo $title_page;?></span>
                        </li>
                    </ul>
                    <!-- END PAGE BREADCRUMB -->
                    <!-- BEGIN PAGE BASE CONTENT -->
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet light portlet-fit portlet-datatable bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class=" icon-list font-dark"></i> &nbsp;&nbsp;
                                        <span class="caption-subject font-dark sbold uppercase">Data <?php if(isset($title_page2)) echo $title_page2;?></span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="table-toolbar">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="btn-group">
                                                  <?php
                                                    if($priv_add == 1)
                                                    {
                                                      $this->session->flashdata('msg');
                                                      
                                                      echo '<button id="modalAdd-btn" class="btn sbold dark" data-toggle="modal" onclick="openFormBarang(),reset()"><i class="icon-plus"></i>&nbsp; Tambah Data
                                                      </button>';
                                                      echo '<button id="btn1" class="btn sbold dark" data-toggle="modal"><i class="icon-doc"></i>&nbsp; Import Data
                                                      </button><br><br>
                                                      <form action="#" class="dropzone dropzone-file-area" id="contoh1" style="width: 1000px;">
                                                        <h3 class="sbold">Drop files here or click to import excel files</h3>
                                                        <div class="fallback">
                                                          <input name="file" type="file" multiple />
                                                        </div>
                                                      </form>';
                                                    }
                                                  ?>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="default-table">
                                        <thead>
                                            <tr>
                                                <th> No </th>
                                                <th> Barcode </th>
                                                <th> Description </th>
                                                <th> Category 1 </th>
                                                <th> Stok </th>
                                                <th> Satuan Barang </th>
                                                <th> Status </th>
                                                <th> Action </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- END EXAMPLE TABLE PORTLET-->
                        </div>
                    </div>
                    <!-- END PAGE BASE CONTENT -->
                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
        </div>
        <!-- END CONTAINER -->

        <?php $this->load->view('layout/V_footer');?>

        <script type="text/javascript">

            $(document).ready(function(){
                searchData();
                
                $("#btn1").click(function(){
                  $("#contoh1").toggle(500);
                });
            });

            function searchData() { 
                $('#default-table').DataTable({
                    destroy: true,
                    "processing": true,
                    "serverSide": true,
                    ajax: {
                      url: '<?php echo base_url();?>Master-Data/Barang/loadData/'
                    },
                    "columns": [
                      {"name": "no","orderable": false,"searchable": false,  "className": "text-center", "width": "5%"},
                      {"name": "barang_kode"},
                      {"name": "barang_nama"},
                      {"name": "jenis_barang_nama"},
                      {"name": "stok"},
                      {"name": "m_satuan_id"},
                      {"name": "barang_status_aktif"},
                      {"name": "action","orderable": false,"searchable": false, "className": "text-center", "width": "20%"}
                    ],
                    // Internationalisation. For more info refer to http://datatables.net/manual/i18n
                    "language": {
                        "aria": {
                            "sortAscending": ": activate to sort column ascending",
                            "sortDescending": ": activate to sort column descending"
                        },
                        "emptyTable": "No data available in table",
                        "info": "Showing _START_ to _END_ of _TOTAL_ records",
                        "infoEmpty": "No records found",
                        "infoFiltered": "(filtered1 from _MAX_ total records)",
                        "lengthMenu": "Show _MENU_",
                        "search": "Search:",
                        "zeroRecords": "No matching records found",
                        "paginate": {
                            "previous":"Prev",
                            "next": "Next",
                            "last": "Last",
                            "first": "First"
                        }
                    },

                    // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
                    // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js). 
                    // So when dropdowns used the scrollable div should be removed. 
                    //"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

                    "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.
                    "pagingType": "bootstrap_extended",

                    "lengthMenu": [
                        [10, 25, 50, 100],
                        [10, 25, 50, 100] // change per page values here
                    ],
                    // set the initial value
                    "pageLength": 10,
                    "columnDefs": [{  // set default column settings
                        'orderable': false,
                        'targets': [0]
                    }, {
                        "searchable": false,
                        "targets": [0]
                    }],
                    "order": [
                        [1, "asc"]
                    ],
                    "iDisplayLength": 10
                });
            }

              function editData(id) {
                $.ajax({
                  type : "GET",
                  url  : '<?php echo base_url();?>Master-Data/Barang/loadDataWhere/',
                  data : "id="+id,
                  dataType : "json",
                  success:function(data){
                    for(var i=0; i<data.val.length;i++){
                      document.getElementsByName("kode")[0].value = data.val[i].kode;
                      document.getElementsByName("barang_kode")[0].value = data.val[i].barang_kode;
                      document.getElementsByName("barang_nomor")[0].value = data.val[i].barang_nomor;
                      document.getElementsByName("barang_nama")[0].value = data.val[i].barang_nama;
                      document.getElementsByName("barang_minimum_stok")[0].value = data.val[i].barang_minimum_stok;
                      document.getElementsByName("harga_jual")[0].value = data.val[i].harga_jual;
                      document.getElementsByName("harga_beli")[0].value = data.val[i].harga_beli;
                      for(var j=0; j<data.val[i].m_jenis_barang_id.val2.length; j++){
                        $("#m_jenis_barang_id").append('<option value="'+data.val[i].m_jenis_barang_id.val2[j].id+'" selected>'+data.val[i].m_jenis_barang_id.val2[j].text+'</option>');
                      }
                      for(var j=0; j<data.val[i].m_brand_id.val2.length; j++){
                        $("#m_brand_id").append('<option value="'+data.val[i].m_brand_id.val2[j].id+'" selected>'+data.val[i].m_brand_id.val2[j].text+'</option>');
                      }
                      for(var j=0; j<data.val[i].m_satuan_id.val2.length; j++){
                        $("#m_satuan_id").append('<option value="'+data.val[i].m_satuan_id.val2[j].id+'" selected>'+data.val[i].m_satuan_id.val2[j].text+'</option>');
                      }
                      if (data.val[i].barang_status_aktif == 'y') {
                        document.getElementById('aktif').selected = true;
                      } else if (data.val[i].barang_status_aktif == 'n') {
                        document.getElementById('nonaktif').selected = true;
                      }
                    }
                  }
                });
              }

              function deleteData(id) {
                swal({
                  title: "Apakah anda yakin?",
                  text: "Data akan dinonaktifkan !",
                  type: "warning",
                  showCancelButton: true,
                  cancelButtonClass: "btn-raised btn-warning",
                  cancelButtonText: "Batal!",
                  confirmButtonClass: "btn-raised btn-danger",
                  confirmButtonText: "Ya!",
                  closeOnConfirm: false
                }, function() {
                  $.ajax({
                    url: '<?php echo base_url();?>Master-Data/Barang/deleteData/',
                    data: 'id='+id,
                    type: 'POST',
                    dataType: 'json',
                    success: function (data) {
                      if (data.status=='200') {
                        alert_success_nonaktif();
                        searchData();
                      } else if (data.status=='204') {
                        alert_fail_nonaktif();
                      }
                    }
                  });
                })
              }

              function aktifData(id) {
                swal({
                  title: "Apakah anda yakin?",
                  text: "Data akan diaktifkan !",
                  type: "warning",
                  showCancelButton: true,
                  cancelButtonClass: "btn-raised btn-warning",
                  cancelButtonText: "Batal!",
                  confirmButtonClass: "btn-raised btn-danger",
                  confirmButtonText: "Ya!",
                  closeOnConfirm: false
                }, function() {
                  $.ajax({
                    url: '<?php echo base_url();?>Master-Data/Barang/aktifData/',
                    data: 'id='+id,
                    type: 'POST',
                    dataType: 'json',
                    success: function (data) {
                      if (data.status=='200') {
                        alert_success_aktif();
                        searchData();
                      } else if (data.status=='204') {
                        alert_fail_aktif();
                      }
                    }
                  });
                })
              }

              function editDataValue(id) {
                $.ajax({
                  type : "GET",
                  url  : '<?php echo base_url();?>Master-Data/Value-Barang/loadDataValueWhere/',
                  data : "id="+id,
                  dataType : "json",
                  success:function(data){
                    for(var i=0; i<data.val.length;i++){
                      document.getElementsByName("kode")[0].value = data.val[i].kode;
                      document.getElementsByName("barang_kode")[0].value = data.val[i].barang_kode;
                      document.getElementsByName("barang_nama")[0].value = data.val[i].barang_nama;
                      $("#m_jenis_barang_id").select2('destroy');
                      for(var j=0; j<data.val[i].m_jenis_barang_id.val2.length; j++){
                        $("#m_jenis_barang_id").append('<option value="'+data.val[i].m_jenis_barang_id.val2[j].id+'" selected>'+data.val[i].m_jenis_barang_id.val2[j].text+'</option>');
                        $("#m_jenis_barang_id").select2();
                      }
                      $("#m_brand_id").select2('destroy');
                      for(var j=0; j<data.val[i].m_brand_id.val2.length; j++){
                        $("#m_brand_id").append('<option value="'+data.val[i].m_brand_id.val2[j].id+'" selected>'+data.val[i].m_brand_id.val2[j].text+'</option>');
                        $("#m_brand_id").select2();
                      }
                      document.getElementsByName("barang_minimum_stok")[0].value = data.val[i].barang_minimum_stok;
                      // for(var j=0; j<data.val[i].m_jenis_barang_id.val2.length; j++){
                      //   $("#m_jenis_barang_id").append('<option value="'+data.val[i].m_jenis_barang_id.val2[j].id+'" selected>'+data.val[i].m_jenis_barang_id.val2[j].text+'</option>');
                      // }
                      $("#m_satuan_id").select2('destroy');
                      for(var j=0; j<data.val[i].m_satuan_id.val2.length; j++){
                        $("#m_satuan_id").append('<option value="'+data.val[i].m_satuan_id.val2[j].id+'" selected>'+data.val[i].m_satuan_id.val2[j].text+'</option>');
                        $("#m_satuan_id").select2();
                      }
                    }

                    for(var i=0; i<data.attribut.length;i++){

                      var value_input = data.attribut[i].atribut_default_value;
                      for(var j=0; j<data.value_attribut.length;j++){
                        if (data.value_attribut[j].referensi_type == 1 && data.value_attribut[j].referensi_id == data.attribut[i].atribut_id) {
                          var value_input = data.value_attribut[j].value;
                        }
                      }

                      // CHECK TYPE
                      if (data.attribut[i].atribut_jenis == 3) {
                        if (data.attribut[i].atribut_satuan != null) {
                          var input_type = '\
                          <div class="col-md-8">\
                            <div class="input-group">\
                              <div class="input-icon right">\
                                  <i class="fa"></i>\
                                  <input type="text" class="form-control" name="value[]" value="'+value_input+'" required/>\
                              </div>\
                              <div class="input-group-addon">'+data.attribut[i].atribut_satuan+'</div>\
                            </div>\
                          </div>';
                        } else {
                          var input_type = '\
                          <div class="col-md-8">\
                              <div class="input-icon right">\
                                  <i class="fa"></i>\
                                  <input type="text" class="form-control" name="value[]" value="'+value_input+'" required/>\
                              </div>\
                          </div>';
                        }
                      } else if (data.attribut[i].atribut_jenis == 2) {
                        var input_type = '\
                        <div class="col-md-8">\
                            <div class="input-icon right">\
                                <i class="fa"></i>\
                                <textarea class="form-control" rows="3" name="value[]" required>'+value_input+'</textarea>\
                            </div>\
                        </div>';
                      } else if (data.attribut[i].atribut_jenis == 1) {
                        defaultValue = jQuery.parseJSON(data.attribut[i].atribut_default_value);
                        var option = '';
                        var selected = '';
                        for (var j = 0; j < defaultValue.length; j++) {
                          if (data.attribut[i].value_real == 1) {
                            if (defaultValue[j].id == value_input) {
                              var selected = 'selected';
                            } else {
                              var selected = '';
                            }
                          }
                          option += '<option value="'+defaultValue[j].id+'" '+selected+'> '+defaultValue[j].nama+' </option>';
                        }
                        var input_type = '\
                        <div class="col-md-8">\
                            <div class="input-icon right">\
                                <i class="fa"></i>\
                                <select class="form-control select2" name="value[]" aria-required="true" aria-describedby="select-error" required>\
                                '+option+'\
                                </select>\
                            </div>\
                        </div>';
                      }

                      $("#attribut-barang").append('\
                        <div class="form-group">\
                          <input type="hidden" class="form-control" name="referensi_type[]" value="1"/>\
                          <input type="hidden" class="form-control" name="referensi_id[]" value="'+data.attribut[i].atribut_id+'"/>\
                          <label class="control-label col-md-4">'+data.attribut[i].atribut_nama+'\
                              <span class="required"> * </span>\
                          </label>\
                          '+input_type+'\
                        </div>\
                        <div id="sub-attribut-barang'+data.attribut[i].atribut_id+'">\
                        </div>\
                      ');
                    }

                    for(var i=0; i<data.subattribut.length;i++){

                      var value_input = data.subattribut[i].atribut_default_value;
                      for(var j=0; j<data.value_subattribut.length;j++){
                        if (data.value_subattribut[j].referensi_type == 2 && data.value_subattribut[j].referensi_id == data.attribut[i].atribut_id) {
                          var value_input = data.value_subattribut[j].value;
                        }
                      }

                      
                      // CHECK TYPE
                      if (data.subattribut[i].sub_atribut_jenis == 3) {
                        if (data.subattribut[i].sub_atribut_satuan != null) {
                          var input_type = '\
                          <div class="col-md-6">\
                            <div class="input-group">\
                              <div class="input-icon right">\
                                  <i class="fa"></i>\
                                  <input type="text" class="form-control" name="value[]" value="'+value_input+'" required/>\
                              </div>\
                              <div class="input-group-addon">'+data.subattribut[i].sub_atribut_satuan+'</div>\
                            </div>\
                          </div>';
                        } else {
                          var input_type = '\
                          <div class="col-md-6">\
                              <div class="input-icon right">\
                                  <i class="fa"></i>\
                                  <input type="text" class="form-control" name="value[]" value="'+value_input+'" required/>\
                              </div>\
                          </div>';
                        }
                      } else if (data.subattribut[i].sub_atribut_jenis == 2) {
                        var input_type = '\
                        <div class="col-md-6">\
                            <div class="input-icon right">\
                                <i class="fa"></i>\
                                <textarea class="form-control" rows="3" name="value[]" required>'+value_input+'</textarea>\
                            </div>\
                        </div>';
                      } else if (data.subattribut[i].sub_atribut_jenis == 1) {
                        defaultValue = jQuery.parseJSON(data.subattribut[i].sub_atribut_default_value);
                        var option = '';
                        var selected = '';
                        for (var j = 0; j < defaultValue.length; j++) {
                          if (data.subattribut[i].value_real == 1) {
                            if (defaultValue[j].id == value_input) {
                              var selected = 'selected';
                            } else {
                              var selected = '';
                            }
                          }
                          option += '<option value="'+defaultValue[j].id+'" '+selected+'> '+defaultValue[j].nama+' </option>';
                        }
                        var input_type = '\
                        <div class="col-md-6">\
                            <div class="input-icon right">\
                                <i class="fa"></i>\
                                <select class="form-control select2" name="value[]" aria-required="true" aria-describedby="select-error" required>\
                                '+option+'\
                                </select>\
                            </div>\
                        </div>';
                      }

                      $("#sub-attribut-barang"+data.subattribut[i].atribut_id).append('\
                        <div class="form-group">\
                          <input type="hidden" class="form-control" name="referensi_type[]" value="2"/>\
                          <input type="hidden" class="form-control" name="referensi_id[]" value="'+data.subattribut[i].sub_atribut_id+'"/>\
                          <label class="control-label col-md-offset-2 col-md-4">'+data.subattribut[i].sub_atribut_nama+'\
                              <span class="required"> * </span>\
                          </label>\
                          '+input_type+'\
                        </div>\
                      ');
                    }

                  }
                });
              }
        </script>

    </body>

</html>