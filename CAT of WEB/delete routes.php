<?php
include('db_connection.php');

// Check if route_id is set
if(isset($_REQUEST['route_id'])) {
    $route_id = $_REQUEST['route_id'];
    
    // Prepare and execute the DELETE statement
   // Disable foreign key checks
$connection->query('SET FOREIGN_KEY_CHECKS=0');

// Perform delete operation
$stmt = $connection->prepare("DELETE FROM routes WHERE route_id=?");
$stmt->bind_param("i", $route_id);
if ($stmt->execute()) {
    header('Location:routes.php?msg=Delete data successfully');
    echo "Record deleted successfully.";
} else {
    echo "Error deleting data: " . $stmt->error;
}
$stmt->close();

// Re-enable foreign key checks
$connection->query('SET FOREIGN_KEY_CHECKS=1');

}
?>
