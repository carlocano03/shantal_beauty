<main>
    <section id="home">
        <header class="py-2">
            <nav class="navbar">
                <div class="navbar__container container">
                    <div class="navbar__right">
                        <img class="navbar__logo" src="<?php echo base_url('assets/images/home/shantal-logo.png'); ?>"
                            alt="Shantal Beauty">
                    </div>
                    <div class="d-flex gap-4">
                        <h1>Sample</h1>
                    </div>
                </div>
            </nav>
        </header>
    </section>
</main>

<script>
const resellerSignupBtn = document.querySelector('.reseller-signup__button');
const resellerLoginBtn = document.querySelector('.reseller-login__button');

// Sign Up 
resellerSignupBtn.addEventListener('click', function(event) {

    const form = document.getElementById('signupForm');

    if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();
        form.classList.add('was-validated');
        return;
    }

    const formData = new FormData(form);



});
</script>
