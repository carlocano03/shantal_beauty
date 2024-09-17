<!-- Footer -->
<footer class="content-footer footer bg-footer-theme">
    <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
        <div class="mb-2 mb-md-0">
            Copyright © All Right Reserved
            <script>
            document.write(new Date().getFullYear());
            </script>
            | 
            <a href="#" target="_blank" class="footer-link fw-bolder">Shantal Beauty and Wellness</a>
        </div>
    </div>
</footer>
<!-- / Footer -->

<div class="content-backdrop fade"></div>
</div>
<!-- Content wrapper -->
</div>
<!-- / Layout page -->
</div>

<!-- Overlay -->
<div class="layout-overlay layout-menu-toggle"></div>
</div>
<!-- / Layout wrapper -->


<script src="<?= base_url('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js');?>"></script>

<script src="<?= base_url('assets/vendor/js/menu.js');?>"></script>
<!-- endbuild -->

<!-- Vendors JS -->
<script src="<?= base_url('assets/vendor/libs/apex-charts/apexcharts.js');?>"></script>

<!-- Main JS -->
<script src="<?= base_url('assets/js/main.js');?>"></script>

<!-- Page JS -->
<!-- <script src="<?= base_url('assets/js/dashboards-analytics.js');?>"></script> -->

<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>

<script>
    function sidebarCount() {
        $.ajax({
            url: "<?= base_url('admin_portal/main/get_sidebar_count')?>",
            method: "GET",
            dataType: "json",
            success: function(data) {
                if (data.application_request > 0) {
                    $('.application_request').text(data.application_request);
                } else {
                    $('.application_request').text('');
                }

                if (data.application_request > 0) {
                    $('.reseller_request').text(data.reseller_request);
                } else {
                    $('.reseller_request').text('');
                }
                
            }
        });
    }
    $(document).ready(function() {
        sidebarCount();

        setInterval(() => {
            sidebarCount();
        }, 5000);
    });
</script>