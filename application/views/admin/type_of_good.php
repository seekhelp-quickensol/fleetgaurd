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
        <!-- <div class="page-header">
            <h1 class="page-title">
                Master
            </h1>
        </div>
     -->


        <!-- tab content  -->
        <div class="tab-content" id="myTabContent">

            <div class="tab-pane fade show active fade-in " id="main-table" role="tabpanel">
                <h6 class="mb-3">
                    <?php if (!empty($single)) { ?>
                        Update Type of Good
                    <?php } else { ?>
                        Add Type of Good
                    <?php } ?>
                </h6>
                <div class="form-data mb-4">
                    <form method="post" name="add_good_type" id="add_good_type" enctype="multipart/form-data">

                        <div class="row flex_wrap">
                            <div class="form-group col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <label>Type of Good<b class="require">*</b></label>
                                <input autocomplete="off" type="text" class="form-control" name="good_type_name"
                                    id="good_type_name" value="<?php if (!empty($single)) {
                                                                    echo $single->good_type_name;
                                                                } ?>" placeholder="Enter type of good">
                                <input type="hidden" name="id" id="id" value="<?php if (!empty($single)) {
                                                                                    echo $single->id;
                                                                                } ?>">
                                <span id="good_type_name_error" class="error-message"></span>
                            </div>
                            <div class="form-group col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <button id="submit" type="submit" class="btn btn-dark " style="margin-top:30px">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
                <h6 class="mb-3">Type Of Good List</h6>
                <div class="list-data">
                    <div class="">
                        <div class="good-type mt-1 p-2"></div>

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
        var table = new Tabulator(".good-type", {
            pagination: true,
            paginationSize: 10,
            selectable: true,
            layout: "fitColumns",
            responsiveLayout: "collapse",

            ajaxURL: "<?= base_url() ?>admin/Ajax_controller/get_all_good_type_list_ajax",
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
                    title: "Good Type",
                    field: "good_type_name",
                    hozAlign: "center",
                    headerFilter: "input",
                    headerHozAlign: "center",
                    headerFilterPlaceholder: "Search By Good Type"

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
                      href="<?= base_url('inactive/tbl_good_type/') ?>${id}"
                      onclick="return confirm('Are you sure you want to inactivate this?');">
                      <i class="bi bi-x-circle"></i>
                      </a>`;
                        } else {
                            action = `
                      <a class="btn btn-sm btn-outline-dark edit-row btn-success text-white"
                      href="<?= base_url('active/tbl_good_type/') ?>${id}"
                      onclick="return confirm('Are you sure you want to activate this ?');">
                      <i class="bi bi-check-circle "></i>
                      </a>`;
                        }
                        action += `
                  <a class="btn btn-sm btn-outline-danger me-1 delete-row"
                  href="<?= base_url('delete/tbl_good_type/') ?>${id}"
                  onclick="return confirm('Are you sure you want to delete this ?');">
                      <i class="bi bi-trash"></i>
                  </a>
                  <a class="btn btn-sm btn-outline-dark edit-row"
                  href="<?php echo base_url('type-of-good/'); ?>${id}">
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

            $("#add_good_type").validate({
                rules: {
                    good_type_name: {
                        required: true,
                        noSpaceStart: true,
                    }
                },
                messages: {
                    good_type_name: {
                        required: "Please enter the type of good !",
                        noSpaceStart: "Please enter the valid type of good !",
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
        $('#good_type_name').on('keyup', function() {
            var good_type_name = $(this).val();

            $.ajax({
                url: '<?= base_url() ?>admin/Ajax_controller/check_unique_good_type_name',
                method: 'post',
                data: {
                    'good_type_name': good_type_name,
                    'id': '<?= $id ?>'
                },
                success: function(response) {
                    if (response == 1) {
                        $('#good_type_name_error').text("This good type name is already added !");
                        $('#submit').prop('disabled', true);
                    } else {
                        $('#good_type_name_error').text("");
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
         $('#type_good').addClass('active_cc');

    });
  
    </script>