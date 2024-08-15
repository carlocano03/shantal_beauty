<style>
    #tbl_choices {
        border-collapse: collapse;
        width: 100%;
    }
    #tbl_choices th {
        border: 1px solid #dfe6e9;
        color: #566a7f !important;
        vertical-align: middle;
    }
    #tbl_choices td {
        border: 1px solid #dfe6e9;
        color: #566a7f !important;
        vertical-align: middle;
    }
</style>
<!-- Modal -->
<div class="modal fade" id="pollModal" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"><i class="bi bi-bar-chart-line me-2"></i>Add New Poll</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="pollForm" class="needs-validation" novalidate>
                    <div class="form-group mb-3">
                        <label for="poll_title" class="form-label">Poll Title</label>
                        <input type="text" class="form-control" id="poll_title" autocomplete="off" required>
                        <div class="invalid-feedback">
                            Please provide a valid poll title.
                        </div>
                    </div>
                    <hr>
                    <table id="tbl_choices">
                        <tr>
                            <th>ADD POLL CHOICES</th>
                            <th class="text-center" style="width:10%;">
                                <button type="button" id="addRow" class="btn btn-primary btn-icon btn-xs"><i class="bi bi-plus-lg"></i></button>
                            </th>
                        </tr>
                        <tbody id="dynamic_field">
                            <tr>
                                <td>
                                    <input type="text" class="form-control choices" placeholder="Enter poll choices" id="choices" name="choices[]" required>
                                </td>
                                <td class="text-center">
                                    <button type="button" id="removeRow" class="btn btn-danger btn-icon btn-xs" disabled><i class="bi bi-dash-lg"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="save_poll">Save changes</button>
            </div>
        </div>
    </div>
</div>

<script>
    var inputCount = 0;
    $(document).on('click', '#addRow', function(e) {
        e.preventDefault();
        inputCount++;
        var newRow  = '<tr><td>'+
                      '<input type="text" class="form-control choices" placeholder="Enter poll choices" id="choices_' + inputCount +'" name="choices[]" required>'+
                      '</td><td class="text-center">'+
                      '<button type="button" class="btn btn-danger btn-icon btn-xs removeRow"><i class="bi bi-dash-lg"></i></button>'+
                      '</td></tr>';
        $("#dynamic_field").prepend(newRow);
    });

    $(document).on('click', '.removeRow', function(e) {
        e.preventDefault();
        let row_item = $(this).parent().parent();
        $(row_item).remove();
    });
</script>