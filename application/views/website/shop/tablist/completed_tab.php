<div class="my-order__section__order-item mb-4 p-4 border rounded order_list_completed">
    <!-- AJAX REQUEST -->
</div>

<script>
    function getCompleted() {
        $.ajax({
            url: "<?= base_url('shop/my_orders/get_count_order_completed');?>",
            method: "POST",
            data: {
                status: 'Completed',
                '_token': csrf_token_value,
            },
            dataType: "json",
            success: function(data) {
                if (data.count > 0) {
                    $('.completed_count').fadeIn(200);
                    $('.completed_count').text(data.count);
                } else {
                    $('.completed_count').hide();
                    $('.completed_count').text('');
                }
            }
        });
    }

    function getOrderCompleted() {
        $.ajax({
            url: "<?= base_url('shop/my_orders/get_order_completed');?>",
            method: "POST",
            data: {
                status: 'Completed',
                '_token': csrf_token_value,
            },
            dataType: "json",
            success: function(data) {
                $('.order_list_completed').html(data.order_list_completed);
            }
        });
    }

    $(document).ready(function() {
        getCompleted();
        getOrderCompleted();
    });
</script>