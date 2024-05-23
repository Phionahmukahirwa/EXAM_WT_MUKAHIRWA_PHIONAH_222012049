<?php
include('db_connection.php');

// Check if TherapistID is set
if(isset($_REQUEST['TherapistID'])) {
    $TherapistID = $_REQUEST['TherapistID'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM therapists WHERE TherapistID=?");
    $stmt->bind_param("i", $TherapistID);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Delete Record</title>
    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this record?");
        }
    </script>
</head>
<body>
    <form method="post" onsubmit="return confirmDelete();">
        <input type="hidden" name="TherapistID" value="<?php echo $TherapistID; ?>">
        <input type="submit" value="Delete">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($stmt->execute()) {
            echo "Record deleted successfully.";
        } else {
            echo "Error deleting data: " . $stmt->error;
        }
    }
    ?>
</body>
</html>
<?php

    $stmt->close();
} else {
    echo "Therapist ID is not set.";
}

$connection->close();
?>
