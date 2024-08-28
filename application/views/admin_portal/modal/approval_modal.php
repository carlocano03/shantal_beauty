<!-- Modal -->
<div class="modal fade" id="letterModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"><i class="bi bi-subtract me-2"></i>Approval of Request</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="approvalForm" class="needs-validation" novalidate>
                    <input type="hidden" id="letter_id">
                    <input type="hidden" id="attendance_date">
                    <input type="hidden" id="remarks">
                    <input type="hidden" id="time_in_out">
                    <input type="hidden" id="member_id">
                    <div class="form-group mb-3">
                        <label class="form-label">Request Validation</label>
                        <select name="request_validation" id="request_validation" class="form-select" required>
                            <option value="">Please select validation</option>
                            <option value="Valid Letter">Valid Letter</option>
                            <option value="Invalid Letter">Invalid Letter</option>
                        </select>
                        <div class="invalid-feedback">
                            Please provide a valid request validation.
                        </div>
                    </div>
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Leave a comment here" id="comment" style="height: 100px"></textarea>
                        <label for="comment">Comments</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-square me-2"></i>Close</button>
                <button type="button" class="btn btn-primary" id="approval_explanation_letter"><i class="bi bi-floppy-fill me-2"></i>Save Changes</button>
            </div>
        </div>
    </div>
</div>