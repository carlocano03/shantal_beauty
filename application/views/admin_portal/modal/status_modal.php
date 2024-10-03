<!-- Modal -->
<div class="modal fade" id="statusModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"><i class="bi bi-person-fill-add me-2"></i>Add New Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updateForm" class="needs-validation" novalidate>
                    <div class="form-group mb-3">
                        <label for="order_status" class="form-label">Order Status</label>
                        <select name="order_status" id="order_status" class="form-select" required>
                            <option value="">Please choose on the following</option>
                            <option value="Ship Out">Ship Out</option>
                        </select>
                        <div class="invalid-feedback">
                            Please provide a valid status.
                        </div>
                    </div>
                </form>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-square me-2"></i>Close</button>
                <button type="button" class="btn btn-primary" id="update_status"><i class="bi bi-floppy-fill me-2"></i>Save changes</button>
            </div>
        </div>
    </div>
</div>