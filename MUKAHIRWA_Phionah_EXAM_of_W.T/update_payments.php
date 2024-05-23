<?php
include('db_connection.php');

// Check if PaymentID is set
if(isset($_REQUEST['PaymentID'])) {
    $PaymentID = $_REQUEST['PaymentID'];
    
    $stmt = $connection->prepare("SELECT * FROM payments WHERE PaymentID=?");
    $stmt->bind_param("i", $PaymentID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['PaymentID'];
        $y = $row['ClientID'];
        $z = $row['TherapistID'];
        $a = $row['Amount'];
        $b = $row['PaymentDate'];
        $c = $row['PaymentStatus'];
        $d = $row['PaymentMethod'];
        $e = $row['TransactionID'];
    } else {
        echo "Payment not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Record in Payments Table</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update payments form -->
    <h2><u>Update Form for Payments</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">

        <label for="ClientID">ClientID:</label>
        <input type="number" name="ClientID" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="TherapistID">TherapistID:</label>
        <input type="number" name="TherapistID" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="Amount">Amount:</label>
        <input type="number" name="Amount" value="<?php echo isset($a) ? $a : ''; ?>">
        <br><br>

        <label for="PaymentDate">PaymentDate:</label>
        <input type="date" name="PaymentDate" value="<?php echo isset($b) ? $b : ''; ?>">
        <br><br>

        <label for="PaymentStatus">PaymentStatus:</label>
        <input type="text" name="PaymentStatus" value="<?php echo isset($c) ? $c : ''; ?>">
        <br><br>

        <label for="PaymentMethod">PaymentMethod:</label>
        <input type="text" name="PaymentMethod" value="<?php echo isset($d) ? $d : ''; ?>">
        <br><br>

        <label for="TransactionID">TransactionID:</label>
        <input type="text" name="TransactionID" value="<?php echo isset($e) ? $e : ''; ?>">
        <br><br>
        
        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $ClientID = $_POST['ClientID'];
    $TherapistID = $_POST['TherapistID'];
    $Amount = $_POST['Amount'];
    $PaymentDate = $_POST['PaymentDate'];
    $PaymentStatus = $_POST['PaymentStatus'];
    $PaymentMethod = $_POST['PaymentMethod'];
    $TransactionID = $_POST['TransactionID'];
    
    // Update the payment in the database
    $stmt = $connection->prepare("UPDATE payments SET ClientID=?, TherapistID=?, Amount=?, PaymentDate=?, PaymentStatus=?, PaymentMethod=?, TransactionID=? WHERE PaymentID=?");
    $stmt->bind_param("iiissssi", $ClientID, $TherapistID, $Amount, $PaymentDate, $PaymentStatus, $PaymentMethod, $TransactionID, $PaymentID);
    $stmt->execute();
    
    // Redirect to payments.php
    header('Location: payments.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
