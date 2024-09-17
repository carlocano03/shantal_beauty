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
                <div class="row g-3 row-cols-lg-3 row-cols-md-2 row-cols-1">
                    <div class="col">
                        <div class="product__item">
                            <i class="bi bi-heart-fill product__item--heart product__item--heart--active	"></i>

                            <div class="product__item__img-container">
                                <img class="product__item--img"
                                    src="<?php echo base_url('assets/images/shop/product-1.webp'); ?>" alt="Product 1">
                            </div>
                            <div class="product__item--content">
                                <div class="d-flex justify-content-between align-items-center">
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

                                    <div class="product__item__status">
                                        Best seller
                                    </div>
                                </div>
                                <h1 class="product__item--name">Shantal's Temptation Cofee</h1>
                                <p class="product__item--p">Blend of Rich Aroma And Smooth...</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="product__item--price">₱ 125.00</div>
                                    <div class="product__item__quantity-selector">
                                        <i class="fa-solid fa-minus product__item__quantity-selector__minus"></i>
                                        <input type="text" disabled value="8"
                                            class="product__item__quantity-selector__input">
                                        <i class="fa-solid fa-plus product__item__quantity-selector__plus"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="product__item--btn">Add to cart</div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="product__item">
                            <i class="bi bi-heart product__item--heart"></i>
                            <div class="product__item__img-container">
                                <img class="product__item--img"
                                    src="<?php echo base_url('assets/images/shop/product-1.webp'); ?>" alt="Product 1">
                            </div>
                            <div class="product__item--content">
                                <div class="d-flex justify-content-between align-items-center">
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

                                    <div class="product__item__status">
                                        Best seller
                                    </div>
                                </div>
                                <h1 class="product__item--name">Shantal's Temptation Cofee</h1>
                                <p class="product__item--p">Blend of Rich Aroma And Smooth...</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="product__item--price">₱ 125.00</div>
                                    <div class="product__item__quantity-selector">
                                        <i class="fa-solid fa-minus product__item__quantity-selector__minus"></i>
                                        <input type="text" class="product__item__quantity-selector__input">
                                        <i class="fa-solid fa-plus product__item__quantity-selector__plus"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="product__item--btn">Add to cart</div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="product__item">
                            <i class="bi bi-heart product__item--heart"></i>
                            <div class="product__item__img-container">
                                <img class="product__item--img"
                                    src="<?php echo base_url('assets/images/shop/product-1.webp'); ?>" alt="Product 1">
                            </div>
                            <div class="product__item--content">
                                <div class="d-flex justify-content-between align-items-center">
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

                                    <div class="product__item__status">
                                        Best seller
                                    </div>
                                </div>
                                <h1 class="product__item--name">Shantal's Temptation Cofee</h1>
                                <p class="product__item--p">Blend of Rich Aroma And Smooth...</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="product__item--price">₱ 125.00</div>
                                    <div class="product__item__quantity-selector">
                                        <i class="fa-solid fa-minus product__item__quantity-selector__minus"></i>
                                        <input type="text" class="product__item__quantity-selector__input">
                                        <i class="fa-solid fa-plus product__item__quantity-selector__plus"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="product__item--btn">Add to cart</div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="product__item">
                            <i class="bi bi-heart product__item--heart"></i>
                            <div class="product__item__img-container">
                                <img class="product__item--img"
                                    src="<?php echo base_url('assets/images/shop/product-1.webp'); ?>" alt="Product 1">
                            </div>
                            <div class="product__item--content">
                                <div class="d-flex justify-content-between align-items-center">
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

                                    <div class="product__item__status">
                                        Best seller
                                    </div>
                                </div>
                                <h1 class="product__item--name">Shantal's Temptation Cofee</h1>
                                <p class="product__item--p">Blend of Rich Aroma And Smooth...</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="product__item--price">₱ 125.00</div>
                                    <div class="product__item__quantity-selector">
                                        <i class="fa-solid fa-minus product__item__quantity-selector__minus"></i>
                                        <input type="text" class="product__item__quantity-selector__input">
                                        <i class="fa-solid fa-plus product__item__quantity-selector__plus"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="product__item--btn">Add to cart</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>