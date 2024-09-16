<?php
include('../config/dbconnection.php'); // Adjust path as needed
include('../config/session_check.php'); // Adjust path as needed

$tblname = "adminlogin";
$tblkey = "id";
$pagename = "Admin Profile";
$page_name = basename($_SERVER['PHP_SELF']);

$username = $_SESSION['username'];
// Get images From db  Profile image 
$profile_img = getvalfield($conn, $tblname, "profile_picture", "username='$username'");
$admin_name = getvalfield($conn, $tblname, "admin_name", "username='$username'");
$email = getvalfield($conn, $tblname, "email", "username='$username'");
$mobile_no = getvalfield($conn, $tblname, "mobile_no", "username='$username'");

// Update And Save Button 
// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['Update'])) {
    $username = $_POST['username'];

    // File upload setup
    $target_dir = "Uploads/";
    $maxSize = 5000000; // 5MB
    $allowedTypes = ["jpg", "jpeg", "png"];
    $customFileName = "Profile-" . $username; // Custom file name

    $uploadOk = 0;
    $file_path = '';

    // Check if a file is uploaded
    if (isset($_FILES['profile_picture']) && !empty($_FILES['profile_picture']['name'])) {
        $file_extension = strtolower(pathinfo($_FILES['profile_picture']['name'], PATHINFO_EXTENSION));

        // Validate file type
        if (in_array($file_extension, $allowedTypes)) {
            // Validate file size
            if ($_FILES['profile_picture']['size'] <= $maxSize) {
                $target_file = $target_dir . $customFileName . '.' . $file_extension;
                $file_path = $customFileName . '.' . $file_extension;

                // Move uploaded file to the target directory
                if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $target_file)) {
                    $uploadOk = 1;
                } else {
                    echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            Swal.fire({
                                title: 'Error!',
                                text: 'File upload failed. Please try again.',
                                icon: 'error',
                                confirmButtonText: 'OK',
                                timer: 3000,
                                timerProgressBar: true
                            });
                        });
                    </script>";
                }
            } else {
                echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            title: 'Error!',
                            text: 'File size exceeds the limit of 5MB.',
                            icon: 'error',
                            confirmButtonText: 'OK',
                            timer: 3000,
                            timerProgressBar: true
                        });
                    });
                </script>";
            }
        } else {
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Invalid file type. Only JPG, JPEG, and PNG files are allowed.',
                        icon: 'error',
                        confirmButtonText: 'OK',
                        timer: 3000,
                        timerProgressBar: true
                    });
                });
            </script>";
        }
    } else {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Error!',
                    text: 'No file selected. Please choose a file to upload.',
                    icon: 'error',
                    confirmButtonText: 'OK',
                    timer: 3000,
                    timerProgressBar: true
                });
            });
        </script>";
    }

    // Check if upload was successful and update database
    if ($uploadOk == 1) {
        $update_query = "UPDATE adminlogin SET profile_picture = '$file_path' WHERE username = '$username'";
        
        if (mysqli_query($conn, $update_query)) {
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Profile updated successfully.',
                        icon: 'success',
                        confirmButtonText: 'Done',
                        timer: 3000,
                        timerProgressBar: true,
                        willClose: () => {
                            window.location.href = '{$page_name}';
                        }
                    });
                });
            </script>";
        } else {
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Failed to update profile: " . mysqli_error($conn) . "',
                        icon: 'error',
                        confirmButtonText: 'OK',
                        timer: 3000,
                        timerProgressBar: true
                    });
                });
            </script>";
        }
    }
}
//  Update Password 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['UpdatePassword'])) {
    // Get the form data
    $username = $_POST['username'];
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Fetch the current password from the database
    $query = "SELECT password FROM $tblname WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $hashed_password = $row['password'];

        // Verify if the old password is correct
        if (password_verify($old_password, $hashed_password)) {
            // Check if the new password and confirm password match
            if ($new_password === $confirm_password) {
                // Hash the new password
                $new_hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

                // Update the password in the database
                $update_query = "UPDATE $tblname SET password = '$new_hashed_password' WHERE username = '$username'";
                if (mysqli_query($conn, $update_query)) {
                    echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            Swal.fire({
                                title: 'Success!',
                                text: 'Password updated successfully.',
                                icon: 'success',
                                confirmButtonText: 'Done',
                                timer: 3000,
                                timerProgressBar: true,
                                willClose: () => {
                                    window.location.href = '{$_SERVER['PHP_SELF']}';
                                }
                            });
                        });
                    </script>";
                } else {
                    echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Failed to update password: " . mysqli_error($conn) . "',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        });
                    </script>";
                }
            } else {
                echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            title: 'Error!',
                            text: 'New password and confirm password do not match.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    });
                </script>";
            }
        } else {
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Old password is incorrect.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                });
            </script>";
        }
    } else {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Error!',
                    text: 'Username not found.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            });
        </script>";
    }
}

?>

