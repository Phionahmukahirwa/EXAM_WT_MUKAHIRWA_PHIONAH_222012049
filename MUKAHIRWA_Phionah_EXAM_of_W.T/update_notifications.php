<?php
include('db_connection.php');

// Check if NotificationID is set
if(isset($_REQUEST['NotificationID'])) {
    $NotificationID = $_REQUEST['NotificationID'];
    
    $stmt = $connection->prepare("SELECT * FROM notifications WHERE NotificationID=?");
    $stmt->bind_param("i", $NotificationID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $UserID = $row['UserID'];
        $NotificationType = $row['NotificationType'];
        $NotificationContent = $row['NotificationContent'];
        $IsRead = $row['IsRead'];
        $Timestamp = $row['Timestamp'];
    } else {
        echo "Notification not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Record in Notifications Table</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update notifications form -->
    <h2><u>Update Form for Notifications</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="UserID">User ID:</label>
        <input type="number" name="UserID" value="<?php echo isset($UserID) ? $UserID : ''; ?>">
        <br><br>
        <label for="NotificationType">Notification Type:</label>
        <input type="text" name="NotificationType" value="<?php echo isset($NotificationType) ? $NotificationType : ''; ?>">
        <br><br>
        <label for="NotificationContent">Notification Content:</label>
        <textarea name="NotificationContent"><?php echo isset($NotificationContent) ? $NotificationContent : ''; ?></textarea>
        <br><br>
        <label for="IsRead">Is Read:</label>
        <input type="checkbox" name="IsRead" <?php echo isset($IsRead) && $IsRead == 1 ? 'checked' : ''; ?>>
        <br><br>
        <label for="Timestamp">Timestamp:</label>
        <input type="datetime-local" name="Timestamp" value="<?php echo isset($Timestamp) ? date('Y-m-d\TH:i:s', strtotime($Timestamp)) : ''; ?>">
        <br><br>
        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $UserID = $_POST['UserID'];
    $NotificationType = $_POST['NotificationType'];
    $NotificationContent = $_POST['NotificationContent'];
    $IsRead = isset($_POST['IsRead']) ? 1 : 0;
    $Timestamp = $_POST['Timestamp'];
    
    // Update the notification in the database
    $stmt = $connection->prepare("UPDATE notifications SET UserID=?, NotificationType=?, NotificationContent=?, IsRead=?, Timestamp=? WHERE NotificationID=?");
    $stmt->bind_param("issssi", $UserID, $NotificationType, $NotificationContent, $IsRead, $Timestamp, $NotificationID);
    $stmt->execute();
    
    // Redirect to view_notifications.php
    header('Location: notifications.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
