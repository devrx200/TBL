<?php
include('../config/dbconnection.php'); // Adjust path as needed
include('../config/session_check.php'); // Adjust path as needed

$tblname = 'inbox';
$pagename = "Inbox Messages Page";
$username = $_SESSION['username'];
$page_name = basename($_SERVER['PHP_SELF']);
// Get images From db  Profile image 
// $profile_img = getvalfield($conn, $tblname, "profile_picture", "username='$username'");
$admin_name = getvalfield($conn, 'adminlogin', "admin_name", "username='$username'");



?>

<!-- Starting page -->
<?php include('../includes/header.php') ?>
<?php include('../includes/sidebar.php') ?>
<?php include('../includes/navbar.php') ?>



<div class="container-fluid px-4 pt-4">

    <!-- Table -->
    <hr class="text-primary p-2 rounded">
    <!-- Table Start -->

    <div class="row">
        <div class="col-sm-12 col-lg-12">
            <h4 class="text-center fw-bolder text-primary mb-3">Inbox Messages</h4>
            <div class="table-responsive rounded">
                <!-- Responsive wrapper -->
                <table class="table table-striped border shadow">
                    <thead class="head">
                        <tr class="text-center text-nowrap">
                            <th scope="col">S.NO</th>
                            <th scope="col">Name</th>
                            <th scope="col">Mobile</th>
                            <th scope="col">Email</th>
                            <th scope="col">Subject</th>
                            <th scope="col">Message</th>
                            <th scope="col">Date & Time</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        $fetch = mysqli_query($conn, "SELECT * FROM inbox ORDER BY id DESC");
                        while ($row = mysqli_fetch_array($fetch)) {
                            $messageID = 'message' . $row['id']; // Create unique ID for each row
                        ?>
                            <tr class="text-center">
                                <th scope="row"><?= $i++ ?></th>
                                <td><?= htmlspecialchars($row['name']) ?></td>
                                <td><?= htmlspecialchars($row['mobile']) ?></td>
                                <td><?= htmlspecialchars($row['email']) ?></td>
                                <td><?= htmlspecialchars($row['subject']) ?></td>
                                <td>
                                    <a class="rounded p-1 bg-white" title="View-Message" data-bs-toggle="collapse" data-bs-target="#<?= $messageID ?>" aria-expanded="false" aria-controls="<?= $messageID ?>">
                                        <i class="fa-solid fa-eye"></i>View
                                        <i class="fa-solid fa-square-caret-down"></i>
                                    </a>
                                </td>
                                <td><?= htmlspecialchars(date('d-m-y g:i a', strtotime($row['created_at']))) ?></td>
                                <td class="">
                                    <a class="text-danger" href="#" onclick="confirmDelete(<?= $row['id']; ?>, 'inbox', 'id')">
                                        <i class="fas fa-trash-alt me-2" title="Delete"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr class="collapse-row">
                                <td colspan="8" class="rounded alert-success m-0 p-0">
                                    <div class="collapse" id="<?= $messageID ?>">
                                        <p class="text-center text-secondary"><?= nl2br(htmlspecialchars($row['message'])) ?></p>
                                    </div>
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