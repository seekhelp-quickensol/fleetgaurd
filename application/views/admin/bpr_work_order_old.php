<?php include('header.php'); ?>
<style>
.custom-header {
    background: red !important;
}

.download-btns {
    background: none;
    border: 1px solid #ccc;
    padding: 5px;
    font-weight: 500;
    border-radius: 4px;
}

.tabulator {
    border: none;
}

.page-title {
    display: block;
}

.page-title span {
    font-size: 14px;
}

.top-bar td {
    border: 1px solid #e6e6e6;
    padding: 5px;
    font-weight: 600;
    color: #555555;
    font-size: 13px;
}

.tgl-view{
    border: 1px solid black;
    background: #e1eff2;
    padding: 11px !important;
    border: 0px !important;
    font-size: 15px !important;
    color: black;
    font-weight: 600;
}
.btn-check:checked+.btn, .btn.active, .btn.show, .btn:first-child:active, :not(.btn-check)+.btn:active {
    background: #212529 !important;
}
</style>
<div class="main-content">
    <div class="sub-content">
        <div class="page-header">
            <h1 class="page-title">
                Report<br><span><?=$report_details->report_number;?>/<?=date("d-m-Y", strtotime(trim($report_details->created_on)));?></span>


            </h1>
            <!--<button id="submit" type="button" class="btn btn-dark btn-sm mt-4"
                onclick="window.location.href='report-list'">Submit</button>-->

        </div>





        <!-- tab content  -->
        <div class="tab-content mt-3" id="myTabContent">

            <div class="tab-pane fade show active fade-in " id="main-table" role="tabpanel">

                <h6 class="mb-3">BPR Work Order Report</h6>
                <div class="list-data">
                    <div class="">
                        <div class="d-flex align-items-center gap-2">
                            <button class="download-btns p-2" id="download-xlsx">
                                <i class="fas fa-download"></i>&nbsp;Download XLSX
                            </button>
                           
                            <!-- Line Master Dropdown -->
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle tgl-view" type="button" id="lineMasterDropdown"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Line Master
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="lineMasterDropdown">
									<?php if(!empty($lines)){foreach($lines as $lines_result){?>
										<li><a class="dropdown-item" href="<?=base_url();?>bpr-work-order/<?=$report_details->report_number;?>/<?=$lines_result->id;?>"><?=$lines_result->line_name;?></a></li>
									<?php }}?>
                                </ul>
                            </div>
                        </div>

                        <!-- Work Order Header -->
                        <div class="work-order-header mb-3 mt-4"
                            style="border: 1px solid #e6e6e6; padding: 10px; font-family: sans-serif;">
                            <div style="display: flex; justify-content: space-between; align-items: center;background: #e1eff2;
                             padding: 10px;">
                                <!-- <img src="fleetguard_logo.png" alt="Fleetguard Logo" style="height: 50px;"> -->
                                <h4
                                    style="text-align: center; flex-grow: 1; margin: 0;font-weight:500;font-size:18px;color:#555555">
                                    FF Auto Work Order - Loni Mfg
                                    Plant</h4>
                                <!-- <img src="filtrum_logo.png" alt="Filtrum Logo" style="height: 50px;"> -->
                            </div>

                            <table class="top-bar"
                                style="width: 100%; margin-top: 10px; border-collapse: collapse; font-size: 14px;">
                                <tr>
                                    <td>Date</td>
                                    <td><?=date("d/m/Y", strtotime(trim($report_details->created_on)));?></td>
                                    <td>Line</td>
                                    <td></td>
                                    <td>Assly Line 1</td>
                                    <td>Start Time</td>
                                    <td>8.00 am</td>
                                    <td>Revesion</td>
                                    <td>1</td>
                                </tr>
                                <tr>
                                    <td>Work Order No</td>
                                    <td></td>
                                    <td>Shift</td>
                                    <td></td>
                                    <td>First</td>
                                    <td>End Time</td>
                                    <td>4.30 pm</td>
                                    <td>Total Plan Qty</td>
                                    <td></td>
                                </tr>
                            </table>
                        </div>

                        <div class="report-table mt-1 p-1"></div>

                    </div>
                </div>

            </div>


        </div>
    </div>

    <!-- Modal 1: Enter Plan Qty -->
    <div class="modal fade" id="planQtyModal" tabindex="-1" aria-labelledby="planQtyModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <form id="planQtyForm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="planQtyModalLabel">Enter Plan Qty</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="planQtyInput" class="form-label">Plan Quantity</label>
                            <input type="number" class="form-control" id="planQtyInput" required min="1" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>

                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal 2: Success Message -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <p class="mb-0">
                    <p class="mb-1">Following item number(s) affected when plan quantity changed:
                    <p class="mb-1">- 101201531</p>
                    <p class="mb-1">- 105081000</p>
                    <p class="mb-1">- 100981474</p>
                    </p>
                    </p>
                    <button type="button" class="btn btn-success " data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
    <?php include('footer.php'); ?>

    <script>
    var projectData = [{
            srNo: 1,
            priority: "1 Black",
            itemNumber: "5024840I9",
            customerItemNumber: "T006860900880",
            cycleTime: 55,
            planQty: 30,
            plannerRemark: "Urgent",
            storeRemark: "Green",
            action: "",
        },
        {
            srNo: 2,
            priority: "1 Black",
            itemNumber: "5020349I9",
            customerItemNumber: "T006860900680",
            cycleTime: 55,
            planQty: 100,
            plannerRemark: "Mat in Receving",
            action: "",
        },
        {
            srNo: 3,
            priority: "1 Black",
            itemNumber: "502407030",
            customerItemNumber: "252709140120",
            cycleTime: 55,
            planQty: 30,
            action: "",
        },
        {
            srNo: 4,
            priority: "2 Red",
            itemNumber: "5022652K8",
            customerItemNumber: "2007336",
            cycleTime: 55,
            planQty: 10,
            action: "",
        },
        {
            srNo: 5,
            priority: "2 Red",
            itemNumber: "502437534",
            customerItemNumber: "252709150309",
            cycleTime: 55,
            planQty: 14,
            action: "",
        },
        {
            srNo: 6,
            priority: "2 Red",
            itemNumber: "826053230",
            customerItemNumber: "252709130328",
            cycleTime: 55,
            planQty: 20,
            action: "",
        },
        {
            srNo: 7,
            priority: "2 Red",
            itemNumber: "501133330",
            customerItemNumber: "253409140315",
            cycleTime: 55,
            planQty: 33,
            action: "",
        },
        {
            srNo: 8,
            priority: "3 Yellow",
            action: "",
        },
        {
            srNo: 9,
            priority: "3 Yellow",
            action: "",
        },
        {
            srNo: 10,
            priority: "3 Yellow",
            action: "",
        },
        {
            srNo: 11,
            priority: "3 Yellow",
            action: "",
        },
        {
            srNo: 12,
            priority: "4 Green",
            action: "",
        },
        {
            srNo: 13,
            priority: "4 Green",
            action: "",
        },
        {
            srNo: 14,
            priority: "4 Green",
            action: "",
        }
    ];

    var table = new Tabulator(".report-table", {
        pagination: "local",
        paginationSize: 10,
        selectable: true,
        layout: "fitColumns",
        columns: [{
                title: "Sr.No",
                field: "srNo",
                hozAlign: "center",
                width: 60

            },
            {
                title: "Priority",
                field: "priority",
                hozAlign: "center"
            },
            {
                title: "Item Number",
                field: "itemNumber",
                hozAlign: "center"
            },
            {
                title: "Customer Item Number",
                field: "customerItemNumber",
                hozAlign: "center"
            },
            {
                title: "Customer ",
                field: "customer",
                hozAlign: "center"
            },
            {
                title: "Cycle Time (Sec)",
                field: "cycleTime",
                hozAlign: "center"
            },
            {
                title: "Gap Quantity",
                field: "gapQuantity",
                hozAlign: "center"
            },
            {
                title: "Full Quantity",
                field: "fullQuantity",
                hozAlign: "center"
            },
            {
                title: "Plan Qty",
                field: "planQty",
                hozAlign: "center"
            },
            {
                title: "Material Issue Qty ",
                field: "materialIssueQty",
                hozAlign: "center"
            },
            {
                title: "Changeover Time (Min)",
                field: "changeoverTime",
                hozAlign: "center"
            },
            {
                title: "Start Time",
                field: "startTime",
                hozAlign: "center"
            },
            {
                title: "End Time",
                field: "endTime",
                hozAlign: "center"
            },
            {
                title: "Planner Remark",
                field: "plannerRemark",
                hozAlign: "center"
            },
            {
                title: "Store Remark",
                field: "storeRemark",
                hozAlign: "center"
            },
            {
                title: "Action",
                field: "action",
                hozAlign: "center",
                formatter: function(cell, formatterParams) {
                    return `
                          
                           <button class="btn btn-sm btn-outline-dark edit" title="Edit"
                                            >
                                            <i class="bi bi-pencil"></i>
                                        </button>
                        `;
                },

                cellClick: function(e, cell) {
                    let row = cell.getRow();
                    if (e.target.classList.contains("delete-row")) {
                        row.delete(); // Delete row
                    }

                }
            }

        ],
        data: projectData,
    });


    //trigger download of data.xlsx file
    document.getElementById("download-xlsx").addEventListener("click", function() {
        table.download("xlsx", "data.xlsx", {
            sheetName: "My Data"
        });
    });
    </script>
    <script>
    $(document).ready(function() {
        $('#master').addClass('active');
    });
    </script>