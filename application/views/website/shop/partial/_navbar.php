<header>
    <div class="header__top">
        New Arrival: Explore Our Latest Product Offering!
    </div>
    <nav class="navbar">
        <div class="navbar__container container">
            <img class="navbar__logo" src="<?php echo base_url('assets/images/home/shantal-logo.png'); ?>"
                alt="Shantal Beauty">
            <ul class="navbar__items">
                <li class="navbar__item"><a href="<?= base_url('shop'); ?>" class="nav-active--item">Shop
                        All</a>
                </li>
                <li class="navbar__item"><a href="<?= base_url('shop/best-sellers'); ?>">Best Sellers</a>
                </li>
                <li class="navbar__item"><a href="<?= base_url('shop/sales-offers'); ?>">Sales &
                        Offers</a></li>
            </ul>

            <div class="d-flex gap-5 align-items-center">
                <a href="<?= base_url('shop/profile'); ?>" class="nav-active">
                    <i class="fa-regular fa-user navbar__right-side--icon"></i>
                </a>

                <a href="<?= base_url('shop/wishlist'); ?>" class="nav-active">
                    <i class="fa-regular fa-heart navbar__right-side--icon"></i>
                </a>

                <div class="navbar__right-side--container open_cart" type="button">
                    <div class="navbar__right-side--indicator cart_count" style="display:none;"></div>
                    <i class="fa-solid fa-cart-shopping navbar__right-side--icon"></i>
                </div>
            </div>
        </div>
    </nav>
</header>