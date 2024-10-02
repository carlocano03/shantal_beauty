<main>
    <section>
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
                    <h1 class="profile__header__title">Profile Settings</h1>
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
                                                value="<?= isset($profile['full_name']) ? ucwords($profile['full_name']) : '';?>"
                                                placeholder="Enter your full name" required>
                                            <div class="invalid-feedback">Please enter your full name.</div>
                                        </div>

                                        <div class="col-12">
                                            <label for="profileCompleteAddress"
                                                class="form-label profile__label">Complete
                                                Address</label>
                                            <input type="text"
                                                value="<?= isset($profile['complete_address']) ? ucwords($profile['complete_address']) : '';?>"
                                                class="form-control profile__input" id="profileCompleteAddress"
                                                placeholder="Enter your full name" required>
                                            <div class="invalid-feedback">Please enter your complete address.</div>
                                        </div>


                                        <div class="col-12">
                                            <label for="profilePhoneNumber" class="form-label profile__label">Mobile
                                                Number</label>
                                            <input type="text"
                                                value="<?= isset($profile['mobile_number']) ? $profile['mobile_number'] : '';?>"
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
                                                value="<?= isset($profile['email_address']) ? $profile['email_address'] : '';?>"
                                                placeholder="Enter your email address" required>
                                            <div class="invalid-feedback">Please enter a valid email address.</div>
                                        </div>

                                        <div class="col-12">
                                            <label for="profilePassword"
                                                class="form-label profile__label">Password</label>
                                            <div class="input-group">
                                                <input type="password" class="form-control profile__input"
                                                    id="profilePassword" value=""
                                                    placeholder="Enter your password (Update)" required>
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
                        <div id="my-order__section" class="profile__sidebar-card profile__content" style="display:none">
                            <h1 class="profile__title">My Order</h1>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <!-- To Pay Tab -->
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="to-pay-tab" data-bs-toggle="tab"
                                        data-bs-target="#to-pay-tab-pane" type="button" role="tab"
                                        aria-controls="to-pay-tab-pane" aria-selected="true">To Pay<span
                                            class="my-order__section__tab--badge to_pay_count" style="display:none;">0</span></button>
                                </li>
                                <!-- To Ship Tab -->
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="to-ship-tab" data-bs-toggle="tab"
                                        data-bs-target="#to-ship-tab-pane" type="button" role="tab"
                                        aria-controls="to-ship-tab-pane" aria-selected="true">To Ship<span
                                            class="my-order__section__tab--badge to_ship_count" style="display:none;">0</span></button>
                                </li>
                                <!-- To Receive Tab -->
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="to-receive-tab" data-bs-toggle="tab"
                                        data-bs-target="#to-receive-tab-pane" type="button" role="tab"
                                        aria-controls="to-receive-tab-pane" aria-selected="false">To Receive<span
                                            class="my-order__section__tab--badge to_receive_count" style="display:none;">0</span></button>
                                </li>
                                <!-- Completed Tab -->
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="completed-tab" data-bs-toggle="tab"
                                        data-bs-target="#completed-tab-pane" type="button" role="tab"
                                        aria-controls="completed-tab-pane" aria-selected="false">Completed<span
                                            class="my-order__section__tab--badge completed_count" style="display:none;">0</span></button>
                                </li>
                                <!-- Cancelled Tab -->
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="cancelled-tab" data-bs-toggle="tab"
                                        data-bs-target="#cancelled-tab-pane" type="button" role="tab"
                                        aria-controls="cancelled-tab-pane" aria-selected="false">Cancelled<span
                                            class="my-order__section__tab--badge cancelled_count" style="display:none;">0</span></button>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <!-- To Pay Tab Content -->
                                <div class="tab-pane fade show active" id="to-pay-tab-pane" role="tabpanel"
                                    aria-labelledby="to-pay-tab" tabindex="0">
                                    <?php $this->load->view('website/shop/tablist/to_pay_tab');?>
                                </div>

                                <!-- To Ship Tab Content -->
                                <div class="tab-pane fade" id="to-ship-tab-pane" role="tabpanel"
                                    aria-labelledby="to-ship-tab" tabindex="0">
                                    <?php $this->load->view('website/shop/tablist/to_ship_tab');?>
                                </div>

                                <!-- To Receive Tab Content -->
                                <div class="tab-pane fade" id="to-receive-tab-pane" role="tabpanel"
                                    aria-labelledby="to-receive-tab" tabindex="0">
                                    <?php $this->load->view('website/shop/tablist/to_receive_tab');?>
                                </div>

                                <!-- Completed Tab Content -->
                                <div class="tab-pane fade" id="completed-tab-pane" role="tabpanel"
                                    aria-labelledby="completed-tab" tabindex="0">
                                    <?php $this->load->view('website/shop/tablist/completed_tab');?>
                                </div>

                                <!-- Cancelled Tab Content -->
                                <div class="tab-pane fade" id="cancelled-tab-pane" role="tabpanel"
                                    aria-labelledby="cancelled-tab" tabindex="0">
                                    <?php $this->load->view('website/shop/tablist/completed_tab');?>
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

                                <button type="button" class="shipping-address__btn" data-bs-toggle="modal"
                                    data-bs-target="#addressModal"><i class="bi bi-plus-circle me-2"></i>Add new
                                    address</button>

                                <div class="address_list d-flex flex-column gap-3 mt-4">
                                    <!-- AJAX REQUEST -->
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
    <div class="spinner-border text-dark" role="status">
    </div>
