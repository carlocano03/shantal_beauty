<style>
    .product-description {
        display: -webkit-box;          /* Enables the box layout for ellipsis */
        -webkit-line-clamp: 3;         /* Limits to 3 lines */
        -webkit-box-orient: vertical;  /* Specifies vertical box orientation */
        overflow: hidden;              /* Hides overflow content */
        width: 385px;
        text-align: justify;
    }

    .product-desc {
        display: -webkit-box;          /* Enables the box layout for ellipsis */
        -webkit-line-clamp: 10;         /* Limits to 3 lines */
        -webkit-box-orient: vertical;  /* Specifies vertical box orientation */
        overflow: hidden;              /* Hides overflow content */
        width: 360px;
        text-align: justify;
    }
</style>
<div class="animated-gradient product-list__top">
    Find Your Perfect Beauty Products and Shop Today
</div>
<div>
    <div class="product-list__header">
        <div class="product-list__header__title">Shantals Beauty and Wellness</div>
        <div class="search-container">
            <div class="input-group">
                <input type="text" class="search-input" placeholder="Search for products, brands, or ingredients...">
                <div class="search-icon"><i class="bi bi-search search-icon"></i></div>
            </div>
        </div>
        <div class="d-flex align-items-center gap-3">
            <div class="product-list__header__title" style="visibility:hidden;">Shantals Beauty and Wellness</div>
            <a href="https://www.facebook.com/ShantalsTemptationBS?mibextid=LQQJ4d" target="_blank" title="Facebook Page">
                <i class="bi bi-facebook facebook-icon"></i>
            </a>
            <a href="https://www.instagram.com/shantalsbeautyandwellnesscorp/?igsh=a2xpczhxb3Y0Mzhz" target="_blank" title="Instagram">
                <i class="bi bi-instagram instagram-icon"></i>
            </a>
        </div>
    </div>
</div>
<div class="product-list__header__platform">
    <div>Available on: </div>
    <a href="https://www.tiktok.com/@shantalsbeauty2022" target="_blank">
        <div class="d-flex items-center">
            <img class="product-list__header__platform__logo"
                src="<?php echo base_url('assets/images/home/tiktok-logo.webp'); ?>" alt="Shantal Beauty">
            <div class="align-self-center">Tiktok</div>
        </div>
    </a>
    <a href="https://www.lazada.com.ph/shop/s1fqxcpx" target="_blank">
        <div class="d-flex items-center">
            <img class="product-list__header__platform__logo"
                src="<?php echo base_url('assets/images/home/lazada-logo.webp'); ?>" alt="Shantal Beauty">
            <div class="align-self-center">Lazada</div>
        </div>
    </a>
    <a href="https://shopee.ph/shop/1214283852" target="_blank">
        <div class="d-flex items-center">
            <img class="product-list__header__platform__logo"
                src="<?php echo base_url('assets/images/home/shopee-logo.webp'); ?>" alt="Shantal Beauty">
            <div class="align-self-center">Shopee</div>
        </div>
    </a>
</div>

<div class="container-xxl py-5">
    <div class="row row-cols-md-2 row-cols-lg-3 gy-5" id="product_list">

        <!-- <div class="col">
            <div class="product-card">
                <div class="product-image-container">
                    <img class="product-image" src="<?php echo base_url('assets/images/home/product-1.webp'); ?>"
                        alt="Shantal Beauty">
                    <span class="product-tag">New</span>
                </div>
                <div class="product-info">
                    <div class="product-category">Temptation Juice</div>
                    <h3 class="product-name">Shantal's Temptation Coffee</h3>
                    <p class="product-description">Shantal’s Temptation Coffee, a blend of rich aroma
                        and
                        smooth
                        flavor crafted with the finest
                        natural ingredients to awaken your senses.</p>
                    <div class="product-meta">
                        <div class="product-price">₱5,000</div>
                    </div>
                    <div class="button-group">
                        <button class="buy-now" data-bs-toggle="modal" data-bs-target="#buy-now">Buy Now</button>
                        <button class="view-details" data-bs-toggle="modal" data-bs-target="#productModal">
                            View
                        </button>
                    </div>
                </div>
            </div>
        </div> -->
    
    </div>
    <div class="pagination_link mt-3"></div>
</div>

<div class="modal fade " id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-3" id="productModalLabel"></h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row" id="product-details">
                    <!-- <div class="col-md-6">
                        <img class="modal-product-image"
                            src="<?php echo base_url('assets/images/home/product-1.webp'); ?>" alt="Shantal Beauty">
                    </div>
                    <div class="col-md-6">
                        <div class="modal-product-details">
                            <h2 class="modal-product-name">Shantal’s Temptation Coffee</h2>
                            <div class="modal-product-price mb-3">₱5,000</div>
                            <div class="modal-product-description">
                                <h4>Description</h4>
                                <p> Shantal’s Temptation Coffee, a blend of rich aroma
                                    and
                                    smooth
                                    flavor crafted with the finest
                                    natural ingredients to awaken your senses . Each cup is crafted with care to
                                    deliver
                                    both
                                    pleasure and wellness. This unique coffee blend is meticulously curated to not
                                    only
                                    delight
                                    your taste buds but also nourish your body from within.
                                </p>
                                <h4>Key Benefits</h4>
                                <ul>
                                    <li>Lorem ipsum dolor sit amet.</li>
                                    <li>Improves skin elasticity</li>
                                    <li>Reduces fine lines and wrinkles</li>
                                    <li>Suitable for all skin types</li>
                                </ul>
                            </div>
                            <button class="buy-now mt-5 mb-3" data-bs-toggle="modal" data-bs-target="#buy-now">Buy
                                Now</button>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>

