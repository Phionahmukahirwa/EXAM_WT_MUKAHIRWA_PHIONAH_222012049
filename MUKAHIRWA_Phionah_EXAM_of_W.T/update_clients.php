<?php
include('db_connection.php');

// Check if ClientID is set
if(isset($_REQUEST['ClientID'])) {
    $ClientID = $_REQUEST['ClientID'];
    
    $stmt = $connection->prepare("SELECT * FROM clients WHERE ClientID=?");
    $stmt->bind_param("i", $ClientID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $UserID = $row['UserID'];
        $DateOfBirth = $row['DateOfBirth'];
        $MedicalHistory = $row['MedicalHistory'];
        $InsuranceDetail = $row['InsuranceDetail'];
        $EmergencyContact = $row['EmergencyContact'];
    } else {
        echo "Client not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Record in Clients Table</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update clients form -->
    <h2><u>Update Form for Clients</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="UserID">User ID:</label>
        <input type="number" name="UserID" value="<?php echo isset($UserID) ? $UserID : ''; ?>">
        <br><br>
        <label for="DateOfBirth">Date of Birth:</label>
        <input type="date" name="DateOfBirth" value="<?php echo isset($DateOfBirth) ? $DateOfBirth : ''; ?>">
        <br><br>
        <label for="MedicalHistory">Medical History:</label>
        <textarea name="MedicalHistory"><?php echo isset($MedicalHistory) ? $MedicalHistory : ''; ?></textarea>
        <br><br>
        <label for="InsuranceDetail">Insurance Detail:</label>
        <input type="text" name="InsuranceDetail" value="<?php echo isset($InsuranceDetail) ? $InsuranceDetail : ''; ?>">
        <br><br>
        <label for="EmergencyContact">Emergency Contact:</label>
        <input type="text" name="EmergencyContact" value="<?php echo isset($EmergencyContact) ? $EmergencyContact : ''; ?>">
        <br><br>
        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $UserID = $_POST['UserID'];
    $DateOfBirth = $_POST['DateOfBirth'];
    $MedicalHistory = $_POST['MedicalHistory'];
    $InsuranceDetail = $_POST['InsuranceDetail'];
    $EmergencyContact = $_POST['EmergencyContact'];
    
    // Update the client in the database
    $stmt = $connection->prepare("UPDATE clients SET UserID=?, DateOfBirth=?, MedicalHistory=?, InsuranceDetail=?, EmergencyContact=? WHERE ClientID=?");
    $stmt->bind_param("issssi", $UserID, $DateOfBirth, $MedicalHistory, $InsuranceDetail, $EmergencyContact, $ClientID);
    $stmt->execute();
    
    // Redirect to view_clients.php
    header('Location: clients.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