<!-- Staring page -->
<?php include('../includes/header.php') ?>
<?php include('../includes/sidebar.php') ?>
<?php include('../includes/navbar.php') ?>

<!--  -->
<!-- Main Code For Logig -->

<style>
    input[type="file"]::file-selector-button {
        color: #00698f;
        /* change the text color to blue */
        background-color: transparent;
        /* change the background color to light gray */
        border: none;
    }
</style>
<form action="" method="POST" enctype="multipart/form-data">
    <div class="container-fluid px-4 pt-4">
        <h4 class="text-center fw-bolder text-primary mb-3"><?= $pagename; ?></h4>
        <hr class="text-danger p-2 rounded">
        <div class="row">
            <!--For ID-->
            <input type="hidden" name="username" id="username" value="<?= $username ?>">
            <!-- ID -->
            <div class="col-lg-6 col-md-12 col-sm-12 align-content-center">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="name" id="name" value="<?= $admin_name ?>" readonly>
                        <label for="name">Name Of Admin</label>
                    </div>

                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" maxlength="10" name="mobile_no" id="mobile_no" value="<?= $mobile_no ?>" readonly>
                        <label for="mobile_no">Mobile Number </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="email" name="email" value="<?= $email ?>" readonly>
                        <label for="email">Email </label>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3  input-group">
                        <input type="file" class="form-control bg-white" id="profile_picture" name="profile_picture" required>
                        <label for="profile_picture">Upload Profile Image <span class="text-danger">*</span></label>
                        <span class="input-group-text">
                            <a href="<?= $profile_img?>" target="_blank" class=" p-0"><i class="fas fa-eye fa-lg"></i></a>
                        </span>
                    </div>
                </div>
            </div>
            <!--  -->

            <div class="col-lg-12 text-center mb-3">
                <div class="form-group">
                    <button class="col-12 text-white btn  text-center shadow" id="Update" type="submit" style="background-color:#4ac387;" name="Update"><b><i class="fa-solid fa-user-pen"></i> Update & Save</b></button>
                </div>
            </div>
            <!--  -->
        </div>
    </div>
</form>

<!--======================== Password ================== -->
<form action="" method="POST" enctype="multipart/form-data">
    <div class="container-fluid px-4 pt-4">
        <h4 class="text-center fw-bolder text-primary mb-3">Change Password</h4>
        <hr class="text-danger p-2 rounded">
        <div class="row">
            <!--For ID-->
            <input type="hidden" name="username" id="username" value="<?= $username ?>">
            <!-- Old Password with Eye Icon without input-group -->
            <div class="col-lg-6 col-md-12 col-sm-12 align-content-center">
                <div class="form-group shadow position-relative">
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" placeholder="Old Password" name="old_password" id="old_password" required>
                        <label for="old_password">Old Password<span class="text-danger">*</span></label>
                        <!-- Eye Icon Positioned Absolutely -->
                        <i class="fas fa-eye position-absolute toggle-password" style="right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer;" data-target="old_password"></i>
                    </div>
                </div>
            </div>

            <!-- New Password with Eye Icon -->
            <div class="col-lg-6 col-md-12 col-sm-12 align-content-center">
                <div class="form-group shadow position-relative">
                    <div class="form-floating mb-3 ">
                        <input type="password" class="form-control" placeholder="New Password" name="new_password" id="new_password" required minlength="8">
                        <label for="new_password">New Password<span class="text-danger">*</span></label>
                        <i class="fas fa-eye position-absolute toggle-password" style="right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer;" data-target="new_password"></i>

                    </div>
                </div>
            </div>

            <!-- Confirm New Password with Eye Icon -->
            <div class="col-lg-12 col-md-12 col-sm-12 align-content-center">
                <div class="form-group shadow  position-relative">
                    <div class="form-floating mb-3 ">
                        <input type="password" class="form-control" placeholder=" " name="confirm_password" id="confirm_password" required minlength="8">
                        <label for="confirm_password">Confirm New Password<span class="text-danger">*</span></label>
                        <i class="fas fa-eye position-absolute toggle-password" style="right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer;" data-target="confirm_password"></i>

                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="col-lg-12 text-center mb-3">
                <div class="form-group">
                    <button class="col-12 text-white btn text-center shadow" id="UpdatePassword" type="submit" style="background-color:#4ac387;" name="UpdatePassword"><b>Update Password</b></button>
                </div>
            </div>

        </div>
    </div>
</form>

<!-- JavaScript to toggle password visibility -->
<script>
    document.querySelectorAll('.toggle-password').forEach(function(element) {
        element.addEventListener('click', function() {
            const target = document.getElementById(this.getAttribute('data-target'));
            if (target.type === 'password') {
                target.type = 'text';
                this.classList.remove('fa-eye');
                this.classList.add('fa-eye-slash');
            } else {
                target.type = 'password';
                this.classList.remove('fa-eye-slash');
                this.classList.add('fa-eye');
            }
        });
    });
</script>






<?php include('../includes/footer.php'); ?>