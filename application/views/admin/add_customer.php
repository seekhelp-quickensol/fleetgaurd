<?php include('header.php');?>

<div class="main-content">
    <div class="sub-content">
        <div class="page-header">
            <h1 class="page-title">
                Customer Master
            </h1>
        </div>
        <?php include('tabs.php'); ?>

        <!-- tab content  -->
        <div class="tab-content mt-3" id="myTabContent">

            <div class="tab-pane fade show active fade-in " id="main-table" role="tabpanel">
                <!-- <h6 class="mb-3">Add Customer</h6> -->


                <div class=" mt-4 lead-tab">
                    <!-- Tab Menu -->
                    <ul class="nav nav-tabs" id="myTabs">
                        <li class="nav-item">
                            <a class="nav-link active" id="company-details-tab" data-bs-toggle="tab"
                                href="#company-details">Headquater Details</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url() ?>plant-details">Plant Details</a>
                        </li>


                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content mt-3">
                        <div class="tab-pane fade show active" id="company-details">
                            <div class="cards-body">
                                <div class="row flex_wrap">



                                    <div class="form-group col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                        <label>Company Name <b class="require">*</b></label>
                                        <input autocomplete="off" type="text" class="form-control" name="company_name"
                                            id="company_name" value="" placeholder="Enter company name">
                                    </div>
                                    <div class="form-group col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                        <label>Management Name <b class="require">*</b></label>
                                        <input autocomplete="off" type="text" class="form-control"
                                            name="management_name" id="management_name" value=""
                                            placeholder="Enter management name">
                                    </div>
                                    <div class="form-group col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                        <label>Management Email <b class="require">*</b></label>
                                        <input autocomplete="off" type="text" class="form-control"
                                            name="management_email" id="management_email" value=""
                                            placeholder="Enter management email">
                                    </div>
                                    <div class="form-group col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                        <label>Management Mobile <b class="require">*</b></label>
                                        <input autocomplete="off" type="text" class="form-control"
                                            name="management_mobile" id="management_mobile" value=""
                                            placeholder="Enter management mobile">
                                    </div>
                                    <div class="form-group col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                        <label>Designation <b class="require">*</b></label>
                                        <select type="text" class="form-control js-example-basic-single"
                                            name="designation" id="designation" value="" style="width:100%">
                                            <option value="">Select Contact Person Designation</option>
                                            <option value="CEO">CEO (Chief Executive Officer)</option>
                                            <option value="COO">COO (Chief Operating Officer)</option>
                                            <option value="Managing Director">Managing Director</option>
                                            <option value="General Manager">General Manager (GM)</option>

                                        </select>
                                    </div>
                                    <div class="form-group col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                        <label>PAN <b class="require">*</b></label>
                                        <input autocomplete="off" type="text" class="form-control" name="pan" id="pan"
                                            value="" placeholder="Enter PAN">
                                    </div>
                                    <div class="form-group col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                        <label>TIN <b class="require">*</b></label>
                                        <input autocomplete="off" type="text" class="form-control" name="tin" id="tin"
                                            value="" placeholder="Enter TIN">
                                    </div>
                                    <div class="form-group col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                        <label>CIN <b class="require">*</b></label>
                                        <input autocomplete="off" type="text" class="form-control" name="cin" id="cin"
                                            value="" placeholder="Enter CIN">
                                    </div>

                                    <div class="form-group col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                        <label>Customer Type <b class="require">*</b></label>
                                        <select class="form-control js-example-basic-single" name="customer_type"
                                            id="customer_type" value="" style="width:100%">
                                            <option value="0">Select Customer Type</option>
                                            <option value="1">Principal</option>
                                            <option value="4">Sales Reference</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                        <label>Customer Since <b class="require">*</b></label>
                                        <select class="form-control js-example-basic-single" name="customer_since"
                                            id="customer_since" style="width:100%">
                                            <option value="">Select Customer Since</option>
                                            <option value="existing">Existing</option>
                                            <option value="contacted">Contacted</option>
                                            <option value="potential">Potential</option>
                                            <option value="non_potential">Non Potential</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                        <label>Customer Remark </label>
                                        <input autocomplete="off" type="text" class="form-control" name="remark"
                                            id="remark" value="" placeholder="Enter Remark">
                                    </div>

                                </div>
                                <div class="tab-navigation mt-3 d-flex justify-content-between">

                                    <button type="button" class="btn  btn-sm btn-dark next-tab">
                                        Submit
                                    </button>

                                </div>

                            </div>

                            <h6 class="mb-3 mt-4">Headquater List</h6>
                            <div class="list-data">
                                <div class="">
                                    <div class="manufacturer-tables mt-1 p-2"></div>

                                </div>
                            </div>


                        </div>



                    </div>

                </div>





            </div>


        </div>
    </div>
    <?php include('footer.php');?>
    <script>
    var projectData = [{
            id: 1,
            company_name: "infotect Pvt Ltd",
            management_name: "Rahul",
            management_email: "rahul@infotect.com",
            management_mobile: "1234567890",
            designation: "CEO",
            pan: "ABC123",
            tin: "ABC123",
            cin: "ABC123",
            customer_type: "Customer",
            customer_since: "Contacted",
            remark: "Test",   
            status: "Active",
            action: "",

        },
        {
            id: 2,
            company_name: "shaurya Pvt Ltd",
            management_name: "Aaditya",
            management_email: "aadi@shaurya.com",
            management_mobile: "1234567890",
            designation: "CEO",
            pan: "ABC123",
            tin: "ABC123",
            cin: "ABC123",
            customer_type: "Customer",
            customer_since: "Contacted",
            remark: "Test",   
            status: "Active",
            action: "",
        }, {
            id: 3,
            company_name: "RTV Pvt Ltd",
            management_name: "Diya",
            management_email: "diya@rtv.com",
            management_mobile: "1234567890",
            designation: "CEO",
            pan: "ABC123",
            tin: "ABC123",
            cin: "ABC123",
            customer_type: "Customer",
            customer_since: "Contacted",
            remark: "Test",   
            status: "Active",
            action: "",
        }






    ];

    var table = new Tabulator(".manufacturer-tables", {


        pagination: true,
        paginationSize: 10,
        selectable: true,
        layout: "fitColumns",
        rowHeader:{hozAlign:"center"},


        columns: [{
                title: "Sr.No",
                formatter: "rownum",
                hozAlign: "center",
                headerSort: false,
                width: 50
            },

            {
                title: "Company Name",
                field: "company_name",
                headerFilter: true,
                headerFilter: "input",
                width: 130,
            },

            {
                title: "Management Name",
                field: "management_name",
                headerFilter: true,
                headerFilter: "input",
                width: 130,

            },
            {
                title: "Management Email",
                field: "management_email",
                headerFilter: true,
                headerFilter: "input",
                width: 130,
            },
            {
                title: "Management Mobile",
                field: "management_mobile",
                headerFilter: true,
                headerFilter: "input",
                width: 130,
            },
            {
                title: "Designation",
                field: "designation",
                headerFilter: true,
                headerFilter: "input",
                width: 130,

            },
            {
                title: "Pan",
                field: "pan",
                headerFilter: true,
                headerFilter: "input",
                width: 130,

            },
            {
                title: "Tin",
                field: "tin",
                headerFilter: true,
                headerFilter: "input",
                width: 130,

            },
            {
                title: "Cin",
                field: "cin",
                headerFilter: true,
                headerFilter: "input",
                width: 130,

            },
            {
                title: "Customer Type",
                field: "customer_type",
                headerFilter: true,
                headerFilter: "input",
                width: 130,

            },

           
            {
                title: "Customer Since ",
                field: "customer_since",
                headerFilter: true,
                headerFilter: "input",
                width: 130,

            },
            {
                
                title: "Remark ",
                field: "remark",
                headerFilter: true,
                headerFilter: "input",
                width: 130,
            },


            {
                title: "Status",
                field: "status",
                hozAlign: "center",
                headerFilter: "input",
                width: 130,

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
                        row.delete(); 
                    }

                }
            }
        ],
        data: projectData,
    });
    </script>
    <script>
    $(document).ready(function() {
        $('#master').addClass('active');
    });
    </script>

    <script>
    $('#add_more').click(function(e) {
        e.preventDefault();
        let count = $('.add_more_div').length;
        var html = $(".add_more_div").first().clone();

        $(html).find(".change").html(

            "<a class='text-danger remove mt-1' id='remove_item' style='cursor: pointer; font-size: 20px;'>" +
            "<i class='fas fa-minus-circle'></i></a>"
        );

        $(html).find(".page_sub_title h6").html("Contact Person " + count);
        $(".add_more_container").append(html);
    });

    $("body").on("click", ".remove", function() {
        $(this).parents(".add_more_div").remove();
    });
    </script>