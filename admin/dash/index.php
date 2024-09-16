<?php include('../config/dbconnection.php') ?>
<?php include('../config/session_check.php') ?>
<?php 
$pagename = "Dashboard";
$page_name = basename($_SERVER['PHP_SELF']); 
?>
<?php include('../includes/header.php') ?>
<?php include('../includes/sidebar.php') ?>
<?php include('../includes/navbar.php') ?>
<?php

// आवेदन 
// $prapth_aavedan1 = getvalfield($conn, 'aavedan', 'count(*)', 'status=0');
// $sveekrt_aavedan1 = getvalfield($conn, 'aavedan', 'count(*)', 'status=1');
// $punh_aavedan1 = getvalfield($conn, 'aavedan', 'count(*)', 'status=2');
// $purn_aavedan1 = getvalfield($conn, 'aavedan', 'count(*)', 'status=3');
// $asveekrt_aavedan1 = getvalfield($conn, 'aavedan', 'count(*)', 'status=4');

?>

<!-- <div class="row"> -->


<!-- 1 -->
<!-- आवेदन  -->
<div class="container-fluid pt-4 px-4 ">
    <div class="row g-4">
        <h3 class="mb-0 text-center fw-bold text-primary">Details</h3>
        <hr class=" p-1 text-primary">
        <div class="col-sm-6 col-xl-4">
            <a href="gallery.php">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4 border border-primary">
                    <i class="fas fa-image fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Gallery</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-sm-6 col-xl-4">
            <a href="slider.php">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4 border border-primary">
                    <i class="fas fa-sliders-h fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Slider</p>
                        <h6 class="mb-0"><?php //$prapth_aavedan1 ?></h6>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-sm-6 col-xl-4">
            <a href="service.php">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4 border border-primary">
                    <i class="fas fa-tools fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Service</p>
                        <h6 class="mb-0"><?php //$sveekrt_aavedan1 ?></h6>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

<?php include('../includes/footer.php'); ?>