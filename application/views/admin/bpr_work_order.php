<?php include('header.php'); ?>
<style>
.custom-header {
    background: red !important;
}

.page-title {
    display: block;
}

.page-title span {
    font-size: 14px;
}

.table-container {
    width: 100%;
    /* overflow-x: auto; */
}

table {
    /* width: 1800px; */
    border-collapse: collapse;
    text-align: center;
}

th,
td {
    border: 1px solid #ccc;
    padding: 8px;
    font-size: 11px;
    white-space: nowrap;
}


.report-list {
    margin-bottom: 0px !important;
}
th{
    background: #eef0f2 !important;
}

/* .dt-scroll-body {
    overflow: hidden !important;
} */

th {
    background: #e1eff2;
    position: sticky;
    top: 0;
    z-index: 2;
}

.dt-search {
    margin-bottom: 10px !important;
}

.black {
    background: black;
    color: white;
}

.red {
    background: red;
    color: white;
}

.yellow {
    background: yellow;
}

.green {
    background: lightgreen;
}

/* .input-td .form-control {
    width: 60px !important;
}

.form-control {
    width: 60px;
} 

.input-td .select2 {
    width: 60px !important;
} */

input {
    width: 100%;
    box-sizing: border-box;
    border: 1px solid #bbb;
    border-radius: 4px;
    padding: 4px;
    text-align: center;
}
input[readonly]{
    padding: 4px;
    text-align: center;
}

.table-data {
    margin: 10px;
}

.kpi-container {
    margin-bottom: 20px;
}

.kpi-row {
    display: flex;
  gap: 4px;
    margin-bottom: 15px;
}

.kpi-card {
    flex: 1;
    padding: 4px;
    border-radius: 4px;
    color: #fff;
    text-align: center;
    font-weight: bold;
    border: 1px solidrgba(231, 231, 231, 0.42);
    /* max-width: 75px; */
}

.kpi-card h4 {
    color: #212529;
    font-size: 9px;
    margin-bottom: 8px;
}

.kpi-card p {
        color: #4d4d52;
    font-size: 10px;
    margin: 0;
    background: #ffffff47;
    margin-bottom: 6px;
    border-radius: 10px;
    /* border: 1px solid #dee2e6; */
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}


.c-1 {
    background-color: #a5d6a7;
}

/* faint green */
.c-2 {
    background-color: #fff59d;
}

/* faint yellow */
.c-3 {
    background-color: rgb(219, 221, 190);
}

/* faint red */
.c-4 {
    background-color: rgb(179, 210, 235);
}

/* faint blue */
.c-5 {
    background-color: #ce93d8;
}

/* faint purple */
.c-6 {
    background-color: hsl(220, 63.20%, 85.10%);
}

/* faint pink */
.c-7 {
    background-color: #80cbc4;
}

/* faint teal */
.c-8 {
    background-color: #ffccbc;
}

/* faint orange */
.c-9 {
    background-color: #cfd8dc;
}

/* faint gray */
.c-10 {
    background-color: #81d4fa;
}

/* faint cyan */
.c-11 {
    background-color: #ef9a9a
}

/* faint cyan */
/* Responsive */
@media (max-width: 768px) {
    table {
        width: 1200px;
    }

    th,
    td {
        font-size: 12px;
        padding: 6px;
    }
}

