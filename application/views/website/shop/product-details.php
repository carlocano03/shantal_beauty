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
                <div class="row g-5">
                    <div class="col-6">
                        <div class="product-details__img-container">
                            <img class="product-details__img"
                                src="<?php echo base_url('assets/images/shop/product-details-1.webp'); ?>"
                                alt="Product 1">
                        </div>
                    </div>
                    <div class="col-6 py-2">
                        <div class="product-details__badge">Best Seller</div>

                        <h1 class="product-details__title">Shantal's Temptation Coffee</h1>
                        <p class="product-details__p">Shantal’s Temptation Coffee, a blend of rich aroma and smooth
                            flavor crafted with the finest
                            natural ingredients to awaken your senses . Each cup is crafted with care to deliver both
                            pleasure and wellness. This unique coffee blend is meticulously curated to not only delight
                            your taste buds but also nourish your body from within.

                            Infused with collagen, combined with the power of ascorbic acid, Shantal Temptation Coffee
                            provides a boost to your immune system while rejuvenating your skin, leaving you feeling
                            refreshed and revitalized with every sip.

                            Whether you’re starting your day with a cup of bliss or treating yourself to a moment of
                            indulgence, Shantal Temptation Coffee is your companion for embracing the pleasures of life
                            while nourishing your body with goodness. Surrender to the temptation and experience coffee

                            like never before.</p>

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
                            <div class="product-details__price">₱185.00</div>
                            <div class="product__item__quantity-selector">
                                <i class="fa-solid fa-minus product__item__quantity-selector__minus"></i>
                                <input type="text" class="product__item__quantity-selector__input">
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
</main>