<?php include('header.php'); ?>
<style>
.spreadsheet-container .header-row {
    color: #6c757d;
    font-size: 12px;
    font-weight: 500;
    margin-bottom: 5px;


}

.modal-header {
    border-bottom: none;
}


.modal .spreadsheet-container {
    width: 100%;
}

.modal .spreadsheet-container {
    width: 100%;
}

.csv-review {
    overflow-x: scroll;
    position: relative;
    width: 100%;
    /* height: 100%; */
}
.submit-btn {
    background-color: #323338;
}
.csv-review .spreadsheet-container::before {
    position: absolute;
    content: '';
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    /* background: #00000038; */
    background: #d1ecef59;
}

.spreadsheet-container {
    position: relative;
    background-color: white;
    border-radius: 4px;
    overflow: hidden;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    /* margin-bottom: 30px; */
    width: max-content;
    height: 100%;
}

.spreadsheet-table {
    width: 100%;
    border-collapse: collapse;
}

.spreadsheet-table th,
.spreadsheet-table td {
    border: 1px solid #dee2e6;
    padding: 5px;
    font-size: 14px;
}

.spreadsheet-table th {
    background-color: #f8f9fa;
    font-weight: 500;
    text-align: center;
    color: #495057;
}

.spreadsheet-table .row-header {
    background-color: #f8f9fa;
    color: #6c757d;
    text-align: center;
    width: 40px;
}

.spreadsheet-table .col-header {
    background-color: #f8f9fa;
    color: #495057;
    font-weight: 500;
    text-align: center;
}

.spreadsheet-table tr:first-child {
    background-color: #f8f9fa;
}

.responsive-spreadsheet {
    overflow-x: auto;
}

