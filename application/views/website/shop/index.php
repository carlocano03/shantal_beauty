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
                        <div class="navbar__right-side--container" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                            <div class="navbar__right-side--indicator">0</div>
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
                        <div class="d-flex justify-content-between">
                            <h1>9 Products</h1>
                            <p>1/8</p>
                        </div>
                        <select class="form-select" aria-label="">
                            <option selected>Title A-Z</option>
                            <option value="1">Title Z-A</option>
                            <option value="2">Date: New to Old</option>
                            <option value="3">Data: Old to New</option>
                            <option value="4">Price: High to Low</option>
                            <option value="5">Price: Low to High</option>
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

    <d class="offcanvas offcanvas-end " tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header border-bottom p-5">
            <h5 id="offcanvasRightLabel" class="cart__title">Your Cart</h5>
            <button type="button" class="btn-close cart__close-btn text-reset" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
        </div>
        <div class="offcanvas-body cart__container">
            <div class="cart__items p-4 py-0">
                <div class="cart__item">
                    <img class="cart__product-img"
                        src="<?php echo base_url('assets/images/shop/product-cart-1.webp'); ?>" alt="Product 1">
                    <div class="d-flex flex-column justify-content-between">
                        <div>
                            <h1 class="cart__product-name">Shantal's Temptation Cofee</h1>
                            <p class="cart__product-p">product category</p>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="cart__item__quantity-selector">
                                <i class="fa-solid fa-minus cart__item__quantity-selector__minus"></i>
                                <input readonly value="1" type="text" class="cart__item__quantity-selector__input">
                                <i class="fa-solid fa-plus cart__item__quantity-selector__plus"></i>
                            </div>
                            <div class="cart__product-price" data-price="125.00">₱125.00</div>
                        </div>
                    </div>
                </div>
                <div class="cart__item">
                    <img class="cart__product-img"
                        src="<?php echo base_url('assets/images/shop/product-cart-1.webp'); ?>" alt="Product 1">
                    <div class="d-flex flex-column justify-content-between">
                        <div>
                            <h1 class="cart__product-name">Shantal's Temptation Cofee</h1>
                            <p class="cart__product-p">product category</p>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="cart__item__quantity-selector">
                                <i class="fa-solid fa-minus cart__item__quantity-selector__minus"></i>
                                <input readonly value="1" type="text" class="cart__item__quantity-selector__input">
                                <i class="fa-solid fa-plus cart__item__quantity-selector__plus"></i>
                            </div>
                            <div class="cart__product-price" data-price="125.00">₱125.00</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="cart__subtotal-container p-4 py-5">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="cart__subtotal-name">Subtotal</div>
                    <div class="cart__subtotal-price">₱125.00</div>
                </div>
                <button type="button" class="cart__checkout">Check out</button>
            </div>
        </div>
    </d iv>
</main>

<script>
    function productList(page) {
        $.ajax({
            url: "<?= base_url('shop/products/get_product_list/')?>" + page,
            method: "GET",
            dataType: "json",
            success: function(data) {
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

            console.log(product_id)
            console.log(qty)
        });

    });
</script>