<main>
    <section id="auth">
        <header class="auth__header" class="py-2">
            <nav class="navbar">
                <div class="navbar__container container">
                    <div class="d-flex align-items-center">
                        <img class="navbar__logo" src="<?php echo base_url('assets/images/home/shantal-logo.png'); ?>"
                            alt="Shantal Beauty">
                        <h1 class="text-white fs-3">Reseller Signup</h1>
                    </div>
                </div>
            </nav>
        </header>
        <div class="auth-page__container">
            <img class="auth-page__bgImg" src="<?php echo base_url('assets/images/reseller/shantal-owner.webp'); ?>"
                alt="Shantal" />
            <div class="auth-page__overlay"></div>
            <div class="container">
                <div class="auth-page__content">
                    <div class="auth-page__hero">
                        <h1 class="auth-page__hero__title">Partner with Shantal’s Beauty</h1>
                        <h1 class="auth-page__hero__sub">Elevate Your Business with Premium Beauty Products</h1>
                    </div>
                    <!-- Login -->
                    <div id="card__login" class="auth-page__cta auth__card--hidden">
                        <div class="auth-page__cta__card">
                            <h1 class="auth-page__cta__card__signup-title">Log In</h1>
                            <p class="auth-page__cta__card__signup-sub">Lorem ipsum dolor, sit amet consectetur
                                adipisicing elit. A voluptatum</p>

                            <form id="auth-page__cta__loginForm" class="row g-3 mt-3 needs-validation" novalidate>
                                <div class="col-12">
                                    <label for="signupEmail" class="form-label signup__label">Email</label>
                                    <input type="email" class="form-control signup__input" id="signupEmail"
                                        placeholder="Enter your email" required>
                                    <div class="invalid-feedback">Please enter a valid email address.</div>
                                </div>

                                <div class="col-12">
                                    <label for="loginPassword" class="form-label login__label">Password</label>
                                    <input type="password" class="form-control login__input" id="loginPassword"
                                        placeholder="Enter your password" required>
                                    <div class="invalid-feedback">Your password is required</div>
                                </div>
                                <div class="col-12 mb-4">
                                    <button type="button" class="reseller_login__btn">Sign In</button>
                                </div>
                                <hr>
                                <div class="col-12">
                                    <p class="login__account">
                                        Dont have an account? <span id="signup__link" type="button"
                                            class="signup__link">Sign
                                            up</span>
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Sign up -->
                    <div id="card__signup" class="auth-page__cta">
                        <div class="auth-page__cta__card">
                            <div class="d-flex justify-content-between align-items-center">
                                <h1 class="auth-page__cta__card__signup-title">Sign Up</h1>
                                <h1 class="auth-page__cta__card__signup-status" type="button" data-bs-toggle="modal"
                                    data-bs-target="#checkStatus">Check Application Status</h1>
                            </div>
                            <p class="auth-page__cta__card__signup-sub">Lorem ipsum dolor, sit amet consectetur
                                adipisicing elit. A voluptatum</p>

                            <div
                                class="auth-page__cta__indicator-container d-flex justify-content-between align-items-center">
                                <div class="auth-page__cta__indicator-title">Account Setup</div>
                                <div class="flex-grow-1 mx-2">
                                    <hr style="border-top: 1px solid #000; margin: 0;">
                                </div>
                                <div class="auth-page__cta__indicator">1/2</div>
                            </div>

                            <!-- Basic Information 1 -->
                            <form id="auth-page__cta__signupForm-1" class="needs-validation" novalidate>
                                <div class="row mt-3">
                                    <div class="col-6">
                                        <label for="firstName" class="form-label signup__label">First Name</label>
                                        <input type="text" class="form-control signup__input" id="firstName"
                                            placeholder="Enter your first name" required>
                                        <div class="invalid-feedback">Please enter your first name.</div>
                                    </div>
                                    <div class="col-6">
                                        <label for="lastName" class="form-label signup__label">Last Name</label>
                                        <input type="text" class="form-control signup__input" id="lastName"
                                            placeholder="Enter your last name" required>
                                        <div class="invalid-feedback">Please enter your last name.</div>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <label for="signupEmail" class="form-label signup__label">Email</label>
                                        <input type="email" class="form-control signup__input" id="signupEmail"
                                            placeholder="Enter your email" required>
                                        <div class="invalid-feedback">Please enter a valid email address.</div>
                                    </div>

                                </div>

                                <div class="row mt-3">
                                    <div class="col-12">
                                        <label for="streetAddress" class="form-label signup__label">Street
                                            Address</label>
                                        <input type="text" class="form-control signup__input" id="streetAddress"
                                            placeholder="Enter your address" required>
                                        <div class="invalid-feedback">Please enter your street address.</div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-6">
                                        <label for="city" class="form-label signup__label">City</label>
                                        <input type="text" class="form-control signup__input" id="city"
                                            placeholder="Enter your city" required>
                                        <div class="invalid-feedback">Please enter your city.</div>
                                    </div>
                                    <div class="col-6">
                                        <label for="stateProvince"
                                            class="form-label signup__label">State/Province</label>
                                        <input type="text" class="form-control signup__input" id="stateProvince"
                                            placeholder="Enter your state/province" required>
                                        <div class="invalid-feedback">Please enter your state/province.</div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <label for="phoneNumber" class="form-label signup__label">Phone Number</label>
                                        <input type="text" class="form-control signup__input" id="phoneNumber"
                                            placeholder="Enter your phone number" required>
                                        <div class="invalid-feedback">Please enter a valid 10-digit phone number.</div>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <label for="signupReferralCode" class="form-label signup__label">Referral
                                            Code</label>
                                        <input type="text" class="form-control signup__input" id="signupReferralCode">
                                    </div>
                                </div>

                                <div class="col-12 my-5">
                                    <button type="button" class="reseller_signup__next-btn-1">Next</button>
                                </div>

                                <div class="col-12">
                                    <p class="signup__account">
                                        Already have an account? <span class="login__link" type="button"
                                            id="login__link">Login</span>
                                    </p>
                                </div>
                            </form>

                            <!-- 2 -->
                            <form id="auth-page__cta__signupForm-2" class="signUp__form--hidden needs-validation"
                                novalidate>
                                <div class="row gap-3 mt-3">
                                    <div class="col-12">
                                        <label for="typeOfId" class="form-label signup__label">Select Type of ID</label>
                                        <select id="typeOfId" class="form-select signup__input"
                                            aria-label="Default select example" required>
                                            <option value="" selected disabled>Select an ID type</option>
                                            <option value="1">Driver's License</option>
                                            <option value="2">Passport</option>
                                            <option value="3">PhilSys</option>
                                            <option value="4">Other</option>

                                        </select>
                                        <div class="invalid-feedback">Please select type of ID.</div>
                                    </div>
                                    <div class="col-12">
                                        <label for="validId" class="form-label signup__label">Upload Valid ID</label>
                                        <input type="file" class="form-control signup__input" id="validId" required
                                            disabled>
                                        <div class="invalid-feedback">Please upload a valid ID.</div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <label for="tin" class="form-label signup__label">Tax Identification
                                            Number (TIN)</label>
                                        <input type="number" class="form-control signup__input" id="tin"
                                            placeholder="Enter your TIN number" required>
                                        <div class="invalid-feedback">Please enter your TIN number.</div>
                                    </div>
                                </div>
                                <div class="row mt-3 gap-3">
                                    <div class="col-12">
                                        <label for="typeOfId" class="form-label signup__label">Select Bank Account for
                                            Commission</label>
                                        <select id="typeOfId" class="form-select signup__input"
                                            aria-label="Default select example" required>
                                            <option value="" selected disabled>Select a account type</option>
                                            <option value="1">Debit Card</option>
                                            <option value="2">GCash</option>
                                            <option value="3">Paymaya</option>
                                        </select>
                                        <div class="invalid-feedback">Please select accoun type.</div>
                                    </div>
                                    <!-- <div class="col-12">
                                        <label for="validId" class="form-label signup__label">Upload Valid ID</label>
                                        <input type="file" class="form-control signup__input" id="validId" required>
                                        <div class="invalid-feedback">Please upload a valid ID.</div>
                                    </div> -->

                                    <!-- <label for="ageConfirmation"> </label>
                                        <input type="checkbox" id="ageConfirmation" name="ageConfirmation" required>
                                        I confirm that I am 18 years old or older. -->
                                </div>


                                <div class="row mt-3">
                                    <div class="col-12 mt-3">
                                        <label for="ageConfirmation" class="form-label signup__label">
                                            <input type="checkbox" id="ageConfirmation" name="ageConfirmation" required>
                                            I confirm that I am 18 years old or older.
                                        </label>
                                        <div class="invalid-feedback">You must confirm that you are 18 years old or
                                            older.</div>
                                    </div>
                                </div>

                                <div class="col-12 mb-3 mt-5">
                                    <button type="button" class="reseller_signup__next-btn-2">Submit</button>
                                    <button type="button" class="reseller_signup__back-btn-2">Back</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</main>

