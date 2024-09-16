<?php include('../config/dbconnection.php') ?>
<?php include('../config/session_check.php') ?>
<?php

// echo 'dsdnsjbasf';die;
// // Get the raw POST data
// $postData = file_get_contents('php://input');
// $request = json_decode($postData, true);

// if (isset($request['id']) && isset($request['table']) && isset($request['key'])) {
//     $id = $request['id'];
//     $table = $request['table'];
//     $key = $request['key'];

//     // Ensure both ID and table name are safe to use in a SQL query
//     $id = mysqli_real_escape_string($conn, $id);
//     $table = mysqli_real_escape_string($conn, $table);

//     // Array of tables and columns where the district_id or district_name might be referenced
//     $referenceTables = [
//         ['table' => 'swekshanudan', 'column' => 'district_id'],
//         ['table' => 'vidhansabha_master', 'column' => 'district_id'],
//         // Add more tables and columns as needed
//     ];
// echo 'id-'.$id.'table-'.$table.'key-'.$key;die;
//     // Check for references in other tables
//     $referenceFound = false;
//     foreach ($referenceTables as $refTable) {
//         $refTableName = $refTable['table'];
//         $refColumnName = $refTable['column'];

//         $checkSql = "SELECT COUNT(*) as count FROM `$refTableName` WHERE `$refColumnName`='$id'";
//         $result = mysqli_query($conn, $checkSql);
//         $row = mysqli_fetch_assoc($result);

//         if ($row['count'] > 0) {
//             $referenceFound = true;
//             break;
//         }
//     }

//     if ($referenceFound) {
//         echo "Error: Record cannot be deleted as it is referenced in other tables.";
//     } else {
//         // SQL to delete the record from the specified table
//         $sql = "DELETE FROM `$table` WHERE `$key`='$id'";

//         if (mysqli_query($conn, $sql)) {
//             // Record deleted successfully
//             echo "Record deleted successfully.";
//         } else {
//             // Error deleting record
//             echo "Error deleting record: " . mysqli_error($conn);
//         }
//     }

//     // Close the database connection
//     mysqli_close($conn);
// } else {
//     echo "Invalid request.";
// }

// Get the raw POST data
$postData = file_get_contents('php://input');
$request = json_decode($postData, true);

if (isset($request['id']) && isset($request['table']) && isset($request['key'])) {
    $id = $request['id'];
    $table = $request['table'];
    $key = $request['key'];

    // Ensure both ID and table name are safe to use in a SQL query
    $id = mysqli_real_escape_string($conn, $id);
    $table = mysqli_real_escape_string($conn, $table);

    // SQL to delete the record from the specified table
    $sql = "DELETE FROM `$table` WHERE $key='$id'";

    if (mysqli_query($conn, $sql)) {
        // Record deleted successfully
        echo "Record deleted successfully.";
    } else {
        // Error deleting record
        echo "Error deleting record: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    echo "Invalid request.";
}
?>
