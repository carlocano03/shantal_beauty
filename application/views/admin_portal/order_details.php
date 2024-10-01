<style>
    .table__title {
        font-size: 20px;
        font-weight: 500;
        color: #434875 !important;
        padding: 8px 0;
        margin-bottom: 0;
    }

    .card {
        background: #ffffff;
        border-radius: 8px;
        color: #434875;
        box-shadow: 0 9px 20px rgba(46, 35, 94, .07);
    }

    .checkout__product-list__items {
        margin-top: 32px;
        padding: 0;
    }
    .checkout__product-list__item {
        list-style: none;
        border-radius: 8px;
        background-color: #ffffff;
        padding: 24px;
        margin-bottom: 20px;
        box-shadow: rgba(149, 157, 165, 0.1) 0px 8px 24px;
    }

    .checkout__product-list__item__product-img {
        width: 72px;
        object-fit: contain;
        height: auto;
    }
    .checkout__product-list__item__product-name {
        font-size: 1.5rem;
        margin: 0;
        color: var(--primary-black);
    }

    .checkout__product-list__item__sub {
        color: var(--accent-2);
        font-size: 12px;
        margin: 0;
    }
    .checkout__product-list__item__subtotal {
        font-size: 16px;
        margin: 0;
    }

    .checkout__product-list__item__total__container {
        background: #ffffff;
        padding: 12px 28px;
        display: flex;
        align-items: center;
        font-size: 18px;
        justify-content: space-between;
        width: 100%;
        font-weight: 600;
        border-radius: 8px;
        box-shadow: rgba(149, 157, 165, 0.1) 0px 8px 24px;
    }

    .product_amount {
        background: #ffffff;
        padding: 12px 28px;
        font-size: 18px;
        width: 100%;
        font-weight: 600;
        border-radius: 8px;
        box-shadow: rgba(149, 157, 165, 0.1) 0px 8px 24px;
    }

    .batch_no {
        width: 200px;
        height: 35px;
        border-radius: 5px;
        border: 1.5px solid #b2bec3;
        color: #2d3436;
        font-size: 14px;
        outline: none !important;
        padding-left: 6px;
    }

    .address_list__container{
        margin-top: 32px;
        padding:10px 16px 14px 10px;
        background-color:var(--secondary-white);
        border-radius:8px;
        box-shadow: rgba(149, 157, 165, 0.1) 0px 8px 24px;
    }

    .referral__container {
        /* margin-top: 32px; */
        padding:10px 16px 14px 10px;
        background-color:var(--secondary-white);
        border-radius:8px;
        box-shadow: rgba(149, 157, 165, 0.1) 0px 8px 24px;
    }

