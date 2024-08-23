<!-- Modal -->
<div class="modal fade" id="letterModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"><i class="bi bi-upload me-2"></i>Upload Explanation Letter</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="attachmentForm" class="needs-validation" novalidate>
                    <div class="form-group mb-3">
                        <label class="form-label">Attendance Date</label>
                        <select name="attendance_date" id="attendance_date" class="form-select" required>
                            <option value="">Please select the attendance date</option>
                            <?php foreach($attendance as $row) : ?>
                                <option value="<?= $row->schedule_date?>"><?= $row->schedule_date?></option>
                            <?php endforeach;?>
                        </select>
                        <div class="invalid-feedback">
                            Please provide a valid attendance date.
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">Options</label>
                        <select name="options" id="options" class="form-select" required>
                            <option value="">Please select on the following options</option>
                            <option value="No Time-In">No Time-In</option>
                            <option value="No Time-Out">No Time-Out</option>
                        </select>
                        <div class="invalid-feedback">
                            Please provide a valid options.
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">Expected Time In/Out</label>
                        <input type="time" class="form-control" id="est_in_out">
                        <div class="invalid-feedback">
                            Please provide a valid options.
                        </div>
                    </div>
                    <label class="form-label">Explanation Letter <span class="text-danger" style="font-size:9px;">(PDF and Docs Format Only)</span></label>
                    <div class="input-group mb-3">
                        <input type="file" class="form-control" id="attachment" accept=".doc, .docx, .pdf" required>
                        <label class="input-group-text" for="attachment">Upload</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-square me-2"></i>Close</button>
                <button type="button" class="btn btn-primary" id="save_explanation_letter"><i class="bi bi-floppy-fill me-2"></i>Save Changes</button>
            </div>
        </div>
    </div>
</div>