</div>

<?php $this->load->view('website/shop/modal/new_address_modal');?>


<script>
    var set_default = 0;

    function getAddress() {
        $.ajax({
            url: "<?= base_url('shop/products/get_delivery_address')?>",
            method: "GET",
            dataType: "json",
            success: function (data) {
                $('.address_list').html(data.address_list);
            }
        });
    }

    $(document).ready(function () {
        getAddress();

        $(document).on('change', '.set_default', function () {
            if ($(this).is(':checked')) {
                set_default = 1;
            } else {
                set_default = 0;
            }
        });

        $(document).on('click', '.change_delivery_address', function () {
            var shipping_id = $(this).data('id');

            if ($(this).is(':checked')) {
                $.ajax({
                    url: "<?= base_url('shop/products/change_delivery_address');?>",
                    method: "POST",
                    data: {
                        shipping_id: shipping_id,
                        '_token': csrf_token_value,
                    },
                    dataType: "json",
                    success: function (data) {
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
                            getAddress();
                        }
                    },
                    error: function () {
                        Toast.fire({
                            icon: 'error',
                            title: 'An error occurred while processing the request.',
                        });
                    }
                });
            }
        });

        $(document).on('click', '.delete_address', function () {
            var shipping_id = $(this).data('id');

            Swal.fire({
                title: 'Are you sure..',
                text: "You want to delete this address?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, continue',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?= base_url('shop/products/delete_address');?>",
                        method: "POST",
                        data: {
                            shipping_id: shipping_id,
                            '_token': csrf_token_value,
                        },
                        dataType: "json",
                        success: function (data) {
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
                                getAddress();
                            }
                        },
                        error: function () {
                            Toast.fire({
                                icon: 'error',
                                title: 'An error occurred while processing the request.',
                            });
                        }
                    });
                }
            });
        });

        $(document).on('click', '#save_address', function (event) {
            event.preventDefault();
            event.stopPropagation();

            var form = $('#addressForm')[0];
            var formData = new FormData(form);
            formData.append('fullname', $('#fullname').val());
            formData.append('contact_no', $('#contact_no').val());
            formData.append('province_name', $('#province_name').val());
            formData.append('municipality_name', $('#municipality_name').val());
            formData.append('brgy_name', $('#brgy_name').val());
            formData.append('postal_code', $('#postal_code').val());
            formData.append('street_name', $('#street_name').val());
            formData.append('landmark', $('#landmark').val());
            formData.append('label_as', $('#label_as').val());
            formData.append('set_default', set_default);
            formData.append('_token', csrf_token_value);

            form.classList.add('was-validated');
            if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
            } else {
                Swal.fire({
                    title: 'Are you sure..',
                    text: "You want to continue this transaction?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, continue',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "<?= base_url('shop/products/save_address');?>",
                            method: "POST",
                            data: formData,
                            contentType: false,
                            processData: false,
                            dataType: "json",
                            success: function (data) {
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
                                    $('#addressModal').modal('hide');
                                    form.reset();
                                    form.classList.remove('was-validated');
                                    getAddress();
                                }
                            },
                            error: function () {
                                Toast.fire({
                                    icon: 'error',
                                    title: 'An error occurred while processing the request.',
                                });
                            }
                        });
                    }
                });
            }
        });
    });
</script>