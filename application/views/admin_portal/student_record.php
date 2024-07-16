<style>
    #tbl_student th:nth-child(1),
    #tbl_student td:nth-child(1),
    #tbl_student th:nth-child(5),
    #tbl_student td:nth-child(5),
    #tbl_student th:nth-child(6),
    #tbl_student td:nth-child(6),
    #tbl_student th:nth-child(7),
    #tbl_student td:nth-child(7) {
        text-align: center;
    }
</style>
<!-- Content wrapper -->
<div class="content-wrapper">

    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header mb-3">
                <h5><i class="<?= $icon?> me-2"></i><?= $card_title?></h5>
            </div>
            <div class="card-body">
                <table class="table" width="100%" id="tbl_student">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Scholarship No</th>
                            <th>Name</th>
                            <th>School</th>
                            <th>Birthday</th>
                            <th>Civil Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- / Content -->

<script>
    $(document).ready(function() {
        var tbl_student = $('#tbl_student').DataTable({
            language: {
                search: '',
                searchPlaceholder: "Search Here...",
                paginate: {
                    next: '<i class="bi bi-chevron-double-right"></i>',
                    previous: '<i class="bi bi-chevron-double-left"></i>'
                }
            },
            "ordering": false,
            "serverSide": true,
            "processing": true,
            "deferRender": true,
            "ajax": {
                "url": "<?= base_url('portal/admin_portal/student_record/get_student_list')?>",
                "type": "POST",
                "data": function (d) {
                    d[csrf_token_name] = csrf_token_value;
                },
                "complete": function(res) {
                    csrf_token_name = res.responseJSON.csrf_token_name;
                    csrf_token_value = res.responseJSON.csrf_token_value;
                }
            },
        });

        $(document).on('click', '.delete_scholar', function() {
            var member_id = $(this).data('id');
            var user_id = $(this).data('user');

            Swal.fire({
                title: 'Are you sure..',
                text: "You want to remove this scholar?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, continue',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?= base_url('portal/admin_portal/student_record/delete_scholar')?>",
                        method: "POST",
                        data: {
                            member_id: member_id,
                            user_id: user_id,
                            '_token': csrf_token_value,
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data.message == 'Success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Thank You',
                                    text: 'Scholar successfully deleted.',
                                });
                                tbl_student.draw();
                            } else {
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Oops...',
                                    text: 'Failed to delete the record.',
                                });
                            }
                        },
                        error: function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'An error occurred while processing the request.',
                            });
                        }
                    });
                }
            });
        });
    });
</script>
