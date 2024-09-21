<div class="modal fade" id="voucherModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"><i class="bi bi-ticket-detailed me-2"></i>Create New Voucher</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addForm" class="needs-validation" novalidate>
                    <div class="form-group mb-3">
                        <label for="voucher" class="form-label">Voucher Code</label>
                        <input type="text" class="form-control" id="voucher" required>
                        <div class="invalid-feedback">
                            Please provide a valid voucher code.
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" placeholder="Leave a description here" id="vocher_desc" style="height: 100px" required></textarea>
                        <label for="vocher_desc">Voucher Description</label>
                        <div class="invalid-feedback">
                            Please provide a valid voucher description.
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group mb-3">
                                <label for="voucher_amt" class="form-label">Voucher Amount</label>
                                <input type="text" class="form-control amount-input" id="voucher_amt" required>
                                <div class="invalid-feedback">
                                    Please provide a valid voucher amount.
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group mb-3">
                                <label for="end_date" class="form-label">End Date</label>
                                <input type="date" class="form-control" id="end_date" required>
                                <div class="invalid-feedback">
                                    Please provide a valid end date.
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="save_voucher">Save Changes</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="updateModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"><i class="bi bi-ticket-detailed me-2"></i>Update Voucher Info</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updateForm" class="needs-validation" novalidate>
                    <input type="hidden" id="voucher_id">
                    <div class="form-group mb-3">
                        <label for="edit_voucher" class="form-label">Voucher Code</label>
                        <input type="text" class="form-control" id="edit_voucher" required>
                        <div class="invalid-feedback">
                            Please provide a valid voucher code.
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" placeholder="Leave a description here" id="edit_vocher_desc" style="height: 100px" required></textarea>
                        <label for="edit_vocher_desc">Voucher Description</label>
                        <div class="invalid-feedback">
                            Please provide a valid voucher description.
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group mb-3">
                                <label for="edit_voucher_amt" class="form-label">Voucher Amount</label>
                                <input type="text" class="form-control amount-input" id="edit_voucher_amt" required>
                                <div class="invalid-feedback">
                                    Please provide a valid voucher amount.
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group mb-3">
                                <label for="edit_end_date" class="form-label">End Date</label>
                                <input type="date" class="form-control" id="edit_end_date" required>
                                <div class="invalid-feedback">
                                    Please provide a valid end date.
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="update_voucher">Save Changes</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).on('click', '.update_modal', function() {
        var voucher_id = $(this).data('id');
        var voucher_code = $(this).data('voucher_code');
        var desc = $(this).data('desc');
        var amt = $(this).data('amt');
        var end_date = $(this).data('end_date');

        $('#voucher_id').val(voucher_id);
        $('#edit_vocher_desc').val(desc);
        $('#edit_voucher').val(voucher_code);
        $('#edit_voucher_amt').val(amt);
        $('#edit_end_date').val(end_date);
        
        $('#updateModal').modal('show');
    });
</script>