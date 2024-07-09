<?php
    $application_id = $this->cipher->decrypt($this->input->get('application'));
?>
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
                        <a href="<?= base_url('admin/scholarship-approval')?>" class="btn btn-outline-dark btn-sm"><i class="bi bi-backspace-fill me-2"></i>Back</a>
                    </div>

                    <?php if(isset($application['application_status']) && $application['application_status'] == 'For Approval') : ?>
                        <div class="text-end">
                            <button class="btn btn-primary btn-sm approve_request"><i class="bi bi-box-arrow-right me-2"></i>Approve Request</button>
                            <button class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#declineModal"><i class="bi bi-x-square-fill me-2"></i>Decline Request</button>
                        </div>
                    <?php else :?>
                        <div class="text-end">
                            <?php if(isset($application['application_status']) && $application['application_status'] == 'Approved') : ?>
                                <div class="fw-bold">Application Status: <span class="badge bg-success"><i class="bi bi-check2-square me-1"></i><?= isset($application['application_status']) ? $application['application_status'] : '';?></span></div>
                            <?php else : ?>
                                <div class="fw-bold">Application Status: <span class="badge bg-danger"><i class="bi bi-x-circle me-1"></i><?= isset($application['application_status']) ? $application['application_status'] : '';?></span></div>
                            <?php endif; ?>
                            
                        </div>
                    <?php endif; ?>
                    
                </div>

                <?php $this->load->view('admin_portal/form/scholar_registration_form')?>
            </div>
        </div>
    </div>
    <!-- / Content -->
<?php $this->load->view('admin_portal/modal/decline_modal')?>

<script>
    var application_id = '<?= $application_id?>';

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

    $(document).on('click', '.approve_request', function() {
        Swal.fire({
            title: 'Are you sure..',
            text: "You want to activate this account?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, continue',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= base_url('portal/admin_portal/scholar_request/approve_request')?>",
                    method: "POST",
                    data: {
                        application_id: application_id,
                        action: 'Approved',
                        '_token': csrf_token_value,
                    },
                    dataType: "json",
                    beforeSend: function() {
						$('.loading-screen').show();
					},
                    success: function(data) {
                        if (data.error != '') {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Oops...',
                                text: data.error,
                            }); 
                        } else {
                            Swal.fire({
                                icon: 'success',
                                title: 'Thank you!',
                                text: data.success,
                            });
                            setTimeout(() => {
								window.location.href = '<?= base_url('admin/scholarship-approval')?>';
							}, 1000);
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
    });

    $(document).on('click', '#decline_request', function() {
        var comment = $('#comment').val();

        if (comment != '') {
            Swal.fire({
                title: 'Are you sure..',
                text: "You want to activate this account?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, continue',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?= base_url('portal/admin_portal/scholar_request/approve_request')?>",
                        method: "POST",
                        data: {
                            application_id: application_id,
                            comment: comment,
                            action: 'Declined',
                            '_token': csrf_token_value,
                        },
                        dataType: "json",
                        beforeSend: function() {
                            $('.loading-screen').show();
                        },
                        success: function(data) {
                            if (data.error != '') {
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Oops...',
                                    text: data.error,
                                }); 
                            } else {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Thank you!',
                                    text: data.success,
                                });
                                setTimeout(() => {
                                    window.location.href = '<?= base_url('admin/scholarship-approval')?>';
                                }, 1000);
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
        } else {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Please provide a valid comment.',
            }); 
        }
    });
</script>