<?php
// Establish database connection (replace these values with your database credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "digivruksh";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form submission from addnew.php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_POST['userId'];
    $siblingName = $_POST['siblingName'];
    $relation = $_POST['relation'];
    $gender = $_POST['gender'];

    // Insert sibling details into sibling_details table
    $sql_add_sibling = "INSERT INTO sibling_details (userId, siblingName, siblingRelation, siblingGender)
                        VALUES ('$userId', '$siblingName', '$relation', '$gender')";

    if ($conn->query($sql_add_sibling) === TRUE) {
        // Increment num_siblings count in details table
        $sql_update_num_siblings = "UPDATE details SET num_siblings = num_siblings + 1 WHERE id = '$userId'";
        if ($conn->query($sql_update_num_siblings) === TRUE) {
            // Display JavaScript alert and redirect
            echo '<script>alert("Sibling details added successfully!"); window.location.href = "fetch.php";</script>';
        } else {
            // Display error message
            echo '<script>alert("Error updating num_siblings count: ' . $conn->error . '"); window.location.href = "addnew.php";</script>';
        }
    } else {
        // Display error message
        echo '<script>alert("Error adding sibling details: ' . $conn->error . '"); window.location.href = "addnew.php";</script>';
    }
}

$conn->close();
