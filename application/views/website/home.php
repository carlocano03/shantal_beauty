<main>
    <div id="home">
        <header class="py-2">
            <nav class="navbar d-none d-lg-block">
                <div class="navbar__container container">
                    <div class="navbar__right">
                        <img class="navbar__logo" src="<?php echo base_url('assets/images/home/shantal-logo.png'); ?>"
                            alt="Shantal Beauty">
                        <ul class="navbar__items">
                            <li class="navbar__item"><a href="#" class="nav-active">Home</a></li>
                            <li class="navbar__item"><a href="/about">About</a></li>
                            <li class="navbar__item"><a href="/product">Product</a></li>
                            <li class="navbar__item"><a href="/mission-vision">Mission & Vision</a></li>
                            <li class="navbar__item"><a href="/contact">Contact Us</a></li>
                        </ul>
                    </div>
                    <div class="d-flex gap-4">
                        <a href="<?php echo base_url('/reseller'); ?>" class="navbar__button__reseller">
                            Reseller
                        </a>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#login"
                            class="navbar__button__shop">Shop
                            Now</button>
                    </div>
                </div>
            </nav>
        </header>
        <section class="home-section">
            <div class="container">
                <div class="row home-section__row gap-x-lg-5 align-items-lg-center">
                    <div class="col-lg-6 col-12 d-lg-block d-flex flex-column align-items-center">
                        <div class="home-section__text-top">Uncover Your Beauty With</div>
                        <h1 class="home-section__title-1">Shantal's</h1>
                        <h1 class="home-section__title-2">Beauty & Wellness</h1>
                        <p class="home-section__p">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Porro vel
                            laudantium, accusantium,
                            necessitatibus incidunt alias molestiae ducimus doloribus voluptatibus cupiditate
                            exercitationem
                            veritatis in et ratione debitis laboriosam possimus, quisquam esse?</p>
                        <button class="home-section__button" type="button"><i class="bi bi-cart2"></i> Order
                            Now</button>
                    </div>
                    <div class="col-lg-6 col-12 d-flex align-items-center justify-content-center"
                        style="position:relative">
                        <img class="home-section__sparkling-1"
                            src="<?php echo base_url('assets/images/home/sparkling.webp'); ?>" alt="Sparkling">
                        <img class="home-section__sparkling-2"
                            src="<?php echo base_url('assets/images/home/sparkling.webp'); ?>" alt="Sparkling">
                        <div class="home-section__img-wrapper">
                            <img class="home-section__img"
                                src="<?php echo base_url('assets/images/home/shantal-pic-1.webp'); ?>"
                                alt="Shantal Beauty">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <img class="home-section__ellipse-1" src="<?php echo base_url('assets/images/home/ellipse.png'); ?>"
            alt="Ellipse">
        <img class="home-section__ellipse-2" src="<?php echo base_url('assets/images/home/ellipse.png'); ?>"
            alt="Ellipse">
    </div>
</main>

<!-- Modal -->
<div class="modal fade" id="signup" data-bs-backdrop="static" tabindex="-1" aria-labelledby="signup" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content signup_modal-content">
            <h1 class="signup__title">Sign up</h1>
            <p class="signup__p">Enter your details below to create your account and get started.</p>

            <form id="signupForm" class="row g-3 mt-3 needs-validation" novalidate>
                <div class="col-12">
                    <label for="signupFullName" class="form-label signup__label">Full Name</label>
                    <input type="text" class="form-control signup__input" id="signupFullName"
                        placeholder="Enter your full name" required>
                    <div class="invalid-feedback">Please enter your full name.</div>
                </div>

                <div class="col-12">
                    <label for="signupAddress" class="form-label signup__label">Complete Address</label>
                    <input type="text" class="form-control signup__input" id="signupAddress"
                        placeholder="Enter your complete address" required>
                    <div class="invalid-feedback">Please enter your complete address.</div>
                </div>

                <div class="col-12">
                    <label for="signupPhoneNumber" class="form-label signup__label">Mobile Number</label>
                    <input type="text" class="form-control signup__input number-input" id="signupPhoneNumber"
                        placeholder="Enter your phone number" required>
                    <div class="invalid-feedback">Please enter a valid 10-digit phone number.</div>
                </div>

                <div class="col-12">
                    <label for="signupEmail" class="form-label signup__label">Email Address</label>
                    <input type="email" class="form-control signup__input" id="signupEmail"
                        placeholder="Enter your email address" required>
                    <div class="invalid-feedback">Please enter a valid email address.</div>
                </div>

                <div class="col-12">
                    <label for="signupPassword" class="form-label signup__label">Password</label>
                    <input type="password" class="form-control signup__input" id="signupPassword"
                        placeholder="Enter your password" required>
                    <div class="invalid-feedback">Please enter a valid password.</div>
                </div>

                <div class="col-12 mb-4">
                    <button type="button" class="signup__button">Sign Up</button>
                </div>

                <hr>
                <div class="col-12">
                    <p class="signup__account">
                        Already have an account? <span class="login__link" type="button" data-bs-toggle="modal"
                            data-bs-target="#login">Login</span>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="login" data-bs-backdrop="static" tabindex="-1" aria-labelledby="login" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content login_modal-content">
            <h1 class="login__greeting">Welcome Back!</h1>
            <h1 class="login__title">Log In to Your Account</h1>
            <p class="login__p">We're glad to see you again! Please enter your details below to log in.</p>

            <div class="error-message"></div>
            <form id="loginForm" class="row g-3 mt-3 needs-validation" novalidate>
                <div class="col-12">
                    <label for="loginEmail" class="form-label login__label">Email</label>
                    <input type="email" class="form-control login__input" id="loginEmail" placeholder="Enter your email"
                        required>
                    <div class="invalid-feedback">Please enter a valid email address.</div>
                </div>

                <div class="col-12">
                    <label for="loginPassword" class="form-label login__label">Password</label>
                    <input type="password" class="form-control login__input" id="loginPassword"
                        placeholder="Enter your password" required>
                    <div class="invalid-feedback">Your password is required</div>
                </div>

                <div class="col-12 mb-4">
                    <button type="button" class="login__button">Sign In</button>
                </div>

                <hr>
                <div class="col-12">
                    <p class="login__account">
                        Dont have an account? <span type="button" class="signup__link" data-bs-toggle="modal"
                            data-bs-target="#signup">Sign
                            up</span>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="otpModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="login"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content login_modal-content">
            <h1 class="login__title">Email Verification</h1>
            <p class="login__p">Please check your email to get the OTP to verify your account.</p>
            <hr>
            <div class="message"></div>
            <div class="col-12">
                <input type="text" class="form-control login__input" id="otp_number" placeholder="Enter OTP Number">
            </div>

            <div class="col-12 mb-4">
                <button type="button" class="verify__button">Verify Account</button>
            </div>
            <hr>
            <div class="col-12">
                <p class="login__account">
                    Didn't receive the OTP? <span type="button" class="signup__link" id="resend_otp">Resend OTP</span>
                </p>
            </div>
        </div>
    </div>
