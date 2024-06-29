<style>
    .loading-screen {
        overflow: hidden;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.8);
        /* background-color: #fff; */
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
        /* Make sure it appears on top of other elements */
    }
</style>
<div class="loading-screen text-center">
    <div class="spinner-border text-dark" role="status">
            <span class="visually-hidden">Loading...</span>
    </div>
</div>

<div id="login">
    <div class="login__card">
        <div class="d-flex flex-column  align-items-center mb-4">
            <img class="login__logo" src="<?php echo base_url('assets/images/home/clc.jpg'); ?>" alt="">
            <h1 class="login__title">STUDENT UNITY PORTAL SYSTEM </h1>
        </div>
        <div class="error-message"></div>
        <form class="form d-flex flex-column needs-validation mt-2" id="loginForm" style="gap:32px;" novalidate>
            <div class="form-group">
                <input type="text" id="username" class="input input-second-step" required>
                <label for="username" class="label">Username</label>
                <div class="invalid-feedback">
                    Please provide a valid username.
                </div>
            </div>
            <div class="form-group">
                <input type="password" id="password" class="input input-second-step" required>
                <label for="password" class="label">Password</label>
                <div class="invalid-feedback">
                    Please provide a valid password.
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <p class="text-primary login__forgot-password" href="#forgotModal" data-bs-toggle="modal">Forgot Password?</p>
            </div>
            <button type="button" class="login__btn" id="login_btn">Log in</button>
        </form>
    </div>
</div>

<?php $this->load->view('auth/forgot_pass_modal');?>

<script>
    $(document).ready(function() {
        setTimeout(() => {
            $('.loading-screen').fadeOut(500);
            $('body').css('overflow', 'auto');
        }, 1500);

        function handleLogin() {
            var form = $('#loginForm')[0];
            var formData = new FormData(form);

            formData.append('username', $('#username').val());
            formData.append('password', $('#password').val());
            formData.append('_token', csrf_token_value);

            form.classList.add('was-validated');
            if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
            } else {
                Swal.fire({
                    title: 'Are you sure..',
                    text: "You want to continue with the login?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, continue',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "<?= base_url('main/login_process');?>",
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
                                $('.error-message').html('<div class="alert alert-danger p-2 text-dark text-sm">An error occurred while processing the request.</div>');
                            }
                        });
                    }
                });
            }
        }

        $(document).on('click', '#login_btn', function(event) {
            event.preventDefault();
            event.stopPropagation();
            handleLogin();
        });

        $(document).on('keypress', '#password', function(event) {
            if (event.which === 13) {
                event.preventDefault();
                event.stopPropagation();
                handleLogin();
            }
        });
    });
</script>