.empty-cell {
    background-color: white;
}
.page-title {
    display: block;
}
.page-title span{
font-size:14px;
}
</style>
<div class="main-content">
    <div class="sub-content">
		<?php if(!empty($report_details)){?>
			<div class="page-header">
				<h1 class="page-title">
					Report Preview<br><span><?=$report_details->report_number;?>/<?=date("d-m-Y", strtotime(trim($report_details->created_on)));?></span>
					
				</h1>
				<form method="post">
					<input type="hidden" name="report_number" id="report_number" value="<?=$report_details->report_number;?>">
					<input type="hidden" name="report_id" id="report_id" value="<?=$report_details->id;?>">
					<button class="btn btn-dark btn-sm mt-4 submit-btn" name="generate_shortage_report" value="generate_shortage_report">
						Submit
					</button>
				</form>
				
			</div>
      
		
			<div class="row g-4">
				
				<!-- order -->
				<?php if(!empty($order_report)){?>
					<div class="col-lg-4">
						<label for="bom-report">MTS Order Report <b>(Total Quantity: <?=$order_report_count;?>)</b></label>
						<div class="csv-review">
							<div class="spreadsheet-container">
								<table class="spreadsheet-table">

									<tbody>
										<tr>
											<td class="row-header"></td>
											<td class="milestone-cell"><strong>Category</strong></td>
											<td><strong>Sub Line</strong></td>
											<td><strong>FFPL Item Number</strong></td>
											<td><strong>Ffpl Item Description</strong></td>
											<td><strong>Customer Item Number</strong></td>
											<td><strong>Customer Item Description</strong></td>
											<td><strong>Customer Name</strong></td>
											<td><strong>Pack Size</strong></td>
											<td><strong>Green Level</strong></td>
											<td><strong>Actual On Hand ( A/M RWH / OE Depot )0</strong></td>
											<td><strong>Reservation</strong></td>
											<td><strong>Intransit</strong></td>
											<td><strong>Gap Qty</strong></td>
											<td><strong>Penetration in Percentage (%)</strong></td>
											<td><strong>Priority Mark</strong></td>
											<td><strong>Plant Onhand</strong></td>
											<td><strong>Actual Gap</strong></td>
										</tr>
										<?php 
											$i=1;foreach($order_report as $order_report_result){
										?>
											<tr>
												<td class="row-header"><?=$i++;?></td>

												<td><?=$order_report_result->category;?></td>
												<td><?=$order_report_result->sub_line;?></td>
												<td><?=$order_report_result->ffpl_item_number;?></td>
												<td><?=$order_report_result->ffpl_item_description;?></td>
												<td><?=$order_report_result->customer_item_number;?></td>
												<td><?=$order_report_result->customer_item_description;?></td>
												<td><?=$order_report_result->customer_name;?></td>
												<td><?=$order_report_result->pack_size;?></td>
												<td><?=$order_report_result->green_level;?></td>
												<td><?=$order_report_result->actual_on_hand;?></td>
												<td><?=$order_report_result->reservation;?></td>
												<td><?=$order_report_result->intransit;?></td>
												<td><?=$order_report_result->gap_qty;?></td>
												<td><?=$order_report_result->penetration_in_percentage;?></td>
												<td><?=$order_report_result->priority_mark;?></td>
												<td><?=$order_report_result->plant_onhand;?></td>
												<td><?=$order_report_result->actual_gap;?></td>
											</tr>
										<?php }?>

									</tbody>
								</table>
							</div>

						</div>
						<button type="button" class="btn btn-dark w-100 my-3  order-review">
							Preview Order Report
						</button>
					</div>
				<?php }?>
				<!-- MTO order -->
				<?php if(!empty($mto_order_report)){?>
					<div class="col-lg-4">
						<label for="bom-report">MTO Order Report <b>(Total Quantity: <?=$mto_order_report_count;?>)</b></label>
						<div class="csv-review">
							<div class="spreadsheet-container">
								<table class="spreadsheet-table">

									<tbody>
										<tr>
											<td class="row-header"></td>
											<td class="milestone-cell"><strong>Organization Name</strong></td>
											<td><strong>Order Category</strong></td>
											<td><strong>Sales Order Number</strong></td>
											<td><strong>Version No</strong></td>
											<td><strong>Last Update Date</strong></td>
											<td><strong>IR Preparer Name</strong></td>
											<td><strong>Customer Name</strong></td>
											<td><strong>Line Entry date</strong></td>
											<td><strong>Customer Part No</strong></td>
											<td><strong>FF Part No</strong></td>
											<td><strong>Part Description</strong></td>
											<td><strong>Category Code</strong></td>
											<td><strong>Need By Date</strong></td>
											<td><strong>Order Quantity</strong></td>
											<td><strong>Pending Order Quantity</strong></td>
											<td><strong>Plant On-Hand Quantity</strong></td>
											<td><strong>Value</strong></td>
											<td><strong>Time Buffer Penetration</strong></td>
											<td><strong>Mfg Start Date</strong></td>
											<td><strong>Original Request Date</strong></td>
											<td><strong>Original Request Date</strong></td>
											<td><strong>Spike Order Resaon</strong></td>
											<td><strong>Open Job Order Qty</strong></td>
											<td><strong>Net Pending Order Quantity</strong></td>
											<td><strong></strong></td>
										</tr>
										<?php 
											$i=1;foreach($mto_order_report as $mto_order_report_result){
										?>
											<tr>
												<td class="row-header"><?=$i++;?></td>
												<td><?=$mto_order_report_result->organization_name;?></td>
												<td><?=$mto_order_report_result->order_category;?></td>
												<td><?=$mto_order_report_result->sales_order_number;?></td>
												<td><?=$mto_order_report_result->version_no;?></td>
												<td><?=$mto_order_report_result->last_update_date;?></td>
												<td><?=$mto_order_report_result->ir_preparer_name;?></td>
												<td><?=$mto_order_report_result->customer_name;?></td>
												<td><?=$mto_order_report_result->line_entry_date;?></td>
												<td><?=$mto_order_report_result->customer_part_no;?></td>
												<td><?=$mto_order_report_result->ff_part_no;?></td>
												<td><?=$mto_order_report_result->ff_part_description;?></td>
												<td><?=$mto_order_report_result->category_code;?></td>
												<td><?=$mto_order_report_result->need_by_date;?></td>
												<td><?=$mto_order_report_result->order_quantity;?></td>
												<td><?=$mto_order_report_result->pending_order_quantity;?></td>
												<td><?=$mto_order_report_result->plant_on_hand_quantity;?></td>
												<td><?=$mto_order_report_result->value;?></td>
												<td><?=$mto_order_report_result->time_buffer_penetration;?></td>
												<td><?=$mto_order_report_result->mfg_start_date;?></td>
												<td><?=$mto_order_report_result->original_request_date;?></td>
												<td><?=$mto_order_report_result->original_request_dates;?></td>
												<td><?=$mto_order_report_result->spike_order_resaon;?></td>
												<td><?=$mto_order_report_result->open_job_order_qty;?></td>
												<td><?=$mto_order_report_result->net_pending_order_quantity;?></td>
												<td><?=$mto_order_report_result->order_type;?></td>
											</tr>
										<?php }?>

									</tbody>
								</table>
							</div>

						</div>
						<button type="button" class="btn btn-dark w-100 my-3  mto-order-review">
							Preview Order Report
						</button>
					</div>
				<?php }?>
				<!-- inventory -->
				<?php if(!empty($inventory_report)){?>
					<div class="col-lg-4">
						<label for="bom-report">Inventory Report <b>(Total Quantity: <?=$inventory_report_count;?>)</b></label>
						<div class="csv-review">

							<div class="spreadsheet-container">
								<table class="spreadsheet-table">

									<thead>

										<tr>
											<td class="row-header"></td>
											<td class="milestone-cell"><strong>Scrap</strong></td>
											<td><strong>PROCESS REJ.SCRAP</strong></td>
											<td><strong>SHOP.RM</strong></td>
											<td><strong>SHOP.SA</strong></td>
											<td><strong>OSP</strong></td>
											<td><strong>Total Quantity</strong></td>
											<td><strong>Unit Cost</strong></td>
											<td><strong>Total Cost</strong></td>
											<td><strong>MAX.Quantity</strong></td>
											<td><strong>On Hand</strong></td>
											<td><strong>Production Line</strong></td>
											<td><strong>Trading Flag</strong></td>

										</tr>

									</thead>
									<tbody>
										<?php 
										$j=1; foreach($inventory_report as $inventory_report_result){
										?>
											<tr>
												<td class="row-header"><?=$j++;?></td>
												<td class="text-left"><?=$inventory_report_result->item;?></td>
												<td class="text-left"><?=$inventory_report_result->description;?></td>
												<td><?=$inventory_report_result->shop_rm;?></td>
												<td><?=$inventory_report_result->shop_sa;?></td>
												<td><?=$inventory_report_result->osp;?></td>
												<td><?=$inventory_report_result->total_quantity;?></td>
												<td><?=$inventory_report_result->unit_cost;?></td>
												<td><?=$inventory_report_result->total_cost;?></td>
												<td><?=$inventory_report_result->max_quantity;?></td>
												<td><?=$inventory_report_result->on_hand;?></td>
												<td><?=$inventory_report_result->production_line;?></td>
												<td class="text-left"><?=$inventory_report_result->trading_flag;?></td>
											</tr>
										<?php }?>
									</tbody>
								</table>
							</div>

						</div>
						<button type="button" class="btn btn-dark w-100 my-3 inventory-review">
							Preview Inventory Report
						</button>
					</div>
				<?php }?>
				<!-- trigger report -->
				<?php if(!empty($trigger_report)){?>
					<div class="col-lg-4">
						<label for="bom-report">Trigger Report <b>(Total Quantity: <?=$trigger_report_count;?>)</b></label>
						<div class="csv-review">

							<div class="spreadsheet-container">
								<table class="spreadsheet-table">

									<thead>

										<tr>
											<td class="row-header"></td>
											<td class="milestone-cell"><strong>Organization Name</strong></td>
											<td><strong>Vendor Name</strong></td>
											<td><strong>Vendor Site</strong></td>
											<td><strong>Item Code</strong></td>
											<td><strong>Item Description</strong></td>
											<td><strong>Release Date</strong></td>
											<td><strong>Buffer(%)</strong></td>
											<td><strong>Priority Mark</strong></td>
											<td><strong>Shipped Date</strong></td>
											<td><strong>Release Qty</strong></td>
											<td><strong>Asn Qty</strong></td>
											<td><strong>Difference</strong></td>
											<td><strong>Percentage</strong></td>
										</tr>

									</thead>
									<tbody>
										<?php
										$j=1; foreach($trigger_report as $trigger_report_result){
										?>
											<tr>
												<td class="row-header"><?=$j++;?></td>
												<td class="text-left"><?=$trigger_report_result->organization_name;?></td>
												<td class="text-left"><?=$trigger_report_result->vendor_name;?></td>
												<td><?=$trigger_report_result->vendor_site;?></td>
												<td><?=$trigger_report_result->item_no;?></td>
												<td><?=$trigger_report_result->description;?></td>
												<td><?=$trigger_report_result->release_date;?></td>
												<td><?=$trigger_report_result->buffer;?></td>
												<td><?=$trigger_report_result->priority_mark;?></td>
												<td><?=$trigger_report_result->shipped_date;?></td>
												<td><?=$trigger_report_result->release_qty;?></td>
												<td><?=$trigger_report_result->asn_qty;?></td>
												<td><?=$trigger_report_result->difference;?></td>
												<td><?=$trigger_report_result->percentage;?></td>
											</tr>
										<?php }?>
									</tbody>
								</table>
							</div>

						</div>
						<button type="button" class="btn btn-dark w-100 my-3 trigger-report-review">
							Preview Trigger Report
						</button>
					</div>
				<?php }?>
			</div>
		<?php }?>
    </div>


