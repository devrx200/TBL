<?php
include('../config/dbconnection.php'); // Adjust path as needed
include('../config/session_check.php'); // Adjust path as needed

$admin_id = $_SESSION['username'];
$old_password = $_POST['old_password'];

// Fetch the stored password hash from the database
$sql = "SELECT password FROM adminlogin WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $admin_id);
$stmt->execute();
$result = $stmt->get_result();
$admin = $result->fetch_assoc();

$response = array('valid' => false);

if ($admin) {
    // Verify the entered password with the stored password
    if (password_verify($old_password, $admin['password'])) {
        $response['valid'] = true;
    }
}

echo json_encode($response);
?>
