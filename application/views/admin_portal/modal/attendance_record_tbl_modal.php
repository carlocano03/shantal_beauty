<style>
.modal__btn--view {
    background-color: #434875;
    color: #ffffff;
    border: none;
    font-size: 14px;
    padding: 8px 20px;
    border-radius: 6px;
    transition: all 0.4s ease-in-out;


}

.modal__btn--close {
    background-color: #F5F5F7;
    color: #434875;
    border: none;
    font-size: 14px;
    padding: 8px 20px;
    border-radius: 6px;
    transition: all 0.4s ease-in-out;


}

.modal__btn--view:hover {
    opacity: 0.8;

}

.student-img {
    border-radius: 100%;
    height: 50px;
    width: 50px;
    border: 2px solid rgba(0, 0, 0, .125);
}

.modal__label {
    font-size: 12px;
}

.modal__data {
    font-size: 12px;
}
</style>

<!-- Modal -->
<div class="modal fade" id="viewAttendanceRecordTableDetails" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-bottom-none">
                <h6 class="modal-title" id="staticBackdropLabel"><i class="fa-solid fa-user me-2"></i>User Details
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="row row-cols-1 gap-3">
                    <div class="col border-bottom pb-4 d-flex justify-content-center">
                        <img id="studentImg" class=" student-img" src=""></img>
                    </div>
                    <div class="col border-bottom pb-3">
                        <div class="row align-items-center">
                            <div class="col modal__label">Scholar No:</div>
                            <div id="scholarNo" class="col modal__data"></div>
                        </div>
                    </div>
                    <div class="col border-bottom pb-3">
                        <div class="row align-items-center">
                            <div class="col modal__label">Student:</div>
                            <div id="studentName" class="col modal__data"></div>
                        </div>
                    </div>
                    <div class="col border-bottom pb-3">
                        <div class="row align-items-center">
                            <div class="col modal__label">Total Late:</div>
                            <div id="totalLate" class="col modal__data"></div>
                        </div>
                    </div>
                    <div class="col border-bottom pb-3">
                        <div class="row align-items-center">
                            <div class="col modal__label">Schedule:</div>
                            <div id="studentSchedule" class="col modal__data"></div>
                        </div>
                    </div>
                    <div class="col border-bottom pb-3">
                        <div class="row align-items-center">
                            <div class="col modal__label">Year Level:</div>
                            <div id="studentYearLevel" class="col modal__data"></div>
                        </div>
                    </div>
                    <div class="col border-bottom pb-3">
                        <div class="row align-items-center">
                            <div class="col modal__label">Course:</div>
                            <div id="studentCourse" class="col modal__data"></div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="row align-items-center">
                            <div class="col modal__label">Action:</div>
                            <div class="col modal__data">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-dark btn-sm dropdown-toggle"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        Action
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a data-bs-dismiss="modal" id="manageAttendanceBtn"
                                                class="dropdown-item link-cursor text-primary manage_attendance"
                                                data-id=""><i class="bi bi-view-list me-2"></i>Manage
                                                Attendance</a></li>
                                        <li><a style="display:none;" data-bs-dismiss="modal" id="viewScheduleBtn"
                                                class="dropdown-item link-cursor text-danger view_schedule"
                                                data-id=""><i class="bi bi-calendar-week-fill me-2"></i>View
                                                Schedule</a></li>
                                        <li><a style="display:none;" data-bs-dismiss="modal" id="verifyLetter"
                                            class="dropdown-item link-cursor text-info verify_letter"
                                            ><i class="bi bi-download me-2"></i>Verify Letter</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="modal__btn--close" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="verifyModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"><i class="bi bi-download me-2"></i>Verify Excuse Letter</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="verifyForm" class="needs-validation" novalidate>
                    <input type="hidden" id="uploaded_id">
                    <input type="hidden" id="memberID">
                    <label for="attachment" class="form-label">Attachment</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="attachment" readonly>
                        <button class="btn btn-outline-secondary" type="button" id="download_btn"><i class="bi bi-download me-2"></i>Download</button>
                    </div>

                    <div class="form-group mb-3">
                        <label for="letter_verification" class="form-label">Letter Verification</label>
                        <select name="letter_verification" id="letter_verification" class="form-select" required>
                            <option value="">Please select on the following options</option>
                            <option value="Valid">Valid Letter</option>
                            <option value="Invalid">Invalid Letter</option>
                        </select>
                        <div class="invalid-feedback">
                            Please provide a valid options.
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
                <button type="button" class="btn btn-primary" id="save_verification"><i class="bi bi-floppy-fill me-2"></i>Save changes</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).on("click", ".viewStudentAttendanceRecordDetailsBtn", function() {
    var base_url = "<?php echo base_url(); ?>";

    var member_id = $(this).data("member-id");
    var late_count = $(this).data("late_count");
    var no_late = $(this).data("no_late");
    var show_button = $(this).data("show_button");

    $.ajax({
        url: '<?php echo base_url('portal/admin_portal/attendance_record/get_student_details'); ?>',
        type: "GET",
        data: {
            member_id: member_id,
            '_token': csrf_token_value,
        },

        success: function(response) {
            var data = JSON.parse(response);
            if (data.error) {
                // Error
            } else {
                $("#studentImg").attr("src", data.img);
                $("#scholarNo").text(data.scholarship_no);
                $("#studentName").text(data.name);
                $("#studentSchedule").html(data.schedule);
                $("#studentYearLevel").text(data.year_level);
                $("#studentCourse").text(data.course);

                if(data.schedule_count > 0) {
                    $("#viewScheduleBtn").show(200);
                    $("#viewScheduleBtn").attr("data-id", data.member_id);
                } else {
                    $("#viewScheduleBtn").hide(200);
                }

                $("#manageAttendanceBtn").attr("data-id", member_id);

                if(show_button == 'Show') {
                    $("#verifyLetter").show(200);
                    $("#verifyLetter").attr("data-id", data.member_id);
                } else {
                    $("#verifyLetter").hide(200);
                }
                
                $('#totalLate').text(late_count+' / '+no_late);
            }
        }
    });
});
</script>
