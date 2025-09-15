<?php include('header.php'); ?>
<style>
.page-title {
    display: block;
}
.page-title span{
font-size:14px;
}
.submit-btn {
   
 
        background-color: #212529;
}
</style>
<div class="main-content">
    <div class="sub-content">
        <div class="page-header">
            <h1 class="page-title">
                Report<br><span>001/19-05-2025</span>


            </h1>
            <button id="submit" type="button" class="btn btn-sm btn-dark  submit-btn"
                    onclick="window.location.href='<?= base_url('bom-list') ?>'">
                    Submit
                </button>
        </div>
       
     



        <!-- tab content  -->
        <div class="tab-content mt-3" id="myTabContent">

            <div class="tab-pane fade show active fade-in " id="main-table" role="tabpanel">

                <h6 class="mb-3">BPR MTS Review</h6>
                <div class="list-data">
                    <div class="">
                        <div class="manufacturer-tables mt-1 p-2"></div>

                    </div>
                </div>

            </div>


        </div>
    </div>
    <?php include('footer.php'); ?>
    <script>
        
        var sheetData = [
  ["Level", "Item", "Description", "Revision", "Type", "Status", "Engineering Item", "Item Seq", "Op Seq", "Alternate", "Engineering Bill", "Comments", "UOM", "Basis", "Quantity", "Planning %", "Yield", "Extended Quantity", "Effectivity Control", "From", "To", "From Date", "To Date", "Disabled", "Implemented", "ECO", "Supply Type", "Subinventory", "Locator", "Costed", "Unit Cost", "Extended Quantity", "Extended Cost", "Operation Seq", "Manufacturing", "Offset", "Cumulative Manufacturing", "Cumulative Total", "Optional", "Mutually Exclusive", "ATP", "Min Qty", "Max Qty", "Sales Order Basis", "Shippable", "Include on Ship Docs", "Required To Ship", "Required For Revenue"],

  [0, 101023999, "CIRCLIP", 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 263, 0, 0, 263, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5.4693, 263, 1438.4259, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],

  [0, 101042799, "TAPE, BOPP", 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 9802.36, 0, 0, 9802.36, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.52213, 9802.36, 5118.10623, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],

  [0, 101046199, "ADHESIVE, LOCTITE", 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2490.63696, 0, 0, 2490.63696, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 8.84358, 2490.63696, 22026.14721, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],

  [0, 101067199, "BAG, POLY", 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 4556, 0, 0, 4556, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1.39844, 4556, 6371.29264, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],

  [0, 101070500, "EJECTOR VALVE", 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 20, 0, 0, 20, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 20.88813, 20, 417.7626, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
  [0, 101023999, "CIRCLIP", 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 263, 0, 0, 263, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5.4693, 263, 1438.4259, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],

  [0, 101042799, "TAPE, BOPP", 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 9802.36, 0, 0, 9802.36, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.52213, 9802.36, 5118.10623, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],

  [0, 101046199, "ADHESIVE, LOCTITE", 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2490.63696, 0, 0, 2490.63696, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 8.84358, 2490.63696, 22026.14721, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],

  [0, 101067199, "BAG, POLY", 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 4556, 0, 0, 4556, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1.39844, 4556, 6371.29264, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],

  [0, 101070500, "EJECTOR VALVE", 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 20, 0, 0, 20, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 20.88813, 20, 417.7626, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
  [0, 101023999, "CIRCLIP", 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 263, 0, 0, 263, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5.4693, 263, 1438.4259, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],

  [0, 101042799, "TAPE, BOPP", 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 9802.36, 0, 0, 9802.36, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.52213, 9802.36, 5118.10623, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],

  [0, 101046199, "ADHESIVE, LOCTITE", 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2490.63696, 0, 0, 2490.63696, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 8.84358, 2490.63696, 22026.14721, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],

  [0, 101067199, "BAG, POLY", 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 4556, 0, 0, 4556, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1.39844, 4556, 6371.29264, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],

  [0, 101070500, "EJECTOR VALVE", 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 20, 0, 0, 20, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 20.88813, 20, 417.7626, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
  [0, 101023999, "CIRCLIP", 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 263, 0, 0, 263, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5.4693, 263, 1438.4259, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],

  [0, 101042799, "TAPE, BOPP", 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 9802.36, 0, 0, 9802.36, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.52213, 9802.36, 5118.10623, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],

  [0, 101046199, "ADHESIVE, LOCTITE", 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2490.63696, 0, 0, 2490.63696, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 8.84358, 2490.63696, 22026.14721, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],

  [0, 101067199, "BAG, POLY", 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 4556, 0, 0, 4556, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1.39844, 4556, 6371.29264, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],

  [0, 101070500, "EJECTOR VALVE", 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 20, 0, 0, 20, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 20.88813, 20, 417.7626, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
];




        //Build Tabulator
        var table = new Tabulator(".manufacturer-tables", {


            spreadsheet: true,
            layout: "fitDataStretch",
            spreadsheetRows: 10,
            spreadsheetColumns: 10,
            // spreadsheetColumnDefinition: {
            //     editor: "input"
            // },
            spreadsheetData: sheetData,
            progressiveLoad: "scroll",
            selectableRange: true,
            selectableRangeColumns: true,
            selectableRangeRows: true,
            rowNumbers: false,
            rowHeader: {
                field: "_id",
                resizable: false,
                frozen: true,
                hozAlign: "center",
                formatter: "rownum",
                cssClass: "range-header-col"
            },
            columnDefaults: {
                headerSort: false,
                resizable: "header",
            },


            editorEmptyValue: undefined, //ensure empty values are set to undefined so they arent included in spreadsheet output data
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#master').addClass('active');
        });
    </script>