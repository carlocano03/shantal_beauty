<!-- Order Item -->
<div class="my-order__section__order-item mb-4 p-4 border rounded order_list">
    <!-- AJAX REQUEST -->
</div>


<script>
    function getToPay() {
        $.ajax({
            url: "<?= base_url('shop/my_orders/get_count_order');?>",
            method: "POST",
            data: {
                status: 'Pending',
                '_token': csrf_token_value,
            },
            dataType: "json",
            success: function(data) {
                if (data.count > 0) {
                    $('.to_pay_count').fadeIn(200);
                    $('.to_pay_count').text(data.count);
                } else {
                    $('.to_pay_count').hide();
                    $('.to_pay_count').text('');
                }
            }
        });
    }

    function getOrderList() {
        $.ajax({
            url: "<?= base_url('shop/my_orders/get_order_list');?>",
            method: "POST",
            data: {
                status: 'Pending',
                '_token': csrf_token_value,
            },
            dataType: "json",
            success: function(data) {
                $('.order_list').html(data.order_list);
            }
        });
    }

    $(document).ready(function() {
        getToPay();
        getOrderList();

        $(document).on('click', '.view_product', function() {
            var product_id = $(this).data('id');
            var url = "<?= base_url('shop/product-details?id=')?>" + product_id;
            window.location.href = url;
        });

        $(document).on('click', '.cancel_order', function() {
            var order_id = $(this).data('id');

            Swal.fire({
                title: 'Are you sure..',
                text: "You want to cancel this order?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, continue',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?= base_url('shop/my_orders/cancel_order');?>",
                        method: "POST",
                        data: {
                            order_id: order_id,
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
                                getToPay();
                                getOrderList();
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
    });
</script>