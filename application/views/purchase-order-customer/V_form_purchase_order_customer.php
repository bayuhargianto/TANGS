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
                            <div class="portlet light portlet-fit portlet-datatable bordered" id="form_wizard_1">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class=" icon-doc font-dark"></i> &nbsp;&nbsp;
                                        <span class="caption-subject font-dark sbold uppercase">Form <?php if(isset($title_page2)) echo $title_page2;?></span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <form action="#" id="formAdd" class="form-horizontal" method="post">
                                        <div class="form-wizard">
                                            <div class="form-body">
                                                <ul class="nav nav-pills nav-justified steps">
                                                    <li>
                                                        <a href="#tab1" data-toggle="tab" class="step active">
                                                            <span class="number"> 1 </span>
                                                            <span class="desc">
                                                                <i class="fa fa-check"></i> PO Customer </span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#tab2" data-toggle="tab" class="step">
                                                            <span class="number"> 2 </span>
                                                            <span class="desc">
                                                                <i class="fa fa-check"></i> Cek Stok Barang </span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#tab3" data-toggle="tab" class="step">
                                                            <span class="number"> 3 </span>
                                                            <span class="desc">
                                                                <i class="fa fa-check"></i> Cek Kredit Limit </span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#tab4" data-toggle="tab" class="step">
                                                            <span class="number"> 4 </span>
                                                            <span class="desc">
                                                                <i class="fa fa-check"></i> Persetujuan </span>
                                                        </a>
                                                    </li>
                                                </ul>
                                                <div id="bar" class="progress progress-striped" role="progressbar">
                                                    <div class="progress-bar progress-bar-success"> </div>
                                                </div>
                                                <div class="tab-content">
                                                    <div class="alert alert-danger display-none">
                                                        <button class="close" data-dismiss="alert"></button> You have some form errors. Please check below. </div>
                                                    <div class="alert alert-success display-none">
                                                        <button class="close" data-dismiss="alert"></button> Your form validation is successful! </div>
                                                    <input type="hidden" id="url" value="Marketing/Purchase-Order-Customer/postData/">
                                                    <input type="hidden" id="url_data" value="Marketing/Purchase-Order-Customer">
                                                    <input type="hidden" name="po_customer_status" value="0">
                                                    <div class="tab-pane active" id="tab1">
                                                        <div class="form-group" hidden="true">
                                                            <label class="control-label col-md-4">ID Purchase Order Harga (Auto)
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <div class="col-md-8">
                                                                <div class="input-icon right">
                                                                    <i class="fa"></i>
                                                                    <input type="text" class="form-control" name="kode" value="<?php if(isset($id)) echo $id;?>" readonly /> </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group" hidden="true" id="KodePO">
                                                            <label class="control-label col-md-4">Kode Purchase Order (Auto)
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <div class="col-md-8">
                                                                <div class="input-icon right">
                                                                    <i class="fa"></i>
                                                                    <input type="text" class="form-control" name="po_customer_nomor" readonly /> </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-4">Tanggal Purchase Order 
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <div class="col-md-8">
                                                                <div class="input-icon right">
                                                                    <i class="fa"></i>
                                                                    <div class="datepicker input-group">
                                                                        <input name="po_customer_tanggal" type="text" value="<?php echo date('d/m/Y');?>" class="form-control">
                                                                        <span class="input-group-addon" style="">
                                                                            <span class="icon-calendar"></span>
                                                                        </span>
                                                                    </div> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-4">Nama Customer
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <div class="col-md-8">
                                                                <div class="input-icon right">
                                                                    <i class="fa"></i>
                                                                    <select class="form-control" id="m_partner_id" name="m_partner_id" aria-required="true" aria-describedby="select-error" onchange="copyCustomer()" required>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-4">Kontak Person
                                                            </label>
                                                            <div class="col-md-8">
                                                                <div class="input-icon right">
                                                                    <i class="fa"></i>
                                                                    <input type="text" class="form-control" name="po_customer_kontak_person" /> </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-4">Nama Pelanggan
                                                            </label>
                                                            <div class="col-md-8">
                                                                <div class="input-icon right">
                                                                    <i class="fa"></i>
                                                                    <input type="text" class="form-control" name="po_customer_nama_pelanggan" /> </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-4">Alamat Pelanggan
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <div class="col-md-8">
                                                                <div class="input-icon right">
                                                                    <i class="fa"></i>
                                                                    <textarea class="form-control" rows="3" name="partner_alamat" readonly></textarea> </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-4">Alamat Kirim
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <div class="col-md-8">
                                                                <div class="input-icon right">
                                                                    <i class="fa"></i>
                                                                    <textarea class="form-control" rows="3" name="po_customer_alamat_kirim" required></textarea> </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-4">Nama Sales
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <div class="col-md-8">
                                                                <div class="input-icon right">
                                                                    <i class="fa"></i>
                                                                    <select class="form-control" id="m_karyawan_id" name="m_karyawan_id" aria-required="true" aria-describedby="select-error" required>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-4">Jasa Angkut
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <div class="col-md-8">
                                                                <div class="mt-radio-inline">
                                                                    <i class="fa"></i>
                                                                    <label class="mt-radio"> Ekspedisi
                                                                        <input type="radio" value="1" name="po_customer_jasaangkut_jenis" id="po_customer_jasaangkut_jenis1" onchange="ubahJenis(1)" checked required />
                                                                        <span></span>
                                                                    </label>
                                                                    <label class="mt-radio"> Kirim Sendiri
                                                                        <input type="radio" value="2" name="po_customer_jasaangkut_jenis" id="po_customer_jasaangkut_jenis2" onchange="ubahJenis(2)" />
                                                                        <span></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-4">Ekspedisi
                                                            </label>
                                                            <div class="col-md-8">
                                                                <div class="input-icon right">
                                                                    <i class="fa"></i>
                                                                    <input type="text" class="form-control" name="po_customer_ekspedisi" /> </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group" id="jasaangkut_bayar">
                                                            <label class="control-label col-md-4">Jasa Angkut Bayar
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <div class="col-md-8">
                                                                <div class="mt-radio-inline">
                                                                    <i class="fa"></i>
                                                                    <label class="mt-radio"> Bayar Kantor
                                                                        <input type="radio" value="1" name="po_customer_jasaangkut_bayar" id="po_customer_jasaangkut_bayar1" checked required />
                                                                        <span></span>
                                                                    </label>
                                                                    <label class="mt-radio"> Bayar Toko
                                                                        <input type="radio" value="2" name="po_customer_jasaangkut_bayar" id="po_customer_jasaangkut_bayar2" />
                                                                        <span></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-4">Nama Barang
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <div class="col-md-7">
                                                                <div class="input-icon right">
                                                                    <i class="fa"></i>
                                                                    <select class="form-control" id="m_barang_id" name="m_barang_id" aria-required="true" aria-describedby="select-error">
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <button type="button" id="btnAddBarang" class="btn sbold dark" onclick="addBarang()"><i class="icon-plus"></i></button>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="form-group" id="tblInsert">
                                                            <div class="col-md-12 table-scroll">
                                                                <input type="hidden" name="jml_itemBarang" id="jml_itemBarang" value="0" />
                                                                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="default-table">
                                                                    <thead>
                                                                        <tr>
                                                                            <th> No </th>
                                                                            <th> Kode Barang </th>
                                                                            <th> Uraian dan Spesifikasi Barang </th>
                                                                            <th> Qty PO Customer </th>
                                                                            <th> Satuan </th>
                                                                            <th> Harga Barang Satuan </th>
                                                                            <th> Harga Barang Total </th>
                                                                            <th> Keterangan </th>
                                                                            <th> Action </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="tableTbody">
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-4">Term Of Payment
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <div class="col-md-8">
                                                                <div class="input-icon right">
                                                                    <i class="fa"></i>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control num" name="po_customer_perjanjian_bayar" value="0">
                                                                        <span class="input-group-addon" style="">
                                                                            Hari
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-4">Catatan
                                                            </label>
                                                            <div class="col-md-8">
                                                                <div class="input-icon right">
                                                                    <i class="fa"></i>
                                                                    <textarea class="form-control" rows="3" name="po_customer_catatan"></textarea> </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="tab2">
                                                        <div class="form-group" id="tblStokBarang">
                                                            <input type="hidden" name="statusStok" id="statusStok" value="0" />
                                                            <div class="col-md-12 table-scroll">
                                                                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="default-table2">
                                                                    <thead>
                                                                        <tr>
                                                                            <th> No </th>
                                                                            <th> Kode Barang </th>
                                                                            <th> Uraian dan Spesifikasi Barang </th>
                                                                            <th> Qty PO Customer </th>
                                                                            <th> Qty Gudang </th>
                                                                            <th> Satuan </th>
                                                                            <th> Harga Barang Satuan </th>
                                                                            <th> Harga Barang Total </th>
                                                                            <th> Keterangan </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="tableTbody2">
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-4">Status 
                                                            </label>
                                                            <div class="col-md-8" id="statusstep2">
                                                                -
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="tab3">
                                                        <input type="hidden" name="statusKredit" id="statusKredit" value="0" />
                                                        <div class="form-group">
                                                            <label class="control-label col-md-4">Nama Customer
                                                            </label>
                                                            <div class="col-md-8">
                                                                <div class="input-icon right">
                                                                    <i class="fa"></i>
                                                                    <input type="text" class="form-control" name="partner_nama4" readonly/> </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-4">Sisa Limit Kredit
                                                            </label>
                                                            <div class="col-md-8">
                                                                <div class="input-icon right">
                                                                    <i class="fa"></i>
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" style="">
                                                                            RP
                                                                        </span>
                                                                        <input type="text" class="form-control money" id="partner_limit_kredit4 name="partner_limit_kredit4" readonly />
                                                                    </div> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-4">Status 
                                                            </label>
                                                            <div class="col-md-8" id="statusstep4">
                                                                -
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="tab4">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-4">Kode Purchase Order Harga (Auto)
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <div class="col-md-8">
                                                                <div class="input-icon right">
                                                                    <i class="fa"></i>
                                                                    <input type="text" class="form-control" id="po_customer_nomor2" readonly /> </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-4">Tanggal Purchase Order Harga
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <div class="col-md-8">
                                                                <div class="input-icon right">
                                                                    <i class="fa"></i>
                                                                    <div class="datepicker input-group">
                                                                        <input id="po_customer_tanggal2" type="text" value="<?php echo date('d/m/Y');?>" class="form-control" disabled>
                                                                        <span class="input-group-addon" style="">
                                                                            <span class="icon-calendar"></span>
                                                                        </span>
                                                                    </div> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-4">Nama Supplier
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <div class="col-md-8">
                                                                <div class="input-icon right">
                                                                    <i class="fa"></i>
                                                                    <select class="form-control" id="m_partner_id2" name="m_partner_id2" aria-required="true" aria-describedby="select-error" disabled>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-4">Kontak Person
                                                            </label>
                                                            <div class="col-md-8">
                                                                <div class="input-icon right">
                                                                    <i class="fa"></i>
                                                                    <input type="text" class="form-control" id="po_customer_kontak_person2" readonly /> </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-4">Nama Pelanggan
                                                            </label>
                                                            <div class="col-md-8">
                                                                <div class="input-icon right">
                                                                    <i class="fa"></i>
                                                                    <input type="text" class="form-control" id="po_customer_nama_pelanggan2" readonly /> </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-4">Alamat Pelanggan
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <div class="col-md-8">
                                                                <div class="input-icon right">
                                                                    <i class="fa"></i>
                                                                    <textarea class="form-control" rows="3" id="partner_alamat2" readonly></textarea> </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-4">Alamat Kirim
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <div class="col-md-8">
                                                                <div class="input-icon right">
                                                                    <i class="fa"></i>
                                                                    <textarea class="form-control" rows="3" id="po_customer_alamat_kirim2" disabled></textarea> </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-4">Nama Sales
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <div class="col-md-8">
                                                                <div class="input-icon right">
                                                                    <i class="fa"></i>
                                                                    <select class="form-control" id="m_karyawan_id2" name="m_karyawan_id2" aria-required="true" aria-describedby="select-error" disabled>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-4">Jasa Angkut
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <div class="col-md-8">
                                                                <div class="mt-radio-inline">
                                                                    <i class="fa"></i>
                                                                    <label class="mt-radio"> Ekspedisi
                                                                        <input type="radio" value="1" name="po_customer_jasaangkut_jenis2" id="po_customer_jasaangkut_jenis12" disabled />
                                                                        <span></span>
                                                                    </label>
                                                                    <label class="mt-radio"> Kirim Sendiri
                                                                        <input type="radio" value="2" name="po_customer_jasaangkut_jenis2" id="po_customer_jasaangkut_jenis22" disabled />
                                                                        <span></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-4">Ekspedisi
                                                            </label>
                                                            <div class="col-md-8">
                                                                <div class="input-icon right">
                                                                    <i class="fa"></i>
                                                                    <input type="text" class="form-control" id="po_customer_ekspedisi2" readonly /> </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group" id="jasaangkut_bayar2">
                                                            <label class="control-label col-md-4">Jasa Angkut Bayar
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <div class="col-md-8">
                                                                <div class="mt-radio-inline">
                                                                    <i class="fa"></i>
                                                                    <label class="mt-radio"> Bayar Kantor
                                                                        <input type="radio" value="1" name="po_customer_jasaangkut_bayar2" id="po_customer_jasaangkut_bayar12" disabled />
                                                                        <span></span>
                                                                    </label>
                                                                    <label class="mt-radio"> Bayar Toko
                                                                        <input type="radio" value="2" name="po_customer_jasaangkut_bayar2" id="po_customer_jasaangkut_bayar22" disabled />
                                                                        <span></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="form-group" id="tblInsert2">
                                                            <div class="col-md-12 table-scroll">
                                                                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="default-table3">
                                                                    <thead>
                                                                        <tr>
                                                                            <th> No </th>
                                                                            <th> Kode Barang </th>
                                                                            <th> Uraian dan Spesifikasi Barang </th>
                                                                            <th> Qty PO Customer </th>
                                                                            <th> Satuan </th>
                                                                            <th> Harga Barang Satuan </th>
                                                                            <th> Harga Barang Total </th>
                                                                            <th> Keterangan </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="tableTbody3">
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-4">Term Of Payment
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <div class="col-md-8">
                                                                <div class="input-icon right">
                                                                    <i class="fa"></i>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control num" id="po_customer_perjanjian_bayar2" value="0" readonly>
                                                                        <span class="input-group-addon" style="">
                                                                            Hari
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-4">Catatan
                                                            </label>
                                                            <div class="col-md-8">
                                                                <div class="input-icon right">
                                                                    <i class="fa"></i>
                                                                    <textarea class="form-control" rows="3" id="po_customer_catatan2" readonly></textarea> </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-4">Status 
                                                            </label>
                                                            <div class="col-md-8" id="statusstep3">
                                                                -
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <div class="row">
                                                    <div class="col-md-offset-4 col-md-8 text-right">
                                                        <a href="javascript:;">
                                                            <button type="button" class="btn default button-previous">
                                                            Kembali
                                                            </button>
                                                        </a>
                                                        <a href="<?php echo base_url();?>Marketing/Purchase-Order-Customer">
                                                            <button type="button" class="btn default">Kembali ke List Purchase Order</button>
                                                        </a>
                                                        <button type="button" class="btn green-jungle hidden" id="simpandraft" onclick="simpanDraft()" disabled>
                                                        Simpan Draft
                                                        </button>
                                                        <button type="button" class="btn blue-ebonyclay button-next hidden" id="lanjut" onclick="checkItem()" >
                                                        Lanjut
                                                        </button>
                                                        <button type="button" class="btn red-thunderbird hidden" id="simpantidaksetuju" onclick="simpanTidakSetuju()" disabled>
                                                        Tidak Setuju
                                                        </button>
                                                        <button type="button" class="btn blue-ebonyclay button-next hidden" id="lanjut2" onclick="checkItem()" >
                                                        Lanjut
                                                        </button>
                                                        <button type="button" class="btn red-thunderbird hidden" id="simpantidaksetuju2" onclick="simpanTidakSetuju2()" disabled>
                                                        Tidak Setuju
                                                        </button>
                                                        <button type="button" class="btn blue-ebonyclay button-next hidden" id="lanjut3" onclick="checkItem()" >
                                                        Lanjut
                                                        </button>
                                                        <a href="javascript:;">
                                                            <button type="button" class="btn green-jungle button-submit" id="simpan">
                                                            Simpan
                                                            </button>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
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
                stepPosition = 1;
                itemBarang = parseInt($("#jml_itemBarang").val());
                last_num = 0;
                last_num2 = 0;
                FormWizard2.init();
                $('#m_partner_id').css('width', '100%');
                selectList_customer("#m_partner_id");
                $('#m_barang_id').css('width', '100%');
                selectList_barang2("#m_barang_id");
                $('#m_karyawan_id').css('width', '100%');
                selectList_karyawan("#m_karyawan_id");
                checkItem();
                if (document.getElementsByName("kode")[0].value != null) {
                    editData(document.getElementsByName("kode")[0].value);
                }
            });

            function copyCustomer() {
                $.ajax({
                    type : "GET",
                    url  : '<?php echo base_url();?>Master-Data/Partner/loadDataWhere/',
                    data : { id : document.getElementsByName("m_partner_id")[0].value },
                    dataType : "json",
                    success:function(data){
                        for(var i=0; i<data.val.length;i++){
                            document.getElementsByName('po_customer_nama_pelanggan')[0].value = data.val[i].partner_nama;
                            document.getElementsByName('partner_alamat')[0].value = data.val[i].partner_alamat;
                            document.getElementsByName('po_customer_alamat_kirim')[0].value = data.val[i].partner_alamat;
                        }
                    }
                });
            }

            function copyCustomer2(id) {
                $.ajax({
                    type : "GET",
                    url  : '<?php echo base_url();?>Master-Data/Partner/loadDataWhere/',
                    data : { id : id },
                    dataType : "json",
                    success:function(data){
                        for(var i=0; i<data.val.length;i++){
                            document.getElementsByName('partner_alamat')[0].value = data.val[i].partner_alamat;
                            document.getElementById('partner_alamat2').value = data.val[i].partner_alamat;
                        }
                    }
                });
            }

            function ubahJenis(idx) {
                if (idx == 2) {
                    document.getElementsByName('po_customer_ekspedisi')[0].value = '';
                    document.getElementsByName('po_customer_ekspedisi')[0].readOnly = true;
                    $('#jasaangkut_bayar').addClass('hidden');
                } else {
                    document.getElementsByName('po_customer_ekspedisi')[0].readOnly = false;
                    $('#jasaangkut_bayar').removeClass('hidden');
                }
            }

            function addBarang() {
                var id = document.getElementsByName('m_barang_id')[0].value;
                if (id.length > 0) {
                    getDetailBarang(id);
                }
                $("#m_barang_id").select2('destroy');
                $("#m_barang_id").empty();
                selectList_barang2("#m_barang_id");
                checkItem();
            }

            function removeBarang(itemSeq) {
                var parent = document.getElementById("tableTbody");
                for (var i = 1; i <= itemBarang; i++) {
                  if (i >= itemSeq && i < itemBarang) {
                    document.getElementById("td2"+i).innerHTML = document.getElementById("td2"+(i+1)).innerHTML;
                    document.getElementById("td3"+i).innerHTML = document.getElementById("td3"+(i+1)).innerHTML;
                    document.getElementById("po_customerdet_qty"+i).value = document.getElementById("po_customerdet_qty"+(i+1)).value;
                    document.getElementById("td5"+i).innerHTML = document.getElementById("td5"+(i+1)).innerHTML;
                    document.getElementById("po_customerdet_harga_satuan"+i).value = document.getElementById("po_customerdet_harga_satuan"+(i+1)).value;
                    document.getElementById("po_customerdet_harga_total"+i).value = document.getElementById("po_customerdet_harga_total"+(i+1)).value;
                    document.getElementById("po_customerdet_keterangan"+i).value = document.getElementById("po_customerdet_keterangan"+(i+1)).value;
                  };
                };
                for (var i = 1; i <= itemBarang; i++) {
                  if (i==itemBarang) {
                    var child = document.getElementById("detail"+i);
                    parent.removeChild(child);
                  };
                };
                last_num--;
                itemBarang--;
                checkItem();
            }

            function getDetailBarang(id) {
                itemBarang++;
                last_num++;
                $("#jml_itemBarang").val(itemBarang);
                $.ajax({
                  type : "GET",
                  url  : '<?php echo base_url();?>Master-Data/Barang/loadDataWhere/',
                  data : { id : id },
                  dataType : "json",
                  success:function(data){
                    for(var i = 0; i < data.val.length; i++){
                        $("#default-table tbody").append('\
                            <tr id="detail'+last_num+'">\
                                <td id="td1'+last_num+'">\
                                    '+itemBarang+'\
                                </td>\
                                <td id="td2'+last_num+'">\
                                    <input type="hidden" name="m_barang_id[]" value="'+data.val[i].kode+'"/>\
                                    <input type="hidden" name="po_customerdet_id[]" value=""/>\
                                    '+data.val[i].barang_kode+'\
                                </td>\
                                <td id="td3'+last_num+'">\
                                    '+data.val[i].barang_nama+' ('+data.val[i].barang_nomor+' , '+data.val[i].m_jenis_barang_id.val2[i].text+')\
                                </td>\
                                <td id="td4'+last_num+'">\
                                    <input type="text" class="form-control num2" id="po_customerdet_qty'+last_num+'" name="po_customerdet_qty[]" value="0" onchange="checkSubtotal()" required/>\
                                </td>\
                                <td id="td5'+last_num+'">\
                                    '+data.val[i].m_satuan_id.val2[i].text+'\
                                </td>\
                                <td id="td6'+last_num+'">\
                                    <input type="text" class="form-control money" id="po_customerdet_harga_satuan'+last_num+'" name="po_customerdet_harga_satuan[]" value="0" onchange="checkSubtotal()" required/>\
                                </td>\
                                <td id="td7'+last_num+'">\
                                    <input type="text" class="form-control money" id="po_customerdet_harga_total'+last_num+'" name="po_customerdet_harga_total[]" value="0" required readonly/>\
                                </td>\
                                <td id="td8'+last_num+'">\
                                    <textarea class="form-control" rows="3" id="po_customerdet_keterangan'+last_num+'" name="po_customerdet_keterangan[]"></textarea>\
                                </td>\
                                <td id="td9'+last_num+'">\
                                    <button type="button" id="removeBtn'+last_num+'" class="btn red-thunderbird" onclick="removeBarang('+i+')">\
                                        <i class="icon-close"></i>\
                                    </button>\
                                </td>\
                            </tr>\
                        ');
                        $('.num2').number( true, 2, ',', '.' );
                        $('.money').number( true, 2, ',', '.' );
                    }
                  }
                });
            }

            function checkSubtotal() {
                for (var i = 1; i <= last_num; i++) {
                    qty   = parseInt(document.getElementById('po_customerdet_qty'+i).value.replace(/\./g, ""));
                    harga = parseInt(document.getElementById('po_customerdet_harga_satuan'+i).value.replace(/\./g, ""));
                    document.getElementById('po_customerdet_harga_total'+i).value = (qty * harga);
                }
                $('.num2').number( true, 2, ',', '.' );
                $('.money').number( true, 2, ',', '.' );
            }

            function checkItem() {
                setTimeout(function(){
                    if (stepPosition == 1) {
                        $("#simpandraft").removeClass("hidden");
                        $("#lanjut").removeClass("hidden");
                        $("#simpantidaksetuju").addClass("hidden");
                        $("#lanjut2").addClass("hidden");
                        $("#simpantidaksetuju2").addClass("hidden");
                        $("#lanjut3").addClass("hidden");
                        if (itemBarang > 0) {
                            if (document.getElementsByName('po_customer_status')[0].value <= 1) {
                                document.getElementById('simpandraft').disabled = false;
                            } else {
                                document.getElementById('simpandraft').disabled = true;    
                            }
                            document.getElementById('lanjut').disabled = false;
                        } else {
                            document.getElementById('simpandraft').disabled = true;
                            document.getElementById('lanjut').disabled = true;
                        }   
                    } else if (stepPosition == 2) {
                        $("#simpandraft").addClass("hidden");
                        $("#lanjut").addClass("hidden");
                        $("#simpantidaksetuju").removeClass("hidden");
                        $("#lanjut2").removeClass("hidden");
                        $("#simpantidaksetuju2").addClass("hidden");
                        $("#lanjut3").addClass("hidden");
                        if (document.getElementById("statusStok").value == 0) {
                            document.getElementById('simpantidaksetuju').disabled = false;
                            document.getElementById('lanjut2').disabled = false;   
                        } else {
                            document.getElementById('simpantidaksetuju').disabled = true;
                            document.getElementById('lanjut2').disabled = false;
                        }
                    } else if (stepPosition == 3) {
                        $("#simpandraft").addClass("hidden");
                        $("#lanjut").addClass("hidden");
                        $("#simpantidaksetuju").addClass("hidden");
                        $("#lanjut2").addClass("hidden");
                        $("#simpantidaksetuju2").removeClass("hidden");
                        $("#lanjut3").removeClass("hidden");
                        if ($('#partner_limit_kredit4').val() > 0) {
                            document.getElementById('simpantidaksetuju2').disabled = true;
                        } else {
                            document.getElementById('simpantidaksetuju2').disabled = false;
                        }
                    } else if (stepPosition == 4) {
                        $("#simpandraft").addClass("hidden");
                        $("#lanjut").addClass("hidden");
                        $("#simpantidaksetuju").addClass("hidden");
                        $("#lanjut2").addClass("hidden");
                        $("#simpantidaksetuju2").addClass("hidden");
                        $("#lanjut3").addClass("hidden");
                        if (document.getElementById('po_customer_jasaangkut_jenis12').checked == true) {
                            document.getElementsByName('po_customer_ekspedisi')[0].readOnly = false;
                            $('#jasaangkut_bayar').removeClass('hidden');
                        } else {
                            document.getElementsByName('po_customer_ekspedisi')[0].value = '';
                            document.getElementsByName('po_customer_ekspedisi')[0].readOnly = true;
                            $('#jasaangkut_bayar').addClass('hidden');
                        }
                    }
                }, 1000);
            }

            function checkPosition(index) {
                stepPosition = index+1;
                if (stepPosition == 1) {
                    $("#simpandraft").removeClass("hidden");
                    $("#lanjut").removeClass("hidden");
                    $("#simpantidaksetuju").addClass("hidden");
                    $("#lanjut2").addClass("hidden");
                    $("#simpantidaksetuju2").addClass("hidden");
                    $("#lanjut3").addClass("hidden");
                } else if (stepPosition == 2) {
                    $("#simpandraft").addClass("hidden");
                    $("#lanjut").addClass("hidden");
                    $("#simpantidaksetuju").removeClass("hidden");
                    $("#lanjut2").removeClass("hidden");
                    $("#simpantidaksetuju2").addClass("hidden");
                    $("#lanjut3").addClass("hidden");
                } else if (stepPosition == 3) {
                    $("#simpandraft").addClass("hidden");
                    $("#lanjut").addClass("hidden");
                    $("#simpantidaksetuju").addClass("hidden");
                    $("#lanjut2").addClass("hidden");
                    $("#simpantidaksetuju2").removeClass("hidden");
                    $("#lanjut3").removeClass("hidden");
                } else if (stepPosition == 4) {
                    $("#simpandraft").addClass("hidden");
                    $("#lanjut").addClass("hidden");
                    $("#simpantidaksetuju").addClass("hidden");
                    $("#lanjut2").addClass("hidden");
                    $("#simpantidaksetuju2").addClass("hidden");
                    $("#lanjut3").addClass("hidden");
                }

                if (index == 1) {
                    if (document.getElementsByName('po_customer_status')[0].value <= 1) {
                        document.getElementsByName('po_customer_status')[0].value = 2;
                        $.ajax({
                          type : "POST",
                          url  : $base_url+''+$("#url").val(),
                          data : $( "#formAdd" ).serialize()+"&step="+index,
                          dataType : "json",
                          success:function(data){
                            if(data.status=='200'){
                                document.getElementsByName("kode")[0].value = data.id;
                                document.getElementsByName("po_customer_nomor")[0].value = data.nomor;
                                $("#KodePO").attr('hidden', false);
                                document.getElementsByName("po_customer_tanggal")[0].disabled = true;
                                document.getElementsByName("m_partner_id")[0].disabled = true;
                                document.getElementsByName("po_customer_kontak_person")[0].readOnly = true;
                                document.getElementsByName("po_customer_nama_pelanggan")[0].readOnly = true;
                                document.getElementsByName("m_karyawan_id")[0].disabled = true;
                                document.getElementById("po_customer_jasaangkut_jenis1").disabled = true;
                                document.getElementById("po_customer_jasaangkut_jenis2").disabled = true;
                                document.getElementsByName("po_customer_ekspedisi")[0].readOnly = true;
                                document.getElementById("po_customer_jasaangkut_bayar1").disabled = true;
                                document.getElementById("po_customer_jasaangkut_bayar2").disabled = true;
                                document.getElementsByName("po_customer_perjanjian_bayar")[0].readOnly = true;
                                document.getElementsByName("po_customer_catatan")[0].readOnly = true;
                                document.getElementById("btnAddBarang").disabled = true;
                                for (var i = 1; i <= itemBarang; i++) {
                                    document.getElementById("po_customerdet_qty"+i).readOnly = true;
                                    document.getElementById("po_customerdet_harga_satuan"+i).readOnly = true;
                                    document.getElementById("po_customerdet_harga_total"+i).readOnly = true;
                                    document.getElementById("po_customerdet_keterangan"+i).readOnly = true;
                                    document.getElementById("removeBtn"+i).disabled = true;
                                }
                                if (document.getElementById("statusStok").value == 0) {
                                    getDetailStok(document.getElementsByName("kode")[0].value);
                                }
                                getLimitKredit(document.getElementsByName("m_partner_id")[0].value);
                                getDetailPersetujuan(document.getElementsByName("kode")[0].value);
                            } else if (data.status=='204') {
                            }
                          }
                        });
                        checkItem();   
                    }
                } else if (index == 2) {
                    if (document.getElementById("statusStok").value == 0) {
                        document.getElementsByName('po_customer_status')[0].value = 3;
                        $.ajax({
                          type : "POST",
                          url  : $base_url+''+$("#url").val(),
                          data : $( "#formAdd" ).serialize()+"&step="+index,
                          dataType : "json",
                          success:function(data){
                            // if(data.status=='200'){
                            //     document.getElementById("statusstep2").innerHTML = '<span class="label bg-green-jungle bg-font-green-jungle"> Diterima </span>';
                            //     document.getElementById('simpantidaksetuju').disabled = true;
                            //     document.getElementById("statusStok").value = 1;
                            //     document.getElementById("statusstep3").innerHTML = '<span class="label bg-yellow-lemon bg-font-yellow-lemon"> Menunggu Persetujuan </span>';
                            // } else if (data.status=='204') {
                            // }
                          }
                        });
                        checkItem();
                    }
                } else if (index == 3) {
                    if (document.getElementById("statusKredit").value == 0) {
                        document.getElementsByName('po_customer_status')[0].value = 4;
                        $.ajax({
                          type : "POST",
                          url  : $base_url+''+$("#url").val(),
                          data : $( "#formAdd" ).serialize()+"&step="+index,
                          dataType : "json",
                          success:function(data){
                            if(data.status=='200'){
                                document.getElementById("statusstep2").innerHTML = '<span class="label bg-green-jungle bg-font-green-jungle"> Diterima </span>';
                                document.getElementById('simpantidaksetuju').disabled = true;
                                document.getElementById("statusStok").value = 1;
                                document.getElementById("statusstep3").innerHTML = '<span class="label bg-yellow-lemon bg-font-yellow-lemon"> Menunggu Persetujuan </span>';
                            } else if (data.status=='204') {
                            }
                          }
                        });
                        checkItem();
                    }
                } else if (index == 4) {
                    alert_success_save();
                    window.location.href = $base_url+''+$("#url_data").val();
                }
            }

            function simpanDraft() {
                document.getElementsByName('po_customer_status')[0].value = 1;
                $.ajax({
                  type : "POST",
                  url  : $base_url+''+$("#url").val(),
                  data : $( "#formAdd" ).serialize()+"&step=1",
                  dataType : "json",
                  success:function(data){
                    if(data.status=='200'){
                        alert_success_save();
                        window.location.href = $base_url+''+$("#url_data").val();
                    } else if (data.status=='204') {
                        alert_fail_save();
                    }
                  }
                });
            }

            function simpanTidakSetuju() {
                swal({
                    title: "Apakah anda yakin?",
                    text: "Data PO Customer tidak akan dilanjutkan!",
                    type: "warning",
                    showCancelButton: true,
                    cancelButtonClass: "btn-raised btn-warning",
                    cancelButtonText: "Cancel!",
                    confirmButtonClass: "btn-raised btn-danger",
                    confirmButtonText: "Yes!",
                    closeOnConfirm: false
                }, function() {
                    document.getElementsByName('po_customer_status')[0].value = 7;
                    $.ajax({
                      type : "POST",
                      url  : $base_url+''+$("#url").val(),
                      data : $( "#formAdd" ).serialize()+"&step=2",
                      dataType : "json",
                      success:function(data){
                        if(data.status=='200'){
                            alert_success_save();
                            window.location.href = $base_url+''+$("#url_data").val();
                        } else if (data.status=='204') {
                            alert_fail_save();
                        }
                      }
                    });
                });
            }

            function simpanTidakSetuju2() {
                swal({
                    title: "Apakah anda yakin?",
                    text: "Kredit PO Customer tidak disetujui!",
                    type: "warning",
                    showCancelButton: true,
                    cancelButtonClass: "btn-raised btn-warning",
                    cancelButtonText: "Cancel!",
                    confirmButtonClass: "btn-raised btn-danger",
                    confirmButtonText: "Yes!",
                    closeOnConfirm: false
                }, function() {
                    document.getElementsByName('po_customer_status')[0].value = 8;
                    $.ajax({
                      type : "POST",
                      url  : $base_url+''+$("#url").val(),
                      data : $( "#formAdd" ).serialize()+"&step=3",
                      dataType : "json",
                      success:function(data){
                        if(data.status=='200'){
                            alert_success_save();
                            window.location.href = $base_url+''+$("#url_data").val();
                        } else if (data.status=='204') {
                            alert_fail_save();
                        }
                      }
                    });
                });
            }

            function getDetailStok(id) {
                $.ajax({
                  type : "GET",
                  url  : '<?php echo base_url();?>Marketing/Purchase-Order-Customer/loadDataWhere/',
                  data : { id : id },
                  dataType : "json",
                  success:function(data){
                    for(var i = 0; i < data.val2.length; i++){
                        $("#default-table2 tbody").append('\
                            <tr>\
                                <td>\
                                    '+(i+1)+'\
                                </td>\
                                <td>\
                                    '+data.val2[i].barang_kode+'\
                                </td>\
                                <td>\
                                    '+data.val2[i].barang_uraian+'\
                                </td>\
                                <td>\
                                    <input type="text" class="form-control num2" value="'+data.val2[i].po_customerdet_qty+'" readonly/>\
                                </td>\
                                <td>\
                                    <input type="text" class="form-control num2" value="'+data.val2[i].stok_gudang_qty+'" readonly/>\
                                </td>\
                                <td>\
                                    '+data.val2[i].satuan_nama+'\
                                </td>\
                                <td>\
                                    <input type="text" class="form-control money" value="'+data.val2[i].po_customerdet_harga_satuan+'" readonly/>\
                                </td>\
                                <td>\
                                    <input type="text" class="form-control money" value="'+(data.val2[i].po_customerdet_qty * data.val2[i].po_customerdet_harga_satuan)+'" readonly/>\
                                </td>\
                                <td>\
                                    <textarea class="form-control" rows="3" readonly>'+data.val2[i].satuan_nama+'</textarea>\
                                </td>\
                            </tr>\
                        ');
                        $('.num2').number( true, 2, ',', '.' );
                        $('.money').number( true, 2, ',', '.' );
                    }
                  }
                });
            }

            function getLimitKredit(id) {
                $.ajax({
                    type : "GET",
                    url  : '<?php echo base_url();?>Master-Data/Partner/loadDataLimit/',
                    data : { id : id },
                    dataType : "json",
                    success:function(data){
                        for(var i=0; i<data.val.length;i++){
                            document.getElementsByName('partner_nama4')[0].value = data.val[i].partner_nama;
                            document.getElementsByName('partner_limit_kredit4')[0].value = data.val[i].partner_sisa_kredit;
                            if (data.val[i].partner_sisa_kredit > 0) {
                                document.getElementById("statusstep4").innerHTML = '<span class="label bg-green-jungle bg-font-green-jungle"> Kredit kurang dari limit </span>';
                            } else {
                                document.getElementById("statusstep4").innerHTML = '<span class="label bg-red-thunderbird bg-font-red-thunderbird"> Kredit melebihi limit </span>';
                            }
                            $('.money').number( true, 2, ',', '.' );
                        }
                    }
                });
            }

            function getDetailPersetujuan(id) {
                $.ajax({
                  type : "GET",
                  url  : '<?php echo base_url();?>Marketing/Purchase-Order-Customer/loadDataWhere/',
                  data : { id : id },
                  dataType : "json",
                  success:function(data){
                    for(var i = 0; i < data.val.length; i++){
                        document.getElementById("po_customer_nomor2").value = data.val[i].po_customer_nomor;
                        document.getElementById("po_customer_tanggal2").value = data.val[i].po_customer_tanggal;
                        document.getElementById("m_partner_id2").disabled = false;
                        for(var j=0; j<data.val[i].m_partner_id.val2.length; j++){
                            $("#m_partner_id2").append('<option value="'+data.val[i].m_partner_id.val2[j].id+'" selected>'+data.val[i].m_partner_id.val2[j].text+'</option>');
                            copyCustomer2(data.val[i].m_partner_id.val2[j].id);
                        }
                        document.getElementById("m_partner_id2").disabled = true;
                        document.getElementById("po_customer_kontak_person2").value = data.val[i].po_customer_kontak_person;
                        document.getElementById("po_customer_nama_pelanggan2").value = data.val[i].po_customer_nama_pelanggan;
                        document.getElementById("po_customer_alamat_kirim2").value = data.val[i].po_customer_alamat_kirim;
                        document.getElementById("m_karyawan_id2").disabled = false;
                        for(var j=0; j<data.val[i].m_karyawan_id.val2.length; j++){
                            $("#m_karyawan_id2").append('<option value="'+data.val[i].m_karyawan_id.val2[j].id+'" selected>'+data.val[i].m_karyawan_id.val2[j].text+'</option>');
                        }
                        document.getElementById("m_karyawan_id2").disabled = true;
                        if (data.val[i].po_customer_jasaangkut_jenis == 1) {
                            document.getElementById("po_customer_jasaangkut_jenis12").checked = true;
                            $('#jasaangkut_bayar2').removeClass('hidden');
                        } else {
                            document.getElementById("po_customer_jasaangkut_jenis22").checked = true;
                            $('#jasaangkut_bayar2').addClass('hidden');
                        }
                        document.getElementById("po_customer_ekspedisi2").value = data.val[i].po_customer_ekspedisi;
                        if (data.val[i].po_customer_jasaangkut_bayar == 1) {
                            document.getElementById("po_customer_jasaangkut_bayar12").checked = true;
                        } else {
                            document.getElementById("po_customer_jasaangkut_bayar22").checked = true;
                        }
                        document.getElementById("po_customer_perjanjian_bayar2").value = data.val[i].po_customer_perjanjian_bayar;
                        document.getElementById("po_customer_catatan2").value = data.val[i].po_customer_catatan;
                    }

                    for(var i = 0; i < data.val2.length; i++){
                        $("#default-table3 tbody").append('\
                            <tr>\
                                <td>\
                                    '+(i+1)+'\
                                </td>\
                                <td>\
                                    '+data.val2[i].barang_kode+'\
                                </td>\
                                <td>\
                                    '+data.val2[i].barang_uraian+'\
                                </td>\
                                <td>\
                                    <input type="text" class="form-control num2" value="'+data.val2[i].po_customerdet_qty+'" readonly/>\
                                </td>\
                                <td>\
                                    '+data.val2[i].satuan_nama+'\
                                </td>\
                                <td>\
                                    <input type="text" class="form-control money" value="'+data.val2[i].po_customerdet_harga_satuan+'" readonly/>\
                                </td>\
                                <td>\
                                    <input type="text" class="form-control money" value="'+(data.val2[i].po_customerdet_qty * data.val2[i].po_customerdet_harga_satuan)+'" readonly/>\
                                </td>\
                                <td>\
                                    <textarea class="form-control" rows="3" readonly>'+data.val2[i].satuan_nama+'</textarea>\
                                </td>\
                            </tr>\
                        ');
                        $('.num2').number( true, 2, ',', '.' );
                        $('.money').number( true, 2, ',', '.' );
                    }
                  }
                });
            }

            function editData(id) {
                $.ajax({
                  type : "GET",
                  url  : '<?php echo base_url();?>Marketing/Purchase-Order-Customer/loadDataWhere/',
                  data : { id : id },
                  dataType : "json",
                  success:function(data){
                    for(var i = 0; i < data.val.length; i++){
                        $("#KodePO").attr('hidden', false);
                        // STEP 1
                        document.getElementsByName('po_customer_status').value = data.val[i].po_customer_status;
                        if (data.val[i].po_customer_status > 2) {
                            document.getElementById('simpan').disabled = true;
                            document.getElementsByName('statusStok')[0].value = 1;
                            document.getElementById('btnAddBarang').disabled = true;
                            if (data.val[i].po_customer_status != 7) {
                                document.getElementById("statusstep2").innerHTML = '<span class="label bg-green-jungle bg-font-green-jungle"> Diterima </span>';
                            } else {
                                document.getElementById("statusstep2").innerHTML = '<span class="label bg-red-thunderbird bg-font-red-thunderbird"> Tidak Diterima </span>';
                            }
                            if (data.val[i].po_customer_status == 5) {
                                document.getElementById("statusstep3").innerHTML = '<span class="label bg-yellow-lemon bg-font-yellow-lemon"> Menunggu Persetujuan </span>';
                            } else if (data.val[i].po_customer_status == 4) {
                                document.getElementById("statusstep3").innerHTML = '<span class="label bg-green-jungle bg-font-green-jungle"> Diterima </span>';
                            }
                            if (data.val[i].po_customer_status >= 3 && data.val[i].po_customer_status <= 6) {
                                document.getElementById("statusKredit").value = 1;
                            }
                        }
                        document.getElementsByName("po_customer_nomor")[0].value = data.val[i].po_customer_nomor;
                        document.getElementsByName("po_customer_tanggal")[0].value = data.val[i].po_customer_tanggal;
                        document.getElementsByName("po_customer_tanggal")[0].disabled = true;
                        $("#m_partner_id").select2('destroy');
                        for(var j=0; j<data.val[i].m_partner_id.val2.length; j++){
                            $("#m_partner_id").append('<option value="'+data.val[i].m_partner_id.val2[j].id+'" selected>'+data.val[i].m_partner_id.val2[j].text+'</option>');
                            copyCustomer2(data.val[i].m_partner_id.val2[j].id);
                            getLimitKredit(data.val[i].m_partner_id.val2[j].id);
                        }
                        $("#m_partner_id").select2();
                        document.getElementById("m_partner_id").disabled = true;
                        document.getElementsByName("po_customer_kontak_person")[0].value = data.val[i].po_customer_kontak_person;
                        document.getElementsByName("po_customer_nama_pelanggan")[0].value = data.val[i].po_customer_nama_pelanggan;
                        document.getElementsByName("po_customer_alamat_kirim")[0].value = data.val[i].po_customer_alamat_kirim;
                        document.getElementsByName("po_customer_alamat_kirim")[0].disabled = true;
                        document.getElementsByName("po_customer_kontak_person")[0].disabled = true;
                        document.getElementsByName("po_customer_nama_pelanggan")[0].disabled = true;
                        $("#m_karyawan_id").select2('destroy');
                        for(var j=0; j<data.val[i].m_karyawan_id.val2.length; j++){
                            $("#m_karyawan_id").append('<option value="'+data.val[i].m_karyawan_id.val2[j].id+'" selected>'+data.val[i].m_karyawan_id.val2[j].text+'</option>');
                            copyCustomer2(data.val[i].m_karyawan_id.val2[j].id);
                        }
                        $("#m_karyawan_id").select2();
                        document.getElementById("m_karyawan_id").disabled = true;
                        if (data.val[i].po_customer_jasaangkut_jenis == 1) {
                            document.getElementById("po_customer_jasaangkut_jenis1").checked = true;
                            $('#jasaangkut_bayar').removeClass('hidden');
                        } else {
                            document.getElementById("po_customer_jasaangkut_jenis2").checked = true;
                            $('#jasaangkut_bayar').addClass('hidden');
                        }
                        document.getElementById("po_customer_jasaangkut_jenis1").disabled = true;
                        document.getElementById("po_customer_jasaangkut_jenis2").disabled = true;
                        document.getElementsByName("po_customer_ekspedisi")[0].value = data.val[i].po_customer_ekspedisi;
                        document.getElementsByName("po_customer_ekspedisi")[0].disabled = true;
                        if (data.val[i].po_customer_jasaangkut_bayar == 1) {
                            document.getElementById("po_customer_jasaangkut_bayar1").checked = true;
                        } else {
                            document.getElementById("po_customer_jasaangkut_bayar2").checked = true;
                        }
                        document.getElementById("po_customer_jasaangkut_bayar1").disabled = true;
                        document.getElementById("po_customer_jasaangkut_bayar2").disabled = true;
                        document.getElementsByName("po_customer_perjanjian_bayar")[0].value = data.val[i].po_customer_perjanjian_bayar;
                        document.getElementsByName("po_customer_perjanjian_bayar")[0].disabled = true;
                        document.getElementsByName("po_customer_catatan")[0].value = data.val[i].po_customer_catatan;
                        document.getElementsByName("po_customer_catatan")[0].disabled = true;

                        // STEP 3
                        document.getElementById("po_customer_nomor2").value = data.val[i].po_customer_nomor;
                        document.getElementById("po_customer_tanggal2").value = data.val[i].po_customer_tanggal;
                        document.getElementById("m_partner_id2").disabled = false;
                        for(var j=0; j<data.val[i].m_partner_id.val2.length; j++){
                            $("#m_partner_id2").append('<option value="'+data.val[i].m_partner_id.val2[j].id+'" selected>'+data.val[i].m_partner_id.val2[j].text+'</option>');
                            copyCustomer2(data.val[i].m_partner_id.val2[j].id);
                        }
                        document.getElementById("m_partner_id2").disabled = true;
                        document.getElementById("po_customer_kontak_person2").value = data.val[i].po_customer_kontak_person;
                        document.getElementById("po_customer_nama_pelanggan2").value = data.val[i].po_customer_nama_pelanggan;
                        document.getElementById("po_customer_alamat_kirim2").value = data.val[i].po_customer_alamat_kirim;
                        document.getElementById("m_karyawan_id2").disabled = false;
                        for(var j=0; j<data.val[i].m_karyawan_id.val2.length; j++){
                            $("#m_karyawan_id2").append('<option value="'+data.val[i].m_karyawan_id.val2[j].id+'" selected>'+data.val[i].m_karyawan_id.val2[j].text+'</option>');
                        }
                        document.getElementById("m_karyawan_id2").disabled = true;
                        if (data.val[i].po_customer_jasaangkut_jenis == 1) {
                            document.getElementById("po_customer_jasaangkut_jenis12").checked = true;
                            $('#jasaangkut_bayar2').removeClass('hidden');
                        } else {
                            document.getElementById("po_customer_jasaangkut_jenis22").checked = true;
                            $('#jasaangkut_bayar2').addClass('hidden');
                        }
                        document.getElementById("po_customer_ekspedisi2").value = data.val[i].po_customer_ekspedisi;
                        if (data.val[i].po_customer_jasaangkut_bayar == 1) {
                            document.getElementById("po_customer_jasaangkut_bayar12").checked = true;
                        } else {
                            document.getElementById("po_customer_jasaangkut_bayar22").checked = true;
                        }
                        document.getElementById("po_customer_perjanjian_bayar2").value = data.val[i].po_customer_perjanjian_bayar;
                        document.getElementById("po_customer_catatan2").value = data.val[i].po_customer_catatan;
                    }

                    itemBarang = data.val2.length;
                    for(var i = 0; i < data.val2.length; i++){

                        // STEP 1
                        $("#default-table tbody").append('\
                            <tr>\
                                <td>\
                                    '+(i+1)+'\
                                </td>\
                                <td>\
                                    '+data.val2[i].barang_kode+'\
                                </td>\
                                <td>\
                                    '+data.val2[i].barang_uraian+'\
                                </td>\
                                <td>\
                                    <input type="text" class="form-control num2" value="'+data.val2[i].po_customerdet_qty+'" readonly/>\
                                </td>\
                                <td>\
                                    '+data.val2[i].satuan_nama+'\
                                </td>\
                                <td>\
                                    <input type="text" class="form-control money" value="'+data.val2[i].po_customerdet_harga_satuan+'" readonly/>\
                                </td>\
                                <td>\
                                    <input type="text" class="form-control money" value="'+(data.val2[i].po_customerdet_qty * data.val2[i].po_customerdet_harga_satuan)+'" readonly/>\
                                </td>\
                                <td>\
                                    <textarea class="form-control" rows="3" readonly>'+data.val2[i].satuan_nama+'</textarea>\
                                </td>\
                                <td>\
                                    <button type="button" class="btn red-thunderbird" disabled>\
                                        <i class="icon-close"></i>\
                                    </button>\
                                </td>\
                            </tr>\
                        ');

                        // STEP 2
                        $("#default-table2 tbody").append('\
                            <tr>\
                                <td>\
                                    '+(i+1)+'\
                                </td>\
                                <td>\
                                    '+data.val2[i].barang_kode+'\
                                </td>\
                                <td>\
                                    '+data.val2[i].barang_uraian+'\
                                </td>\
                                <td>\
                                    <input type="text" class="form-control num2" value="'+data.val2[i].po_customerdet_qty+'" readonly/>\
                                </td>\
                                <td>\
                                    <input type="text" class="form-control num2" value="'+data.val2[i].stok_gudang_qty+'" readonly/>\
                                </td>\
                                <td>\
                                    '+data.val2[i].satuan_nama+'\
                                </td>\
                                <td>\
                                    <input type="text" class="form-control money" value="'+data.val2[i].po_customerdet_harga_satuan+'" readonly/>\
                                </td>\
                                <td>\
                                    <input type="text" class="form-control money" value="'+(data.val2[i].po_customerdet_qty * data.val2[i].po_customerdet_harga_satuan)+'" readonly/>\
                                </td>\
                                <td>\
                                    <textarea class="form-control" rows="3" readonly>'+data.val2[i].satuan_nama+'</textarea>\
                                </td>\
                            </tr>\
                        ');

                        // STEP 3
                        $("#default-table3 tbody").append('\
                            <tr>\
                                <td>\
                                    '+(i+1)+'\
                                </td>\
                                <td>\
                                    '+data.val2[i].barang_kode+'\
                                </td>\
                                <td>\
                                    '+data.val2[i].barang_uraian+'\
                                </td>\
                                <td>\
                                    <input type="text" class="form-control num2" value="'+data.val2[i].po_customerdet_qty+'" readonly/>\
                                </td>\
                                <td>\
                                    '+data.val2[i].satuan_nama+'\
                                </td>\
                                <td>\
                                    <input type="text" class="form-control money" value="'+data.val2[i].po_customerdet_harga_satuan+'" readonly/>\
                                </td>\
                                <td>\
                                    <input type="text" class="form-control money" value="'+(data.val2[i].po_customerdet_qty * data.val2[i].po_customerdet_harga_satuan)+'" readonly/>\
                                </td>\
                                <td>\
                                    <textarea class="form-control" rows="3" readonly>'+data.val2[i].satuan_nama+'</textarea>\
                                </td>\
                            </tr>\
                        ');

                        $('.num2').number( true, 2, ',', '.' );
                        $('.money').number( true, 2, ',', '.' );
                    }
                    checkItem();
                  }
                });
            }
        </script>

    </body>

</html>