<div class="loading-screen text-center" style="display: none;">
    <div class="spinner-border text-dark" role="status">

    </div>
</div>


<!-- Platform -->

<div class="modal fade" id="buy-now" data-bs-backdrop="static" tabindex="-1" aria-labelledby="buy-now"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content platform-modal-content">
            <h1 class="platform__greeting">Ready to Shop?</h1>
            <h1 class="platform__title">Choose Your Shopping Platform</h1>
            <p class="platform__p">Select your preferred shopping platform to continue with your purchase.</p>

            <div class="error-message"></div>
            <div class="platform-options mt-4">
                <!-- TikTok -->
                <div class="platform-option">
                    <input type="radio" class="btn-check" name="platform" id="tiktok" autocomplete="off" required>
                    <label class="platform__button" for="tiktok">
                        <img class="platform__logo" src="<?php echo base_url('assets/images/home/tiktok-logo.webp'); ?>"
                            alt="Shantal Beauty">
                        <span class="platform__name">TikTok Shop</span>
                        <span class="platform__desc">Start shopping</span>
                    </label>
                </div>

                <!-- Shopee -->
                <div class="platform-option">
                    <input type="radio" class="btn-check" name="platform" id="shopee" autocomplete="off">
                    <label class="platform__button" for="shopee">
                        <img class="platform__logo" src="<?php echo base_url('assets/images/home/shopee-logo.webp'); ?>"
                            alt="Shantal Beauty">
                        <span class="platform__name">Shopee</span>
                        <span class="platform__desc">Start shopping</span>
                    </label>
                </div>

                <!-- Lazada -->
                <div class="platform-option">
                    <input type="radio" class="btn-check" name="platform" id="lazada" autocomplete="off">
                    <label class="platform__button" for="lazada">
                        <img class="platform__logo" src="<?php echo base_url('assets/images/home/lazada-logo.webp'); ?>"
                            alt="Shantal Beauty">
                        <span class="platform__name">Lazada</span>
                        <span class="platform__desc">Start shopping</span>
                    </label>
                </div>

                <div class="col-12 mt-4">
                    <button type="button" class="continue__button" disabled>Continue to Shop</button>
                </div>

                <hr>
                <div class="col-12">
                    <p class="platform__return">
                        Changed your mind? <span type="button" class="return__link" data-bs-dismiss="modal">Go
                            back</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const platformInputs = document.querySelectorAll('input[name="platform"]');
        const continueButton = document.querySelector('.continue__button');

        platformInputs.forEach(input => {
            input.addEventListener('change', function() {
                continueButton.disabled = false;
            });
        });

        continueButton.addEventListener('click', function() {
            const selectedPlatform = document.querySelector('input[name="platform"]:checked').id;
            switch (selectedPlatform) {
                case 'tiktok':
                    window.open("https://www.tiktok.com/@shantalsbeauty2022");
                    break;
                case 'shopee':
                    window.open("https://shopee.ph/shop/1214283852");
                    break;
                case 'lazada':
                    window.open("https://www.lazada.com.ph/shop/s1fqxcpx/");
                    break;
            }

            $('#buy-now').modal('hide');
        });
    });

    function productList(page) {
        var search_query = $('.search-input').val();
        $('.loading-screen').show();
        $.ajax({
            url: "<?= base_url('website/products/get_product_list/')?>" + page,
            method: "GET",
            data: {
                search: search_query,
            },
            dataType: "json",
            success: function(data) {
                $('.loading-screen').hide();
                $('#product_list').html(data.product_list);
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

        $(document).on('keypress', '.search-input', function(e) {
            if (e.which == 13) { // If Enter key is pressed
                productList(0); // Trigger search from the first page
            }
        });

        $('.search-input').autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "<?= base_url('website/products/search_items') ?>",
                    method: "POST",
                    dataType: "json",
                    data: {
                        term: request.term,
                        '_token': csrf_token_value
                    },
                    success: function(data) {
                        if (data.length === 0) {
                            response([{
                                label: "No product found",
                                value: ""
                            }]);
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
                $('.search-input').val(ui.item.label);
                productList(0);
            },
            //minLength: 2 // Minimum characters before triggering autocomplete
        });

        $(document).on('click', '.view-details', function() {
            var product_id = $(this).data('id');

            $.ajax({
                url: "<?= base_url('website/products/product_details')?>",
                method: "POST",
                data: {
                    product_id: product_id,
                    '_token': csrf_token_value
                },
                dataType: "json",
                success: function(data) {
                    $('#product-details').html(data.product_details);
                    $('#productModalLabel').text(data.product);
                    $('#productModal').modal('show');
                }
            });
        });
    });
</script>