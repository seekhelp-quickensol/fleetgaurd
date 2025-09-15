<?php include('header.php');?>

<div class="main-content">
    <div class="sub-content">
        <div class="page-header">
            <h1 class="page-title">
              Master


            </h1>
           
        </div>

        <?php include('tabs.php'); ?>



        <!-- tab content  -->
        <div class="tab-content mt-3" id="myTabContent">

            <div class="tab-pane fade show active fade-in " id="main-table" role="tabpanel">
                <h6 class="mb-3">Add Machine</h6>
                <div class="form-data mb-4">
                    <div class="row flex_wrap">
                        <div class="form-group col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <label>Machine Name <b class="require">*</b></label>
                            <input autocomplete="off" type="text" class="form-control" name="machine_name"
                                id="machine_name" value="" placeholder="Enter machine name">
                            <span id="machine_name_error"></span>
                        </div>
                        <input autocomplete="off" type="hidden" name="id" id="id" value="">
                        <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                            <button id="submit" type="submit" class="btn btn-dark btn-sm mt-4">Submit</button>
                        </div>
                    </div>

                </div>
                <h6 class="mb-3">Machine List</h6>
                <div class="list-data">
                    <div class="">
                        <div class="manufacturer-tables mt-1 p-2"></div>

                    </div>
                </div>

            </div>


        </div>
    </div>
    <?php include('footer.php');?>
    <script>
    var projectData = [{
            id: 1,
           machine_name: "Machine 1",
            status: "Active",
            action: "",

        },
        {
            id: 2,
           machine_name: "Machine 2",
            status: "Active",
            action: "",

        },
        {
            id: 3,
           machine_name: "Machine 3",
            status: "Active",
            action: "",
        },
        

    ];

    var table = new Tabulator(".manufacturer-tables", {


        pagination: true,
        paginationSize: 10,
        selectable: true,
        layout: "fitColumns",
        responsiveLayout: "collapse",

        columns: [{
                title: "Sr.No",
                formatter: "rownum",
                hozAlign: "center",
                headerSort: false,
                width: 50
            },
            
            {
                title: "Machine Name",
                field: "machine_name",

                hozAlign: "center",
                headerFilter: "input",

            },
            {
                title: "Status",
                field: "status",

                hozAlign: "center",
                headerFilter: "input",

            },

            {
                title: "Action",
                field: "action",
                width: 150,
                hozAlign: "center",
                formatter: function(cell, formatterParams) {
                    return `
        <button class="btn btn-sm btn-outline-danger me-1 delete-row" title="Delete">
            <i class="bi bi-trash"></i>
        </button>
        <button class="btn btn-sm btn-outline-dark edit" title="Edit">
            <i class="bi bi-pencil"></i>
        </button>
    `;
                },

                cellClick: function(e, cell) {
                    let row = cell.getRow();
                    if (e.target.classList.contains("delete-row")) {
                        row.delete(); // Delete row
                    }

                }
            }
        ],
        data: projectData,
    });
    </script>
   <script>
    $(document).ready(function(){
        $('#master').addClass('active');
            });
            
</script>