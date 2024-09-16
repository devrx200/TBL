<?php
// print_r($conn);
$username = $_SESSION['username'];

$profile_picture = getvalfield($conn, "adminlogin", "profile_picture", "username='$username'");
?>

<!-- Sidebar Start -->
<div class="sidebar pe-4 pb-3 bg-warning">
    <nav class="navbar">
        <a href="../dash" class="navbar-brand mx-4 mb-3">
            <h3 class="text-black fw-bold text-center"></h3>
        </a>
        <div class="d-flex align-items-center ms-2 mb-4" style="height: 50px;width: 185px;justify-content: center;">
            <div class="ms-0 d-flex">
                <img class="rounded me-lg-2" src="../dash/uploads/<?= $profile_picture ?>" alt="" style="width: 40px; height: 40px;">
                <h5 class="mb-0 text-success mt-2">Admin <sup class="text-success fw-bolder">*</sup></h5>
            </div>
        </div>
        <div class="navbar-nav w-100">
            <a href="../dash/" class="nav-item nav-link <?= ($page_name == 'index.php') ? 'active' : ''; ?>"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
            <a href="../dash/gallery.php" class="nav-item nav-link mt-2 <?= ($page_name == 'gallery.php') ? 'active' : ''; ?>"><i class="fas fa-image me-2"></i>Gallery-Page</a>
            <a href="../dash/about.php" class="nav-item nav-link mt-2 <?= ($page_name == 'about.php') ? 'active' : ''; ?>"><i class="fa-regular fa-address-card me-2"></i>About-Page</a>
            <a href="../dash/service.php" class="nav-item nav-link mt-2 <?= ($page_name == 'service.php') ? 'active' : ''; ?>"><i class="fas fa-tools me-2"></i>Service-Page</a>
            <a href="../dash/slider.php" class="nav-item nav-link mt-2 <?= ($page_name == 'slider.php') ? 'active' : ''; ?>"><i class="fas fa-sliders-h me-2"></i>Slider-Page</a>
            <a href="../dash/contact-info.php" class="nav-item nav-link mt-2 <?= ($page_name == 'contact-info.php') ? 'active' : ''; ?>"><i class="fa-regular fa-address-book me-2"></i>Contact-Page</a>
            <a href="../dash/logo-icon.php" class="nav-item nav-link mt-2 <?= ($page_name == 'logo-icon.php') ? 'active' : ''; ?>"><i class="fa-solid fa-draw-polygon me-2"></i>Logos & Icons</a>

            <!-- Social Media Icons Links Update  -->
            <a href="../dash/social-media.php" class="nav-item nav-link mt-2 <?= ($page_name == 'social-media.php') ? 'active' : ''; ?>"><i class="fa-solid fa-globe me-2"></i>Social Media Link</a>
            <!-- Messages -->
            <a href="../dash/inbox.php" class="nav-item nav-link mt-2 <?= ($page_name == 'inbox.php') ? 'active' : ''; ?>"><i class="fa-solid fa-envelope-open-text me-2"></i>Inbox</a>
            
            <!-- सेटिंग्स -->
            <div class="nav-item dropdown mt-2">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fas fa-cog me-2"></i>Settings</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="../dash/profile.php" class="dropdown-item"><i class="fa-solid fa-user-tie me-2"></i> Admin Profile</a>
                </div>
            </div>

            <!-- हेल्प -->
            <a href="../dash/help.php" class="nav-item nav-link mt-2 <?= ($page_name == 'help.php') ? 'active' : ''; ?>"><i class="fa-regular fa-circle-question me-2"></i>Help?..</a>


        </div>
    </nav>
</div>
<!-- Sidebar End -->