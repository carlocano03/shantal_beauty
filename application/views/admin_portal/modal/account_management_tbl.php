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
<div class="modal fade" id="viewAccountManagementTableDetails" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-bottom-none">
                <h6 class="modal-title" id="staticBackdropLabel"><i class="fa-solid fa-user me-2"></i>Administrator
                    Account Details
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row row-cols-1 gap-3">
                    <div class="col border-bottom pb-3">
                        <div class="row align-items-center">
                            <div class="col modal__label">Full Name:</div>
                            <div id="full_name" class="col modal__data"></div>
                        </div>
                    </div>
                    <div class="col border-bottom pb-3">
                        <div class="row align-items-center">
                            <div class="col modal__label">Username:</div>
                            <div id="username" class="col modal__data"></div>
                        </div>
                    </div>
                    <div class="col border-bottom pb-3">
                        <div class="row align-items-center">
                            <div class="col modal__label">Email:</div>
                            <div id="email" class="col modal__data"></div>
                        </div>
                    </div>
                    <div class="col border-bottom pb-3">
                        <div class="row align-items-center">
                            <div class="col modal__label">
                                Status
                            </div>
                            <div id="status" class="col modal__data"></div>
                        </div>
                    </div>

                    <div class="col border-bottom pb-3">
                        <div class="row align-items-center">
                            <div class="col modal__label">
                                Action
                            </div>
                            <div id="actionBtn" class="col modal__data">

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
$(document).ready(function() {
    $(document).on("click", ".view-account-management-btn", function() {
        var fullname = $(this).data("fullname");
        var username = $(this).data("username");
        var email = $(this).data("email");
        var status = $(this).data("status");
        var actionBtn = $(this).data("action")

        $('#full_name').text(fullname);
        $('#username').text(username);
        $('#email').text(email);
        $("#status").html(status);
        $('#actionBtn').html(actionBtn);

        $('#viewAccountManagementTableDetails').modal('show');
    });
});
</script>