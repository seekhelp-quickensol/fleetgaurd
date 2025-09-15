<?php include('header.php'); ?>
<style>
.page-title {
    display: block;
}
.page-title span{
font-size:14px;
}
</style>
<div class="main-content">
    <div class="sub-content">
        <div class="page-header">
            <h1 class="page-title">
                Report<br><span><?=$report_details->report_number;?>/<?=date("d-m-Y", strtotime(trim($report_details->created_on)));?></span>


            </h1>
           
        </div>

     



        <!-- tab content  -->
        <div class="tab-content mt-3" id="myTabContent">

            <div class="tab-pane fade show active fade-in " id="main-table" role="tabpanel">

                <h6 class="mb-3">Inventory Review</h6>
                <div class="list-data">
                    <div class="">
                        <div class="manufacturer-tables mt-1 p-2"></div>

                    </div>
                </div>

            </div>


        </div>
    </div>
    <?php include('footer.php'); 
		$order_number = $this->uri->segment(2);
	?>
    <script>
     
		var table = new Tabulator(".manufacturer-tables", {
			pagination: "remote", // Enable server-side pagination
			paginationSize: 10, // 10 records per page
			selectable: true,
			layout: "fitColumns",
			ajaxURL: "<?= base_url() ?>admin/Ajax_controller/get_all_inventory_report_data_ajax",
			ajaxConfig: "POST",
			//ajaxContentType: "json",
			ajaxParams: {
				order_number: "<?=$order_number;?>",
			},
			ajaxResponse: function(url, params, response) {
				console.log('AJAX Params:', params); // Debug: Log the params sent to the server
				console.log('Response:', response); // Debug: Log the response from the server
				return response.data;
			},
			paginationDataSent: {
				"page": "page", // Parameter name for the page number
				"size": "size"  // Parameter name for the page size
			},
			paginationDataReceived: {
				"last_page": "last_page",
				"data": "data",
				"recordsTotal": "recordsTotal",
				"recordsFiltered": "recordsFiltered"
			},
			columns: [{
					title: "Sr.No",
					field: "sr_no",
					formatter: "rownum",
					hozAlign: "center",
					headerSort: false,
					width: 50
				},
				{
					title: "Item ",
					field: "item",
					hozAlign: "center",
					width: 120,
					headerFilter: "input",
					headerHozAlign: "center",
					headerFilterPlaceholder: "Search By Item"
				},
				{
					title: "Description",
					field: "description",
					hozAlign: "center",
					width: 200,
					headerFilter: "input",
					headerHozAlign: "center",
					headerFilterPlaceholder: "Search By Description"
				},
				{
					title: "Scrap",
					field: "scrap",
					hozAlign: "center",
					width: 150,
					headerFilter: "input",
					headerHozAlign: "center",
					headerFilterPlaceholder: "Search By Scrap"
				},
				{
					title: "Process Rej.Scrap",
					field: "process_rej_scrap",
					hozAlign: "center",
					width: 200,
					headerFilter: "input",
					headerHozAlign: "center",
					headerFilterPlaceholder: "Search By Process Rej.Scrap"
				},
				{
					title: "Shop.RM",
					field: "shop_rm",
					hozAlign: "center",
					width: 150,
					headerFilter: "input",
					headerHozAlign: "center",
					headerFilterPlaceholder: "Search By Shop.RM"
				},
				{
					title: "Shop.SA",
					field: "shop_sa",
					hozAlign: "center",
					width: 150,
					headerFilter: "input",
					headerHozAlign: "center",
					headerFilterPlaceholder: "Search By Shop.SA"
				},
				{
					title: "OSP",
					field: "osp",
					hozAlign: "center",
					width: 150,
					headerFilter: "input",
					headerHozAlign: "center",
					headerFilterPlaceholder: "Search By OSP"
				},
				{
					title: "Total Quantity",
					field: "total_quantity",
					hozAlign: "center",
					width: 150,
					headerFilter: "input",
					headerHozAlign: "center",
					headerFilterPlaceholder: "Search By Total Quantity"
				},
				{
					title: "Unit Cost",
					field: "unit_cost",
					hozAlign: "center",
					width: 150,
					headerFilter: "input",
					headerHozAlign: "center",
					headerFilterPlaceholder: "Search By Unit Cost"
				},
				{
					title: "Total Cost",
					field: "total_cost",
					hozAlign: "center",
					width: 150,
					headerFilter: "input",
					headerHozAlign: "center",
					headerFilterPlaceholder: "Search By Total Cost"
				},
				{
					title: "MAX Quantity",
					field: "max_quantity",
					hozAlign: "center",
					width: 150,
					headerFilter: "input",
					headerHozAlign: "center",
					headerFilterPlaceholder: "Search By MAX Quantity"
				},
				{
					title: "On Hand",
					field: "on_hand",
					hozAlign: "center",
					width: 150,
					headerFilter: "input",
					headerHozAlign: "center",
					headerFilterPlaceholder: "Search By On Hand"
				},
				{
					title: "Production Line",
					field: "production_line",
					hozAlign: "center",
					width: 150,
					headerFilter: "input",
					headerHozAlign: "center",
					headerFilterPlaceholder: "Search By Production Line"
				},
				{
					title: "Trading Flag",
					field: "trading_flag",
					hozAlign: "center",
					width: 150,
					headerFilter: "input",
					headerHozAlign: "center",
					headerFilterPlaceholder: "Search By Trading Flag"
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