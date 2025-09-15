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

                <h6 class="mb-3">BPR MTS Shortage Report</h6>
                <div class="list-data">
                <div style="margin-bottom: 15px;">

					<!-- <button class="download-btns p-2 mb-2" id="download-xlsx"> <i class="fas fa-download"></i>&nbsp;Download XLSX</button> -->
							
					<a href="<?= base_url('export_bpr_mts_shortage_report/' . $report_number); ?>" class="download-btns p-2 mb-2">
						<i class="fas fa-download"></i>&nbsp;Download XLSX
					</a>
					<a href="<?= base_url('bpr-mto-shortage-report/' . $report_number.'/1'); ?>" class="download-btns p-2 mb-2">
						View MTO Shortage Report
					</a>

				</div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>SR NO</th>
									<th>Category</th>
									<th>Subline</th>
									<th>Item Number</th>
									<th>Customer Name</th>
									<th>Pack Size</th>
									<th>Green Level</th>
									<th>Reservation</th>
									<th>Intransit</th>
									<th>Gap Quantity</th>
									<th>Penetration %</th>
									<th>Priority Mark</th>
									<th>Plant Onhand</th>
									<th>Net Gap</th>
									<!-- <th class="bg-sky">Pending Qty after Plan</th> -->
									<th class="bg-green">Full Quantity</th>
									<th class="bg-yellow">Plan Qty</th>
									<th class="bg-red">Pending Qty after Plan</th>
									<th class="bg-violet">Status After Plan</th>
									<th class="bg-green">Air Cleaner On Hand</th>
									<th class="bg-green">Kit Assy On Hand</th>
									<th class="bg-green">Shortage Parts</th>
									<th class="bg-green">Discription</th>
									<th class="bg-green">Short Quantity</th>
									<th class="bg-sky">RM Rejection Qty</th>
									<th>Receiving Work Order Qty</th>
									<th>Source 1</th>
									<th>Source 2</th>
									<th>Source 3</th>
									<th>Remark</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php if (!empty($report_data)) {
									$i = $this->uri->segment(3, 1) * 10 - 9; // Adjust SR NO based on page number
									
									foreach ($report_data as $report_result) { ?>
										<tr>
											<td><?= $i++; ?></td>
											<td><?= $report_result->category; ?></td>
											<td><?= $report_result->sub_line; ?></td>
											<td><?= $report_result->ffpl_item_number; ?></td>
											<td><?= $report_result->customer_name; ?></td>
											<td><?= $report_result->pack_size; ?></td>
											<td><?= $report_result->green_level; ?></td>
											<td><?= $report_result->reservation; ?></td>
											<td><?= $report_result->intransit; ?></td>
											<td><?= $report_result->gap_qty; ?></td>
											<td><?= $report_result->penetration_in_percentage; ?></td>
											<td><?= $report_result->priority_mark; ?></td>
											<td><?= $report_result->actual_on_hand; ?></td>
											<td><?= $report_result->actual_gap; ?></td>
											<!-- <td><?= $report_result->pending_qty_after_plan; ?></td> -->
											<td><?= $report_result->full_qty; ?></td>
											<td><?= $report_result->plan_qty; ?></td>
											<td><?= $report_result->actual_gap-$report_result->plan_qty; ?></td>
											<td><?= $report_result->status_after_plan; ?></td>
											<td><?= $report_result->air_cleaner_on_hand; ?></td>
											<td><?= $report_result->kit_assy_on_hand; ?></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td><?= $report_result->remark; ?></td>
											<td>
												<button class="btn btn-sm btn-outline-dark edit" title="Edit"
														data-bs-toggle="modal" data-bs-target="#planQtyModal" onclick="openPlanQtyUpdate('<?=$report_result->report_id;?>', '<?=$report_result->actual_gap;?>', '<?=$report_result->ffpl_item_number;?>')">
													<i class="bi bi-pencil"></i>
												</button>
											</td>
										</tr>
										<?php if (!empty($report_result->shortage_parts)) {
											foreach ($report_result->shortage_parts as $shortage_part_result) { ?>
												<tr>
													<td></td>
													<td></td>
													<td></td>
													<td><?= $report_result->ffpl_item_number; ?></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td><?= $report_result->priority_mark; ?></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td><?= $shortage_part_result->item_no; ?></td>
													<td><?= $shortage_part_result->description; ?></td>
													<td><?= $shortage_part_result->short_quantity; ?></td>
													<td></td>
													<td></td>
													<td><?= $shortage_part_result->source_first; ?></td>
													<td><?= $shortage_part_result->source_two; ?></td>
													<td><?= $shortage_part_result->source_three; ?></td>
													<td></td>
													<td></td>
												</tr>
											<?php }
										} ?>
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
                        <h5 class="modal-title" id="planQtyModalLabel">Enter Net Gap Qty</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3 form-group">
                            <label for="actual_gap" class="form-label">Net Gap Quantity</label>
                            <input type="number" class="form-control" id="actual_gap" name="actual_gap" min="1" />
                            <input type="hidden" class="form-control" id="report_id" name="report_id"/>
                            <input type="hidden" class="form-control" id="ffpl_item_number" name="ffpl_item_number"/>
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
		function openPlanQtyUpdate(report_id, actual_gap, ffpl_item_number){
			// alert("Report ID: " + report_id + "\nActual Gap: " + actual_gap + "\nFFPL Item Number: " + ffpl_item_number);
			$('#report_id').val(report_id);
			$('#actual_gap').val(actual_gap);
			$('#ffpl_item_number').val(ffpl_item_number);
		}
		$(document).ready(function() {
			$('#master').addClass('active');
		});
		document.getElementById('download-xlsx').addEventListener('click', function () {
			let table = document.querySelector('table');
			let wb = XLSX.utils.table_to_book(table, { sheet: "Sheet 1" });
			XLSX.writeFile(wb, 'BPR_MTS_Shortage_Report.xlsx');
		});
		

		
		$("#planQtyForm").validate({
			rules: {
				plan_quantity: {
					required: true,
				},
			},
			messages: {
				plan_quantity: {
					required: "Please enter the plan quantity !",
				},
			},
			errorElement: 'span',
			errorPlacement: function(error, element) {
				error.addClass('invalid-feedback');
				element.closest('.form-group').append(error);
			},
			highlight: function(element, errorClass, validClass) {
				$(element).addClass('is-invalid');
			},
			unhighlight: function(element, errorClass, validClass) {
				$(element).removeClass('is-invalid');
			}
		});
	</script>

	 <script>
    $(document).ready(function() {
        $('#report-management .nav-link').addClass('nav_active');
        $('#report-management .child_menu').addClass('show');
        $('#report-list').addClass('active_cc');

    });
  
    </script>


    