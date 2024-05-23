<?php
include('db_connection.php');

// Check if Availability_id is set
if(isset($_REQUEST['Availability_id'])) {
    $Avail_id = $_REQUEST['Availability_id'];
    
    $stmt = $connection->prepare("SELECT * FROM therapistavailabilities WHERE Availability_id=?");
    $stmt->bind_param("i", $Avail_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['Availability_id'];
        $g = $row['TherapistId'];
        $y = $row['Day_of_week'];
        $z = $row['Start_time'];
        $w = $row['End_time'];
    } else {
        echo "Therapist not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Record in therapistavailabilities Table</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update therapists availability form -->
    <h2><u>Update Form for Therapist Availability</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">

         <label for="TherapistId">TherapistId:</label>
        <input type="number" name="TherapistId" value="<?php echo isset($g) ? $g : ''; ?>">
        <br><br>

  
        <label for="Day_of_week">Day of Week:</label>
        <input type="text" name="Day_of_week" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="Start_time">Start Time:</label>
        <input type="text" name="Start_time" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="End_time">End Time:</label>
        <input type="text" name="End_time" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $TherapistId = $_POST['TherapistId'];
    $Day_of_week = $_POST['Day_of_week'];
    $Start_time = $_POST['Start_time'];
    $End_time = $_POST['End_time'];
    
    // Update the therapist availability in the database
    $stmt = $connection->prepare("UPDATE therapistavailabilities SET TherapistId=?, Day_of_week=?, Start_time=?, End_time=? WHERE Availability_id=?");
    $stmt->bind_param("isssi", $TherapistId, $Day_of_week, $Start_time, $End_time, $Avail_id);
    $stmt->execute();
    
    // Redirect to view page
    header('Location: therapistavailabilities.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
