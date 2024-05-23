<?php
include('db_connection.php');

// Check if AppointmentID is set
if(isset($_REQUEST['AppointmentID'])) {
    $AppointmentID = $_REQUEST['AppointmentID'];
    
    $stmt = $connection->prepare("SELECT * FROM appointments WHERE AppointmentID=?");
    $stmt->bind_param("i", $AppointmentID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $TherapistID = $row['TherapistID'];
        $ClientID = $row['ClientID'];
        $AppointmentDate = $row['AppointmentDate'];
        $StartTime = $row['StartTime'];
        $EndTime = $row['EndTime'];
        $Status = $row['Status'];
        $ReasonForAppointment = $row['ReasonForAppointment'];
    } else {
        echo "Appointment not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Record in Appointments Table</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update appointments form -->
    <h2><u>Update Form for Appointments</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">

        <label for="TherapistID">Therapist ID:</label>
        <input type="number" name="TherapistID" value="<?php echo isset($TherapistID) ? $TherapistID : ''; ?>">
        <br><br>

        <label for="ClientID">Client ID:</label>
        <input type="number" name="ClientID" value="<?php echo isset($ClientID) ? $ClientID : ''; ?>">
        <br><br>

        <label for="AppointmentDate">Appointment Date:</label>
        <input type="date" name="AppointmentDate" value="<?php echo isset($AppointmentDate) ? $AppointmentDate : ''; ?>">
        <br><br>

        <label for="StartTime">Start Time:</label>
        <input type="time" name="StartTime" value="<?php echo isset($StartTime) ? $StartTime : ''; ?>">
        <br><br>

        <label for="EndTime">End Time:</label>
        <input type="time" name="EndTime" value="<?php echo isset($EndTime) ? $EndTime : ''; ?>">
        <br><br>

        <label for="Status">Status:</label>
        <input type="text" name="Status" value="<?php echo isset($Status) ? $Status : ''; ?>">
        <br><br>

        <label for="ReasonForAppointment">Reason for Appointment:</label>
        <input type="text" name="ReasonForAppointment" value="<?php echo isset($ReasonForAppointment) ? $ReasonForAppointment : ''; ?>">
        <br><br>
        
        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
  
    $TherapistID = $_POST['TherapistID'];
    $ClientID = $_POST['ClientID'];
    $AppointmentDate = $_POST['AppointmentDate'];
    $StartTime = $_POST['StartTime'];
    $EndTime = $_POST['EndTime'];
    $Status = $_POST['Status'];
    $ReasonForAppointment = $_POST['ReasonForAppointment'];
    
    // Update the appointment in the database
    $stmt = $connection->prepare("UPDATE appointments SET TherapistID=?, ClientID=?, AppointmentDate=?, StartTime=?, EndTime=?, Status=?, ReasonForAppointment=? WHERE AppointmentID=?");
    $stmt->bind_param("iisssssi", $TherapistID, $ClientID, $AppointmentDate, $StartTime, $EndTime, $Status, $ReasonForAppointment, $AppointmentID);
    $stmt->execute();
    
    // Redirect to view_appointments.php or any other appropriate page
    header('Location: view_appointments.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
