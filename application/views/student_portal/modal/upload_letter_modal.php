<!-- Modal -->
<div class="modal fade" id="uploadModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"><i class="bi bi-upload me-2"></i>Upload Excuse Letter</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="attachmentForm" class="needs-validation" novalidate>
                    <label class="form-label">Excuse Letter <span class="text-danger" style="font-size:9px;">(PDF and Docs Format Only)</span></label>
                    <div class="input-group mb-3">
                        <input type="file" class="form-control" id="attachment" accept=".doc, .docx, .pdf" required>
                        <label class="input-group-text" for="attachment">Upload</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-square me-2"></i>Close</button>
                <button type="button" class="btn btn-primary" id="save_excuse_letter"><i class="bi bi-floppy-fill me-2"></i>Save Changes</button>
            </div>
        </div>
    </div>
</div>