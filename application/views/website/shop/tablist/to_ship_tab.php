<!-- Order Item -->
<div class="my-order__section__order-item mb-4 p-4 border rounded order_list_ship">
    <!-- AJAX REQUEST -->
</div>

<script>
    function getToShip() {
        $.ajax({
            url: "<?= base_url('shop/my_orders/get_count_order_ship');?>",
            method: "POST",
            data: {
                status: 'Preparing',
                '_token': csrf_token_value,
            },
            dataType: "json",
            success: function(data) {
                if (data.count > 0) {
                    $('.to_ship_count').fadeIn(200);
                    $('.to_ship_count').text(data.count);
                } else {
                    $('.to_ship_count').hide();
                    $('.to_ship_count').text('');
                }
            }
        });
    }

    function getOrderShip() {
        $.ajax({
            url: "<?= base_url('shop/my_orders/get_order_ship');?>",
            method: "POST",
            data: {
                status: 'Preparing',
                '_token': csrf_token_value,
            },
            dataType: "json",
            success: function(data) {
                $('.order_list_ship').html(data.order_list_ship);
            }
        });
    }

    $(document).ready(function() {
        getToShip();
        getOrderShip();
    });
</script>