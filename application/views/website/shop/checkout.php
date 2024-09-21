<main>
    <section>
        <header>
            <div class="header__top">
                New Arrival: Explore Our Latest Product Offering!
            </div>
            <nav class="navbar">
                <div class="navbar__container container">
                    <img class="navbar__logo" src="<?php echo base_url('assets/images/home/shantal-logo.png'); ?>"
                        alt="Shantal Beauty">
                    <ul class="navbar__items">
                        <li class="navbar__item"><a href="#" class="nav-active">Shop All</a></li>
                        <li class="navbar__item"><a href="#">Best Sellers</a></li>
                        <li class="navbar__item"><a href="#">Sales & Offers</a></li>
                    </ul>

                    <div class=" d-flex gap-4 align-items-center">
                        <div class="d-flex align-items-center gap-3">
                            <input type="text" class="navbar__search-input">
                            <i class="fa-solid fa-magnifying-glass navbar__right-side--icon  "></i>
                        </div>
                        <div>
                            <i class="fa-regular fa-user navbar__right-side--icon"></i>
                        </div>
                        <div>
                            <i class="fa-regular fa-heart navbar__right-side--icon"></i>
                        </div>
                    </div>
                </div>
            </nav>
        </header>


        <div id="bottom__header">
            <div>
                <div class="container">
                    <nav aria-label="breadcrumb" class="py-4">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Shop All</a></li>
                            <li class="breadcrumb-item">Product Details</li>
                            <li class="breadcrumb-item active" aria-current="page">Check out</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Checkout  -->
        <div id="checkout">
            <div class="container">
                <div class="row row-cols-lg-2 row-cols-1 gx-5">
                    <div class="col">
                        <h1 class="checkout__product-list__title">Your Product List</h1>
                        <ul class="checkout__product-list__items">
                            <?php 
                            $subtotal = 0; 
                            $no = 0;
                            foreach($cart_items as $list) : ?>
                            <?php
                                $no++;
                                $img = base_url()."assets/images/logo.png";
                                if(!empty($list->main_product_img)){
                                    if(file_exists('./assets/uploaded_file/uploaded_product/'.$list->main_product_img)){
                                        $img = base_url()."assets/uploaded_file/uploaded_product/".$list->main_product_img;
                                    }
                                }

                                $total_amount = $list->selling_price * $list->quantity;
                                $subtotal += $total_amount;
                            ?>
                            <li class="checkout__product-list__item">
                                <div class="d-flex  gap-5">
                                    <img class="checkout__product-list__item__product-img" src="<?= $img;?>"
                                        alt="Product 1">
                                    <div class="w-100">
                                        <h1 class="checkout__product-list__item__product-name mb-2">
                                            <?= ucwords($list->product_name);?>
                                        </h1>
                                        <div class="d-flex flex-column gap-2">
                                            <div class="checkout__product-list__item__sub">Available Stocks:
                                                <?= number_format($list->available_stocks);?></div>
                                            <div class="checkout__product-list__item__sub">Unit Price:
                                                <?= '₱'.number_format($list->selling_price,2)?></div>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="checkout__product-list__item__sub">Quantity:
                                                    <?= $list->quantity;?></div>
                                                <div class="checkout__product-list__item__subtotal">
                                                    <?= '₱'.number_format($total_amount,2)?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" class="cart_id" value="<?= $list->cart_id;?>">
                                <input type="hidden" class="product_id" value="<?= $list->product_id;?>">
                                <input type="hidden" class="qty_order" value="<?= $list->quantity;?>">
                            </li>
                            <?php endforeach;?>
                            <div class="checkout__product-list__item__total__container">
                                <div>Sub Total</div>
                                <div><?= '₱'.number_format($subtotal,2)?></div>
                                <input type="hidden" class="no_items" value="<?= $no;?>">
                            </div>
                        </ul>
                    </div>
                    <div class="col">
                        <h1 class="checkout__detail-summary__title">Detail Summary</h1>
                        <div class="checkout__address">
                            <div class="checkout__address__header">
                                <h1 class="checkout__address__title">Delivery Address</h1>
                                <div class="checkout__address__icon"><i class="bi bi-arrow-right"></i></div>
                            </div>
                            <div class="default_delivery_address">
                                <!-- AJAX REQUEST -->
                            </div>
                        </div>
                        <div class="checkout__detail-summary__container">
                            <h1 class="checkout__detail-summary__title-section">Order Summary</h1>
                            <div class="d-flex flex-column gap-3 border-bottom pb-4">
                                <div class="checkout__detail-summary__item">
                                    <div class="checkout__detail-summary__item__sub">Subtotal Product</div>
                                    <div class="checkout__detail-summary__item__sub sub_total_product">
                                        <?= '₱'.number_format($subtotal,2)?></div>
                                </div>
                                <div class="checkout__detail-summary__item">
                                    <div>Price Delivery</div>
                                    <div class="shipping_fee">₱49</div>
                                </div>
                                <div class="checkout__detail-summary__item">
                                    <div>Referral Code</div>
                                    <input type="text" class="referral_code">
                                </div>
                                <div class="invalid-referral"></div>
                                <div class="checkout__detail-summary__item">
                                    <div>Voucher Code</div>
                                    <input type="text" class="voucher_code">
                                </div>
                                <div class="invalid-voucher"></div>
                                <div class="checkout__detail-summary__item voucher_amt" style="display:none;">
                                    <div>Voucher Amount</div>
                                    <div class="amount_voucher">₱0.00</div>
                                </div>
                            </div>

                            <div class="checkout__detail-summary__message-seller">
                                <div>Message for Seller</div>
                                <textarea id="messageForSeller" name="messageForSeller"></textarea>
                            </div>

                            <div class="d-flex align-items-center justify-content-between">
                                <div>Sub Total</div>
                                <div class="subtotal">₱0.00</div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                                <div>Shipping Fee</div>
                                <div class="delivery_fee">-0.00</div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                                <div>Voucher</div>
                                <div class="voucherAmt">-0.00</div>
                            </div>
                            <div class="checkout__detail-summary__total">
                                <div class="checkout__detail-summary__item__total">Total Amount</div>
                                <div class="checkout__detail-summary__item__total total_amount">₱0.00</div>
                            </div>
                        </div>
                        <div class="checkout__payment-method">
                            <h1 class="checkout__payment-method__title">Payment Method</h1>
                            <div class="d-flex flex-column gap-3">
                                <div class="form-check checkout__payment-method__check">
                                    <div class="d-flex align-items-center gap-2">
                                        <img class="checkout__payment-method__label-img"
                                            src="<?php echo base_url('assets/images/shop/debitcard.png'); ?>"
                                            alt="Product 1">
                                        <label class="form-check-label checkout__payment-method__label" for="debitCard">
                                            Debit Card
                                        </label>
                                    </div>
                                    <input class="form-check-input checkout__payment-method__input" type="radio"
                                        name="paymentMethod" id="debitCard" value="Debit Card">
                                </div>

                                <div class="form-check checkout__payment-method__check">
                                    <div class="d-flex align-items-center gap-2">
                                        <img class="checkout__payment-method__label-img"
                                            src="<?php echo base_url('assets/images/shop/gcash-logo.png'); ?>"
                                            alt="Product 1">
                                        <label class="form-check-label checkout__payment-method__label" for="gcash">
                                            Gcash
                                        </label>
                                    </div>
                                    <input class="form-check-input checkout__payment-method__input" type="radio"
                                        name="paymentMethod" id="gcash" value="Gcash">
                                </div>

                                <div class="form-check checkout__payment-method__check">
                                    <div class="d-flex align-items-center gap-2">
                                        <img class="checkout__payment-method__label-img"
                                            src="<?php echo base_url('assets/images/shop/maya.png'); ?>"
                                            alt="Product 1">
                                        <label class="form-check-label checkout__payment-method__label" for="paymaya">
                                            Maya
                                        </label>
                                    </div>
                                    <input class="form-check-input checkout__payment-method__input" type="radio"
                                        name="paymentMethod" id="paymaya" value="Paymaya">
                                </div>

                                <div class="form-check checkout__payment-method__check">
                                    <div class="d-flex align-items-center gap-2">
                                        <img class="checkout__payment-method__label-img"
                                            src="<?php echo base_url('assets/images/shop/cod.png'); ?>"
                                            alt="Product 1">
                                        <label class="form-check-label checkout__payment-method__label" for="cod">
                                            Cash on Delivery
                                        </label>
                                    </div>
                                    <input class="form-check-input checkout__payment-method__input" type="radio" checked
                                        name="paymentMethod" id="cod" value="COD">
                                </div>
                            </div>
                            <div class="w-100">
                                <button type="button" class="checkout__payment-method__btn submit_checkout">Check Out</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<div class="loading-screen text-center" style="display: none;">
    <div class="spinner-border text-dark" role="status">

    </div>
