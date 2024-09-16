<?php
include('../config/dbconnection.php'); // Adjust path as needed
include('../config/session_check.php'); // Adjust path as needed

$tblname = 'help_requests';
$pagename = "Help Page";
$username = $_SESSION['username'];
$page_name = basename($_SERVER['PHP_SELF']);
// Get images From db  Profile image 
// $profile_img = getvalfield($conn, $tblname, "profile_picture", "username='$username'");
$admin_name = getvalfield($conn, 'adminlogin', "admin_name", "username='$username'");
$email = getvalfield($conn, 'adminlogin', "email", "username='$username'");
$mobile_no = getvalfield($conn, 'adminlogin', "mobile_no", "username='$username'");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['SendHelpRequest'])) {
    $name = $_POST['name'];
    $help_email = $_POST['help_email'];
    $website_name = $_POST['website_name'];
    $website_url = $_POST['website_url'];
    $description = $_POST['description'];
    $error_page_url = $_POST['error_page_url'];

    // Prepare email body
    $toEmail = $help_email; // Replace with the email where you want to receive help requests
    $toName = "sarthi ride";
    $subject = "Help Request from Website";
    $body = "
        <h3>Help Request Details</h3>
        <p><strong>Name:</strong> $name</p>
        <p><strong>Email:</strong> $help_email</p>
        <p><strong>Website Name:</strong> $website_name</p>
        <p><strong>Website URL:</strong> $website_url</p>
        <p><strong>Error Page URL:</strong> $error_page_url</p>
        <p><strong>Description:</strong> $description</p>";


    $uploadOk = "";
    $target_dir = "Uploads/";
    $maxSize = 5000000; // 5 MB
    $allowedTypes = ["jpg", "png", "jpeg"];
    $customFileName = $target_dir;
    // Initialize variables
    $file_upload = ['success' => false, 'filePath' => ''];

    // Call the function for each file upload if the file is set
    if (isset($_FILES['screenshot']) && !empty($_FILES['screenshot']['name']))
        $file_upload = handleFileUpload('screenshot', $target_dir, $maxSize, $allowedTypes);

    if (!empty($file_upload['success'])) {
        $uploadOk = 1;
        $imagePath = $file_upload['filePath'];
    } else {
        $uploadOk = 0;
    }

    if ($uploadOk == 1) {
        // Send email
        if (sendEmail($toEmail, $toName, $subject, $body, $imagePath, $altBody = '')) {
            $sql = mysqli_query($conn, "INSERT INTO `help_requests`(`help_name`, `help_email`, `help_mobile`, `website_url`, `error_page_url`, `screenshot_path`, `description`) VALUES ('$admin_name','$email','$mobile_no','$website_url','$error_page_url','$imagePath','$description')");

            echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Success!',
                    text: 'Help request sent successfully.',
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
            // $msg = "<div class='msg-container'><b class='alert alert-success msg'>Help request sent successfully</b></div>";
        } else {
            // $msg = "<div class='msg-container'><b class='alert alert-danger msg'>Failed to send help request</b></div>";
            echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Oops!',
                    text: 'Failed to send help request.',
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
    } else {
        echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Oops!',
                text: 'Sorry, your file was not uploaded.',
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
}
?>

<!-- Starting page -->
<?php include('../includes/header.php') ?>
<?php include('../includes/sidebar.php') ?>
<?php include('../includes/navbar.php') ?>

<style>
    input[type="file"]::file-selector-button {
        color: #00698f;
        /* change the text color to blue */
        background-color: white;
        /* change the background color to light gray */
        border: none;
    }

    .image-cell {
        width: 150px;
        /* Adjust width as needed */
        height: 100px;
        /* Adjust height as needed */
        overflow: hidden;
        /* Hide overflow if the image is larger */
        text-align: center;
        /* Center the image horizontally */
        vertical-align: middle;
        /* Center the image vertically */
    }

    .image-cell img {
        max-width: 100%;
        max-height: 100%;
        object-fit: cover;
        /* This will crop the image if it exceeds the size of the td */
    }

    .action {
        width: auto;
        /* Adjust width as needed */
        height: 100px;
    }
</style>
<!-- css -->

<div class="container-fluid px-4 pt-4">
    <form action="" method="POST" enctype="multipart/form-data">
        <h4 class="text-center fw-bolder text-primary mb-3">Help Request Form</h4>
        <hr class="text-danger p-2 rounded">
        <div class="row">

            <!-- Name Field -->
            <div class="col-lg-4 col-md-12 col-sm-12">
                <div class="form-group shadow position-relative">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" placeholder="Your Name" name="name" id="name" required value="<?= $admin_name ?>" readonly>
                        <label for="name">Name<span class="text-danger">*</span></label>
                    </div>
                </div>
            </div>

            <!-- Help Email Field -->
            <div class="col-lg-4 col-md-12 col-sm-12">
                <div class="form-group shadow position-relative">
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" placeholder="Your Email" name="help_email" id="help_email" required value="<?= $email ?>" readonly>
                        <label for="help_email">Email<span class="text-danger">*</span></label>
                    </div>
                </div>
            </div>

            <!-- Mobile Number Field -->
            <div class="col-lg-4 col-md-12 col-sm-12">
                <div class="form-group shadow position-relative">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" placeholder="Your Mobile Number" name="help_mobile" id="help_mobile" required
                            pattern="[6-9]{1}[0-9]{9}" title="Please enter a valid 10-digit Indian mobile number starting with 6, 7, 8, or 9." value="<?= $mobile_no ?>" readonly>
                        <label for="help_mobile">Mobile Number<span class="text-danger">*</span></label>
                    </div>
                </div>
            </div>

            <!-- Website Name Field -->
            <div class="col-lg-4 col-md-12 col-sm-12">
                <div class="form-group shadow position-relative">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" placeholder="Your Name" name="website_name" id="website_name" required>
                        <label for="website_name">Website Name<span class="text-danger">*</span></label>
                    </div>
                </div>
            </div>

            <!-- Website URL Field -->
            <div class="col-lg-4 col-md-12 col-sm-12">
                <div class="form-group shadow position-relative">
                    <div class="form-floating mb-3">
                        <input type="url" class="form-control" placeholder="Website URL" name="website_url" id="website_url" required>
                        <label for="website_url">Website URL<span class="text-danger">*</span></label>
                    </div>
                </div>
            </div>

            <!-- Error Page URL Field -->
            <div class="col-lg-4 col-md-12 col-sm-12">
                <div class="form-group shadow position-relative">
                    <div class="form-floating mb-3">
                        <input type="url" class="form-control" placeholder="Error Page URL" name="error_page_url" id="error_page_url" required>
                        <label for="error_page_url">Error Page URL<span class="text-danger">*</span></label>
                    </div>
                </div>
            </div>

            <!-- Screenshot Upload with Preview -->
            <div class="col-lg-12 col-md-12 col-sm-12">
                <!-- Image Preview -->
                <div class="mt-2" id="screenshot-preview-container" style="display:none;">
                    <div class=" d-flex justify-content-center m-2 ">
                        <img id="screenshot-preview" src="#" alt="Screenshot Preview" class="img-thumbnail" style="max-height: 200px;">
                    </div>
                </div>
                <div class="form-group shadow position-relative">
                    <div class="form-floating mb-3">
                        <input type="file" class="form-control bg-white" name="screenshot" id="screenshot" accept="image/*" onchange="previewScreenshot(event)" required>
                        <label for="screenshot">Upload Screenshot<span class="text-danger">*</span></label>

                    </div>

                </div>
            </div>

            <!-- Full Info Description -->
            <div class="col-lg-12">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <textarea maxlength="1500" name="description" class="form-control" id="description" placeholder="Explain Your Site Problem!" style="height: 110px;" required></textarea>
                        <label for="description">Description<span class="text-danger">*</span></label>
                    </div>
                </div>
            </div>
            <!-- Submit Button -->
            <div class="col-lg-12 text-center mb-3">
                <div class="form-group">
                    <button class="col-12 text-white btn text-center shadow" id="SendHelpRequest" type="submit" style="background-color:#4ac387;" name="SendHelpRequest"><b>Send Help Request</b></button>
                </div>
            </div>
        </div>

    </form>

    <script>
        function previewScreenshot(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var preview = document.getElementById('screenshot-preview');
                preview.src = reader.result;
                document.getElementById('screenshot-preview-container').style.display = 'block';
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>

    <!-- Table -->
    <hr class="text-primary p-2 rounded">
    <!-- Table Start -->

    <div class="row">
        <div class="col-sm-12 col-lg-12">
            <h4 class="text-center fw-bolder text-primary mb-3">Help Request List</h4>
            <div class=" rounded" style="overflow-y: scroll;">

                <table class="table table-striped border shadow" id="example" class="display">
                    <thead class="head">
                        <tr class="text-center text-nowrap">
                            <th scope="col">S.NO</th>
                            <th scope="col">Help ID</th>
                            <th scope="col">Picture</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Mobile</th>
                            <th scope="col">Website URL</th>
                            <th scope="col">Error Page URL</th>
                            <th scope="col">Description</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        $fetch = mysqli_query($conn, "SELECT * FROM help_requests ORDER BY id DESC");
                        while ($row = mysqli_fetch_array($fetch)) {
                        ?>
                            <tr class="text-center">
                                <th scope="row"><?= $i++ ?></th>
                                <td><?= htmlspecialchars($row['help_id']) ?></td>
                                <td class="image-cell">
                                    <?php if (!empty($row['screenshot_path'])): ?>
                                        <a href="<?= htmlspecialchars($row['screenshot_path']); ?>" target="_blank"><img src="<?= htmlspecialchars($row['screenshot_path']); ?>" alt="Screenshot" class="img-thumbnail" style="max-height: 100px;"></a>
                                    <?php else: ?>
                                        No Image
                                    <?php endif; ?>
                                </td>
                                <td><?= htmlspecialchars($row['help_name']) ?></td>
                                <td><?= htmlspecialchars($row['help_email']) ?></td>
                                <td><?= htmlspecialchars($row['help_mobile']) ?></td>
                                <td><?= htmlspecialchars($row['website_url']) ?></td>
                                <td><?= htmlspecialchars($row['error_page_url']) ?></td>
                                <td><?= htmlspecialchars($row['description']) ?></td>
                                <td class="action">
                                    <!-- <a href="#" onclick="view(<?= $row['id'] ?>)"><i class="fas fa-eye me-2" title="View"></i></a> -->
                                    <!-- <a href="#" onclick="edit(<?= $row['id'] ?>)"><i class="fas fa-pen me-2" title="Edit"></i></a> -->
                                    <a class="text-danger" href="#" onclick="confirmDelete(<?= $row['id']; ?>, 'help_requests', 'id')"><i class="fas fa-trash-alt me-2" title="Delete"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <!-- Table End -->
</div>
<?php include('../includes/footer.php'); ?>