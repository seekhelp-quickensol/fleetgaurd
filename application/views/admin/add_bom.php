<?php include('header.php'); ?>

<style>

    .error-message {

        width: 100%;

        margin-top: .25rem;

        font-size: .875em;

        color: var(--bs-form-invalid-color);

    }

</style>

<div class="main-content">

    <div class="sub-content">

      
       

        <div class="tab-content " id="myTabContent">

            <div class="tab-pane fade show active fade-in " id="main-table" role="tabpanel">

                <h6 class="mb-3">

                    <?php if (!empty($single)) { ?>

                        Update BOM

                    <?php } else { ?>

                        Add BOM

                    <?php } ?>

                </h6>

                <form method="post" name="bom_details_form" id="bom_details_form" enctype="multipart/form-data">

                    <div class="form-data mb-4">

                        <div class="row flex_wrap">

                            <div class="form-group col-xl-4 col-lg-4 col-md-4 col-sm-12">

                                <label> FG Item <b class="require">*</b></label>

                                <input type="text" class="form-control " name="finish_good_item_id" id="finish_good_item_id" value="<?php if (!empty($single)) {

                                                                                                                                        echo $single->item_no;

                                                                                                                                    } ?>"

                                    placeholder="Enter FG item">

                                <span class="error-message" id="finish_good_item_id_error"></span>



                            </div>



                            <div class="form-group col-xl-4 col-lg-4 col-md-4 col-sm-12">

                                <label>FG Item Description <b class="require">*</b></label>



                                <input type="text" class="form-control" name="item_description" id="item_description" value="<?php if (!empty($single)) {

                                                                                                                                    echo $single->fg_item_description;

                                                                                                                                } ?>"

                                    placeholder="FG Item Description" readonly>

                            </div>



                        </div>

                        <hr class="my-3">

                        <div id="more-items-wrapper">

                            <div class="row more-item-group mb-2">

                                <div class="form-group col-md-1">

                                    <label>Item No <b class="require">*</b></label>

                                    <select class="form-control js-example-basic-single" id="item_id" name="item_id">

                                        <option value="">Select Item</option>

                                        <?php if (!empty($item_numbers)) : ?>

                                            <?php foreach ($item_numbers as $item_numbers_result) : ?>

                                                <option value="<?= $item_numbers_result->id ?>"

                                                    <?= (!empty($single) && $single->item_no_id == $item_numbers_result->id) ? 'selected="selected"' : '' ?>>

                                                    <?= $item_numbers_result->item_no ?>

                                                </option>

                                            <?php endforeach; ?>

                                        <?php endif; ?>

                                    </select>

                                    <span class="error-message" id="item_id_error"></span>

                                </div>

                                <div class="form-group col-md-3">

                                    <label>Item Description</label>

                                    <input type="text" class="form-control" id="item_desc" name="item_desc" placeholder="Item Description" value="<?php if (!empty($single)) {

                                                                                                                                                        echo $single->item_desc_id;

                                                                                                                                                    } ?>" readonly>

                                </div>

                                <div class="form-group col-md-1">

                                    <label>Level <b class="require">*</b></label>

                                    <input type="text" class="form-control" name="item_no" id="item_no" value="<?php if (!empty($single)) {

                                                                                                                    echo $single->item_level;

                                                                                                                } ?>" placeholder="Enter Level">

                                </div>

                                <div class="form-group col-md-1">

                                    <label>Revision<b class="require">*</b></label>

                                    <input type="text" class="form-control" name="revision" id="revision" value="<?php if (!empty($single)) {

                                                                                                                        echo $single->revision;

                                                                                                                    } ?>" placeholder="Enter Revision">

                                </div>

                                <input type="hidden" class="form-control" name="id" id="id" value="<?php if (!empty($single)) {

                                                                                                        echo $single->id;

                                                                                                    } ?>">

                                <div class="form-group col-md-2">

                                    <label>Type<b class="require">*</b></label>

                                    <select class="form-control js-example-basic-single" name="item_type_id" id="item_type_id">

                                        <option value="">Select Type</option>

                                        <?php if (!empty($item_types)) : ?>

                                            <?php foreach ($item_types as $item_types_result) : ?>

                                                <option value="<?= $item_types_result->id ?>"

                                                    <?= (!empty($single) && $single->item_type_id == $item_types_result->id) ? 'selected="selected"' : '' ?>>

                                                    <?= $item_types_result->item_name ?>

                                                </option>

                                            <?php endforeach; ?>

                                        <?php endif; ?>

                                    </select>

                                </div>



                                <div class="form-group col-md-2">

                                    <label>Status<b class="require">*</b></label>

                                    <select class="form-control js-example-basic-single" name="status" id="status">

                                        <option value="">Select Status</option>

                                        <option value="Active" <?= (!empty($single) && $single->item_status == "Active") ? 'selected="selected"' : '' ?>>Active</option>

                                        <option value="Inactive" <?= (!empty($single) && $single->item_status == "Inactive") ? 'selected="selected"' : '' ?>>Inactive</option>



                                    </select>



                                </div>

                                <div class="form-group col-md-1">

                                    <label>UOM<b class="require">*</b></label>

                                    <select class="form-control js-example-basic-single" name="uom_id" id="uom_id">

                                        <option value="">Select Uom</option>

                                        <?php if (!empty($uoms)) : ?>

                                            <?php foreach ($uoms as $uoms_result) : ?>

                                                <option value="<?= $uoms_result->id ?>"

                                                    <?= (!empty($single) && $single->uom_id == $uoms_result->id) ? 'selected="selected"' : '' ?>>

                                                    <?= $uoms_result->unit_name ?>

                                                </option>

                                            <?php endforeach; ?>

                                        <?php endif; ?>

                                    </select>

                                </div>

                                <div class="form-group col-md-1">

                                    <label>Qty<b class="require">*</b></label>

                                    <input type="number" class="form-control" name="qty" id="qty" placeholder="Enter Qty" value="<?php if (!empty($single)) {

                                                                                                                                        echo $single->qty;

                                                                                                                                    } ?>">

                                </div>



                            </div>

                        </div>

                        <div class="form-group">

                            <button id="submit" type="submit" class="btn btn-dark " style="margin-top:30px">Submit</button>

                        </div>

                    </div>

                </form>

                <h6 class="mb-3">BOM List</h6>

                <div class="bom-data">

                    <div class="bom-table mt-1 p-2"></div>

                </div>

            </div>





        </div>

    </div>

    <?php include('footer.php'); ?>

    <script>

        $(document).ready(function() {

            $.validator.addMethod("noSpaceAtStart", function(value, element) {

                return this.optional(element) || /^\s/.test(value) === false;

            }, "First letter cannot be space");

            $("#bom_details_form").validate({

                ignore: [],

                rules: {

                    finish_good_item_id: {

                        required: true,

                    },

                    item_id: {

                        required: true

                    },

                    item_no: {

                        required: true,

                        noSpaceAtStart: true

                    },

                    revision: {

                        required: true,

                        noSpaceAtStart: true,

                        number: true

                    },

                    item_type_id: {

                        required: true,

                    },

                    status: {

                        required: true,

                    },

                    uom_id: {

                        required: true,

                    },

                    qty: {

                        required: true,

                        noSpaceAtStart: true,

                        number: true

                    },



                },

                messages: {

                    finish_good_item_id: {

                        required: "Please select finish good item !",

                    },

                    item_id: {

                        required: "Please select item !"

                    },

                    item_no: {

                        required: "Please enter level !",

                        noSpaceAtStart: "Please enter valid level !"

                    },

                    revision: {

                        required: "Please enter revision !",

                        noSpaceAtStart: "Please enter valid revision !",

                        number: "Please enter valid revision !"

                    },

                    item_type_id: {

                        required: "Please select item type !"

                    },

                    status: {

                        required: "Please select item status !"

                    },

                    uom_id: {

                        required: "Please select uom !"

                    },

                    qty: {

                        required: "Please enter qty !",

                        noSpaceAtStart: "Please enter valid qty !",

                        number: "Please enter valid qty !"

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

            $('#finish_good_item_id, #item_id, #item_type_id, #status, #uom_id').change(function() {

                $(this).valid();

            });



        });

    </script>

    <script>

        $(document).ready(function() {



            $("#finish_good_item_id").on('keyup change', function() {

                var finish_good_item_id = $(this).val();

                var id = $("#id").val();



                $.ajax({

                    url: '<?= base_url() ?>admin/Ajax_controller/check_finish_good_item',

                    method: 'POST',

                    data: {

                        finish_good_item_id: finish_good_item_id,

                        id: id

                    },

                    success: function(response) {

                        if (response == "1") {
                            $("#item_description").prop('readonly', false);
                            $("#finish_good_item_id_error").text("");
 
                        } else if (response == '0') {
                            $("#item_description").prop('readonly', true);
                            $("#finish_good_item_id_error").text("");
                        } else {
                            $("#item_description").prop('readonly', false);
                            $("#finish_good_item_id_error").text("Finish Good does not exist !");
                        }

                    }

                });

            });



            $("#finish_good_item_id").on('keyup change', function() {

                var finish_good_item_id = $(this).val();

                var id = $("#id").val();



                $.ajax({

                    type: "POST",

                    url: "<?= base_url(); ?>admin/Ajax_controller/get_all_finish_good_item_descriptions",

                    data: {

                        'finish_good_item_id': finish_good_item_id,

                    },

                    success: function(response) {

                        console.log("AJAX response:", response);

                        if (response != '[]') {

                            var details = $.parseJSON(response);



                            $.each(details, function(i, data) {



                                $('#item_description').val(data.description);

                            });

                        } else {

                            console.warn('No description found in response');

                            $('#item_description').val('');

                        }

                    },

                    error: function(xhr, status, error) {

                        console.error('AJAX error:', status, error);

                        alert('Error retrieving item description. Please try again.');

                    }

                });

            });



            $('#item_id').change(function() {

                var item_id = $(this).val();

                if (item_id) {

                    $.ajax({

                        url: '<?= base_url(); ?>admin/Ajax_controller/get_finish_good_item_description',

                        type: 'POST',

                        data: {

                            finish_good_item_id: item_id

                        },

                        success: function(response) {

                            if (response) {

                                var details = $.parseJSON(response);



                                $.each(details, function(i, data) {

                                    $('#item_desc').val(data.description);

                                });

                            } else {

                                console.warn('No description found in response');

                                $('#item_desc').val('');

                            }

                        },

                        error: function(xhr, status, error) {

                            console.error('AJAX error:', status, error);

                            alert('Error retrieving item description. Please try again.');

                        }

                    });

                } else {

                    $('#item_desc').val('');

                }

            });



            $('#item_id').change(function() {

                var item_id = $(this).val();

                var finish_good_item_id = $('#finish_good_item_id').val();

                if (item_id) {

                    $.ajax({

                        url: '<?= base_url(); ?>admin/Ajax_controller/check_unique_bom_item',

                        type: 'POST',

                        data: {

                            item_id: item_id,

                            finish_good_item_id: finish_good_item_id,

                        },

                        success: function(response) {

                            if (response == "1") {

                                $("#item_id_error").html("This Item No is  already exists!");

                                $("#submit").prop('disabled', true);

                            } else {

                                $("#item_id_error").html("");

                                $("#submit").prop('disabled', false);

                            }

                        },

                        error: function(xhr, status, error) {

                            console.error('AJAX error:', status, error);

                            alert('Error retrieving item description. Please try again.');

                        }

                    });

                } else {

                    $('#item_desc').val('');

                }

            });







        });

    </script>

    <script>

        $(document).ready(function() {

            $('#master').addClass('active');

        });

    </script>

    <script>

        // Tabulator setup

        var table = new Tabulator(".bom-table", {

            pagination: true,

            paginationSize: 10,

            selectable: true,

            layout: "fitColumns",



            ajaxURL: "<?= base_url() ?>admin/Ajax_controller/get_all_bom_list_ajax",

            ajaxConfig: "POST",

            ajaxContentType: "json",

            ajaxResponse: function(url, params, response) {

                console.log(response);

                return response.data;

            },



            columns: [{

                    title: "Sr.No",

                    formatter: "rownum",

                    hozAlign: "center",

                    headerSort: false,

                    width: 50

                },

                {

                    title: "Item FG ",

                    field: "finish_good_item_id",

                    hozAlign: "center",

                    width: 120,

                    headerFilter: "input",

                    headerHozAlign: "center",

                    headerFilterPlaceholder: "Search By FG Item"

                },

                {

                    title: "Item Description",

                    field: "fg_item_description",

                    hozAlign: "center",

                    width: 200,

                    headerFilter: "input",

                    headerHozAlign: "center",

                    headerFilterPlaceholder: "Search By FG Item Description"

                },

                {

                    title: "Item No",

                    field: "item_no_id",

                    hozAlign: "center",

                    width: 150,

                    headerFilter: "input",

                    headerHozAlign: "center",

                    headerFilterPlaceholder: "Search By FG Item Description"

                },

                {

                    title: "Item Description",

                    field: "item_desc_id",

                    hozAlign: "center",

                    width: 200,

                    headerFilter: "input",

                    headerHozAlign: "center",

                    headerFilterPlaceholder: "Search By FG Item Description"

                },

                {

                    title: "Item Level",

                    field: "item_level",

                    hozAlign: "center",

                    width: 150,

                    headerFilter: "input",

                    headerHozAlign: "center",

                    headerFilterPlaceholder: "Search By Item Level"

                },

                {

                    title: "Revision",

                    field: "revision",

                    hozAlign: "center",

                    width: 150,

                    headerFilter: "input",

                    headerHozAlign: "center",

                    headerFilterPlaceholder: "Search By Revision"

                },

                {

                    title: "Item Type",

                    field: "item_type_id",

                    hozAlign: "center",

                    width: 150,

                    headerFilter: "input",

                    headerHozAlign: "center",

                    headerFilterPlaceholder: "Search By Item Type"

                },

                {

                    title: "Status",

                    field: "item_status",

                    hozAlign: "center",

                    width: 150,

                    headerFilter: "input",

                    headerHozAlign: "center",

                    headerFilterPlaceholder: "Search By Status"

                },

                {

                    title: "UOM",

                    field: "uom_id",

                    hozAlign: "center",

                    width: 150,

                    headerFilter: "input",

                    headerHozAlign: "center",

                    headerFilterPlaceholder: "Search By UOM"

                },

                {

                    title: "Qty",

                    field: "qty",

                    hozAlign: "center",

                    width: 150,

                    headerFilter: "input",

                    headerHozAlign: "center",

                    headerFilterPlaceholder: "Search By Qty"

                },

                {

                    title: "Action",

                    field: "action",

                    hozAlign: "center",

                    width: 200,

                    formatter: function(cell, formatterParams, onRendered) {

                        const id = cell.getRow().getData().id;

                        return `

            <a class="btn btn-sm btn-outline-danger me-1"

                href="<?= base_url('delete/tbl_add_bom/') ?>${id}"

                onclick="return confirm('Are you sure you want to delete this?');">

                <i class="bi bi-trash"></i></a>



            <a class="btn btn-sm btn-outline-dark"

                href="<?= base_url('add-bom/') ?>${id}">

                <i class="bi bi-pencil"></i></a>

        `;

                    },

                    cellClick: function(e, cell) {

                        if (e.target.closest('.delete-row')) {

                            cell.getRow().delete();

                        }

                    }

                }



            ],

        });

    </script>

     <script>
    $(document).ready(function() {
        $('#bom-master .nav-link').addClass('nav_active');
        $('#bom-master .child_menu').addClass('show');
         $('#add-bom').addClass('active_cc');

    });
  
    </script>