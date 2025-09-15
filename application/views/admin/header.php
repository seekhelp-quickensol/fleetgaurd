<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard</title>



    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">



    <link href="<?= base_url() ?>admin_assets/css/flatpickr.min.css" rel="stylesheet">

    <link href="<?= base_url() ?>admin_assets/css/select2.min.css" rel="stylesheet">

    <link rel="stylesheet" href="<?= base_url() ?>admin_assets/css/bootstrap.min.css">

    <link rel="stylesheet" href="<?= base_url() ?>admin_assets/css/style.css">
    <link rel="stylesheet" href="<?= base_url() ?>admin_assets/css/theme.css">

    <link rel="stylesheet" href="<?= base_url() ?>admin_assets/css/tabulator.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>admin_assets/css/dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

</head>



<!-- <style>
.dropdown-arrow {
    display: inline-block;
    transition: transform 0.3s ease;
}



.sidebar-dropdown {

    display: none;

    flex-direction: column;

    background-color: #d1ecef47;



    border-radius: 4px;

    margin: 5px 12px;

}



.dropdown-link {

    display: block;

    padding: 8px;

    color: black;

    text-decoration: none;

    font-size: 13px;

}

.act {
    padding: 0.5rem 1rem;
}

.dropdown-arrow {
    font-size: 11px;
    color: gray;
}


.dropdown-arrow {

    margin-left: auto;

    /* transform: rotate(-90deg); */



}

.dropdown-arrow {
    transform: rotate(0);
}

.dropdown-arrow.rotate {
    transform: rotate(0);
}


/* .rotate {

    transform: rotate(0);

} */



.act .active {

    border-radius: 4px;

    background-color: #d1ecef !important;

}
</style> -->


<style>
.navbar-nav .dropdown-menu {
    inset: unset !important;

    transform: unset !important;
    position: static !important;
}
</style>

