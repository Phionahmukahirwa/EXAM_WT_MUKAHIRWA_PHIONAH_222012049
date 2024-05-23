<?php
include('db_connection.php');

// Check if FeedbackID is set
if(isset($_REQUEST['FeedbackID'])) {
    $FeedbackID = $_REQUEST['FeedbackID'];
    
    $stmt = $connection->prepare("SELECT * FROM feedback WHERE FeedbackID=?");
    $stmt->bind_param("i", $FeedbackID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $SessionID = $row['SessionID'];
        $ClientID = $row['ClientID'];
        $TherapistID = $row['TherapistID'];
        $Rating = $row['Rating'];
        $FeedbackContent = $row['FeedbackContent'];
        $FeedbackDate = $row['FeedbackDate'];
    } else {
        echo "Feedback not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Record in Feedback Table</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update feedback form -->
    <h2><u>Update Form for Feedback</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="SessionID">Session ID:</label>
        <input type="number" name="SessionID" value="<?php echo isset($SessionID) ? $SessionID : ''; ?>">
        <br><br>
        <label for="ClientID">Client ID:</label>
        <input type="number" name="ClientID" value="<?php echo isset($ClientID) ? $ClientID : ''; ?>">
        <br><br>
        <label for="TherapistID">Therapist ID:</label>
        <input type="number" name="TherapistID" value="<?php echo isset($TherapistID) ? $TherapistID : ''; ?>">
        <br><br>
        <label for="Rating">Rating:</label>
        <input type="number" name="Rating" value="<?php echo isset($Rating) ? $Rating : ''; ?>">
        <br><br>
        <label for="FeedbackContent">Feedback Content:</label>
        <textarea name="FeedbackContent"><?php echo isset($FeedbackContent) ? $FeedbackContent : ''; ?></textarea>
        <br><br>
        <label for="FeedbackDate">Feedback Date:</label>
        <input type="date" name="FeedbackDate" value="<?php echo isset($FeedbackDate) ? $FeedbackDate : ''; ?>">
        <br><br>
        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $SessionID = $_POST['SessionID'];
    $ClientID = $_POST['ClientID'];
    $TherapistID = $_POST['TherapistID'];
    $Rating = $_POST['Rating'];
    $FeedbackContent = $_POST['FeedbackContent'];
    $FeedbackDate = $_POST['FeedbackDate'];
    
    // Update the feedback in the database
    $stmt = $connection->prepare("UPDATE feedback SET SessionID=?, ClientID=?, TherapistID=?, Rating=?, FeedbackContent=?, FeedbackDate=? WHERE FeedbackID=?");
    $stmt->bind_param("iiiissi", $SessionID, $ClientID, $TherapistID, $Rating, $FeedbackContent, $FeedbackDate, $FeedbackID);
    $stmt->execute();
    
    // Redirect to view_feedback.php
    header('Location: feedback.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
