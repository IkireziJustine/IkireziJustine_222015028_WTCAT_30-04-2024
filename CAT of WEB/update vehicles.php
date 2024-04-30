<?php
include('db_connection.php');
// Initialize variables
$vehicle_id = $vehicle_name = $capacity = $route_id = '';

// Check if vehicle_id is set
if(isset($_REQUEST['vehicle_id'])) {
    $vehicle_id = $_REQUEST['vehicle_id'];
    
    $stmt = $connection->prepare("SELECT * FROM vehicles WHERE vehicle_id=?");
    $stmt->bind_param("i", $vehicle_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $vehicle_name = $row['vehicle_name'];
        $capacity = $row['capacity'];
        $route_id = $row['route_id'];
    } else {
        echo "Vehicle not found.";
    }
}

// Handle form submission
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $vehicle_name = $_POST['vehicle_name'];
    $capacity = $_POST['capacity'];
    $route_id = $_POST['route_id'];
    
    // Update the database
    $stmt = $connection->prepare("UPDATE vehicles SET vehicle_name=?, capacity=?, route_id=? WHERE vehicle_id=?");
    $stmt->bind_param("ssii", $vehicle_name, $capacity, $route_id, $vehicle_id);
    if ($stmt->execute()) {
        // Redirect to vehicles.php after successful update
        header('Location: vehicles.php');
        exit(); 
    } else {
        echo "Error updating record: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update vehicles</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
    </head>
<body><center>
        <!-- Update vehicles form -->
    <h2><u>Update Form of vehicles</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
    <label for="vehicle_id">Vehicle ID:</label>
    <input type="number" name="vehicle_id" value="<?php echo isset($vehicle_id) ? $vehicle_id: ''; ?>">
    <br><br>

    <label for="vehicle_name">Vehicle Name:</label>
    <input type="text" name="vehicle_name" value="<?php echo isset($vehicle_name) ? $vehicle_name : ''; ?>">
    <br><br>

    <label for="capacity">Capacity:</label>
    <input type="text" name="capacity" value="<?php echo isset($capacity) ? $capacity : ''; ?>">
    <br><br>

    <label for="route_id">Route ID:</label>
    <input type="number" name="route_id" value="<?php echo isset($route_id) ? $route_id : ''; ?>">
    <br><br>

    <input type="submit" name="up" value="Update">
</form>

</body>
</html>
<?php
if(isset($_POST['update'])) {
    // Retrieve updated values from form
    $vehicle_name = $_POST['vehicle_name'];
    $capacity= $_POST['capacity'];
    $route_id = $_POST['route_id'];
    
    
    
$stmt = $connection->prepare("UPDATE vehicles SET vehicle_name=?, capacity=?, route_id=? WHERE vehicle_id=?");
$stmt->bind_param("sssi",$vehicle_name, $capacity, $route_id, $vehicle_id);
$stmt->execute();

    
    // Redirect to routes.php
    header('Location:vehicles.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
