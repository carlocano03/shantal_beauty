<div class="my-order__section__order-item mb-4 p-4 border rounded order_list_cancel">
    <!-- AJAX REQUEST -->
</div>

<script>
    function getCancel() {
        $.ajax({
            url: "<?= base_url('shop/my_orders/get_count_order_cancel');?>",
            method: "POST",
            data: {
                status: 'Cancelled',
                '_token': csrf_token_value,
            },
            dataType: "json",
            success: function(data) {
                if (data.count > 0) {
                    $('.cancelled_count').fadeIn(200);
                    $('.cancelled_count').text(data.count);
                } else {
                    $('.cancelled_count').hide();
                    $('.cancelled_count').text('');
                }
            }
        });
    }

    function getOrderCancel() {
        $.ajax({
            url: "<?= base_url('shop/my_orders/get_order_cancel');?>",
            method: "POST",
            data: {
                status: 'Cancelled',
                '_token': csrf_token_value,
            },
            dataType: "json",
            success: function(data) {
                $('.order_list_cancel').html(data.order_list_cancel);
            }
        });
    }

    $(document).ready(function() {
        getCancel();
        getOrderCancel();
    });
</script>