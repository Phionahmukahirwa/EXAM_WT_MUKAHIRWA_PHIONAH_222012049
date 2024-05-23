<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="mystyle.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sessions Page</title>
  <style>
    /* Normal link */
    a {
      padding: 10px;
      color: white;
      background-color: yellow;
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
  </style>

  <!-- JavaScript validation and content load for insert data-->
        <script>
            function confirmInsert() {
                return confirm('Are you sure you want to insert this record?');
            }
        </script>
        
  </head>

  <header>

<body bgcolor="dimgray">
  <form class="d-flex" role="search" action="search.php">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="query">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
  <ul style="list-style-type: none; padding: 0;">
    <li style="display: inline; margin-right: 10px;">
    <img src="./image/th.jpg" width="90" height="60" alt="Logo">
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./home.html">HOME</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./about.html">ABOUT</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./contact.html">CONTACT</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./appointments.php">Appointments</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./clients.php">Clients</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./exercises.php">Exercises</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./feedback.php">Feedback</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./notifications.php">Notifications</a>
  </li>  <li style="display: inline; margin-right: 10px;"><a href="./payments.php">Payments</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./sessions.php">Sessions</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./therapists.php">Therapists</a>
  </li>
<li style="display: inline; margin-right: 10px;"><a href="./therapistavailabilities.php">Therapist Availabilities</a>
  </li>
   
   
  
    <li class="dropdown" style="display: inline; margin-right: 10px;">
      <a href="#" style="padding: 10px; color: white; background-color: skyblue; text-decoration: none; margin-right: 15px;">Settings</a>
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
   <h1><u>sessions Form</u></h1>

<form method="post" onsubmit="return confirmInsert();">

    <label for="SessionID">SessionID:</label>
    <input type="number" id="driver_id" name="driver_id" required><br><br>

    <label for="TherapistID">TherapistID:</label>
    <input type="number" id="user_id" name="user_id" required><br><br>

    <label for="ClientID">ClientID:</label>
    <input type="text" id="license_number" name="license_number" required><br><br>

    <label for="Date">Date:</label>
    <input type="date" id="car_model" name="car_model" required><br><br>

    <label for="StartTime">StartTime:</label>
    <input type="time" id="capacity" name="capacity" required><br><br>

    <label for="EndTime">EndTime:</label>
    <input type="time" id="capacit" name="capacit" required><br><br>

    <label for="DurationMinutes">DurationMinutes:</label>
    <input type="text" id="capaci" name="capaci" required><br><br>

    <label for="SessionNotes">SessionNotes:</label>
    <input type="text" id="capac" name="capac" required><br><br>

    <input type="submit" name="add" value="Insert">
</form>

<?php
include('db_connection.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind the parameters
    $stmt = $connection->prepare("INSERT INTO sessions(SessionID, TherapistID, ClientID, Date, StartTime,EndTime,DurationMinutes,SessionNotes) VALUES (?, ?, ?, ?, ? ,?,?,?)");
    $stmt->bind_param("isssssss", $SessionID, $TherapistID, $ClientID, $Date, $StartTime,$EndTime,$DurationMinutes,$SessionNotes);
    // Set parameters and execute
    $PaymentID = $_POST['driver_id'];
    $ClientID = $_POST['user_id'];
    $TherapistID = $_POST['license_number'];
    $Amount = $_POST['car_model'];
    $PaymentDate = $_POST['capacity'];
    $PaymentStatus = $_POST['capacit'];
    $PaymentMethod = $_POST['capaci'];
    $TransactionID = $_POST['capac'];
    
    if ($stmt->execute() == TRUE) {
        echo "New record has been added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
$connection->close();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Clients TABLE</title>
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
    <center><h2>sessions Table</h2></center>
    <table border="3">
        <tr>
            <th>SessionID</th>
            <th>TherapistID</th>
            <th>ClientID</th>
            <th>Date</th>
            <th>StartTime</th>
            <th>EndTime</th>
            <th>DurationMinutes</th>
            <th>SessionNotes</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
<?php
include('db_connection.php');
// Prepare SQL query to retrieve all sessions
$sql = "SELECT * FROM sessions";
$result = $connection->query($sql);

// Check if there are any sessions
if ($result->num_rows > 0) {
    // Output data for each row
    while ($row = $result->fetch_assoc()) {
        $SessionID = $row['SessionID']; // Fetch the SessionID
        echo "<tr>
            <td>" . $row['SessionID'] . "</td>
            <td>" . $row['TherapistID'] . "</td>
            <td>" . $row['ClientID'] . "</td>
            <td>" . $row['Date'] . "</td>
            <td>" . $row['StartTime'] . "</td>
            <td>" . $row['EndTime'] . "</td>
            <td>" . $row['DurationMinutes'] . "</td>
            <td>" . $row['SessionNotes'] . "</td>
            <td><a style='padding:4px' href='delete_sessions.php?SessionID=$SessionID'>Delete</a></td> 
            <td><a style='padding:4px' href='update_sessions.php?SessionID=$SessionID'>Update</a></td> 
        </tr>";
    }
} else {
    echo "<tr><td colspan='7'>No data found</td></tr>";
}

// Close the database connection
$connection->close();
?>
    </table>
</body>

</section>
 
<footer>
  <center> 
   <b><h2>UR CBE BIT &copy, 2024 &reg, Designer by:MUKAHIRWA PHIONNAH</h2></b>
  </center>
</footer>
  
</body>
</html>


