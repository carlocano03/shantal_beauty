<!-- Modal -->
<div class="modal fade" id="updateModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"><i class="bi bi-person-check me-2"></i>Validate Letter</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updateForm" class="needs-validation" novalidate>
                    <div class="form-group mb-3">
                        <label for="validation" class="form-label">Validation Remarks</label>
                        <select name="validation" id="validation" class="form-select" required>
                            <option value="">Choose validation remarks</option>
                            <option value="Valid">Valid Letter</option>
                            <option value="Invalid">Invalid Letter</option>
                        </select>
                        <div class="invalid-feedback">
                            Please provide a valid remarks.
                        </div>
                    </div>
                </form>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-square me-2"></i>Close</button>
                <button type="button" class="btn btn-primary" id="save_validation"><i class="bi bi-floppy-fill me-2"></i>Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="brokenModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"><i class="bi bi-calendar2-plus me-2"></i>Apply Broken Schedule</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="brokenForm" class="needs-validation" novalidate>
                    <input type="hidden" id="selected_sched_id">
                    <input type="hidden" id="member_id">
                    <div class="form-group mb-3">
                        <label for="validation" class="form-label">Schedule (Time From)</label>
                        <input type="time" class="form-control" id="broken_sched">
                        <div class="invalid-feedback">
                            Please provide a valid time.
                        </div>
                    </div>
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Leave a comment here" id="comment" style="height: 100px" required></textarea>
                        <label for="comment">Comments</label>
                        <div class="invalid-feedback">
                            Please provide a valid comment.
                        </div>
                    </div>
                </form>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-square me-2"></i>Close</button>
                <button type="button" class="btn btn-primary" id="save_broken_sched"><i class="bi bi-floppy-fill me-2"></i>Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="viewModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"><i class="bi bi-calendar2-plus me-2"></i>View Broken Schedule</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex align-items-center justify-content-between" style="font-size:14px;">
                    <div class="fw-bold">Remarks:</div>
                    <div id="remarks"></div>
                </div>
                <hr>
                <div class="d-flex align-items-center justify-content-between" style="font-size:14px;">
                    <div class="fw-bold">Date Change:</div>
                    <div id="date_change"></div>
                </div>
                <hr>
                <div class="d-flex align-items-center justify-content-between" style="font-size:14px;">
                    <div class="fw-bold">Comment:</div>
                </div>
                <span id="comment_section"></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-square me-2"></i>Close</button>
            </div>
        </div>
    </div>
</div>