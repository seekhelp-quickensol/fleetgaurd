<?php include('header.php'); ?>

<style>
    .error {

        color: red;

    }



    #employee_id {

        text-transform: uppercase;



    }



    ::-webkit-input-placeholder {

        text-transform: initial;

    }



    #email {

        text-transform: lowercase;

    }
</style>

<div class="main-content">

    <div class="sub-content">




        <!-- tab content  -->

        <div class="tab-content " id="myTabContent">

            <div class="tab-pane fade show active fade-in " id="main-table" role="tabpanel">

                <h6 class="mb-3">Add User</h6>

                <div class="form-data mb-4">

                    <form method="post" name="add_user" id="add_user" enctype="multipart/form-data" action="">

                        <div class="row flex_wrap">

                            <div class="form-group col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">

                                <label>First Name <b class="require">*</b></label>

                                <input autocomplete="off" type="text" class="form-control" name="first_name" id="first_name"

                                    value="<?php if (!empty($single)) {

                                                echo $single->first_name;
                                            } ?>" placeholder="Enter first name">

                                <input type="hidden" name="id" id="id" value="<?php if (!empty($single)) {

                                                                                    echo $single->id;
                                                                                } ?>">



                            </div>

                            <div class="form-group col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">

                                <label>Middle Name <b class="require">*</b></label>

                                <input autocomplete="off" type="text" class="form-control" name="middle_name" id="middle_name"

                                    value="<?php if (!empty($single)) {

                                                echo $single->middle_name;
                                            } ?>" placeholder="Enter middle name">

                            </div>

                            <div class="form-group col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">

                                <label>Last Name <b class="require">*</b></label>

                                <input autocomplete="off" type="text" class="form-control" name="last_name" id="last_name"

                                    value="<?php if (!empty($single)) {

                                                echo $single->last_name;
                                            } ?>" placeholder="Enter last name">

                            </div>

                            <div class="form-group col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">

                                <label>Employee ID <b class="require">*</b></label>

                                <input autocomplete="off" type="text" class="form-control" name="employee_id"

                                    id="employee_id" value="<?php if (!empty($single)) {

                                                                echo $single->employee_id;
                                                            } ?>" placeholder="Enter employee ID">

                                <span class="error" id="employee_id_error"></span>

                            </div>

                            <div class="form-group col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">

                                <label>Email <b class="require">*</b></label>

                                <input autocomplete="off" type="text" class="form-control" name="email" id="email" value="<?php if (!empty($single)) {

                                                                                                                                echo $single->email;
                                                                                                                            } ?>"

                                    placeholder="Enter email">

                                <span class="error" id="email_error"></span>



                            </div>

                            <div class="form-group col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">

                                <label>Department <b class="require">*</b></label>

                                <select class="form-control js-example-basic-single" name="department_id"

                                    id="department_id" style="width:100%">

                                    <option value="">Select Department</option>

                                    <?php if (!empty($department)) {

                                        foreach ($department as $department_result) { ?>

                                            <option value="<?= $department_result->id ?>" <?php if (!empty($single) && $single->department_id == $department_result->id) { ?>selected="selected" <?php } ?>><?= $department_result->department_name ?> </option>

                                    <?php }
                                    } ?>

                                </select>

                            </div>

                            <div class="form-group col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">

                                <label>Designation <b class="require">*</b></label>

                                <select class="form-control js-example-basic-single" name="designation_id" style="width:100%"

                                    id="designation_id">

                                    <option value="">Please Select</option>

                                    <?php if (!empty($designation)) {

                                        foreach ($designation as $designation_result) { ?>

                                            <option value="<?= $designation_result->id ?>" <?php if (!empty($single) && $single->designation_id == $designation_result->id) { ?>selected="selected" <?php } ?>><?= $designation_result->designation_name ?> </option>

                                    <?php }
                                    } ?>

                                </select>

                            </div>

                            <div class="form-group col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">

                                <label>Username <b class="require">*</b></label>

                                <input autocomplete="off" type="text" class="form-control" name="username" id="username" value="<?php if (!empty($single)) {

                                                                                                                                    echo $single->username;
                                                                                                                                } ?>"

                                    placeholder="Enter username">

                                <span class="error" id="username_error"></span>



                            </div>
                            <div class="form-group col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">

                                <label>Password <b class="require">*</b></label>

                                <input autocomplete="off" type="password" class="form-control" name="password" id="password"

                                    value="<?php if (!empty($single)) {

                                                echo $single->password;
                                            } ?>">

                                <span class="toggle_password"><i class="fa fa-eye-slash"></i></span>

                            </div>

                            <div class="form-group col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">

                                <label>Photo</label>

                                <?php if (!empty($single) && $single->profile_image != ""): ?>

                                    <a target="_blank" href="<?= base_url(); ?>admin_assets/images/profile_image/<?= $single->profile_image; ?>"><i class="fa fa-eye"></i></a>

                                <?php endif; ?>

                                </label>

                                <input type="file" class="form-control" name="profile_image" id="profile_image" accept=".png,.jpg,.jpeg,.pdf">

                                <input type="hidden" name="existing_profile_image" value="<?= !empty($single) ? $single->profile_image : ''; ?>">

                            </div>



                            <div class="form-group col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">

                                <button id="submit" type="submit" name="submit" class="btn btn-dark " style="margin-top:30px">Submit</button>

                            </div>

                        </div>

                    </form>

                </div>

                <h6 class="mb-3">User List</h6>

                <div class="list-data">

                    <div class="">

                        <div class="user-list mt-1 p-2"></div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <?php include('footer.php'); ?>

    <script>
        const BASE_URL = "<?= base_url() ?>";



        var table = new Tabulator(".user-list", {

            pagination: true,

            paginationSize: 10,

            selectable: true,

            layout: "fitColumns",

            responsiveLayout: "collapse",

            ajaxURL: `${BASE_URL}admin/Ajax_controller/get_all_user_list_ajax`,

            ajaxConfig: "POST",

            ajaxContentType: "json",

            ajaxResponse: function(url, params, response) {

                console.log(response);

                return response && response.data ? response.data : [];

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

                    title: "First Name",

                    field: "first_name",

                    hozAlign: "center",

                    headerFilter: "input",

                    headerHozAlign: "center",

                    headerFilterPlaceholder: "Search By First Name"

                },

                {

                    title: "Last Name",

                    field: "last_name",

                    hozAlign: "center",

                    headerFilter: "input",

                    headerHozAlign: "center",

                    headerFilterPlaceholder: "Search By Last Name"

                },

                {

                    title: "Employee Id",

                    field: "employee_id",

                    hozAlign: "center",

                    headerFilter: "input",

                    headerHozAlign: "center",

                    headerFilterPlaceholder: "Search By Employee Id"

                },

                {

                    title: "Username",

                    field: "username",

                    hozAlign: "center",

                    headerFilter: "input",

                    headerHozAlign: "center",

                    headerFilterPlaceholder: "Search By Username"

                },

                {

                    title: "Email",

                    field: "email",

                    hozAlign: "center",

                    headerFilter: "input",

                    headerHozAlign: "center",

                    headerFilterPlaceholder: "Search By Email"

                },

                {

                    title: "Department",

                    field: "department_id",

                    hozAlign: "center",

                    headerFilter: "input",

                    headerHozAlign: "center",

                    headerFilterPlaceholder: "Search By Department"

                },

                {

                    title: "Designation",

                    field: "designation_id",

                    hozAlign: "center",

                    headerFilter: "input",

                    headerHozAlign: "center",

                    headerFilterPlaceholder: "Search By Designation"

                },

                {

                    title: "Photo",

                    field: "profile_image",

                    hozAlign: "center",

                    headerFilter: "input",

                    headerHozAlign: "center",

                    headerFilterPlaceholder: "Search By Photo",

                    formatter: function(cell) {

                        const profile_image = cell.getValue();

                        return profile_image ?

                            `<a target="_blank" href="${BASE_URL}admin_assets/images/profile_image/${profile_image}" title="View Profile Image"><i class="fa fa-eye"></i></a>` :

                            '-';

                    }

                },

                {

                    title: "Status",

                    field: "status",

                    hozAlign: "center",

                    headerFilter: "input",

                    headerHozAlign: "center",

                    headerFilterPlaceholder: "Search By Status",

                    formatter: function(cell) {

                        const status = cell.getValue();

                        return status === 'active' ? '<span class="badge bg-success">Active</span>' :

                            status === 'inactive' ? '<span class="badge bg-danger">Inactive</span>' : '';

                    }

                },

                {

                    title: "Action",

                    field: "id",

                    width: 150,

                    hozAlign: "center",

                    headerHozAlign: "center",

                    formatter: function(cell) {

                        const rowData = cell.getRow().getData();

                        const id = rowData.id;

                        const status = rowData.status;

                        let action = status === 'active' ?

                            `<a class="btn btn-sm btn-outline-dark btn-danger text-white" href="${BASE_URL}inactive/tbl_user/${id}" onclick="return confirm('Are you sure you want to inactivate this?');"><i class="bi bi-x-circle"></i></a>` :

                            `<a class="btn btn-sm btn-outline-dark btn-success text-white" href="${BASE_URL}active/tbl_user/${id}" onclick="return confirm('Are you sure you want to activate this?');"><i class="bi bi-check-circle"></i></a>`;

                        action += `

                        <a class="btn btn-sm btn-outline-danger me-1" href="${BASE_URL}delete/tbl_user/${id}" onclick="return confirm('Are you sure you want to delete this?');"><i class="bi bi-trash"></i></a>

                        <a class="btn btn-sm btn-outline-dark" href="${BASE_URL}add-user/${id}"><i class="bi bi-pencil"></i></a>`;

                        return action;

                    }

                }

            ]

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
        $("#employee_id").on('keyup change', function() {

            var employeeId = $(this).val();

            var id = $("#id").val();



            $.ajax({

                url: '<?= base_url() ?>admin/Ajax_controller/check_unique_employee_id',

                method: 'POST',

                data: {

                    employee_id: employeeId,

                    id: id

                },

                success: function(response) {

                    if (response === "exists") {

                        $("#employee_id_error").html("This Employee ID already exists !");

                        $("#submit").prop('disabled', true);

                    } else {

                        $("#employee_id_error").html("");

                        $("#submit").prop('disabled', false);

                    }

                }

            });

        });



        $("#email").on('keyup change', function() {

            var email = $(this).val();

            var id = $("#id").val();



            $.ajax({

                url: '<?= base_url() ?>admin/Ajax_controller/check_unique_email',

                method: 'POST',

                data: {

                    email: email,

                    id: id

                },

                success: function(response) {

                    if (response === "exists") {

                        $("#email_error").html("This Email already exists !");

                        $("#submit").prop('disabled', true);

                    } else {

                        $("#email_error").html("");

                        $("#submit").prop('disabled', false);

                    }

                }

            });

        });

        $("#username").on('keyup change', function() {

            var username = $(this).val();

            var id = $("#id").val();



            $.ajax({

                url: '<?= base_url() ?>admin/Ajax_controller/check_unique_username',

                method: 'POST',

                data: {

                    username: username,

                    id: id

                },

                success: function(response) {

                    if (response === "exists") {

                        $("#username_error").html("This Username already exists !");

                        $("#submit").prop('disabled', true);

                    } else {

                        $("#username_error").html("");

                        $("#submit").prop('disabled', false);

                    }

                }

            });

        });
    </script>



    <script>
        $(document).ready(function() {

            // $.validator.addMethod("customEmail", function(value, element) {

            //  return this.optional(element) || /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/.test(value);

            // }, "Please enter a valid email address");

            $.validator.addMethod("validate_email", function(value, element) {
                return this.optional(element) || /^[a-z0-9._%+-]+@[a-z.-]+\.[a-z]{2,}$/.test(value);
            }, "Please enter a valid email address without digits after '@'.");

            $.validator.addMethod("noSpaceStart", function(value, element) {

                return this.optional(element) || /^[^\s]/.test(value);

            }, "No space allowed at the beginning.");

            $.validator.addMethod("noNumberAtStart", function(value, element) {

                return this.optional(element) || /^\d/.test(value) === false;

            }, "First letter cannot be number");

            // $.validator.addMethod("lettersonly", function(value, element) {
            //     return this.optional(element) || /^[a-zA-Z]/.test(value) == true;
            // }, "Letters and spaces only allowed !");

            $.validator.addMethod("customPassword", function(value, element) {

                return this.optional(element) || /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/.test(value);

            }, "Password must be at least 8 characters long and include uppercase, lowercase, a number, and a special character !");

            $("#add_user").validate({

                ignore: [],

                rules: {

                    first_name: {

                        noSpaceStart: true,

                        required: true,

                        noNumberAtStart: true

                    },

                    middle_name: {

                        noSpaceStart: true,

                        required: true,

                        noNumberAtStart: true

                    },

                    last_name: {

                        noSpaceStart: true,

                        required: true,

                        noNumberAtStart: true

                    },

                    employee_id: {

                        noSpaceStart: true,

                        required: true

                    },

                    email: {

                        noSpaceStart: true,

                        required: true,

                        validate_email: true

                    },
                    username: {
                        required: true,
                        noSpaceStart: true,
                        noNumberAtStart: true,
                        // lettersonly: true
                    },

                    department_id: {

                        required: true

                    },

                    designation_id: {

                        required: true

                    },

                    password: {

                        noSpaceStart: true,

                        customPassword: true,

                        required: true,

                    },

                    profile_image: {

                        //   extension: "jpg|jpeg|png"

                    }

                },

                messages: {

                    first_name: {

                        required: "Please enter first name !",

                        noSpaceStart: "Please enter valid first name !",

                        noNumberAtStart: "Please enter valid first name !",

                    },

                    middle_name: {

                        required: "Please enter middle name !",

                        noSpaceStart: "Please enter valid middle name !",

                        noNumberAtStart: "Please enter valid middle name !",

                    },

                    last_name: {

                        required: "Please enter last name !",

                        noSpaceStart: "Please enter valid last name !",

                        noNumberAtStart: "Please enter valid last name !",

                    },

                    employee_id: {

                        required: "Please enter Employee ID !",

                        noSpaceStart: "Please enter valid Employee ID !"

                    },
                    username: {
                        required: "Please enter username !",
                        noSpaceStart: "Please enter valid username !",
                        noNumberAtStart: "Please enter valid username !",
                        // lettersonly: "Please enter valid username !"
                    },
                    email: {

                        required: "Please enter email !",

                        validate_email: "Please enter valid email !",

                        noSpaceStart: "Please enter valid email !"

                    },

                    department_id: {

                        required: "Please select a department !"

                    },

                    designation_id: {

                        required: "Please select a designation !"

                    },

                    password: {

                        required: "Please enter password !",

                        noSpaceStart: "Please enter valid password !",

                        customPassword: "Please enter valid password !"

                    },

                    profile_image: {

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

                // submitHandler: function(form) {

                //     form.submit();

                // }
                submitHandler: function(form) {
                    form.submit(); // ✅ this will only run if validation passes
                }


            });



            $('#designation_id, #department_id').change(function() {

                $(this).valid();

            });



        });

        $("#email").keyup(function() {
            var input_text = $(this).val();
            var lower_text = input_text.toLowerCase();
            $('#lower_text').val(lower_text);
            $(this).val(lower_text);
        });
    </script>





    <script>
        $(document).ready(function() {
            $('#master .nav-link').addClass('nav_active');
            $('#master .child_menu').addClass('show');
            $('#add-user').addClass('active_cc');

        });
    </script>