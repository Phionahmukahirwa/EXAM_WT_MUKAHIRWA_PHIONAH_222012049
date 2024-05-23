<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="mystyle.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Appointments Page</title>
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
   <h1><u>Appointments Profile Form</u></h1>


<form method="post" onsubmit="return confirmInsert();">

    <label for="AppointmentID">AppointmentID:</label>
    <input type="number" id="driver_id" name="driver_id" required><br><br>

    <label for="TherapistID">TherapistID:</label>
    <input type="number" id="user_id" name="user_id" required><br><br>

    <label for="ClientID">ClientID:</label>
    <input type="number" id="license_number" name="license_number" required><br><br>

    <label for="AppointmentDate">AppointmentDate:</label>
    <input type=date id="car_model" name="car_model" required><br><br>

    <label for="StartTime">StartTime:</label>
    <input type="time" id="capacity" name="capacity" required><br><br>

    <label for="EndTime">EndTime:</label>
    <input type="time" id="capacit" name="capacit" required><br><br>

    <label for="Status">Status:</label>
    <input type="time" id="capaci" name="capaci" required><br><br>

    <label for="ReasonForAppointment">ReasonForAppointment:</label>
    <input type="time" id="capac" name="capac" required><br><br>

    <input type="submit" name="add" value="Insert">
</form>

<?php
include('db_connection.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind the parameters
    $stmt = $connection->prepare("INSERT INTO appointments(AppointmentID, TherapistID, ClientID, AppointmentDate, StartTime,EndTime,Status,ReasonForAppointment) VALUES (?, ?, ?, ?, ? ,? ,?,?)");
    $stmt->bind_param("isssssss", $AppointmentID, $TherapistID, $ClientID, $AppointmentDate, $StartTime,$EndTime,$Status,$ReasonForAppointment);
    // Set parameters and execute
    $AppointmentID = $_POST['driver_id'];
    $TherapistID = $_POST['user_id'];
    $ClientID = $_POST['license_number'];
    $AppointmentDate = $_POST['car_model'];
    $StartTime = $_POST['capacity'];
    $EndTime = $_POST['capacit'];
    $Status = $_POST['capaci'];
    $ReasonForAppointment = $_POST['capac'];
   
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
    <title>Driver Profiles</title>
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
    <center><h2>Appointments Table</h2></center>
    <table border="3">
        <tr>
            <th>AppointmentID</th>
            <th>TherapistID</th>
            <th>ClientID</th>
            <th>AppointmentDate</th>
            <th>StartTime</th>
            <th>EndTime</th>
            <th>Status</th>
            <th>SReasonForAppointment</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
<?php
include('db_connection.php');

// Prepare SQL query to retrieve all appointments
$sql = "SELECT * FROM appointments";
$result = $connection->query($sql);

// Check if there are any appointments
if ($result->num_rows > 0) {
    // Output data for each row
    while ($row = $result->fetch_assoc()) {
        $appointments = $row['AppointmentID']; // Fetch the AppointmentID
        echo "<tr>
            <td>" . $row['AppointmentID'] . "</td>
            <td>" . $row['TherapistID'] . "</td>
            <td>" . $row['ClientID'] . "</td>
            <td>" . $row['AppointmentDate'] . "</td>
            <td>" . $row['StartTime'] . "</td>
             <td>" . $row['EndTime'] . "</td>
              <td>" . $row['Status'] . "</td>
               <td>" . $row['ReasonForAppointment'] . "</td>
            <td><a style='padding:4px' href='delete_appointments.php?AppointmentID=$appointments'>Delete</a></td> 
            <td><a style='padding:4px' href='update_appointments.php?AppointmentID=$appointments'>Update</a></td> 
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

