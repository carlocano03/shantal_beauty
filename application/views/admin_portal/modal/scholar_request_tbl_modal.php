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
<div class="modal fade" id="viewScholarRequestTableDetails" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-bottom-none">
                <h6 class="modal-title" id="staticBackdropLabel"><i class="fa-solid fa-user me-2"></i>Student Request
                    Details
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="row row-cols-1 gap-3">
                    <div class="col border-bottom pb-3">
                        <div class="row align-items-center">
                            <div class="col modal__label">Scholar No:</div>
                            <div id="scho_application_no" class="col modal__data"></div>
                        </div>
                    </div>
                    <div class="col border-bottom pb-3">
                        <div class="row align-items-center">
                            <div class="col modal__label">Name:</div>
                            <div id="scho_name" class="col modal__data"></div>
                        </div>
                    </div>
                    <div class="col border-bottom pb-3">
                        <div class="row align-items-center">
                            <div class="col modal__label">School:</div>
                            <div id="scho_school" class="col modal__data"></div>
                        </div>
                    </div>
                    <div class="col border-bottom pb-3">
                        <div class="row align-items-center">
                            <div class="col modal__label">Application Date:</div>
                            <div id="scho_application_date" class="col modal__data"></div>
                        </div>
                    </div>
                    <div class="col border-bottom pb-3">
                        <div class="row align-items-center">
                            <div class="col modal__label">Status:</div>
                            <div id="scho_for_approval" class="col modal__data"></div>
                        </div>
                    </div>

                    <div class="col border-bottom pb-3">
                        <div class="row align-items-center">
                            <div class="col modal__label">Action:</div>
                            <div id="scho_action" class="col modal__data"></div>
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
$(document).on("click", '.viewScholarRequestTableDetailsBtn', function() {
    var baseUrl = "<?php echo base_url(); ?>";


    var application_id = $(this).data('application-id');
    console.log(application_id)
    $.ajax({
        url: '<?php echo base_url('portal/admin_portal/scholar_request/get_scholar'); ?>',
        type: "GET",
        data: {
            application_id: application_id
        },

        success: function(response) {
            var data = JSON.parse(response);
            if (data.error) {} else {
                $("#scho_name").text(data.full_name);
                $('#scho_application_no').text(data.application_no);
                $('#scho_school').text(data.school_name);
                $('#scho_application_date').text(data.application_date);
                $('#scho_for_approval').html(data.status);
                $('#scho_action').html(data.action);

            }
        }
    })
})
</script>