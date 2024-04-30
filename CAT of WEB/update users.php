<?php
include('db_connection.php');
// Check if user_id is set
if(isset($_REQUEST['user_id'])) {
    $user_id = $_REQUEST['user_id'];
    
    $stmt = $connection->prepare("SELECT * FROM users WHERE user_id=?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user_id = $row['user_id'];
        $name = $row['name'];
        $email = $row['email'];
        $phone_number = $row['phone_number'];
        $address = $row['address'];    
    } else {
        echo "User not found.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update users</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
        <!-- Update users form -->
    <h2><u>Update Form of users</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
    <label for="user_id">user_id:</label>
    <input type="number" name="user_id" value="<?php echo isset($user_id) ? $user_id : ''; ?>">
    <br><br>    

    <label for="name">name:</label>
    <input type="text" name="name" value="<?php echo isset($name) ? $name : ''; ?>">
    <br><br>

    <label for="email">email:</label>
    <input type="text" name="email" value="<?php echo isset($email) ? $email : ''; ?>">
    <br><br>

    <label for="phone_number">phone_number:</label>
    <input type="text" name="phone_number" value="<?php echo isset($phone_number) ? $phone_number : ''; ?>">
    <br><br>


    <label for="address">address:</label>
    <input type="text" name="address" value="<?php echo isset($address) ? $address : ''; ?>">
    <br><br>
    <input type="submit" name="update" value="Update">

  </form>
</body>
</html>

<?php
if(isset($_POST['update'])) { // Corrected the form submission check
    // Retrieve updated values from form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];
    
    $stmt = $connection->prepare("UPDATE users SET name=?, email=?, phone_number=?, address=? WHERE user_id=?");
    $stmt->bind_param("ssssi", $name, $email, $phone_number, $address, $user_id); // Corrected binding parameters
    $stmt->execute();
    
    // Redirect to users.php
    header('Location:users.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
