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
<div class="modal fade" id="viewBiometricLogTableDetails" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-bottom-none">
                <h6 class="modal-title" id="staticBackdropLabel"><i class="fa-solid fa-user me-2"></i>Student Details
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="row row-cols-1 gap-3">
                    <div class="col border-bottom pb-4 d-flex justify-content-center" id="b_student_img">
                        
                    </div>
                    <div class="col border-bottom pb-3">
                        <div class="row align-items-center">
                            <div class="col modal__label">Scholar No:</div>
                            <div id="b_scholar_no" class="col modal__data"></div>
                        </div>
                    </div>
                    <div class="col border-bottom pb-3">
                        <div class="row align-items-center">
                            <div class="col modal__label">Student Name:</div>
                            <div id="b_student_name" class="col modal__data"></div>
                        </div>
                    </div>
                    <div class="col border-bottom pb-3">
                        <div class="row align-items-center">
                            <div class="col modal__label">Date:</div>
                            <div id="b_date" class="col modal__data"></div>
                        </div>
                    </div>
                    <div class="col border-bottom pb-3">
                        <div class="row align-items-center">
                            <div class="col modal__label">Time:</div>
                            <div id="b_time" class="col modal__data"></div>
                        </div>
                    </div>
                    <div class="col border-bottom pb-3">
                        <div class="row align-items-center">
                            <div class="col modal__label">Type:</div>
                            <div id="b_type" class="col modal__data"></div>
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
$(document).on("click", ".viewBiometricLogDetailsBtn", function() {
    var base_url = "<?php echo base_url(); ?>";

    var data = $(this).data('biometric-data');

	$("#b_student_img").html(data[0]);
    $("#b_scholar_no").html(data[1]);
    $("#b_student_name").html(data[2]);
    $("#b_date").html(data[3]);
    $("#b_time").html(data[4]);
    $("#b_type").html(data[5]);
});
</script>