


<?php include('header.php');?>
<style>

    .btn-outline-primary {
    font-size: 12px;
    font-weight: 600;
    color:#525252;
    /* background: #525252; */
 border: 1px solid #5252522e;
}
.btn-outline-primary:hover,.btn-outline-primary:active {
    font-size: 12px;
    font-weight: 600;
    color: white;
    background: #525252;
    border: 1px solid #525252;
}
.tabulator .tabulator-col .tabulator-col-title {
    text-align: center;
    display: block;
}
.page-title {
    display: block;
}
.page-title span{
font-size:14px;
}


.btn-1{
	background:#fcd7d6;
}
.btn-2{
	background:#D3E0DC;
}
.btn-3{
	background: #AEE1E1;
}
.btn-4{
	background:#FFD6BA;
}
.btn-5{
	background:#DEE791;
}
.btn-6{
	background:#F0F0D7;
}
.btn-7{
	background:#C6E7FF;
}
.btn-8{
	background:#FFC1DA;
}

    </style>
<div class="main-content">
    <div class="sub-content">
        <div class="page-header">
            <h6 >
                Report List

            </h6>

        </div>



        <!-- tab content  -->


       

        <div class="" id="main-table" role="tabpanel">
              
              
              <div class="list-data">
                  <div class="">
                      <div class="report-list mt-1 p-2"></div>

                  </div>
              </div>

          </div>




    </div>
    <?php include('footer.php');?>
    <script>
    
		var table = new Tabulator(".report-list", {
			pagination: "remote",
			paginationSize: 10,
			selectable: true,
			// layout: "fitColumns",
			ajaxURL: "<?= base_url() ?>admin/Ajax_controller/get_all_report_data_ajax",
			ajaxConfig: "POST",
			ajaxContentType: "json",
			ajaxResponse: function(url, params, response) {
				console.log(response);
				return response.data;
			},
			placeholder: "No Data Found", // Display this message when no data is available
			columns: [{
					title: "Sr.No",
					field: "sr_no",
					formatter: "rownum",
					hozAlign: "center",
					headerSort: false,
					width: 50,
				},
				{
					title: "Report Id ",
					field: "report_number",
					hozAlign: "center",
					headerFilter: "input",
					headerHozAlign: "center",
					headerFilterPlaceholder: "Search By Report Id"
				},
				{
					title: "Date/Time",
					field: "date_time",
					hozAlign: "center",
					headerFilter: "input",
					headerHozAlign: "center",
					headerFilterPlaceholder: "Search By Date/Time"
				},
				{
					title: "MTO Order Report",
					field: "mto_order_report",
					hozAlign: "center",
					formatter: function(cell) {
						var rowData = cell.getRow().getData();
						var reportNumber = rowData.report_number;
						return `<a href="<?= base_url('mto-order-review/'); ?>${reportNumber}" target="_blank" class="btn btn-sm btn-outline-primary btn-1">View MTO Order</a>`
					}
				},
				{
					title: "MTS Order Report",
					field: "order_report",
					hozAlign: "center",
					formatter: function(cell) {
						var rowData = cell.getRow().getData();
						var reportNumber = rowData.report_number;
						return `<a href="<?= base_url('order-review/'); ?>${reportNumber}" target="_blank" class="btn btn-sm btn-outline-primary btn-2">View MTS Order</a>`
					}
				},
				{
					title: "Inventory Report",
					field: "inventory_report",
					hozAlign: "center",
					formatter: function(cell) {
						var rowData = cell.getRow().getData();
						var reportNumber = rowData.report_number;
						return `<a href="<?= base_url('inventory-review/'); ?>${reportNumber}" target="_blank" class="btn btn-sm btn-outline-primary btn-3">View Inventory</a>`
					}
				},
				{
					title: "Trigger Report",
					field: "trigger_report",
					hozAlign: "center",
					formatter: function(cell) {
						var rowData = cell.getRow().getData();
						var reportNumber = rowData.report_number;
						return `<a href="<?= base_url('trigger-report-review/'); ?>${reportNumber}" target="_blank" class="btn btn-sm btn-outline-primary btn-4">View Trigger Report</a>`
					}
				},
				{
					title: "BPR MTO Report",
					field: "bpr_mto_report",
					hozAlign: "center",
					formatter: function(cell) {
						var rowData = cell.getRow().getData();
						var reportNumber = rowData.report_number;
						return `<a href="<?= base_url('bpr-mto-shortage-report/'); ?>${reportNumber}/1" target="_blank" class="btn btn-sm btn-outline-primary btn-5">View BPR MTO</a>`
					}
				},
				{
					title: "BPR MTS Report",
					field: "bpr_mts_report",
					hozAlign: "center",
					formatter: function(cell) {
						var rowData = cell.getRow().getData();
						var reportNumber = rowData.report_number;
						return `<a href="<?= base_url('bpr-mts-shortage-report/'); ?>${reportNumber}/1" target="_blank" class="btn btn-sm btn-outline-primary btn-6">View BPR MTS</a>`
					}
				},
				{
					title: "BPR Shortage Summary",
					field: "bpr_shortage_summary",
					hozAlign: "center",
					formatter: function(cell) {
						var rowData = cell.getRow().getData();
						var reportNumber = rowData.report_number;
						return `<a href="<?= base_url('bpr-shortage-summary-report/'); ?>${reportNumber}" target="_blank" class="btn btn-sm btn-outline-primary btn-7">View Shortage Summary</a>`
					}
				},
				{
					title: "BPR Work Order Report",
					field: "bpr_work_order",
					hozAlign: "center",
					formatter: function(cell) {
						var rowData = cell.getRow().getData();
						var reportNumber = rowData.report_number;
						return `<a href="<?= base_url('bpr-work-order?filter_report='); ?>${reportNumber}" target="_blank" class="btn btn-sm btn-outline-primary btn-8">Generate Work Order</a>`
					}
				},
				{
					title: "Added By",
					field: "added_by",
					hozAlign: "center",
					headerFilter: "input",
					headerHozAlign: "center",
					headerFilterPlaceholder: "Search By Added By"
				},
			],
		});
    
		

    </script>

	 <script>
    $(document).ready(function() {
        $('#report-management .nav-link').addClass('nav_active');
        $('#report-management .child_menu').addClass('show');
        $('#report-list').addClass('active_cc');

    });
  
    </script>