</style>
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header pb-3 d-flex align-items-center justify-content-between gap-2">
                <div class="d-flex aling-items-center justify-content-between">
                    <img src="<?php echo base_url('assets/images/home/order-details.png'); ?>" width="36px"
                        alt="Calendar" />
                    <h5 class="table__title"><?= $card_title?> [<?= isset($orders['order_no']) ? $orders['order_no'] : '';?>]</h5>
                </div>
                <?php if(isset($orders['order_status']) && $orders['order_status'] == 'Pending') : ?>
                    <div class="me-3">
                        <button class="btn btn-success" id="prepare_order"><i class="bi bi-box-seam me-2"></i>Prepare Order</button>
                        <button class="btn btn-outline-danger" id="cancel_order"><i class="bi bi-x-lg me-2"></i>Cancel Order</button>
                    </div>
                <?php else : ?>
                    <?php
                        $order_status = isset($orders['order_status']) ? $orders['order_status'] : '';
                        $stageColors = array(
                            'Preparing' => 'bg-warning',
                            'Completed' => 'bg-success',
                            'Cancelled' => 'bg-danger',
                        );    
                        $color = array_key_exists($order_status, $stageColors) ? $stageColors[$order_status] : 'bg-secondary';
                    ?>
                    <div class="me-3">
                        Order Status: <span class="badge <?= $color;?> px-3"><?= isset($orders['order_status']) ? $orders['order_status'] : '';?></span>
                    </div>
                <?php endif;?>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-7">
                        <ul class="checkout__product-list__items">
                            <?php 
                            $subtotal = 0;
                            $product_ids_array = [];
                            foreach($order_details as $list) : ?>
                            <?php
                                $img = base_url()."assets/images/logo.png";
                                if(!empty($list->main_product_img)){
                                    if(file_exists('./assets/uploaded_file/uploaded_product/'.$list->main_product_img)){
                                        $img = base_url()."assets/uploaded_file/uploaded_product/".$list->main_product_img;
                                    }
                                }

                                $total_amount = $list->selling_price * $list->quantity_order;
                                $subtotal += $total_amount;

                                // Split batch data
                                $batch_numbers = explode(',', $list->batch_lot_numbers);
                                $batch_stocks = explode(',', $list->batch_stocks);
                                $stock_ids = explode(',', $list->stock_ids);

                                // Accumulate product_id in the array
                                $product_ids_array[] = $list->product_id; 
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
                                            
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="checkout__product-list__item__sub">Unit Price:
                                                    <?= '₱'.number_format($list->selling_price,2)?></div>
                                                
                                                <?php if(isset($orders['order_status']) && $orders['order_status'] == 'Pending') : ?>
                                                <!-- Batch Number Select Options -->
                                                <select name="batch_no_<?= $list->product_id; ?>" id="batch_no_<?= $list->product_id; ?>" class="batch_no">
                                                    <option value="">Select Batch</option>
                                                    <?php foreach($batch_numbers as $index => $batch_number): ?>
                                                        <option value="<?= $stock_ids[$index]; ?>">
                                                            Batch: <?= $batch_number; ?> - Stocks: <?= $batch_stocks[$index]; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <?php endif;?>
                                                
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="checkout__product-list__item__sub">Quantity:
                                                    <?= $list->quantity_order;?></div>
                                                <div class="checkout__product-list__item__subtotal">
                                                    <?= '₱'.number_format($total_amount,2)?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="qty_order_<?= $list->product_id; ?>" value="<?= $list->quantity_order;?>">
                            </li>
                            <?php endforeach;?>

                            <div class="checkout__product-list__item__total__container">
                                <div>Sub Total</div>
                                <div><?= '₱'.number_format($subtotal,2)?></div>
                            </div>
                            <hr>
                            <div class="product_amount">
                                <div class="d-flex align-items-center justify-content-between" style="font-size:13px; color: #7f8fa6;">
                                    <div>Shipping Fee</div>
                                    <div><?= isset($orders['shipping_fee']) ? '-'.$orders['shipping_fee'] : '0.00'?></div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between" style="font-size:13px; color: #7f8fa6;">
                                    <div>Voucher Discount</div>
                                    <div><?= isset($orders['discount_voucher_amt']) ? '-'.number_format($orders['discount_voucher_amt'],2) : '0.00'?></div>
                                </div>
                                <hr>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>Total Amount</div>
                                    <div><?= isset($orders['total_amount']) ? '₱'.number_format($orders['total_amount'],2) : '0.00'?></div>
                                </div>
                            </div>
                        </ul>
                    </div>
                    <div class="col-md-5">
                        <div class="address_list d-flex flex-column gap-3 mb-3">
                            <!-- AJAX REQUEST -->
                        </div>

                        <div class="mb-3">
                            <div class="referral__container">
                                <div class="ms-2 pt-2 fw-bold"><i class="bi bi-view-list me-2"></i>Other Details of Order</div>
                                <hr class="mt-1 mb-2">
                                <div class="d-flex align-items-center justify-content-between mb-1" style="margin-left:25px; font-size:13px;">
                                    <div class="fw-bold">Order Date:</div>
                                    <div><?= isset($orders['date_created']) ? date('D M j, Y h:i A', strtotime($orders['date_created'])) : ''?></div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mb-1" style="margin-left:25px; font-size:13px;">
                                    <div class="fw-bold">Use Voucher Code:</div>
                                    <div><?= isset($orders['voucher_code']) ? $orders['voucher_code'] : ''?></div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mb-1" style="margin-left:25px; font-size:13px;">
                                    <div class="fw-bold">Payment Method:</div>
                                    <div><?= isset($orders['payment_type']) ? $orders['payment_type'] : ''?></div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between" style="margin-left:25px; font-size:13px;">
                                    <div class="fw-bold">Message from Customer:</div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between" style="margin-left:25px; font-size:13px;">
                                    <div><?= isset($orders['message_to_seller']) ? $orders['message_to_seller'] : ''?></div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <?php if($referred_by->num_rows() > 0) : ?>
                                <?php
                                    $row = $referred_by->row();
                                    $mobileNumber = $row->phone_number;
                                    // Remove leading zero and replace it with +63
                                    if (substr($mobileNumber, 0, 1) == '0') {
                                        $mobileNumber = '+63' . substr($mobileNumber, 1);
                                    }
                                
                                    // Format the number with spaces
                                    $formattedNumber = preg_replace('/(\+63)(\d{3})(\d{3})(\d{4})/', '($1) $2 $3 $4', $mobileNumber);

                                    $fullname = ucwords($row->first_name).' '.ucwords($row->last_name);

                                    $no_items = isset($orders['no_items']) ? $orders['no_items'] : 0;
                                    $total_amount = isset($orders['sub_total']) ? $orders['sub_total'] : 0;
                                    $shipping_fee = isset($orders['shipping_fee']) ? $orders['shipping_fee'] : 0;
                                    if ($no_items > 1 && $no_items != 0)  {
                                        // 0.25
                                        $commission = ($total_amount - $shipping_fee) * 0.25;
                                    } else {
                                        $commission = ($total_amount - $shipping_fee) * 0.25;
                                    }
                                ?>
                                <div class="referral__container">
                                    <div class="ms-2 pt-2 fw-bold"><i class="bi bi-person-lines-fill me-2"></i>Referral Information</div>
                                    <hr class="mt-1 mb-1">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="form-check checkbox d-flex align-items-center">
                                            <label class="form-check-label" style="font-size:14px; font-weight:500; margin-top:4px;">
                                                <span class="fw-bold"><?= $fullname;?></span> | <?= $formattedNumber;?>
                                            </label>
                                        </div>
                                                    
                                    </div>
                                    <div style="margin-left:25px; font-size:13px; color:#636e72;">
                                        <div>Referral Code: <?= $row->referral_code;?></div>
                                        <div>Date Joined: <?= date('D M j, Y', strtotime($row->date_created));?></div>
                                        <div>Estimated Commission: <?= '₱'.number_format($commission,2);?></div>
                                    </div>
                                </div>
                            <?php else : ?>
                                <div class="alert alert-danger"><i class="bi bi-info-circle-fill me-2"></i>No referral information found.</div>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="loading-screen text-center" style="display: none;">
    <div class="spinner-border text-dark" role="status">

    </div>
