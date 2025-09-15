<?php include('header.php'); ?>



<div class="main-content">
    <div class="sub-content">
        <div class="page-header">
            <h1 class="page-title">
                Today's BPR MTS Report
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
            name: "John Doe",
            date: "20 May 2025",
            time: "10:00 AM",
            report_url: "<?=base_url()?>BPR-MTS-shortage-report"
        },
        {
            name: "Jane Smith",
            date: "20 May 2025",
            time: "11:30 AM",
            report_url: "<?=base_url()?>BPR-MTS-shortage-report"
        },
        {
            name: "David Lee",
            date: "20 May 2025",
            time: "1:00 PM",
            report_url: "<?=base_url()?>BPR-MTS-shortage-report"
        }
    ];

    // Initialize Tabulator
    var table = new Tabulator(".bpr-session-table", {
        pagination: "remote",
		paginationSize: 10,
		selectable: true,
		layout: "fitColumns",
		ajaxURL: "<?= base_url() ?>admin/Ajax_controller/get_today_report_data_ajax",
		ajaxConfig: "POST",
		ajaxContentType: "json",
		ajaxResponse: function(url, params, response) {
			console.log(response);
			return response.data;
		},
		placeholder: "No Data Found", // Display this message when no data is available
        columns: [{
                title: "Sr.No",
                formatter: "rownum",
                hozAlign: "center",
                headerSort: false,
                width: 60
            },
            {
                title: "Name",
                field: "added_by",
                hozAlign: "center"
            },
            {
                title: "Report Number",
                field: "report_number",
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
					var rowData = cell.getRow().getData();
					var reportNumber = rowData.report_number;
					return `<a href="<?= base_url('bpr-mts-shortage-report/'); ?>${reportNumber}" target="_blank" class="btn btn-sm btn-dark">View Report</a>`
				},
                width: 150
            }
        ],
    });
    </script>






    <?php include('footer.php'); ?>
    <script>
    $(document).ready(function() {
        $('#report').addClass('active');
        $('#todays-bpr-report').addClass('active');
        $(".sidebar-dropdown").slideToggle().toggleClass('act');
    });
    </script>