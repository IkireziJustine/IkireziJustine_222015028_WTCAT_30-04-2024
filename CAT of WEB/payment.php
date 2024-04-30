<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>payment</title>
  <style>
    /* Normal link */
    a {
      padding: 10px;
      color: white;
      background-color:green;
      text-decoration: none;
      margin-right: 15px;
    }

    /* Visited link */
    a:visited {
      color: purple;
    }
    /* Unvisited link */
    a:link {
      color: brown; /* Changed to lowercase */
    }
    /* Hover effect */
    a:hover {
      background-color: white;
    }

    /* Active link */
    a:active {
      background-color: red;
    }

    /* Extend margin left for search button */
    button.btn {
      margin-left: 15px; /* Adjust this value as needed */
      margin-top: 4px;
    }
    /* Extend margin left for search button */
    input.form-control {
      margin-left: 1200px; /* Adjust this value as needed */

      padding: 8px;
     
    }
    section{
    padding:71px;
    border-bottom: 1px solid #ddd;
    }
    footer{
    text-align: center;
    padding: 15px;
    background-color:darkviolet;
    }

  </style>
  </head>

  <header>

<body bgcolor="white">
  <form class="d-flex" role="search" action="search.php">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
  <ul style="list-style-type: none; padding: 0;">
    <li style="display: inline; margin-right: 10px;">
    <img src="./image/logo.png" width="90" height="60" alt="Logo">
  </li>
     </li>
    <li style="display: inline; margin-right: 10px;"><a href="./home.html">HOME</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./about.html">ABOUT</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./contact.html">CONTACT</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./users.php">USERS</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./payment.php">PAYMENT</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./tickets.php">TICKETS</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./routes.php">ROUTES</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./vehicles.php">VEHICLES</a>
  </li>
    <li class="dropdown" style="display: inline; margin-right: 10px;">
      <a href="#" style="padding: 10px; color: white; background-color: darkgreen; text-decoration: none; margin-right: 15px;">SETTINGS</a>
      <div class="dropdown-contents">
        <!-- Links inside the dropdown menu -->
        <a href="login.html">Login</a>
        <a href="register.html">Register</a>
        <a href="logout.php">Logout</a>
      </div>
    </li><br><br>
    
    
    
  </ul>

</header>
<section>

     <h1><u>PAYMENT FORM</u></h1>
    <form method="post">
        <label for="payment_id">payment_id:</label>
        <input type="number" id="payment_id" name="payment_id"><br><br>

        <label for="ticket_id">ticket_id:</label>
        <input type="number" id="ticket_id" name="ticket_id" required><br><br>

        <label for="amount">amount:</label>
        <input type="number" id="amount" name="amount" required><br><br>

        <label for="payment_date">payment_date:</label>
        <input type="date" id="payment_date" name="payment_date" required><br><br>

        <input type="submit" name="add" value="Insert">
    </form>

    <?php
    // Connection details
    include('db_connection.php');
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Prepare and bind the parameters
        $stmt = $connection->prepare("INSERT INTO payment(payment_id, ticket_id, amount, payment_date) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiis", $payment_id, $ticket_id, $amount, $payment_date);

        // Set parameters and execute
        $payment_id = $_POST['payment_id'];
        $ticket_id = $_POST['ticket_id'];
        $amount = $_POST['amount'];
        $payment_date = $_POST['payment_date'];

        if ($stmt->execute() === TRUE) {
            echo "New record has been added successfully";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    $connection->close();
    ?>
<?php
// Connection details
include('db_connection.php');
// SQL query to fetch data from the payment table
$sql = "SELECT * FROM payment";
$result = $connection->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>payments</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <center><h2>PAYMENT</h2></center>
    <table border="5">
        <tr>
            <th>payment id</th>
            <th>ticket id</th>
            <th>amount</th>
            <th>payment_date</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
        include('db_connection.php');


        // Prepare SQL query to retrieve all payments
        $sql = "SELECT * FROM payment";
        $result = $connection->query($sql);

        // Check if there are any payments
        if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                $Payment_id = $row['payment_id']; // Fetch the Payment_id
                echo "<tr>
                    <td>" . $row['payment_id'] . "</td>
                    <td>" . $row['ticket_id'] . "</td>
                    <td>" . $row['amount'] . "</td>
                    <td>" . $row['payment_date'] . "</td>
  <td><a style='padding:4px' href='delete payment.php?payment_id=$Payment_id'>Delete</a></td> 
  <td><a style='padding:4px' href='update payment.php?payment_id=$Payment_id'>Update</a></td> 
                </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No data found</td></tr>";
        }
        // Close the database connection
        $connection->close();
        ?>
    </table>
</body>

    </section>


  
<footer>
  <center> 
    <b><h2>2024 &reg, Designer by: @Justine IKIREZI</h2></b>
  </center>
</footer>
</body>
</html>