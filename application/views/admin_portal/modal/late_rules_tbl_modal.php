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
<div class="modal fade" id="viewLateRulesTableDetails" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-bottom-none">
                <h6 class="modal-title" id="staticBackdropLabel"><i class="fa-solid fa-user me-2"></i>Late Rules Details
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="row row-cols-1 gap-3">
                    <div class="col border-bottom pb-3">
                        <div class="row align-items-center">
                            <div class="col modal__label">Rule Name:</div>
                            <div class="col modal__data">Rule 1</div>
                        </div>
                    </div>
                    <div class="col border-bottom pb-3">
                        <div class="row align-items-center">
                            <div class="col modal__label">Consecutive Lates:</div>
                            <div class="col modal__data">5 Lates</div>
                        </div>
                    </div>
                    <div class="col border-bottom pb-3">
                        <div class="row align-items-center">
                            <div class="col modal__label">No. Of Days:</div>
                            <div class="col modal__data">5</div>
                        </div>
                    </div>
                    <div class="col border-bottom pb-3">
                        <div class="row align-items-center">
                            <div class="col modal__label">
                                Status
                            </div>
                            <div class="col modal__data">
                                <label class="switch">
                                    <input type="checkbox" class="rule_activation" id="1" checked="">
                                    <span class="slider round"></span>
                                </label><br>Active
                            </div>
                        </div>

                    </div>
                    <div class="col border-bottom pb-3">
                        <div class="row align-items-center">
                            <div class="col modal__label">Date Added:</div>
                            <div class="col modal__data">Thu Jul 4, 2024 06:18 PM</div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="row align-items-center">
                            <div class="col modal__label">Action:</div>
                            <div class="col modal__data">
                                <div>
                                    <button type="button" class="btn btn-dark btn-sm dropdown-toggle"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        Action
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item link-cursor text-primary" id="update_rule"><i
                                                    class="bi bi-pencil-square me-1"></i>Update Rule</a></li>
                                        <li><a class="dropdown-item link-cursor text-danger" id="delete_rule"><i
                                                    class="bi bi-trash3-fill me-1"></i>Delete Rule</a></li>
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