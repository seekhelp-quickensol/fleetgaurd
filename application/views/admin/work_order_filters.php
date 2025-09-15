<style>
.report-cs {
    background: #fce7e7;
    padding: 3px 10px;
    border-radius: 4px;
    border: 1px solid #ee2e241c;
    font-size:9px;
}

.singledatepickers {
    width: 100%;
}
.form-data{
   min-height:auto !important;
}
.main-form{
    padding:15px 30px;
}
</style>

<div class="form-data mb-3 main-form">
    <div class="row">
        <div class="form-group col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12">
            <h6 class=" mt-4">BPR Work Order <br><?php if(!empty($report_details)){ ?>
                <span class="mb-3 report-cs">For Report:
                    <span><?=$report_details->report_number; ?>/<?=date('d-m-Y',strtotime($report_details->created_on)); ?></span></span>
                <?php }else if(!empty($shift_details)){ ?>
                <span class="mb-3 report-cs">For Shift:
                    <span><?=$shift_details->name . ' (' . date('h:i A',strtotime($shift_details->from)) . ' to ' . date('h:i A',strtotime($shift_details->to)) . ')'; ?></span></span>
                <?php } ?>
            </h6>
        </div>
         <div class="form-group col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <label>Line<b class="require">*</b></label>
            <select class="form-control js-example-basic-single" style="width:100%" id="filter_line">
                <option value="">Select Line</option>
                <?php if(!empty($lines)){ foreach($lines as $row){ ?>
                <option value="<?=$row->id; ?>"><?=$row->line_name; ?></option>
                <?php }} ?>
            </select>
        </div>
        <div class="form-group col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12"
            <?php if(isset($_GET['filter_shift'])){?>style="display: block;" <?php }else{?>style="display: none;"
            <?php }?>>
            <label>Date</label>
            <input autocomplete="off" type="text" class="form-control singledatepickers" name="filter_date"
                id="filter_date"
                value="<?php if(isset($_GET['filter_shift']) && isset($_GET['filter_date'])){?><?=$_GET['filter_date']?><?php }else if(isset($_GET['filter_shift']) && !isset($_GET['filter_date'])){?><?=date('d-m-Y')?><?php }?>"
                placeholder="Select Date">
        </div>
        <input type="hidden" id="filter_report" name="filter_report"
            value="<?=isset($_GET['filter_report']) ? $_GET['filter_report'] : ''; ?>">
        <input type="hidden" id="filter_work_order" name="filter_work_order"
            value="<?=isset($_GET['filter_work_order']) ? $_GET['filter_work_order'] : ''; ?>">
        <input type="hidden" id="filter_shift" name="filter_shift"
            value="<?=isset($_GET['filter_shift']) ? $_GET['filter_shift'] : ''; ?>">



           <div class="form-group col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <button id="apply" type="button" class="btn btn-dark apply-btn" style="margin-top:30px">Apply</button>
        </div>

    </div>

    <!-- <div class="row flex_wrap">
        <div class="form-group col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <button id="apply" type="button" class="btn btn-dark btn-sm mt-4 apply-btn">Apply</button>
        </div>
    </div> -->
</div>