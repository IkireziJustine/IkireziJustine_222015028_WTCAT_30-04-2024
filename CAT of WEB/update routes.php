<?php
include('db_connection.php');

// Check if route_id is set
if(isset($_REQUEST['route_id'])) {
    $route_id = $_REQUEST['route_id'];
    
    $stmt = $connection->prepare("SELECT * FROM routes WHERE route_id=?");
    $stmt->bind_param("i", $route_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $route_id = $row['route_id'];
        $source = $row['source'];
        $destination = $row['destination'];
        $distance = $row['distance'];
       
        
    } else {
        echo "routes not found.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update routes</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
        <!-- Update routes form -->
    <h2><u>Update Form of routes</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
    <label for="route_id">roure_id:</label>
    <input type="number" name="route_id" value="<?php echo isset($route_id) ? $route_id : ''; ?>">
    <br><br>    

    <label for="source">source:</label>
    <input type="text" name="source" value="<?php echo isset($source) ? $source : ''; ?>">
    <br><br>

    <label for="destination">destination:</label>
    <input type="text" name="destination" value="<?php echo isset($destination) ? $destination : ''; ?>">
    <br><br>

    <label for="distance">distance:</label>
    <input type="number" name="distance" value="<?php echo isset($distance) ? $distance : ''; ?>">
    <br><br>
    <input type="submit" name="update" value="Update">

  </form>
</body>
</html>

<?php
if(isset($_POST['update'])) {
    // Retrieve updated values from form
    $source = $_POST['source'];
    $destination= $_POST['destination'];
    $distance = $_POST['distance'];
    
    
    
$stmt = $connection->prepare("UPDATE routes SET source=?, destination=?, distance=? WHERE route_id=?");
$stmt->bind_param("sssi",$source, $destination, $distance, $route_id);
$stmt->execute();

    
    // Redirect to routes.php
    header('Location:routes.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
