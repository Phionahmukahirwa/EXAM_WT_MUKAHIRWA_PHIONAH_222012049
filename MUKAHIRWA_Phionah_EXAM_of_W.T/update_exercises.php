<?php
include('db_connection.php');

// Check if ExerciseID is set
if(isset($_REQUEST['ExerciseID'])) {
    $ExerciseID = $_REQUEST['ExerciseID'];
    
    $stmt = $connection->prepare("SELECT * FROM exercises WHERE ExerciseID=?");
    $stmt->bind_param("i", $ExerciseID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $Name = $row['Name'];
        $Description = $row['Description'];
        $DifficultyLevel = $row['DifficultyLevel'];
        $AudioFile = $row['AudioFile'];
        $ImageOrVideo = $row['ImageOrVideo'];
        $Instructions = $row['Instructions'];
    } else {
        echo "Exercise not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Record in Exercises Table</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update exercises form -->
    <h2><u>Update Form for Exercises</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="Name">Name:</label>
        <input type="text" name="Name" value="<?php echo isset($Name) ? $Name : ''; ?>">
        <br><br>
        <label for="Description">Description:</label>
        <textarea name="Description"><?php echo isset($Description) ? $Description : ''; ?></textarea>
        <br><br>
        <label for="DifficultyLevel">Difficulty Level:</label>
        <input type="text" name="DifficultyLevel" value="<?php echo isset($DifficultyLevel) ? $DifficultyLevel : ''; ?>">
        <br><br>
        <label for="AudioFile">Audio File:</label>
        <input type="text" name="AudioFile" value="<?php echo isset($AudioFile) ? $AudioFile : ''; ?>">
        <br><br>
        <label for="ImageOrVideo">Image or Video:</label>
        <input type="text" name="ImageOrVideo" value="<?php echo isset($ImageOrVideo) ? $ImageOrVideo : ''; ?>">
        <br><br>
        <label for="Instructions">Instructions:</label>
        <textarea name="Instructions"><?php echo isset($Instructions) ? $Instructions : ''; ?></textarea>
        <br><br>
        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $Name = $_POST['Name'];
    $Description = $_POST['Description'];
    $DifficultyLevel = $_POST['DifficultyLevel'];
    $AudioFile = $_POST['AudioFile'];
    $ImageOrVideo = $_POST['ImageOrVideo'];
    $Instructions = $_POST['Instructions'];
    
    // Update the exercise in the database
    $stmt = $connection->prepare("UPDATE exercises SET Name=?, Description=?, DifficultyLevel=?, AudioFile=?, ImageOrVideo=?, Instructions=? WHERE ExerciseID=?");
    $stmt->bind_param("sssissi", $Name, $Description, $DifficultyLevel, $AudioFile, $ImageOrVideo, $Instructions, $ExerciseID);
    $stmt->execute();
    
    // Redirect to view_exercises.php
    header('Location: exercises.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
