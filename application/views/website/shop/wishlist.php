<main>
    <section id="home">
        <div id="bottom__header">
            <div>
                <div class="container d-flex align-items-center justify-content-between py-3">
                    <div>
                        <h1 class="home__page-title">Wishlist</h1>
                    </div>
                    <div class="search-container">
                        <input type="text" placeholder="Search on wishlist..." class="search-input navbar__search-input">
                        <button class="search-btn">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                    <nav aria-label="breadcrumb" class="py-4">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Wishlist</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="shop__filter-category">
            <div class="container">
                <div class="d-flex justify-content-end pb-2">
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

        <!-- Best Sellers -->
        <div id="best-sellers">
            <div class="container">
                <div class="row g-4 row-cols-lg-4 row-cols-md-2 row-cols-1 mb-3" id="wishlist">
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
    function productList(page, filter) {
        var search_query = $('.navbar__search-input').val();
        $('.loading-screen').show();
        $.ajax({
            url: "<?= base_url('shop/wishlist/get_wishlist/')?>" + page,
            method: "GET",
            data: {
                search: search_query,
                filter: filter,
            },
            dataType: "json",
            success: function(data) {
                $('.loading-screen').hide();
                $('#wishlist').html(data.wishlist);
                $('.pagination_link').html(data.links);
            }
        });
    }

    $(document).ready(function() {
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
                    url: "<?= base_url('shop/wishlist/search_items') ?>",
                    method: "POST",
                    dataType: "json",
                    data: {
                        term: request.term,
                        '_token': csrf_token_value
                    },
                    success: function(data) {
                        if (data.length === 0) {
                            response([{ label: "No product found", value: "" }]);
                        } else {
                            response(data);
                        }
                    }
                });
            },
            select: function(event, ui) {
                if (ui.item.value === "") {
                    return false;
                }
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
                const input = event.target.closest(".product__item__quantity-selector").querySelector(
                    '.product__item__quantity-selector__input');
                let quantity = parseInt(input.value);
                if (quantity > 1) {
                    quantity -= 1;
                    input.value = quantity;
                }
            }

            if (event.target.classList.contains('product__item__quantity-selector__plus')) {
                const input = event.target.closest(".product__item__quantity-selector").querySelector(
                    '.product__item__quantity-selector__input');
                var availableStock = $(event.target).data('stocks');
                let quantity = parseInt(input.value);

                if (quantity < availableStock) {
                    quantity += 1;
                    input.value = quantity;
                } else {
                    Toast.fire({
                        icon: 'warning',
                        title: 'This product is out of stock.',
                    });
                }
            }
        });

        $(document).on('click', '.view_product', function() {
            var product_id = $(this).data('id');
            var url = "<?= base_url('shop/product-details?id=')?>" + product_id;
            window.location.href = url;
        });

        $(document).on('click', '#buy_now', function() {
            var product_id = $(this).data('id');
            var qty = $(this).closest('.product__item').find('.qty_input').val();

            $.ajax({
                url: "<?= base_url('shop/products/buy_now')?>",
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
                        window.location.href = data.checkoutURL;
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