.dt-info {
    display: none !important;
}
</style>
<div class="main-content">
    <div class="sub-content">
        <!-- tab content  -->
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active fade-in " id="main-table" role="tabpanel">

                <?php include('work_order_filters.php'); ?>
                <div class="list-data mt-0" style="display: none;">
                    <!-- counters -->
                    <!-- KPI Cards Section -->
                    <?php if(isset($_GET['filter_shift'])){?>
                        <div class="kpi-container">
                            <!-- First row of counters -->
                            <div class="kpi-row">
                                <div class="kpi-card c-1">
                                    <p id="production_target_total">0</p>
                                    <h4>Production Target</h4>
                                
                                </div>
                                <div class="kpi-card c-2">
                                    <p id="production_total">0</p>
                                    <h4>Actual Production</h4>
                                
                                </div>
                                <div class="kpi-card c-9 ">
                                    <p id="line_oee_percentage">0%</p>
                                    <h4>Line OEE Against Cycle Time </h4>
                                    
                                </div>
                                <div class="kpi-card c-9 ">
                                    <p id="plan_vs_actual_percentage">0%</p>
                                    <h4>Plan vs Actual Production </h4>
                                
                                </div>
                                <div class="kpi-card c-9 ">
                                    <p id="material_issue_vs_actual_percentage">0%</p>
                                    <h4>Material Issue Vs Actual Production </h4>
                                    
                                </div>


                                <div class="kpi-card c-6">
                                    <p id="total_production_time">0</p>
                                    <h4>Total Production Time <br> (In Min.)</h4>
                                
                                </div>
                                <div class="kpi-card c-7">
                                        <p id="required_time_full_kit_qty">0</p>
                                    <h4>Required Time for Full Kit Qty <br> (In Min.)</h4>
                                </div>
                                <div class="kpi-card c-8">
                                    <p id="required_time_plan_qty">0</p>
                                    <h4>Required Time for Plan Qty <br>(In Min.)</h4>
                                </div>
                                <div class="kpi-card c-9">
                                    <p id="total_production_time_consumed">0</p>
                                    <h4>Total Time Consuming  Production (In Min.)</h4>
                                </div>
                                <div class="kpi-card c-10">
                                        <p id="balance_time">0</p>
                                    <h4>Balance Time <br>(In Min.)</h4>
                                </div>
                                <div class="kpi-card c-11">
                                    <p id="extra_time">0</p>
                                    <h4>Extra Time (In Min.)</h4>
                                </div>
                            </div>
                        </div>
                    <?php }?>
                    <!-- Your existing table will come below this -->
                    <!-- table -->
                    <div class="table-container">
                        <table class="table table-data report-list " id="example">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Work Order No</th>
                                    <th>BPR Status</th>
                                    <th>Priority</th>
                                    <th>Part Number</th>
                                    <th>Customer Item Number</th>
                                    <th>Cycle Time (Sec)</th>
                                    <th>Change over Time (Sec)</th>
                                    <th>Gap Qty</th>
                                    <th>Full Kit Qty</th>
                                    <th>Plan Qty</th>
                                    <th>Material Issue Qty</th>
                                    <th>Job Order No</th>
                                    <th>Production Qty</th>
                                    <th>ATag Qty</th>
                                    <th>Date</th>
                                    <th>Assign Shift</th>
                                    <th>Production Status</th>
                                    <th>Planner Remark</th>
                                    <th>Store Remark</th>
                                    <th>Production Remark</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>

                            <tfoot>
                                <tr>
                                    <th colspan="6">Total</th>
                                    <th>0</th>
                                    <th>0</th>
                                    <th>0</th>
                                    <th>0</th>
                                    <th>0</th>
                                    <th>0</th>
                                    <th></th>
                                    <th>0</th>
                                    <th>0</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('footer.php'); ?>
<script>
var table;
var oldExportAction = function(self, e, dt, button, config) {
    if (button[0].className.indexOf('buttons-excel') >= 0) {
        if ($.fn.dataTable.ext.buttons.excelHtml5.available(dt, config)) {
            $.fn.dataTable.ext.buttons.excelHtml5.action.call(self, e, dt, button, config);
        } else {
            $.fn.dataTable.ext.buttons.excelFlash.action.call(self, e, dt, button, config);
        }
    } else if (button[0].className.indexOf('buttons-print') >= 0) {
        $.fn.dataTable.ext.buttons.print.action(e, dt, button, config);
    }
};

var newExportAction = function(e, dt, button, config) {
    var self = this;
    var oldStart = dt.settings()[0]._iDisplayStart;
    dt.one('preXhr', function(e, s, data) {
        data.start = 0;
        data.length = 2147483647;
        dt.one('preDraw', function(e, settings) {
            oldExportAction(self, e, dt, button, config);
            dt.one('preXhr', function(e, s, data) {
                settings._iDisplayStart = oldStart;
                data.start = oldStart;
            });
            setTimeout(dt.ajax.reload, 0);
            return false;
        });
    });
    dt.ajax.reload();
};

$(document).ready(function() {
    <?php if(isset($_GET['filter_shift'])){?>
    $('#shift-toggle .sidebar-link-div').addClass('active');
    $('#shift-list-<?=$_GET['filter_shift'];?>').addClass('active');
    $(".shift-dropdown").slideToggle().toggleClass('act');
    <?php }else if(isset($_GET['filter_report'])){?>
    $('#report').addClass('active');
    $('#report-list').addClass('active');
    $(".report-dropdown").slideToggle().toggleClass('act');
    <?php }?>

    // Apply filter button
    $('.apply-btn').on('click', function(e) {
        e.preventDefault();
        if ($('#filter_line').val() != '') {
            $('.list-data').show();
        } else {
            $('.list-data').hide();
        }
        fetchAndUpdateProductionTime(function() {
            loadTable();
        });
    });

    //loadTable();
});

