<?php
include('db_connection.php');
// Check if ticket_id is set
if(isset($_REQUEST['ticket_id'])) {
    $ticket_id = $_REQUEST['ticket_id'];
    
    // Prepare and execute the DELETE statement
   // Disable foreign key checks
$connection->query('SET FOREIGN_KEY_CHECKS=0');

// Perform delete operation
$stmt = $connection->prepare("DELETE FROM tickets WHERE ticket_id=?");
$stmt->bind_param("i", $ticket_id);
if ($stmt->execute()) {
    header('Location:tickets.php?msg=Delete data successfully');
    echo "Record deleted successfully.";
} else {
    echo "Error deleting data: " . $stmt->error;
}
$stmt->close();

// Re-enable foreign key checks
$connection->query('SET FOREIGN_KEY_CHECKS=1');

}
?>

