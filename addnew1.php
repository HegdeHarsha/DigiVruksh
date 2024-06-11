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

// Process form submission from fetch_details.html
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user details from the form
    $name = $_POST['firstname'];
    $dob = $_POST['dob'];

    // Fetch user details based on name and date of birth
    $sql_fetch_user = "SELECT * FROM details WHERE firstname = '$name' AND dob = '$dob'";
    $result_fetch_user = $conn->query($sql_fetch_user);

    if ($result_fetch_user->num_rows > 0) {
        // User details found, display form to add sibling details
        $row = $result_fetch_user->fetch_assoc();
        $userId = $row['id'];
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Add Sibling Details</title>
        </head>

        <body>
            <h2>Add Sibling Details</h2>

            <form action="process_add_sibling.php" method="post">
                <input type="hidden" name="userId" value="<?php echo $userId; ?>">

                <label for="siblingName">Sibling Name:</label>
                <input type="text" id="siblingName" name="siblingName" required /><br />

                <label for="relation">Relation:</label>
                <select id="relation" name="relation" required>
                    <option value="elder_brother">Elder Brother</option>
                    <option value="elder_sister">Elder Sister</option>
                    <option value="older_brother">Older Brother</option>
                    <option value="older_sister">Older Sister</option>
                </select><br />

                <label for="gender">Gender:</label>
                <select id="gender" name="gender" required>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select><br />

                <input type="submit" value="Add Sibling" />
            </form>
        </body>

        </html>
<?php
    } else {
        echo "No details found for the provided name and date of birth.";
    }
}

$conn->close();
?>