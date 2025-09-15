<?php include('header.php'); ?>

<style>

    .error {

        color: red;

    }



    .error-message {

        width: 100%;

        margin-top: .25rem;

        font-size: .875em;

        color: var(--bs-form-invalid-color);

    }

</style>

<div class="main-content">

    <div class="sub-content">
<!-- 
        <div class="page-header">

            <h1 class="page-title">

                Site Master

            </h1>

        </div> -->




        <div class="tab-content " id="myTabContent">

            <div class="tab-pane fade show active fade-in " id="main-table" role="tabpanel">

                <?php if ($this->uri->segment(2) != '') { ?>

                    <h6 class="table-title mb-3">Update Site</h2>

                    <?php } else { ?>

                        <h6 class="table-title mb-3">Add Site</h2>

                        <?php } ?>

                        <div class="form-data mb-4">

                            <form method="post" name="add_site" id="add_site" enctype="multipart/form-data">

                                <div class="row flex_wrap">

                                    <div class="form-group col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">

                                        <label>Site Name<b class="require">*</b></label>

                                        <input autocomplete="off" type="text" class="form-control" name="site_name"

                                            id="site_name" value="<?php if (!empty($single)) {

                                                                        echo $single->site_name;

                                                                    } ?>" placeholder="Enter site name">

                                        <input type="hidden" name="id" id="id" value="<?php if (!empty($single)) {

                                                                                            echo $single->id;

                                                                                        } ?>">

                                        <span id="site_name_error" class="error-message"></span>

                                    </div>

                                   <div class="form-group col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">

                                        <button id="submit" type="submit" class="btn btn-dark "style="margin-top:30px">Submit</button>

                                    </div>

                                </div>

                            </form>

                        </div>

                        <h6 class="mb-3">Site List</h6>

                        <div class="list-data">

                            <div>

                                <!-- <button id="download-xlsx" class="btn btn-muted mb-3"> Excel</button> -->

                            </div>

                            <div class="">

                                <div class="site-list mt-1 p-2"></div>



                            </div>

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

        var table = new Tabulator(".site-list", {

            pagination: true,

            paginationSize: 10,

            selectable: true,

            layout: "fitColumns",

            responsiveLayout: "collapse",



            ajaxURL: "<?= base_url() ?>admin/Ajax_controller/get_all_site_list_ajax",

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

                    title: "Site Name",

                    field: "site_name",

                    hozAlign: "center",

                    headerFilter: "input",

                    headerHozAlign: "center",

                    headerFilterPlaceholder: "Search By Site Name"



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

                      href="<?= base_url('inactive/tbl_site/') ?>${id}"

                      onclick="return confirm('Are you sure you want to inactivate this?');">

                      <i class="bi bi-x-circle"></i>

                      </a>`;

                        } else {

                            action = `

                      <a class="btn btn-sm btn-outline-dark edit-row btn-success text-white"

                      href="<?= base_url('active/tbl_site/') ?>${id}"

                      onclick="return confirm('Are you sure you want to activate this ?');">

                      <i class="bi bi-check-circle "></i>

                      </a>`;

                        }

                        action += `

                  <a class="btn btn-sm btn-outline-danger me-1 delete-row"

                  href="<?= base_url('delete/tbl_site/') ?>${id}"

                  onclick="return confirm('Are you sure you want to delete this ?');">

                      <i class="bi bi-trash"></i>

                  </a>

                  <a class="btn btn-sm btn-outline-dark edit-row"

                  href="<?php echo base_url('site/'); ?>${id}">

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

            $.validator.addMethod("noSpaceStart", function(value, element) {

                return this.optional(element) || /^[^\s]/.test(value);

            }, "No space allowed at the beginning.");



            $.validator.addMethod("lettersOnly", function(value, element) {

                return this.optional(element) || /^[a-zA-Z\s]+$/.test(value);

            }, "Only letters are allowed, no numbers or special characters.");



            $("#add_site").validate({

                rules: {

                    site_name: {

                        noSpaceStart: true,

                        required: true,

                    }

                },

                messages: {

                    site_name: {

                        required: "Please enter the site name !",

                        noSpaceStart: "Please enter valid the site name !",

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

        });

    </script>

    <script>

        $('#site_name').on('keyup', function() {

            var site_name = $(this).val();



            $.ajax({

                url: '<?= base_url() ?>admin/Ajax_controller/check_unique_site_name',

                method: 'post',

                data: {

                    'site_name': site_name,

                    'id': '<?= $id ?>'

                },

                success: function(response) {

                    if (response == 1) {

                        $('#site_name_error').text("This site name is already added !");

                        $('#submit').prop('disabled', true);

                    } else {

                        $('#site_name_error').text("");

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
    $(document).ready(function() {
        $('#master .nav-link').addClass('nav_active');
        $('#master .child_menu').addClass('show');
         $('#site').addClass('active_cc');

    });
  
    </script>