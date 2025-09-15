<?php include('header.php'); ?>
<style>
    .error_messages {
        color: red;
    }
</style>
<div class="main-content">
    <div class="sub-content">
        <div class="page-header">
            <h1 class="page-title">
                Master
            </h1>
        </div>
        <?php include('tabs.php'); ?>
        <div class="tab-content mt-3" id="myTabContent">
            <div class="tab-pane fade show active fade-in " id="main-table" role="tabpanel">
                <h6 class="mb-3">
                    <?php if (!empty($single)) { ?>
                        Update FG
                    <?php } else { ?>
                        Add FG
                    <?php } ?>
                </h6>
                <form method="post" name="fg_details_form" id="fg_details_form" enctype="multipart/form-data">
                    <div class="form-data mb-4">
                        <div class="row flex_wrap">
                            <div class="form-group col-xl-4 col-lg-4 col-md-4 col-sm-12">
                                <label> FG Item <b class="require">*</b></label>
                                <input type="text" class="form-control " name="finish_good_item" id="finish_good_item" value="<?php if (!empty($single)) {
                                                                                                                                    echo $single->finish_good_item;
                                                                                                                                } ?>"
                                    placeholder="Enter FG item">
                                <span id="finish_good_item_error" class="error_messages"></span>
                            </div>
                            <div class="form-group col-xl-4 col-lg-4 col-md-4 col-sm-12">
                                <label>FG Item Description <b class="require">*</b></label>
                                <input type="text" class="form-control" name="item_description" id="item_description" value="<?php if (!empty($single)) {
                                                                                                                                    echo $single->item_description;
                                                                                                                                } ?>"
                                    placeholder="Enter FG Item Description">
                                <span id="item_description_error" class="error_messages"></span>

                            </div>
                            <input type="hidden" class="form-control" name="id" id="id" value="<?php if (!empty($single)) {
                                                                                                    echo $single->id;
                                                                                                } ?>"
                                placeholder="Enter FG Item Description">
                        </div>

                        <div class="form-group">
                            <button id="submit" type="submit" class="btn btn-dark btn-sm mt-2">Submit</button>
                        </div>
                    </div>
                </form>
                <h6 class="mb-3">FG List</h6>
                <div class="fg-data">
                    <div class="fg-table mt-1 p-2"></div>
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
            $("#fg_details_form").validate({
                ignore: [],
                rules: {
                    finish_good_item: {
                        required: true,
                        noSpaceAtStart: true,
                        number: true
                    },
                    item_description: {
                        required: true,
                        noSpaceAtStart: true,
                    }

                },
                messages: {
                    finish_good_item: {
                        required: "Please enter finish good item !",
                        number: "Please enter valid finish good item !",
                        noSpaceAtStart: "Please enter valid finish good item !",
                    },
                    item_description: {
                        required: "Please enter item description !",
                        noSpaceAtStart: "Please enter valid item description !"
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

        $('#finish_good_item').on('keyup', function() {
            var finish_good_item = $(this).val();
            $.ajax({
                url: '<?= base_url() ?>admin/Ajax_controller/check_unique_finish_good_item',
                method: 'post',
                data: {
                    'finish_good_item': finish_good_item,
                    'id': '<?= $id ?>'
                },
                success: function(response) {
                    if (response == 1) {
                        $('#finish_good_item_error').text("This finish good item is already added !");
                        $('#submit').prop('disabled', true);
                    } else {
                        $('#finish_good_item_error').text("");
                        $('#submit').prop('disabled', false);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('AJAX Error: ' + textStatus, errorThrown);
                }
            });
        });

        $('#item_description').on('keyup', function() {
            var item_description = $(this).val();
            $.ajax({
                url: '<?= base_url() ?>admin/Ajax_controller/check_unique_item_description',
                method: 'post',
                data: {
                    'item_description': item_description,
                    'id': '<?= $id ?>'
                },
                success: function(response) {
                    if (response == 1) {
                        $('#item_description_error').text("This item description is already added !");
                        $('#submit').prop('disabled', true);
                    } else {
                        $('#item_description_error').text("");
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
            $('#master').addClass('active');
        });
    </script>
    <script>
        var table = new Tabulator(".fg-table", {
            pagination: true,
            paginationSize: 10,
            selectable: true,
            layout: "fitColumns",
            responsiveLayout: "collapse",
            ajaxURL: "<?= base_url() ?>admin/Ajax_controller/get_all_fg_list_ajax",
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
                    title: "FG Item",
                    field: "finish_good_item",
                    hozAlign: "center",
                    headerFilter: "input",
                    headerHozAlign: "center",
                    headerFilterPlaceholder: "Search By FG Item"
                },
                {
                    title: "FG Item Description",
                    field: "item_description",
                    hozAlign: "center",
                    headerFilter: "input",
                    headerHozAlign: "center",
                    headerFilterPlaceholder: "Search By FG Item Description"
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
                      href="<?= base_url('inactive/tbl_add_fg/') ?>${id}"
                      onclick="return confirm('Are you sure you want to inactivate this?');">
                      <i class="bi bi-x-circle"></i>
                      </a>`;
                        } else {
                            action = `
                      <a class="btn btn-sm btn-outline-dark edit-row btn-success text-white"
                      href="<?= base_url('active/tbl_add_fg/') ?>${id}"
                      onclick="return confirm('Are you sure you want to activate this ?');">
                      <i class="bi bi-check-circle "></i>
                      </a>`;
                        }
                        action += `
                  <a class="btn btn-sm btn-outline-danger me-1 delete-row"
                  href="<?= base_url('delete/tbl_add_fg/') ?>${id}"
                  onclick="return confirm('Are you sure you want to delete this ?');">
                      <i class="bi bi-trash"></i>
                  </a>
                  <a class="btn btn-sm btn-outline-dark edit-row"
                  href="<?php echo base_url('add-fg/'); ?>${id}">
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