


<?php include('header.php'); ?>



<div class="main-content">
    <div class="sub-content">
        <div class="page-header">
            <h1 class="page-title">
            Today's BPR Work Order Report
            </h1>
        </div>

        <!-- Table Container -->
        <div class="tab-content mt-3" id="myTabContent">
            <div class="tab-pane fade show active fade-in" id="main-table" role="tabpanel">

                <div class="list-data">
                    <div class="table-responsive">
                        <div class="bpr-session-table mt-1 p-2"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('footer.php');?>

    <script>
    // Dummy BPR data
    var bprData = [{
            name: "Yash Sinha",
            date: "20 May 2025",
            time: "10:00 AM",
            report_url: "<?=base_url()?>bpr-work-order"
        },
        {
            name: "Yogi Desai",
            date: "20 May 2025",
            time: "11:30 AM",
            report_url: "<?=base_url()?>bpr-work-order"
        },
        {
            name: "David Lee",
            date: "20 May 2025",
            time: "1:00 PM",
            report_url: "<?=base_url()?>bpr-work-order"
        }
    ];

    // Initialize Tabulator
    var table = new Tabulator(".bpr-session-table", {
        layout: "fitColumns",
        pagination: true,
        paginationSize: 10,
        selectable: true,
        columns: [{
                title: "Sr.No",
                formatter: "rownum",
                hozAlign: "center",
                headerSort: false,
                width: 60
            },
            {
                title: "Name",
                field: "name",
                hozAlign: "center"
            },
            {
                title: "Date",
                field: "date",
                hozAlign: "center"
            },
            {
                title: "Time",
                field: "time",
                hozAlign: "center"
            },
            {
                title: "Action",
                field: "report_url",
                hozAlign: "center",
                formatter: function(cell) {
                    var url = cell.getValue();
                    return `<button class="btn btn-sm btn-dark" onclick="window.location.href='${url}'">View Report</button>`;
                },
                width: 150
            }
        ],
        data: bprData,
    });
    </script>






<?php include('footer.php'); ?>
<script>
    $(document).ready(function() {
        $('#report').addClass('active');
        $('#todays-bpr-work-report').addClass('active');
        $(".sidebar-dropdown").slideToggle().toggleClass('act');
    });
</script>