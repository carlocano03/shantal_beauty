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
                        <div class="navbar__right-side--container">
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
                                                    <video id="video_preview" class="product-details__img" controls autoplay muted loop>
                                                        <source id="video_source" src="<?= base_url("assets/uploaded_file/uploaded_product/").$row['product_img']; ?>" type="video/mp4">
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
                                            <img class="product-details__img" src="<?= base_url("assets/uploaded_file/uploaded_product/") . $row['product_img']; ?>" alt="Product Image">
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>

                        <?php if(count($product_img) > 0) : ?>
                        <div thumbsSlider="" class="swiper mySwiper">
                            <div class="swiper-wrapper">
                                <?php
                                    // First, check for video and display it first
                                    foreach($product_img as $row) :
                                        if (isset($product['with_video']) && $product['with_video'] == 1 && pathinfo($row['product_img'], PATHINFO_EXTENSION) == 'mp4') : ?>
                                            <div class="swiper-slide">
                                                <div class="product-details__img-container--small">
                                                    <video id="video_preview" class="product-details__img--small" controls autoplay muted loop>
                                                        <source id="video_source" src="<?= base_url("assets/uploaded_file/uploaded_product/").$row['product_img']; ?>" type="video/mp4">
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
                                        <img class="product-details__img--small" src="<?= $img; ?>" alt="Main Product Image">
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
                                            <img class="product-details__img--small" src="<?= base_url("assets/uploaded_file/uploaded_product/") . $row['product_img']; ?>" alt="Product Image">
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <?php endif;?>
                    </div>
                    <div class="col py-2">
                        <div class="product-details__badge">Best Seller</div>

                        <h1 class="product-details__title"><?= isset($product['product_name']) ? ucwords($product['product_name']) : '';?></h1>
                        <p class="product-details__p" style="text-align:justify;">
                            <?= isset($product['description']) ? nl2br(htmlspecialchars($product['description'])) : ''; ?>
                        </p>

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
                        <div class="d-flex align-items-center justify-content-between mt-4">
                            <div class="product-details__price">₱<?= isset($product['selling_price']) ? number_format($product['selling_price'],2) : '0.00';?></div>
                            <div class="product__item__quantity-selector">
                                <i class="fa-solid fa-minus product__item__quantity-selector__minus"></i>
                                    <input type="text" value="1" class="product__item__quantity-selector__input input qty_input" readonly>
                                <i class="fa-solid fa-plus product__item__quantity-selector__plus"></i>
                            </div>
                        </div>
                        <div class="row product-details__buttons">
                            <div class="col-5">
                                <div class="product-details__add-to-cart"><i class="bi bi-bag-plus me-3"></i>Add To Cart
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="product-details__buy">Buy Now</div>
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
        <!-- Product Review -->
        <div class="container">
            <div class="product-review">
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
                const input = event.target.closest(".product__item__quantity-selector").querySelector('.product__item__quantity-selector__input');
                let quantity = parseInt(input.value);
                if (quantity > 1) {
                    quantity -= 1;
                    input.value = quantity;
                }
            })
        })

        plusButtons.forEach(button => {
            button.addEventListener("click", (event) => {
                const input = event.target.closest(".product__item__quantity-selector").querySelector('.product__item__quantity-selector__input');
                let quantity = parseInt(input.value);
                quantity += 1;
                input.value = quantity;

            })
        })

        $(document).ready(function() {

        });
    </script>
</main>