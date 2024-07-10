<main class="bg-primary">
    <div class="wrapper">
        <div class="content">
            <div class="container">
                <div class="d-flex justify-content-center align-items-center" style="width: 100%; height: 100vh">
                    <div class="card p-2 py-5 bg-white" style="width: 30rem; border-radius: 24px">
                        <div class="mx-auto">
                            <img src="<?= base_url('assets/images/checked.png')?>" alt="" width="74" height="74" />
                        </div>
                        <div class="card-body">
                            <h4 class="text-center my-2 pb-2 fw-bold form-title">Congratulations! Your registration was
                                successful.</h4>
                            <hr>
                            <div class="text-center">
                                <a href="<?= base_url();?>" class="btn btn-outline-success px-5 rounded-5">Continue</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<footer class="footer fixed-bottom py-4 bg-primary">
    <div class="container-xxl">
        <div class="d-flex justify-content-between align-items-center">
            <p class="text-white">Copyright All Right Reserved 2024 | Change Life Christian Church</p>

            <div class="d-flex align-items-center gap-4 text-white">
                <p>Terms of Use</p>
                <p>Privacy Policy</p>
                <p>Lorem, ipsum dolor.</p>
            </div>
        </div>
    </div>
</footer>


<script>
$(document).ready(function() {
    setTimeout(() => {
        window.location.href = "<?= base_url()?>";
    }, 3000);
});
</script>