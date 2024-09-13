<style>
    #tbl_reference {
        width: 100%;
        border-collapse: collapse;
    }
    #tbl_reference th {
        border: 2px solid #dfe6e9;
        padding: 8px;
        vertical-align: middle;
    }
    #tbl_reference td {
        border: 1px solid #dfe6e9;
        padding: 8px;
        vertical-align: middle;
    }
</style>
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
                                    <label for="loginEmail" class="form-label signup__label">Email</label>
                                    <input type="email" name="loginEmail" class="form-control signup__input"
                                        id="loginEmail" placeholder="Enter your email" required>
                                    <div class="invalid-feedback">Please enter a valid email address.</div>
                                </div>

                                <div class="col-12">
                                    <label for="loginPassword" class="form-label login__label">Password</label>
                                    <input type="password" name="loginPassword" class="form-control login__input"
                                        id="loginPassword" placeholder="Enter your password" required>
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
                            <form id="auth-page__cta__signupForm" class="needs-validation" novalidate>
                                <div id="form1" class="">
                                    <div class="row mt-3">
                                        <div class="col-6">
                                            <label for="firstName" class="form-label signup__label">First Name</label>
                                            <input type="text" name="firstName" class="form-control signup__input"
                                                id="firstName" placeholder="Enter your first name" required>
                                            <div class="invalid-feedback">Please enter your first name.</div>
                                        </div>
                                        <div class="col-6">
                                            <label for="lastName" class="form-label signup__label">Last Name</label>
                                            <input type="text" name="lastName" class="form-control signup__input"
                                                id="lastName" placeholder="Enter your last name" required>
                                            <div class="invalid-feedback">Please enter your last name.</div>
                                        </div>
                                        <div class="col-12 mt-3">
                                            <label for="signupEmail" class="form-label signup__label">Email</label>
                                            <input type="email" name="signupEmail" class="form-control signup__input"
                                                id="signupEmail" placeholder="Enter your email" required>
                                            <div class="invalid-feedback">Please enter a valid email address.</div>
                                        </div>

                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-6">
                                            <label for="streetAddress" class="form-label signup__label">Street/House No.</label>
                                            <input type="text" name="streetAddress" class="form-control signup__input"
                                                id="streetAddress" placeholder="Enter your st./house no." required>
                                            <div class="invalid-feedback">Please enter st./house no.</div>
                                        </div>
                                        <div class="col-6">
                                            <label for="brgyAddress" class="form-label signup__label">Barangay</label>
                                            <input type="text" name="brgyAddress" class="form-control signup__input"
                                                id="brgyAddress" placeholder="Enter your barangay" required>
                                            <div class="invalid-feedback">Please enter your barangay.</div>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-6">
                                            <label for="city" class="form-label signup__label">Municipality</label>
                                            <input type="text" name="city" class="form-control signup__input" id="city"
                                                placeholder="Enter your municipality" required>
                                            <div class="invalid-feedback">Please enter your municipality.</div>
                                        </div>
                                        <div class="col-6">
                                            <label for="stateProvince"
                                                class="form-label signup__label">State/Province</label>
                                            <input type="text" name="stateProvince" class="form-control signup__input"
                                                id="stateProvince" placeholder="Enter your state/province" required>
                                            <div class="invalid-feedback">Please enter your state/province.</div>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-12">
                                            <label for="phoneNumber" class="form-label signup__label">Phone
                                                Number</label>
                                            <input type="text" name="phoneNumber" class="form-control signup__input number-input"
                                                id="phoneNumber" placeholder="Enter your phone number" required>
                                            <div class="invalid-feedback">Please enter a valid 10-digit phone number.
                                            </div>
                                        </div>
                                        <div class="col-12 mt-3">
                                            <label for="signupReferralCode" class="form-label signup__label">Referral
                                                Code</label>
                                            <input type="text" name="signupReferralCode"
                                                class="form-control signup__input" id="signupReferralCode">
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
                                </div>



                                <!-- 2 -->
                                <div id="form2" class="signUp__form--hidden">
                                    <div class="row gap-3 mt-3 ">
                                        <div class="col-12">
                                            <label for="typeOfId" class="form-label signup__label">Select Type of
                                                ID</label>
                                            <select id="typeOfId" name="typeOfId" class="form-select signup__input"
                                                aria-label="Default select example" required>
                                                <option value="" selected disabled>Select an ID type</option>
                                                <option value="Driver's License">Driver's License</option>
                                                <option value="Passport">Passport</option>
                                                <option value="TIN ID">TIN ID</option>
                                                <option value="Senior Citizen">Senior Citizen</option>
                                                <option value="National ID">National ID</option>
                                                <option value="Postal ID">Postal ID</option>
                                                <option value="Voters ID">Voters ID</option>
                                                <option value="Philhealth">Philhealth</option>
                                                <option value="Unified Multi-purpose Id (UMID)">Unified Multi-purpose Id (UMID)</option>
                                                <option value="SSS ID">SSS ID</option>
                                                <option value="PRC ID">PRC ID</option>
                                                <option value="GSIS">GSIS</option>
                                            </select>
                                            <div class="invalid-feedback">Please select type of ID.</div>
                                        </div>
                                        <div class="col-12">
                                            <label for="validId" class="form-label signup__label">Upload Valid
                                                ID</label>
                                            <input type="file" name="validId" class="form-control signup__input"
                                                id="validId" accept="image/*" required disabled>
                                            <div class="invalid-feedback">Please upload a valid ID.</div>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-12">
                                            <label for="tin" class="form-label signup__label">Tax Identification
                                                Number (TIN)</label>
                                            <input type="text" name="tin" class="form-control signup__input number-input" id="tin"
                                                placeholder="Enter your TIN number" required>
                                            <div class="invalid-feedback">Please enter your TIN number.</div>
                                        </div>
                                    </div>
                                    <div class="row mt-3 gap-3">
                                        <div class="col-12">
                                            <label for="account_commission" class="form-label signup__label">Select Bank Account
                                                for
                                                Commission</label>
                                            <select id="account_commission" name="account_commission" class="form-select signup__input"
                                                aria-label="Default select example" required>
                                                <option value="" selected disabled>Select a account type</option>
                                                <option value="Debit Card">Debit Card</option>
                                                <option value="GCash">GCash</option>
                                                <option value="Paymaya">Paymaya</option>
                                            </select>
                                            <div class="invalid-feedback">Please select account type.</div>
                                        </div>
                                    </div>
                                    <div class="row mt-3" id="bank-wrapper" style="display:none;">
                                        <div class="col-12">
                                            <label for="bank_name" class="form-label signup__label">Bank Name</label>
                                            <input type="text" name="bank_name" class="form-control signup__input" id="bank_name"
                                                placeholder="Enter your bank name">
                                            <div class="invalid-feedback">Please enter your bank name.</div>
                                        </div>
                                    </div>
                                    <div class="row mt-3" id="account-wrapper" style="display:none;">
                                        <div class="col-12">
                                            <label for="account_no" class="form-label signup__label">Account Number</label>
                                            <input type="text" name="account_no" class="form-control signup__input number-input" id="account_no"
                                                placeholder="Enter your account number">
                                            <div class="invalid-feedback">Please enter your account number.</div>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-12 mt-3">
                                            <label for="ageConfirmation" class="form-label signup__label">
                                                <input type="checkbox" id="ageConfirmation" name="ageConfirmation"
                                                    required>
                                                I confirm that I am at least 18 years old.
                                            </label>
                                            <div id="ageConfirmation__error"
                                                class="ageConfirmation__error-message ageConfirmation__hidden">You must
                                                confirm that you are at least 18 years old.</div>
                                        </div>
                                    </div>

                                    <div class="col-12 mb-3 mt-5">
                                        <button type="button" class="reseller_signup__next-btn-2">Submit</button>
                                        <button type="button" class="reseller_signup__back-btn-2">Back</button>
                                    </div>
                                </div>
                            </form>
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
<div class="modal fade" id="checkStatus" tabindex="-1" aria-labelledby="login" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content check-status__modal-content">
            <h1 class="check-status__title">Track Your Application Status</h1>
            <p class="check-status__p">Please enter the reference number provided during registration to view the status
                of
                your application. You will be able to see if your application is still under review, approved, or if
                further information is required.</p>

            <form id="checkStatusForm" class="row g-3 mt-4 needs-validation" novalidate>
                <div class="message"></div>
                <div class="col-12">
                    <label for="referenceNumber" class="form-label signup__label">Reference Number</label>
                    <input type="text" class="form-control signup__input" id="referenceNumber"
                        placeholder="Enter your reference number" required>
                    <div class="invalid-feedback">Please enter your reference number.</div>
                </div>
                <div class="col-12" id="reference_status">
                    <!-- AJAX REQUEST -->
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
    var age_confirmation = 0;
    // Sign Up 
    $('.reseller_signup__next-btn-1').on('click', function(event) {
        const $form1 = $('#form1');
        // Validate only the visible fields in Section 1
        const isValid = $('#form1 input').filter('[required]').toArray().every(function(input) {
            return input.checkValidity();
        });

        if (!isValid) {
            event.preventDefault();
            event.stopPropagation();
            $form1.addClass('was-validated');
        } else {
            // Move to Section 2
            $("#form2").removeClass("signUp__form--hidden");
            $("#form1").addClass("signUp__form--hidden");
            $('.auth-page__cta__indicator').text('2/2');
        }
    });

    $('.reseller_signup__next-btn-2').on('click', function(event) {
        event.preventDefault();
        event.stopPropagation();

        const $form2 = $('#form2');
        const $ageConfirmation = $('#ageConfirmation');
        const isAgeConfirmed = $ageConfirmation.is(':checked');

        // Validate only the visible fields in Section 2
        const isValid = $('#form2 input, #form2 select').filter('[required]').toArray().every(function(
            input) {
            return input.checkValidity();
        });

        if (!isValid) {
            event.preventDefault();
            event.stopPropagation();
            if (!isAgeConfirmed) {
                $("#ageConfirmation__error").removeClass('ageConfirmation__hidden');
            } else {
                $("#ageConfirmation__error").addClass('ageConfirmation__hidden');
            }

            $form2.addClass('was-validated');
        } else {
            var form = $('#auth-page__cta__signupForm')[0];
            var formData = new FormData(form);
            formData.append('firstName', $('#firstName').val());
            formData.append('lastName', $('#lastName').val());
            formData.append('signupEmail', $('#signupEmail').val());
            formData.append('streetAddress', $('#streetAddress').val());
            formData.append('brgyAddress', $('#brgyAddress').val());
            formData.append('city', $('#city').val());
            formData.append('stateProvince', $('#stateProvince').val());
            formData.append('phoneNumber', $('#phoneNumber').val());
            formData.append('signupReferralCode', $('#signupReferralCode').val());
            formData.append('typeOfId', $('#typeOfId').val());
            formData.append('validId', $('#validId')[0].files[0]);
            formData.append('tin', $('#tin').val());
            formData.append('account_commission', $('#account_commission').val());
            formData.append('bank_name', $('#bank_name').val());
            formData.append('account_no', $('#account_no').val());
            formData.append('age_confirmation', age_confirmation);
            formData.append('_token', csrf_token_value);

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
                        url: "<?= base_url('reseller/reseller_application/save_application')?>",
                        method: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        dataType: "json",
                        beforeSend: function () {
                            $('.loading-screen').show();
                        },
                        success: function(data) {
                            if (data.error != '') {
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Oops...',
                                    text: data.error,
                                });
                            } else {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Thank you!',
                                    text: data.success,
                                });
                                setTimeout(() => {
                                    location.reload();
                                }, 2000);
                            }
                        },
                        complete: function () {
                            $('.loading-screen').hide();
                        },
                        error: function () {
                            $('.loading-screen').hide();
                            Swal.fire({
                                icon: 'error',
                                title: 'Ooops...',
                                text: 'An error occurred while processing the request.',
                            });
                        }
                    });
                }
            });
        }

    });

    $(".reseller_signup__back-btn-2").on("click", function(event) {
        $("#form1").removeClass("signUp__form--hidden");
        $("#form2").addClass("signUp__form--hidden");
        $('.auth-page__cta__indicator').text('1/2');
    })

    $('#typeOfId').on("change", function(event) {
        if (event.target.value) {
            $('#validId').prop('disabled', false);
        }
    });

    $('#account_commission').on("change", function() {
        var options = $(this).val();
        if (options == "Debit Card") {
            $('#bank-wrapper').fadeIn(200);
            $('#account-wrapper').fadeIn(200);

            $('#bank_name').attr('required', true);
            $('#account_no').attr('required', true);
        } else {
            $('#account-wrapper').fadeIn(200);
            $('#bank-wrapper').hide();

            $('#account_no').attr('required', true);
            $('#bank_name').attr('required', false);
        }
    });

    $('#ageConfirmation').on("change", function(event) {
        const isAgeConfirmed = $(this).is(':checked');

        if (!isAgeConfirmed) {
            $("#ageConfirmation__error").removeClass('ageConfirmation__hidden');
            age_confirmation = 0;
        } else {
            $("#ageConfirmation__error").addClass('ageConfirmation__hidden');
            age_confirmation = 1;
        }
    })

    $('.check-status__btn').on("click", function(event) {
        event.preventDefault();
		event.stopPropagation();

        var form = $('#checkStatusForm')[0];
		var formData = new FormData(form);

        formData.append('referenceNumber', $('#referenceNumber').val());
        formData.append('_token', csrf_token_value);

        form.classList.add('was-validated');
        if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
        } else {
            $.ajax({
                url: "<?= base_url('reseller/reseller_application/track_application_status')?>",
                method: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(data) {
                    if (data.error != '') {
                        $('.message').html(data.error);
                        setTimeout(() => {
                            $('.message').html('');
                        }, 3000);
                    } else {
                        $('#reference_status').html(data.status);
                    }
                },
                error: function () {
                    $('.message').html('<div class="alert alert-danger">An error occurred while processing the request.</div>');
                }
            });
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