</div>

<?php $this->load->view('website/shop/modal/address_modal');?>

<script>
    var set_default = 0;
    var reseller_id = '';
    var voucher_amt = 0;

    function calculateAmount() {
        var subtotal = $('.sub_total_product').text();
        var delivery_fee = $('.shipping_fee').text();
        var voucherAmt = parseFloat(voucher_amt);

        subtotal = subtotal.replace(/[₱,]/g, '');
        subtotal = parseFloat(subtotal);

        delivery_fee = delivery_fee.replace(/[₱,]/g, '');
        delivery_fee = parseFloat(delivery_fee);

        var totalAmt = subtotal + delivery_fee - voucherAmt;
        var sub_total = subtotal + delivery_fee;

        var formattedTotal = '₱' + totalAmt.toLocaleString(undefined, {
			minimumFractionDigits: 2,
			maximumFractionDigits: 2
		});

        var formattedSubTotal = '₱' + sub_total.toLocaleString(undefined, {
			minimumFractionDigits: 2,
			maximumFractionDigits: 2
		});

        var formattedFee = '-' + delivery_fee.toLocaleString(undefined, {
			minimumFractionDigits: 2,
			maximumFractionDigits: 2
		});

        var formattedVoucher = '-' + voucherAmt.toLocaleString(undefined, {
			minimumFractionDigits: 2,
			maximumFractionDigits: 2
		});

        
        $('.subtotal').text(formattedSubTotal)
        $('.delivery_fee').text(formattedFee);
        $('.voucherAmt').text(formattedVoucher);
        $('.total_amount').text(formattedTotal);
    }

    function getAddress() {
        $.ajax({
            url: "<?= base_url('shop/products/get_delivery_address')?>",
            method: "GET",
            dataType: "json",
            success: function(data) {
                $('.address_list').html(data.address_list);
            }
        });
    }

    function getDefaultAddress()
    {
        $.ajax({
            url: "<?= base_url('shop/products/get_default_address')?>",
            method: "GET",
            dataType: "json",
            success: function(data) {
                $('.default_delivery_address').html(data.default_address);
            }
        });
    }

    $(document).ready(function() {
        getDefaultAddress();
        calculateAmount();

        $(document).on('click', '.checkout__address__icon', function() {
            var offcanvasElement = document.getElementById('addressModal');
            var offcanvas = new bootstrap.Offcanvas(offcanvasElement);
            getAddress();
            offcanvas.show();
        });

        $(document).on('change', '.set_default', function() {
            if($(this).is(':checked')) {
                set_default = 1;
            } else {
                set_default = 0;
            }
        });

        $(document).on('click', '#save_address', function(event) {
            event.preventDefault();
            event.stopPropagation();

            var form = $('#addressForm')[0];
            var formData = new FormData(form);
            formData.append('fullname', $('#fullname').val());
            formData.append('contact_no', $('#contact_no').val());
            formData.append('province_name', $('#province_name').val());
            formData.append('municipality_name', $('#municipality_name').val());
            formData.append('brgy_name', $('#brgy_name').val());
            formData.append('postal_code', $('#postal_code').val());
            formData.append('street_name', $('#street_name').val());
            formData.append('landmark', $('#landmark').val());
            formData.append('label_as', $('#label_as').val());
            formData.append('set_default', set_default);
            formData.append('_token', csrf_token_value);

            form.classList.add('was-validated');
            if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
            } else {
                Swal.fire({
                    title: 'Are you sure..',
                    text: "You want to continue this transaction?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, continue',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "<?= base_url('shop/products/save_address');?>",
                            method: "POST",
                            data: formData,
                            contentType: false,
                            processData: false,
                            dataType: "json",
                            success: function(data) {
                                if (data.error != '') {
                                    Toast.fire({
                                        icon: 'warning',
                                        title: data.error,
                                    });
                                } else {
                                    Toast.fire({
                                        icon: 'success',
                                        title: data.success,
                                    });
                                    form.reset();
                                    form.classList.remove('was-validated');
                                    getAddress();
                                    getDefaultAddress();

                                    const collapseElement = document.getElementById('collapseAddress');
                                    if (collapseElement.classList.contains('show')) {
                                        const collapseInstance = bootstrap.Collapse.getInstance(collapseElement);
                                        collapseInstance.hide();
                                    }
                                }
                            },
                            error: function() {
                                Toast.fire({
                                    icon: 'error',
                                    title: 'An error occurred while processing the request.',
                                });
                            }
                        });
                    }
                });
            }
        });

        $(document).on('click', '.change_delivery_address', function() {
            var shipping_id = $(this).data('id');

            if($(this).is(':checked')) {
                $.ajax({
                    url: "<?= base_url('shop/products/change_delivery_address');?>",
                    method: "POST",
                    data: {
                        shipping_id: shipping_id,
                        '_token': csrf_token_value,
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data.error != '') {
                            Toast.fire({
                                icon: 'warning',
                                title: data.error,
                            });
                        } else {
                            Toast.fire({
                                icon: 'success',
                                title: data.success,
                            });
                            getAddress();
                            getDefaultAddress();
                        }
                    },
                    error: function() {
                        Toast.fire({
                            icon: 'error',
                            title: 'An error occurred while processing the request.',
                        });
                    }
                });
            }
        });

        $(document).on('click', '.delete_address', function() {
            var shipping_id = $(this).data('id');

            Swal.fire({
                title: 'Are you sure..',
                text: "You want to delete this address?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, continue',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?= base_url('shop/products/delete_address');?>",
                        method: "POST",
                        data: {
                            shipping_id: shipping_id,
                            '_token': csrf_token_value,
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data.error != '') {
                                Toast.fire({
                                    icon: 'warning',
                                    title: data.error,
                                });
                            } else {
                                Toast.fire({
                                    icon: 'success',
                                    title: data.success,
                                });
                                getAddress();
                            }
                        },
                        error: function() {
                            Toast.fire({
                                icon: 'error',
                                title: 'An error occurred while processing the request.',
                            });
                        }
                    });
                }
            });
        });

        $(document).on('input', '.referral_code', function() {
            var referral_code = $(this).val();
            $.ajax({
                url: "<?= base_url('shop/products/check_referral_code');?>",
                method: "POST",
                data: {
                    referral_code: referral_code,
                    '_token': csrf_token_value,
                },
                dataType: "json",
                success: function(data) {
                    if (data.error != '') {
                        $('.submit_checkout').attr('disabled', true);
                        $('.invalid-referral').text(data.error);
                        setTimeout(() => {
                            $('.invalid-referral').text('');
                        }, 5000);
                    } else {
                        $('.submit_checkout').attr('disabled', false);
                        $('.invalid-referral').text(data.success);
                        reseller_id = data.reseller_id;

                        setTimeout(() => {
                            $('.invalid-referral').text('');
                        }, 3000);
                    }
                },
                error: function() {
                    Toast.fire({
                        icon: 'error',
                        title: 'An error occurred while processing the request.',
                    });
                }
            });
        });

        $(document).on('input', '.voucher_code', function() {
            var voucher_code = $(this).val();

            $.ajax({
                url: "<?= base_url('shop/products/check_voucher_code');?>",
                method: "POST",
                data: {
                    voucher_code: voucher_code,
                    reseller_id: reseller_id,
                    '_token': csrf_token_value,
                },
                dataType: "json",
                success: function(data) {
                    if (data.error != '') {
                        $('.submit_checkout').attr('disabled', true);
                        $('.invalid-voucher').text(data.error);
                        $('.voucher_amt').hide();
                        setTimeout(() => {
                            $('.invalid-voucher').text('');
                        }, 5000);
                    } else {
                        $('.submit_checkout').attr('disabled', false);
                        $('.invalid-voucher').text(data.success);
                        $('.voucher_amt').fadeIn(200);

                        voucher_amt = data.voucher_amt;
                        var formattedAmount = '₱' + voucher_amt.toLocaleString(undefined, {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        });
                        $('.amount_voucher').text(formattedAmount);
                        calculateAmount();

                        setTimeout(() => {
                            $('.invalid-voucher').text('');
                        }, 3000);
                    }
                },
                error: function() {
                    Toast.fire({
                        icon: 'error',
                        title: 'An error occurred while processing the request.',
                    });
                }
            });
        });

        $(document).on('click', '.submit_checkout', function(event) {
            event.preventDefault();
            var cartIds = [];
            var productIds = [];
            var qtyOrder = [];

            var shipping_id = $('.shipping_id').val();
            var subtotal = $('.subtotal').text();
            var delivery_fee = $('.delivery_fee').text();
            var referral_code = $('.referral_code').val();
            var voucher_code = $('.voucher_code').val();
            var voucher_discount_amt = $('.amount_voucher').text();
            var total_amount = $('.total_amount').text();
            var payment_method = $('input[name="paymentMethod"]:checked').val();
            var no_items = $('.no_items').val();
            var messageForSeller = $('#messageForSeller').val();

            $('.checkout__product-list__items li').each(function() {
                var cart_id = $(this).find('.cart_id').val();
                var product_id = $(this).find('.product_id').val();
                var qty_order = $(this).find('.qty_order').val();
                

                cartIds.push(cart_id);
                productIds.push(product_id);
                qtyOrder.push(qty_order);
            });

            Swal.fire({
                title: 'Are you sure..',
                text: "You want to continue this transaction?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, continue',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?= base_url('shop/products/process_checkout');?>",
                        method: "POST",
                        data: {
                            cart_ids: cartIds,
                            product_ids: productIds,
                            qtyOrders: qtyOrder,
                            shipping_id: shipping_id,
                            subtotal: subtotal,
                            delivery_fee: delivery_fee,
                            referral_code: referral_code,
                            voucher_code: voucher_code,
                            voucher_discount_amt: voucher_discount_amt,
                            total_amount: total_amount,
                            payment_method: payment_method,
                            no_items: no_items,
                            messageForSeller: messageForSeller,
                            '_token': csrf_token_value,
                        },
                        dataType: "json",
                        beforeSend: function() {
                            $('.loading-screen').show();
                        },
                        success: function(data) {
                            if (data.error != '') {
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Ooops...',
                                    text: data.error,
                                });
                            } else {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Thank You!',
                                    text: data.success,
                                });
                                setTimeout(() => {
                                    window.location.href = "<?= base_url('shop')?>";
                                }, 3000);
                            }
                        },
                        complete: function() {
                            $('.loading-screen').hide();
                        },
                        error: function() {
                            $('.loading-screen').hide();
                            Swal.fire({
                                icon: 'error',
                                title: 'Ooops...',
                                text: 'An error occurred while processing the request.',
                            });
                        }
                    });
                };
            });
        });
    });
</script>