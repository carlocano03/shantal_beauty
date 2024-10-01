<main>
    <section id="product-section">
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
                        <div>
                            <a href="<?= base_url('shop/profile');?>"><i class="fa-regular fa-user navbar__right-side--icon"></i></a>
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

                        <p class="product-details__p">
                            <?= isset($product['description']) ? nl2br(htmlspecialchars($product['description'])) : ''; ?>
                        </p>


                        <div class="d-flex align-items-center justify-content-between mt-5">
                            <div class="product-details__price">
                                ₱<?= isset($product['selling_price']) ? number_format($product['selling_price'],2) : '0.00';?>
                            </div>
                            <div class="product__item__quantity-selector">
                                <i class="fa-solid fa-minus product__item__quantity-selector__minus"></i>
                                <input type="text" value="1"
                                    class="product__item__quantity-selector__input input qty_input" readonly>
                                <i class="fa-solid fa-plus product__item__quantity-selector__plus"></i>
                            </div>
                        </div>
                        <div class="row product-details__buttons">
                            <div class="col-5">
                                <div class="product-details__add-to-cart" id="add_cart" data-id="<?= isset($product['product_id']) ? $product['product_id'] : '';?>"><i class="bi bi-bag-plus me-3"></i>Add To Cart
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="product-details__buy" id="buy_now" data-id="<?= isset($product['product_id']) ? $product['product_id'] : '';?>">Buy Now</div>
                            </div>
                            <div class="col-2 d-flex justify-content-center align-items-center">
                                <div class="product-details__heart">
                                    <i class="bi bi-heart"></i>
                                </div>
                            </div>
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
                                <div class="product-information__detail">Shantal's Temptation Coffee</div>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <div class="product-information__name">Brand:</div>
                                <div class="product-information__detail">Shantal's</div>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <div class="product-information__name">Weight:</div>
                                <div class="product-information__detail">250g</div>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <div class="product-information__name">Price:</div>
                                <div class="product-information__detail">₱500.00</div>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <div class="product-information__name">Ingredients:</div>
                                <div class="product-information__detail">Coffee beans, Collagen, Ascorbic acid (Vitamin
                                    C)</div>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <div class="product-information__name">Serving Size:</div>
                                <div class="product-information__detail">1 tablespoon (10g) per cup</div>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <div class="product-information__name">Serving per Package:</div>
                                <div class="product-information__detail">Approximately 25 servings</div>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <div class="product-information__name">Storage Instruction:</div>
                                <div class="product-information__detail">Store in a cool, dry place away from direct
                                    sunlight. Keep the resealable bag tightly closed after use.</div>
                            </div>
                            <div>
                                <div class="product-information__name">Health Benefits:</div>
                                <ul class="product-information__items">
                                    <li class="product-information__item">Boosts immune system with collagen and
                                        ascorbic acid</li>
                                    <li class="product-information__item">Supports healthy skin rejuvenation</li>
                                    <li class="product-information__item">Rich in antioxidants</li>
                                </ul>
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
                        <div class="row row-cols-lg-4 row-cols-md-2 row-cols-1 gy-4 gx-4">
                            <div class="col">
                                <div class="recommended-product__item">
                                    <div class="product__item__img-container">
                                        <img class="recommended-product__item__img"
                                            src="http://localhost/shantal_beauty/assets/uploaded_file/uploaded_product/151541767_155708.png"
                                            alt="Product 1">
                                    </div>
                                    <div class="recommended-product__content">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h1 class="recommended-product__item--name">
                                                Collastem</h1>
                                            <div class="product__item__status">
                                                Best seller
                                            </div>
                                        </div>
                                        <p class="recommended-product__item--p">Lorem ipsum dolor sit amet consectetur
                                            adipisicing elit. Quae voluptatum
                                            obcaecati quasi facilis quo maxime.</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="recommended-product__item--price">₱ 500.00</div>
                                            <div class="recommended-product__item--sold">25 sold</div>
                                        </div>
                                    </div>
                                    <div class="recommended-product__item--btn" id="add_cart">Add to cart</div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="recommended-product__item">
                                    <div class="product__item__img-container">
                                        <img class="recommended-product__item__img"
                                            src="http://localhost/shantal_beauty/assets/uploaded_file/uploaded_product/151541767_155708.png"
                                            alt="Product 1">
                                    </div>
                                    <div class="recommended-product__content">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h1 class="recommended-product__item--name">
                                                Collastem</h1>
                                            <div class="product__item__status">
                                                Best seller
                                            </div>
                                        </div>
                                        <p class="recommended-product__item--p">Lorem ipsum dolor sit amet consectetur
                                            adipisicing elit. Quae voluptatum
                                            obcaecati quasi facilis quo maxime.</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="recommended-product__item--price">₱ 500.00</div>
                                            <div class="recommended-product__item--sold">25 sold</div>

                                        </div>
                                    </div>
                                    <div class="recommended-product__item--btn" id="add_cart">Add to cart</div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="recommended-product__item">
                                    <div class="product__item__img-container">
                                        <img class="recommended-product__item__img"
                                            src="http://localhost/shantal_beauty/assets/uploaded_file/uploaded_product/151541767_155708.png"
                                            alt="Product 1">
                                    </div>
                                    <div class="recommended-product__content">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h1 class="recommended-product__item--name">
                                                Collastem</h1>
                                            <div class="product__item__status">
                                                Best seller
                                            </div>
                                        </div>
                                        <p class="recommended-product__item--p">Lorem ipsum dolor sit amet consectetur
                                            adipisicing elit. Quae voluptatum
                                            obcaecati quasi facilis quo maxime.</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="recommended-product__item--price">₱ 500.00</div>
                                            <div class="recommended-product__item--sold">25 sold</div>

                                        </div>
                                    </div>
                                    <div class="recommended-product__item--btn" id="add_cart">Add to cart</div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="recommended-product__item">
                                    <div class="product__item__img-container">
                                        <img class="recommended-product__item__img"
                                            src="http://localhost/shantal_beauty/assets/uploaded_file/uploaded_product/151541767_155708.png"
                                            alt="Product 1">
                                    </div>
                                    <div class="recommended-product__content">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h1 class="recommended-product__item--name">
                                                Collastem</h1>
                                            <div class="product__item__status">
                                                Best seller
                                            </div>
                                        </div>
                                        <p class="recommended-product__item--p">Lorem ipsum dolor sit amet consectetur
                                            adipisicing elit. Quae voluptatum
                                            obcaecati quasi facilis quo maxime.</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="recommended-product__item--price">₱ 500.00</div>
                                            <div class="recommended-product__item--sold">25 sold</div>

                                        </div>
                                    </div>
                                    <div class="recommended-product__item--btn" id="add_cart">Add to cart</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


    </section>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
        var swiper = new Swiper(".mySwiper", {
            loop: false,
            spaceBetween: 10,
            slidesPerView: 4,
            freeMode: true,
            watchSlidesProgress: true,
        });
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
                let quantity = parseInt(input.value);
                quantity += 1;
                input.value = quantity;

            })
        })

        const thumbnailContainers = document.querySelectorAll(".product-details__img-container--small");

        thumbnailContainers.forEach(item => {
            item.addEventListener("click", function() {
                thumbnailContainers.forEach(container => container.classList.remove("active"));
                this.classList.add("active");
            });
        });

        $(document).ready(function() {

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
        });

    </script>
</main>