</div>


<?php include('footer.php'); 

$order_number = $this->uri->segment(2);
?>
<script>
$(document).ready(function() {
    $('#master').addClass('active');
    // bom review
    $('.bom-review').click(function() {
    setTimeout(function() {
        window.open("<?= base_url() ?>bom-review", '_blank');
    }, 500);
});

    // order review
    $('.order-review').click(function() {
       
        setTimeout(function() {
            window.open("<?= base_url() ?>order-review/<?=$order_number;?>", '_blank');
          
        }, 500);
    });
    // order review
    $('.mto-order-review').click(function() {

        setTimeout(function() {
            window.open("<?= base_url() ?>mto-order-review/<?=$order_number;?>", '_blank');
          
        }, 500);
    });

    // inventory review
    $('.inventory-review').click(function() {
        setTimeout(function() {
            window.open("<?= base_url() ?>inventory-review/<?=$order_number;?>", '_blank');
            
        }, 500);
    });

	// trigger report review
    $('.trigger-report-review').click(function() {
        setTimeout(function() {
            window.open("<?= base_url() ?>trigger-report-review/<?=$order_number;?>", '_blank');
        }, 500);
    });

    // $('.submit-btn').click(function() {

        // window.location.href = "<?= base_url() ?>generated-report";

    // });

});
</script>

<script>
function showFileName(input, targetId) {
    const fileName = input.files.length > 0 ? input.files[0].name : "No file chosen";
    document.getElementById(targetId).textContent = fileName;
}
</script>
<script>
// $(document).ready(function() {
    // $('.submit-btn').click(function() {

        // window.location.href = "<?= base_url() ?>BPR-MTS-shortage-report";

    // });
// })
</script>