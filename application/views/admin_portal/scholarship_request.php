<style>
    #tbl_request th:nth-child(1),
    #tbl_request td:nth-child(1),
    #tbl_request th:nth-child(5),
    #tbl_request td:nth-child(5),
    #tbl_request th:nth-child(6),
    #tbl_request td:nth-child(6),
    #tbl_request th:nth-child(7),
    #tbl_request td:nth-child(7) {
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
                <table class="table" width="100%" id="tbl_request">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Application No</th>
                            <th>Name</th>
                            <th>School</th>
                            <th>Application Date</th>
                            <th>Status</th>
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
        var tbl_request = $('#tbl_request').DataTable({
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
                "url": "<?= base_url('portal/admin_portal/scholar_request/get_scholar_list')?>",
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
    });
</script>