</div>

<script>
    var order_id = "<?= isset($orders['order_id']) ? $orders['order_id'] : 0;?>";
    var referral_code = "<?= isset($orders['referral_code']) ? $orders['referral_code'] : '';?>";
    var subtotal = "<?= $subtotal;?>";
    function getAddress() {
        $.ajax({
            url: "<?= base_url('admin_portal/online_orders/get_delivery_address')?>",
            method: "GET",
            data: {
                shipping_id: "<?= isset($orders['shipping_id']) ? $orders['shipping_id'] : '';?>"
            },
            dataType: "json",
            success: function(data) {
                $('.address_list').html(data.address_list);
            }
        });
    }

    $(document).ready(function() {
        getAddress();

        $(document).on('click', '#prepare_order', function(e) {
            e.preventDefault();
            var orderData = [];
            var isValid = true; 

            // Loop through each product
            $('.checkout__product-list__item').each(function() {
                var productId = $(this).find('.batch_no').attr('id').split('_')[2]; // Extract product_id
                var batchNo = $('#batch_no_' + productId).val(); // Get the selected batch_no
                var qtyOrder = $('#qty_order_' + productId).val(); // Get the quantity_order

                var $selectElement = $('#batch_no_' + productId);
                $selectElement.css('border', '');

                if (!batchNo) {
                    isValid = false;
                    // Change border to red if batch number is not selected
                    $selectElement.css('border', '2px solid red');
                } else {
                    // Reset the border if batch number is selected
                    $selectElement.css('border', '2px solid green');
                }

                // If batch number is selected, add to orderData
                if (qtyOrder) {
                    orderData.push({
                        product_id: productId,
                        batch_no: batchNo,
                        quantity_order: qtyOrder
                    });
                }
            });

            
            if(isValid && orderData.length > 0) {
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
                            url: "<?= base_url('admin_portal/online_orders/prepare_order')?>",
                            method: "POST",
                            data: {
                                order_data: orderData ,
                                order_id: order_id,
                                referral_code: referral_code,
                                subtotal: subtotal,
                                '_token': csrf_token_value,
                            },
                            dataType: "json",
                            beforeSend: function () {
                                $('.loading-screen').show();
                            },
                            success: function(data) {
                                if (data.error != '') {
                                    Swal.fire({
                                        icon: 'warning',
                                        title: 'Oops...',
                                        text: data.error,
                                    }); 
                                    $('.loading-screen').hide();
                                } else {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Thank you!',
                                        text: data.success,
                                    });
                                    setTimeout(() => {
                                        window.location.href = "<?= base_url('admin/pending-orders')?>";
                                    }, 3000);
                                }
                            },
                            complete: function () {
                                $('.loading-screen').hide();
                            },
                            error: function () {
                                $('.loading-screen').hide();
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Ooops...',
                                    text: 'An error occurred while processing the request.',
                                });
                            }
                        });
                    }
                });
            }
        });
    });
</script>