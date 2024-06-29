<div id="login">
    <div class="login__card">
        <div class="d-flex flex-column  align-items-center mb-4">
            <img class="login__logo" src="<?php echo base_url('assets/images/home/clc.jpg'); ?>" alt="">
            <h1 class="login__title">STUDENT UNITY PORTAL SYSTEM </h1>
        </div>
        <form class="form d-flex flex-column mt-5" style="gap:32px;">
            <div class="form-group">
                <input type="text" id="username" class="input input-second-step" required>
                <label for="username" class="label">Username</label>
            </div>
            <div class="form-group">
                <input type="text" id="password" class="input input-second-step" required>
                <label for="password" class="label">Password</label>
            </div>
            <div class="d-flex justify-content-end">
                <p class="text-primary login__forgot-password">Forgot Password?</p>
            </div>
            <button type="submit" class="login__btn mt-4">Log in</button>
        </form>
    </div>
</div>