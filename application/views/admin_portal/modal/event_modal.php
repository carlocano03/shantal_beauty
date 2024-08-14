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