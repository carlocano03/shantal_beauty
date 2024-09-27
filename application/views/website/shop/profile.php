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
                            <div class="profile__sidebar-menu__item" data-target="#my-order__section">My Orders
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

                        <!-- My Order -->
                        <div id="my-order__section" class="profile__sidebar-card profile__content">
                            <h1 class="profile__title">My Order</h1>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <!-- To Ship Tab -->
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="to-ship-tab" data-bs-toggle="tab"
                                        data-bs-target="#to-ship-tab-pane" type="button" role="tab"
                                        aria-controls="to-ship-tab-pane" aria-selected="true">To Ship<span
                                            class="my-order__section__tab--badge">2</span></button>
                                </li>
                                <!-- To Receive Tab -->
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="to-receive-tab" data-bs-toggle="tab"
                                        data-bs-target="#to-receive-tab-pane" type="button" role="tab"
                                        aria-controls="to-receive-tab-pane" aria-selected="false">To Receive<span
                                            class="my-order__section__tab--badge">2</span></button>
                                </li>
                                <!-- Completed Tab -->
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="completed-tab" data-bs-toggle="tab"
                                        data-bs-target="#completed-tab-pane" type="button" role="tab"
                                        aria-controls="completed-tab-pane" aria-selected="false">Completed<span
                                            class="my-order__section__tab--badge">2</span></button>
                                </li>
                                <!-- Cancelled Tab -->
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="cancelled-tab" data-bs-toggle="tab"
                                        data-bs-target="#cancelled-tab-pane" type="button" role="tab"
                                        aria-controls="cancelled-tab-pane" aria-selected="false">Cancelled<span
                                            class="my-order__section__tab--badge">2</span></button>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <!-- To Ship Tab Content -->
                                <div class="tab-pane fade show active" id="to-ship-tab-pane" role="tabpanel"
                                    aria-labelledby="to-ship-tab" tabindex="0">
                                    <!-- Order Item -->
                                    <div class="my-order__section__order-item mb-4 p-4 border rounded">
                                        <div
                                            class="my-order__section__order-header mb-3 d-flex justify-content-between align-items-center">
                                            <div>
                                                <h1 class="my-order__orderNo">Order #54321</h1>
                                                <small class="text-muted">Placed on: 15th September 2024</small>
                                            </div>
                                            <span class="badge bg-warning my-order__badge">To Ship</span>
                                        </div>
                                        <div class="my-order__section__order-products">
                                            <!-- Product -->
                                            <div
                                                class="my-order__section__product d-flex justify-content-between align-items-center">
                                                <div class="d-flex">
                                                    <img src="<?php echo base_url('assets/images/shop/product-cart-1.webp'); ?>"
                                                        class="my-order__section__product-img me-4" alt="Product 1">
                                                    <div class="d-flex flex-column justify-content-between">
                                                        <div>
                                                            <p class="my-order__product__name">Temptation Coffee</p>
                                                            <p class="my-order__product__quantity">Quantity: 2</p>
                                                        </div>
                                                        <p class="my-order__product__price">₱200</p>
                                                    </div>
                                                </div>
                                                <button type="button" class="my-order__product__track-order">Track
                                                    Order</button>
                                            </div>

                                            <div
                                                class="my-order__section__product d-flex justify-content-between align-items-center">
                                                <div class="d-flex">
                                                    <img src="<?php echo base_url('assets/images/shop/product-cart-1.webp'); ?>"
                                                        class="my-order__section__product-img me-4" alt="Product 1">
                                                    <div class="d-flex flex-column justify-content-between">
                                                        <div>
                                                            <p class="my-order__product__name">Temptation Coffee</p>
                                                            <p class="my-order__product__quantity">Quantity: 2</p>
                                                        </div>
                                                        <p class="my-order__product__price">₱200</p>
                                                    </div>
                                                </div>
                                                <button type="button" class="my-order__product__track-order">Track
                                                    Order</button>
                                            </div>



                                        </div>
                                    </div>
                                </div>
                                <!-- To Receive Tab Content -->
                                <div class="tab-pane fade" id="to-receive-tab-pane" role="tabpanel"
                                    aria-labelledby="to-receive-tab" tabindex="0">
                                    <!-- Order Item -->
                                    <div class="my-order__section__order-item mb-4 p-4 border rounded">
                                        <div
                                            class="my-order__section__order-header mb-3 d-flex justify-content-between align-items-center">
                                            <div>
                                                <h1 class="my-order__orderNo">Order #67890</h1>
                                                <small class="text-muted">Shipped on: 16th September 2024</small>
                                            </div>
                                            <span class="badge bg-info my-order__badge">To Receive</span>
                                        </div>
                                        <div class="my-order__section__order-products">
                                            <!-- Product -->
                                            <div
                                                class="my-order__section__product d-flex justify-content-between align-items-center">
                                                <div class="d-flex">
                                                    <img src="<?php echo base_url('assets/images/shop/product-cart-1.webp'); ?>"
                                                        class="my-order__section__product-img me-4" alt="Product 1">
                                                    <div class="d-flex flex-column justify-content-between">
                                                        <div>
                                                            <p class="my-order__product__name">Temptation Coffee</p>
                                                            <p class="my-order__product__quantity">Quantity: 1</p>
                                                        </div>
                                                        <p class="my-order__product__price">₱150</p>
                                                    </div>
                                                </div>
                                                <button type="button" class="my-order__product__track-order">Track
                                                    Order</button>
                                            </div>

                                            <div
                                                class="my-order__section__product d-flex justify-content-between align-items-center">
                                                <div class="d-flex">
                                                    <img src="<?php echo base_url('assets/images/shop/product-cart-1.webp'); ?>"
                                                        class="my-order__section__product-img me-4" alt="Product 1">
                                                    <div class="d-flex flex-column justify-content-between">
                                                        <div>
                                                            <p class="my-order__product__name">Temptation Coffee</p>
                                                            <p class="my-order__product__quantity">Quantity: 1</p>
                                                        </div>
                                                        <p class="my-order__product__price">₱150</p>
                                                    </div>
                                                </div>
                                                <button type="button" class="my-order__product__track-order">Track
                                                    Order</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Completed Tab Content -->
                                <div class="tab-pane fade" id="completed-tab-pane" role="tabpanel"
                                    aria-labelledby="completed-tab" tabindex="0">
                                    <div class="my-order__section__order-item mb-4 p-4 border rounded">
                                        <div
                                            class="my-order__section__order-header mb-3 d-flex justify-content-between align-items-center">
                                            <div>
                                                <h1 class="my-order__orderNo">Order #12345</h1>
                                                <small class="text-muted">Delivered on: 12th September 2024</small>
                                            </div>
                                            <span class="badge bg-success my-order__badge">Completed</span>
                                        </div>
                                        <div class="my-order__section__order-products">
                                            <!-- Product -->
                                            <div
                                                class="my-order__section__product d-flex justify-content-between align-items-center">
                                                <div class="d-flex">
                                                    <img src="<?php echo base_url('assets/images/shop/product-cart-1.webp'); ?>"
                                                        class="my-order__section__product-img me-4" alt="Product 1">
                                                    <div class="d-flex flex-column justify-content-between">
                                                        <div>
                                                            <p class="my-order__product__name">Temptation Coffee</p>
                                                            <p class="my-order__product__quantity">Quantity: 1</p>
                                                        </div>
                                                        <p class="my-order__product__price">₱100</p>
                                                    </div>
                                                </div>
                                                <button type="button" class="my-order__product__buy-again">Buy
                                                    Again</button>
                                            </div>

                                            <div
                                                class="my-order__section__product d-flex justify-content-between align-items-center">
                                                <div class="d-flex">
                                                    <img src="<?php echo base_url('assets/images/shop/product-cart-1.webp'); ?>"
                                                        class="my-order__section__product-img me-4" alt="Product 1">
                                                    <div class="d-flex flex-column justify-content-between">
                                                        <div>
                                                            <p class="my-order__product__name">Temptation Coffee</p>
                                                            <p class="my-order__product__quantity">Quantity: 1</p>
                                                        </div>
                                                        <p class="my-order__product__price">₱100</p>
                                                    </div>
                                                </div>
                                                <button type="button" class="my-order__product__buy-again">Buy
                                                    Again</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Cancelled Tab Content -->
                                <div class="tab-pane fade" id="cancelled-tab-pane" role="tabpanel"
                                    aria-labelledby="cancelled-tab" tabindex="0">
                                    <div class="my-order__section__order-item mb-4 p-4 border rounded">
                                        <div
                                            class="my-order__section__order-header mb-3 d-flex justify-content-between align-items-center">
                                            <div>
                                                <h1 class="my-order__orderNo">Order #98765</h1>
                                                <small class="text-muted">Cancelled on: 14th September 2024</small>
                                            </div>
                                            <span class="badge bg-danger my-order__badge">Cancelled</span>
                                        </div>
                                        <div class="my-order__section__order-products">
                                            <!-- Product -->
                                            <div
                                                class="my-order__section__product d-flex justify-content-between align-items-center">
                                                <div class="d-flex">
                                                    <img src="<?php echo base_url('assets/images/shop/product-cart-1.webp'); ?>"
                                                        class="my-order__section__product-img me-4" alt="Product 1">
                                                    <div class="d-flex flex-column justify-content-between">
                                                        <div>
                                                            <p class="my-order__product__name">Temptation Coffee</p>
                                                            <p class="my-order__product__quantity">Quantity: 1</p>
                                                        </div>
                                                        <p class="my-order__product__price">₱5,000</p>
                                                    </div>
                                                </div>
                                                <button type="button"
                                                    class="my-order__product__reorder">Reorder</button>
                                            </div>

                                            <div
                                                class="my-order__section__product d-flex justify-content-between align-items-center">
                                                <div class="d-flex">
                                                    <img src="<?php echo base_url('assets/images/shop/product-cart-1.webp'); ?>"
                                                        class="my-order__section__product-img me-4" alt="Product 1">
                                                    <div class="d-flex flex-column justify-content-between">
                                                        <div>
                                                            <p class="my-order__product__name">Temptation Coffee</p>
                                                            <p class="my-order__product__quantity">Quantity: 1</p>
                                                        </div>
                                                        <p class="my-order__product__price">₱5,000</p>
                                                    </div>
                                                </div>
                                                <button type="button"
                                                    class="my-order__product__reorder">Reorder</button>
                                            </div>
                                        </div>
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

                            <button type="button" class="shipping-address__btn"><i
                                    class="bi bi-plus-circle me-2"></i>Add New Payment Method </button>

                            <div class="row row-cols-lg-2 row-cols-1 gy-4 gy-lg-0 mt-5">
                                <div class="col">
                                    <div class="d-flex flex-column gap-3">
                                        <div id="payment-method__debit-card" class="payment-methods__card">
                                            <div class="form-check checkout__payment-method__check">
                                                <div class="d-flex align-items-center gap-3">
                                                    <img class="checkout__payment-method__label-img"
                                                        src="<?php echo base_url('assets/images/shop/mastercard-Logo.png'); ?>"
                                                        alt="Debit Card">
                                                    <div>
                                                        <label for="debitCard"
                                                            class="form-check-label payment-methods__card__label">
                                                            Debit Card ending in 1234
                                                        </label>
                                                        <p class="card-expiry">Exp. date: 12/24</p>
                                                    </div>

                                                    <div class="payment-methods__card__selected">Default</div>

                                                </div>

                                                <input class="form-check-input checkout__payment-method__input"
                                                    type="radio" name="paymentMethod" id="debitCard" value="Debit Card">
                                            </div>
                                        </div>

                                        <div id="payment-method__gcash" class="payment-methods__card">
                                            <div class="form-check checkout__payment-method__check">
                                                <div class="d-flex align-items-center gap-3">
                                                    <img class="checkout__payment-method__label-img"
                                                        src="<?php echo base_url('assets/images/shop/gcash-logo.png'); ?>"
                                                        alt="GCash">
                                                    <div>
                                                        <label for="gcash"
                                                            class="form-check-label payment-methods__card__label">
                                                            GCash account: 0917xxxxxxx
                                                        </label>
                                                        <p class="card-expiry">Verified</p>
                                                    </div>
                                                </div>
                                                <input class="form-check-input checkout__payment-method__input"
                                                    type="radio" name="paymentMethod" id="gcash" value="GCash">
                                            </div>
                                        </div>

                                        <div id="payment-method__maya" class="payment-methods__card">
                                            <div class="form-check checkout__payment-method__check">
                                                <div class="d-flex align-items-center gap-3">
                                                    <img class="checkout__payment-method__label-img"
                                                        src="<?php echo base_url('assets/images/shop/maya.png'); ?>"
                                                        alt="Maya">
                                                    <div>
                                                        <label for="maya"
                                                            class="form-check-label payment-methods__card__label">
                                                            Maya account: 0918xxxxxxx
                                                        </label>
                                                        <p class="card-expiry">Verified</p>
                                                    </div>
                                                </div>
                                                <input class="form-check-input checkout__payment-method__input"
                                                    type="radio" name="paymentMethod" id="maya" value="Maya">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div id="payment-method__debit-card__details" class="payment-method-details">
                                        <h1 class="payment-method-details__title">Payment Method Details</h1>
                                        <p><strong>Debit Card:</strong> **** **** **** 1234</p>
                                        <p><strong>Expiration Date:</strong> 12/24</p>
                                        <p><strong>Billing Address:</strong> 1234 Street, City, Country</p>
                                        <div class="d-flex items-center gap-2 mt-5">
                                            <button class="payment-method-details__edit-btn">Edit Payment
                                                Method</button>
                                            <button class="payment-method-details__delete-btn">Delete</button>
                                        </div>
                                    </div>
                                    <div id="payment-method__gcash__details" class="payment-method-details"
                                        style="display:none">
                                        <h1 class="payment-method-details__title">Payment Method Details</h1>
                                        <!-- GCash Details -->
                                        <p><strong>GCash Account:</strong> 0917xxxxxxx</p>
                                        <p><strong>Status:</strong> Verified</p>
                                        <div class="d-flex items-center gap-2 mt-5">
                                            <button class="payment-method-details__edit-btn">Edit GCash Details</button>
                                            <button class="payment-method-details__delete-btn">Delete</button>
                                        </div>
                                    </div>

                                    <div id="payment-method__maya__details" class="payment-method-details"
                                        style="display:none">
                                        <h1 class="payment-method-details__title">Payment Method Details</h1>
                                        <!-- Maya Details -->
                                        <p><strong>Maya Account:</strong> 0918xxxxxxx</p>
                                        <p><strong>Status:</strong> Verified</p>
                                        <div class="d-flex items-center gap-2 mt-5">
                                            <button class="payment-method-details__edit-btn">Edit Maya Details</button>
                                            <button class="payment-method-details__delete-btn">Delete</button>
                                        </div>
                                    </div>

                                </div>

                            </div>

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
    < class="spinner-border text-dark" role="status">
    </ div>
</div>