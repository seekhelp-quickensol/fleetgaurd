<?php include('header.php');?>
<style>
.dropdown-toggle-master::after {

    transform: rotate(0deg) !important;
}


.dropdown-toggle-master:not(.show)::after {
    transform: rotate(270deg) !important;

}


#main-table {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;

}

.centered-gif {

    height: auto;
    width: 250px;
}

.annimated-gif {

    margin: 130px auto;

}
</style>
<div class="main-content">
    <div class="sub-content">
        <div class="page-header">
            <h1 class="page-title">
                Master

            </h1>
            <!-- <button class="btn btn-outline-secondary">
                <i class="bi bi-arrow-repeat"></i> Refresh
            </button> -->
        </div>

        <?php include('tabs.php'); ?>



        <!-- tab content  -->
        <div class="tab-content mt-3" id="myTabContent">
            <div class="tab-pane fade show active fade-in" id="main-table" role="tabpanel">
                <div class="annimated-gif">
                    <img src="<?=base_url()?>admin_assets/images/animate.gif" alt="Loading..." class="centered-gif">
                </div>
            </div>
        </div>


    </div>
</div>
<?php include('footer.php');?>
<script>
$(document).ready(function() {
    $('#master').addClass('active');
});
</script>