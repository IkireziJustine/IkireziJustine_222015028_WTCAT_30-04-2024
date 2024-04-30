<?php
include('db_connection.php');
// Check if payment_id is set
if(isset($_REQUEST['payment_id'])) {
    $payment_id = $_REQUEST['payment_id'];
    
    // Prepare and execute the DELETE statement
   // Disable foreign key checks
$connection->query('SET FOREIGN_KEY_CHECKS=0');

// Perform delete operation
$stmt = $connection->prepare("DELETE FROM payment WHERE payment_id=?");
$stmt->bind_param("i", $payment_id);
if ($stmt->execute()) {
    header('Location:payment.php?msg=Delete data successfully');
    echo "Record deleted successfully.";
} else {
    echo "Error deleting data: " . $stmt->error;
}
$stmt->close();

// Re-enable foreign key checks
$connection->query('SET FOREIGN_KEY_CHECKS=1');

}
?>
