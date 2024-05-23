<?php
// Check if the 'query' GET parameter is set
if (isset($_GET['query']) && !empty($_GET['query'])) {

 include('db_connection.php');

    // Sanitize input to prevent SQL injection
    $searchTerm = $connection->real_escape_string($_GET['query']);

    // Queries for different tables
    $queries = [
        'appointments' => "SELECT  AppointmentID FROM appointments WHERE AppointmentID LIKE '%$searchTerm%'",
        'clients' => "SELECT ClientID FROM clients WHERE ClientID LIKE '%$searchTerm%'",
        'exercises' => "SELECT  Name FROM exercises WHERE  Name LIKE '%$searchTerm%'",
        'feedback' => "SELECT  FeedbackID FROM feedback WHERE FeedbackID LIKE '%$searchTerm%'",
        'payments' => "SELECT PaymentMethod FROM payments WHERE PaymentMethod LIKE '%$searchTerm%'",
         'notifications' => "SELECT NotificationType FROM notifications WHERE NotificationType LIKE '%$searchTerm%'",
        'sessions' => "SELECT SessionID FROM sessions WHERE SessionID LIKE '%$searchTerm%'",
        'therapistavailabilities' => "SELECT Day_of_week FROM therapistavailabilities WHERE  Day_of_week LIKE '%$searchTerm%'",
        'therapists' => "SELECT TherapistID FROM therapists WHERE TherapistID LIKE '%$searchTerm%'",
    ];

    // Output search results
    echo "<h2><u>Search Results:</u></h2>";

    foreach ($queries as $table => $sql) {
        $result = $connection->query($sql);
        echo "<h3>Table of $table:</h3>";
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<p>" . $row[array_keys($row)[0]] . "</p>"; // Dynamic field extraction from result
            }
        } else {
            echo "<p>No results found in $table matching the search term: '$searchTerm'</p>";
        }
    }

    // Close the connection
    $connection->close();
} else {
    echo "<p>No search term was provided.</p>";
}
?>



