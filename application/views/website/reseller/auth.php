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
                    <div id="card__login" class="auth-page__cta ">
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
                    <div id="card__signup" class="auth-page__cta auth__card--hidden">
                        <div class="auth-page__cta__card">
                            <h1 class="auth-page__cta__card__signup-title">Sign Up</h1>
                            <p class="auth-page__cta__card__signup-sub">Lorem ipsum dolor, sit amet consectetur
                                adipisicing elit. A voluptatum</p>

                            <form id="auth-page__cta__signupForm" class="row g-3 mt-3 needs-validation" novalidate>
                                <div class="col-12">
                                    <label for="signupFullName" class="form-label signup__label">Full Name</label>
                                    <input type="text" class="form-control signup__input" id="signupFullName"
                                        placeholder="Enter your full name" required>
                                    <div class="invalid-feedback">Please enter your full name.</div>
                                </div>
                                <div class="col-12">
                                    <label for="signupAddress" class="form-label signup__label">Address</label>
                                    <input type="text" class="form-control signup__input" id="signupAddress"
                                        placeholder="Enter your address" required>
                                    <div class="invalid-feedback">Please enter your address.</div>
                                </div>

                                <div class="col-12">
                                    <label for="signupPhoneNumber" class="form-label signup__label">Phone Number</label>
                                    <input type="text" class="form-control signup__input" id="signupPhoneNumber"
                                        placeholder="Enter your phone number" required>
                                    <div class="invalid-feedback">Please enter a valid 10-digit phone number.</div>
                                </div>

                                <div class="col-12">
                                    <label for="signupEmail" class="form-label signup__label">Email</label>
                                    <input type="email" class="form-control signup__input" id="signupEmail"
                                        placeholder="Enter your email" required>
                                    <div class="invalid-feedback">Please enter a valid email address.</div>
                                </div>

                                <div class="col-12">
                                    <label for="signupReferralCode" class="form-label signup__label">Referral
                                        Code</label>
                                    <input type="email" class="form-control signup__input" id="signupReferralCode">

                                </div>
                                <div class="col-12 mb-4">
                                    <button type="button" class="reseller_signup__btn">Sign Up</button>
                                </div>

                                <div class="col-12">
                                    <p class="signup__account">
                                        Already have an account? <span class="login__link" type="button"
                                            id="login__link">Login</span>
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</main>

<script>
const resellerSignupBtn = document.querySelector('.reseller_signup__btn');
const resellerLoginBtn = document.querySelector('.reseller_login__btn');

const loginLink = document.getElementById('login__link');
const signupLink = document.getElementById('signup__link');

const cardSignup = document.getElementById('card__signup');
const cardLogin = document.getElementById('card__login');


// Sign Up 
resellerSignupBtn.addEventListener('click', function(event) {

    const form = document.getElementById('auth-page__cta__signupForm');

    if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();
        form.classList.add('was-validated');
        return;
    }

    const formData = new FormData(form);

    // AJAX request 

});

// Log In 
resellerLoginBtn.addEventListener('click', function(event) {

    const form = document.getElementById('auth-page__cta__loginForm');

    if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();
        form.classList.add('was-validated');
        return;
    }

    const formData = new FormData(form);

    // AJAX request 

});



loginLink.addEventListener('click', function(event) {
    cardLogin.classList.remove("auth__card--hidden");
    cardSignup.classList.add("auth__card--hidden");
})
signupLink.addEventListener('click', function(event) {
    cardSignup.classList.remove("auth__card--hidden");
    cardLogin.classList.add("auth__card--hidden");
})
</script>