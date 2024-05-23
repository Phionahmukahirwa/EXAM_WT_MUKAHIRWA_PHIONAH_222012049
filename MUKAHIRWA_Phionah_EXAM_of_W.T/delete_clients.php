<?php
include('db_connection.php');

// Check if ClientID is set
if(isset($_REQUEST['ClientID'])) {
    $ClientID = $_REQUEST['ClientID'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM clients WHERE ClientID=?");
    $stmt->bind_param("i", $ClientID);
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
        <input type="hidden" name="ClientID" value="<?php echo $ClientID; ?>">
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
    echo "Client ID is not set.";
}

$connection->close();
?>