<div class="modal fade" id="checkStatus" tabindex="-1" aria-labelledby="login" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content check-status__modal-content">
            <h1 class="check-status__title">Track Your Application Status</h1>
            <p class="check-status__p">Please enter the reference number provided during registration to view the status
                of
                your application. You will be able to see if your application is still under review, approved, or if
                further information is required.</p>

            <form id="checkStatusForm" class="row g-3 mt-4 needs-validation" novalidate>
                <div class="col-12">
                    <label for="referenceNumber" class="form-label signup__label">Reference Number</label>
                    <input type="number" class="form-control signup__input" id="referenceNumber"
                        placeholder="Enter your reference number" required>
                    <div class="invalid-feedback">Please enter your reference number.</div>
                </div>

                <div class="col-12 mt-4 mb-2">
                    <button type="button" class="check-status__btn">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {

    // Sign Up 
    $('.reseller_signup__next-btn-1').on('click', function(event) {

        const $form = $('#auth-page__cta__signupForm-1');

        if (!$form[0].checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
            $form.addClass('was-validated');
            return;
        }

        const formData = new FormData($form[0]);
        $("#auth-page__cta__signupForm-2").removeClass("signUp__form--hidden");
        $("#auth-page__cta__signupForm-1").addClass("signUp__form--hidden");
        $('.auth-page__cta__indicator').text('2/2');

        // AJAX request 

    });

    $('.reseller_signup__next-btn-2').on('click', function(event) {

        const $form = $('#auth-page__cta__signupForm-2');

        if (!$form[0].checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
            $form.addClass('was-validated');
            return;
        }

        const formData = new FormData($form[0]);

        // AJAX request 

    });

    $(".reseller_signup__back-btn-2").on("click", function(event) {
        $("#auth-page__cta__signupForm-1").removeClass("signUp__form--hidden");
        $("#auth-page__cta__signupForm-2").addClass("signUp__form--hidden");
        $('.auth-page__cta__indicator').text('1/2');
    })

    $('#typeOfId').on("change", function(event) {
        if (event.target.value) {
            $('#validId').prop('disabled', false);
        }
    });

    // Log In 
    $('.reseller_login__btn').on('click', function(event) {

        const $form = $('#auth-page__cta__loginForm');

        if (!$form[0].checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
            $form.addClass('was-validated');
            return;
        }

        const formData = new FormData($form[0]);
        // AJAX request 

    });


    // Switch between login and signup
    $('#login__link').on('click', function(event) {
        $('#card__login').removeClass("auth__card--hidden");
        $('#card__signup').addClass("auth__card--hidden");
    });

    $('#signup__link').on('click', function(event) {
        $('#card__signup').removeClass("auth__card--hidden");
        $('#card__login').addClass("auth__card--hidden");
    });

    // Next Button


});
</script>
