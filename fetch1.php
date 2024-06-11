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

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get values from form
    $firstname = $_POST['firstname'];
    $dob = $_POST['dob'];

    // Prepare SQL query to fetch details based on name and dob
    $sql = "SELECT * FROM details WHERE firstname = '$firstname' AND dob = '$dob'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Display fetched details
        while ($row = $result->fetch_assoc()) {
            echo "<h2>Details Found:</h2>";
            echo "<p>First Name: " . $row['firstname'] . "</p>";
            echo "<p>Last Name: " . $row['lastname'] . "</p>";
            echo "<p>Email: " . $row['email'] . "</p>";
            echo "<p>Phone: " . $row['phone'] . "</p>";
            echo "<p>Date of Birth: " . $row['dob'] . "</p>";
            echo "<p>Kula: " . $row['kula'] . "</p>";
            echo "<p>Gotra: " . $row['gotra'] . "</p>";
            echo "<p>Kula Devatha: " . $row['kula_devatha'] . "</p>";
            echo "<p>Father Name: " . $row['father_name'] . "</p>";
            echo "<p>Mother Name: " . $row['mother_name'] . "</p>";
            echo "<p>Native: " . $row['native'] . "</p>";
            echo "<p>Current Address: " . $row['current_address'] . "</p>";
            echo "<p>Number of Siblings: " . $row['num_siblings'] . "</p>";

            // Fetch and display sibling details based on userId
            $userId = $row['id'];
            $sql_siblings = "SELECT * FROM sibling_details WHERE userId = '$userId'";
            $result_siblings = $conn->query($sql_siblings);

            if ($result_siblings->num_rows > 0) {
                echo "<h3>Sibling Details:</h3>";
                while ($sibling = $result_siblings->fetch_assoc()) {
                    echo "<p>Sibling Name: " . $sibling['siblingName'] . "</p>";
                    echo "<p>Relation: " . $sibling['siblingRelation'] . "</p>";
                    echo "<p>Gender: " . $sibling['siblingGender'] . "</p>";
                }
            } else {
                echo "No sibling details found.";
            }
            echo '<a href="index1.php"><button>Home</button></a>';
        }
    } else {
        echo "No details found for the provided name and date of birth.";
    }
}

$conn->close();
