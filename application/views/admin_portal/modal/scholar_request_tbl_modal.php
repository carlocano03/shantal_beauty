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
                            <div class="col modal__label">#</div>
                            <div class="col modal__data">1</div>
                        </div>
                    </div>
                    <div class="col border-bottom pb-3">
                        <div class="row align-items-center">
                            <div class="col modal__label">Scholar No:</div>
                            <div class="col modal__data">23423432432432</div>
                        </div>
                    </div>
                    <div class="col border-bottom pb-3">
                        <div class="row align-items-center">
                            <div class="col modal__label">Name:</div>
                            <div class="col modal__data">Jake Castor</div>
                        </div>
                    </div>
                    <div class="col border-bottom pb-3">
                        <div class="row align-items-center">
                            <div class="col modal__label">School:</div>
                            <div class="col modal__data">Neust</div>
                        </div>
                    </div>
                    <div class="col border-bottom pb-3">
                        <div class="row align-items-center">
                            <div class="col modal__label">Application Date:</div>
                            <div class="col modal__data">Wed Jul 17, 2024 08:00 AM</div>
                        </div>
                    </div>
                    <div class="col border-bottom pb-3">
                        <div class="row align-items-center">
                            <div class="col modal__label">Status:</div>
                            <div class="col modal__data">For Approval</div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="modal__btn--close" data-bs-dismiss="modal">Close</button>
                <button type="button" class="modal__btn--view">View Request</button>

            </div>
        </div>
    </div>
</div>
