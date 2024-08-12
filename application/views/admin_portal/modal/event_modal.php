<!-- Modal -->
<div class="modal fade" id="eventModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"><i class="bi bi-plus-lg"></i> Add Event</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="eventForm">
                <div class="modal-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="error-message"></div>
                        <div class="cursor-pointer"><i class="bi bi-info-circle-fill"></i></div>
                    </div>
                    <div class="d-flex flex-column gap-2">
                        <div class="form-group">
                            <label for="event_img" class="form-label">Image</label>
                            <input type="file" class="form-control" id="event_img" accept="image/*" required>
                        </div>
                        <div class="form-group">
                            <label for="event_name" class="form-label">Event Name</label>
                            <input type="text" class="form-control" id="event_name" required>
                        </div>
                        <div class="form-group">
                            <label for="date" class="form-label">Date</label>
                            <input type="date" class="form-control" id="date" required>
                        </div>
                        <div class="form-group">
                            <label for="start_time" class="form-label">Time</label>
                            <div class="d-flex justify-content-between align-items-center gap-2">
                                <input type="time" class="form-control" id="start_time" required>
                                <div> - </div>
                                <input type="time" class="form-control" id="end_time" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="event_description" class="form-label">event_description</label>
                            <textarea type="text" placeholder="Description" id="event_description"
                                class="form-control"></textarea>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="add_event_btn">Add Event</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {

    $("#add_event_btn").on('click', function(e) {
        e.preventDefault();
        event.stopPropagation();

        var formData = new FormData();
        formData.append('event_name', $("#event_name").val());
        formData.append('event_date', $("#date").val());
        formData.append('start_time', $("#start_time").val());
        formData.append('end_time', $("#end_time").val());
        formData.append('event_description', $("#event_description").val());
        formData.append('event_img', $("#event_img")[0].files[0]);
        formData.append('_token', csrf_token_value);

        Swal.fire({
            title: 'Are you sure..',
            text: "You want to add this event?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, continue',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?=base_url('portal/admin_portal/main/add_event');?>',
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(data) {
                        if (data.error) {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Ooops...',
                                text: data.error,
                            });
                        } else {
                            Swal.fire({
                                icon: 'success',
                                title: 'Thank You!',
                                text: data.success,
                            });
                            $('#eventForm')[0].reset();
                            $('#eventModal').modal('hide');
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Ooops...',
                            text: 'An error occurred while processing the request.',
                        });
                    }
                })
            }

        })

    })
})
</script>