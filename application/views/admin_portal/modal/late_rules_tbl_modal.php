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
                            <div id="ruleName" class="col modal__data"></div>
                        </div>
                    </div>
                    <div class="col border-bottom pb-3">
                        <div class="row align-items-center">
                            <div class="col modal__label">Consecutive Lates:</div>
                            <div id="consecutiveLates" class="col modal__data"></div>
                        </div>
                    </div>
                    <div class="col border-bottom pb-3">
                        <div class="row align-items-center">
                            <div class="col modal__label">No. Of Days:</div>
                            <div id="ruleNoDays" class="col modal__data"></div>
                        </div>
                    </div>
                    <div class="col border-bottom pb-3">
                        <div class="row align-items-center">
                            <div class="col modal__label">
                                Status
                            </div>
                            <div id="ruleStatus" class="col  modal__data">

                            </div>
                        </div>

                    </div>
                    <div class="col border-bottom pb-3">
                        <div class="row align-items-center">
                            <div class="col modal__label">Date Added:</div>
                            <div id="ruleDateAdded" class="col modal__data"></div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="row align-items-center">
                            <div class="col modal__label">Action:</div>
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
$(document).on("click", ".viewLateRulesDetailsBtn", function() {
    const base_url = "<?php echo base_url(); ?>";
    const late_rule_id = $(this).data("rule-id");

    $.ajax({
        url: '<?php echo base_url('portal/admin_portal/late_rules/get_rule_by_id'); ?>',
        type: "GET",
        dataType: 'json',
        data: {
            late_rule_id: late_rule_id,
        },
        success: function(data) {
            if (data.error) {
                console.log(data.error);
            } else {
                $('#ruleName').text(data.rule_name);
                $('#consecutiveLates').text(data.no_late);
                $('#ruleNoDays').text(data.no_days);
                $('#ruleStatus').html(data.status);
                $('#ruleDateAdded').text(data.date_created);
                $('#actionBtn').html(data.action);
            }
        },
        error: function(xhr, status, error) {
            console.log("AJAX error: " + status + ' : ' + error);
        }
    });
});
</script>
