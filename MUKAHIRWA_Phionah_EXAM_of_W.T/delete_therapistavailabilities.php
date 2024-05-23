<?php
include('db_connection.php');

// Check if Availability_id is set
if(isset($_REQUEST['Availability_id'])) {
    $Availability_id = $_REQUEST['Availability_id'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM therapistavailabilities WHERE Availability_id=?");
    $stmt->bind_param("i", $Availability_id);
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
        <input type="hidden" name="Availability_id" value="<?php echo $Availability_id; ?>">
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
    echo "Availability ID is not set.";
}

$connection->close();
?>
