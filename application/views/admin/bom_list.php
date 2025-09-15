<?php include('header.php'); ?>



<div class="main-content">

    <div class="sub-content">
<!-- 
        <div class="page-header">


            <h1 class="page-title">

                Master





            </h1>



        </div> -->



      







        <!-- tab content  -->

        <div class="tab-content" id="myTabContent">



            <div class="tab-pane fade show active fade-in " id="main-table" role="tabpanel">

                <h6 class="mb-3"> BOM List</h6>





                <div class="bom-data">

                    <div class="">

                        <div class="bom-table mt-1 p-2"></div>



                    </div>

                </div>



            </div>





        </div>

    </div>

    <?php include('footer.php'); ?>

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
         $('#bom_list').addClass('active_cc');

    });
  
    </script>