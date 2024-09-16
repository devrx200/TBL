<?php
include('../config/dbconnection.php'); // Adjust path as needed
include('../config/session_check.php'); // Adjust path as needed

$tblname = "social_links";
$tblkey = "id";
$pagename = "Admin Profile";
$page_name = basename($_SERVER['PHP_SELF']);

$username = $_SESSION['username'];

$youtube   ="";
$facebook  ="";
$twitter   ="";
$instagram ="";
// $password = getvalfield($conn, $tblname, "password", "username='$username'");
// $profile_picture = getvalfield($conn, $tblname, "profile_picture", "username='$username'");


// Update And Save Button 
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['Update'])) {
    // print_r($_POST);die;
    $youtube = $_POST['youtube'];
    $facebook = $_POST['facebook'];
    $twitter = $_POST['twitter'];
    $instagram = $_POST['instagram'];

    // Update query
    $update_query = "UPDATE $tblname SET 
    youtube = '$youtube', 
    facebook = '$facebook', 
    twitter = '$twitter', 
    instagram = '$instagram'
    WHERE 1";

// echo $update_query;die;
    if (mysqli_query($conn, $update_query)) {
        // $msg = "<div class='msg-container'><b class='alert alert-warning msg'>Update Successfully</b></div>";
        echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Success!',
                text: 'Links Update Successfully.',
                icon: 'success',
                confirmButtonText: 'Done',
                timer: 3000, // 3000 milliseconds = 3 seconds
                timerProgressBar: true,
                allowOutsideClick: false, 
                customClass: { confirmButton: 'custom-confirm-button' },
                willClose: () => {
                    // Redirect to a specific URL after the alert is closed
                    window.location.href = '{$page_name}';
                }
            });
        });
                </script>";
    } else {
        // $msg = "<div class='msg-container'><b class='alert alert-danger msg'>Update Unsuccessfully</b></div>";
        echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Oops!',
                text: 'Links Update Unsuccessfully.',
                icon: 'error',
                confirmButtonText: 'Okay',
                timer: 3000, // 3000 milliseconds = 3 seconds
                timerProgressBar: true,
                backdrop: true,
                allowOutsideClick: false, 
                customClass: { confirmButton: 'custom-confirm-button' },
                willClose: () => {
                    // Redirect to a specific URL after the alert is closed
                    window.location.href = '{$page_name}';
                }
            });
        });
            </script>";
    }
}else{
    $fetch = mysqli_fetch_array(mysqli_query($conn,"select * from $tblname WHERE 1"));
    $youtube   = $fetch['youtube'];
    $facebook  = $fetch['facebook'];
    $twitter   = $fetch['twitter'];
    $instagram = $fetch['instagram'];  
}

?>
<style>
    input{
        padding-right: 33px !important;
    }
</style>
<!-- Staring page -->
<?php include('../includes/header.php') ?>
<?php include('../includes/sidebar.php') ?>
<?php include('../includes/navbar.php') ?>

<form action="" method="POST" enctype="multipart/form-data">
    <div class="container-fluid px-4 pt-4">
        <h4 class="text-center fw-bolder text-primary mb-3">Update Social Media Links For Follow Us </h4>
        <hr class="text-danger p-2 rounded">
        <div class="row">
            <!-- For ID -->
            <input type="hidden" name="id" id="id" value="<?= $id ?>">

            <!-- Social Media URLs -->
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="form-group shadow position-relative">
                    <div class="form-floating mb-3">
                        <input type="url" class="form-control " placeholder="YouTube URL" name="youtube" id="youtube" value="<?= $youtube ?>">
                        <label for="youtube">YouTube URL<span class="text-danger">*</span></label>
                        <i class="fab fa-youtube position-absolute" style="right: 10px; top: 50%; transform: translateY(-50%);"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="form-group shadow position-relative">
                    <div class="form-floating mb-3">
                        <input type="url" class="form-control " placeholder="Facebook URL" name="facebook" id="facebook" value="<?= $facebook ?>">
                        <label for="facebook">Facebook URL<span class="text-danger">*</span></label>
                        <i class="fab fa-facebook position-absolute" style="right: 10px; top: 50%; transform: translateY(-50%);"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="form-group shadow position-relative">
                    <div class="form-floating mb-3">
                        <input type="url" class="form-control" placeholder="Twitter URL" name="twitter" id="twitter" value="<?= $twitter ?>">
                        <label for="twitter">Twitter URL<span class="text-danger">*</span></label>
                        <i class="fab fa-twitter position-absolute" style="right: 10px; top: 50%; transform: translateY(-50%);"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="form-group shadow position-relative">
                    <div class="form-floating mb-3">
                        <input type="url" class="form-control" placeholder="Instagram URL" name="instagram" id="instagram" value="<?= $instagram ?>">
                        <label for="instagram">Instagram URL<span class="text-danger">*</span></label>
                        <i class="fab fa-instagram position-absolute" style="right: 10px; top: 50%; transform: translateY(-50%);"></i>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="col-lg-12 text-center mb-3">
                <div class="form-group">
                    <button class="col-12 text-white btn text-center shadow" id="Update" type="submit" style="background-color:#4ac387;" name="Update"><b>Update & Links</b></button>
                </div>
            </div>
        </div>
    </div>
</form>



<?php include('../includes/footer.php'); ?>