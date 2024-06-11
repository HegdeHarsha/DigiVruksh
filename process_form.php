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

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    // Check if email already exists
    $check_email_sql = "SELECT * FROM details WHERE email = '$email'";
    $result = $conn->query($check_email_sql);

    if ($result->num_rows > 0) {
        // Email already exists, show error message and redirect
        echo '<script>alert("Error: Email already exists. Please use a different email."); window.location.href = "form.php";</script>';
    } else {
        // Email does not exist, proceed with inserting the details
        $insert_details_sql = "INSERT INTO details (firstname, lastname, email, phone, dob, kula, gotra, kula_devatha, father_name, mother_name, native, current_address, num_siblings) 
                                VALUES ('$firstname', '$lastname', '$email', '$phone', '$dob', '$kula', '$gotra', '$kuladevatha', '$fathername', '$mothername', '$native', '$currentaddress', '$numSiblings')";

        if ($conn->query($insert_details_sql) === TRUE) {
            $user_id = $conn->insert_id; // Get the ID of the last inserted record (details table)

            // Insert sibling details into 'sibling_details' table
            for ($i = 1; $i <= $numSiblings; $i++) {
                $siblingName = $_POST["siblingName$i"];
                $siblingRelation = $_POST["siblingRelation$i"];
                $siblingGender = $_POST["siblingGender$i"][0]; // Get the selected gender (radio button)

                $insert_sibling_sql = "INSERT INTO sibling_details (userId, siblingName, siblingRelation, siblingGender) 
                                        VALUES ('$user_id', '$siblingName', '$siblingRelation', '$siblingGender')";

                if ($conn->query($insert_sibling_sql) !== TRUE) {
                    echo '<script>alert("Error inserting sibling details: ' . $conn->error . '"); window.location.href = "form.php";</script>';
                }
            }

            echo '<script>alert("Form submitted successfully!"); window.location.href = "index1.php";</script>';
        } else {
            echo '<script>alert("Error: Form submission failed."); window.location.href = "form.php";</script>';
        }
    }

    $conn->close(); // Close the database connection
} else {
    // If form submission method is not POST
    echo "Form submission method not allowed.";
}
