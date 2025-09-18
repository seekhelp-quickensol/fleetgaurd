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

                <h6 class="mb-3">Trigger Report Review</h6>
                <div class="list-data">
					<!-- <button id="export-excel">Export to Excel</button> -->
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
			ajaxURL: "<?= base_url() ?>admin/Ajax_controller/get_all_trigger_report_data_ajax",
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
					title: "Organization Name",
					field: "organization_name",
					hozAlign: "center",
					width: 120,
					headerFilter: "input",
					headerHozAlign: "center",
					headerFilterPlaceholder: "Search By Organization Name"
				},
				{
					title: "Vendor Name",
					field: "vendor_name",
					hozAlign: "center",
					width: 200,
					headerFilter: "input",
					headerHozAlign: "center",
					headerFilterPlaceholder: "Search By Vendor Name"
				},
				{
					title: "Vendor Site",
					field: "vendor_site",
					hozAlign: "center",
					width: 150,
					headerFilter: "input",
					headerHozAlign: "center",
					headerFilterPlaceholder: "Search By Vendor Site"
				},
				{
					title: "Item Code",
					field: "item_no",
					hozAlign: "center",
					width: 200,
					headerFilter: "input",
					headerHozAlign: "center",
					headerFilterPlaceholder: "Search By Item Code"
				},
				{
					title: "Item Description",
					field: "description",
					hozAlign: "center",
					width: 150,
					headerFilter: "input",
					headerHozAlign: "center",
					headerFilterPlaceholder: "Search By Item Description"
				},
				{
					title: "Release Date",
					field: "release_date",
					hozAlign: "center",
					width: 150,
					headerFilter: "input",
					headerHozAlign: "center",
					headerFilterPlaceholder: "Search By Release Date"
				},
				{
					title: "Buffer(%)",
					field: "buffer",
					hozAlign: "center",
					width: 150,
					headerFilter: "input",
					headerHozAlign: "center",
					headerFilterPlaceholder: "Search By Buffer(%)"
				},
				{
					title: "Priority Mark",
					field: "priority_mark",
					hozAlign: "center",
					width: 150,
					headerFilter: "input",
					headerHozAlign: "center",
					headerFilterPlaceholder: "Search By Priority Mark"
				},
				{
					title: "Shipped Date",
					field: "shipped_date",
					hozAlign: "center",
					width: 150,
					headerFilter: "input",
					headerHozAlign: "center",
					headerFilterPlaceholder: "Search By Shipped Date"
				},
				{
					title: "Release Qty",
					field: "release_qty",
					hozAlign: "center",
					width: 150,
					headerFilter: "input",
					headerHozAlign: "center",
					headerFilterPlaceholder: "Search By Release Qty"
				},
				{
					title: "Asn Qty",
					field: "asn_qty",
					hozAlign: "center",
					width: 150,
					headerFilter: "input",
					headerHozAlign: "center",
					headerFilterPlaceholder: "Search By ASN Quantity"
				},
				{
					title: "Difference",
					field: "difference",
					hozAlign: "center",
					width: 150,
					headerFilter: "input",
					headerHozAlign: "center",
					headerFilterPlaceholder: "Search By Difference"
				},
				{
					title: "Percentage",
					field: "percentage",
					hozAlign: "center",
					width: 150,
					headerFilter: "input",
					headerHozAlign: "center",
					headerFilterPlaceholder: "Search By Percentage"
				},
			],
		});
		// jQuery event listener for Excel export
		$("#export-excel").on("click", function() {
			// Option 1: Export only the currently loaded page
			table.download("xlsx", "trigger_report_data.xlsx", {
				sheetName: "Trigger Report",
				columnStyles: {
					"buffer": { numFmt: "0.00%" }, // Format buffer as percentage
					"release_qty": { numFmt: "0.00" }, // Format release_qty as number with 2 decimals
					"asn_qty": { numFmt: "0.00" }, // Format asn_qty as number with 2 decimals
					"difference": { numFmt: "0.00" }, // Format difference as number with 2 decimals
					"percentage": { numFmt: "0.00%" } // Format percentage as percentage
				}
			});
		});
    </script>
 <script>
    $(document).ready(function() {
        $('#report-management .nav-link').addClass('nav_active');
        $('#report-management .child_menu').addClass('show');
        $('#report-list').addClass('active_cc');

    });
  
    </script>