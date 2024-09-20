<main>
    <section>
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
                            <li class="breadcrumb-item">Product Details</li>
                            <li class="breadcrumb-item active" aria-current="page">Check out</li>

                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Checkout  -->
        <div id="checkout">
            <div class="container">
                <div class="row row-cols-lg-2 row-cols-1 gx-5">
                    <div class="col">
                        <h1 class="checkout__product-list__title">Your Product List</h1>
                        <ul class="checkout__product-list__items">
                            <?php 
                            $subtotal = 0; 
                            foreach($cart_items as $list) : ?>
                                <?php
                                    $img = base_url()."assets/images/logo.png";
                                    if(!empty($list->main_product_img)){
                                        if(file_exists('./assets/uploaded_file/uploaded_product/'.$list->main_product_img)){
                                            $img = base_url()."assets/uploaded_file/uploaded_product/".$list->main_product_img;
                                        }
                                    }

                                    $total_amount = $list->selling_price * $list->quantity;
                                    $subtotal += $total_amount;
                                ?>
                                <li class="checkout__product-list__item">
                                    <div class="d-flex  gap-5">
                                        <img class="checkout__product-list__item__product-img"
                                            src="<?= $img;?>"
                                            alt="Product 1">
                                        <div class="w-100">
                                            <div class="d-flex align-items-center justify-content-between mb-2">
                                                <h1 class="checkout__product-list__item__product-name"><?= ucwords($list->product_name);?>
                                                </h1>
                                                <div class="checkout__product-list__item__delete-btn"><i
                                                        class="bi bi-trash"></i></div>
                                            </div>
                                            <div class="d-flex flex-column gap-2">
                                                <div class="checkout__product-list__item__sub">Available Stocks: <?= number_format($list->available_stocks);?></div>
                                                <div class="checkout__product-list__item__sub">Unit Price: <?= '₱'.number_format($list->selling_price,2)?></div>
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="checkout__product-list__item__sub">Quantity: <?= $list->quantity;?></div>
                                                    <div class="checkout__product-list__item__subtotal"><?= '₱'.number_format($total_amount,2)?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            <?php endforeach;?>
                            <div class="checkout__product-list__item__total__container">
                                <div>Sub Total</div>
                                <div><?= '₱'.number_format($subtotal,2)?></div>
                            </div>
                        </ul>
                    </div>
                    <div class="col">
                        <h1 class="checkout__detail-summary__title">Detail Summary</h1>
                        <div class="checkout__address">
                            <div class="checkout__address__header">
                                <h1 class="checkout__address__title">Shipping Address</h1>
                                <div class="checkout__address__icon"><i class="bi bi-arrow-right"></i></div>
                            </div>
                            <div>
                                <h1 class="checkout__address__name">Jake Castor</h1>
                                <p class="checkout__address__p">1234 Elm Street, Unit 4B, Sinipit, IL 62704, PH</p>
                                <p class="checkout__address__p">Landmark: Lorem ipsum dolor sit amet consectetur
                                    adipisicing elit.</p>

                            </div>
                        </div>
                        <div class="checkout__detail-summary__container">
                            <h1 class="checkout__detail-summary__title-section">Order Summary</h1>
                            <div class="d-flex flex-column gap-3 border-bottom pb-4">
                                <div class="checkout__detail-summary__item">
                                    <div class="checkout__detail-summary__item__sub">Subtotal Product</div>
                                    <div class="checkout__detail-summary__item__sub"><?= '₱'.number_format($subtotal,2)?></div>
                                </div>
                                <div class="checkout__detail-summary__item">
                                    <div>Price Delivery</div>
                                    <div>₱49</div>
                                </div>
                                <div class="checkout__detail-summary__item">
                                    <div>Referral Code</div>
                                    <input type="text">
                                </div>
                                <div class="checkout__detail-summary__item">
                                    <div>Voucher Code</div>
                                    <input type="text">
                                </div>
                            </div>

                            <div class="checkout__detail-summary__message-seller">
                                <div>Message for Seller</div>
                                <textarea id="messageForSeller" name="messageForSeller"></textarea>
                            </div>
                            <div class="checkout__detail-summary__total">
                                <div class="checkout__detail-summary__item__total">Total Amount</div>
                                <div class="checkout__detail-summary__item__total">₱479</div>
                            </div>
                        </div>
                        <div class="checkout__payment-method">
                            <h1 class="checkout__payment-method__title">Payment Method</h1>
                            <div class="d-flex flex-column gap-3">
                                <div class="form-check checkout__payment-method__check">
                                    <div class="d-flex align-items-center gap-2">
                                        <img class="checkout__payment-method__label-img"
                                            src="<?php echo base_url('assets/images/shop/debitcard.png'); ?>"
                                            alt="Product 1">
                                        <label class="form-check-label checkout__payment-method__label" for="debitCard">
                                            Debit Card
                                        </label>
                                    </div>
                                    <input class="form-check-input checkout__payment-method__input" type="radio"
                                        name="paymentMethod" id="debitCard" value="debitCard" checked>
                                </div>

                                <div class="form-check checkout__payment-method__check">
                                    <div class="d-flex align-items-center gap-2">
                                        <img class="checkout__payment-method__label-img"
                                            src="<?php echo base_url('assets/images/shop/gcash-logo.png'); ?>"
                                            alt="Product 1">
                                        <label class="form-check-label checkout__payment-method__label" for="gcash">
                                            Gcash
                                        </label>
                                    </div>
                                    <input class="form-check-input checkout__payment-method__input" type="radio"
                                        name="paymentMethod" id="gcash" value="gcash">
                                </div>

                                <div class="form-check checkout__payment-method__check">
                                    <div class="d-flex align-items-center gap-2">
                                        <img class="checkout__payment-method__label-img"
                                            src="<?php echo base_url('assets/images/shop/maya.png'); ?>"
                                            alt="Product 1">
                                        <label class="form-check-label checkout__payment-method__label" for="paymaya">
                                            Maya
                                        </label>
                                    </div>
                                    <input class="form-check-input checkout__payment-method__input" type="radio"
                                        name="paymentMethod" id="paymaya" value="paymaya">
                                </div>
                            </div>
                            <div class="w-100">
                                <button type="button" class="checkout__payment-method__btn">Check Out</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>