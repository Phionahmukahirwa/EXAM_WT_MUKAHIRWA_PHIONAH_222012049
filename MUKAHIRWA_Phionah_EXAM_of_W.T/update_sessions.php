<?php
include('db_connection.php');

// Check if SessionID is set
if(isset($_REQUEST['SessionID'])) {
    $SessionID = $_REQUEST['SessionID'];
    
    $stmt = $connection->prepare("SELECT * FROM sessions WHERE SessionID=?");
    $stmt->bind_param("i", $SessionID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $TherapistID = $row['TherapistID'];
        $ClientID = $row['ClientID'];
        $Date = $row['Date'];
        $StartTime = $row['StartTime'];
        $EndTime = $row['EndTime'];
        $DurationMinutes = $row['DurationMinutes'];
        $SessionNotes = $row['SessionNotes'];
    } else {
        echo "Session not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Record in Sessions Table</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update sessions form -->
    <h2><u>Update Form for Sessions</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="TherapistID">Therapist ID:</label>
        <input type="number" name="TherapistID" value="<?php echo isset($TherapistID) ? $TherapistID : ''; ?>">
        <br><br>
        <label for="ClientID">Client ID:</label>
        <input type="number" name="ClientID" value="<?php echo isset($ClientID) ? $ClientID : ''; ?>">
        <br><br>
        <label for="Date">Date:</label>
        <input type="date" name="Date" value="<?php echo isset($Date) ? $Date : ''; ?>">
        <br><br>
        <label for="StartTime">Start Time:</label>
        <input type="time" name="StartTime" value="<?php echo isset($StartTime) ? $StartTime : ''; ?>">
        <br><br>
        <label for="EndTime">End Time:</label>
        <input type="time" name="EndTime" value="<?php echo isset($EndTime) ? $EndTime : ''; ?>">
        <br><br>
        <label for="DurationMinutes">Duration (minutes):</label>
        <input type="number" name="DurationMinutes" value="<?php echo isset($DurationMinutes) ? $DurationMinutes : ''; ?>">
        <br><br>
        <label for="SessionNotes">Session Notes:</label>
        <textarea name="SessionNotes"><?php echo isset($SessionNotes) ? $SessionNotes : ''; ?></textarea>
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
    $Date = $_POST['Date'];
    $StartTime = $_POST['StartTime'];
    $EndTime = $_POST['EndTime'];
    $DurationMinutes = $_POST['DurationMinutes'];
    $SessionNotes = $_POST['SessionNotes'];
    
    // Update the session in the database
    $stmt = $connection->prepare("UPDATE sessions SET TherapistID=?, ClientID=?, Date=?, StartTime=?, EndTime=?, DurationMinutes=?, SessionNotes=? WHERE SessionID=?");
    $stmt->bind_param("iisssisi", $TherapistID, $ClientID, $Date, $StartTime, $EndTime, $DurationMinutes, $SessionNotes, $SessionID);
    $stmt->execute();
    
    // Redirect to view_sessions.php
    header('Location: sessions.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
