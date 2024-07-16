
<div class="loading-screen text-center" style="display: none;">
    <div class="spinner-border text-dark" role="status">

    </div>
</div>

<!-- Content wrapper -->
<div class="content-wrapper">

    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header mb-3">
                <h5><i class="<?= $icon?> me-2"></i><?= $card_title?></h5>
            </div>
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div>
                        <a href="<?= base_url('admin/scholars-record')?>" class="btn btn-outline-dark btn-sm"><i class="bi bi-backspace-fill me-2"></i>Back</a>
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
            var url = "<?= base_url('portal/admin_portal/scholar_request/download_attachment?file=')?>" + filename + '&folder=' + folder;
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