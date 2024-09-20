<main>
    <section id="home">
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
                        <div class="navbar__right-side--container open_cart" type="button">
                            <div class="navbar__right-side--indicator cart_count" style="display:none;"></div>
                            <i class="fa-solid fa-cart-shopping navbar__right-side--icon"></i>
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
                            <li class="breadcrumb-item active" aria-current="page">Shop All</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="container">
                <div class="d-flex justify-content-between align-items-end  pb-2">
                    <div>
                        <h1 class="home__page-title">Shop All</h1>
                    </div>
                    <div>
                        <select id="productFilter" class="form-select" aria-label="">
                            <option value="title_asc" selected>Product A-Z</option>
                            <option value="title_desc">Product Z-A</option>
                            <option value="date_desc">Date: New to Old</option>
                            <option value="date_asc">Date: Old to New</option>
                            <option value="price_desc">Price: High to Low</option>
                            <option value="price_asc">Price: Low to High</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Products -->
        <div id="product">
            <div class="container">
                <div class="row g-3 row-cols-lg-3 row-cols-md-2 row-cols-1 mb-3" id="product_list">
                    <!-- AJAX REQUEST -->
                </div>
                <div class="pagination_link"></div>
            </div>
        </div>
    </section>

    <d class="offcanvas offcanvas-end" data-bs-backdrop="static" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header border-bottom p-5">
            <h5 id="offcanvasRightLabel" class="cart__title">Your Cart <span class="cart_count_list" style="font-size:18px;"></span></h5>
            <button type="button" class="btn-close cart__close-btn text-reset" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
        </div>
        <div class="offcanvas-body cart__container">
            <div class="form-check checkbox">
                <input class="form-check-input" type="checkbox" id="select-all-checkbox" style="margin-top:5px;">
                <label class="form-check-label" for="select-all-checkbox" style="font-size:14px; font-weight:500;">
                    Select all items in the cart
                </label>
            </div>
            <div class="cart__items p-4 py-0 cart_item_list">
                <!-- AJAX REQUEST -->
            </div>

            <div class="cart__subtotal-container p-4 py-5">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="cart__subtotal-name">Subtotal</div>
                    <div class="cart__subtotal-price">0.00</div>
                </div>
                <button type="button" class="cart__checkout">Check out <span class="checkout_count">(0)</span></button>
            </div>
        </div>
    </div>
</main>

<div class="loading-screen text-center" style="display: none;">
    <div class="spinner-border text-dark" role="status">

    </div>
</div>

