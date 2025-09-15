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

                Supplier Management

            </h1>

        </div>

     -->






        <!-- tab content  -->

        <div class="tab-content " id="myTabContent">

            <div class="tab-pane fade show active fade-in " id="main-table" role="tabpanel">

                <?php if ($this->uri->segment(2) != '') { ?>

                <h6 class="table-title mb-3">Update Supplier</h2>

                    <?php } else { ?>

                    <h6 class="table-title mb-3">Add Supplier</h2>

                        <?php } ?>

                        <div class="form-data mb-4">

                            <form method="post" name="add_supplier" id="add_supplier" enctype="multipart/form-data">

                                <div class="row flex_wrap">

                                    <div class="form-group col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">

                                        <label>Supplier Name <b class="require">*</b></label>

                                        <input type="text" class="form-control" name="supplier_name" id="supplier_name"
                                            value="<?php if (!empty($single)) {

                                                        echo $single->supplier_name;

                                                    } ?>" placeholder="Enter Supplier Name">

                                        <input type="hidden" name="id" id="id" value="<?php if (!empty($single)) {

                                                                                            echo $single->id;

                                                                                        } ?>">

                                    </div>

                                    <div class="form-group col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">

                                        <label>Site <b class="require">*</b></label>

                                        <select class="form-control js-example-basic-single" name="site_id"
                                            id="site_id">

                                            <option value="">Select Site</option>

                                            <?php if (!empty($site)) {

                                                foreach ($site as $site_result) { ?>

                                            <option value="<?= $site_result->id ?>"
                                                <?php if (!empty($single) && $single->site_id == $site_result->id) { ?>selected="selected"
                                                <?php } ?>><?= $site_result->site_name ?> </option>

                                            <?php }

                                            } ?>



                                        </select>



                                    </div>

                                    <!-- Address Line 1 -->

                                    <div class="form-group col-xl-3">

                                        <label>Address Line 1</label>

                                        <input type="text" class="form-control" name="address_line1" id="address_line1"
                                            value="<?php if (!empty($single)) {

                                                        echo $single->address_line1;

                                                    } ?>" placeholder="Enter Address Line 1">

                                    </div>



                                    <!-- Address Line 2 -->

                                    <div class="form-group col-xl-3">

                                        <label>Address Line 2</label>

                                        <input type="text" class="form-control" name="address_line2" id="address_line2"
                                            value="<?php if (!empty($single)) {

                                                        echo $single->address_line2;

                                                    } ?>" placeholder="Enter Address Line 2">

                                    </div>



                                    <!-- Address Line 3 -->

                                    <div class="form-group col-xl-3">

                                        <label>Address Line 3</label>

                                        <input type="text" class="form-control" name="address_line3" id="address_line3"
                                            value="<?php if (!empty($single)) {

                                                        echo $single->address_line3;

                                                    } ?>" placeholder="Enter Address Line 3">

                                    </div>





                                    <!-- Country -->

                                    <div class="form-group col-xl-3">

                                        <label>Country</label>

                                        <select class="multisteps-form__input form-control js-example-basic-single"
                                            id="country_id" name="country_id">

                                            <option value="">Select Country</option>

                                            <?php if (!empty($countries)) {

                                                foreach ($countries as $country_result) { ?>

                                            <option value="<?= $country_result->id ?>"
                                                <?php if (!empty($single) && $single->country_id == $country_result->id) { ?>selected="selected"
                                                <?php } ?>><?= $country_result->name ?> </option>

                                            <?php }

                                            } ?>

                                        </select>

                                    </div>

                                    <?php

                                    $states = !empty($single) ? $this->Admin_model->get_states($single->country_id) : [];

                                    ?>

                                    <!-- State -->

                                    <div class="form-group col-xl-3">

                                        <label>State</label>

                                        <select class="multisteps-form__input form-control js-example-basic-single"
                                            id="state_id" name="state_id">

                                            <option value="">Select State</option>

                                            <?php if (!empty($states)) {

                                                foreach ($states as $state_result) { ?>

                                            <option value="<?= $state_result->id ?>"
                                                <?php if (!empty($single) && $single->state_id == $state_result->id) { ?>selected="selected"
                                                <?php } ?>><?= $state_result->name ?> </option>

                                            <?php }

                                            } ?>

                                        </select>

                                    </div>

                                    <?php

                                    $cities = !empty($single) ? $this->Admin_model->get_city($single->state_id) : [];

                                    ?>

                                    <!-- City -->

                                    <div class="form-group col-xl-3">

                                        <label>City</label>

                                        <select class="multisteps-form__input form-control js-example-basic-single"
                                            id="city_id" name="city_id">

                                            <option value="">Select City</option>

                                            <?php if (!empty($cities)) {

                                                foreach ($cities as $city_result) { ?>

                                            <option value="<?= $city_result->id ?>"
                                                <?php if (!empty($single) && $single->city_id == $city_result->id) { ?>selected="selected"
                                                <?php } ?>><?= $city_result->name ?> </option>

                                            <?php }

                                            } ?>



                                        </select>

                                    </div>



                                    <!-- Pin Code -->

                                    <div class="form-group col-xl-3">

                                        <label>Pin Code</label>

                                        <input type="text" class="form-control" name="pin_code" id="pin_code" value="<?php if (!empty($single)) {

                                                        echo $single->pin_code;

                                                    } ?>" placeholder="Enter Pin Code">

                                    </div>



                                    <!-- Type of Good (Dropdown) -->

                                    <div class="form-group col-xl-3">

                                        <label>Type of Good</label>

                                        <select class="form-control" name="type_of_good_id" id="type_of_good_id">

                                            <option value="">Select Type</option>

                                            <?php if (!empty($type_of_goods)) {

                                                foreach ($type_of_goods as $type_of_goods_result) { ?>

                                            <option value="<?= $type_of_goods_result->id ?>"
                                                <?php if (!empty($single) && $single->type_of_good_id == $type_of_goods_result->id) { ?>selected="selected"
                                                <?php } ?>><?= $type_of_goods_result->good_type_name ?> </option>

                                            <?php }

                                            } ?>

                                        </select>

                                    </div>



                                    <!-- Last Name -->

                                    <div class="form-group col-xl-3">

                                        <label>Last Name</label>

                                        <input type="text" class="form-control" name="last_name" id="last_name" value="<?php if (!empty($single)) {

                                                        echo $single->last_name;

                                                    } ?>" placeholder="Enter Last Name">

                                    </div>



                                    <!-- First Name -->

                                    <div class="form-group col-xl-3">

                                        <label>First Name</label>

                                        <input type="text" class="form-control" name="first_name" id="first_name" value="<?php if (!empty($single)) {

                                                        echo $single->first_name;

                                                    } ?>" placeholder="Enter First Name">

                                    </div>



                                    <!-- Contact No 1 -->

                                    <div class="form-group col-xl-3">

                                        <label>Contact No 1</label>

                                        <input type="text" class="form-control" name="contact_no_1" id="contact_no_1"
                                            value="<?php if (!empty($single)) {

                                                        echo $single->contact_no_1;

                                                    } ?>" placeholder="Enter Contact No 1">

                                    </div>



                                    <!-- Contact No 2 -->

                                    <div class="form-group col-xl-3">

                                        <label>Contact No 2</label>

                                        <input type="text" class="form-control" name="contact_no_2" id="contact_no_2"
                                            value="<?php if (!empty($single)) {

                                                        echo $single->contact_no_2;

                                                    } ?>" placeholder="Enter Contact No 2">

                                    </div>



                                    <!-- E-mail ID -->

                                    <div class="form-group col-xl-3">

                                        <label>Email ID</label>

                                        <input type="email" class="form-control" name="email" id="email" value="<?php if (!empty($single)) {

                                                        echo $single->email;

                                                    } ?>" placeholder="Enter Email ID">

                                    </div>



                                    <!-- E-mail ID 1 -->

                                    <div class="form-group col-xl-3">

                                        <label>Email ID 1</label>

                                        <input type="text" class="form-control" name="email_1" id="email_1" value="<?php if (!empty($single)) {

                                                        echo $single->email_1;

                                                    } ?>" placeholder="Enter Email ID 1">

                                    </div>



                                    <!-- E-mail ID 2 -->

                                    <div class="form-group col-xl-3">

                                        <label>Email ID 2</label>

                                        <input type="text" class="form-control" name="email_2" id="email_2" value="<?php if (!empty($single)) {

                                                        echo $single->email_2;

                                                    } ?>" placeholder="Enter Email ID 2">

                                    </div>

                                    <!-- E-mail ID 3 -->

                                    <div class="form-group col-xl-3">

                                        <label>Email ID 3</label>

                                        <input type="text" class="form-control" name="email_3" id="email_3" value="<?php if (!empty($single)) {

                                                        echo $single->email_3;

                                                    } ?>" placeholder="Enter Email ID 3">

                                    </div>

                                    <!-- Submit Button -->

                                    <div class="form-group col-xl-3">

                                        <button type="submit" class="btn btn-dark" style="margin-top:30px">Submit</button>

                                    </div>

                                </div>

                            </form>

                        </div>

                        <h6 class="mb-3">Supplier List</h6>

                        <div class="list-data">

                            <div class="">

                                <div class="Supplier-list  mt-1 p-2"></div>



                            </div>

                        </div>

            </div>

        </div>

    </div>

    <?php include('footer.php'); ?>





    <script>
    var table = new Tabulator(".Supplier-list", {

        pagination: true,

        paginationSize: 10,

        selectable: true,

        layout: "fitColumns",

        ajaxURL: "<?= base_url() ?>admin/Ajax_controller/get_all_supplier_list_ajax",

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

                headerSort: false,

                width: 50

            },

            {

                title: "Supplier Name",

                field: "supplier_name",

                hozAlign: "center",

                headerFilter: "input",

                headerFilterPlaceholder: "Search by Supplier Name",

                width: 150

            },

            {

                title: "Site",

                field: "site_id",

                hozAlign: "center",

                headerFilter: "input",

                headerFilterPlaceholder: "Search by Site",

                width: 150

            },

            {

                title: "Address Line 1",

                field: "address_line1",

                hozAlign: "center",

                headerFilter: "input",

                headerFilterPlaceholder: "Search by Address 1",

                width: 150

            },

            {

                title: "Address Line 2",

                field: "address_line2",

                hozAlign: "center",

                headerFilter: "input",

                headerFilterPlaceholder: "Search by Address 2",

                width: 150

            },

            {

                title: "Address Line 3",

                field: "address_line3",

                hozAlign: "center",

                headerFilter: "input",

                headerFilterPlaceholder: "Search by Address 3",

                width: 150

            },

            {

                title: "City",

                field: "city_id",

                hozAlign: "center",

                headerFilter: "input",

                headerFilterPlaceholder: "Search by City",

                width: 150

            },

            {

                title: "State",

                field: "state_id",

                hozAlign: "center",

                headerFilter: "input",

                headerFilterPlaceholder: "Search by State",

                width: 150

            },

            {

                title: "Country",

                field: "country_id",

                hozAlign: "center",

                headerFilter: "input",

                headerFilterPlaceholder: "Search by Country",

                width: 150

            },

            {

                title: "Pin Code",

                field: "pin_code",

                hozAlign: "center",

                headerFilter: "input",

                headerFilterPlaceholder: "Search by Pin Code",

                width: 150

            },

            {

                title: "Type of Good",

                field: "type_of_good_id",

                hozAlign: "center",

                headerFilter: "input",

                headerFilterPlaceholder: "Search by Type",

                width: 150

            },

            {

                title: "Last Name",

                field: "last_name",

                hozAlign: "center",

                headerFilter: "input",

                headerFilterPlaceholder: "Search by Last Name",

                width: 150

            },

            {

                title: "First Name",

                field: "first_name",

                hozAlign: "center",

                headerFilter: "input",

                headerFilterPlaceholder: "Search by First Name",

                width: 150

            },

            {

                title: "Contact No 1",

                field: "contact_no_1",

                hozAlign: "center",

                headerFilter: "input",

                headerFilterPlaceholder: "Search by Contact 1",

                width: 150

            },

            {

                title: "Contact No 2",

                field: "contact_no_2",

                hozAlign: "center",

                headerFilter: "input",

                headerFilterPlaceholder: "Search by Contact 2",

                width: 150

            },

            {

                title: "Email",

                field: "email",

                hozAlign: "center",

                headerFilter: "input",

                headerFilterPlaceholder: "Search by Email",

                width: 150

            },

            {

                title: "Email 1",

                field: "email_1",

                hozAlign: "center",

                headerFilter: "input",

                headerFilterPlaceholder: "Search by Email 1",

                width: 150

            },

            {

                title: "Email 2",

                field: "email_2",

                hozAlign: "center",

                headerFilter: "input",

                headerFilterPlaceholder: "Search by Email 2",

                width: 150

            },

            {

                title: "Email 3",

                field: "email_3",

                hozAlign: "center",

                headerFilter: "input",

                headerFilterPlaceholder: "Search by Email 3",

                width: 150

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

                        href="<?= base_url('delete/tbl_supplier_management/') ?>${id}"

                        onclick="return confirm('Are you sure you want to delete this?');">

                        <i class="bi bi-trash"></i></a>

                        <a class="btn btn-sm btn-outline-dark"

                        href="<?= base_url('supplier/') ?>${id}">

                        <i class="bi bi-pencil"></i></a>`;

                    return action;

                }

            }

        ],



    });

    $(document).ready(function() {

        $('#master').addClass('active');

    });
    </script>

    <script>
    $(document).ready(function() {

        $('#country_id').change(function() {

            var country_id = $(this).val();

            if (country_id) {

                $.ajax({

                    url: '<?= base_url() ?>admin/Ajax_controller/get_all_state',

                    type: 'POST',

                    data: {

                        country_id: country_id

                    },

                    dataType: 'json',

                    success: function(data) {

                        $('#state_id').empty();

                        $('#state_id').append(
                            '<option value="">Please Select State</option>');

                        $.each(data, function(index, state) {

                            $('#state_id').append('<option value="' + state.id +
                                '">' +

                                state.name + '</option>');

                        });

                    },

                    error: function() {

                        alert('Error retrieving states. Please try again.');

                    }

                });

            } else {

                $('#state_id').empty();

                $('#state_id').append('<option value="">Please Select State</option>');

            }

        });

    });
    </script>

    <script>
    $(document).ready(function() {

        $('#state_id').change(function() {

            var state_id = $(this).val();

            if (state_id) {

                $.ajax({

                    url: '<?= base_url() ?>admin/Ajax_controller/get_all_cities',

                    type: 'POST',

                    data: {

                        state_id: state_id

                    },

                    dataType: 'json',

                    success: function(data) {

                        $('#city_id').empty();

                        $('#city_id').append(
                        '<option value="">Please Select City</option>');

                        $.each(data, function(index, city) {

                            $('#city_id').append('<option value="' + city.id +
                                '">' +

                                city.name + '</option>');

                        });

                    },

                    error: function() {

                        alert('Error retrieving cities. Please try again.');

                    }

                });

            } else {

                $('#city_id').empty();

                $('#city_id').append('<option value="">Please Select City</option>');

            }

        });

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



        $.validator.addMethod("customEmail", function(value, element) {

            return this.optional(element) || /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/.test(
                value);

        }, "Please enter a valid email address");

        $.validator.addMethod("noSpaceStart", function(value, element) {

            return this.optional(element) || /^[^\s]/.test(value);

        }, "No space allowed at the beginning.");

        $.validator.addMethod("customPassword", function(value, element) {

                return this.optional(element) ||
                    /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/.test(value);

            },
            "Password must be at least 8 characters long and include uppercase, lowercase, a number, and a special character !"
            );

        $.validator.addMethod("lettersOnly", function(value, element) {

            return this.optional(element) || /^[a-zA-Z\s]+$/.test(value);

        }, "Only letters are allowed, no numbers or special characters.");

        $("#add_supplier").validate({

            ignore: ":hidden:not(select)",

            rules: {

                supplier_name: {

                    noSpaceStart: true,

                    required: true,

                    lettersOnly: true

                },

                first_name: {

                    noSpaceStart: true,

                },

                last_name: {

                    noSpaceStart: true,

                },

                contact_no_1: {

                    noSpaceStart: true,

                    digits: true,

                    validMobile: true,

                    minlength: 10

                },

                pin_code: {

                    minlength: 6,

                    maxlength: 10,

                    number: true,

                    noSpaceStart: true

                },

                address_line1: {

                    noSpaceStart: true

                },

                address_line2: {

                    noSpaceStart: true

                },

                address_line3: {

                    noSpaceStart: true

                },

                email_1: {

                    noSpaceStart: true,

                    customEmail: true

                },

                email_2: {

                    noSpaceStart: true,

                    customEmail: true

                },

                email_3: {

                    noSpaceStart: true,

                    customEmail: true

                },

                contact_no_2: {

                    noSpaceStart: true,

                    digits: true,

                    validMobile: true,

                    minlength: 10,

                },

                email: {

                    noSpaceStart: true,

                    customEmail: true

                },

                site_id: {

                    required: true

                },

                password: {

                    noSpaceStart: true,

                    required: true,

                    customPassword: true,

                },

                profile_image: {

                    required: function(element) {

                        return $("#old_profile_image").val() === "";

                    },

                    extension: "jpg|jpeg|png"

                }

            },

            messages: {

                supplier_name: {

                    required: "Please enter supplier name !",

                    noSpaceStart: "Please enter valid supplier name !",

                    lettersOnly: "Please enter valid supplier name !"

                },

                first_name: {

                    required: "Please enter first name !",

                    noSpaceStart: "Please enter valid first name !"

                },

                last_name: {

                    required: "Please enter last name !",

                    noSpaceStart: "Please enter valid last name !"

                },

                contact_no_1: {

                    noSpaceStart: "Please enter contact number !",

                    digits: "Please enter valid contact number !",

                    validMobile: "Please enter valid contact number !",

                    minlength: "Please enter valid contact number !",

                    required: "Please enter valid contact number !",

                },

                email: {

                    noSpaceStart: "Please enter email !",

                    required: "Please enter valid email !",

                    customEmail: "Please enter valid email !"

                },

                site_id: {

                    required: "Please select a site !"

                },

                type_of_good_id: {

                    required: "Please select a type of good !"

                },

                password: {

                    noSpaceStart: "Please enter valid password !",

                    required: "Please enter password !",

                    customPassword: "Please enter valid password !"

                },

                pin_code: {

                    minlength: "Please enter valid pincode !",

                    maxlength: "Please enter valid pincode !",

                    number: "Please enter valid pincode !",

                    noSpaceStart: "Please enter valid pincode !"

                },

                email_1: {

                    noSpaceStart: "Please enter email !",

                    customEmail: "Please enter valid email !"

                },

                email_2: {

                    noSpaceStart: "Please enter email !",

                    customEmail: "Please enter valid email !"

                },

                email_3: {

                    noSpaceStart: "Please enter email !",

                    customEmail: "Please enter valid email !"

                },

                contact_no_2: {

                    noSpaceStart: "Please enter contact number !",

                    digits: "Please enter valid contact number !",

                    validMobile: "Please enter valid contact number !",

                    minlength: "Please enter valid contact number !",

                },

                address_line1: {

                    noSpaceStart: "Please enter valid address !"

                },

                address_line2: {

                    noSpaceStart: "Please enter valid address !"

                },

                address_line3: {

                    noSpaceStart: "Please enter valid address !"

                },

                profile_image: {

                    required: "Please select profile image !",

                    extension: "Please select valid profile image !"

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

            },

            submitHandler: function(form) {

                form.submit();

            }

        });



        $('#site_id, #type_of_good_id').change(function() {

            $(this).valid();

        });



    });
    </script>

    <script>
    $(document).ready(function() {
        $('#master .nav-link').addClass('nav_active');
        $('#master .child_menu').addClass('show');
        $('#supplier').addClass('active_cc');

    });
    </script>