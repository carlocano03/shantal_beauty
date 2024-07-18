<style>
.table__title {
    font-size: 20px;
    font-weight: 500;
    color: #434875 !important;
    padding: 8px 0;
    margin-bottom: 0;

}

.card {
    background: #ffffff;
    border-radius: 8px;
    color: #434875;
    box-shadow: 0 9px 20px rgba(46, 35, 94, .07);
}
</style>
<div class="loading-screen text-center" style="display: none;">
    <div class="spinner-border text-dark" role="status">

    </div>
</div>

<!-- Content wrapper -->
<div class="content-wrapper">

    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header mb-3 pb-3 d-flex align-items-center gap-2 ">
                <img src="<?php echo base_url('assets/images/student-info.png'); ?>" width="36px" alt="Calendar" />
                <h5 class="table__title"><?= $card_title?></h5>
            </div>
            <div class="card-body mt-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div>
                        <a href="<?= base_url('admin/scholars-record')?>" class="btn btn-outline-dark btn-sm"><i
                                class="bi bi-backspace-fill me-2"></i>Back</a>
                    </div>
                </div>

                <?php $this->load->view('admin_portal/form/student_information_form')?>
            </div>
        </div>
    </div>
    <!-- / Content -->

    <script>
    $(document).on('click', '.download', function() {
        var filename = $(this).data('file');
        var folder = $(this).data('folder');

        if (filename != '') {
            var url = "<?= base_url('portal/admin_portal/scholar_request/download_attachment?file=')?>" +
                filename + '&folder=' + folder;
            window.location.href = url;
        } else {
            Swal.fire({
                icon: 'warning',
                title: 'Ooops...',
                text: 'No attachment found.',
            });
        }
    });
    </script>