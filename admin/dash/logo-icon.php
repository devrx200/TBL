<?php
include('../config/dbconnection.php'); // Adjust path as needed
include('../config/session_check.php'); // Adjust path as needed

$tblname = "logo_icon";
$tblkey = "id";
$pagename = "Logos & Icons";
$page_name = basename($_SERVER['PHP_SELF']);



if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {

    $existing_header_logo = "";
    $existing_footer_logo = "";
    $type = $_POST['type'];
    
    // Handle existing paths
    if(isset($_POST['existing_header_logo'])) {
        $existing_header_logo = $_POST['existing_header_logo'];
    }

    if(isset($_POST['existing_footer_logo'])) {
        $existing_footer_logo = $_POST['existing_footer_logo'];
    }

    // Determine the type of logo (header or footer)
    if ($type == 'header_logo') {
        $message = "Header Logo";
    } else if ($type == 'footer_logo') {
        $message = "Footer Logo";
    }

    $target_dir = "images/logo-icon/";
    $maxSize = 5000000; // 5 MB
    $allowedTypes = ["jpg", "png", "jpeg"];
    
    // Initialize variables for file uploads
    $header_logo = ['success' => false, 'filePath' => ''];
    $footer_logo = ['success' => false, 'filePath' => ''];

    // Handle file upload for header logo
    if ($type == 'header_logo' && isset($_FILES['header_logo']) && !empty($_FILES['header_logo']['name'])) {
        $header_logo = handleFileUpload('header_logo', $target_dir, $maxSize, $allowedTypes);
    }

    // Handle file upload for footer logo
    if ($type == 'footer_logo' && isset($_FILES['footer_logo']) && !empty($_FILES['footer_logo']['name'])) {
        $footer_logo = handleFileUpload('footer_logo', $target_dir, $maxSize, $allowedTypes);
    }

    // Decide which paths to use (existing or new uploads)
    $header_path = (!empty($header_logo['filePath'])) ? $header_logo['filePath'] : $existing_header_logo;
    $footer_path = (!empty($footer_logo['filePath'])) ? $footer_logo['filePath'] : $existing_footer_logo;

    // Check if either logo was successfully uploaded or existing paths are being used
    if (!empty($header_path) || !empty($footer_path)) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
    }

    // If file upload is successful, update the database
    if ($uploadOk == 1) {
        if ($type == 'header_logo') {
            $sql = "UPDATE $tblname SET header_location = '$header_path'";
        } else if ($type == 'footer_logo') {
            $sql = "UPDATE $tblname SET footer_location = '$footer_path'";
        }

        // Execute the SQL query
        if (mysqli_query($conn, $sql)) {
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Success!',
                        text: '$message Added Successfully.',
                        icon: 'success',
                        confirmButtonText: 'Done',
                        timer: 3000,
                        timerProgressBar: true,
                        allowOutsideClick: false, 
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
                        title: 'Oops!',
                        text: '$message Added Unsuccessfully.',
                        icon: 'error',
                        confirmButtonText: 'Okay',
                        timer: 3000,
                        timerProgressBar: true,
                        allowOutsideClick: false,
                        willClose: () => {
                            window.location.href = '{$page_name}';
                        }
                    });
                });
            </script>";
        }
    } else {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Oops!',
                    text: 'Sorry, your file was not uploaded.',
                    icon: 'error',
                    confirmButtonText: 'Okay',
                    timer: 3000,
                    timerProgressBar: true,
                    allowOutsideClick: false,
                    willClose: () => {
                        window.location.href = '{$page_name}';
                    }
                });
            });
        </script>";
    }
}


$fetch = mysqli_fetch_array(mysqli_query($conn, "select * from $tblname where 1"));
$header_location = $fetch['header_location'];
$footer_location = $fetch['footer_location'];


?>

<!-- Starting page -->
<?php include('../includes/header.php') ?>
<?php include('../includes/sidebar.php') ?>
<?php include('../includes/navbar.php') ?>


