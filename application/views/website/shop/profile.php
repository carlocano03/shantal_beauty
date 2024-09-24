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

        <!-- Profile  -->
        <div id="profile">
            <div class="container">
                <div class="profile__header">
                    <h1 class="profile__header__title">Settings</h1>
                    <p class="profile__header__p">Manage your account settings and preferences to personalize your
                        shopping
                        experience.</p>
                    <hr />
                </div>
                <div class="row gx-lg-5 gy-5">
                    <div class="col-lg-4 col-12">
                        <div class="profile__sidebar-card">
                            <div class="profile__sidebar-menu__item active" data-target="#profile__section">
                                Profile</div>
                            <div class="profile__sidebar-menu__item" data-target="#order-history__section">Order History
                            </div>
                            <div class=" profile__sidebar-menu__item" data-target="#shipping-address__section">Shipping
                                Address</div>
                            <div class="profile__sidebar-menu__item" data-target="#payment-methods__section">Payment
                                Methods</div>
                            <div class="profile__sidebar-menu__item" data-target="#settings__section">Settings
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-12">
                        <div id="profile__section" class="profile__sidebar-card profile__content"
                            style="display:block;">
                            <h1 class="profile__title">Profile</h1>
                            <p class="profile__p">Keep your profile information up-to-date to ensure a
                                personalized
                                and
                                seamless shopping
                                experience on our site.</p>
                            <hr />
                            <div class="row">
                                <div class="col-8">
                                    <form id="profile__form" class="row g-4 mt-2 needs-validation" novalidate>
                                        <div class="col-12">
                                            <label for="profileFullname" class="form-label profile__label">Full
                                                Name</label>
                                            <input type="text" class="form-control profile__input" id="profileFullname"
                                                value="Jake Castor" placeholder="Enter your full name" required>
                                            <div class="invalid-feedback">Please enter your full name.</div>
                                        </div>

                                        <div class="col-12">
                                            <label for="profileCompleteAddress"
                                                class="form-label profile__label">Complete
                                                Address</label>
                                            <input type="text" value="Sinipit, Cabiao, Nueva Ecija"
                                                class="form-control profile__input" id="profileCompleteAddress"
                                                placeholder="Enter your full name" required>
                                            <div class="invalid-feedback">Please enter your complete address.</div>
                                        </div>


                                        <div class="col-12">
                                            <label for="profilePhoneNumber" class="form-label profile__label">Mobile
                                                Number</label>
                                            <input type="text" value="0961232132"
                                                class="form-control profile__input number-input" id="profilePhoneNumber"
                                                placeholder="Enter your phone number" required>
                                            <div class="invalid-feedback">Please enter a valid 10-digit phone
                                                number.
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="profileEmail" class="form-label profile__label">Email
                                                Address</label>
                                            <input type="email" class="form-control profile__input" id="profileEmail"
                                                value="jakecastor@gmail.com" placeholder="Enter your email address"
                                                required>
                                            <div class="invalid-feedback">Please enter a valid email address.</div>
                                        </div>

                                        <div class="col-12">
                                            <label for="profilePassword"
                                                class="form-label profile__label">Password</label>
                                            <div class="input-group">
                                                <input type="password" class="form-control profile__input"
                                                    id="profilePassword" value="12321421"
                                                    placeholder="Enter your password" required>
                                                <span class="input-group-text">
                                                    <i class="far fa-eye" id="togglePassword"
                                                        style="cursor: pointer;"></i>
                                                </span>
                                            </div>

                                            <div class="invalid-feedback">Please enter a valid password.</div>
                                        </div>

                                        <div class="col-12">
                                            <button type="button" class="profile__update-button">Update
                                                Profile</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Order History -->
                        <div id="order-history__section" class="profile__sidebar-card profile__content"
                            style="display:none;">
                            <h1 class="profile__title">Order History</h1>
                            <p class="profile__p">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nostrum quam
                                veritatis nulla suscipit, harum dolore aut earum excepturi natus? Id.</p>
                            <hr />
                            <div class="order-history__section__order-item mb-4 p-4 border rounded">
                                <div
                                    class="order-history__section__order-header mb-3 d-flex justify-content-between align-items-center">
                                    <div>
                                        <h1 class="order-history__orderNo">Order #12345</h1>
                                        <small class="text-muted">Delivered on: 12th September 2024</small>
                                    </div>
                                    <span class="badge bg-success order-history__badge">Completed</span>


                                </div>

                                <div class="order-history__section__order-products">
                                    <!-- Product 1 -->
                                    <div class="product d-flex justify-content-between align-items-center">
                                        <div class="d-flex">
                                            <img src="<?php echo base_url('assets/images/shop/product-cart-1.webp'); ?>"
                                                class="order-history__section__product-img me-4" alt="Product 1">
                                            <div class="d-flex flex-column justify-content-between">
                                                <div>
                                                    <p class="order-history__product__name">Temptation Coffee</p>
                                                    <p class="order-history__product__quantity">Quantity: 1</p>
                                                </div>
                                                <p class="order-history__product__price">₱100</p>
                                            </div>

                                        </div>
                                        <button type="button" class="order-history__product__buy-again">Buy
                                            Again</button>
                                    </div>

                                    <!-- Product 2 -->
                                    <div class="product d-flex justify-content-between align-items-center">
                                        <div class="d-flex">
                                            <img src="<?php echo base_url('assets/images/shop/product-cart-1.webp'); ?>"
                                                class="order-history__section__product-img me-4" alt="Product 1">
                                            <div class="d-flex flex-column justify-content-between">
                                                <div>
                                                    <p class="order-history__product__name">Temptation Coffee</p>
                                                    <p class="order-history__product__quantity">Quantity: 1</p>
                                                </div>
                                                <p class="order-history__product__price">₱100</p>
                                            </div>

                                        </div>
                                        <button type="button" class="order-history__product__buy-again">Buy
                                            Again</button>
                                    </div>

                                </div>

                            </div>
                        </div>

                        <!-- Shipping Address -->
                        <div id="shipping-address__section" class="profile__sidebar-card profile__content"
                            style="display:none;">
                            <h1 class="profile__title">Shipping Address</h1>
                            <p class="profile__p">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nostrum quam
                                veritatis nulla suscipit, harum dolore aut earum excepturi natus? Id.</p>
                            <hr />

                            <div class="mt-4">

                                <button type="button" class="shipping-address__btn"><i
                                        class="bi bi-plus-circle me-2"></i>Add new address</button>

                                <div class="address_list d-flex flex-column gap-3 mt-4">
                                    <div class="address_list__container">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="form-check checkbox d-flex align-items-center gap-3">
                                                <input
                                                    class="form-check-input cart__item__check_all-product change_delivery_address"
                                                    data-id="1" type="radio" name="address_selection"
                                                    id="address_selection1">
                                                <label class="form-check-label" for="address_selection1"
                                                    style="font-size:14px; font-weight:500; margin-top:4px;">
                                                    <span class="fw-bold">Carlo Cano</span> | (+63) 906 179 8559
                                                </label>
                                            </div>
                                            <div class="delete--btn delete_address" data-id="1"><i
                                                    class="bi bi-trash"></i>
                                            </div>
                                        </div>
                                        <div style="margin-left:25px; font-size:13px; color:#636e72;">
                                            <div>Landmark: Basketball Court</div>
                                            <div>Purok 4 Bangkal Papaya, San Antonio, Nueva Ecija 3108</div>
                                            <span class="badge bg-warning text-white">Default</span>
                                        </div>
                                    </div>
                                    <div class="address_list__container">

                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="form-check checkbox d-flex align-items-center gap-3">
                                                <input
                                                    class="form-check-input cart__item__check_all-product change_delivery_address"
                                                    data-id="2" type="radio" name="address_selection"
                                                    id="address_selection2" checked="">
                                                <label class="form-check-label" for="address_selection2"
                                                    style="font-size:14px; font-weight:500; margin-top:4px;">
                                                    <span class="fw-bold">Ana Marie Cano</span> | (+63) 965 093 6316
                                                </label>
                                            </div>
                                        </div>
                                        <div style="margin-left:25px; font-size:13px; color:#636e72;">
                                            <div>Landmark: Basketball Court</div>
                                            <div>Purok 4 Bangkal Papaya, San Antonio, Nueva Ecija 3108</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Payment methods -->
                        <div id="payment-methods__section" class="profile__sidebar-card profile__content"
                            style="display:none;">
                            <h1 class="profile__title">Payment Methods</h1>
                            <p class="profile__p">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nostrum
                                quam
                                veritatis nulla suscipit, harum dolore aut earum excepturi natus? Id.</p>
                            <hr />

                        </div>

                        <!-- Settings -->
                        <div id="settings__section" class="profile__sidebar-card profile__content"
                            style="display:none;">
                            <h1 class="profile__title">Settings</h1>
                            <p class="profile__p">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nostrum
                                quam
                                veritatis nulla suscipit, harum dolore aut earum excepturi natus? Id.</p>
                            <hr />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
    </section>
</main>

<div class="loading-screen text-center" style="display: none;">
    <div class="spinner-border text-dark" role="status">
    </div>
</div>