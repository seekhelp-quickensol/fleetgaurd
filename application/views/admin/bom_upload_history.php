




<?php include('header.php');?>

<div class="main-content">
    <div class="sub-content">
        <h6 >
                 BOM Upload History


            </h6>
   



        <!-- tab content  -->
        <div class="tab-content mt-3" id="myTabContent">

            <div class="tab-pane fade show active fade-in " id="main-table" role="tabpanel">
                <!-- <h6 class="mb-3"> BOM Upload History</h6> -->
               
              
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

    // Dummy data for 3 initial rows
    var projectData = [
    {
        datetime: "2025-05-22 10:30 AM",
        bom_url: "bom-report-001.pdf"
    },
    {
        datetime: "2025-05-21 02:15 PM",
        bom_url: "bom-report-002.pdf"
    },
    {
        datetime: "2025-05-20 04:45 PM",
        bom_url: "bom-report-003.pdf"
    }
];

    // Tabulator setup
    var table = new Tabulator(".manufacturer-tables", {
    pagination: true,
    paginationSize: 10,
    layout: "fitDataStretch",

    columns: [
        { title: "Sr.No", formatter: "rownum", hozAlign: "center", headerSort: false, width: 60 },
        { title: "Date/Time", field: "datetime", hozAlign: "center", width: 500 },
        {
            title: "BOM Report",
            field: "bom_url",
            hozAlign: "center",
            width: 500,
            formatter: function(cell) {
                const url = cell.getValue();
                return `<a class="btn btn-sm btn-dark" href="#" target="_blank">View</a>`;
            }
        },
        {
            title: "Action",
            hozAlign: "center",
            width: 200,
            formatter: () => `
                <button class="btn btn-sm btn-outline-danger delete-row">
                    <i class="bi bi-trash"></i>
                </button>`,
            cellClick: function(e, cell) {
                if (e.target.closest('.delete-row')) {
                    cell.getRow().delete();
                }
            }
        }
    ],

    data: projectData,
});
     
    </script>
   

   <script>
    $(document).ready(function() {
        $('#bom-master .nav-link').addClass('nav_active');
        $('#bom-master .child_menu').addClass('show');
         $('#bom_history').addClass('active_cc');

    });
  
    </script>
  