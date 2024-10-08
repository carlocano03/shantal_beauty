<main>
    <section id="product-section">
        <div id="bottom__header">
            <div>
                <div class="container">
                    <nav aria-label="breadcrumb" class="py-4">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Shop All</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Product Details</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Product Details -->
        <div id="product-details">
            <div class="container">
                <div class="row row-cols-lg-2 row-cols-1 g-5">
                    <div class="col">
                        <!-- 
                      
                        </div> -->
                        <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff"
                            class="swiper mySwiper2">
                            <div class="swiper-wrapper">
                                <?php
                                    // First, check for video and display it first
                                    foreach($product_img as $row) :
                                        if (isset($product['with_video']) && $product['with_video'] == 1 && pathinfo($row['product_img'], PATHINFO_EXTENSION) == 'mp4') : ?>
                                <div class="swiper-slide">
                                    <div class="product-details__img-container">
                                        <video id="video_preview" class="product-details__img" autoplay muted loop>
                                            <source id="video_source"
                                                src="<?= base_url("assets/uploaded_file/uploaded_product/").$row['product_img']; ?>"
                                                type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    </div>
                                </div>
                                <?php 
                                            // Skip the video to avoid displaying it again later
                                            break; 
                                        endif;
                                    endforeach; 
                                ?>

                                <?php
                                    // Then display the main product image
                                    $img = base_url() . "assets/images/logo.png"; // Default image
                                    if (!empty($product['main_product_img']) && file_exists('./assets/uploaded_file/uploaded_product/' . $product['main_product_img'])) {
                                        $img = base_url() . "assets/uploaded_file/uploaded_product/" . $product['main_product_img'];
                                    }
                                ?>
                                <div class="swiper-slide">
                                    <div class="product-details__img-container">
                                        <img class="product-details__img" src="<?= $img; ?>" alt="Main Product Image">
                                    </div>
                                </div>

                                <?php
                                    // Now, display the rest of the images (excluding video and main product image)
                                    foreach($product_img as $row) :
                                        // Skip the video and the main product image if they are in the product_img array
                                        if (pathinfo($row['product_img'], PATHINFO_EXTENSION) == 'mp4' || $row['product_img'] == $product['main_product_img']) {
                                            continue;
                                        }
                                ?>
                                <div class="swiper-slide">
                                    <div class="product-details__img-container">
                                        <img class="product-details__img"
                                            src="<?= base_url("assets/uploaded_file/uploaded_product/") . $row['product_img']; ?>"
                                            alt="Product Image">
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>

                        <?php if(count($product_img) > 0) : ?>
                        <div thumbsSlider="" class="swiper mySwiper my-2">
                            <div class="swiper-wrapper">
                                <?php
                                    // First, check for video and display it first
                                    foreach($product_img as $row) :
                                        if (isset($product['with_video']) && $product['with_video'] == 1 && pathinfo($row['product_img'], PATHINFO_EXTENSION) == 'mp4') : ?>
                                <div class="swiper-slide">
                                    <div
                                        class="product-details__img-container--small product-details__video-small__container">
                                        <i class="bi bi-play-circle-fill product-details__video-small__play-icon"></i>
                                        <video id="video_preview" class="product-details__video--small " muted loop>
                                            <source id="video_source"
                                                src="<?= base_url("assets/uploaded_file/uploaded_product/").$row['product_img']; ?>"
                                                type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    </div>
                                </div>
                                <?php 
                                            // Skip the video to avoid displaying it again later
                                            break; 
                                        endif;
                                    endforeach; 
                                ?>

                                <?php
                                    // Then display the main product image
                                    $img = base_url() . "assets/images/logo.png"; // Default image
                                    if (!empty($product['main_product_img']) && file_exists('./assets/uploaded_file/uploaded_product/' . $product['main_product_img'])) {
                                        $img = base_url() . "assets/uploaded_file/uploaded_product/" . $product['main_product_img'];
                                    }
                                ?>
                                <div class="swiper-slide">
                                    <div class="product-details__img-container--small">
                                        <img class="product-details__img--small" src="<?= $img; ?>"
                                            alt="Main Product Image">
                                    </div>
                                </div>

                                <?php
                                    // Now, display the rest of the images (excluding video and main product image)
                                    foreach($product_img as $row) :
                                        // Skip the video and the main product image if they are in the product_img array
                                        if (pathinfo($row['product_img'], PATHINFO_EXTENSION) == 'mp4' || $row['product_img'] == $product['main_product_img']) {
                                            continue;
                                        }
                                ?>
                                <div class="swiper-slide">
                                    <div class="product-details__img-container--small">
                                        <img class="product-details__img--small"
                                            src="<?= base_url("assets/uploaded_file/uploaded_product/") . $row['product_img']; ?>"
                                            alt="Product Image">
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <?php endif;?>
                    </div>
                    <div class="col py-2">
                        <div class="d-flex align-items-center justify-content-between">
                            <h1 class="product-details__title">
                                <?= isset($product['product_name']) ? ucwords($product['product_name']) : '';?></h1>
                            <div class="product-details__badge">Best Seller</div>
                        </div>

                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-3">
                                <div class="product__item__ratings__container">
                                    <i class="bi bi-star-fill product__item__ratings__item"></i>
                                    <i class="bi bi-star-fill product__item__ratings__item"></i>
                                    <i class="bi bi-star-fill product__item__ratings__item"></i>
                                    <i class="bi bi-star-fill product__item__ratings__item"></i>
                                    <i class="bi bi-star-fill product__item__ratings__item"></i>
                                </div>
                                <div class="product__item__review">(100 reviews)</div>
                            </div>
                            <div style="font-size:12px; color:#95a5a6; font-weight:600;"><?= isset($no_sold->total_sold) ? number_format($no_sold->total_sold).' sold' : ''?></div>
                        </div>

                        <p class="product-details__p" style="text-align:justify;">
                            <?= isset($product['description']) ? nl2br(htmlspecialchars($product['description'])) : ''; ?>
                        </p>


                        <div class="d-flex align-items-center justify-content-between mt-5">
                            <div class="product-details__price">
                                <?= isset($product['selling_price']) ? '₱'.number_format($product['selling_price'],2) : '0.00';?>
                            </div>
                            <div class="product__item__quantity-selector">
                                <i class="fa-solid fa-minus product__item__quantity-selector__minus"></i>
                                <input type="text" value="1"
                                    class="product__item__quantity-selector__input input qty_input" readonly>
                                <i class="fa-solid fa-plus product__item__quantity-selector__plus" data-stocks="<?= isset($product['available_stocks']) ? $product['available_stocks'] : '0.00';?>"></i>
                            </div>
                        </div>
                        <div class="row product-details__buttons">
                            <?php if(isset($product['available_stocks']) && $product['available_stocks'] > 0) : ?>
                                <div class="col-5">
                                    <div class="product-details__add-to-cart" id="add_cart"
                                        data-id="<?= isset($product['product_id']) ? $product['product_id'] : '';?>"><i
                                            class="bi bi-bag-plus me-3"></i>Add To Cart
                                    </div>
                                </div>
                                <div class="col-5">
                                    <div class="product-details__buy" id="buy_now"
                                        data-id="<?= isset($product['product_id']) ? $product['product_id'] : '';?>">Buy Now
                                    </div>
                                </div>
                            <?php else : ?>
                                <div class="col-5">
                                    <div class="product-details__add-to-cart" id="add_wishlist"
                                        data-id="<?= isset($product['product_id']) ? $product['product_id'] : '';?>"><i class="bi bi-heart me-3"></i>Add To Wishlist
                                    </div>
                                </div>
                            <?php endif; ?>
                            
                        </div>
                    </div>

                </div>

            </div>
        </div>
        <div class="container product-review__nav-tabs">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="review-tab" data-bs-toggle="tab"
                        data-bs-target="#review-tab-pane" type="button" role="tab" aria-controls="review-tab-pane"
                        aria-selected="true">Review</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="information-tab" data-bs-toggle="tab"
                        data-bs-target="#information-tab-pane" type="button" role="tab"
                        aria-controls="information-tab-pane" aria-selected="false">Information</button>
                </li>
            </ul>
        </div>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="review-tab-pane" role="tabpanel" aria-labelledby="review-tab"
                tabindex="0">
                <!-- Product Review -->
                <div class="product-review">
                    <div class="container">
                        <h1 class="product-review__title">Reviews</h1>
                        <div class="product-review__select">
                            <select class="form-select" aria-label="">
                                <option selected>Newest</option>
                                <option value="highest_rating">Highest Rating</option>
                                <option value="lowest_rating">Lowest Rating</option>
                                <option value="oldest">Oldest</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-7">
                                <div class="product-review__rating-summary">
                                    <div class="d-flex align-items-center gap-3 mb-3">
                                        <span class="star-rating">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star-half-alt"></i>
                                        </span>
                                        <div class="product-review__rating-summary__total">4.5 out of 5 (120 Reviews)
                                        </div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-2 product-review__rating-summary__star">5 Star:</div>
                                        <div class="col-4">
                                            <div class="progress">
                                                <div class="progress-bar bg-dark" role="progressbar" style="width: 70%"
                                                    aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="col-2 percentage">70%</div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-2 product-review__rating-summary__star">4 Star:</div>
                                        <div class="col-4">
                                            <div class="progress">
                                                <div class="progress-bar bg-dark" role="progressbar" style="width: 20%"
                                                    aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="col-2 percentage">20%</div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-2 product-review__rating-summary__star">3 Star:</div>
                                        <div class="col-4">
                                            <div class="progress">
                                                <div class="progress-bar bg-dark" role="progressbar" style="width: 5%"
                                                    aria-valuenow="5" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="col-2 percentage">5%</div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-2 product-review__rating-summary__star">2 Star:</div>
                                        <div class="col-4">
                                            <div class="progress">
                                                <div class="progress-bar bg-dark" role="progressbar" style="width: 3%"
                                                    aria-valuenow="3" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="col-2 percentage">3%</div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-2 product-review__rating-summary__star">1 Star:</div>
                                        <div class="col-4">
                                            <div class="progress">
                                                <div class="progress-bar bg-dark" role="progressbar" style="width: 2%"
                                                    aria-valuenow="2" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="col-2 percentage">2%</div>
                                    </div>
                                </div>
                                <div class="product-review__items">
                                    <div class="product-review__item">
                                        <div class="d-flex align-items-center gap-3 py-4">
                                            <img class="product-review__img"
                                                src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp" />
                                            <div class="d-flex  flex-column ">
                                                <div class="d-flex align-items-center gap-2">
                                                    <h1 class="product-review__name">Ellen</h1>
                                                    <p class="product-review__date">yesterday</p>
                                                </div>
                                                <div class="product-review__stars">
                                                    <i class="bi bi-star-fill product__item__ratings__item"></i>
                                                    <i class="bi bi-star-fill product__item__ratings__item"></i>
                                                    <i class="bi bi-star-fill product__item__ratings__item"></i>
                                                    <i class="bi bi-star-fill product__item__ratings__item"></i>
                                                    <i class="bi bi-star-fill product__item__ratings__item"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="product-review__comment">
                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Et
                                            molestias, illo minima eos a
                                            placeat minus animi eveniet mollitia tenetur id pariatur alias delectus
                                            reprehenderit veniam
                                            optio recusandae aliquam consectetur?</p>
                                    </div>
                                </div>

                                <div class="product-review__items">
                                    <div class="product-review__item">
                                        <div class="d-flex align-items-center gap-3 py-4">
                                            <img class="product-review__img"
                                                src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp" />
                                            <div class="d-flex  flex-column ">
                                                <div class="d-flex align-items-center gap-2">
                                                    <h1 class="product-review__name">Ellen</h1>
                                                    <p class="product-review__date">yesterday</p>
                                                </div>
                                                <div class="product-review__stars">
                                                    <i class="bi bi-star-fill product__item__ratings__item"></i>
                                                    <i class="bi bi-star-fill product__item__ratings__item"></i>
                                                    <i class="bi bi-star-fill product__item__ratings__item"></i>
                                                    <i class="bi bi-star-fill product__item__ratings__item"></i>
                                                    <i class="bi bi-star-fill product__item__ratings__item"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="product-review__comment">
                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Et
                                            molestias, illo minima eos a
                                            placeat minus animi eveniet mollitia tenetur id pariatur alias delectus
                                            reprehenderit veniam
                                            optio recusandae aliquam consectetur?</p>
                                    </div>
                                </div>

                                <div class="product-review__items">
                                    <div class="product-review__item">
                                        <div class="d-flex align-items-center gap-3 py-4">
                                            <img class="product-review__img"
                                                src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp" />
                                            <div class="d-flex  flex-column ">
                                                <div class="d-flex align-items-center gap-2">
                                                    <h1 class="product-review__name">Ellen</h1>
                                                    <p class="product-review__date">yesterday</p>
                                                </div>
                                                <div class="product-review__stars">
                                                    <i class="bi bi-star-fill product__item__ratings__item"></i>
                                                    <i class="bi bi-star-fill product__item__ratings__item"></i>
                                                    <i class="bi bi-star-fill product__item__ratings__item"></i>
                                                    <i class="bi bi-star-fill product__item__ratings__item"></i>
                                                    <i class="bi bi-star-fill product__item__ratings__item"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="product-review__comment">
                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Et
                                            molestias, illo minima eos a
                                            placeat minus animi eveniet mollitia tenetur id pariatur alias delectus
                                            reprehenderit veniam
                                            optio recusandae aliquam consectetur?</p>
                                    </div>
                                </div>

                                <div class="product-review__items">
                                    <div class="product-review__item">
                                        <div class="d-flex align-items-center gap-3 py-4">
                                            <img class="product-review__img"
                                                src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp" />
                                            <div class="d-flex  flex-column ">
                                                <div class="d-flex align-items-center gap-2">
                                                    <h1 class="product-review__name">Ellen</h1>
                                                    <p class="product-review__date">yesterday</p>
                                                </div>
                                                <div class="product-review__stars">
                                                    <i class="bi bi-star-fill product__item__ratings__item"></i>
                                                    <i class="bi bi-star-fill product__item__ratings__item"></i>
                                                    <i class="bi bi-star-fill product__item__ratings__item"></i>
                                                    <i class="bi bi-star-fill product__item__ratings__item"></i>
                                                    <i class="bi bi-star-fill product__item__ratings__item"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="product-review__comment">
                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Et
                                            molestias, illo minima eos a
                                            placeat minus animi eveniet mollitia tenetur id pariatur alias delectus
                                            reprehenderit veniam
                                            optio recusandae aliquam consectetur?</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-5"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="information-tab-pane" role="tabpanel" aria-labelledby="information-tab"
                tabindex="0">
                <!-- Product Review -->
                <div class="product-information">
                    <div class="container">
                        <h1 class="product-information__title">Product Information</h1>

                        <div class="product-information__content">
                            <div class="d-flex align-items-center gap-2">
                                <div class="product-information__name">Product Name:</div>
                                <div class="product-information__detail"><?= isset($product['product_name']) ? ucwords($product['product_name']) : '';?></div>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <div class="product-information__name">Net Weight:</div>
                                <div class="product-information__detail"><?= isset($product['net_weight']) ? $product['net_weight'] : '';?></div>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <div class="product-information__name">Price:</div>
                                <div class="product-information__detail"><?= isset($product['selling_price']) ? '₱'.number_format($product['selling_price'],2) : '';?></div>
                            </div>
                            <div>
                                <div class="product-information__name">Descriptions:</div>
                                <div class="product-information__detail"><?= isset($product['description']) ? nl2br(htmlspecialchars($product['description'])) : ''; ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recommended for You -->
            <div class="container">
                <div class="recommended-product">
                    <h1 class="recommended-product__title">Recommended for You</h1>
                    <div class="recommended-product__items mt-5">
                        <div class="row row-cols-lg-4 row-cols-md-2 row-cols-1 gy-4 gx-4" id="recommended_product">
                            

                            <!-- AJAX REQUEST -->
                        </div>
                    </div>
                </div>
            </div>


    </section>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
    var swiperContainer1 = document.querySelector('.mySwiper');
    var swiperContainer2 = document.querySelector('.mySwiper2');
    if (swiperContainer1 && swiperContainer1.querySelectorAll('.swiper-slide').length > 0) {
        var swiper = new Swiper(".mySwiper", {
            loop: false,
            spaceBetween: 10,
            slidesPerView: 4,
            freeMode: true,
            watchSlidesProgress: true,
        });
    }

    if (swiperContainer2 && swiperContainer2.querySelectorAll('.swiper-slide').length > 0) {
        var swiper2 = new Swiper(".mySwiper2", {
            loop: true,
            spaceBetween: 10,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            thumbs: {
                swiper: swiper,
            },
        });
    }

    // var swiper = new Swiper(".mySwiper", {
    //     loop: false,
    //     spaceBetween: 10,
    //     slidesPerView: 4,
    //     freeMode: true,
    //     watchSlidesProgress: true,
    // });
    // var swiper2 = new Swiper(".mySwiper2", {
    //     loop: true,
    //     spaceBetween: 10,
    //     navigation: {
    //         nextEl: ".swiper-button-next",
    //         prevEl: ".swiper-button-prev",
    //     },
    //     thumbs: {
    //         swiper: swiper,
    //     },
    // });

    const minusButtons = document.querySelectorAll('.product__item__quantity-selector__minus');
    const plusButtons = document.querySelectorAll('.product__item__quantity-selector__plus');

    minusButtons.forEach(button => {
        button.addEventListener("click", (event) => {
            const input = event.target.closest(".product__item__quantity-selector").querySelector(
                '.product__item__quantity-selector__input');
            let quantity = parseInt(input.value);
            if (quantity > 1) {
                quantity -= 1;
                input.value = quantity;
            }
        })
    })

    plusButtons.forEach(button => {
        button.addEventListener("click", (event) => {
            const input = event.target.closest(".product__item__quantity-selector").querySelector(
                '.product__item__quantity-selector__input');
            var availableStock = event.target.dataset.stocks;
            let quantity = parseInt(input.value);

            if (quantity < parseInt(availableStock)) {
                quantity += 1;
                input.value = quantity;
            } else {
                Toast.fire({
                    icon: 'warning',
                    title: 'This product is out of stock.',
                });
            }
            

        })
    })

    const thumbnailContainers = document.querySelectorAll(".product-details__img-container--small");

    thumbnailContainers.forEach(item => {
        item.addEventListener("click", function() {
            thumbnailContainers.forEach(container => container.classList.remove("active"));
            this.classList.add("active");
        });
    });

    function getRecommendedProduct()
    {
        $.ajax({
            url: "<?= base_url('shop/products/get_recommended_product')?>",
            method: "POST",
            data: {
                product_id: "<?= $this->input->get('id', true);?>",
                '_token': csrf_token_value,
            },
            dataType: "json",
            success: function(data) {
                $('#recommended_product').html(data.recommended_product);
            }
        });
    }

    $(document).ready(function() {
        getRecommendedProduct();
        
        $(document).on('click', '.view_product', function() {
            var product_id = $(this).data('id');
            var url = "<?= base_url('shop/product-details?id=')?>" + product_id;
            window.location.href = url;
        });

        $(document).on('click', '#add_cart', function() {
            var product_id = $(this).data('id');
            var qty = $('.qty_input').val();

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

        $(document).on('click', '#buy_now', function() {
            var product_id = $(this).data('id');
            var qty = $('.qty_input').val();

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

        $(document).on('click', '#add_wishlist', function() {
            var product_id = $(this).data('id');

            $.ajax({
                url: "<?= base_url('shop/products/add_wishlist')?>",
                method: "POST",
                data: {
                    product_id: product_id,
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
                        wishlistCount();
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
</main>