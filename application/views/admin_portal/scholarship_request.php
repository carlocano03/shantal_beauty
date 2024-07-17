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


#tbl_request td:nth-child(2),
#tbl_request td:nth-child(4),
#tbl_request td:nth-child(5) {
    display: none;

}

@media (min-width: 992px) {
    #tbl_request td:nth-child(5) {
        display: table-cell;
    }
}


@media (min-width: 768px) {

    #tbl_request td:nth-child(2),
    #tbl_request td:nth-child(4) {
        display: table-cell;
    }

}




.table__title {
    font-size: 20px;
    font-weight: 500;
    color: #434875 !important;
    padding: 8px 0;
    margin-bottom: 0;

}

.card {
    background: #ffffff;
    border-radius: 8px;
    color: #434875;
    box-shadow: 0 9px 20px rgba(46, 35, 94, .07);
}
</style>
<!-- Content wrapper -->
<div class="content-wrapper">

    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header mb-3 pb-3 d-flex align-items-center gap-2 ">
                <img src="<?php echo base_url('assets/images/approval.png'); ?>" width="36px" alt="Approval" />
                <h5 class="table__title"><?= $card_title?></h5>
            </div>
            <div class="card-body mt-4">
                <table class="table" width="100%" id="tbl_request">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th class="d-none d-md-table-cell">Application No</th>
                            <th>Name</th>
                            <th class="d-none d-md-table-cell">School</th>
                            <th class="d-none d-lg-table-cell">Application Date</th>
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

    <?php $this->load->view('/admin_portal/modal/scholar_request_tbl_modal.php');?>

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
                "data": function(d) {
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