function fetchAndUpdateProductionTime(callback) {
    var lineId = $('#filter_line').val();
    var shiftId = $('#filter_shift').val();

    $.ajax({
        url: "<?= base_url('admin/Ajax_controller/get_production_time_ajax'); ?>",
        type: "POST",
        data: {
            line_id: lineId,
            shift_id: shiftId
        },
        dataType: "json",
        success: function(res) {
            console.log(res);
            var productionTime = res.production_time || 0;
            $('#total_production_time').text(productionTime);

            // If a callback function is provided, execute it
            if (typeof callback === 'function') {
                callback();
            }
        },
        error: function() {
            $('#total_production_time').text('0'); // Set default on error
            if (typeof callback === 'function') {
                callback();
            }
        }
    });
}

function loadTable() {
    if ($.fn.DataTable.isDataTable('#example')) {
        table.ajax.reload();
        return;
    }

    table = $('#example').DataTable({
        "paging": false, // Disable pagination controls
        "scrollX": true,
        'searching': true,
        "processing": true,
        "serverSide": true,
        "cache": false,
        "order": [],
        "columnDefs": [{
            "orderable": false,
            "className": "dt-center",
            "targets": "_all"
        }],
        buttons: [{
            extend: "excelHtml5",
            filename: "Shortage Items",
            action: newExportAction,
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
                modifier: {
                    search: 'applied',
                    order: 'applied'
                }
            }
        }],
        dom: "frt",
        scrollCollapse: true,
        ajax: {
            url: "<?= base_url(); ?>admin/Ajax_controller/get_shortage_item_data_ajax",
            type: "POST",
            data: function(d) {
                d.filter_report = $('#filter_report').val();
                d.filter_shift = $('#filter_shift').val();
                d.filter_work_order = $('#filter_work_order').val();
                d.filter_line = $('#filter_line').val();
                d.filter_date = $('#filter_date').val();
            }
        },
        footerCallback: function(row, data, start, end, display) {
            var api = this.api();

            // A more robust function to parse numbers, returning 0 for blank or invalid values
            var intVal = function(i) {
                if (typeof i === 'string') {
                    i = i.replace(/[\$,]/g, ''); // Remove currency formatting
                }
                var num = parseFloat(i);
                return isNaN(num) ? 0 : num; // Return 0 if not a number
            };

            // --- Get Dynamic Total Production Time ---
            var totalProductionTime = intVal($('#total_production_time').text());


            // --- Initialize variables ---
            let totalRequiredFullKitTimeSeconds = 0;
            let totalRequiredPlanTimeSeconds = 0;
            let totalTimeConsumedSeconds = 0;
            let productionTargetTotal = 0;
            let actualProductionTotal = 0;
            let materialIssueTotal = 0;
            let planQtyTotal = 0;
            let tagQtyTotal = 0;
            let gapQtyTotal = 0;

            // --- Iterate over all visible rows to read current values from inputs ---
            api.rows({
                search: 'applied'
            }).every(function() {
                var rowNode = this.node();
                var rowData = this.data();

                // Read values from original data or input fields
                const cycleTime = intVal(rowData[6]);
                const changeoverTime = intVal(rowData[7]);
                const gapQty = intVal(rowData[8]);
                const fullKitQty = intVal(rowData[9]);
                const planQty = intVal($(rowNode).find('input[id^="plan_qty_"]').val());
                const materialIssueQty = intVal($(rowNode).find('input[id^="issue_qty_"]').val());
                const productionQty = intVal($(rowNode).find('input[id^="production_qty_"]').val());
                const tagQty = intVal($(rowNode).find('input[id^="tag_qty_"]').val());

                // Sum totals
                productionTargetTotal += fullKitQty;
                actualProductionTotal += productionQty;
                materialIssueTotal += materialIssueQty;
                planQtyTotal += planQty;
                tagQtyTotal += tagQty;
                gapQtyTotal += gapQty;

                // Time calculations
                totalRequiredFullKitTimeSeconds += (cycleTime * fullKitQty) + changeoverTime;
                totalRequiredPlanTimeSeconds += (cycleTime * planQty) + changeoverTime;
                totalTimeConsumedSeconds += (cycleTime * productionQty) + changeoverTime;
            });

            // --- Update Footer ---
            $(api.column(8).footer()).html(gapQtyTotal);
            $(api.column(9).footer()).html(productionTargetTotal);
            $(api.column(10).footer()).html(planQtyTotal);
            $(api.column(11).footer()).html(materialIssueTotal);
            $(api.column(13).footer()).html(actualProductionTotal);
            $(api.column(14).footer()).html(tagQtyTotal);

            // --- Update KPI Cards ---
            $('#production_target_total').text(productionTargetTotal);
            $('#production_total').text(actualProductionTotal);

            // Time-based KPIs
            const requiredTimeMinutes = totalRequiredFullKitTimeSeconds / 60;
            $('#required_time_full_kit_qty').text(requiredTimeMinutes.toFixed(0));
            $(api.column(6).footer()).html('');

            const requiredTimePlanMinutes = totalRequiredPlanTimeSeconds / 60;
            $('#required_time_plan_qty').text(requiredTimePlanMinutes.toFixed(0));
            $(api.column(7).footer()).html(requiredTimePlanMinutes.toFixed(0));

            const totalProductionTimeConsumed = requiredTimePlanMinutes + requiredTimeMinutes;
            $('#total_production_time_consumed').text(totalProductionTimeConsumed.toFixed(0));

            let totalBalanceTime = totalProductionTime - totalProductionTimeConsumed;
            if (totalBalanceTime < 0) {
                totalBalanceTime = 0;
            }
            $('#balance_time').text(totalBalanceTime.toFixed(0));

            let totalExtraTime = totalProductionTimeConsumed - totalProductionTime;
            if (totalExtraTime < 0) {
                totalExtraTime = 0;
            }
            $('#extra_time').text(totalExtraTime.toFixed(0));

            // Percentage-based KPIs
            const timeConsumedForProductionMinutes = totalTimeConsumedSeconds / 60;
            let lineOEE = (timeConsumedForProductionMinutes / totalProductionTime) * 100;
            $('#line_oee_percentage').text((isFinite(lineOEE) ? lineOEE : 0).toFixed(0) + '%');

            let planVsActualPercentage = (productionTargetTotal > 0) ? (actualProductionTotal /
                productionTargetTotal) * 100 : 0;
            $('#plan_vs_actual_percentage').text(planVsActualPercentage.toFixed(0) + '%');

            let materialIssuePercentage = (materialIssueTotal > 0) ? (actualProductionTotal /
                materialIssueTotal) * 100 : 0;
            $('#material_issue_vs_actual_percentage').text(materialIssuePercentage.toFixed(0) + '%');
        },
        drawCallback: function(settings) {
            $('.js-example-basic-single').select2({
                width: '100%'
            });
            $(".singledatepickers").flatpickr({
                dateFormat: "d-m-Y",
            });
        }
    });
}

