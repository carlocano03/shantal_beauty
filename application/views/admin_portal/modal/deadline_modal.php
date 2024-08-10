<!-- Modal -->
<div class="modal fade" id="deadlineModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"><i class="bi bi-calendar2-x me-2"></i>Deadline for Filling Scholarship</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="error-message"></div>
                <div class="form-group">
                    <label for="deadline" class="form-label">Deadline for Filling of Scholarship</label>
                    <input type="date" class="form-control" id="deadline">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-square me-2"></i>Close</button>
                <button type="button" class="btn btn-primary" id="save_deadline"><i class="bi bi-floppy-fill me-2"></i>Save changes</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="cutOffModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"><i class="bi bi-calendar-week-fill me-2"></i>Manage
                    Attendance</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="attendance_member_id">
                <div class="form-group">
                    <label for="month" class="form-label">Month of</label>
                    <input type="month" class="form-control" id="month" value="<?= date('Y-m');?>">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                        class="bi bi-x-square me-2"></i>Close</button>
                <button type="button" class="btn btn-primary proceed_attendance"><i
                        class="bi bi-arrow-right-square me-2"></i>Proceed</button>
            </div>
        </div>
    </div>
</div>