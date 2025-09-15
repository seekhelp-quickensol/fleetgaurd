<?php include('header.php'); ?>
<style>

</style>
<div class="main-content">
    <div class="sub-content">
        <div class="page-header">
            <h1 class="page-title">
                Report


            </h1>
            <button class="btn btn-outline-secondary">
                <i class="bi bi-arrow-repeat"></i> Refresh
            </button>
        </div>

        <?php include('tabs.php'); ?>



        <!-- tab content  -->
        <div class="tab-content mt-3" id="myTabContent">

            <div class="tab-pane fade show active fade-in " id="main-table" role="tabpanel">

                <h6 class="mb-3">BPR MTS Shortage Report</h6>
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
        //define an array of spreasheet data
        var sheetData = [
            ["Item", "Description", "Intransit", "DOM.STEEL", "Receiving", "REJECT_RM", "Scrap", "PROCESS REJ.SCRAP", "SHOP.RM", "SHOP.SA", "OSP", "Total Quantity", "Unit Cost", "Total Cost", "MAX.Quantity", "On Hand", "Production Line", "Trading Flag"],
            [101023999, "CIRCLIP", 0, 243, 0, 0, 0, 0, 0, 0, 0, 263, 5.4693, 1438.4259, 150, 263, "", ""],
            [101042799, "TAPE, BOPP", 0, 0, 0, 0, 0, 0, 1, 0, 0, 9802.36, 0.52213, 5118.10623, 31202, 9802.36, "", ""],
            [101046199, "ADHESIVE, LOCTITE", 0, 0, 0, 0, 0, 0, 10.00001, 0, 0, 2490.63696, 8.84358, 22026.14721, 119, 2490.63696, "", ""],
            [101067199, "BAG, POLY", 0, 0, 0, 0, 0, 0, 0, 0, 0, 4556, 1.39844, 6371.29264, 4741, 4556, "", ""],
            [101070500, "EJECTOR VALVE", 20, 0, 0, 0, 0, 0, 0, 0, 0, 20, 20.88813, 417.7626, 0, 0, "LPK LINE", ""],
            [101042799, "TAPE, BOPP", 0, 0, 0, 0, 0, 0, 1, 0, 0, 9802.36, 0.52213, 5118.10623, 31202, 9802.36, "", ""],
            [101023999, "CIRCLIP", 0, 243, 0, 0, 0, 0, 0, 0, 0, 263, 5.4693, 1438.4259, 150, 263, "", ""],
            [101067199, "BAG, POLY", 0, 0, 0, 0, 0, 0, 0, 0, 0, 4556, 1.39844, 6371.29264, 4741, 4556, "", ""],
            [101046199, "ADHESIVE, LOCTITE", 0, 0, 0, 0, 0, 0, 10.00001, 0, 0, 2490.63696, 8.84358, 22026.14721, 119, 2490.63696, "", ""],
            [101070500, "EJECTOR VALVE", 20, 0, 0, 0, 0, 0, 0, 0, 0, 20, 20.88813, 417.7626, 0, 0, "LPK LINE", ""],
            [101023999, "CIRCLIP", 0, 243, 0, 0, 0, 0, 0, 0, 0, 263, 5.4693, 1438.4259, 150, 263, "", ""],
            [101067199, "BAG, POLY", 0, 0, 0, 0, 0, 0, 0, 0, 0, 4556, 1.39844, 6371.29264, 4741, 4556, "", ""],
            [101046199, "ADHESIVE, LOCTITE", 0, 0, 0, 0, 0, 0, 10.00001, 0, 0, 2490.63696, 8.84358, 22026.14721, 119, 2490.63696, "", ""],
            [101070500, "EJECTOR VALVE", 20, 0, 0, 0, 0, 0, 0, 0, 0, 20, 20.88813, 417.7626, 0, 0, "LPK LINE", ""],
            [101023999, "CIRCLIP", 0, 243, 0, 0, 0, 0, 0, 0, 0, 263, 5.4693, 1438.4259, 150, 263, "", ""],
            [101067199, "BAG, POLY", 0, 0, 0, 0, 0, 0, 0, 0, 0, 4556, 1.39844, 6371.29264, 4741, 4556, "", ""],
            [101046199, "ADHESIVE, LOCTITE", 0, 0, 0, 0, 0, 0, 10.00001, 0, 0, 2490.63696, 8.84358, 22026.14721, 119, 2490.63696, "", ""],
            [101070500, "EJECTOR VALVE", 20, 0, 0, 0, 0, 0, 0, 0, 0, 20, 20.88813, 417.7626, 0, 0, "LPK LINE", ""],
            [101023999, "CIRCLIP", 0, 243, 0, 0, 0, 0, 0, 0, 0, 263, 5.4693, 1438.4259, 150, 263, "", ""],
            [101067199, "BAG, POLY", 0, 0, 0, 0, 0, 0, 0, 0, 0, 4556, 1.39844, 6371.29264, 4741, 4556, "", ""],
            [101046199, "ADHESIVE, LOCTITE", 0, 0, 0, 0, 0, 0, 10.00001, 0, 0, 2490.63696, 8.84358, 22026.14721, 119, 2490.63696, "", ""],
            [101070500, "EJECTOR VALVE", 20, 0, 0, 0, 0, 0, 0, 0, 0, 20, 20.88813, 417.7626, 0, 0, "LPK LINE", ""],
            [101023999, "CIRCLIP", 0, 243, 0, 0, 0, 0, 0, 0, 0, 263, 5.4693, 1438.4259, 150, 263, "", ""],
            
        ];


        //Build Tabulator
        var table = new Tabulator(".manufacturer-tables", {


            spreadsheet: true,
            layout: "fitDataStretch",
            spreadsheetRows: 10,
            spreadsheetColumns: 10,
            spreadsheetColumnDefinition: {
                editor: "input"
            },
            spreadsheetData: sheetData,
            progressiveLoad: "scroll",
            selectableRange: true,
            selectableRangeColumns: true,
            selectableRangeRows: true,
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