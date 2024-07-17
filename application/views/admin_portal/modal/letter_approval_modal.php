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