$(document).on('change', '.select_row', function() {
    let $row = $(this).closest('tr');

    if ($(this).is(':checked')) {
        $row.find('input').prop('readonly', false).prop('disabled', false);
        $row.find('select').prop('disabled', false).trigger('change');
        $row.find('.action-buttons').show();
    } else {
        $row.find('input').prop('readonly', true);
        $row.find('select').prop('disabled', true).trigger('change');
        $row.find('.action-buttons').hide();
    }
});

$(document).on('click', '.submit', function() {
    let $row = $(this).closest('tr');
    let rowId = $row.find('.select_row').attr('id') || '';

    // let line_id = $row.find('input[id^="line_id_"]').val();
    let line_id = $('#filter_line').val();
    let shift_id = $row.find('select[id^="selected_shift_"]').val();
    let date = $row.find('input[id^="filter_date_"]').val();

    let item = {
        shortage_items_tbl_id: $row.find('input[id^="shortage_items_tbl_id_"]').val(),
        assigned_shift: shift_id,
        date: date,
        issue_qty: $row.find('input[id^="issue_qty_"]').val(),
        job_order_no: $row.find('input[id^="order_no_"]').val(),
        production_qty: $row.find('input[id^="production_qty_"]').val(),
        tag_qty: $row.find('input[id^="tag_qty_"]').val(),
        production_status: $row.find('select[id^="production_status_"]').val(),
        planner_remark: $row.find('input[id^="planner_remark_"]').val(),
        store_remark: $row.find('input[id^="store_remark_"]').val(),
        production_remark: $row.find('input[id^="production_remark_"]').val(),
        plan_qty: $row.find('input[id^="plan_qty_"]').val(),
        report_type: $row.find('input[id^="report_type_"]').val(),
    };
    console.log('item',item);
    $.ajax({
        url: "<?= base_url('admin/Ajax_controller/set_work_order_ajax'); ?>",
        type: "POST",
        data: {
            line_id: line_id,
            shift_id: shift_id,
            date: date,
            items: [item]
        },
        dataType: "json",
        success: function(res) {
            if (res == '1') {
                Swal.fire({
                    icon: 'success',
                    title: 'Saved',
                    text: 'Work order updated successfully!'
                });
                table.ajax.reload();
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to save work order'
                });
            }
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