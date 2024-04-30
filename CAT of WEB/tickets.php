<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tickets</title>
  <style>
    /* Normal link */
    a {
      padding: 10px;
      color: white;
      background-color: pink;
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
    section {
      padding: 71px;
      border-bottom: 1px solid #ddd;
    }
    footer {
      text-align: center;
      padding: 15px;
      background-color: darkgray;
    }
  </style>
</head>
<body bgcolor="pink">

<header>
  <form class="d-flex" role="search" action="search.php">
    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-success" type="submit">Search</button>
  </form>
  <ul style="list-style-type: none; padding: 0;">
    <li style="display: inline; margin-right: 10px;">
      <img src="./image/logo.png" width="90" height="60" alt="Logo">
    </li>
    <li style="display: inline; margin-right: 10px;"><a href="./home.html">HOME</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./about.html">ABOUT</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./contact.html">CONTACT</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./users.php">USERS</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./payment.php">PAYMENT</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./tickets.php">TICKETS</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./routes.php">ROUTES</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./vehicles.php">VEHICLES</a></li>
    <li class="dropdown" style="display: inline; margin-right: 10px;">
      <a href="#" style="padding: 10px; color: white; background-color: darkgreen; text-decoration: none; margin-right: 15px;">SETTINGS</a>
      <div class="dropdown-contents">
        <!-- Links inside the dropdown menu -->
        <a href="login.html">Login</a>
        <a href="register.html">Register</a>
        <a href="logout.php">Logout</a>
      </div>
    </li>
  </ul>
</header>

<section>
  <h1><u>Tickets form</u></h1>
  <form method="post">
    <label for="ticket_id">ticket_id:</label>
    <input type="number" id="ticket_id" name="ticket_id"><br><br>
     
     <label for="user_id">user_id:</label>
    <input type="number" id="user_id" name="user_id"><br><br>     

    <label for="source">source:</label>
    <input type="text" id="source" name="source" required><br><br>

    <label for="destination">Destination:</label>
    <input type="text" id="destination" name="destination" required><br><br>

    <label for="departure_time">departure_time:</label>
    <input type="date" id="departure_time" name="departure_time" required><br><br>

    <input type="submit" name="add" value="Insert">
  </form>

  <?php
 include('db_connection.php');


  // Check if the form is submitted
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // Prepare and bind the parameters
      $stmt = $connection->prepare("INSERT INTO tickets( user_id, source, destination, departure_time) VALUES (?, ?, ?, ?)");
$stmt->bind_param("isss",$user_id, $source, $destination, $distance);

      // Set parameters and execute
      $user_id=$_POST['user_id'];
      $source = $_POST['source'];
      $destination = $_POST['destination'];
      $departure_time = $_POST['departure_time'];

      if($stmt->execute() == TRUE){
          echo "New record has been added successfully";
      } else {
          echo "Error: " . $stmt->error;
      }
      $stmt->close();
  }
  $connection->close();
  ?>

  <h2>Tickets</h2>
  <table border="1">
    <tr>
      <th>Ticket Id</th>
      <th>user_id</th>
      <th>source</th>
      <th>destination</th>
      <th>departure_time</th>
      <th>Delete</th>
      <th>Update</th>
    </tr>
    <?php
    include('db_connection.php');


    $sql = "SELECT * FROM tickets";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $ticket_id = $row['ticket_id'];
            echo "<tr>
                <td>" . $row['ticket_id'] . "</td>
                 <td>" . $row['user_id'] . "</td>
                <td>" . $row['source'] . "</td>
                <td>" . $row['destination'] . "</td>
                <td>" . $row['departure_time'] . "</td>
                <td><a href='delete tickets.php?ticket_id=$ticket_id'>Delete</a></td> 
                <td><a href='update tickets.php?ticket_id=$ticket_id'>Update</a></td> 
              </tr>";
        }
    } else {
        echo "<tr><td colspan='7'>No data found</td></tr>";
    }
    $connection->close();
    ?>
  </table>
</section>

<footer>
  <center><b>2024 &reg; Designed by: @Justine IKIREZI</b></center>
</footer>

</body>
</html>
