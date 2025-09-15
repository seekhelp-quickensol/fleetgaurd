<?php include('header.php'); ?>

<style>
.DashboardImg {
    width: 100%;
    text-align: center;
}

.DashboardImg img {
    width: 150px;
    margin: 0 auto;
}

.DashboardImg p {
    font-size: 25px;
    color: #043e7e;
    font-weight: 600;
    margin-top: 20px;
}





.card {
    margin-bottom: 25px;
    border: 1px solid #ffffff00;

    background: #fff;
    /* box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px -1px rgba(0, 0, 0, .1); */

}

.media-body h3 {
    font-size: 34px;
    font-weight: 700;
    color: #323338;
}


.media-body span {
    color: #d0d8da;
}

.card-img .fa {
    color: white !important;
    font-size: 22px;
    line-height: 60px;
    text-align: center;
}


.media-body span {
    font-size: 14px;
    font-weight: 600;
    /* color: #f6f9ff !important; */
}

.card-img {
    width: 60px;
    height: 60px;
    flex: none;
    background-color: #d0d8da;
    text-align: center;
    border-radius: 50%;
}

#calendar {
    background-color: white;
}


.table-container {
    max-width: 100%;
    overflow-x: auto;
    background: #fff;
    padding: 15px;
    border-radius: 12px;
    border: 1px solid #dddddd;
}

h2 {
    text-align: center;
    margin-bottom: 15px;
}

table {
    width: 100%;
    border-collapse: collapse;
    text-align: center;
    font-size: 14px;
}

thead {
    background: #eef0f2;
    color: #fff;
}

th,
td {
    padding: 10px;
    border: 1px solid #ddd;
}

tr:nth-child(even) {
    background: #f8f9f9;
}

/* Priority Colors */
.black {
    background: #4b4747d4;
    color: #fff;
    font-weight: bold;
}

.red {
    background: #c4000087;
    color: #fff;
    font-weight: bold;
}

.yellow {
    background:#c9b6049e;
    font-weight: bold;
    color: #fff;
}

.green {
    background: #0e4e11cf;
    color: #fff;
    font-weight: bold;
}

.white {
    background: #ffffff;
    font-weight: bold;

}

/* Responsive Styling */
@media (max-width: 768px) {

    table,
    thead,
    tbody,
    th,
    td,
    tr {
        display: block;
    }

    thead {
        display: none;
    }

    tr {
        margin-bottom: 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 10px;
    }

    td {
        text-align: right;
        padding-left: 50%;
        position: relative;
    }

    td::before {
        content: attr(data-label);
        position: absolute;
        left: 15px;
        font-weight: bold;
        text-align: left;
    }
}

.media-body span {
    color: #62646d;
}

.card-supplier {
    background: #fcd7d6;
}

.card-item {
    background: #FFF4DE;
}

.card-machine {
    background: #D3E0DC;
}

.card-user {
    background: #AEE1E1;
}

.card-supplier .card-img {
    background: #ff9896;
}

.card-item .card-img {
    background: #ffdb93;
}

.card-machine .card-img {
    background: #7db1a1;
}

.card-user .card-img {
    background: #43cfcf;
}
</style>


