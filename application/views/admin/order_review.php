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

                <h6 class="mb-3">Order Review</h6>
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
        ajaxURL: "<?= base_url() ?>admin/Ajax_controller/get_all_order_report_data_ajax",
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
                title: "Category ",
                field: "category",
                hozAlign: "center",
                width: 120,
                headerFilter: "input",
                headerHozAlign: "center",
                headerFilterPlaceholder: "Search By Category"
            },
            {
                title: "Sub Line",
                field: "sub_line",
                hozAlign: "center",
                width: 200,
                headerFilter: "input",
                headerHozAlign: "center",
                headerFilterPlaceholder: "Search By Sub Line"
            },
            {
                title: "FFPL Item Number",
                field: "ffpl_item_number",
                hozAlign: "center",
                width: 150,
                headerFilter: "input",
                headerHozAlign: "center",
                headerFilterPlaceholder: "Search By FFPL Item Number"
            },
            {
                title: "FFPL Item Description",
                field: "ffpl_item_description",
                hozAlign: "center",
                width: 200,
                headerFilter: "input",
                headerHozAlign: "center",
                headerFilterPlaceholder: "Search By FFPL Item Description"
            },
            {
                title: "Customer Item Number",
                field: "customer_item_number",
                hozAlign: "center",
                width: 150,
                headerFilter: "input",
                headerHozAlign: "center",
                headerFilterPlaceholder: "Search By Customer Item Number"
            },
            {
                title: "Customer Item Description",
                field: "customer_item_description",
                hozAlign: "center",
                width: 150,
                headerFilter: "input",
                headerHozAlign: "center",
                headerFilterPlaceholder: "Search By Customer Item Description"
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
                title: "Pack Size",
                field: "pack_size",
                hozAlign: "center",
                width: 150,
                headerFilter: "input",
                headerHozAlign: "center",
                headerFilterPlaceholder: "Search By Pack Size"
            },
            {
                title: "Green Level",
                field: "green_level",
                hozAlign: "center",
                width: 150,
                headerFilter: "input",
                headerHozAlign: "center",
                headerFilterPlaceholder: "Search By Green Level"
            },
            {
                title: "Actual On Hand ( A/M RWH / OE Depot )",
                field: "actual_on_hand",
                hozAlign: "center",
                width: 150,
                headerFilter: "input",
                headerHozAlign: "center",
                headerFilterPlaceholder: "Search By Actual On Hand"
            },
            {
                title: "Reservation",
                field: "reservation",
                hozAlign: "center",
                width: 150,
                headerFilter: "input",
                headerHozAlign: "center",
                headerFilterPlaceholder: "Search By Reservation"
            },
            {
                title: "Intransit",
                field: "intransit",
                hozAlign: "center",
                width: 150,
                headerFilter: "input",
                headerHozAlign: "center",
                headerFilterPlaceholder: "Search By Intransit"
            },
            {
                title: "Gap Qty",
                field: "gap_qty",
                hozAlign: "center",
                width: 150,
                headerFilter: "input",
                headerHozAlign: "center",
                headerFilterPlaceholder: "Search By Gap Qty"
            },
            {
                title: "Penetration in Percentage (%)",
                field: "penetration_in_percentage",
                hozAlign: "center",
                width: 150,
                headerFilter: "input",
                headerHozAlign: "center",
                headerFilterPlaceholder: "Search By Penetration in Percentage"
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
                title: "Plant Onhand",
                field: "plant_onhand",
                hozAlign: "center",
                width: 150,
                headerFilter: "input",
                headerHozAlign: "center",
                headerFilterPlaceholder: "Search By Plant Onhand"
            },
            {
                title: "Actual Gap",
                field: "actual_gap",
                hozAlign: "center",
                width: 150,
                headerFilter: "input",
                headerHozAlign: "center",
                headerFilterPlaceholder: "Search By Actual Gap"
            },
        ],
    });
    </script>
    <script>
        $(document).ready(function() {
            $('#master').addClass('active');
        });
    </script>

     <script>
    $(document).ready(function() {
        $('#report-management .nav-link').addClass('nav_active');
        $('#report-management .child_menu').addClass('show');
        $('#report-list').addClass('active_cc');

    });
  
    </script>