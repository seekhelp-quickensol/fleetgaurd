<?php include('header.php'); ?>

<style>

    .error_messages {

        color: red;

    }

</style>

<div class="main-content">

    <div class="sub-content">
<!-- 
        <div class="page-header">

            <h1 class="page-title">Line Master</h1>

        </div> -->

       



        <div class="tab-content" id="myTabContent">

            <div class="tab-pane fade show active fade-in" id="main-table" role="tabpanel">

                <h6 class="mb-3">

                    <?php if (!empty($single)) { ?>

                        Update Line Master

                    <?php } else { ?>

                        Add Line Master

                    <?php } ?>

                </h6>

                <form method="post" name="line_master_form" id="line_master_form" enctype="multipart/form-data">

                    <div class="form-data mb-4">

                        <div class="row flex_wrap">

                            <!-- Plant Name Dropdown -->

                            <div class="form-group col-xl-3 col-lg-3 col-md-4 col-sm-12 col-xs-12">

                                <label>Plant Name <b class="require">*</b></label>

                                <select class="form-control js-example-basic-single" id="plant_id" name="plant_id">

                                    <option value="">Select Plant</option>

                                    <?php if (!empty($plants)) {

                                        foreach ($plants as $plants_result) { ?>

                                            <option value="<?= $plants_result->id ?>" <?php if (!empty($single) && $single->plant_id == $plants_result->id) { ?>selected="selected" <?php } ?>>

                                                <?= $plants_result->plant_name ?></option>

                                    <?php }

                                    } ?>

                                    <!-- Add more plants as needed -->

                                </select>

                            </div>

                            <!-- Plant Code (readonly) -->

                            <div class="form-group col-xl-3 col-lg-3 col-md-4 col-sm-12 col-xs-12">

                                <label>Plant Code<b class="require">*</b></label>

                                <input type="text" class="form-control ronly" id="plant_code" name="plant_code"

                                    placeholder="0" value="<?php if (!empty($single)) {

                                                                echo $single->plant_code;

                                                            } ?>" readonly>

                            </div>

                            <!-- Workshop Dropdown -->

                            <div class="form-group col-xl-3 col-lg-3 col-md-4 col-sm-12 col-xs-12">

                                <label>Workshop <b class="require">*</b></label>

                                <select class="form-control js-example-basic-single" id="workshop_id" name="workshop_id">

                                    <option value="">Select Workshop</option>

                                    <?php if (!empty($workshops)) {

                                        foreach ($workshops as $workshops_result) { ?>

                                            <option value="<?= $workshops_result->id ?>" <?php if (!empty($single) && $single->workshop_id == $workshops_result->id) { ?>selected="selected" <?php } ?>>

                                                <?= $workshops_result->workshop_name ?></option>

                                    <?php }

                                    } ?>

                                </select>

                            </div>

                            <!-- Line Name Input -->

                            <div class="form-group col-xl-3 col-lg-3 col-md-4 col-sm-12 col-xs-12">

                                <label>Line Name <b class="require">*</b></label>

                                <input type="text" class="form-control" id="line_name" name="line_name"

                                    placeholder="Enter Line Name" value="<?php if (!empty($single)) {

                                                                                echo $single->line_name;

                                                                            } ?>">

                                <span id="error_messages" class="error_messages"></span>

                            </div>

                            <input type="hidden" class="form-control" id="id" name="id"

                                value="<?php if (!empty($single)) {

                                            echo $single->id;

                                        } ?>">

                            <!-- Line Code Input -->

                            <div class="form-group col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">

                                <label>Line Code <b class="require">*</b></label>

                                <input type="text" class="form-control" id="line_code" name="line_code"

                                    placeholder="Enter Line Code" value="<?php if (!empty($single)) {

                                                                                echo $single->line_code;

                                                                            } ?>">

                                <span id="error_message" class="error_messages"></span>

                            </div>

                            <?php if(!empty($shifts)) { foreach($shifts as $shifts_result) { ?>
                                <div class="form-group col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <label><?=$shifts_result->name;?> Production Time (In Minutes)</label>
                                    <input type="text" class="form-control" id="line_<?=$shifts_result->id;?>_production_time" name="line_production_time[]" placeholder="Enter Production Time (In Minutes)" value="">
                                    <input type="hidden" class="form-control" id="line_shift_id_<?=$shifts_result->id;?>" name="line_shift_id[]" value="<?=$shifts_result->id;?>">
                                </div>
                            <?php }}?>

                           <div class="form-group col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">

                                <button id="submit" type="submit" class="btn btn-dark" style="margin-top:30px">Submit</button>

                            </div>

                        </div>

                    </div>

                </form>



                <h6 class="mb-3">Line List</h6>

                <div class="list-data">

                    <div class="line-table mt-1 p-2"></div>

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

            $.validator.addMethod("noSpaceAtStart", function(value, element) {

                return this.optional(element) || /^\s/.test(value) === false;

            }, "First letter cannot be space");



            $("#line_master_form").validate({

                ignore: [],

                rules: {

                    plant_id: {

                        required: true

                    },

                    plant_code: {

                        required: true

                    },

                    workshop_id: {

                        required: true

                    },

                    line_name: {

                        required: true,

                        noSpaceAtStart: true

                    },

                    line_code: {

                        required: true,

                        noSpaceAtStart: true

                    }

                },

                messages: {

                    plant_id: {

                        required: "Please select plant !"

                    },

                    plant_code: {

                        required: "Please select plant !"

                    },

                    workshop_id: {

                        required: "Please select workshop !"

                    },

                    line_name: {

                        required: "Please enter line name !",

                        noSpaceAtStart: "Please enter valid line name !"

                    },

                    line_code: {

                        required: "Please enter line code !",

                        noSpaceAtStart: "Please enter valid line code !"

                    }

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





            $('#plant_id, #workshop_id').change(function() {

                $(this).valid();

            });



        });

    </script>



    <script>

        $(document).ready(function() {

            $('#plant_id').change(function() {

                var plant_id = $(this).val();

                if (plant_id) {

                    $.ajax({

                        url: '<?= base_url() ?>admin/Ajax_controller/get_all_plant_codes',

                        type: 'POST',

                        data: {

                            plant_id: plant_id

                        },

                        success: function(response) {

                            if (response) {

                                var details = $.parseJSON(response);



                                $.each(details, function(i, data) {

                                    $('#plant_code').val(data.plant_code);

                                });

                            } else {

                                console.warn('No plant code found in response');

                                $('#plant_code').val('');

                            }

                        },

                        error: function(xhr, status, error) {

                            console.error('AJAX error:', status, error);

                            alert('Error retrieving plant code. Please try again.');

                        }

                    });

                } else {

                    $('#plant_code').val('');

                }

            });

        });



        $('#line_name').on('keyup', function() {

            var line_name = $(this).val();

            var plant_id = $('#plant_id').val();

            var workshop_id = $('#workshop_id').val();

            $.ajax({

                url: '<?= base_url() ?>admin/Ajax_controller/check_unique_line_name',

                method: 'post',

                data: {

                    'line_name': line_name,

                    'plant_id': plant_id,

                    'workshop_id': workshop_id,

                    'id': '<?= $id ?>'

                },

                success: function(response) {

                    if (response == 1) {

                        $('#error_messages').text("This line name is already added !");

                        $('#submit').prop('disabled', true);

                    } else {

                        $('#error_messages').text("");

                        $('#submit').prop('disabled', false);

                    }

                },

                error: function(jqXHR, textStatus, errorThrown) {

                    console.error('AJAX Error: ' + textStatus, errorThrown);

                }

            });

        });



        $('#line_code').on('keyup', function() {

            var line_code = $(this).val();

            var line_name = $(this).val();

            var plant_id = $('#plant_id').val();

            var workshop_id = $('#workshop_id').val();

            $.ajax({

                url: '<?= base_url() ?>admin/Ajax_controller/check_unique_line_code',

                method: 'post',

                data: {

                    'line_code': line_code,

                    'line_name': line_name,

                    'plant_id': plant_id,

                    'workshop_id': workshop_id,

                    'id': '<?= $id ?>'

                },

                success: function(response) {

                    if (response == 1) {

                        $('#error_message').text("This line code is already added !");

                        $('#submit').prop('disabled', true);

                    } else {

                        $('#error_message').text("");

                        $('#submit').prop('disabled', false);

                    }

                },

                error: function(jqXHR, textStatus, errorThrown) {

                    console.error('AJAX Error: ' + textStatus, errorThrown);

                }

            });

        });

    </script>



    <script>

        var table = new Tabulator(".line-table", {

            pagination: true,

            paginationSize: 10,

            selectable: true,

            layout: "fitColumns",

            responsiveLayout: "collapse",

            ajaxURL: "<?= base_url() ?>admin/Ajax_controller/get_all_line_list_ajax",

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

                    title: "Plant Name",

                    field: "plant_name",

                    hozAlign: "center",

                    headerFilter: "input",

                    headerHozAlign: "center",

                    headerFilterPlaceholder: "Search By Plant Name"



                },

                {

                    title: "Plant Code",

                    field: "plant_code",

                    hozAlign: "center",

                    headerFilter: "input",

                    headerHozAlign: "center",

                    headerFilterPlaceholder: "Search By Plant Code"



                },

                {

                    title: "Workshop",

                    hozAlign: "center",

                    field: "workshop_name",

                    headerFilter: "input",

                    headerHozAlign: "center",

                    headerFilterPlaceholder: "Search By Workshop"

                },

                {

                    title: "Line Name",

                    hozAlign: "center",

                    field: "line_name",

                    headerFilter: "input",

                    headerHozAlign: "center",

                    headerFilterPlaceholder: "Search By Line Name"

                },

                {

                    title: "Line Code",

                    hozAlign: "center",

                    field: "line_code",

                    headerFilter: "input",

                    headerHozAlign: "center",

                    headerFilterPlaceholder: "Search By Line Code"

                },



                {

                    title: "Status",

                    field: "status",

                    hozAlign: "center",

                    headerFilter: "input",

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

                      href="<?= base_url('inactive/tbl_line/') ?>${id}"

                      onclick="return confirm('Are you sure you want to inactivate this?');">

                      <i class="bi bi-x-circle"></i>

                      </a>`;

                        } else {

                            action = `

                      <a class="btn btn-sm btn-outline-dark edit-row btn-success text-white"

                      href="<?= base_url('active/tbl_line/') ?>${id}"

                      onclick="return confirm('Are you sure you want to activate this ?');">

                      <i class="bi bi-check-circle "></i>

                      </a>`;

                        }

                        action += `

                  <a class="btn btn-sm btn-outline-danger me-1 delete-row"

                  href="<?= base_url('delete/tbl_line/') ?>${id}"

                  onclick="return confirm('Are you sure you want to delete this ?');">

                      <i class="bi bi-trash"></i>

                  </a>

                  <a class="btn btn-sm btn-outline-dark edit-row"

                  href="<?php echo base_url('add-line-master/'); ?>${id}">

                      <i class="bi bi-pencil"></i>

                  </a>`;

                        return action;

                    }

                }

            ],

        });

        document.getElementById("download-xlsx").addEventListener("click", function() {

            table.download("xlsx", "data.xlsx", {

                sheetName: "My Data"

            });

        });



        function showToast(message, type) {

            console.log(type + ': ' + message);

        }

    </script>



     <script>
    $(document).ready(function() {
        $('#master .nav-link').addClass('nav_active');
        $('#master .child_menu').addClass('show');
         $('#line').addClass('active_cc');

    });
  
    </script>
</div>