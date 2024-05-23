<?php
include('db_connection.php');

// Check if TherapistID is set
if(isset($_REQUEST['TherapistID'])) {
    $TherapistID = $_REQUEST['TherapistID'];
    
    $stmt = $connection->prepare("SELECT * FROM therapists WHERE TherapistID=?");
    $stmt->bind_param("i", $TherapistID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['TherapistID'];
        $y = $row['UserID'];
        $z = $row['Specialization'];
        $a = $row['ExperienceYears'];
        $b = $row['Availability'];
        $c = $row['LicenseNumber'];
        $d = $row['Certification'];
    } else {
        echo "Therapist not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Record in Therapists Table</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update therapists form -->
    <h2><u>Update Form for Therapists</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">

  
        <label for="UserID">UserID:</label>
        <input type="number" name="UserID" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="Specialization">Specialization:</label>
        <input type="text" name="Specialization" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>
        
        <label for="ExperienceYears">ExperienceYears:</label>
        <input type="text" name="ExperienceYears" value="<?php echo isset($a) ? $a : ''; ?>">
        <br><br>
        
        <label for="Availability">Availability:</label>
        <input type="text" name="Availability" value="<?php echo isset($b) ? $b : ''; ?>">
        <br><br>
        
        <label for="LicenseNumber">LicenseNumber:</label>
        <input type="text" name="LicenseNumber" value="<?php echo isset($c) ? $c : ''; ?>">
        <br><br>
        
        <label for="Certification">Certification:</label>
        <input type="text" name="Certification" value="<?php echo isset($d) ? $d : ''; ?>">
        <br><br>
        
        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
  
    $UserID = $_POST['UserID'];
    $Specialization = $_POST['Specialization'];
    $ExperienceYears = $_POST['ExperienceYears'];
    $Availability = $_POST['Availability'];
    $LicenseNumber = $_POST['LicenseNumber'];
    $Certification = $_POST['Certification'];
    
    // Update the therapist in the database
    $stmt = $connection->prepare("UPDATE therapists SET UserID=?, Specialization=?, ExperienceYears=?, Availability=?, LicenseNumber=?, Certification=? WHERE TherapistID=?");
    $stmt->bind_param("ississs", $UserID, $Specialization, $ExperienceYears, $Availability, $LicenseNumber, $Certification, $TherapistID);
    $stmt->execute();
    
    // Redirect to therapists.php
    header('Location: therapists.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
