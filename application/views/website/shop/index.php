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

    $(document).ready(function(){
        productList(0);
        

        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            var page = $(this).attr('href').split('/').pop();
            productList(page);
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
    });
</script>