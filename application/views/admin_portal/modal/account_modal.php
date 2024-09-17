<!-- Modal -->
<div class="modal fade" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"><i class="bi bi-person-fill-add me-2"></i>Add New Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger"><i class="bi bi-info-circle-fill me-2"></i>Admin Staff Account</div>
                <form id="userForm" class="needs-validation" novalidate>
                    <div class="form-group mb-3">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="first_name" autocomplete="off" required>
                        <div class="invalid-feedback">
                            Please provide a valid first name.
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="middle_name" class="form-label">Middle Name</label>
                        <input type="text" class="form-control" id="middle_name" autocomplete="off">
                    </div>
                    <div class="form-group mb-3">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="last_name" autocomplete="off" required>
                        <div class="invalid-feedback">
                            Please provide a valid last name.
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="email_add" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email_add" autocomplete="off" required>
                        <div class="invalid-feedback">
                            Please provide a valid email address.
                        </div>
                    </div>
                </form>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-square me-2"></i>Close</button>
                <button type="button" class="btn btn-primary" id="save_account"><i class="bi bi-floppy-fill me-2"></i>Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="updateModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"><i class="bi bi-person-fill-add me-2"></i>Update Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger"><i class="bi bi-info-circle-fill me-2"></i>Admin Staff Account</div>
                <form id="updateForm" class="needs-validation" novalidate>
                    <input type="hidden" id="user_id">
                    <div class="form-group mb-3">
                        <label for="edit_first_name" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="edit_first_name" autocomplete="off" required>
                        <div class="invalid-feedback">
                            Please provide a valid first name.
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="edit_middle_name" class="form-label">Middle Name</label>
                        <input type="text" class="form-control" id="edit_middle_name" autocomplete="off">
                    </div>
                    <div class="form-group mb-3">
                        <label for="edit_last_name" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="edit_last_name" autocomplete="off" required>
                        <div class="invalid-feedback">
                            Please provide a valid last name.
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="edit_email_add" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="edit_email_add" autocomplete="off" required>
                        <div class="invalid-feedback">
                            Please provide a valid email address.
                        </div>
                    </div>
                </form>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-square me-2"></i>Close</button>
                <button type="button" class="btn btn-primary" id="edit_account"><i class="bi bi-floppy-fill me-2"></i>Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- modalPermission -->
<div class="modal fade" id="modalPermission" style="z-index:9999" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="bi bi-person-plus-fill me-2"></i>Add Permissions</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="success-message"></div>
                <div class="permission-list mt-2">
                    <table class="table" width="100%" id="table_permission">
                        <thead>
                            <tr>
                                <th>Permission</th>
                                <th class="text-center" width="15%">Access</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).on('click', '.update_account', function() {
        var user_id = $(this).data('id');
        var fname = $(this).data('fname');
        var mname = $(this).data('mname');
        var lname = $(this).data('lname');
        var email = $(this).data('email');

        $('#user_id').val(user_id);
        $('#edit_first_name').val(fname);
        $('#edit_middle_name').val(mname);
        $('#edit_last_name').val(lname);
        $('#edit_email_add').val(email);

        $('#updateModal').modal('show');
    });

</script>
