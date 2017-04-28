

<script type="text/javascript">
    var outlets = [{"id":"1","value":"Surabaya 001"}];
    var customers = [];
    var items = [];
    var recent_items = [];
    var sales_discount_item = 0;
    var sales_discount_item_current_index = 0;
    var sales_total_item = 0;
    var sales_active = 0;
    var sales_pay = 0;
    var sales_cashback = 0;
    var sales_date = "11-04-2017";
    var sales_time = "12:14:41";
    var sales_customer = "umum";
    var sales_customer_id = 1;
    var sales_cabang = "Surabaya 001";
    var sales_cabang_id = 1;
    var base_url = "<?php echo base_url(); ?>";
    var sales_id = 1;
    var discount_percent = 0;
    var stok_gudang_jumlah = 0;


    var sales_shift = 1;
    if (localStorage.getItem("sales_shift") == null){
        sales_shift = 1;
    }else{
        sales_shift = localStorage.getItem("sales_shift");
    }


    var sales_discount = 0;
    var sales_cash = 0;
    var sales_username = 'ADMIN';
    var sales_fee = 10;
    var sales_fee_batas = 100000;

    function printDiv(divId) {
        var printContents = document.getElementById(divId).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = "<html><head><title></title></head><body>" + printContents + "</body>";
        window.print();
        document.body.innerHTML = originalContents;
    }
    var intTotal = 0;
    var intSubTotal = 0;

    jQuery(function($) {
        $('.numeric').autoNumeric('init',{aPad: false});
        $('[data-toggle="tooltip"]').tooltip();
    });

    $(document).ready(function () {

        // $.each(item-name, function(index, value) {
        //   console.log(1);
        // })

        $('#item-name').val();
        $("#btn-sales-bayar").click(function(){
            $("#sales_type").val('cash');
            $("#sales_type").change();
        });

        $("#search").focus();

        // /*LOCAL STORAGE*/
        var storage_sales = JSON.parse(localStorage.getItem('sales'));
        var storage_sales_detail = JSON.parse(localStorage.getItem('sales_detail'));
        // console.log(storage_sales_detail);

        if (!storage_sales_detail) {
            storage_sales_detail = [];
            localStorage.setItem('sales_detail', JSON.stringify(storage_sales_detail));
        }

        $.each(outlets, function (index, value) {
            $('#sales-outlet').append($('<option/>', {
                value: value.id,
                text: value.value
            }));
        });


        $('#my-modal-disc').on('click', '.btn-ok', function () {
            if( $('#input-discount').val().length == 0 ){
                sales_discount = 0;
            }else{
                sales_discount = parseInt($("#input-discount").autoNumeric('get'));
            }
            if( sales_discount > total_sales_detail ){
                alert('Diskon tidak boleh lebih dari total bayar!');
                sales_discount = 0;
                $("#input-discount").val('0');
                $("#input-discount-percent").val('0')
            }else{
                $.fn.updateSales();
                $('#my-modal-disc').modal('toggle');
            }
        });

        $('#my-modal-disc-item').on('click', '.btn-ok', function () {
            var current_discount_item = 0;
            if( $('#input-discount-item').val().length == 0 ){
                discount_percent = 0;
                current_discount_item = 0;
            }else{
                discount_percent = $('#input-discount-item-percent').val();
                current_discount_item = parseInt($("#input-discount-item").autoNumeric('get'));
            }
            if( current_discount_item > sales_total_item ){
                alert('Diskon tidak boleh lebih dari total!');
                current_discount_item = 0;
                $("#input-discount-item").val('0');
                $("#input-discount-item-percent").val('0')
            }else{
                console.log( current_discount_item );
                var item_index = sales_discount_item_current_index;
                var this_name = '';
                var this_id = 0;
                var this_price = 0;
                var this_qty = 0;
                var this_disc = 0;
                var this_total = 0;
                var item_exist = 0;
                var item_exist_index = -1;

                if (storage_sales_detail) {
                    $.each(storage_sales_detail, function (index, value) {
                        if (item_index == index) {
                            this_name = value.item_name;
                            this_id = value.item_id;
                            this_price = value.item_price;
                            this_qty = value.item_qty;
                            this_disc = current_discount_item;
                            this_disc_percent = discount_percent;
                            this_has_promo = value.item_has_promo;
                            this_promo_type = value.item_promo_type;
                            this_promo_gratis = value.item_promo_gratis;
                            this_promo_item_name = value.item_promo_item_name;
                            this_promo_qty = value.item_promo_qty;
                            this_total = value.item_total * this_qty;
                            item_exist = 1;
                            item_exist_index = index;
                        }
                    });
                }
                var new_data = {
                    'item_name': this_name,
                    'item_id': this_id,
                    'item_price': this_price,
                    'item_qty': this_qty,
                    'item_disc': this_disc,
                    'item_discount_percent': this_disc_percent,
                    'item_total': this_total,
                    'item_has_promo': this_has_promo,
                    'item_promo_type': this_promo_type,
                    'item_promo_gratis': this_promo_gratis,
                    'item_promo_item_name': this_promo_item_name,
                    'item_promo_qty': this_promo_qty
                };
                storage_sales_detail[item_exist_index] = new_data;
                localStorage.setItem('sales_detail', JSON.stringify(storage_sales_detail));
                $.fn.refreshChart();
                $('#my-modal-disc-item').modal('toggle');
            }
        });

        $.fn.getCustomers = function () {
            $.get( base_url+'C_POS/get_customers',function(data){
                customers = data;
                var html = '';
                $.each(JSON.parse(data), function (index, value) {
                    html += '<tr><td id="item-name">'+value.partner_nama+'</td>' +
                        '<td class="text-right">'+value.partner_telepon+'</td>' +
                        '<td class="text-center"><button data-name="'+value.partner_nama+'" data-id="'+value.partner_id+
                        '" class="btn btn-success btn-xs btn-add-customer">' +
                        '<i class="fa fa-check"></i></button></td></tr>';
                });
                $("#data-customers").html(html);
            });
        };

        $.fn.updateSales = function () {
            var new_sales = {
                'sales_cabang_id': sales_cabang_id,
                'sales_cabang': sales_cabang,
                'sales_customer': sales_customer,
                'sales_customer_id': sales_customer_id,
                'sales_disc': sales_discount,
                'sales_shift': sales_shift
            };
            storage_sales = new_sales;
            localStorage.setItem('sales', JSON.stringify(storage_sales));
            $.fn.refreshChart();
        };

        $.fn.updateSalesDiscount = function () {
            var new_sales = {
                'sales_cabang_id': sales_cabang_id,
                'sales_cabang': sales_cabang,
                'sales_customer': sales_customer,
                'sales_customer_id': sales_customer_id,
                'sales_disc': sales_discount,
                'sales_shift': sales_shift
            };
            storage_sales = new_sales;
            localStorage.setItem('sales', JSON.stringify(storage_sales));
        };

        $.fn.refreshSales = function () {
            storage_sales = JSON.parse(localStorage.getItem('sales'));
            if (storage_sales) {
                sales_cabang_id = parseInt(storage_sales.sales_cabang_id);
                sales_cabang = storage_sales.sales_cabang;
                sales_customer = storage_sales.sales_customer;
                sales_customer_id = parseInt(storage_sales.sales_customer_id);
                sales_discount = parseInt(storage_sales.sales_disc);
                sales_shift = parseInt(storage_sales.sales_shift);
            }
        };

        $.fn.refreshChart = function () {
            $.fn.refreshSales();
            storage_sales_detail = JSON.parse(localStorage.getItem('sales_detail'));

            var html = '';
            var html_struk = '';
            var input_sales_detail = '';
            intSubTotal = 0;
            total_sales_detail = 0;
            var total_disc_prod = 0;
            var total_item = 0;
            var total_item_qty = 0;
            var has_discount = 0;

            var input_sales = ''
                + '<input type="hidden" name="outlet_id" value="' + sales_cabang_id + '">'
                + '<input type="hidden" name="sales_shift" value="' + sales_shift + '">'
                + '<input type="hidden" name="customer_id" value="' + sales_customer_id + '">'
                + '<input type="hidden" name="sales_discount" value="' + sales_discount + '">';

            html_struk += '<tr class="border-bottom">';
            html_struk += '<td style="text-align: center;" colspan="4">HEADER STRUK</td>';
            html_struk += '</tr>';
            html_struk += '<tr class="border-bottom">';
            html_struk += '<td style="text-align: center;" colspan="2">'+sales_date+' '+sales_time+'</td>';
            html_struk += '<td style="text-align: center;" colspan="2">'+sales_username+'</td>';
            html_struk += '</tr>';
            html_struk += '<tr class="border-bottom">';
            html_struk += '<td>NAMA</td>';
            html_struk += '<td style="text-align: center;">QTY</td>';
            html_struk += '<td style="text-align: right;">HARGA</td>';
            html_struk += '<td style="text-align: right;">SUBTOTAL</td>';
            html_struk += '</tr>';

            $.each(storage_sales_detail, function (index, value) {
                var item_disc = value.item_disc;
                if( item_disc ) has_discount = 1;
            });

            $.each(storage_sales_detail, function (index, value) {
                var item_name = value.item_name;
                var item_id = value.item_id;
                var item_price = value.item_price;
                var item_qty = value.item_qty;
                var item_disc = value.item_disc;
                var item_discount_percent = value.item_disc;
                var item_has_promo = value.item_has_promo;
                var item_promo_type = value.item_promo_type;
                var item_promo_gratis = value.item_promo_gratis;
                var item_promo_item_name = value.item_promo_item_name;
                var item_promo_qty = value.item_promo_qty;
                var item_disc_total = 0;
                if( item_disc > 0 ) item_disc_total += item_disc;
                var item_total = (item_qty * item_price) - item_disc_total;
                var item_total_before_discount = item_qty * item_price;
                total_sales_detail += item_total;
                total_disc_prod += item_disc_total;
                total_item+=1;
                total_item_qty+=item_qty;

                var promo_text = '';
                if( item_has_promo && item_qty >= item_promo_qty ){
                    if( item_promo_type == 'item' ){
                        item_promo_gratis = Math.floor(item_qty/item_promo_qty)* item_promo_gratis;
                        total_item+=1;
                        total_item_qty+=item_promo_gratis;
                        promo_text = '<br/><small style="font-size: 9px;color: red;">(GRATIS) ' + item_promo_item_name + ' x ' + item_promo_gratis + '</small>';
                    }else{
                        //item_promo_gratis = Math.floor(item_qty/item_promo_qty)* item_promo_gratis;
                        promo_text = '<br/><small style="font-size: 9px;color: red;">Cashback Rp ' + Intl.NumberFormat().format(item_disc) + '</small>';
                        //item_disc_total+=item_promo_gratis;
                    }
                }

                var input = '<input type="hidden" name="item_id[]" value="' + item_id + '">'
                            + '<input type="hidden" name="item_price[]" value="' + item_price + '">'
                            + '<input type="hidden" name="item_qty[]" value="' + item_qty + '">'
                            + '<input type="hidden" name="item_discount[]" value="' + item_disc_total + '">'
                            + '<input type="hidden" name="item_discount_percent[]" value="' + item_discount_percent + '">'
                            ;

                input_sales_detail += input;

                intSubTotal += item_total;
                var itemPrice = Intl.NumberFormat().format(item_price);
                var itemTotal = Intl.NumberFormat().format(item_total);
                var itemDiscTotal = Intl.NumberFormat().format(item_disc_total);

                html += '<tr>';
                html += '<td class="text-center">';
                html += '<div class="input-group input-group-sm">';
                html += '<span class="input-group-btn">';
                html += '<button data-id="" class="btn btn-danger btn-sm btn-decrease-cart" type="button"><i class="fa fa-minus"></i></button>';
                html += '</span>';
                html += '<input type="text"  style="text-align:center;" class="form-control input-sm qty" value="' + item_qty + '">';
                html += '<span class="input-group-btn">';
                html += '<button data-id="" class="btn btn-success btn-sm btn-increase-cart" type="button"><i class="fa fa-plus"></i></button>';
                html += '</span>';
                html += '</div>';
                html += '</td>';
                html += '<td>' + item_name;
                if( item_has_promo ) html += promo_text;
                html += '</td>';
                html += '<td class="text-right">' + itemPrice + '</td>';
                if( has_discount ) html += '<td class="text-center">' + itemDiscTotal + '</td>';
                html += '<td class="text-right">' + itemTotal + '</td>';
                html += '<td style="text-align: right;">' +
                        '<div class="btn-group">' +
                        '<button type="button" title="diskon item" data-discount-item="'+item_disc_total+'"\
                        data-total="'+item_total_before_discount+'" class="btn btn-primary btn-sm btn-show-discount-item">\
                        <i class="fa fa-usd" aria-hidden="true"></i></button>' +
                        '<button type="button" title="hapus item" class="btn btn-danger btn-sm btn-remove-cart">\
                        <i class="fa fa-trash" aria-hidden="true"></i></button>' +
                        '</div>' +
                        '</td>';
                html += '</tr>';

                html_struk += '<tr>';
                if( item_disc > 0 ){
                    html_struk += '<td>' + item_name +' DISC '+itemDiscTotal + '%</td>';
                }else{
                    html_struk += '<td>' + item_name +'</td>';
                }
                html_struk += '<td style="text-align: center;">'+ item_qty  +'</td>';
                html_struk += '<td style="text-align: right;">' + itemPrice + '</td>';
                html_struk += '<td style="text-align: right;">' + itemTotal + '</td>';
                html_struk += '</tr>';
            });

            if( has_discount ) {
                $("#sales-column-discount").removeClass('hide');
            }else{
                $("#sales-column-discount").addClass('hide');
            }

            html += input_sales;

            var total_disc_nota = 0;
            if( sales_discount > 0 ) total_disc_nota += sales_discount;
            intTotal = intSubTotal - (total_disc_nota);
            intTotal = Math.ceil(intTotal/100)*100;



            var cartTotal = Intl.NumberFormat().format(intTotal);
            var cartSubTotal = Intl.NumberFormat().format(intSubTotal);
            var cartDiscount = Intl.NumberFormat().format(sales_discount);
            var cartDiscountPercent = Intl.NumberFormat().format(total_disc_nota/total_sales_detail*100);
            var cartItemTotal = Intl.NumberFormat().format(total_item);
            var cartItemQty = Intl.NumberFormat().format(total_item_qty);

            html_struk += '<tr class="border-top">';
            html_struk += '<td style="text-align: right;" colspan="2">HARGA JUAL :</td>';
            html_struk += '<td style="text-align: right;" colspan="2">'+ cartTotal +'</td>';
            html_struk += '</tr>';
            html_struk += '<tr class="border-top">';
            html_struk += '<td style="text-align: center;" colspan="4">FOOTER STRUK</td>';
            html_struk += '</tr>';

            $("#list-hidden").html(input_sales + input_sales_detail);
            $(".transaksi tbody").html(html);
            $(".struk tbody").html(html_struk);
            $("#cart-discount").html(cartDiscount);
            $("#cart-discount-percent").html(cartDiscountPercent);
            $("#cart_discount_percen").val(cartDiscountPercent);
            $("#input-discount").val(sales_discount);
            $("#cart-total").html(cartSubTotal);
            $("#cart-total-after-discount").html(cartTotal);
            $("#cart-total-item").html(cartItemTotal);
            $("#cart-total-qty").html(cartItemQty);
            $("#cart-total-big").html(cartTotal);
            $(".sales-customer").html(sales_customer.toUpperCase());
            $(".sales-id").html(sales_id);
            $(".sales-cabang").html(sales_cabang);
            $(".sales-shift").html(sales_shift);

            $("#my-modal-pay").find("input:text#input-total-currency").val(cartTotal);
            $("#my-modal-pay").find("input:text#input-total").val();

            if( sales_discount == 0 ){
                $(".diskon_text").addClass('hide');
                $("#cart-discount").html('');
                $("#cart-discount-percent").html('');
            }else{
                $(".diskon_text").removeClass('hide');
            }

            if (total_item == 0) {
                $("#btn-sales-bayar").attr('disabled', 'disabled');
                $("#btn-sales-diskon").attr('disabled', 'disabled');
                $.fn.refreshSales();
            } else {
                $("#btn-sales-bayar").removeAttr('disabled');
                $("#btn-sales-diskon").removeAttr('disabled');
            }
        };

        $.fn.addCart = function (btn) {
            var this_name = btn.attr('data-name');
            var this_id = parseInt(btn.attr('data-id'));
            var this_price = parseInt(btn.attr('data-price'));
            var this_qty = parseInt(btn.attr('data-qty'));
            var this_disc = parseInt(btn.attr('data-disc'));
            var this_has_promo = parseInt(btn.attr('data-has-promo'));
            var this_promo_type = btn.attr('data-promo-type');
            var this_promo_gratis = parseInt(btn.attr('data-promo-gratis'));
            var this_promo_item_name = btn.attr('data-promo-item-name');
            var this_promo_qty = parseInt(btn.attr('data-promo-qty'));
            var this_total = this_qty * this_price;
            var item_exist = 0;
            var item_exist_index = -1;

            // alert(this_id);

            if (storage_sales_detail) {
                $.each(storage_sales_detail, function (index, value) {
                    if (value.item_id == this_id) {
                        item_exist = 1;
                        item_exist_index = index;
                        this_qty = this_qty + value.item_qty;
                    }
                });
            }

            if (item_exist) storage_sales_detail.splice(item_exist_index, 1);

            var discount = this_disc;
            var new_sales_detail = {
                'item_name': this_name,
                'item_id': this_id,
                'item_price': this_price,
                'item_qty': this_qty,
                'item_disc': discount,
                'item_total': this_total,
                'item_has_promo': this_has_promo,
                'item_promo_type': this_promo_type,
                'item_promo_gratis': this_promo_gratis,
                'item_promo_item_name': this_promo_item_name,
                'item_promo_qty': this_promo_qty
            };
            storage_sales_detail.push(new_sales_detail);
            localStorage.setItem('sales_detail', JSON.stringify(storage_sales_detail));
            $.fn.refreshChart();
        };

        $("body").on("click", ".btn-remove-cart", function (e) {
            var item_row = $(this).parent().parent().parent();
            var item_index = item_row.index();
            item_row.remove();
            storage_sales_detail.splice(item_index, 1);
            localStorage.setItem('sales_detail', JSON.stringify(storage_sales_detail));
            $.fn.refreshChart();
            alert();
        });

        $("body").on("click", ".btn-show-discount-item", function (e) {
            var item_row = $(this).parent().parent().parent();
            sales_discount_item_current_index = item_row.index();
            sales_total_item = parseInt($(this).attr('data-total'));
            sales_discount_item = parseInt($(this).attr('data-discount-item'));
            $("#input-discount-item").autoNumeric('set', sales_discount_item);
            var persen = sales_discount_item/sales_total_item*100;
            $("#input-discount-item-percent").autoNumeric('set', persen);
            $('#my-modal-disc-item').modal('toggle');
            e.preventDefault();
        });

        $("#input-discount-item").keyup(function () {
            var this_value = $(this).autoNumeric('get');
            var persen = this_value/sales_total_item*100;
            $("#input-discount-item-percent").autoNumeric('set', persen);
        });

        $("#input-discount-item-percent").keyup(function () {
            var this_value = $(this).autoNumeric('get');
            var nominal = this_value/100*sales_total_item;
            $("#input-discount-item").autoNumeric('set', nominal);
        });

        $("#input-discount").keyup(function () {
            var this_value = $(this).autoNumeric('get');
            var type_karyawan = $('#type_karyawan').val();
            var persen = this_value/total_sales_detail*100;

            if (persen>=5) {
              if (type_karyawan!=2) {
                $("#input-discount").val(0);
                persen = '';
              }
            }

            $("#input-discount-percent").autoNumeric('set', persen);

        });

        $("#input-discount-percent").keyup(function () {
            var this_value = $(this).autoNumeric('get');
            var type_karyawan = $('#type_karyawan').val();
            var nominal = '';

            console.log(this_value);
            if (this_value>5) {
              if (type_karyawan!=1) {
                $("#input-discount-percent").val(0);
                var nominal = 0;
              } else {
                $("#input-discount-percent").val(this_value);
                var nominal = this_value/100*total_sales_detail;
              }
            }

            $("#input-discount").autoNumeric('set', nominal);

        });

        $("#input-pay-currency").keyup(function () {
            sales_pay = $(this).autoNumeric('get');

      			// var total_fee = sales_fee / 100 * intTotal;
      			// var tot = intTotal + total_fee;

            sales_cashback = sales_pay - intTotal;
            var cashback2 = Intl.NumberFormat().format(sales_cashback);
            $("#input-pay").val(sales_pay);
            $("#my-modal-pay").find("input:text#input-cashback-currency").val(cashback2);
            $("#input-cashback").val(sales_cashback);
        });

        $.fn.getItems = function () {
          $.get( base_url+'C_POS/get_items',function(data){
              var html = '';
              $.each(JSON.parse(data), function (index, value) {
                  items.push(value);
                  stok_gudang_jumlah = value.stok_gudang_jumlah;
                  if (stok_gudang_jumlah>0) {
                    var icon = '<i class="glyphicon glyphicon-ok-circle"></i>';
                  } else {
                    var icon = '<i class="glyphicon glyphicon-remove-circle"></i>';
                  }
                  html += '<tr>\
                            <td class="text-center">'+icon+'</td>\
                            <td id="item-name">'+value.barang_nama+'</td>\
                            <td class="text-right">'+Intl.NumberFormat().format(value.harga_jual_pajak)+'</td>\
                            <td class="text-center">\
                              <button data-disc="" data-price="'+value.harga_jual_pajak+'" \
                              data-qty="1" data-name="'+value.barang_nama+' EXP." \
                              data-id="'+value.barang_id+'" data-has-promo="'+value.aktif+'" data-promo-harga="" data-promo-type=""\
                              data-status-aktif=""\
                              data-promo-item-name="'+value.promo_nama+'" data-promo-gratis="" data-promo-qty="'+value.promo_qty+'" \
                              class="btn btn-success btn-xs btn-add-cart">\
                                <i class="fa fa-plus"></i>\
                              </button>\
                            </td>\
                          </tr>';
                    });
              $("#data-items").html(html);
          }).fail(function(data){
                alert(data);
            });
    };

    // console.log(items);

        $("#search").keyup(function () {
            var new_data = [];
            var word = $(this).val();
            word = word.toLowerCase();
            var i =1;
            $.each(items, function (index, value) {
                var name = value.barang_nama.toLowerCase();
                var barang_kode = value.barang_kode;
                // // console.log(name);
                if(name.search(word) > -1){
                //   // console.log(name);
                    this_data = {
                        'barang_id' : value.barang_id,
                        'm_jenis_barang_id' : value.m_jenis_barang_id,
                        'category_2_id' : value.category_2_id,
                        'barang_kode' : value.barang_kode,
                        'barang_nomor' : value.barang_nomor,
                        'barang_nama' : value.barang_nama,
                        'm_satuan_id' : value.m_satuan_id,
                        'brand_id' : value.brand_id,
                        'harga_beli' : value.harga_beli,
                        'harga_jual' : value.harga_jual,
                        'harga_jual_pajak' : value.harga_jual_pajak,
                        'stok' : value.stok,
                        'barang_minimum_stok' : value.barang_minimum_stok,
                        'stok_maks' : value.stok_maks,
                        'barang_status_aktif' : value.barang_status_aktif,
                        'barang_create_date' : value.barang_create_date,
                        'barang_create_by' : value.barang_create_by,
                        'barang_update_date' : value.barang_update_date,
                        'barang_update_by' : value.barang_update_by,
                        'barang_revised': value.barang_revised,
                        'stok_gudang_jumlah': value.stok_gudang_jumlah
                    };
                    // console.log(this_data);
                    new_data.push(this_data);
                    // console.log(new_data);
                }
            });

            var html = '';
            $.each(new_data, function (index, value) {
              stok_gudang_jumlah = value.stok_gudang_jumlah;
              if (stok_gudang_jumlah>0) {
                var icon = '<i class="glyphicon glyphicon-ok-circle"></i>';
              } else {
                var icon = '<i class="glyphicon glyphicon-remove-circle"></i>';
              }
              html += '<tr>\
                        <td></td>\
                        <td id="item-name">'+value.barang_nama+'</td>\
                        <td class="text-right">'+Intl.NumberFormat().format(value.harga_jual_pajak)+'</td><td class="text-center">\
                          <button data-disc="" data-price="'+value.harga_jual_pajak+'" \
                          data-qty="1" data-name="'+value.barang_nama+' EXP." \
                          data-id="'+value.barang_id+'" data-has-promo="'+value.aktif+'" data-promo-harga="'+value.promo_harga+'" data-promo-type=""\
                          data-status-aktif=""\
                          data-promo-item-name="'+value.promo_nama+'" data-promo-gratis="" data-promo-qty="'+value.promo_qty+'" \
                          class="btn btn-success btn-xs btn-add-cart">\
                            <i class="fa fa-plus"></i>\
                          </button>\
                        </td>\
                      </tr>';
            });
            $("#data-items").html(html);
        });


        $('body').on('click', '.btn-add-cart', function (e) {
            $.fn.addCart($(this));
            e.preventDefault();
        });

        $('body').on('click', '.btn-add-customer', function (e) {
            sales_customer_id = $(this).attr("data-id");
            sales_customer = $(this).attr("data-name");
            $.fn.updateSales();
            e.preventDefault();
        });

        $('#my-modal-hold').on('click', '.list-group-item', function (e) {
            sales_id = $(this).html();
            $(".list-group-item").removeClass("active");
            $(this).addClass("active");
            $.fn.refreshChart();
            e.preventDefault();
        });

        $("#btn-new-sales").click(function () {
            $.fn.newSales();
        });

        $(document).on('keydown', '.qty', function(e){
            if(e.which == 13) {
                var item_qty = 1;
                if( $(this).val().length == 0 || $(this).val() < 1 ){
                    item_qty = 1;
                }else{
                    item_qty = parseInt($(this).val());
                }
                var item_row = $(this).parent().parent().parent();
                var item_index = item_row.index();
                var this_name = '';
                var this_id = 0;
                var this_price = 0;
                var this_qty = 0;
                var this_disc = 0;
                var this_total = 0;
                var item_exist = 0;
                var item_exist_index = -1;

                if (storage_sales_detail) {
                    $.each(storage_sales_detail, function (index, value) {
                        if (item_index == index) {

                            var discount = 0;
                            if( value.item_has_promo && item_qty >= value.item_promo_qty ){
                                if( value.item_promo_type == 'uang' ){
                                    discount = Math.floor(item_qty/value.item_promo_qty)* value.item_promo_gratis;
                                }
                            }

                            this_name = value.item_name;
                            this_id = value.item_id;
                            this_price = value.item_price;
                            this_qty = item_qty;
                            this_disc = discount;
                            this_has_promo = value.item_has_promo;
                            this_promo_type = value.item_promo_type;
                            this_promo_gratis = value.item_promo_gratis;
                            this_promo_item_name = value.item_promo_item_name;
                            this_promo_qty = value.item_promo_qty;
                            this_total = value.item_total * this_qty;
                            item_exist = 1;
                            item_exist_index = index;
                        }
                    });
                }
                var new_data = {
                    'item_name': this_name,
                    'item_id': this_id,
                    'item_price': this_price,
                    'item_qty': this_qty,
                    'item_disc': this_disc,
                    'item_total': this_total,
                    'item_has_promo': this_has_promo,
                    'item_promo_type': this_promo_type,
                    'item_promo_gratis': this_promo_gratis,
                    'item_promo_item_name': this_promo_item_name,
                    'item_promo_qty': this_promo_qty
                };
                storage_sales_detail[item_exist_index] = new_data;
                localStorage.setItem('sales_detail', JSON.stringify(storage_sales_detail));
                $.fn.refreshChart();
            }
        });

        $("body").on("click", ".btn-increase-cart", function (event) {
            var item_row = $(this).parent().parent().parent().parent();
            var item_index = item_row.index();
            var this_name = '';
            var this_id = 0;
            var this_price = 0;
            var this_qty = 0;
            var this_disc = 0;
            var this_total = 0;
            var item_exist = 0;
            var item_exist_index = -1;

            if (storage_sales_detail) {
                $.each(storage_sales_detail, function (index, value) {
                    if (item_index == index) {

                        var qty = value.item_qty + 1;
                        var discount = 0;
                        if( value.item_has_promo && qty >= value.item_promo_qty ){
                            if( value.item_promo_type == 'uang' ){
                                discount = Math.floor(qty/value.item_promo_qty)* value.item_promo_gratis;
                            }
                        }

                        this_name = value.item_name;
                        this_id = value.item_id;
                        this_price = value.item_price;
                        this_qty = value.item_qty + 1;
                        this_disc = discount;
                        this_has_promo = value.item_has_promo;
                        this_promo_type = value.item_promo_type;
                        this_promo_gratis = value.item_promo_gratis;
                        this_promo_item_name = value.item_promo_item_name;
                        this_promo_qty = value.item_promo_qty;
                        this_total = value.item_total * this_qty;
                        item_exist = 1;
                        item_exist_index = index;
                    }
                });
            }
            var new_data = {
                'item_name': this_name,
                'item_id': this_id,
                'item_price': this_price,
                'item_qty': this_qty,
                'item_disc': this_disc,
                'item_total': this_total,
                'item_has_promo': this_has_promo,
                'item_promo_type': this_promo_type,
                'item_promo_gratis': this_promo_gratis,
                'item_promo_item_name': this_promo_item_name,
                'item_promo_qty': this_promo_qty
            };
            storage_sales_detail[item_exist_index] = new_data;
            localStorage.setItem('sales_detail', JSON.stringify(storage_sales_detail));
            $.fn.refreshChart();
            event.preventDefault();
        });

        $("body").on("click", ".btn-decrease-cart", function (event) {
            var qty = $(this).parent().parent().find("input:text");
            var value = qty.val();
            value = parseInt(value);
            if (value > 1) {
                var item_row = $(this).parent().parent().parent().parent();
                var item_index = item_row.index();
                var this_name = '';
                var this_id = 0;
                var this_price = 0;
                var this_qty = 0;
                var this_disc = 0;
                var this_total = 0;
                var item_exist = 0;
                var item_exist_index = -1;
                if (storage_sales_detail) {
                    $.each(storage_sales_detail, function (index, value) {
                        if (item_index == index) {

                            var qty = value.item_qty - 1;
                            var discount = 0;
                            if( value.item_has_promo && qty >= value.item_promo_qty ){
                                if( value.item_promo_type == 'uang' ){
                                    discount = Math.floor(qty/value.item_promo_qty)* value.item_promo_gratis;
                                }
                            }

                            this_name = value.item_name;
                            this_id = value.item_id;
                            this_price = value.item_price;
                            this_qty = qty;
                            this_disc = discount;
                            this_has_promo = value.item_has_promo;
                            this_promo_type = value.item_promo_type;
                            this_promo_gratis = value.item_promo_gratis;
                            this_promo_item_name = value.item_promo_item_name;
                            this_promo_qty = value.item_promo_qty;
                            this_total = value.item_total * this_qty;
                            item_exist = 1;
                            item_exist_index = index;
                        }
                    });
                }
                var new_data = {
                    'item_name': this_name,
                    'item_id': this_id,
                    'item_price': this_price,
                    'item_qty': this_qty,
                    'item_disc': this_disc,
                    'item_total': this_total,
                    'item_has_promo': this_has_promo,
                    'item_promo_type': this_promo_type,
                    'item_promo_gratis': this_promo_gratis,
                    'item_promo_item_name': this_promo_item_name,
                    'item_promo_qty': this_promo_qty
                };
                storage_sales_detail[item_exist_index] = new_data;
                localStorage.setItem('sales_detail', JSON.stringify(storage_sales_detail));
                $.fn.refreshChart();
                event.preventDefault();
            }
        });

        $.fn.resetSales = function (e) {
            $("#input-pay").val('0');
            storage_sales_detail = [];
            localStorage.setItem('sales_detail', JSON.stringify(storage_sales_detail));
            localStorage.removeItem('sales');
            sales_discount = 0;
            $.fn.refreshChart();
        };

        $("#form-submit-sales").submit(function (e) {
            var status_cashback = false;
            if( $("#sales_type").find('option:selected').val() == 'kredit' ){
                status_cashback = true;
            }

            if( $("#sales_type").find('option:selected').val() == 'kartu_kredit' ){
                if ($("#sales-nama").val() == "" || $("#sales-nomor-kartu").val() == "" || $("#sales-nama-bank").val() == ""){
                    alert("Silakan Lengkapi Nama, Nomor Kartu, dan Nama Bank");
                    return false;
                }
            }

            if (sales_cashback >= 0 || status_cashback) {

                var option = "C_POS/simpan_transaksi/";
                var url = base_url + option;
                $.ajax({
                    type: 'post',
                    data: $(this).serialize(),
                    url: url,
                    success: function (result) {
                        var obj = JSON.parse(result);
                        console.log( obj );
                        console.log( obj );
                        window.open(base_url+'Penjualan/print/'+obj);
                        // if( obj.status ){
                        //     $('#my-modal-pay').modal('toggle');
                        //     /*window.print();*/
							          //     // window.open(base_url+'C_POS/print_struk/');
                        //     // $.fn.resetSales();
                        // } else {
                        //     console.log( 'error' );
                        // }
                        // $('#input-pay-currency').val();
                        // $('#input-pay').val();
                        $('#my-modal-pay').find('input').val(0);
                        $('#my-modal-pay').modal('hide');
                        $.fn.resetSales();
                    }
                });
            } else {
                alert("Tidak bisa melakukan proses pembayaran, Nominal pembayaran yang anda masukan kurang dari total pembayaran");
            }

        });

        $.fn.refreshChart();

        window.onbeforeunload = function() {
            localStorage.removeItem('sales_detail');
            localStorage.removeItem('sales');
            return '';
        };

        $('#my-modal-pay').on('shown.bs.modal', function() {
            $("#sales_type").focus();
        });

        $('#my-modal-disc').on('shown.bs.modal', function() {
            $("#input-discount").focus();
        });

        $('#my-modal-disc-item').on('shown.bs.modal', function() {
            $("#input-discount-item").focus();
        });

        $("#sales_type").change(function() {
            var total_sales = total_sales_detail-sales_discount;
            var box = $(".box-sales");
            var dp = $("#box-sales-dp");
            var bayar = $("#box-sales-pay");
            var nama = $("#box-sales-nama");
            var bank = $("#box-sales-nama-bank");
            var nokartu = $("#box-sales-nomor-kartu");
            var rekening = $("#box-sales-nomor-rekening");
            var cashback = $("#box-input-cashback");
            var fee = $("#box-sales-fee");

            $('#input-total-currency').val( Intl.NumberFormat().format(total_sales) );
            $('#input-total').val(total_sales);

            box.hide();

            switch ( $(this).val() ){
                case 'cash':

					           var total_fee = 0;

                        bayar.show();
                        cashback.show();
                    break;

                case 'kredit':

                        dp.show();

                    break;

                case 'transfer':
                        nama.show();
                        bank.show();
                        rekening.show();

                    break;
                case 'kartu_kredit':
                        nama.show();
                        nokartu.show();
                        bank.show();

                    break;
            }
        });


        /*TRIGGER EVENT BY KEYBOARD*/
        $(document).on('keydown', function ( e ) {
            if ((e.metaKey || e.altKey) && ( String.fromCharCode(e.which).toLowerCase() === '1') ) {
                $("#btn-sales-bayar").trigger('click');
                console.log(e.metaKey);
            }
            if ((e.metaKey || e.altKey) && ( String.fromCharCode(e.which).toLowerCase() === '2') ) {
                $("#btn-sales-diskon").trigger('click');
            }
            if ((e.metaKey || e.altKey) && ( String.fromCharCode(e.which).toLowerCase() === '3') ) {
                $("#btn-sales-opsi").trigger('click');
            }
            if ((e.metaKey || e.altKey) && ( String.fromCharCode(e.which).toLowerCase() === '4') ) {
                $('.nav-tabs a[href="#tab-B"]').trigger('click');
                $("#search").trigger('focus');
            }
            if ((e.metaKey || e.altKey) && ( String.fromCharCode(e.which).toLowerCase() === '5') ) {
                $('.nav-tabs a[href="#tab-C"]').trigger('click');
                $("#search2").trigger('focus');
            }
            if ((e.metaKey || e.altKey) && ( String.fromCharCode(e.which).toLowerCase() === '6') ) {
                $('.nav-tabs a[href="#tab-D"]').trigger('click');
                $("#search").trigger('focus');
            }
            if ((e.metaKey || e.altKey) && ( String.fromCharCode(e.which).toLowerCase() === '7') ) {
                $("#btn-sales-batal").trigger('click');
                console.log(e.metaKey);
            }

        });

        $('#btn-sales-batal').click(function(){
          // a = confirm('Apakah anda yakin keluar dari halaman ini ??');
          // if (a == true) {
            window.location.href='../Penjualan/Point-of-Sale';
          // }
        });

        $.fn.getItems();
        $.fn.getCustomers();
    });


</script>

</body></html>
