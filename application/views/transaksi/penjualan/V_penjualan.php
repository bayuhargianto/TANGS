
<div id="struk">
    <table class="struk" width="100%">
            <tbody>
              <tr class="border-bottom">
                <td style="text-align: center;" colspan="4">HEADER STRUK</td>
              </tr>
              <tr class="border-bottom">
                <td style="text-align: center;" colspan="2">11-04-2017 12:14:41</td>
                <td style="text-align: center;" colspan="2">ADMIN</td>
              </tr>
              <tr class="border-bottom">
                <td>NAMA</td>
                <td style="text-align: center;">QTY</td>
                <td style="text-align: right;">HARGA</td>
                <td style="text-align: right;">SUBTOTAL</td>
              </tr>
              <tr class="border-top">
                <td style="text-align: right;" colspan="2">HARGA JUAL :</td>
                <td style="text-align: right;" colspan="2">0</td>
              </tr>
              <tr class="border-top">
                <td style="text-align: center;" colspan="4">FOOTER STRUK</td>
              </tr>
            </tbody>
    </table>
</div>
<div class="container" style="margin-top: 10px;">
    <div class="row">
        <div class="col-lg-5">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="pull-left">
                        <table class="table" style="font-size: 8pt;">
                            <tbody>
                            <tr>
                                <td>CUSTOMER :</td>
                                <td class="text-right sales-customer">
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="pull-right">
                        <table class="table" style="font-size: 8pt;">
                            <tbody>
                            <tr>
                                <td>USER :</td>
                                <td class="text-right sales-user">admin</td>
                            </tr>
                            <tr>
                                <td>SHIFT :</td>
                                <td class="text-right sales-shift">1</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-body">
                    <ul class="nav nav-tabs">
                        <li class="nav active"><a href="#tab-B" data-toggle="tab" title="ALT+4">ALL ITEMS</a></li>
                        <li class="nav"><a href="#tab-C" data-toggle="tab" title="ALT+5">CUSTOMERS</a></li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane fade" id="tab-A">
                            <br>
                            <table id="table-recent-item" class="table table-hover table-striped my-item" style="font-size: 12px;">
                                <thead>
                                <tr>
                                    <th width="80%">NAMA ITEM</th>
                                    <th class="text-right">HARGA</th>
                                    <th class="text-center"><i class="fa fa-th"></i></th>
                                </tr>
                                </thead>
                                <tbody class="fbody" id="data-recent-items">

                            </table>
                        </div>
                        <div class="tab-pane fade in active" id="tab-B">
                            <br>
                            <div class="input-group">
                                <input type="text" id="search" class="form-control input-sm" placeholder="Cari produk">
                                <span class="input-group-btn">
                                  <button class="btn btn-default btn-sm" type="button">
                                    <i class="fa fa-search"></i>
                                  </button>
                                </span>
                            </div><!-- /input-group -->
                            <br>
                            <table id="table-item" class="table table-hover table-striped my-item" style="font-size: 12px;">
                                <thead>
                                  <tr>
                                    <th width="80%">NAMA ITEM</th>
                                    <th class="text-right">HARGA</th>
                                    <th class="text-center"><i class="fa fa-th"></i></th>
                                  </tr>
                                </thead>
                                <tbody class="fbody" id="data-items">
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="tab-C">
                            <br>
                            <div class="input-group">
                                <input type="text" id="search2" class="form-control input-sm" placeholder="Cari Customer">
                                <span class="input-group-btn">
                                  <button class="btn btn-default btn-sm" type="button"><i class="fa fa-search"></i>
                                  </button>
                                </span>
                            </div><!-- /input-group -->
                            <br>
                            <table id="table-customer" class="table table-hover table-striped my-item" style="font-size: 12px;">
                                <thead>
                                <tr>
                                    <th width="80%">NAMA CUSTOMER</th>
                                    <th class="text-right">TELP.</th>
                                    <th class="text-center"><i class="fa fa-th"></i></th>
                                </tr>
                                </thead>
                                <tbody class="fbody" id="data-customers">
                                  <tr>
                                    <td id="item-name"></td>
                                    <td class="text-right"></td>
                                    <td class="text-center">
                                      <button data-name="Umum" data-id="1" class="btn btn-success btn-xs btn-add-customer">
                                        <i class="fa fa-check"></i>
                                      </button>
                                    </td>
                                  </tr>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="tab-D">
                            <br>
                            <div class="input-group">
                                <input type="text" id="search" class="form-control input-sm" placeholder="Cari produk">
                                <span class="input-group-btn">
                                  <button class="btn btn-default btn-sm" type="button"><i class="fa fa-search"></i>
                                  </button>
                                </span>
                            </div><!-- /input-group -->
                            <br>
                            <table id="table-item" class="table table-hover table-striped my-item" style="font-size: 12px;">
                                <thead>
                                <tr>
                                    <th width="80%">NAMA ITEM</th>
                                    <th class="text-right">HARGA</th>
                                    <th class="text-center"><i class="fa fa-th"></i></th>
                                </tr>
                                </thead>
                                <tbody class="fbody" id="data-diskon">
                                  <tr>
                                    <td id="item-name">Abon Roll EXP.10/12/2016</td>
                                    <td class="text-right">5.500</td>
                                    <td class="text-center">
                                      <button data-disc="0" data-price="5500" data-qty="1" data-name="Abon Roll EXP.10/12/2016"
                                      data-id="1" data-has-promo="0" data-promo-type="null" data-promo-item-name="null"
                                      data-promo-gratis="null" data-promo-qty="null" class="btn btn-success btn-xs btn-add-cart">
                                        <i class="fa fa-plus"></i>
                                      </button>
                                    </td>
                                  </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="panel panel-default" style="margin-bottom: 5px;">
                <div class="panel-body text-success" style="padding-top: 1px; padding-bottom: 1px;font-weight: bold;">
                    <small class="text-left pull-left">TOTAL YANG HARUS DIBAYAR</small>
                    <div id="cart-total-big" class="text-right pull-right" style="font-size: 40pt;">0</div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div id="list-cart">
                        <table class="table table-hover table-striped transaksi" style="font-size: 12px;">
                            <thead>
                            <tr>
                                <th width="20%" class="text-center">QTY</th>
                                <th width="40%">ITEM</th>
                                <th class="text-right">HARGA</th>
                                <th class="text-center hide" id="sales-column-discount">DISC</th>
                                <th class="text-right">TOTAL</th>
                                <th width="13%" class="text-center"><i class="fa fa-th"></i></th>
                            </tr>
                            </thead>
                            <tbody><input type="hidden" name="outlet_id" value="1"><input type="hidden" name="sales_shift" value="1">
                              <input type="hidden" name="customer_id" value="1"><input type="hidden" name="sales_discount" value="0">
                              <input type="hidden" name="sales_discount_percent_all" value="0">
                            </tbody>
                        </table>
                    </div>
                    <table class="table">
                        <tbody style="font-size: 10px;">
                        <tr style="font-weight: bold;">
                            <td width="15%" class="text-left text-danger"><span class="diskon_text hide">DISKON (%)</span></td>
                            <td width="15%" class="text-right text-danger" id="cart-discount-percent">
                              <!-- <input type="text" id="cart_discount_percen" name="cart_discount_percen" value=""> -->
                            </td>
                            <td width="15%" class="text-right text-info">TOTAL QTY</td>
                            <td width="15%" class="text-right text-info" id="cart-total-qty">0</td>
                            <td width="25%" class="text-right text-success">TOTAL SEBELUM DISKON</td>
                            <td width="15%" class="text-right text-success" id="cart-total">0</td>
                        </tr>
                        <tr style="font-weight: bold;">
                            <td width="15%" class="text-left text-danger"><span class="diskon_text hide">DISKON (Rp)</span></td>
                            <td width="15%" class="text-right text-danger" id="cart-discount"></td>
                            <td width="15%" class="text-right text-info">TOTAL ITEM</td>
                            <td width="15%" class="text-right text-info" id="cart-total-item">0</td>
                            <td width="25%" class="text-right text-success">TOTAL SETELAH DISKON</td>
                            <td width="15%" class="text-right text-success" id="cart-total-after-discount">0</td>
                        </tr>
                        </tbody>
                    </table>
                    <!--<button class="btn btn-default" id="btn-new-sales" disabled><i class="fa fa-plus"></i> TRANSAKSI</button>
                    <button class="btn btn-default" data-toggle="modal" data-target=".bs-modal-hold" disabled>HOLD</button>-->
                    <!-- <button title="ALT+3" class="btn btn-default" id="btn-sales-opsi"
                    data-toggle="modal" data-target=".bs-modal-sales">OPSI</button> -->
                    <button title="ALT+2" class="btn btn-warning" id="btn-sales-diskon"
                    data-toggle="modal" data-target=".bs-modal-disc" disabled="disabled">DISKON</button>
                    <button title="ALT+1" class="btn btn-success" id="btn-sales-bayar"
                    data-toggle="modal" data-target=".bs-modal-pay" disabled="disabled">BAYAR</button>

                    <div id="my-modal-hold" class="modal fade bs-modal bs-modal-hold" tabindex="-1" role="dialog"
                    aria-labelledby="mySmallModalLabel">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">×</span>
                                    </button>
                                    <h4 class="modal-title">TRANSAKSI AKTIF</h4>
                                </div>
                                <div class="modal-body" id="sales-hold-list">
                                    <label for="sales-list">NO. TRANSAKSI: </label>
                                    <div class="list-group" id="sales-list">
                                        <a href="#" class="list-group-item">1111</a>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary btn-ok" data-dismiss="modal">OK
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="my-modal-disc-item" class="modal fade bs-modal bs-modal-disc-item" tabindex="-1"
                    role="dialog" aria-labelledby="mySmallModalLabel">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">×</span>
                                    </button>
                                    <h4 class="modal-title">DISKON ITEM</h4>
                                </div>
                                <div class="modal-body">
                                    <label for="input-discount-item">Diskon(Rp) :</label>
                                    <input type="text" class="form-control input-lg numeric" id="input-discount-item" value="">
                                    <label for="input-discount-item-percent">Diskon(%) :</label>
                                    <input type="text" class="form-control input-lg numeric" id="input-discount-item-percent" value="">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary btn-ok">OK</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="my-modal-disc" class="modal fade bs-modal bs-modal-disc" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">×</span>
                                    </button>
                                    <h4 class="modal-title">DISKON NOTA</h4>
                                </div>
                                <div class="modal-body">
                                    <label for="input-discount">Diskon(Rp) :</label>
                                    <input type="text" class="form-control input-lg numeric" id="input-discount" value="">
                                    <label for="input-discount-percent">Diskon(%) :</label>
                                    <input type="text" class="form-control input-lg numeric" id="input-discount-percent" value="">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary btn-ok">OK</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="my-modal-pay" class="modal fade bs-modal bs-modal-pay" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <form id="form-submit-sales" onsubmit="return false;" method="post">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">×</span>
                                        </button>
                                        <h4 class="modal-title">PEMBAYARAN</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div style="display: none;" class="box-sales" id="box-sales-fee">
                                            <label for="sales-fee">Biaya Tambahan :</label>
                                            <input type="text" class="form-control" id="sales-fee" value="0" readonly="">
                                            <small class="text-danger" id="sales-fee-text"></small>
                                        </div>
                                        <label for="input-total">Total :</label>
                                        <input type="text" class="form-control" id="input-total-currency" name="input-total-currency" value="0" readonly="">
                                        <input type="hidden" class="form-control" id="input-total" name="input-total" value="0" readonly="">
                                        <label for="sales_type">Jenis Pembayaran :</label>
                                        <select name="sales_type" id="sales_type" class="form-control">
                                            <option value="cash" selected="">Cash</option>
                                            <option value="debit">Debit</option>
                                            <option value="kredit">Kredit</option>
                                            <option value="transfer">Transfer</option>
                                            <option value="kartu_kredit">Kartu Kredit</option>
                                        </select>
                                        <div class="box-sales" id="box-sales-pay">
                                            <label for="input-pay">Bayar :</label>
                                            <input type="text" class="form-control numeric" id="input-pay-currency" name="sales_pay_currency" value="0">
                                            <input type="hidden" class="form-control" id="input-pay" name="sales_pay" value="0">
                                        </div>
                                        <div style="display: none;" class="box-sales" id="box-sales-dp">
                                            <label for="sales-dp">DP :</label>
                                            <input type="text" class="form-control numeric" id="sales-dp" name="sales-dp" value="0">
                                            <label for="sales-dp">Tanggal Jatuh Tempo :</label>
                                            <div class='input-group date' id='datetimepicker1'>
                                                <input type='text' class="form-control" name="tgl_jatuh_tempo" />
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                        </div>
                                        <div style="display: none;" class="box-sales" id="box-sales-nama">
                                            <label for="sales-nama">Nama* :</label>
                                            <input type="text" class="form-control" id="sales-nama" name="sales-nama">
                                        </div>
                                        <div style="display: none;" class="box-sales" id="box-sales-nomor-kartu">
                                            <label for="sales-nomor-kartu">Nomor Kartu* :</label>
                                            <input type="text" class="form-control" id="sales-nomor-kartu" name="sales-nomor-kartu">
                                        </div>
                                        <div style="display: none;" class="box-sales" id="box-sales-nama-bank">
                                            <label for="sales-nama-bank">Nama Bank* :</label>
                                            <input type="text" class="form-control" id="sales-nama-bank" name="sales-nama-bank">
                                        </div>
                                        <div style="display: none;" class="box-sales" id="box-sales-nomor-rekening">
                                            <label for="sales-nomor-rekening">Nomor Rekening :</label>
                                            <input type="text" class="form-control" id="sales-nomor-rekening" name="sales-nomor-rekening">
                                        </div>
                                        <div class="box-sales" id="box-input-cashback">
                                            <label for="input-cashback">Kembalian :</label>
                                            <input type="text" class="form-control" id="input-cashback-currency" value="0" readonly="">
                                            <input type="hidden" class="form-control" id="input-cashback" name="input-cashback" value="0" readonly="">
                                        </div>
                                    </div>
                                    <div id="list-hidden"><input type="hidden" name="outlet_id" value="1">
                                      <input type="hidden" name="sales_shift" value="1">
                                      <input type="hidden" name="customer_id" value="1">
                                      <input type="hidden" name="sales_discount" value="0">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary btn-ok">OK</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div id="my-modal-sales" class="modal fade bs-modal bs-modal-sales" tabindex="-1" role="dialog"
                    aria-labelledby="mySmallModalLabel">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">×</span>
                                    </button>
                                    <h4 class="modal-title">OPSI PENJUALAN</h4>
                                </div>
                                <div class="modal-body">
                                    <label for="sales-outlet">NAMA OUTLET :</label>
                                    <select class="form-control" id="sales-outlet">
                                    <option value="1">Surabaya 001</option></select>
                                    <br>
                                    <label for="sales-shift">SHIFT :</label>
                                    <select class="form-control" id="sales-shift">
                                        <option value="1">SHIFT 1</option>
                                        <option value="2">SHIFT 2</option>
                                    </select>
                                    <br>
                                    <input type="hidden" class="form-control input-lg" id="sales-cash" value="0">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary btn-ok">OK</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
