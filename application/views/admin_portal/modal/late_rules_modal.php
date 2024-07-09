<!-- Modal -->
<div class="modal fade" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"><i class="bi bi-person-fill-add me-2"></i>Add New Late Rules</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addForm" class="needs-validation" novalidate>
                    <div class="form-group mb-3">
                        <label for="rule_name" class="form-label">Rule Name</label>
                        <input type="text" class="form-control" id="rule_name" autocomplete="off" required>
                        <div class="invalid-feedback">
                            Please provide a valid rule name.
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="no_late" class="form-label">Number of consecutive lates</label>
                        <input type="text" class="form-control number-input" id="no_late" autocomplete="off" required>
                        <div class="invalid-feedback">
                            Please provide a valid number of consecutive lates.
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="no_days" class="form-label">Number of days (Late Range)</label>
                        <input type="text" class="form-control number-input" id="no_days" autocomplete="off" required>
                        <div class="invalid-feedback">
                            Please provide a valid number of days.
                        </div>
                    </div>
                </form>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-square me-2"></i>Close</button>
                <button type="button" class="btn btn-primary" id="save_rules"><i class="bi bi-floppy-fill me-2"></i>Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="updateModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"><i class="bi bi-person-fill-add me-2"></i>Update Late Rules</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updateForm" class="needs-validation" novalidate>
                    <input type="hidden" id="late_rule_id">
                    <div class="form-group mb-3">
                        <label for="edit_rule_name" class="form-label">Rule Name</label>
                        <input type="text" class="form-control" id="edit_rule_name" autocomplete="off" required>
                        <div class="invalid-feedback">
                            Please provide a valid rule name.
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="edit_no_late" class="form-label">Number of consecutive lates</label>
                        <input type="text" class="form-control number-input" id="edit_no_late" autocomplete="off" required>
                        <div class="invalid-feedback">
                            Please provide a valid number of consecutive lates.
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="edit_no_days" class="form-label">Number of days (Late Range)</label>
                        <input type="text" class="form-control number-input" id="edit_no_days" autocomplete="off" required>
                        <div class="invalid-feedback">
                            Please provide a valid number of days.
                        </div>
                    </div>
                </form>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-square me-2"></i>Close</button>
                <button type="button" class="btn btn-primary" id="update_rules"><i class="bi bi-floppy-fill me-2"></i>Save changes</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).on('click', '#update_rule', function() {
        var late_rule_id = $(this).data('id');
        var rule_name = $(this).data('rule_name');
        var no_late = $(this).data('no_late');
        var no_days = $(this).data('no_days');

        $('#edit_rule_name').val(rule_name);
        $('#edit_no_late').val(no_late);
        $('#edit_no_days').val(no_days);
        $('#late_rule_id').val(late_rule_id);

        $('#updateModal').modal('show');
    });
</script>