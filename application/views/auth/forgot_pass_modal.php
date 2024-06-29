<!-- modalPermission -->
<div class="modal fade" id="forgotModal" data-bs-backdrop="static">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-user-lock me-2"></i>Reset Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="custom-message"></div>
                <div class="form-group">
                    <input type="text" class="form-control" id="reset_pass" name="email-username" 
                        placeholder="Enter your email or username" autofocus required/>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="reset_password">Reset Password</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).on('input', '#reset_pass', function() {
        var username = $(this).val();
        $.ajax({
            url: "<?= base_url('admin_crm/login_admin/check_user');?>",
            method: "POST",
            data: {
                username: username,
                '_token': csrf_token_value
            },
            dataType: "json",
            success: function(data) {
                if (data.error != '') {
                    $('.custom-message').html(data.error);
                    $('#reset_password').attr('disabled', true);
                } else {
                    $('.custom-message').html('');
                    $('#reset_password').attr('disabled', false);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("AJAX request failed:", textStatus, errorThrown);
                $('.custom-message').html('<div class="alert alert-danger p-2 text-dark text-sm">An error occurred while processing the request.</div>');
            }
        });
    });

    $(document).on('click', '#reset_password', function() {
        var username = $('#reset_pass').val();

        if (username != '') {
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
                        url: "<?= base_url('admin_crm/login_admin/reset_password');?>",
                        method: "POST",
                        data: {
                            username: username,
                            '_token': csrf_token_value
                        },
                        dataType: "json",
                        beforeSend: function() {
                            $('.loading-screen').show();
                        },
                        success: function(data) { 
                            if (data.error != '') {
                                $('.custom-message').html(data.error);
                                setTimeout(function() {
                                    $('.custom-message').html('');
                                }, 3000)
                            } else {
                                $('.custom-message').html(data.success);
                                setTimeout(function() {
                                    $('.custom-message').html('');
                                    $('#forgotModal').modal('hide');
                                }, 3000);
                            }
                        },
                        complete: function() {
                            $('.loading-screen').hide();
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.error("AJAX request failed:", textStatus, errorThrown);
                            $('.custom-message').html('<div class="alert alert-danger p-2 text-dark text-sm">An error occurred while processing the request.</div>');
                        }
                    });
                }
            });
        } else {
            $('.custom-message').html('<div class="alert alert-danger p-2 text-dark text-sm">Please provide a valid username/email</div>');
        }
    });
</script>