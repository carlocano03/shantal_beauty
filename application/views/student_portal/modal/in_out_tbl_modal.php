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
</style>

<!-- Modal -->
<div class="modal fade" id="viewTimeInOutRecord" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-bottom-none">
                <h6 class="modal-title" id="staticBackdropLabel"><i class="fa-solid fa-user me-2"></i>No Time In/Out
                    Record
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="row row-cols-1 gap-3">
                    <div class="col border-bottom pb-3">
                        <div class="row align-items-center">
                            <div class="col modal__label">Attendance Date:</div>
                            <div id="attendanceDate" class="col modal__data"></div>
                        </div>
                    </div>
                    <div class="col border-bottom pb-3">
                        <div class="row align-items-center">
                            <div class="col modal__label">Remarks:</div>
                            <div id="remarks" class="col modal__data"></div>
                        </div>
                    </div>
                    <div class="col border-bottom pb-3">
                        <div class="row align-items-center">
                            <div class="col modal__label">Date Submitted:</div>
                            <div id="dateSubmitted" class="col  modal__data">

                            </div>
                        </div>
                    </div>
                    <div class="col border-bottom pb-3">
                        <div class="row align-items-center">
                            <div class="col modal__label">Status:</div>
                            <div id="status" class="col modal__data"></div>
                        </div>
                    </div>
                    <div class="col border-bottom pb-3">
                        <div class="row align-items-center">
                            <div class="col modal__label">Time In/Out:</div>
                            <div id="timeInOut" class="col modal__data"></div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="row align-items-center">
                            <div class="col modal__label">Action:</div>
                            <div id="actionBtn" class="col modal__data"></div>
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



<script>
$(document).on("click", ".viewTimeInOutRecordBtn", function() {
    const base_url = "<?php echo base_url(); ?>";
    const id = $(this).data("id");

    $.ajax({
        url: '<?php echo base_url('portal/student_portal/student_attendance/get_explanation_letter_by_id'); ?>',
        type: "GET",
        dataType: 'json',
        data: {
            id: id,
        },
        success: function(data) {
            if (data.status === "error") {
                console.log(data.message);
            } else {
                $('#attendanceDate').text(data.data.attendance_date);
                $('#remarks').html(data.data.remarks);
                $('#dateSubmitted').text(data.data.date_created);
                $('#status').html(data.data.status);
                $('#timeInOut').text(data.data.time_in_out);
                $('#actionBtn').html(data.data.action);
            }
        },
        error: function(xhr, status, error) {
            console.log("AJAX error: " + status + ' : ' + error);
        }
    });
});
</script>