<div class="main-content">
    <div class="sub-content">
        <div class="page-header">
            <h1 class="page-title">
                Welcome Fleetgaurd

            </h1>

        </div>

        <div class="container-fluid">

            <div class="animated flipInY col-md-12 col-sm-12 col-xs-12">

                <div class="right">

                    <div class="row">
                        <!-- Total Supplier -->
                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="card card-supplier">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="align-self-center card-img">
                                                <i class="fa fa-truck" aria-hidden="true"></i> <!-- supplier icon -->
                                            </div>
                                            <div class="media-body text-right">
                                                <h3>0</h3>
                                                <span>Total Supplier</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total Item -->
                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="card card-item">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="align-self-center card-img">
                                                <i class="fa fa-cubes" aria-hidden="true"></i>
                                                <!-- item/product icon -->
                                            </div>
                                            <div class="media-body text-right">
                                                <h3>7024</h3>
                                                <span>Total Item</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total Machine -->
                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="card card-machine">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="align-self-center card-img">
                                                <i class="fa fa-cogs" aria-hidden="true"></i> <!-- machine icon -->
                                            </div>
                                            <div class="media-body text-right">
                                                <h3>0</h3>
                                                <span>Total Machine</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total User -->
                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="card card-user">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="align-self-center card-img">
                                                <i class="fa fa-user" aria-hidden="true"></i> <!-- user icon -->
                                            </div>
                                            <div class="media-body text-right">
                                                <h3>1</h3>
                                                <span>Total User</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="table-container col-md-6">
                            <h6 class="mb-4">BPR Summary</h6>
                            <table>
                                <thead>
                                    <tr>
                                        <th>BPR Status</th>
                                        <th>Priority</th>
                                        <th>Total Part Qty</th>
                                        <th>Total Plan Qty</th>
                                        <th>Total Pending</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- MTS -->
                                    <tr>
                                        <td rowspan="5">MTS</td>
                                        <td class="black">Black</td>
                                        <td>20</td>
                                        <td>19</td>
                                        <td>1</td>
                                    </tr>
                                    <tr>
                                        <td class="red">Red</td>
                                        <td>30</td>
                                        <td>29</td>
                                        <td>1</td>
                                    </tr>
                                    <tr>
                                        <td class="yellow">Yellow</td>
                                        <td>20</td>
                                        <td>20</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td class="green">Green</td>
                                        <td>10</td>
                                        <td>10</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td class="white">White</td>
                                        <td>25</td>
                                        <td>0</td>
                                        <td>25</td>
                                    </tr>

                                    <!-- MTO -->
                                    <tr>
                                        <td rowspan="5">MTO</td>
                                        <td class="black">Black</td>
                                        <td>35</td>
                                        <td>23</td>
                                        <td>12</td>
                                    </tr>
                                    <tr>
                                        <td class="red">Red</td>
                                        <td>23</td>
                                        <td>23</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td class="yellow">Yellow</td>
                                        <td>12</td>
                                        <td>12</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td class="green">Green</td>
                                        <td>34</td>
                                        <td>34</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td class="white">White</td>
                                        <td>56</td>
                                        <td>0</td>
                                        <td>56</td>
                                    </tr>

                                    <!-- Total -->
                                    <tr style="font-weight:bold; background:#e0e0e0;">
                                        <td colspan="2">Total</td>
                                        <td>125</td>
                                        <td>160</td>
                                        <td>105</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="col-md-6 graph">
                            <div class="graphical-representation" style="background:#646363; padding:20px;">
                                <canvas id="myChart" style="width:100%; height:100%;"></canvas>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>





    </div>

</div>
<?php include('footer.php'); ?>
<script src="<?= base_url() ?>admin_assets/js/canvasjs.min.js"></script>
<script src="<?= base_url() ?>admin_assets/js/chart.js"></script>



<script>
$(document).ready(function() {
    const ctx = document.getElementById("myChart").getContext("2d");

    const myChart = new Chart(ctx, {
        type: "bar",
        data: {
            labels: ["MTS", "MTO", "Total"],
            datasets: [{
                    label: "Total Pending",
                    data: [90, 68, 105],
                    backgroundColor: "#43cfcf",
                    barThickness: 90
                },
                {
                    label: "Total Plan QTY",
                    data: [78, 92, 170],
                    backgroundColor: "#7db1a1",
                    barThickness: 90
                },
                {
                    label: "Total Part Qty",
                    data: [40, 100, 165],
                    backgroundColor: "#ffdb93",
                    barThickness: 90
                },
                {
                    label: "Priority",
                    data: [80, 135, 55],
                    backgroundColor: "#ff9896",
                    barThickness: 90
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false, 
            plugins: {
                title: {
                    display: true,
                    text: "BPR Summary Report",
                    color: "#fff",
                    font: {
                        size: 20,
                        weight: "bold"
                    },
                },
                legend: {
                    position: "bottom",
                    labels: {
                        color: "#fff"
                    },
                },
            },
            scales: {
                x: {
                    stacked: true,
                    barPercentage: 0.5,
                    ticks: {
                        color: "#fff",
                        font: {
                            size: 14,
                            weight: "bold"
                        }
                    },
                    grid: {
                        color: "rgba(255,255,255,0.1)"
                    },
                },
                y: {
                    stacked: true,
                    beginAtZero: true,
                    ticks: {
                        color: "#fff",
                        font: {
                            size: 14,
                            weight: "bold"
                        }
                    },
                    grid: {
                        color: "rgba(255,255,255,0.2)"
                    },
                },
            },
        },
    });
});
</script>

<script src='https://cdn.jsdelivr.net/npm/fullcalendar/index.global.min.js'></script>

<script>
$(document).ready(function() {
    $('#dashboard_link .nav-link').addClass('nav_active');
    $('#dashboard_link .child_menu').addClass('show');
    // $('#report-list').addClass('active_cc');

});
</script>