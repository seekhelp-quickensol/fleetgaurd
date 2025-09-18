<?php include('header.php'); ?>
<style>
.custom-header {
    background: red !important;
}

table thead th {
    width: auto !important;
    white-space: nowrap;
}

table {
    width: 100%;
    table-layout: auto;
    /* Allows columns to adjust based on content */

}

.custom-modal-md {
    max-width: 600px;
    margin: 1.75rem auto;
}

.bg-red {
    background: red !important;
    color: white !important;
}

.bg-green {
    background: green !important;
    color: white !important;
}

.bg-violet {
    background: purple !important;
    color: white !important;
}

.bg-yellow {
    background: yellow !important;
    color: black !important;
}

.bg-sky {
    background: skyblue !important;
}

.submit-btn {
    background-color: #323338;
}

.table-striped {
    font-size: 14px;
}
.btn-primary{
    background-color: #323338;
    font-size:13px;
    border:1px solid #323338;
}
.btn-primary:hover{
    background-color: #323338;
    font-size:13px;
    border:1px solid #323338;
}
.page-title {
    display: block;
}
.page-title span{
font-size:14px;
}


.download-btns {
    background: none;
    border: 1px solid #ccc;
    padding: 5px;
    font-weight: 500;
    border-radius: 4px;
    font-size:13px;
	color:#000;
	text-decoration: none;
}


</style>
<div class="main-content">
    <div class="sub-content">
        <div class="page-header">
            <h1 class="page-title">
                Report<br><span><?=$report_details->report_number;?>/<?=date("d-m-Y", strtotime(trim($report_details->created_on)));?></span>
            </h1>
            <!-- <a href="<?=base_url();?>bpr-work-order/<?=$report_details->report_number;?>" class="btn btn-dark btn-sm mt-4 submit-btn">Submit</a> -->
        </div>




        <!-- tab content  -->
        <div class="tab-content mt-3" id="myTabContent">

            <div class="tab-pane fade show active fade-in " id="main-table" role="tabpanel">

                <h6 class="mb-3">Shortage Summary Report</h6>
                <div class="list-data">
                <div style="margin-bottom: 15px;">
                    <a href="<?= base_url('export-bpr-shortage-summary-report/' . $report_number); ?>" class="download-btns p-2 mb-2">
						<i class="fas fa-download"></i>&nbsp;Download XLSX
					</a>
					
				</div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>SR NO</th>
									<th>Type Of BPR trigger</th>
									<th>Shortage Parts</th>
									<th>Description</th>
									<th>Sum of Short Qty</th>
									<th>Req for how many FG Partrs</th>
									<th>Req for how many FG Partrs (COUNT)</th>
									<th>Supplier Name 1</th>
									<th>Trigger for Supplier 1</th>
									<th>Supplier Name 2</th>
									<th>Trigger for Supplier 2</th>
									<th>Supplier Name 3</th>
									<th>Trigger for Supplier 3</th>
									<th>Total Trigger QTY </th>
								</tr>
							</thead>
							<tbody>
								<?php if (!empty($report_data)) {
									$i = $this->uri->segment(3, 1) * 10 - 9; // Adjust SR NO based on page number
									
									foreach ($report_data as $report_result) { 
                                        $item_supplier_one_data = $this->Admin_model->get_item_supplier_one_data($report_result->report_id, $report_result->material_code);
                                        $item_supplier_two_data = $this->Admin_model->get_item_supplier_two_data($report_result->report_id, $report_result->material_code);
                                        $item_supplier_three_data = $this->Admin_model->get_item_supplier_three_data($report_result->report_id, $report_result->material_code);
                                        $shortage_fg = $this->Admin_model->get_for_shortage_fg_details($report_result->report_id, $report_result->material_code, $report_result->report_type);
                                ?>
										<tr>
											<td><?= $i++; ?></td>
											<td><?= $report_result->report_type; ?></td>
											<td><?= $report_result->item_no; ?></td>
											<td><?= $report_result->item_description; ?></td>
											<td><?= $report_result->total_short_quantity; ?></td>
                                            <td>
                                                <?php
                                                    if(!empty($shortage_fg))
                                                    {
                                                        foreach($shortage_fg as $fg)
                                                        {
                                                            echo $fg->ffpl_item_number . ', ';
                                                        }
                                                    }
                                                ?>
                                            </td>
											<td><?=count($shortage_fg);?></td>
											<td><?php if(!empty($item_supplier_one_data)) { echo $item_supplier_one_data->supplier_name; }else{ echo '-';} ?></td>
											<td><?php if(!empty($item_supplier_one_data)) { echo $item_supplier_one_data->trigger; }else{ echo '-';} ?></td>
											<td><?php if(!empty($item_supplier_two_data)) { echo $item_supplier_two_data->supplier_name; }else{ echo '-';} ?></td>
											<td><?php if(!empty($item_supplier_two_data)) { echo $item_supplier_two_data->trigger; }else{ echo '-';} ?></td>
											<td><?php if(!empty($item_supplier_three_data)) { echo $item_supplier_three_data->supplier_name; }else{ echo '-';} ?></td>
											<td><?php if(!empty($item_supplier_three_data)) { echo $item_supplier_three_data->trigger; }else{ echo '-';} ?></td>
											<td></td>
										</tr>
									<?php }
								} ?>
							</tbody>
						</table>
						<!-- Pagination Links -->
						<div class="pagination-container">
							<?= $pagination; ?>
						</div>

                    </div>
                </div>

            </div>


        </div>
    </div>
    <!-- Modal 1: Enter Plan Qty -->
    <div class="modal fade" id="planQtyModal" tabindex="-1" aria-labelledby="planQtyModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <form id="planQtyForm" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="planQtyModalLabel">Enter Plan Qty</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3 form-group">
                            <label for="plan_quantity" class="form-label">Plan Quantity</label>
                            <input type="number" class="form-control" id="plan_quantity" name="plan_quantity" min="1" />
                            <input type="hidden" class="form-control" id="id" name="id"/>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="change_plan_quantity" value="submit">Submit</button>
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
                    <p class="mb-1">Following item number(s) affected when plan quantity changed:<p class="mb-1">- 101201531</p><p class="mb-1">- 105081000</p><p class="mb-1">- 100981474</p>
                        </p>
                    </p>
                    <button type="button" class="btn btn-success " data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    <?php include('footer.php'); ?>

    <script>
        var table;
        var oldExportAction = function (self, e, dt, button, config) {
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

        var newExportAction = function (e, dt, button, config) {
            var self = this;
            var oldStart = dt.settings()[0]._iDisplayStart;
            dt.one('preXhr', function (e, s, data) {
                data.start = 0;
                data.length = 2147483647;
                dt.one('preDraw', function (e, settings) {
                    oldExportAction(self, e, dt, button, config);
                    dt.one('preXhr', function (e, s, data) {
                        settings._iDisplayStart = oldStart;
                        data.start = oldStart;
                    });
                    setTimeout(dt.ajax.reload, 0);
                    return false;
                });
            });
            dt.ajax.reload();
        };

        table = $('#example').DataTable({
            "lengthChange": true,
            "scrollX": true,
            "lengthMenu": [10, 25, 50, 100, 200, 500],
            'searching': true,
            "processing": false,
            "serverSide": false,
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
                    modifier: { search: 'applied', order: 'applied' }
                }
            }],
            dom: "lfrtip",
            scrollCollapse: true,
        });
	</script>
	 <script>
    $(document).ready(function() {
        $('#report-management .nav-link').addClass('nav_active');
        $('#report-management .child_menu').addClass('show');
        $('#report-list').addClass('active_cc');

    });
  
    </script>

    