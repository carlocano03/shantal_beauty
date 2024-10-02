<!-- Order Item -->
<div class="my-order__section__order-item mb-4 p-4 border rounded order_list">
    <!-- AJAX REQUEST -->
</div>


<script>
    function getToShip() {
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
        getToShip();
        getOrderList();
    });
</script>