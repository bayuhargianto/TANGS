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
                                        <input type="hidden" id="url" value="Penjualan/Faktur-Penjualan/postData/">
                                        <input type="hidden" id="url_data" value="Penjualan/Faktur-Penjualan">
                                        <div class="form-group" id="kode" hidden="true">
                                            <label class="control-label col-md-4">ID Faktur (Auto)
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" class="form-control" name="kode" value="<?php if(isset($id)) echo $id;?>" readonly /> </div>
                                            </div>
                                        </div>
                                        <div class="form-group" id="KodeFaktur" hidden="true">
                                            <label class="control-label col-md-4">Kode Faktur (Auto)
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" class="form-control" name="faktur_penjualan_nomor" readonly /> </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Tanggal Faktur
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <div class=" input-group">
                                                        <input name="faktur_penjualan_tanggal" type="text" value="<?php echo date('d/m/Y');?>" class="form-control" readonly>
                                                        <span class="input-group-addon" style="">
                                                            <span class="icon-calendar"></span>
                                                        </span>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Tanggal Jatuh Tempo
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-group date datepicker" data-date-format="dd/mm/yyyy" data-date-start-date="+0d">
                                                    <input type="text" class="form-control" name="faktur_penjualan_jatuh_tempo" id="faktur_penjualan_jatuh_tempo" value="<?php echo date('d/m/Y');?>" required>
                                                    <span class="input-group-addon" style="">
                                                        <span class="icon-calendar"></span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Nomor Surat Jalan
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-7">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <select class="form-control" id="t_surat_jalan_id" name="t_surat_jalan_id" aria-required="true" aria-describedby="select-error" required>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <button type="button" id="btnAddSOCustomer" class="btn sbold dark" onclick="addSOCustomer()"><i class="icon-plus"></i></button>
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
                                            <label class="control-label col-md-4">Alamat Customer
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <textarea class="form-control" rows="3" name="partner_alamat" readonly></textarea> </div>
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
                                        <hr>
                                        <div class="form-group" id="tblInsert">
                                            <div class="col-md-12 table-scroll">
                                                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="default-table">
                                                    <thead>
                                                        <tr>
                                                            <th> No </th>
                                                            <th> Kode Barang </th>
                                                            <th> Uraian dan Spesifikasi Barang </th>
                                                            <th> Qty PO Customer </th>
                                                            <th> Satuan </th>
                                                            <th> Harga Barang Satuan </th>
                                                            <th> % Disc </th>
                                                            <th> Harga Barang Total </th>
                                                            <th> Keterangan </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th colspan="7" class="text-right"> Harga Jual Netto </th>
                                                            <th>
                                                                <input type="text" class="form-control money" id="faktur_penjualan_subtotal" name="faktur_penjualan_subtotal" value="0" required readonly />
                                                            </th>
                                                            <th class="text-right"></th>
                                                        </tr>
                                                        <tr>
                                                            <th colspan="7" class="text-right"> Potongan Harga </th>
                                                            <th>
                                                                <input type="text" class="form-control money" id="faktur_penjualan_potongan" name="faktur_penjualan_potongan" value="0" onchange="sumTotal()" required />
                                                            </th>
                                                            <th class="text-right"></th>
                                                        </tr>
                                                        <tr>
                                                            <th colspan="7" class="text-right"> Uang Muka Diterima </th>
                                                            <th>
                                                                <input type="text" class="form-control money" id="faktur_penjualan_uang_muka" name="faktur_penjualan_uang_muka" value="0" onchange="sumTotal()" required />
                                                            </th>
                                                            <th class="text-right"></th>
                                                        </tr>
                                                        <tr>
                                                            <th colspan="7" class="text-right"> Total </th>
                                                            <th>
                                                                <input type="text" class="form-control money" id="faktur_penjualan_total" name="faktur_penjualan_total" value="0" required readonly />
                                                            </th>
                                                            <th class="text-right"></th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Pembayaran Transfer ke 
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right" id="pilihan">
                                                    
                                                </div><br>
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <textarea class="form-control" rows="6" name="faktur_penjualan_tujuan_transfer_text" id="faktur_penjualan_tujuan_transfer_text" readonly></textarea> </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-4 col-md-8 text-right">
                                                <button type="submit" id="submit" class="btn green-jungle">Simpan</button>
                                                <a href="<?php echo base_url();?>Penjualan/Faktur-Penjualan">
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
                addBank();
                itemBarang = 0;
                datadetailfaktur = [];
                dataBank = [];
                $("#formAdd").submit(function(event){
                  if ($("#formAdd").valid() == true) {
                    actionData2();
                  }
                  return false;
                });
                $('#t_so_customer_id').css('width', '100%');
                selectList_SJ("#t_surat_jalan_id");
                if (document.getElementsByName("kode")[0].value.length > 0) {
                    editData(document.getElementsByName("kode")[0].value);
                }
            });

            function addBank() {
                $.ajax({
                  type : "GET",
                  url  : '<?php echo base_url();?>Master-Data/Bank/loadDataSelect/',
                  data : "id="+<?php echo $this->session->userdata('cabang_id'); ?>,
                  dataType : "json",
                  success:function(data){
                    for(var i = 0; i < data.items.length; i++)
                    {
                        // alert(data.items[i].text);
                        $('#pilihan').append('<label class="mt-checkbox">'+data.items[i].text+' \
                            <input type="checkbox" value="'+data.items[i].id+'" name="faktur_penjualan_tujuan_transfer[]" id="faktur_penjualan_tujuan_transfer'+i+'" onclick="addPembayaran('+data.items[i].id+', '+i+');" />\
                            <span></span>\
                        </label><br>');
                        var bank = {
                            bank_id : data.items[i].id,
                            bank_nama : data.items[i].bank_nama,
                            bank_atas_nama : data.items[i].bank_atas_nama,
                            bank_no_rek : data.items[i].bank_no_rek,
                            bank_index : i,
                            bank_selected : false
                        };
                        dataBank[i] = bank;
                    }
                  }
                });
            }

            function addPembayaran(id, i) {
                if(document.getElementById('faktur_penjualan_tujuan_transfer'+i).checked)
                {
                    for(var j = 0; j < dataBank.length; j++)
                    {
                        if(dataBank[j].bank_id == id)
                        {
                            $('#faktur_penjualan_tujuan_transfer_text').append(dataBank[j].bank_nama+'\n A/n '+dataBank[j].bank_atas_nama+'\n No Rek. '+dataBank[j].bank_no_rek+'\n \n');
                            dataBank[j].bank_selected = true;
                        }
                    }
                }
                else
                {
                    dataBank[i].bank_selected = false;
                    $('#faktur_penjualan_tujuan_transfer_text').empty();
                    for(var j =0; j < dataBank.length; j++)
                    {
                        if(dataBank[j].bank_selected == true)
                        {
                            $('#faktur_penjualan_tujuan_transfer_text').append(dataBank[j].bank_nama+'\n A/n '+dataBank[j].bank_atas_nama+'\n No Rek. '+dataBank[j].bank_no_rek+'\n \n');
                        }
                    }
                }
            }

            function addSOCustomer() {
                var id = document.getElementsByName('t_surat_jalan_id')[0].value;
                $("#default-table tbody").empty();
                if (id.length > 0) {
                    $.ajax({
                      type : "GET",
                      url  : '<?php echo base_url();?>Penjualan/Surat-Jalan/loadDataWhere/',
                      data : "id="+id,
                      dataType : "json",
                      success:function(data){
                        for(var i = 0; i < data.val[0].t_order_id.val2.length; i++)
                        {
                            getDetailSOCustomer(data.val[0].t_order_id.val2[i].id);
                        }
                      }
                    });
                    
                }
            }

            function getDetailSOCustomer(id) {
                $.ajax({
                  type : "GET",
                  url  : '<?php echo base_url();?>Penjualan/Sales-Order-Customer/loadDataWhere/',
                  data : "id="+id,
                  dataType : "json",
                  success:function(data){
                    for(var i=0; i<data.val.length;i++){
                        $.ajax({
                          type : "GET",
                          url  : '<?php echo base_url();?>Marketing/Purchase-Order-Customer/loadDataWhere/',
                          data : "id="+data.val[i].t_po_customer_id.val2[0].id,
                          dataType : "json",
                          success:function(data){
                            for (var i = 0; i < data.val.length; i++) {
                                document.getElementsByName("partner_nama")[0].value = data.val[i].po_customer_nama_pelanggan;
                                $.ajax({
                                  type : "GET",
                                  url  : '<?php echo base_url();?>Master-Data/Partner/loadDataWhere/',
                                  data : "id="+data.val[i].m_partner_id.val2[0].id,
                                  dataType : "json",
                                  success:function(data){
                                    for(var j=0; j<data.val.length;j++){
                                        document.getElementsByName("partner_alamat")[0].value = data.val[j].partner_alamat;
                                        document.getElementsByName("partner_telp")[0].value = data.val[j].partner_telepon2;
                                    }
                                  }
                                });
                            }

                            for(var i = 0; i < data.val2.length; i++){
                                itemBarang++;
                                // STEP 1
                                $("#default-table tbody").append('\
                                    <tr>\
                                        <td>\
                                            '+itemBarang+'\
                                        </td>\
                                        <td>\
                                            <input type="hidden" name="t_po_customerdet_id[]" value="'+data.val2[i].po_customerdet_id+'"/>\
                                            '+data.val2[i].barang_kode+'\
                                        </td>\
                                        <td>\
                                            '+data.val2[i].barang_uraian+'\
                                        </td>\
                                        <td>\
                                            <input type="text" id="qtybrg'+itemBarang+'" class="form-control num2" value="'+data.val2[i].po_customerdet_qty+'" readonly/>\
                                        </td>\
                                        <td>\
                                            '+data.val2[i].satuan_nama+'\
                                        </td>\
                                        <td>\
                                            <input type="text" id="hargabrg'+itemBarang+'" class="form-control money" value="'+data.val2[i].po_customerdet_harga_satuan+'" readonly/>\
                                        </td>\
                                        <td>\
                                            <input type="text" class="form-control num2" id="faktur_penjualandet_discount'+itemBarang+'" name="faktur_penjualandet_discount[]" value="'+datadetailfaktur[itemBarang-1].faktur_penjualandet_discount+'" onchange="sumSubTotal()" required/>\
                                        </td>\
                                        <td>\
                                            <input type="text" id="totalhargabrg'+itemBarang+'" class="form-control money" value="'+(data.val2[i].po_customerdet_qty * data.val2[i].po_customerdet_harga_satuan)+'" readonly/>\
                                        </td>\
                                        <td>\
                                            <textarea class="form-control" rows="3" readonly>'+data.val2[i].po_customerdet_keterangan+'</textarea>\
                                        </td>\
                                    </tr>\
                                ');

                                $('.num2').number( true, 2, '.', ',' );
                                $('.money').number( true, 2, '.', ',' );
                            }

                            if (document.getElementsByName("kode")[0].value.length > 0) {
                                // alert(datadetailfaktur.length);
                                // for(var i = 0; i < datadetailfaktur.length; i++){
                                //     if(document.getElementById('faktur_penjualandet_discount'+(i+1)).value !== null)
                                //     {
                                //         document.getElementById('faktur_penjualandet_discount'+(i+1)).value = datadetailfaktur[i].faktur_penjualandet_discount;
                                //     }
                                // }
                                for (var i = 1; i <= itemBarang; i++) {
                                    // if(document.getElementById('faktur_penjualandet_discount'+i).value !== null)
                                    // {
                                        document.getElementById('faktur_penjualandet_discount'+i).readOnly = true;
                                    // }
                                }
                                sumSubTotal();
                            }

                          }
                        });
                    }
                  }
                });
            }

            function sumSubTotal() {
                subTotal = 0;
                for (var i = 1; i <= itemBarang; i++) {
                    qty = parseInt(document.getElementById('qtybrg'+i).value.replace(/\./g, ""));
                    hrg = parseInt(document.getElementById('hargabrg'+i).value.replace(/\./g, ""));
                    disc = parseInt(document.getElementById('faktur_penjualandet_discount'+i).value.replace(/\./g, ""));
                    document.getElementById('totalhargabrg'+i).value = qty * hrg - (qty * hrg * disc / 100);
                    subTotal += qty * hrg - (qty * hrg * disc / 100);
                }
                document.getElementById('faktur_penjualan_subtotal').value = subTotal;
                $('.money').number( true, 2, '.', ',' );
                sumTotal();
            }

            function sumTotal() {
                subTotal = parseInt(document.getElementById('faktur_penjualan_subtotal').value.replace(/\./g, ""));
                potongan = parseInt(document.getElementById('faktur_penjualan_potongan').value.replace(/\./g, ""));
                dp = parseInt(document.getElementById('faktur_penjualan_uang_muka').value.replace(/\./g, ""));
                document.getElementById('faktur_penjualan_total').value = subTotal - potongan - dp;
                $('.money').number( true, 2, '.', ',' );
            }

            function editData(id, edit = null) {
                $.ajax({
                  type : "GET",
                  url  : '<?php echo base_url();?>Penjualan/Faktur-Penjualan/loadDataWhere/',
                  data : "id="+id,
                  dataType : "json",
                  success:function(data){
                    datadetailfaktur = data.val2;
                    for(var i=0; i<data.val.length;i++){
                        document.getElementById('submit').disabled = true;
                        document.getElementById('btnAddSOCustomer').disabled = true;
                        $("#KodeFaktur").attr('hidden', false);
                        document.getElementsByName("kode")[0].value = data.val[i].kode;
                        document.getElementsByName("faktur_penjualan_nomor")[0].value = data.val[i].faktur_penjualan_nomor;
                        document.getElementsByName("faktur_penjualan_tanggal")[0].value = data.val[i].faktur_penjualan_tanggal;
                        document.getElementsByName("faktur_penjualan_tanggal")[0].disabled = true;
                        document.getElementsByName("faktur_penjualan_jatuh_tempo")[0].value = data.val[i].faktur_penjualan_jatuh_tempo;
                        document.getElementsByName("faktur_penjualan_jatuh_tempo")[0].disabled = true;
                        $("#t_surat_jalan_id").select2('destroy');
                        for(var j=0; j<data.val[i].t_so_customer_id.val2.length; j++){
                            getDetailSOCustomer(data.val[i].t_so_customer_id.val2[j].id);
                        }
                        for(var j=0; j<data.val[i].t_surat_jalan_id.val2.length; j++){
                            $("#t_surat_jalan_id").append('<option value="'+data.val[i].t_surat_jalan_id.val2[j].id+'" selected>'+data.val[i].t_surat_jalan_id.val2[j].text+'</option>');
                            $("#t_surat_jalan_id").select2();
                        }
                        document.getElementById("t_surat_jalan_id").disabled = true;
                        document.getElementsByName("faktur_penjualan_potongan")[0].value = data.val[i].faktur_penjualan_potongan;
                        document.getElementsByName("faktur_penjualan_potongan")[0].readOnly = true;
                        document.getElementsByName("faktur_penjualan_uang_muka")[0].value = data.val[i].faktur_penjualan_uang_muka;
                        document.getElementsByName("faktur_penjualan_uang_muka")[0].readOnly = true;
                        var idBank = JSON.parse(data.val[i].faktur_penjualan_tujuan_transfer);
                        for(var j=0; j < idBank.length; j++)
                        {
                            for(var k=0; k < dataBank.length; k++)
                            {
                                if(dataBank[k].bank_id == idBank[j])
                                {
                                    dataBank[k].bank_selected = true;
                                    document.getElementById('faktur_penjualan_tujuan_transfer'+dataBank[k].bank_index).checked = true;
                                    $('#faktur_penjualan_tujuan_transfer_text').append(dataBank[k].bank_nama+'\n A/n '+dataBank[k].bank_atas_nama+'\n No Rek. '+dataBank[k].bank_no_rek+'\n \n');
                                }
                            }
                        }
                        // document.getElementsByName("faktur_penjualan_tujuan_transfer")[0].value = data.val[i].faktur_penjualan_tujuan_transfer;
                        // document.getElementsByName("faktur_penjualan_tujuan_transfer").disabled = true;
                    }
                    
                  }
                });
            }
        </script>

    </body>

</html>