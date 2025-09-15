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

                <h6 class="mb-3">MTO Order Review</h6>
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
        ajaxURL: "<?= base_url() ?>admin/Ajax_controller/get_all_mto_order_report_data_ajax",
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
                title: "Organization Name ",
                field: "organization_name",
                hozAlign: "center",
                width: 120,
                headerFilter: "input",
                headerHozAlign: "center",
                headerFilterPlaceholder: "Search By Organization Name"
            },
            {
                title: "Order Category",
                field: "order_category",
                hozAlign: "center",
                width: 200,
                headerFilter: "input",
                headerHozAlign: "center",
                headerFilterPlaceholder: "Search By Order Category"
            },
            {
                title: "Sales Order Number",
                field: "sales_order_number",
                hozAlign: "center",
                width: 150,
                headerFilter: "input",
                headerHozAlign: "center",
                headerFilterPlaceholder: "Search By Sales Order Number"
            },
            {
                title: "Version No",
                field: "version_no",
                hozAlign: "center",
                width: 200,
                headerFilter: "input",
                headerHozAlign: "center",
                headerFilterPlaceholder: "Search By Version No"
            },
            {
                title: "Last Update Date",
                field: "last_update_date",
                hozAlign: "center",
                width: 150,
                headerFilter: "input",
                headerHozAlign: "center",
                headerFilterPlaceholder: "Search By Last Update Date"
            },
            {
                title: "IR Preparer Name",
                field: "ir_preparer_name",
                hozAlign: "center",
                width: 150,
                headerFilter: "input",
                headerHozAlign: "center",
                headerFilterPlaceholder: "Search By IR Preparer Name"
            },
            {
                title: "Customer Name",
                field: "customer_name",
                hozAlign: "center",
                width: 150,
                headerFilter: "input",
                headerHozAlign: "center",
                headerFilterPlaceholder: "Search By Customer Name"
            },
            {
                title: "Line Entry date",
                field: "line_entry_date",
                hozAlign: "center",
                width: 150,
                headerFilter: "input",
                headerHozAlign: "center",
                headerFilterPlaceholder: "Search By Line Entry date"
            },
            {
                title: "Customer Part No",
                field: "customer_part_no",
                hozAlign: "center",
                width: 150,
                headerFilter: "input",
                headerHozAlign: "center",
                headerFilterPlaceholder: "Search By Customer Part No"
            },
            {
                title: "FF Part No",
                field: "ff_part_no",
                hozAlign: "center",
                width: 150,
                headerFilter: "input",
                headerHozAlign: "center",
                headerFilterPlaceholder: "Search By FF Part No"
            },
            {
                title: "Part Description",
                field: "ff_part_description",
                hozAlign: "center",
                width: 150,
                headerFilter: "input",
                headerHozAlign: "center",
                headerFilterPlaceholder: "Search By Part Description"
            },
            {
                title: "Category Code",
                field: "category_code",
                hozAlign: "center",
                width: 150,
                headerFilter: "input",
                headerHozAlign: "center",
                headerFilterPlaceholder: "Search By Category Code"
            },
            {
                title: "Need By Date",
                field: "need_by_date",
                hozAlign: "center",
                width: 150,
                headerFilter: "input",
                headerHozAlign: "center",
                headerFilterPlaceholder: "Search By Need By Date"
            },
            {
                title: "Order Quantity",
                field: "order_quantity",
                hozAlign: "center",
                width: 150,
                headerFilter: "input",
                headerHozAlign: "center",
                headerFilterPlaceholder: "Search By Order Quantity"
            },
            {
                title: "Pending Order Quantity",
                field: "pending_order_quantity",
                hozAlign: "center",
                width: 150,
                headerFilter: "input",
                headerHozAlign: "center",
                headerFilterPlaceholder: "Search By Pending Order Quantity"
            },
            {
                title: "Plant On-Hand Quantity",
                field: "plant_on_hand_quantity",
                hozAlign: "center",
                width: 150,
                headerFilter: "input",
                headerHozAlign: "center",
                headerFilterPlaceholder: "Search By Plant On-Hand Quantity"
            },
            {
                title: "Value",
                field: "value",
                hozAlign: "center",
                width: 150,
                headerFilter: "input",
                headerHozAlign: "center",
                headerFilterPlaceholder: "Search By Value"
            },
            {
                title: "Time Buffer Penetration",
                field: "time_buffer_penetration",
                hozAlign: "center",
                width: 150,
                headerFilter: "input",
                headerHozAlign: "center",
                headerFilterPlaceholder: "Search By Time Buffer Penetration"
            },
            {
                title: "Time Mfg Start Date",
                field: "mfg_start_date",
                hozAlign: "center",
                width: 150,
                headerFilter: "input",
                headerHozAlign: "center",
                headerFilterPlaceholder: "Search By Time Mfg Start Date"
            },
            {
                title: "Original Request Date",
                field: "original_request_date",
                hozAlign: "center",
                width: 150,
                headerFilter: "input",
                headerHozAlign: "center",
                headerFilterPlaceholder: "Search By Original Request Date"
            },
            {
                title: "Original Request Date",
                field: "original_request_dates",
                hozAlign: "center",
                width: 150,
                headerFilter: "input",
                headerHozAlign: "center",
                headerFilterPlaceholder: "Search By Original Request Date"
            },
            {
                title: "Spike Order Resaon",
                field: "spike_order_resaon",
                hozAlign: "center",
                width: 150,
                headerFilter: "input",
                headerHozAlign: "center",
                headerFilterPlaceholder: "Search By Spike Order Resaon"
            },
            {
                title: "Open Job Order Qty",
                field: "open_job_order_qty",
                hozAlign: "center",
                width: 150,
                headerFilter: "input",
                headerHozAlign: "center",
                headerFilterPlaceholder: "Search By Open Job Order Qty"
            },
            {
                title: "Net Pending Order Quantity",
                field: "net_pending_order_quantity",
                hozAlign: "center",
                width: 150,
                headerFilter: "input",
                headerHozAlign: "center",
                headerFilterPlaceholder: "Search By Net Pending Order Quantity"
            },
            {
                title: "",
                field: "order_type",
                hozAlign: "center",
                width: 150,
                headerFilter: "input",
                headerHozAlign: "center",
                headerFilterPlaceholder: "Search"
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