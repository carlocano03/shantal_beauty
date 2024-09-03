<main>
    <section id="home">
        <header class="py-2">
            <nav class="navbar">
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
                        <button type="button" data-bs-toggle="modal" data-bs-target="#reseller"
                            class="navbar__button__reseller">Reseller</button>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#login"
                            class="navbar__button__shop">Shop
                            Now</button>
                    </div>
                </div>
            </nav>
        </header>
    </section>
</main>

<!-- Modal -->
<div class="modal fade" id="signup" tabindex="-1" aria-labelledby="signup" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-5">
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
<div class="modal fade" id="login" tabindex="-1" aria-labelledby="login" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-5">
            <h1 class="login__greeting">Welcome Back!</h1>
            <h1 class="login__title">Log In to Your Account</h1>
            <p class="login__p">We're glad to see you again! Please enter your details below to log in.</p>

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


<script>
const signUpBtn = document.querySelector('.signup__button');
const loginBtn = document.querySelector('.login__button');

// Sign Up 
signUpBtn.addEventListener('click', function(event) {

    const form = document.getElementById('signupForm');

    if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();
        form.classList.add('was-validated');
        return;
    }

    const formData = new FormData(form);



});

// Login 
loginBtn.addEventListener('click', function(event) {
    const form = document.getElementById('loginForm');

    if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();
        form.classList.add('was-validated');
        return;
    }

    const formData = new FormData(form);

    // AJAX request 
})
</script>