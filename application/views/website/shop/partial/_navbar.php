<?php
    $shop_all = FALSE;
    $best_seller = FALSE;
    $sales_offer = FALSE;

    if ($active_page == 'shop_all_page') {
        $shop_all = TRUE;
    } elseif ($active_page == 'best_seller_page') {
        $best_seller = TRUE;
    } elseif ($active_page == 'sales_offer_page') {
        $sales_offer = TRUE;
    }
?>
<header>
    <div class="header__top">
        New Arrival: Explore Our Latest Product Offering!
    </div>
    <nav class="navbar">
        <div class="navbar__container container">
            <img class="navbar__logo" src="<?php echo base_url('assets/images/home/shantal-logo.png'); ?>"
                alt="Shantal Beauty">
            <ul class="navbar__items">
                <li class="navbar__item"><a href="<?= base_url('shop'); ?>"
                        class="<?= ($shop_all) ? 'nav-active--item' : '';?>">Shop
                        All</a>
                </li>
                <li class="navbar__item"><a href="<?= base_url('shop/best-sellers'); ?>"
                        class="<?= ($best_seller) ? 'nav-active--item' : '';?>">Best Sellers</a>
                </li>
                <li class="navbar__item"><a href="<?= base_url('shop/sales-offers'); ?>"
                        class="<?= ($sales_offer) ? 'nav-active--item' : '';?>">Sales &
                        Offers</a></li>
            </ul>

            <div class="d-flex gap-5 align-items-center">
                <div class="dropdown">
                    <button class="dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="fa-regular fa-user navbar__right-side--icon"></i>
                    </button>
                    <ul class="dropdown-menu custom-dropdown" aria-labelledby="dropdownMenuButton">
                        <li><a href="<?= base_url('shop/profile'); ?>" class="dropdown-item" href="register.html">View
                                profile</a></li>
                        <li><a class="dropdown-item" href="#">Logout</a></li>
                    </ul>
                </div>

                <div class="navbar__right-side--container" type="button">
                    <div class="navbar__right-side--indicator wishlist_count" style="display:none;"></div>
                    <a href="<?= base_url('shop/wishlist'); ?>" class="nav-active">
                        <i class="fa-regular fa-heart navbar__right-side--icon"></i>
                    </a>
                </div>

                <?php if($active_page != 'checkout_page') : ?>
                <div class="navbar__right-side--container open_cart" type="button">
                    <div class="navbar__right-side--indicator cart_count" style="display:none;"></div>
                    <i class="fa-solid fa-cart-shopping navbar__right-side--icon"></i>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </nav>
</header>