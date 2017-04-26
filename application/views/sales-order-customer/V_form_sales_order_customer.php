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
                            <a href="#"> <?php if(isset($title_page)) echo $title_page;?> </a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <span class="active"><?php if(isset($title_page2)) echo $title_page2;?></span>
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
                                        <i class=" icon-doc font-dark"></i> &nbsp;&nbsp;
                                        <span class="caption-subject font-dark sbold uppercase">Form  <?php if(isset($title_page2)) echo $title_page2;?></span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                <!-- BEGIN FORM-->
                                <form action="#" id="formAdd" class="form-horizontal" method="post">
                                    <div class="form-body">
                                        <div class="alert alert-danger display-hide">
                                            <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
                                        <div class="alert alert-success display-hide">
                                            <button class="close" data-close="alert"></button> Your form validation is successful! </div>
                                        <input type="hidden" id="url" value="Penjualan/Sales-Order-Customer/postData/">
                                        <input type="hidden" id="url_data" value="Penjualan/Sales-Order-Customer">
                                        <input type="hidden" name="so_customer_status" value="0">
                                        <div class="form-group" id="kode" hidden="true">
                                            <label class="control-label col-md-4">ID Sales Order (Auto)
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" class="form-control" name="kode" value="<?php if(isset($id)) echo $id;?>" readonly /> </div>
                                            </div>
                                        </div>
                                        <div class="form-group" id="KodeSO" hidden="true">
                                            <label class="control-label col-md-4">Kode Sales Order (Auto)
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" class="form-control" name="so_customer_nomor" readonly /> </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Tanggal Sales Order
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <div class=" input-group">
                                                        <input name="so_customer_tanggal" type="text" value="<?php echo date('d/m/Y');?>" class="form-control" readonly>
                                                        <span class="input-group-addon" style="">
                                                            <span class="icon-calendar"></span>
                                                        </span>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Nomor PO Customer
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-7">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <select class="form-control" id="t_po_customer_id" name="t_po_customer_id" aria-required="true" aria-describedby="select-error" required>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <button type="button" id="btnAddPOCustomer" class="btn sbold dark" onclick="addPOCustomer()"><i class="icon-plus"></i></button>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Nama Customer
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" class="form-control" name="partner_nama" readonly /> </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Nama Cetak Customer
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <select class="form-control" name="nama_cetak" id="nama_cetak"></select> </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Alamat Customer
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <textarea class="form-control" rows="3" name="partner_alamat" readonly></textarea> </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Alamat Kirim
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <textarea class="form-control" rows="3" name="partner_alamat_kirim" readonly></textarea> </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Telp/Hp Customer
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <textarea class="form-control" rows="3" name="partner_telp" readonly></textarea> </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Nama Sales
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" class="form-control" name="karyawan_nama" readonly /> </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">PPN
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <label class="mt-radio"> Ya
                                                        <input type="radio" value="1" name="po_customer_ppn" id="po_customer_ppn1" disabled checked />
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-radio"> Tidak
                                                        <input type="radio" value="2" name="po_customer_ppn" id="po_customer_ppn2" disabled />
                                                        <span></span>
                                                    </label> </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group" id="tblInsert">
                                            <div class="col-md-12 table-scroll">
                                                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="default-table">
                                                    <thead>
                                                        <tr>
                                                            <th> No </th>
                                                            <th> Uraian dan Spesifikasi Barang </th>
                                                            <th> Kode Barang </th>
                                                            <th> Nama Barang </th>
                                                            <th> Qty PO Customer </th>
                                                            <th> Satuan </th>
                                                            <th colspan="2"> Harga Barang Satuan </th>
                                                            <th> Harga Barang Total </th>
                                                            <th> Keterangan </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th colspan="8" class="text-right"> Uang Muka Diterima </th>
                                                            <th>
                                                                <input type="text" class="form-control money" id="so_customer_dp" name="so_customer_dp" value="0" onchange="sumTotal()" required />
                                                            </th>
                                                            <th></th>
                                                        </tr>
                                                        <tr>
                                                            <th colspan="8" class="text-right"> Total </th>
                                                            <th>
                                                                <input type="text" class="form-control money" id="so_customer_total" name="so_customer_total" value="0" required readonly />
                                                            </th>
                                                            <th></th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Catatan
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <textarea class="form-control" rows="3" name="so_customer_catatan"></textarea> </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-4 col-md-8 text-right">
                                                <button type="submit" id="submit" class="btn green-jungle">Simpan</button>
                                                <a href="<?php echo base_url();?>Penjualan/Sales-Order-Customer">
                                                <button type="button" class="btn default">Kembali</button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <!-- END FORM -->
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
                rules();
                itemBarang = 0;
                $("#formAdd").submit(function(event){
                  if ($("#formAdd").valid() == true) {
                    actionData2();
                  }
                  return false;
                });
                $('#t_po_customer_id').css('width', '100%');
                selectList_POCustomer("#t_po_customer_id");
                if (document.getElementsByName("kode")[0].value.length >0) {
                    editData(document.getElementsByName("kode")[0].value);
                }
            });

            function addPOCustomer() {
                var id = document.getElementsByName('t_po_customer_id')[0].value;
                if (id.length > 0) {
                    getDetailPOCustomer(id);
                }
            }

            function getDetailPOCustomer(id, status = null) {
                $.ajax({
                  type : "GET",
                  url  : '<?php echo base_url();?>Marketing/Purchase-Order-Customer/loadDataWhere/',
                  data : "id="+id,
                  dataType : "json",
                  success:function(data){
                    $("#default-table tbody").empty();
                    for (var i = 0; i < data.val.length; i++) {
                        document.getElementsByName("partner_nama")[0].value = data.val[i].po_customer_nama_pelanggan;
                        document.getElementsByName("partner_alamat_kirim")[0].value = data.val[i].po_customer_alamat_kirim;
                        document.getElementsByName("karyawan_nama")[0].value = data.val[i].m_karyawan_id.val2[0].text;
                        if(data.val[i].po_customer_ppn == 1)
                        {
                            document.getElementById('po_customer_ppn1').checked = true;
                            $("#default-table thead").empty();
                            $("#default-table thead").append('<tr>\
                                <th rowspan="2" align="center"> No </th>\
                                <th rowspan="2" align="center"> Uraian dan Spesifikasi Barang </th>\
                                <th rowspan="2" align="center"> Kode Barang </th>\
                                <th rowspan="2" align="center"> Nama Barang </th>\
                                <th rowspan="2" align="center"> Qty PO Customer </th>\
                                <th rowspan="2" align="center"> Satuan </th>\
                                <th colspan="2" align="center"> Harga Barang Satuan </th>\
                                <th rowspan="2" align="center"> Harga Barang Total </th>\
                                <th rowspan="2" align="center"> Keterangan </th>\
                            </tr>\
                            <tr>\
                                <th align="center">DPP</th>\
                                <th align="center">PPN</th>\
                                <th colspan="2"></th>\
                            </tr>');
                        }
                        else
                        {
                            document.getElementById('po_customer_ppn2').checked = true;
                            $("#default-table thead").empty();
                            $("#default-table thead").append('<tr>\
                                <th> No </th>\
                                <th> Uraian dan Spesifikasi Barang </th>\
                                <th> Kode Barang </th>\
                                <th> Nama Barang </th>\
                                <th> Qty PO Customer </th>\
                                <th> Satuan </th>\
                                <th colspan="2"> Harga Barang Satuan </th>\
                                <th> Harga Barang Total </th>\
                                <th> Keterangan </th>\
                            </tr>');
                        }
                        $.ajax({
                          type : "GET",
                          url  : '<?php echo base_url();?>Master-Data/Partner/loadDataWhere/',
                          data : "id="+data.val[i].m_partner_id.val2[0].id,
                          dataType : "json",
                          success:function(data){
                            for(var j=0; j<data.val.length;j++){
                                document.getElementsByName("partner_alamat")[0].value = data.val[j].partner_alamat;
                                document.getElementsByName("partner_telp")[0].value = data.val[j].partner_telepon2;
                                var namaCetak = data.val[j].partner_nama_cetak.val2;
                                for(var j = 0; j < namaCetak.length; j++)
                                {
                                    $("#nama_cetak").append('<option value="'+namaCetak[j].text+'">'+namaCetak[j].text+'</option>');
                                }
                                $("#nama_cetak").select2();
                            }
                          }
                        });
                    }
                    itemBarang = data.val2.length;
                    for(var i = 0; i < data.val2.length; i++){
                        // STEP 1
                        if(document.getElementById('po_customer_ppn2').checked)
                        {
                            $("#default-table tbody").append('\
                                <tr>\
                                    <td>\
                                        '+(i+1)+'\
                                    </td>\
                                    <td>\
                                        '+data.val2[i].po_customerdet_barang_uraian+'\
                                    </td>\
                                    <td id="kode'+(i+1)+'">\
                                    </td>\
                                    <td>\
                                        <input type="hidden" class="form-control num2" id="po_customerdet_id'+(i+1)+'" name="po_customerdet_id[]" value="'+data.val2[i].po_customerdet_id+'" />\
                                        <select id="m_barang_id'+(i+1)+'" class="form-control" name="m_barang_id[]"></select>\
                                    </td>\
                                    <td>\
                                        <input type="text" class="form-control num2" id="orderdet_qty'+(i+1)+'" value="'+data.val2[i].po_customerdet_qty+'" readonly/>\
                                    </td>\
                                    <td id="satuan'+(i+1)+'">\
                                    </td>\
                                    <td colspan="2">\
                                        <input type="text" class="form-control money" id="orderdet_harga_satuan'+(i+1)+'" value="'+data.val2[i].po_customerdet_harga_satuan+'" readonly/>\
                                    </td>\
                                    <td>\
                                        <input type="text" class="form-control money" id="orderdet_total'+(i+1)+'" value="'+(data.val2[i].po_customerdet_qty * data.val2[i].po_customerdet_harga_satuan)+'" readonly/>\
                                    </td>\
                                    <td>\
                                        <textarea style="width:300px;" class="form-control" rows="3" readonly>'+data.val2[i].po_customerdet_keterangan+'</textarea>\
                                    </td>\
                                </tr>\
                            ');
                            // selectList_barang2("#m_barang_id"+(i+1));
                        }
                        else
                        {
                            var dpp = data.val2[i].po_customerdet_harga_satuan/1.1;
                            var ppn = data.val2[i].po_customerdet_harga_satuan/1.1*10/100;
                            $("#default-table tbody").append('\
                                <tr>\
                                    <td>\
                                        '+(i+1)+'\
                                    </td>\
                                    <td>\
                                        '+data.val2[i].po_customerdet_barang_uraian+'\
                                    </td>\
                                    <td id="kode'+(i+1)+'">\
                                    </td>\
                                    <td>\
                                        <input type="hidden" class="form-control num2" id="po_customerdet_id'+(i+1)+'" name="po_customerdet_id[]" value="'+data.val2[i].po_customerdet_id+'" />\
                                        <select id="m_barang_id'+(i+1)+'" class="form-control" style="width:200px;" name="m_barang_id[]" onchange="getKode('+(i+1)+')"></select>\
                                    </td>\
                                    <td>\
                                        <input type="text" class="form-control num2" id="orderdet_qty'+(i+1)+'" value="'+data.val2[i].po_customerdet_qty+'" readonly/>\
                                    </td>\
                                    <td id="satuan'+(i+1)+'">\
                                    </td>\
                                    <td>\
                                        <input type="text" class="form-control money" id="orderdet_dpp'+(i+1)+'" value="'+dpp+'" readonly/>\
                                    </td>\
                                    <td>\
                                        <input type="text" class="form-control money" id="orderdet_ppn'+(i+1)+'" value="'+ppn+'" readonly/>\
                                    </td>\
                                    <td>\
                                        <input type="text" class="form-control money" id="orderdet_total'+(i+1)+'" value="'+(data.val2[i].po_customerdet_qty * (dpp+ppn))+'" readonly/>\
                                    </td>\
                                    <td>\
                                        <textarea style="width:300px;" class="form-control" rows="3" readonly>'+data.val2[i].po_customerdet_keterangan+'</textarea>\
                                    </td>\
                                </tr>\
                            ');
                            
                            // $('.sel').css('width', '150px');
                        }
                        if((document.getElementsByName("kode")[0].value.length > 0) && ((status == 4)|| (status==1)))
                        {
                            $("#kode"+(i+1)).html(data.val2[i].barang_kode);
                            $("#satuan"+(i+1)).html(data.val2[i].satuan_nama);
                            $("#m_barang_id"+(i+1)).append('<option value="'+data.val2[i].m_barang_id+'">'+data.val2[i].barang_nama+'</option');
                            // document.getElementById('m_barang_id'+(i+1)).disabled = true;
                        }
                        else if((document.getElementsByName("kode")[0].value.length > 0) && ((status != 4)|| (status!=1))) {
                            $("#kode"+(i+1)).html(data.val2[i].barang_kode);
                            $("#satuan"+(i+1)).html(data.val2[i].satuan_nama);
                            $("#m_barang_id"+(i+1)).append('<option value="'+data.val2[i].m_barang_id+'">'+data.val2[i].barang_nama+'</option');
                            document.getElementById('m_barang_id'+(i+1)).disabled = true;
                        }
                        selectList_barang2("#m_barang_id"+(i+1));
                        $('.num2').number( true, 2, '.', ',' );
                        $('.num2').css('text-align', 'right');
                        $('.num2').css('width', '150px');
                        $('.money').number( true, 2, '.', ',' );
                        $('.money').css('text-align', 'right');
                        $('.money').css('width', '150px');
                        
                    }
                    sumTotal();
                  }
                });
            }

            function getKode(index) {
                var id = document.getElementById('m_barang_id'+index).value;
                $.ajax({
                    type : "GET",
                    url  : '<?php echo base_url();?>Master-Data/Barang/loadDataWhere/',
                    data : "id="+id,
                    dataType : "json",
                    success:function(data){
                        for(var i=0; i< data.val.length; i++)
                        {
                            $("#kode"+index).html(data.val[i].barang_kode);
                            $("#satuan"+index).html(data.val[i].m_satuan_id.val2[0].text);
                        }
                    }
                });
            }

            // function sumTotal() {
            //     subTotal = 0;
            //     for (var i = 1; i <= itemBarang; i++) {
            //         qty = parseFloat(document.getElementById('orderdet_qty'+i).value.re;
            //         hrg = parseInt(document.getElementById('orderdet_harga_satuan'+i).value.replace(/\./g, ""));
            //         document.getElementById('orderdet_total'+i).value = qty * hrg;
            //         subTotal += qty * hrg;
            //     }
            //     document.getElementById('order_subtotal').value = subTotal;
            //     $('.money').number( true, 2, '.', ',' );
            //     sumTotal();
            // }

            function sumTotal() {
                total = 0;
                for (var i = 1; i <= itemBarang; i++) {
                    subTotal = parseFloat(document.getElementById('orderdet_total'+i).value.replace(/\,/g, ""));
                    // ppn = parseInt(document.getElementById('order_ppn').value.replace(/\,/g, ""));
                    total = total + subTotal;
                }
                var dp = parseFloat(document.getElementById('so_customer_dp').value.replace(/\,/g, ""))
                total = total - dp;
                document.getElementById('so_customer_total').value = total;
                $('.money').number( true, 2, '.', ',' );
                $('.money').css('text-align', 'right');
                $('.money').css('width', '150px');
            }

            function editData(id, edit = null) {
                $.ajax({
                  type : "GET",
                  url  : '<?php echo base_url();?>Penjualan/Sales-Order-Customer/loadDataWhere/',
                  data : "id="+id,
                  dataType : "json",
                  success:function(data){
                    for(var i=0; i<data.val.length;i++){
                        $("#KodeSO").attr('hidden', false);
                        document.getElementsByName("kode")[0].value = data.val[i].kode;
                        document.getElementsByName("so_customer_nomor")[0].value = data.val[i].so_customer_nomor;
                        document.getElementsByName("so_customer_tanggal")[0].value = data.val[i].so_customer_tanggal;
                        document.getElementsByName("so_customer_dp")[0].value = data.val[i].so_customer_dp;
                        $("#t_po_customer_id").select2('destroy');
                        for(var j=0; j<data.val[i].t_po_customer_id.val2.length; j++){
                            getDetailPOCustomer(data.val[i].t_po_customer_id.val2[j].id, data.val[i].so_customer_status);
                            $("#t_po_customer_id").append('<option value="'+data.val[i].t_po_customer_id.val2[j].id+'" selected>'+data.val[i].t_po_customer_id.val2[j].text+'</option>');
                        }
                        // $("#nama_cetak").append('<option value="'+data.val[i].so_customer_nama_cetak+'">'+data.val[i].so_customer_nama_cetak+'</option>')
                        $("#t_po_customer_id").select2();
                        $("#nama_cetak").select2().select2('val',data.val[i].so_customer_nama_cetak);
                        // $("#nama_cetak").append('<option value="'+data.val[i].so_customer_nama_cetak+'" selected>'+data.val[i].so_customer_nama_cetak+'</option>');
                        $("#nama_cetak").select2();
                        
                        document.getElementsByName("so_customer_catatan")[0].value = data.val[i].so_customer_catatan;
                        if((data.val[i].so_customer_status == 4) || (data.val[i].so_customer_status == 1)) {} else {
                            document.getElementById('submit').disabled = true;
                            document.getElementById('btnAddPOCustomer').disabled = true;
                            document.getElementsByName("so_customer_tanggal")[0].disabled = true;
                            document.getElementById("t_po_customer_id").disabled = true;
                            document.getElementsByName("so_customer_catatan")[0].readOnly = true;
                            document.getElementsByName("so_customer_dp")[0].readOnly = true;
                        }
                    }
                  }
                });
                
            }
        </script>

    </body>

</html>