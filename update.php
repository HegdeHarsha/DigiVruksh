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
    // Retrieve values from form
    $id = $_POST['id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $dob = $_POST['dob'];
    $kula = $_POST['kula'];
    $gotra = $_POST['gotra'];
    $kuladevatha = $_POST['kuladevatha'];
    $fathername = $_POST['fathername'];
    $mothername = $_POST['mothername'];
    $native = $_POST['native'];
    $currentaddress = $_POST['currentaddress'];
    $numSiblings = $_POST['numSiblings'];

    // Update main details in 'details' table
    $sql_update_details = "UPDATE details 
                           SET firstname = '$firstname', lastname = '$lastname', email = '$email', phone = '$phone', dob = '$dob', kula = '$kula', gotra = '$gotra', kula_devatha = '$kuladevatha', father_name = '$fathername', mother_name = '$mothername', native = '$native', current_address = '$currentaddress', num_Siblings = '$numSiblings' 
                           WHERE id = '$id'";

    if ($conn->query($sql_update_details) === TRUE) {
        // Delete existing sibling details for the user
        $sql_delete_siblings = "DELETE FROM sibling_details WHERE userId = '$id'";
        $conn->query($sql_delete_siblings);

        // Insert updated sibling details into 'sibling_details' table
        for ($i = 0; $i < $numSiblings; $i++) {
            $siblingName = $_POST['siblingName'][$i];
            $siblingRelation = $_POST['siblingRelation'][$i];
            $siblingGender = $_POST['siblingGender'][$i];

            $sql_insert_sibling = "INSERT INTO sibling_details (userId, siblingName, siblingRelation, siblingGender) 
                                   VALUES ('$id', '$siblingName', '$siblingRelation', '$siblingGender')";
            $conn->query($sql_insert_sibling);
        }

        // Display JavaScript alert and redirect
        echo '<script>alert("Details updated successfully!"); window.location.href = "fetch.php";</script>';
    } else {
        // Display error message
        echo '<script>alert("Error updating details: ' . $conn->error . '"); window.location.href = "edit.php";</script>';
    }
}

$conn->close();
