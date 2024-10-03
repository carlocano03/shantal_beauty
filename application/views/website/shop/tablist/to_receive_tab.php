<!-- Order Item -->
<div class="my-order__section__order-item mb-4 p-4 border rounded order_list_receive">
    <!-- AJAX REQUEST -->
</div>

<script>
    function getToReceive() {
        $.ajax({
            url: "<?= base_url('shop/my_orders/get_count_order_receive');?>",
            method: "POST",
            data: {
                status: 'Ship Out',
                '_token': csrf_token_value,
            },
            dataType: "json",
            success: function(data) {
                if (data.count > 0) {
                    $('.to_receive_count').fadeIn(200);
                    $('.to_receive_count').text(data.count);
                } else {
                    $('.to_receive_count').hide();
                    $('.to_receive_count').text('');
                }
            }
        });
    }

    function getOrderReceive() {
        $.ajax({
            url: "<?= base_url('shop/my_orders/get_order_receive');?>",
            method: "POST",
            data: {
                status: 'Ship Out',
                '_token': csrf_token_value,
            },
            dataType: "json",
            success: function(data) {
                $('.order_list_receive').html(data.order_list_receive);
            }
        });
    }

    $(document).ready(function() {
        getToReceive();
        getOrderReceive();
    });
</script>