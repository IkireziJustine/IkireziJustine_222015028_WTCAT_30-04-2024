<?php
include('db_connection.php');

// Check if user_id is set
if (isset($_REQUEST['user_id'])) {
    // Disable foreign key checks
    $connection->query('SET FOREIGN_KEY_CHECKS=0');

    // Retrieve user_id from request
    $user_id = $_REQUEST['user_id'];

    // Perform delete operation
    $stmt = $connection->prepare("DELETE FROM users WHERE user_id=?");
    $stmt->bind_param("i", $user_id);

    if ($stmt->execute()) {
        // Redirect after successful deletion
        header('Location: users.php?msg=Data deleted successfully');
        exit(); // Ensure no further processing after redirection
    } else {
        echo "Error deleting data: " . $stmt->error;
    }
    $stmt->close();

    // Re-enable foreign key checks
    $connection->query('SET FOREIGN_KEY_CHECKS=1');
} else {
    echo "user_id is not set.";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Delete Record</title>
    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this record?");
        }
    </script>
</head>
<body>
    <form method="post" onsubmit="return confirmDelete();">
        <!-- You may include any additional information or confirmation message here -->
        <input type="hidden" name="user_id" value="<?php echo isset($_REQUEST['user_id']) ? $_REQUEST['user_id'] : ''; ?>">
        <input type="submit" value="Delete">
    </form>
</body>
</html>