<script>
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });  

    function productList(page, filter) {
        var search_query = $('.navbar__search-input').val();
        $('.loading-screen').show();
        $.ajax({
            url: "<?= base_url('shop/products/get_product_list/')?>" + page,
            method: "GET",
            data: { 
                search: search_query,
                filter: filter,
            },
            dataType: "json",
            success: function(data) {
                $('.loading-screen').hide();
                $('#product_list').html(data.product_list);
                $('.pagination_link').html(data.links);
            }
        }); 
    }

    function cartCount() {
        $.ajax({
            url: "<?= base_url('shop/products/cart_count')?>",
            method: "GET",
            dataType: "json",
            success: function(data) {
                if (data.cart_count > 0) {
                    $('.cart_count').fadeIn(200);
                    $('.cart_count').text(data.cart_count);
                    $('.cart_count_list').text('('+data.cart_count+')');
                } else {
                    $('.cart_count').hide();
                    $('.cart_count').text('');
                    $('.cart_count_list').text('');
                }
                
            }
        }); 
    }

    function getCartItem()
    {
        $.ajax({
            url: "<?= base_url('shop/products/get_cart_item_list')?>",
            method: "GET",
            dataType: "json",
            success: function(data) {
                $('.cart_item_list').html(data.cart_item_list);
            }
        }); 
    }    

    $(document).ready(function(){
        productList(0);
        cartCount();

        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            var page = $(this).attr('href').split('/').pop();
            productList(page);
        });

        $(document).on('click', '.open_cart', function() {
            getCartItem();
            var offcanvasElement = document.getElementById('offcanvasRight');
            var offcanvas = new bootstrap.Offcanvas(offcanvasElement);
            offcanvas.show();
        });

        $(document).on('keypress', '.navbar__search-input', function(e) {
            if (e.which == 13) { // If Enter key is pressed
                productList(0); // Trigger search from the first page
            }
        });

        $('.navbar__search-input').autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "<?= base_url('shop/products/search_items') ?>",
                    method: "POST",
                    dataType: "json",
                    data: { 
                        term: request.term,
                        '_token': csrf_token_value  
                    },
                    success: function(data) {
                        response(data);
                    }
                });
            },
            select: function (event, ui) {
                $('.navbar__search-input').val(ui.item.label);
                productList(0);
            },
            //minLength: 2 // Minimum characters before triggering autocomplete
        });

        $(document).on('change', '#productFilter', function() {
            var selectedFilter = $(this).val();
            productList(0, selectedFilter);
        });

        document.addEventListener("click", function(event) {
            if (event.target.classList.contains('product__item__quantity-selector__minus')) {
                const input = event.target.closest(".product__item__quantity-selector").querySelector('.product__item__quantity-selector__input');
                let quantity = parseInt(input.value);
                if (quantity > 1) {
                    quantity -= 1;
                    input.value = quantity;
                }
            }

            if (event.target.classList.contains('product__item__quantity-selector__plus')) {
                const input = event.target.closest(".product__item__quantity-selector").querySelector('.product__item__quantity-selector__input');
                let quantity = parseInt(input.value);
                quantity += 1;
                input.value = quantity;
            }
        });

        $(document).on('click', '.view_product', function() {
            var product_id = $(this).data('id');
            var url = "<?= base_url('shop/product-details?id=')?>" + product_id;
            window.location.href = url;
        });
        $(document).on('click', '#add_cart', function() {
            var product_id = $(this).data('id');
            var qty = $(this).closest('.product__item').find('.qty_input').val();


            $.ajax({
                url: "<?= base_url('shop/products/add_cart')?>",
                method: "POST",
                data: {
                    product_id: product_id,
                    qty: qty,
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
                        cartCount();
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

        //Cart List
        function updateCartQty(action, cart_id) {
            $.ajax({
                url: "<?= base_url('shop/products/update_cart_qty'); ?>",
                method: "POST",
                data: {
                    cart_id: cart_id,
                    action: action,
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

        $(document).on('click', '.cart__item__quantity-selector__plus', function() {
            var cart_id = $(this).data('cart_id');
            var $quantityInput = $(this).closest('.cart__item').find('.qty_cart');
            var currentQuantity = parseInt($quantityInput.val());
            var availableStock = $(this).data('stocks');
            var action = 'Plus';

            // Check if adding one more exceeds the available stock
            if (currentQuantity < availableStock) {
                currentQuantity++;
                // Update the input field with the new quantity
                $quantityInput.val(currentQuantity);
                updateCartQty(action, cart_id);
                calculateTotal();
            } else {
                Toast.fire({
                    icon: 'warning',
                    title: 'You cannot add more than ' + availableStock + ' items.',
                });
            }
        });

        $(document).on('click', '.cart__item__quantity-selector__minus', function() {
            var cart_id = $(this).data('cart_id');
            var $quantityInput = $(this).closest('.cart__item').find('.qty_cart');
            var currentQuantity = parseInt($quantityInput.val());
            var action = 'Minus';

            // Ensure the quantity is at least 1 before decreasing
            if (currentQuantity > 1) {
                currentQuantity--;
                
                // Update the input field with the new quantity
                $quantityInput.val(currentQuantity);
                updateCartQty(action, cart_id);
                calculateTotal();
            }
        });

        $(document).on('change', '.check_product', function() {
            calculateTotal();
        });

        $(document).on('change', '#select-all-checkbox', function() {
            var isChecked = $(this).prop('checked');

            // Iterate over each .check_product checkbox
            $('.check_product').each(function() {
                var stockStatus = $(this).data('stock'); // Get the stock status from the data attribute
                
                if (stockStatus !== 'No Stocks') {
                    // Only check/uncheck products that are not "No Stocks"
                    $(this).prop('checked', isChecked);
                }
            });

            // Update the count of checked checkboxes, excluding those with "No Stocks"
            var checkedCount = $('.check_product:checked').length;
            $('.checkout_count').text('(' + checkedCount + ')');

            calculateTotal();
        });


        $(document).on('click', '.check_product', function() {
            var checkedCheckboxes = $('.check_product:checked');
            var count = checkedCheckboxes.length;
            $('.checkout_count').text('(' + count + ')');
            //$('#check_count').val(count);

            if (count < $('.check_product').length) {
                $('#select-all-checkbox').prop('checked', false);
            }
        });

        function calculateTotal() {
            var total = 0;
            var hasValidValues = false;

            $('.check_product:checked').each(function() {
                var unitPrice = parseFloat($(this).data('price'));
                var quantity = parseInt($(this).closest('.cart__item').find('.qty_cart').val());
                
                // Check if quantity and unitPrice are valid numbers
                if (!isNaN(quantity) && !isNaN(unitPrice)) {
                    total += unitPrice * quantity;
                    hasValidValues = true; // Set the flag to true if valid values exist
                }
            });

            if (hasValidValues) {
                var formattedTotal = '₱ ' + total.toLocaleString(undefined, {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });
                $('.cart__subtotal-price').text(formattedTotal); // Display the total
                //$('#total_amount').val(total.toFixed(2));
            } else {
                // Display zero when there are no valid values
                $('.cart__subtotal-price').text('₱ 0.00');
                //$('#total_amount').val(0.00);
            }
        }

        $(document).on('click', '.cart__checkout', function() {
            var checkbox = $('.check_product:checked');
            var cart_ids  = new Array();

            if (checkbox.length > 0) {
                $(checkbox).each(function() {
                    var cart_id = $(this).closest('.cart__item').find('.check_product').data('cart_id');

                    cart_ids.push(cart_id);
                });
                var cart_ids_param = cart_ids.join(',');

                var url = "<?= base_url('shop/checkout?product=')?>" + cart_ids_param;
                window.location.href = url;
            } else {
                Toast.fire({
                    icon: 'warning',
                    title: 'You have not selected any items for checkout.',
                });
            }
        });
        //End of Cart

    });
</script>