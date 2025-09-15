<?php include('header.php'); ?>

<style>
.error-message {
    width: 100%;
    margin-top: .25rem;
    font-size: .875em;
    color: var(--bs-form-invalid-color);
}

.select2-container {
    width: 100% !important;
}
</style>

<div class="main-content">
    <div class="sub-content">
        <!-- <div class="page-header">
            <h1 class="page-title">Part Master</h1>
        </div> -->


        <div class="tab-content " id="myTabContent">
            <div class="tab-pane fade show active fade-in" id="main-table" role="tabpanel">

                <h6 class="mb-3">
                    <?php if (!empty($single)) { ?>
                    Update Part Master
                    <?php } else { ?>
                    Add Part Master
                    <?php } ?>
                </h6>
                <form method="post" name="part_master_form" id="part_master_form" enctype="multipart/form-data">
                    <div class="form-data mb-4">
                        <div class="row flex_wrap">

                            <!-- Item Number -->
                            <div class="form-group col-xl-4 col-lg-4 col-md-4 col-sm-12">
                                <label> FG Item <b class="require">*</b></label>
                                <input type="text" class="form-control " name="finish_good_item_no"
                                    id="finish_good_item_no"
                                    value="<?php if (!empty($single)) {
                                                                                                                                        echo $single->finish_good_item_no;
                                                                                                                                    } ?>"
                                    placeholder="Enter FG item">
                                <span class="error-message" id="finish_good_item_id_error"></span>
                            </div>

                            <!-- FG Description -->
                            <div class="form-group col-xl-4 col-lg-4 col-md-4  col-sm-12">
                                <label>FG Description <b class="require">*</b></label>
                                <input type="text" class="form-control" name="finish_good_description"
                                    id="finish_good_description"
                                    value="<?php if (!empty($single)) {
                                                                                                                                                echo $single->finish_good_description;
                                                                                                                                            } ?>"
                                    placeholder="Enter FG description" readonly>
                            </div>
                            <input type="hidden" class="form-control" id="finish_good_description_id"
                                name="finish_good_description_id" value="">
                            <hr>

                            <!-- Part Type Selection Dropdown -->
                            <div class="form-group col-xl-4 col-lg-4 col-md-4 col-sm-12">
                                <label> Part Type <b class="require">*</b></label>
                                <select class="form-control js-example-basic-single" id="part_type" name="part_type">
                                    <option value="">Select Part Type</option>
                                    <option value="air_cleaner"
                                        <?php if (!empty($single) && $single->part_type == 'air_cleaner') echo 'selected'; ?>>
                                        Air Cleaner Part</option>
                                    <option value="kit_assy"
                                        <?php if (!empty($single) && $single->part_type == 'kit_assy') echo 'selected'; ?>>
                                        Kit Assy Part</option>
                                </select>
                            </div>
                        </div>

                        <!-- Air Cleaner Fields Group -->
                        <div id="air_cleaner_fields" class="row flex_wrap" style="display: none;">
                            <div class="form-group col-xl-6 col-lg-6 col-md-6  col-sm-12">
                                <label>Air Cleaner Part No <b class="require">*</b></label>
                                <input type="text" class="form-control" id="air_cleaner_part_no"
                                    name="air_cleaner_part_no"
                                    value="<?php if (!empty($single)) { echo $single->air_cleaner_part_no; } ?>"
                                    placeholder="Air cleaner part no">
                                <span id="air_cleaner_part_no_error" class="error-message"></span>
                            </div>
                            <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <label>Air Cleaner Part Description</label>
                                <input type="text" class="form-control" id="air_cleaner_part_description"
                                    name="air_cleaner_part_description"
                                    value="<?php if (!empty($single)) { echo $single->air_cleaner_part_description; } ?>"
                                    placeholder="Enter Air Cleaner Part Description" readonly>
                            </div>
                            <input type="hidden" class="form-control" id="air_cleaner_part_description_id"
                                name="air_cleaner_part_description_id" value="">
                            <div class="form-group col-xl-4 col-lg-4 col-md-6 col-sm-12">
                                <label>Line Name Hsg <b class="require">*</b></label>
                                <select class="form-control js-example-basic-single" id="line_name_hsg_id"
                                    name="line_name_hsg_id">
                                    <option value="">Select Line Name Hsg</option>
                                    <?php if (!empty($lines)) { foreach ($lines as $lines_result) { ?>
                                    <option value="<?= $lines_result->id ?>"
                                        <?php if (!empty($single) && $single->line_name_hsg_id == $lines_result->id) { ?>selected="selected"
                                        <?php } ?>>
                                        <?= $lines_result->line_name ?>
                                    </option>
                                    <?php } } ?>
                                </select>
                            </div>
                            <div class="form-group col-xl-4 col-lg-4 col-md-6 col-sm-12">
                                <label>Cycle Time (Seconds) <b class="require">*</b></label>
                                <input type="text" class="form-control" id="cycle_time1" name="cycle_time1"
                                    value="<?php if (!empty($single)) { echo $single->cycle_time1; } ?>"
                                    placeholder="Cycle Time in Seconds">
                            </div>
                            <div class="form-group col-xl-4 col-lg-4 col-md-6 col-sm-12">
                                <label>Change Over Time <b class="require">*</b></label>
                                <input type="text" class="form-control" id="change_over_time1" name="change_over_time1"
                                    value="<?php if (!empty($single)) { echo $single->change_over_time1; } ?>"
                                    placeholder="Change Over Time">
                            </div>
                        </div>

                        <!-- Kit Assy Fields Group -->
                        <div id="kit_assy_fields" class="row flex_wrap" style="display: none;">
                            <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <label>Kit Assy Part No <b class="require">*</b></label>
                                <input type="text" class="form-control" id="kit_assy_part_no" name="kit_assy_part_no"
                                    value="<?php if (!empty($single)) { echo $single->air_cleaner_part_no; } ?>"
                                    placeholder="Kit Assy Part No">
                                <span id="kit_assy_part_no_error" class="error-message"></span>
                            </div>
                            <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <label>Kit Assy Description</label>
                                <input type="text" class="form-control" id="kit_assy_description"
                                    name="kit_assy_description"
                                    value="<?php if (!empty($single)) { echo $single->air_cleaner_part_description; } ?>"
                                    placeholder="Enter Kit Assy Description" readonly>
                            </div>
                            <input type="hidden" class="form-control" id="kit_assy_description_id"
                                name="kit_assy_description_id" value="">
                            <div class="form-group col-xl-4 col-lg-4 col-md-6 col-sm-12">
                                <label>Line Name Kit <b class="require">*</b></label>
                                <select class="form-control js-example-basic-single" id="line_name_kit_id"
                                    name="line_name_kit_id">
                                    <option value="">Select Line Name Kit</option>
                                    <?php if (!empty($lines)) { foreach ($lines as $lines_result) { ?>
                                    <option value="<?= $lines_result->id ?>"
                                        <?php if (!empty($single) && $single->line_name_hsg_id == $lines_result->id) { ?>selected="selected"
                                        <?php } ?>>
                                        <?= $lines_result->line_name ?>
                                    </option>
                                    <?php } } ?>
                                </select>
                            </div>
                            <div class="form-group col-xl-4 col-lg-4 col-md-6 col-sm-12">
                                <label>Cycle Time (Seconds) <b class="require">*</b></label>
                                <input type="text" class="form-control" id="cycle_time2" name="cycle_time2"
                                    value="<?php if (!empty($single)) { echo $single->cycle_time1; } ?>"
                                    placeholder="Cycle Time in Seconds">
                            </div>
                            <div class="form-group col-xl-4 col-lg-4 col-md-6 col-sm-12">
                                <label>Change Over Time <b class="require">*</b></label>
                                <input type="text" class="form-control" id="change_over_time2" name="change_over_time2"
                                    value="<?php if (!empty($single)) { echo $single->change_over_time1; } ?>"
                                    placeholder="Change Over Time">
                            </div>
                        </div>

                        <!-- Common Fields -->
                        <div class="row flex_wrap">
                            <input type="hidden" class="form-control" id="id" name="id"
                                value="<?php if (!empty($single)) { echo $single->id; } ?>">
                            <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 mt-2">
                                <button id="submit" type="submit" class="btn btn-dark ">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
                <h6 class="mb-3">Part Master List</h6>
                <div class="list-data">
                    <div class="partmaster-table mt-1 p-2"></div>
                </div>
            </div>
        </div>
    </div>

    <?php include('footer.php'); ?>

    <?php
    $id = 0;
    if ($this->uri->segment(2) != "") {
        $id = $this->uri->segment(2);
    } ?>

    <script>
    $(document).ready(function() {
        // --- Main logic for showing/hiding fields ---
        function togglePartFields() {
            var selectedType = $('#part_type').val();
            if (selectedType === 'air_cleaner') {
                $('#air_cleaner_fields').show();
                $('#kit_assy_fields').hide();
                // Clear values from the hidden section
                $('#kit_assy_fields').find('input, select').val('');
            } else if (selectedType === 'kit_assy') {
                $('#kit_assy_fields').show();
                $('#air_cleaner_fields').hide();
                // Clear values from the hidden section
                $('#air_cleaner_fields').find('input, select').val('');
            } else {
                $('#air_cleaner_fields').hide();
                $('#kit_assy_fields').hide();
            }
        }

        // Bind the function to the dropdown's change event
        $('#part_type').on('change', function() {
            togglePartFields();
        });

        // Trigger the function on page load in case of an edit form
        togglePartFields();


        // --- Validation Logic ---
        $.validator.addMethod("noSpaceAtStart", function(value, element) {
            return this.optional(element) || /^\s/.test(value) === false;
        }, "First letter cannot be space !");

        $.validator.addMethod("noNumberAtStart", function(value, element) {
            return this.optional(element) || /^\d/.test(value) === false;
        }, "First letter cannot be number !");

        $("#part_master_form").validate({
            ignore: [],
            rules: {
                finish_good_item_no: {
                    required: true,
                    noSpaceAtStart: true,
                },
                part_type: {
                    required: true
                },
                // --- Conditional Rules ---
                air_cleaner_part_no: {
                    required: function(element) {
                        return $("#part_type").val() == 'air_cleaner';
                    },
                    noSpaceAtStart: true,
                },
                line_name_hsg_id: {
                    required: function(element) {
                        return $("#part_type").val() == 'air_cleaner';
                    }
                },
                cycle_time1: {
                    required: function(element) {
                        return $("#part_type").val() == 'air_cleaner';
                    },
                    number: true
                },
                change_over_time1: {
                    required: function(element) {
                        return $("#part_type").val() == 'air_cleaner';
                    },
                    number: true
                },
                kit_assy_part_no: {
                    required: function(element) {
                        return $("#part_type").val() == 'kit_assy';
                    },
                    noSpaceAtStart: true,
                },
                line_name_kit_id: {
                    required: function(element) {
                        return $("#part_type").val() == 'kit_assy';
                    }
                },
                cycle_time2: {
                    required: function(element) {
                        return $("#part_type").val() == 'kit_assy';
                    },
                    number: true
                },
                change_over_time2: {
                    required: function(element) {
                        return $("#part_type").val() == 'kit_assy';
                    },
                    number: true
                }
            },
            messages: {
                finish_good_item_no: {
                    required: "Please enter finish good item no !",
                },
                part_type: {
                    required: "Please select a part type!"
                },
                air_cleaner_part_no: {
                    required: "Please enter air cleaner part no !"
                },
                line_name_hsg_id: {
                    required: "Please select line name hsg !"
                },
                cycle_time1: {
                    required: "Please enter cycle time !",
                    number: "Please enter a valid number!"
                },
                change_over_time1: {
                    required: "Please enter change over time !",
                    number: "Please enter a valid number!"
                },
                kit_assy_part_no: {
                    required: "Please enter kit assy part no !",
                },
                line_name_kit_id: {
                    required: "Please select line name kit !"
                },
                cycle_time2: {
                    required: "Please enter cycle time !",
                    number: "Please enter a valid number!"
                },
                change_over_time2: {
                    required: "Please enter change over time !",
                    number: "Please enter a valid number!"
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

        $('#line_name_hsg_id, #line_name_kit_id, #part_type').change(function() {
            $(this).valid();
        });
    });

    // --- Existing AJAX calls for description fetching ---
    $("#kit_assy_part_no").keyup(function() {
        var finish_good_item_no = $(this).val();
        var id = $("#id").val();
        $.ajax({
            url: '<?= base_url() ?>admin/Ajax_controller/check_finish_good_item',
            method: 'POST',
            data: {
                finish_good_item_id: finish_good_item_no,
                id: id
            },
            success: function(response) {
                if (response == "1") {
                    $("#kit_assy_description").prop('readonly', false);
                    $("#kit_assy_part_no_error").text("");
                } else if (response == '0') {
                    $("#kit_assy_description").prop('readonly', true);
                    $("#kit_assy_part_no_error").text("");
                } else {
                    $("#kit_assy_description").prop('readonly', false);
                    $("#kit_assy_part_no_error").text("Finish Good does not exist !");
                }
            }
        });
    });

    $("#kit_assy_part_no").on('keyup change', function() {
        var finish_good_item_no = $(this).val();
        if (finish_good_item_no) {
            $.ajax({
                url: '<?= base_url(); ?>admin/Ajax_controller/get_all_finish_good_item_description',
                type: 'POST',
                data: {
                    finish_good_item_id: finish_good_item_no
                },
                success: function(response) {
                    if (response != '[]') {
                        var details = $.parseJSON(response);
                        $.each(details, function(i, data) {
                            $('#kit_assy_description').val(data.description);
                            $('#kit_assy_description_id').val(data.id);
                        });
                    } else {
                        $('#kit_assy_description').val('');
                    }
                }
            });
        } else {
            $('#kit_assy_description').val('');
        }
    });

    $("#air_cleaner_part_no").keyup(function() {
        var finish_good_item_no = $(this).val();
        var id = $("#id").val();
        $.ajax({
            url: '<?= base_url() ?>admin/Ajax_controller/check_finish_good_item',
            method: 'POST',
            data: {
                finish_good_item_id: finish_good_item_no,
                id: id
            },
            success: function(response) {
                if (response == "1") {
                    $("#air_cleaner_part_description").prop('readonly', false);
                    $("#air_cleaner_part_no_error").text("");
                } else if (response == '0') {
                    $("#air_cleaner_part_description").prop('readonly', true);
                    $("#air_cleaner_part_no_error").text("");
                } else {
                    $("#air_cleaner_part_description").prop('readonly', false);
                    $("#air_cleaner_part_no_error").text("Finish Good does not exist !");
                }
            }
        });
    });

    $("#air_cleaner_part_no").on('keyup change', function() {
        var finish_good_item_no = $(this).val();
        if (finish_good_item_no) {
            $.ajax({
                url: '<?= base_url(); ?>admin/Ajax_controller/get_all_finish_good_item_description',
                type: 'POST',
                data: {
                    finish_good_item_id: finish_good_item_no
                },
                success: function(response) {
                    if (response != '[]') {
                        var details = $.parseJSON(response);
                        $.each(details, function(i, data) {
                            $('#air_cleaner_part_description').val(data.description);
                            $('#air_cleaner_part_description_id').val(data.id);
                        });
                    } else {
                        $('#air_cleaner_part_description').val('');
                    }
                }
            });
        } else {
            $('#air_cleaner_part_description').val('');
        }
    });

    $("#finish_good_item_no").on('keyup change', function() {
        var finish_good_item_no = $(this).val();
        if (finish_good_item_no) {
            $.ajax({
                url: '<?= base_url(); ?>admin/Ajax_controller/get_all_finish_good_item_description',
                type: 'POST',
                data: {
                    finish_good_item_id: finish_good_item_no
                },
                success: function(response) {
                    if (response != '[]') {
                        var details = $.parseJSON(response);
                        $.each(details, function(i, data) {
                            $('#finish_good_description').val(data.description);
                            $('#finish_good_description_id').val(data.id);
                        });
                    } else {
                        $('#finish_good_description').val('');
                    }
                }
            });
        } else {
            $('#finish_good_description').val('');
        }
    });
    </script>

    <script>
    // --- Existing Tabulator and other scripts ---
    var table = new Tabulator(".partmaster-table", {

        pagination: true,

        paginationSize: 10,

        selectable: true,
        pagination: true,

        layout: "fitDataStretch",



        ajaxURL: "<?= base_url() ?>admin/Ajax_controller/get_all_part_master_list_ajax",

        ajaxConfig: "POST",

        ajaxContentType: "json",

        ajaxResponse: function(url, params, response) {

            console.log(response);

            return response.data;

        },



        columns: [{

                title: "Sr.No",

                field: "sr_no",

                formatter: "rownum",

                hozAlign: "center",



                headerHozAlign: "center",



                headerSort: false,

                width: 50



            },

            {

                title: "Part Type",

                field: "part_type",

                hozAlign: "center",

                headerFilter: "input",

                width: 150,

                headerHozAlign: "center",

                headerFilterPlaceholder: "Search By Part Type",

                formatter: function(cell) {

                    var part_type = cell.getValue();

                    if (part_type == 'air_cleaner') {

                        return 'Air Cleaner Part';

                    } else if (part_type == 'kit_assy') {

                        return 'Kit Assy Part';

                    }

                    return '-';

                }
            },

            {

                title: "FG Item Number",

                field: "finish_good_item_no",

                hozAlign: "center",

                headerFilter: "input",

                width: 150,

                headerHozAlign: "center",

                headerFilterPlaceholder: "Search By FG Item Number"



            },

            {

                title: "FG Description",

                field: "finish_good_description",

                hozAlign: "center",

                headerFilter: "input",

                headerHozAlign: "center",

                width: 150,

                headerFilterPlaceholder: "Search By FG Description"



            },



            {

                title: "Air Cleaner / Kit Assy Part No",

                field: "air_cleaner_part_no",

                hozAlign: "center",

                width: 150,

                headerFilter: "input",

                headerHozAlign: "center",

                headerFilterPlaceholder: "Search By Air Cleaner Part No"

            },

            {

                title: "Air Cleaner / Kit Assy Desc",

                field: "air_cleaner_part_description",

                hozAlign: "center",

                width: 150,

                headerFilter: "input",

                headerHozAlign: "center",

                headerFilterPlaceholder: "Search By Air Cleaner Desc"

            },

            {

                title: "Cycle Time (s)",

                field: "cycle_time1",

                hozAlign: "center",

                width: 150,

                headerFilter: "input",

                headerHozAlign: "center",

                headerFilterPlaceholder: "Search By Cycle Time"

            },

            {

                title: "Change Over Time",

                field: "change_over_time1",

                hozAlign: "center",

                width: 150,

                headerFilter: "input",

                headerHozAlign: "center",

                headerFilterPlaceholder: "Search By Change Over Time"

            },

            {

                title: "Line Name",

                field: "line_name",

                hozAlign: "center",

                width: 150,

                headerFilter: "input",

                headerHozAlign: "center",

                headerFilterPlaceholder: "Search By Line Name"

            },

            {

                title: "Status",

                field: "status",

                hozAlign: "center",

                headerFilter: "input",

                width: 150,

                headerHozAlign: "center",

                headerFilterPlaceholder: "Search By Status",

                formatter: function(cell) {

                    var status = cell.getValue();

                    if (status == 'active') {

                        return '<span class="badge bg-success">Active</span>';

                    } else if (status == 'inactive') {

                        return '<span class="badge bg-danger">Inactive</span>';

                    }

                    return '';

                }



            },



            {

                title: "Action",

                field: "id",

                width: 150,

                hozAlign: "center",

                headerHozAlign: "center",

                formatter: function(cell, formatterParams) {

                    var rowData = cell.getRow().getData();

                    var id = rowData.id;

                    var status = rowData.status;

                    var action = '';

                    if (status == 'active') {

                        action = `

                      <a class="btn btn-sm btn-outline-dark edit-row edit-row btn-danger text-white"

                      href="<?= base_url('inactive/tbl_part_master/') ?>${id}"

                      onclick="return confirm('Are you sure you want to inactivate this?');">

                      <i class="bi bi-x-circle"></i>

                      </a>`;

                    } else {

                        action = `

                      <a class="btn btn-sm btn-outline-dark edit-row btn-success text-white"

                      href="<?= base_url('active/tbl_part_master/') ?>${id}"

                      onclick="return confirm('Are you sure you want to activate this ?');">

                      <i class="bi bi-check-circle "></i>

                      </a>`;

                    }

                    action += `

                  <a class="btn btn-sm btn-outline-danger me-1 delete-row"

                  href="<?= base_url('delete/tbl_part_master/') ?>${id}"

                  onclick="return confirm('Are you sure you want to delete this ?');">

                      <i class="bi bi-trash"></i>

                  </a>

                  <a class="btn btn-sm btn-outline-dark edit-row"

                  href="<?php echo base_url('add-part-master/'); ?>${id}">

                      <i class="bi bi-pencil"></i>

                  </a>`;

                    return action;

                }

            }

        ],

    });





    function showToast(message, type) {

        console.log(type + ': ' + message);

    }
    </script>

    <script>
    $(document).ready(function() {
        $('#bom-master .nav-link').addClass('nav_active');
        $('#bom-master .child_menu').addClass('show');
        $('#add_part_master').addClass('active_cc');

    });
    </script>

</div>