<body>

    <div class="loader_div" id="loader_div">

        <span class="loader"></span>

    </div>

    <!-- Navbar -->

    <nav class="navbar sticky-top">

        <div class="container-fluid">

            <div class="d-flex align-items-center">

                <span class="nav-logo me-2 d-flex align-items-center">
                    <img src="<?= base_url() ?>admin_assets/images/logo.png" alt="Fleetgaurd Logo"
                        style=" width: auto; margin-right: 6px;">
                    <!-- Fleetgaurd <span class="fw-normal"> CRM</span> -->
                </span>


                </button>

            </div>



            <div class="dropdown dekstop">

                <div class="d-flex align-items-center" data-bs-toggle="dropdown" style="cursor: pointer;">

                    <div class="ms-2 d-flex align-items-center justify-content-center rounded-circle text-white"
                        style="width: 32px; height: 32px;    background-color: rgb(238 46 36) !important;">


                        <i class="fa-solid fa-right-from-bracket"></i>

                    </div>

                </div>



                <ul class="dropdown-menu dropdown-menu-end">

                    <li><a class="dropdown-item text-danger" href="<?= base_url() ?>logout"
                            onclick="return confirm('Are you sure you want to sign out?');"><i
                                class="fa fa-sign-out-alt me-2"></i> Logout</a></li>

                </ul>

            </div>
            <div class="dropdown mobile toggle-s">
                <button class="menu-btn">&#9776;</button>
            </div>


          

        </div>

    </nav>



    <div class="d-flex main-nav">

        <!-- Sidebar -->

        <div class="sidebar navbar-vertical ">

            <span class="toggle-sidebar dekstop">

                <i class="fa-solid fa-chevron-left"></i>

            </span>

            <div class=" navbar-collapse w-auto ps sidebar-menu" id="sidenav-collapse-main">
                <ul class="navbar-nav">



                    <li class="nav-item" id="dashboard_link">
                        <a class="nav-link" href="<?= base_url() ?>">
                            <div
                                class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="fa-solid fa-house"></i>
                            </div>
                            <span class="nav-link-text ms-1">Dashboard</span>
                        </a>
                    </li>


                    <li class="nav-item dropdown" id="master">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <div
                                class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="fa-solid fa-database"></i>
                            </div>
                            <span class="nav-link-text ms-1">Master</span>
                        </a>
                        <ul class="dropdown-menu child_menu">
                            <h6 class="sub_header">Master</h6>

                            <li>
                                <a class="dropdown-item" id="add-user" href="<?= base_url() ?>add-user">
                                    <i class="fa-solid fa-user"></i> User Master
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item" id="line" href="<?= base_url() ?>add-line-master">
                                    <i class="fa-solid fa-diagram-project"></i> Line Master
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item" id="supplier" href="<?= base_url() ?>supplier">
                                    <i class="fa-solid fa-truck-field"></i> Supplier Management
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item" id="site" href="<?= base_url() ?>site">
                                    <i class="fa-solid fa-location-dot"></i> Site Master
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item" id="type_good" href="<?= base_url() ?>type-of-good">
                                    <i class="fa-solid fa-boxes-stacked"></i> Type Of Good Master
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item" id="designation"
                                    href="<?= base_url() ?>designation-management">
                                    <i class="fa-solid fa-id-badge"></i> Designation Management
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item" id="department" href="<?= base_url() ?>deparment-management">
                                    <i class="fa-solid fa-building-user"></i> Department Management
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item" id="plant" href="<?= base_url() ?>add-plant">
                                    <i class="fa-solid fa-industry"></i> Plant Master
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item" id="Workshop" href="<?= base_url() ?>add-workshop">
                                    <i class="fa-solid fa-screwdriver-wrench"></i> Workshop Master
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item" id="type_master" href="<?= base_url() ?>add-type-item">
                                    <i class="fa-solid fa-shapes"></i> Item Type Master
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item" id="uom" href="<?= base_url() ?>add-udm">
                                    <i class="fa-solid fa-ruler-combined"></i> UOM Master
                                </a>
                            </li>

                            <!-- Example if you re-enable Customer Type -->
                            <!--
    <li>
        <a class="dropdown-item" id="customer_type_master" href="<?= base_url() ?>add-customer-types">
            <i class="fa-solid fa-users"></i> Customer Type Master
        </a>
    </li>
    -->
                        </ul>

                    </li>

                    <li class="nav-item dropdown" id="bom-master">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <div
                                class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="fa-solid fa-boxes-stacked"></i>
                            </div>
                            <span class="nav-link-text ms-1"> BOM Master </span>
                        </a>
                        <ul class="dropdown-menu child_menu">
                            <h6 class="sub_header"> BOM Master </h6>


                            <li><a class="dropdown-item" id="add-bom" href="<?= base_url() ?>add-bom"> <i
                                        class="fa-solid fa-plus-square"></i>Add BOM </a></li>
                            <li><a class="dropdown-item" id="upload-bom" href="<?= base_url() ?>upload-bom"> <i
                                        class="fa-solid fa-plus-square"></i>BOM Uploade</a></li>
                            <li><a class="dropdown-item" id="bom_list" href="<?= base_url() ?>bom-list"> <i
                                        class="fa-solid fa-list"></i>BOM List</a></li>
                            <li><a class="dropdown-item" id="bom_history" href="<?= base_url() ?>bom-upload-history"> <i
                                        class="fa-solid fa-list"></i>BOM
                                    Upload History</a></li>


                            <li><a class="dropdown-item" id="add_part_master" href="<?= base_url() ?>add-part-master">
                                    <i class="fa-solid fa-plus-square"></i>Part Master</a></li>


                            <li><a class="dropdown-item" id="add_items" href="<?= base_url() ?>add-item"> <i
                                        class="fa-solid fa-plus-square"></i>Item Master</a></li>


                        </ul>


                    </li>





                    <li class="nav-item dropdown" id="report-management">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <div
                                class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="fa-solid fa-chart-column"></i>
                            </div>
                            <span class="nav-link-text ms-1">Shortage Report </span>
                        </a>
                        <ul class="dropdown-menu child_menu">
                            <h6 class="sub_header">Shortage Report </h6>

                            <li><a class="dropdown-item" id="create-report" href="<?= base_url() ?>create-report"> <i
                                        class="fa-solid fa-plus-square"></i>Uploade File</a></li>


                            <li><a class="dropdown-item" id="report-list" href="<?= base_url() ?>report-list"> <i
                                        class="fa-solid fa-list"></i>Report List</a></li>

                        </ul>


                    </li>



                    <?php 
                    $all_shift = $this->Admin_model->get_all_shifts();
                ?>

                    <li class="nav-item dropdown" id="work-management">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <div
                                class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="fa-solid fa-file-contract"></i>
                            </div>
                            <span class="nav-link-text ms-1"> Work Order</span>
                        </a>
                        <ul class="dropdown-menu child_menu">
                            <h6 class="sub_header"> Work Order</h6>
                            <?php foreach($all_shift as $shift){ ?>
                            <li><a class="dropdown-item"
                                    href="<?= base_url() ?>bpr-work-order?filter_shift=<?=$shift->id ?>"
                                    id="shift-list-<?=$shift->id ?>"> <i
                                        class="fa-solid fa-plus-square"></i><?=$shift->name ;?></a>
                            </li>

                            <?php } ?>





                        </ul>


                    </li>


                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url() ?>logout"
                            onclick="return confirm('Are you sure you want to sign out?');">
                            <div
                                class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="fa-solid fa-right-to-bracket"></i>
                            </div>
                            <span class="nav-link-text ms-1">Sign Out</span>
                        </a>
                    </li>

                </ul>

            </div>

        </div>