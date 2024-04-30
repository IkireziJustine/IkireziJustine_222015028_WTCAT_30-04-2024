<?php
include('db_connection.php');
// Check if Product_Id is set
if(isset($_REQUEST['ticket_id'])) {
    $ticket_id = $_REQUEST['ticket_id'];
    
    $stmt = $connection->prepare("SELECT * FROM tickets WHERE ticket_id=?");
    $stmt->bind_param("i", $ticket_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $ticket_id = $row['ticket_id'];
        $user_id = $row['user_id'];
        $source = $row['source'];
        $destination = $row['destination'];
        $departure_time = $row['departure_time'];
        
    } else {
        echo "ticket not found.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update tickets</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
        <!-- Update products form -->
    <h2><u>Update Form of tickets</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
    <label for="ticket_id">ticket_id:</label>
    <input type="text" name="ticket_id" value="<?php echo isset($ticket_id) ? $ticket_id : ''; ?>">
    <br><br>    

    <label for="user_id">user_id:</label>
    <input type="text" name="user_id" value="<?php echo isset($user_id) ? $user_id : ''; ?>">
    <br><br>

    <label for="source">source:</label>
    <input type="text" name="source" value="<?php echo isset($source) ? $source : ''; ?>">
    <br><br>

    <label for="destination">destination:</label>
    <input type="text" name="destination" value="<?php echo isset($destination) ? $destination : ''; ?>">
    <br><br>


    <label for="departure_time">departure_time:</label>
    <input type="text" name="departure_time" value="<?php echo isset($departure_time) ? $departure_time : ''; ?>">
    <br><br>
    <input type="submit" name="up" value="Update">

  </form>
</body>
</html>


<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $ticket_id = $_POST['ticket_id'];
    $user_id = $_POST['user_id'];
    $source= $_POST['source'];
    $destination = $_POST['destination'];
    $departure_time = $_POST['departure_time'];
    
   // Update the ticket in the database
$stmt = $connection->prepare("UPDATE tickets SET user_id=?, source=?, destination=?, departure_time=? WHERE ticket_id=?");
$stmt->bind_param("issss", $user_id, $source, $destination, $departure_time, $ticket_id);
$stmt->execute();

    
    // Redirect to tickets.php
    header('Location: tickets.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>