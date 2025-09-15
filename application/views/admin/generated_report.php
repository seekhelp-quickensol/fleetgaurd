<?php include('header.php'); ?>
<style>
.custom-header{
    background: red !important;
}
</style>
<div class="main-content">
    <div class="sub-content">
        <div class="page-header">
            <h1 class="page-title">
                Report


            </h1>
            <!-- <button class="btn btn-outline-secondary">
                <i class="bi bi-arrow-repeat"></i> Refresh
            </button> -->
            <button id="submit" type="submit" class="btn btn-dark btn-sm mt-4 submit-btn">Submit</button>
        </div>

        <?php include('tabs.php'); ?>



        <!-- tab content  -->
        <div class="tab-content mt-3" id="myTabContent">

            <div class="tab-pane fade show active fade-in " id="main-table" role="tabpanel">

                <h6 class="mb-3">BPR MTS Shortage Report</h6>
                <div class="list-data">
                    <div class="">
                        <div class="report-table mt-1 p-2"></div>

                    </div>
                </div>

            </div>


        </div>
    </div>
    <?php include('footer.php'); ?>
    <script>
        var projectData = [{
                category: "OES",
                subline: "Child Parts",
                item_number: "101201531",
                customer_name: "Tata Motors Limited (OES-Hariyana from Pune)",
                pack_size: 1,
                green_level: 42,
                reservation: 0,
                intransit: 0,
                gap_quantity: 42,
                penetration_percentage: 100,
                priority_mark: "1 BLACK",
                on_hand: 0,
                actual_gap_qty: 42,
                pending_qty_after_plan: 27,
                full_qty: 0,
                plan_qty: 15,
                status_after_plan: 64,
                shortage: 0,
                air_cleaner: 0,
                kit_assy: 0,
                rejection_qty: 0,
                reciving_work_order_qty: 0,
                shortage_parts: "",
                short_qty: "",
                action: ""
            },
            {
                category: "After Market",
                subline: "Kit-Air Cleaner",
                item_number: "105081000",
                customer_name: "Fleetguard Filters Private Limited-(WADD)",
                pack_size: 1,
                green_level: 7,
                reservation: 0,
                intransit: 0,
                gap_quantity: 7,
                penetration_percentage: 100,
                priority_mark: "1 BLACK",
                on_hand: 0,
                actual_gap_qty: 7,
                pending_qty_after_plan: 4,
                full_qty: 0,
                plan_qty: 3,
                status_after_plan: 57,
                shortage: 7,
                air_cleaner: 0,
                kit_assy: 6,
                rejection_qty: 0,
                reciving_work_order_qty: 0,
                shortage_parts: "",
                short_qty: "",
                action: ""
            },
            {
                category: "OE",
                subline: "Child Parts",
                item_number: "500982474",
                customer_name: "Mahindra Vehicle Manufacturers Ltd.",
                pack_size: 12,
                green_level: 48,
                reservation: 0,
                intransit: 0,
                gap_quantity: 48,
                penetration_percentage: 100,
                priority_mark: "1 BLACK",
                on_hand: 0,
                actual_gap_qty: 48,
                pending_qty_after_plan: 31,
                full_qty: 0,
                plan_qty: 17,
                status_after_plan: 65,
                shortage: 0,
                air_cleaner: 0,
                kit_assy: 0,
                rejection_qty: 0,
                reciving_work_order_qty: 0,
                shortage_parts: "",
                short_qty: "",
                action: ""
            },
            {
                category: "OE",
                subline: "Kit-Air Cleaner",
                item_number: "501580005",
                customer_name: "VE Commercial Vehicles Limited (OE)",
                pack_size: 1,
                green_level: 17,
                reservation: 0,
                intransit: 0,
                gap_quantity: 17,
                penetration_percentage: 100,
                priority_mark: "1 BLACK",
                on_hand: 0,
                actual_gap_qty: 17,
                pending_qty_after_plan: 17,
                full_qty: 0,
                plan_qty: 0,
                status_after_plan: 100,
                shortage: 0,
                air_cleaner: 0,
                kit_assy: 0,
                rejection_qty: 0,
                reciving_work_order_qty: 0,
                shortage_parts: "",
                short_qty: "",
                action: ""
            }
        ];

        var table = new Tabulator(".report-table", {
            pagination: true,
            paginationSize: 10,
            selectable: true,
            renderHorizontal:"virtual",
           
            // responsiveLayout: "collapse",
            columns: [{
                    title: "Category",
                    field: "category",
                    hozAlign: "center",
                    // headerFilter: "input",
                    headerSort: true,
                    cssClass: "custom-header"
                   
                },
                {
                    title: "Subline",
                    field: "subline",
                    hozAlign: "center",
                    // headerFilter: "input"
                },
                {
                    title: "Item Number",
                    field: "item_number",
                    hozAlign: "center",
                    // headerFilter: "input"
                },
                {
                    title: "Customer Name",
                    field: "customer_name",
                    hozAlign: "center",
                    // headerFilter: "input"
                },
                {
                    title: "Pack Size",
                    field: "pack_size",
                    hozAlign: "center"
                },
                {
                    title: "Green Level",
                    field: "green_level",
                    hozAlign: "center"
                },
                {
                    title: "Reservation",
                    field: "green_level",
                    hozAlign: "center"
                },
                {
                    title: "Intransit",
                    field: "green_level",
                    hozAlign: "center"
                },
                {
                    title: "Gap Quantity",
                    field: "gap_quantity",
                    hozAlign: "center"
                },
                {
                    title: "Penetration %",
                    field: "penetration_percentage",
                    hozAlign: "center"
                },
                {
                    title: "Priority Mark",
                    field: "priority_mark",
                    hozAlign: "center"
                },
                {
                    title: "OnHand",
                    field: "on_hand",
                    hozAlign: "center"
                },
                {
                    title: "Actual Gap Quantity",
                    field: "actual_gap_qty",
                    hozAlign: "center"
                },
                {
                    title: "Pending Qty after Plan",
                    field: "pending_qty_after_plan",
                    hozAlign: "center"
                },
                {
                    title: "Full Quantity",
                    field: "full_qty",
                    hozAlign: "center"
                },
                {
                    title: "Plan Qty",
                    field: "plan_qty",
                    hozAlign: "center"
                },
                {
                    title: "Status After plan",
                    field: "status_after_plan",
                    hozAlign: "center"
                },
                {
                    title: "Shortage",
                    field: "shortage",
                    hozAlign: "center"
                },
                {
                    title: "Air Cleaner On Hand",
                    field: "air_cleaner",
                    hozAlign: "center"
                },
                {
                    title: "Kit Assy On Hand",
                    field: "kit_assy",
                    hozAlign: "center"
                },
                {
                    title: "Rejection Qty",
                    field: "rejection_qty",
                    hozAlign: "center"
                },
                {
                    title: "Receiving work order qty",
                    field: "reciving_work_order_qty",
                    hozAlign: "center"
                },
                {
                    title: "Shortage Parts",
                    field: "shortage_parts",
                    hozAlign: "center"
                },
                {
                    title: "Short Quantity",
                    field: "short_qty",
                    hozAlign: "center"
                },
                {
                    title: "Action",
                    field: "action",
                    width: 150,
                    hozAlign: "center",
                    formatter: function(cell, formatterParams) {
                        return `
                    
                    <button class="btn btn-sm btn-outline-dark edit" title="Edit">
                        <i class="bi bi-pencil"></i>
                    </button>
                `;
                    },
                    cellClick: function(e, cell) {
                        let row = cell.getRow();
                        if (e.target.classList.contains("delete-row")) {
                            row.delete();
                        }
                    }
                }
            ],
            data: projectData,
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#master').addClass('active');
        });
    </script>
     <script>
        $('.submit-btn').click(function() {

            window.location.href = "<?= base_url() ?>bpr-work-order";

        });
    </script>