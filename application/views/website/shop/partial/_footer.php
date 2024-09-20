    <div class="offcanvas offcanvas-end" data-bs-backdrop="static" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header border-bottom p-5">
            <h5 id="offcanvasRightLabel" class="cart__title">Your Cart <span class="cart_count_list" style="font-size:18px;"></span></h5>
            <button type="button" class="btn-close cart__close-btn text-reset" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
        </div>
        <div class="offcanvas-body cart__container">
            <div class="form-check checkbox">
                <input class="form-check-input" type="checkbox" id="select-all-checkbox" style="margin-top:5px;">
                <label class="form-check-label" for="select-all-checkbox" style="font-size:14px; font-weight:500;">
                    Select all items in the cart
                </label>
            </div>
            <div class="cart__items p-4 py-0 cart_item_list">
                <!-- AJAX REQUEST -->
            </div>

            <div class="cart__subtotal-container p-4 py-5">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="cart__subtotal-name">Subtotal</div>
                    <div class="cart__subtotal-price">0.00</div>
                </div>
                <button type="button" class="cart__checkout">Check out <span class="checkout_count">(0)</span></button>
            </div>
        </div>
    </div>
    
<footer id="footer">
    <div class="container">
        <div class="row">
            <div class="col">
                <img class="footer__logo" src="<?php echo base_url('assets/images/logo.png'); ?>" alt="Product 1">
                <h1 class="footer__title">Shantal's Beauty & Wellness</h1>
                <p class="footer__p">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Odit, unde. Nobis dolor
                    mollitia cum ad?
                    Eligendi, suscipit aperiam! Neque, ea.</p>
            </div>
            <div class="col d-flex flex-column justify-content-end">
                <div class="row">
                    <div class="col">
                        <ul class="footer__items">
                            <li class="footer__items__title">Shop</li>
                            <li class="footer__item">Shop All</li>
                            <li class="footer__item">Best Sellers</li>
                            <li class="footer__item">Sales & Offers</li>
                        </ul>
                    </div>
                    <div class="col">
                        <ul class="footer__items">
                            <li class="footer__items__title">Company</li>
                            <li class="footer__item">Shop All</li>
                            <li class="footer__item">Best Sellers</li>
                            <li class="footer__item">Sales & Offers</li>
                        </ul>
                    </div>
                    <div class="col">
                        <ul class="footer__items">
                            <li class="footer__items__title">Support</li>
                            <li class="footer__item">Shop All</li>
                            <li class="footer__item">Best Sellers</li>
                            <li class="footer__item">Sales & Offers</li>
                        </ul>
                    </div>
                    <div class="col">
                        <ul class="footer__items">
                            <li class="footer__items__title">Shop</li>
                            <li class="footer__item">Shop All</li>
                            <li class="footer__item">Best Sellers</li>
                            <li class="footer__item">Sales & Offers</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer__copyright">
            © 2024 Shantalsbeautyandwellness.com
        </div>
    </div>
</footer>



</body>