</div>

<div class="loading-screen text-center" style="display: none;">
    <div class="spinner-border text-dark" role="status">

    </div>
</div>

<script>
// Sign Up 
$(document).ready(function() {
    var user_details_id = 0;
    var email_address = '';

    $(document).on('click', '.signup__button', function(event) {
        event.preventDefault();
        event.stopPropagation();

        var form = $('#signupForm')[0];
        var formData = new FormData(form);
        formData.append('full_name', $('#signupFullName').val());
        formData.append('complete_address', $('#signupAddress').val());
        formData.append('contact_no', $('#signupPhoneNumber').val());
        formData.append('email_address', $('#signupEmail').val());
        formData.append('password', $('#signupPassword').val());
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
                        url: "<?= base_url('shop/login_process/signup_user')?>",
                        method: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        dataType: "json",
                        beforeSend: function() {
                            $('.loading-screen').show();
                        },
                        success: function(data) {
                            if (data.error != '') {
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Ooops...',
                                    text: data.error,
                                });
                            } else {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Thank You!',
                                    text: data.success,
                                });
                                $('#signup').modal('hide');
                                form.reset();
                                form.classList.remove('was-validated');

                                user_details_id = data.user_details_id;
                                email_address = data.email_address;
                                //Email OTP
                                $('#otpModal').modal('show');
                            }
                        },
                        complete: function() {
                            $('.loading-screen').hide();
                        },
                        error: function() {
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

    $(document).on('click', '.verify__button', function() {
        var otp_no = $('#otp_number').val();

        if (otp_no != '') {
            $.ajax({
                url: "<?= base_url('shop/login_process/verify_account')?>",
                method: "POST",
                data: {
                    user_details_id: user_details_id,
                    email_address: email_address,
                    otp_no: otp_no,
                    '_token': csrf_token_value,
                },
                dataType: "json",
                success: function(data) {
                    if (data.error != '') {
                        $('.message').html(data.error);
                        setTimeout(() => {
                            $('.message').html('');
                        }, 3000);
                    } else {
                        $('.message').html(data.success);
                        setTimeout(() => {
                            $('.message').html('');
                            $('#otp_number').val('');
                            $('#login').modal('show');
                            $('#otpModal').modal('hide');
                        }, 3000);

                    }
                },
                error: function() {
                    $('.message').html(
                        '<div class="alert alert-danger"><i class="bi bi-info-circle-fill me-2"></i>An error occurred while processing the request.</div>'
                    );
                    setTimeout(() => {
                        $('.message').html('');
                    }, 3000);
                }
            });
        } else {
            $('.message').html(
                '<div class="alert alert-danger"><i class="bi bi-info-circle-fill me-2"></i>Please provide a valid OTP.</div>'
            );
            setTimeout(() => {
                $('.message').html('');
            }, 3000);
        }
    });

    function handleLogin() {
        var form = $('#loginForm')[0];
        var formData = new FormData(form);

        formData.append('username', $('#loginEmail').val());
        formData.append('password', $('#loginPassword').val());
        formData.append('_token', csrf_token_value);

        form.classList.add('was-validated');
        if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
        } else {
            $.ajax({
                url: "<?= base_url('shop/login_process/login');?>",
                method: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "json",
                beforeSend: function() {
                    $('.loading-screen').show();
                },
                success: function(data) {
                    if (data.error != '') {
                        $('.error-message').html(data.error);
                        setTimeout(function() {
                            $('.error-message').html('');
                        }, 3000)
                    } else {
                        $('.error-message').html(data.success);
                        setTimeout(function() {
                            $('.error-message').html('');
                            window.location.href = data.main_url;
                        }, 3000);
                    }
                },
                complete: function() {
                    $('.loading-screen').hide();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("AJAX request failed:", textStatus, errorThrown);
                    $('.error-message').html(
                        '<div class="alert alert-danger p-2 text-dark text-sm">An error occurred while processing the request.</div>'
                    );
                }
            });
        }
    }

    $(document).on('click', '.login__button', function(event) {
        event.preventDefault();
        event.stopPropagation();
        handleLogin();
    });

    $(document).on('keypress', '#loginPassword', function(event) {
        if (event.which === 13) {
            event.preventDefault();
            event.stopPropagation();
            handleLogin();
        }
    });
});
</script>