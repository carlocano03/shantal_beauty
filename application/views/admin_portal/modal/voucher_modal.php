<div class="modal fade" id="voucherModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"><i class="bi bi-ticket-detailed-fill me-2"></i>Voucher Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="voucherForm" class="needs-validation" novalidate>
                    <input type="hidden" class="voucher_id">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="form-label fw-bold"><i class="bi bi-ticket-detailed-fill me-2"></i>Voucher Code</div>
                        <div class="form-label voucher_code"></div>
                    </div>
                    <hr class="mt-0 mb-2">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="form-label fw-bold"><i class="bi bi-box-seam-fill me-2"></i>Product Name</div>
                        <div class="form-label product_name"></div>
                    </div>
                    <hr class="mt-0 mb-2">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="form-label fw-bold"><i class="bi bi-wallet me-2"></i>Voucher Amount</div>
                        <div class="form-label voucher_amt"></div>
                    </div>
                    <hr class="mt-0 mb-2">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="form-label fw-bold"><i class="bi bi-calendar-week-fill me-2"></i>End Date</div>
                        <div class="form-label end_date"></div>
                    </div>
                    <hr class="mt-0 mb-2">
                    <div class="form-group mb-3">
                        <label for="desc" class="form-label fw-bold"><i class="bi bi-card-checklist me-2"></i>Description</label>
                        <div style="font-size:13px; text-align:justify;" class="desc"></div>
                    </div>
                    <hr class="mt-0 mb-2">
                    <div class="form-group mb-3">
                        <label for="approval_remarks" class="form-label">Approval Remarks</label>
                        <select name="approval_remarks" id="approval_remarks" class="form-select" required>
                            <option value="">Please choose on the following options</option>
                            <option value="Approved">Approve Voucher</option>
                            <option value="Declined">Decline Voucher</option>
                        </select>
                        <div class="invalid-feedback">
                            Please provide a valid approval remarks.
                        </div>
                    </div>
                    <div class="form-floating comment" style="display:none;">
                        <textarea class="form-control" placeholder="Leave a comment here" id="comment" style="height: 100px"></textarea>
                        <label for="comment">Comment/Remarks</label>
                        <div class="invalid-feedback">
                            Please provide a valid comment/remarks.
                        </div>
                    </div>
                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="voucher_approval">Save Changes</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).on('click', '.view_modal', function() {
        var voucher_id = $(this).data('id');
        var product = $(this).data('product');
        var voucher_code = $(this).data('voucher_code');
        var desc = $(this).data('desc');
        var amount = $(this).data('amt');
        var end_date = $(this).data('end_date');

        $('.voucher_id').val(voucher_id);
        $('.voucher_code').text(voucher_code);
        $('.product_name').text(product);
        $('.voucher_amt').text('₱'+amount);
        $('.end_date').text(end_date);
        $('.desc').text(desc);
        $('#voucherModal').modal('show');
    });

    $(document).on('change', '#approval_remarks', function() {
        var remarks = $(this).val();

        if (remarks == 'Declined') {
            $('.comment').fadeIn(200);
            $('#comment').attr('required', true);
        } else {
            $('.comment').hide();
            $('#comment').attr('required', false);
        }
    });
</script>