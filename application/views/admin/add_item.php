<?php include('header.php'); ?>

<style>

    .error {

        color: red;

    }

</style>

<div class="main-content">

    <div class="sub-content">

        <!-- <div class="page-header">

            <h1 class="page-title">

                Item Management

            </h1>

        </div> -->

       

        <div class="tab-content" id="myTabContent">

            <div class="tab-pane fade show active fade-in" id="main-table" role="tabpanel">

                <?php if ($this->uri->segment(2) != '') { ?>

                    <h6 class="table-title mb-3">Update Item</h2>

                    <?php } else { ?>

                        <h6 class="table-title mb-3">Add Item</h2>

                        <?php } ?>

                        <div class="form-data mb-4">

                            <form method="post" name="add_item" id="add_item" enctype="multipart/form-data">

                                <div class="row flex_wrap">

                                    <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">

                                        <label>Item No <b class="require">*</b></label>

                                        <input autocomplete="off" type="text" class="form-control" name="item_noo" id="item_no"

                                            value="<?php if (!empty($single)) {

                                                        echo $single->item_no;

                                                    } ?>" placeholder="Enter Item No">

                                        <input type="hidden" name="id" id="id" value="<?php if (!empty($single)) {

                                                                                            echo $single->id;

                                                                                        } ?>">

                                        <span class="error" id="item_no_error"></span>

                                    </div>

                                    <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">

                                        <label>Description <b class="require">*</b></label>

                                        <input autocomplete="off" type="text" class="form-control" name="description"

                                            value="<?php if (!empty($single)) {

                                                        echo $single->description;

                                                    } ?>" id="description" placeholder="Enter Description">

                                    </div>

                                    <div class="form-group col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">

                                        <label>Supplier Name 1 </label>

                                        <select class="form-control js-example-basic-single" name="supplier_1" id="supplier_1">

                                            <option value="">Please Select</option>

                                            <?php if (!empty($supplier)) {

                                                foreach ($supplier as $supplier_result) { ?>

                                                    <option value="<?= $supplier_result->id ?>" <?php if (!empty($single) && $single->supplier_1 == $supplier_result->id) { ?>selected="selected" <?php } ?>><?= $supplier_result->supplier_name ?> </option>

                                            <?php }

                                            } ?>

                                        </select>

                                    </div>

                                    <div class="form-group col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">

                                        <label>Supplier-1 SOB </label>

                                        <input autocomplete="off" type="number" class="form-control" name="supplier_1_sob"

                                            id="supplier_1_sob"

                                            value="<?php if (!empty($single)) {

                                                        echo $single->supplier_1_sob;

                                                    } ?>"

                                            placeholder="Enter supplier-1 SOB number" min="0">

                                    </div>

                                    <div class="form-group col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">

                                        <label>Supplier Name 2 </label>

                                        <select class="form-control js-example-basic-single" name="supplier_2" id="supplier_2">

                                            <option value="">Please Select</option>

                                            <?php if (!empty($supplier)) {

                                                foreach ($supplier as $supplier_result) { ?>

                                                    <option value="<?= $supplier_result->id ?>" <?php if (!empty($single) && $single->supplier_2 == $supplier_result->id) { ?>selected="selected" <?php } ?>><?= $supplier_result->supplier_name ?> </option>

                                            <?php }

                                            } ?>

                                        </select>

                                    </div>

                                    <div class="form-group col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">

                                        <label>Supplier-2 SOB </label>

                                        <input autocomplete="off" type="number" class="form-control" name="supplier_2_sob"

                                            id="supplier_2_sob"

                                            value="<?php if (!empty($single)) {

                                                        echo $single->supplier_2_sob;

                                                    } ?>"

                                            placeholder="Enter supplier-2 SOB Number" min="0">

                                    </div>

                                    <div class="form-group col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">

                                        <label>Supplier Name 3 </label>

                                        <select class="form-control js-example-basic-single" name="supplier_3" id="supplier_3">

                                            <option value="">Please Select</option>

                                            <?php if (!empty($supplier)) {

                                                foreach ($supplier as $supplier_result) { ?>

                                                    <option value="<?= $supplier_result->id ?>" <?php if (!empty($single) && $single->supplier_3 == $supplier_result->id) { ?>selected="selected" <?php } ?>><?= $supplier_result->supplier_name ?> </option>

                                            <?php }

                                            } ?>

                                        </select>

                                    </div>

                                    <div class="form-group col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">

                                        <label>Supplier-3 SOB </label>

                                        <input autocomplete="off" type="number" class="form-control" name="supplier_3_sob"

                                            id="supplier_3_sob"

                                            value="<?php if (!empty($single)) {

                                                        echo $single->supplier_3_sob;

                                                    } ?>"

                                            placeholder="Enter supplier-3 SOB number" min="0">

                                    </div>

                                    <div class="form-group col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">

                                        <label>Supplier Name 4 </label>

                                        <select class="form-control js-example-basic-single" name="supplier_4" id="supplier_4">

                                            <option value="">Please Select</option>

                                            <?php if (!empty($supplier)) {

                                                foreach ($supplier as $supplier_result) { ?>

                                                    <option value="<?= $supplier_result->id ?>" <?php if (!empty($single) && $single->supplier_4 == $supplier_result->id) { ?>selected="selected" <?php } ?>><?= $supplier_result->supplier_name ?> </option>

                                            <?php }

                                            } ?>

                                        </select>

                                    </div>



                                    <div class="form-group col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">

                                        <label>Supplier-4 SOB </label>

                                        <input autocomplete="off" type="number" class="form-control" name="supplier_4_sob"

                                            id="supplier_4_sob"

                                            value="<?php if (!empty($single)) {

                                                        echo $single->supplier_4_sob;

                                                    } ?>"

                                            placeholder="Enter supplier-4 SOB number" min="0">

                                    </div>

                                    <div class="form-group col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">

                                        <label>Supplier Name 5 </label>

                                        <select class="form-control js-example-basic-single" name="supplier_5" id="supplier_5">

                                            <option value="">Please Select</option>

                                            <?php if (!empty($supplier)) {

                                                foreach ($supplier as $supplier_result) { ?>

                                                    <option value="<?= $supplier_result->id ?>" <?php if (!empty($single) && $single->supplier_5 == $supplier_result->id) { ?>selected="selected" <?php } ?>><?= $supplier_result->supplier_name ?> </option>

                                            <?php }

                                            } ?>

                                        </select>

                                    </div>

                                    <div class="form-group col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">

                                        <label>Supplier-5 SOB </label>

                                        <input autocomplete="off" type="number" class="form-control" name="supplier_5_sob"

                                            id="supplier_5_sob"

                                            value="<?php if (!empty($single)) {

                                                        echo $single->supplier_5_sob;

                                                    } ?>"

                                            placeholder="Enter supplier-5 SOB number" min="0">

                                    </div>

                                <div class="form-group col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">

                                        <button id="submit" type="submit" class="btn btn-dark " style="margin-top:30px">Submit</button>

                                    </div>

                                </div>

                            </form>

                        </div>



                        <h6 class="mb-3">Item List</h6>

                        <div class="list-data">

                            <div class="item-list mt-1 p-2"></div>

                        </div>

            </div>

        </div>

    </div>



    <?php include('footer.php'); ?>



    <script>

        $("#item_no").on('keyup change', function() {

            var item_no = $(this).val();

            var id = $("#id").val();



            $.ajax({

                url: '<?= base_url() ?>admin/Ajax_controller/check_unique_item_no',

                method: 'POST',

                data: {

                    item_no: item_no,

                    id: id

                },

                success: function(response) {

                    if (response === "exists") {

                        $("#item_no_error").html("This Item No is  already exists!");

                        $("#submit").prop('disabled', true);

                    } else {

                        $("#item_no_error").html("");

                        $("#submit").prop('disabled', false);

                    }

                }

            });

        });

    </script>





    <script>

        var table = new Tabulator(".item-list", {

            pagination: true,

            paginationSize: 10,

            selectable: true,

            layout: "fitColumns",



            ajaxURL: "<?= base_url() ?>admin/Ajax_controller/get_all_item_management_list_ajax",

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

                    title: "Item No",

                    field: "item_no",

                    hozAlign: "center",

                    headerFilter: "input",

                    headerHozAlign: "center",

                    headerFilterPlaceholder: "Search By Item Number",

                    width: 150



                },

                {

                    title: "Description",

                    field: "description",

                    width: 150,

                    hozAlign: "center",

                    headerFilter: "input",

                    headerHozAlign: "center",

                    headerFilterPlaceholder: "Search By Description"

                },

                {

                    title: "Supplier 1",

                    field: "supplier_1",

                    width: 150,

                    hozAlign: "center",

                    headerFilter: "input",

                    headerHozAlign: "center",

                    headerFilterPlaceholder: "Search By Supplier"

                },

                {

                    title: "SOB 1",

                    field: "supplier_1_sob",

                    width: 150,

                    hozAlign: "center",

                    headerFilter: "input",

                    headerHozAlign: "center",

                    headerFilterPlaceholder: "Search By SOB"

                },

                {

                    title: "Supplier 2",

                    field: "supplier_2",

                    width: 150,

                    hozAlign: "center",

                    headerFilter: "input",

                    headerHozAlign: "center",

                    headerFilterPlaceholder: "Search By Supplier",

                },

                {

                    title: "SOB 2",

                    field: "supplier_2_sob",

                    width: 150,

                    hozAlign: "center",

                    headerFilter: "input",

                    headerHozAlign: "center",

                    headerFilterPlaceholder: "Search By SOB"

                },

                {

                    title: "Supplier 3",

                    field: "supplier_3",

                    width: 150,

                    hozAlign: "center",

                    headerFilter: "input",

                    headerHozAlign: "center",

                    headerFilterPlaceholder: "Search By Supplier"

                },

                {

                    title: "SOB 3",

                    field: "supplier_3_sob",

                    width: 150,

                    hozAlign: "center",

                    headerFilter: "input",

                    headerHozAlign: "center",

                    headerFilterPlaceholder: "Search By SOB"

                },

                {

                    title: "Supplier 4",

                    field: "supplier_4",

                    width: 150,

                    hozAlign: "center",

                    headerFilter: "input",

                    headerHozAlign: "center",

                    headerFilterPlaceholder: "Search By Supplier"

                },

                {

                    title: "SOB 4",

                    field: "supplier_4_sob",

                    width: 150,

                    hozAlign: "center",

                    headerFilter: "input",

                    headerHozAlign: "center",

                    headerFilterPlaceholder: "Search By SOB"

                },

                {

                    title: "Supplier 5",

                    field: "supplier_5",

                    width: 150,

                    hozAlign: "center",

                    headerFilter: "input",

                    headerHozAlign: "center",

                    headerFilterPlaceholder: "Search By Supplier"

                },

                {

                    title: "SOB 5",

                    field: "supplier_5_sob",

                    width: 150,

                    hozAlign: "center",

                    headerFilter: "input",

                    headerHozAlign: "center",

                    headerFilterPlaceholder: "Search By SOB"

                },

                {

                    title: "Action",

                    field: "id",

                    width: 150,

                    hozAlign: "center",

                    headerHozAlign: "center",

                    formatter: function(cell) {

                        var rowData = cell.getRow().getData();

                        var id = rowData.id;

                        var status = rowData.status;

                        var action = '';

                        action += `

                        <a class="btn btn-sm btn-outline-danger me-1"

                        href="<?= base_url('delete/tbl_item_management/') ?>${id}"

                        onclick="return confirm('Are you sure you want to delete this?');">

                        <i class="bi bi-trash"></i></a>



                        <a class="btn btn-sm btn-outline-dark"

                        href="<?= base_url('add-item/') ?>${id}">

                        <i class="bi bi-pencil"></i></a>`;



                        return action;

                    }

                }

            ],



        });




    </script>





    <script>

        $(document).ready(function() {





            $.validator.addMethod("validMobile", function(value, element) {

                return !/^(0{10,12})$/.test(value);

                s

            }, "Enter a valid mobile number.");



            $("#contact_no_1").on("keyup blur", function() {

                if (/^(0{10,12})$/.test($(this).val())) {

                    $("#submit").hide();

                } else {

                    $("#submit").show();

                }

            });

            $.validator.addMethod("validate_email", function(value, element) {

                return this.optional(element) || (/^[a-z0-9._%+-]+@gmail\.com$/).test(value);

            }, "Please enter a valid Gmail address (lowercase only).");



            $.validator.addMethod("noSpaceStart", function(value, element) {

                return this.optional(element) || /^[^\s]/.test(value);

            }, "No space allowed at the beginning.");



            $("#add_item").validate({

                ignore: ":hidden:not(select)",

                rules: {

                    item_no: {

                        noSpaceStart: true,

                        required: true

                    },

                    description: {

                        noSpaceStart: true,

                        required: true

                    },

                    supplier_1: {

                        required: true,

                    },

                    site_id: {

                        required: true

                    },

                    supplier_1_sob: {

                        noSpaceStart: true,

                        required: true

                    }



                },

                messages: {

                    item_no: {

                        required: "Please enter item number !",

                        noSpaceStart: "Please enter valid item number !"

                    },

                    description: {

                        required: "Please enter description !",

                        noSpaceStart: "Please enter valid description !"

                    },

                    supplier_1: {

                        required: "Please select supplier !"

                    },

                    site_id: {

                        required: "Please select site !"

                    },

                    supplier_1_sob: {

                        required: "Please enter supplier sob !",

                        noSpaceStart: "Please enter valid supplier sob !"

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

                },

            });



            $('#supplier_1, #site_id').change(function() {

                $(this).valid();

            });



        });

    </script>

        <script>
    $(document).ready(function() {
        $('#bom-master .nav-link').addClass('nav_active');
        $('#bom-master .child_menu').addClass('show');
        $('#add_items').addClass('active_cc');

    });
    </script>




</div>