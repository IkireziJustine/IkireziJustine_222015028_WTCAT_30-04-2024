<?php
include('db_connection.php');

// Check if payment_id is set
if(isset($_REQUEST['payment_id'])) {
    $payment_id = $_REQUEST['payment_id'];
    
    $stmt = $connection->prepare("SELECT * FROM payment WHERE payment_id=?");
    $stmt->bind_param("i", $payment_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $payment_id = $row['payment_id'];
        $ticket_id = $row['ticket_id'];
        $amount = $row['amount'];
        $payment_date = $row['payment_date'];
       
        
    } else {
        echo "payment not done.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update payment</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
    </head>
<body><center>
        <!-- Update payment form -->
    <h2><u>Update Form of payment</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">

        <label for="payment_id">payment_id:</label>
        <input type="number" name="payment_id" value="<?php echo isset($payment_id) ? $payment_id: ''; ?>">
        <br><br>

        <label for="ticket_id">ticket_id:</label>
        <input type="number" name="ticket_id" value="<?php echo isset($ticket_id) ? $ticket_id : ''; ?>">
        <br><br>

        <label for="amount">amount:</label>
        <input type="number" name="amount" value="<?php echo isset($amount) ? $amount: ''; ?>">
        <br><br>

         <label for="payment_date">payment_date:</label>
        <input type="Date" name="payment_date" value="<?php echo isset($payment_date) ? $payment_date : ''; ?>">
        <br><br>

        <input type="submit" name="update" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['update'])) {
    //Retrieve updated values from form
    $ticket_id = $_POST['ticket_id'];
    $amount= $_POST['amount'];
    $payment_date = $_POST['payment_date'];
    
    
    
$stmt = $connection->prepare("UPDATE payment SET ticket_id=?, amount=?, payment_date=? WHERE payment_id=?");
$stmt->bind_param("sssi",$ticket_id, $amount, $payment_date, $payment_id);
$stmt->execute();

    
    // Redirect to payment.php
    header('Location:Payment.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