<!-- Page content -->
<div class="container-fluid px-4 pt-4">

    <h4 class="text-center fw-bolder text-primary mb-3">Update Logo And Icons</h4>
    <hr class="text-danger p-2 rounded">


    <div class="card mb-3">
        <div class="card-header fw-bolder bg-primary text-white border">Update Header Logo &amp; Footer Logo Details</div>
        <div class="card-body row">
            <!-- 1 Header Logo -->
            <div class="col-lg-6">
                <form id="headerLogoForm" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="type" value="header_logo">
                    <input type="hidden" name="existing_header_logo" value="<?= $header_location ?>">
                    <label class="fw-bolder d-flex justify-content-center" for="headerlogo">
                        <h4 class="m-0 p-0 text-warning">Header Logo Image</h4>
                    </label>
                    <hr>
                    <!-- Preview of the Header Logo -->
                    <div class="form-group  headerlogo d-flex justify-content-center">
                        <img id="headerLogoPreview" class="logo-shadow rounded border border-dark shadow" src="<?= $header_location ?>" style="width: 250px; height: 250px;">
                    </div>
                    <!-- File Input for Header Logo -->
                    <div class="form-group d-flex mt-3 mb-3">
                        <input class="form-control bg-white" type="file" name="header_logo" id="headerLogoInput" accept="image/*" required>
                        <!-- Update Button -->
                        <button type="submit" class="ms-2 btn btn-success" name="submit"><i class="bi bi-file-earmark-arrow-up-fill"></i></button>
                        <!-- Delete Button -->
                        <button type="button" class="ms-2 btn btn-danger" id="deleteHeaderLogo"><i class="bi bi-trash"></i></button>
                    </div>
                </form>
            </div>

            <!-- 2 Footer Logo -->
            <div class="col-lg-6">
                <form id="footerLogoForm" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="type" value="footer_logo">
                    <input type="hidden" name="existing_footer_logo" value="<?= $footer_location ?>">
                    <label class="fw-bolder d-flex justify-content-center" for="footerlogo">
                        <h4 class="m-0 p-0 text-warning">Footer Logo Image</h4>
                    </label>
                    <hr>
                    <!-- Preview of the Footer Logo -->
                    <div class="form-group  footerlogo d-flex justify-content-center">
                        <img id="footerLogoPreview" class="logo-shadow rounded border border-dark shadow" src="<?= $footer_location ?>" style="width: 250px; height: 250px;">
                    </div>
                    <!-- File Input for Footer Logo -->
                    <div class="form-group d-flex mt-3 mb-3">
                        <input class="form-control bg-white" type="file" name="footer_logo" id="footerLogoInput" accept="image/*" required>
                        <!-- Update Button -->
                        <button type="submit" class="ms-2 btn btn-success" name="submit"><i class="bi bi-file-earmark-arrow-up-fill"></i></button>
                        <!-- Delete Button -->
                        <button type="button" class="ms-2 btn btn-danger" id="deleteFooterLogo"><i class="bi bi-trash"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Preview Header Logo
        const headerLogoInput = document.getElementById('headerLogoInput');
        const headerLogoPreview = document.getElementById('headerLogoPreview');

        headerLogoInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    headerLogoPreview.src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });

        // Preview Footer Logo
        const footerLogoInput = document.getElementById('footerLogoInput');
        const footerLogoPreview = document.getElementById('footerLogoPreview');

        footerLogoInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    footerLogoPreview.src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });

        // Clear Header Logo Preview on Delete
        document.getElementById('deleteHeaderLogo').addEventListener('click', function() {
            headerLogoPreview.src = 'default_header_logo.jpg'; // Replace with default image path
            headerLogoInput.value = ''; // Clear the file input
        });

        // Clear Footer Logo Preview on Delete
        document.getElementById('deleteFooterLogo').addEventListener('click', function() {
            footerLogoPreview.src = 'default_footer_logo.jpg'; // Replace with default image path
            footerLogoInput.value = ''; // Clear the file input
        });
    </script>




</div>

<?php include('../includes/footer.php'); ?>