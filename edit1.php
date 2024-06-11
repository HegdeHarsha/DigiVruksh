<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Details</title>
</head>

<body>
    <h2>Edit Details</h2>

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
            // Display fetched details within an editable form
            while ($row = $result->fetch_assoc()) {
    ?>
                <form action="update.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <label for="firstname">
                        <span>Firstname</span>
                        <input name="firstname" id="firstname" type="text" class="input" value="<?php echo $row['firstname']; ?>" required><br>
                    </label>

                    <label for="lastname">
                        <span>Lastname</span>
                        <input name="lastname" id="lastname" type="text" class="input" value="<?php echo $row['lastname']; ?>" required><br>
                    </label>

                    <label for="email">
                        <span>Email</span>
                        <input name="email" id="email" type="email" class="input" value="<?php echo $row['email']; ?>" required><br>
                    </label>

                    <label for="phone">
                        <span>Phone</span>
                        <input name="phone" id="phone" type="number" class="input" value="<?php echo $row['phone']; ?>" required><br>
                    </label>

                    <label for="dob">
                        <span>Date of Birth</span>
                        <input name="dob" id="dob" type="date" class="input" value="<?php echo $row['dob']; ?>" required><br>
                    </label>

                    <label for="kula">
                        <span>Kula</span>
                        <input name="kula" id="kula" type="text" class="input" value="<?php echo $row['kula']; ?>" required><br>
                    </label>

                    <label for="gotra">
                        <span>Gotra</span>
                        <input name="gotra" id="gotra" type="text" class="input" value="<?php echo $row['gotra']; ?>" required><br>
                    </label>

                    <label for="kuladevatha">
                        <span>Kula Devatha</span>
                        <input name="kuladevatha" id="kuladevatha" type="text" class="input" value="<?php echo $row['kula_devatha']; ?>" required><br>
                    </label>

                    <label for="fathername">
                        <span>Father name</span>
                        <input name="fathername" id="fathername" type="text" class="input" value="<?php echo $row['father_name']; ?>" required><br>
                    </label>

                    <label for="mothername">
                        <span>Mother Name</span>
                        <input name="mothername" id="mothername" type="text" class="input" value="<?php echo $row['mother_name']; ?>" required><br>
                    </label>

                    <label for="native">
                        <span>Native</span>
                        <input name="native" id="native" type="text" class="input" value="<?php echo $row['native']; ?>" required><br>
                    </label>

                    <label for="currentaddress">
                        <span>Current Address</span>
                        <input name="currentaddress" id="currentaddress" type="text" class="input" value="<?php echo $row['current_address']; ?>" required><br>
                    </label>

                    <label for="numSiblings"></label>
                    <input type="hidden" id="numSiblings" name="numSiblings" value="<?php echo $row['num_siblings']; ?>" required><br>

                    <!-- Fetch and display sibling details based on userId -->
                    <?php
                    $userId = $row['id'];
                    $sql_siblings = "SELECT * FROM sibling_details WHERE userId = '$userId'";
                    $result_siblings = $conn->query($sql_siblings);

                    if ($result_siblings->num_rows > 0) {
                        echo "<h3>Sibling Details:</h3>";
                        while ($sibling = $result_siblings->fetch_assoc()) {
                    ?>
                            <div>
                                <label for="siblingName">Sibling Name:</label>
                                <input type="text" id="siblingName" name="siblingName[]" value="<?php echo $sibling['siblingName']; ?>" required><br>

                                <label for="siblingRelation">Relation:</label>
                                <select id="siblingRelation" name="siblingRelation[]" required>
                                    <option value="elder_brother" <?php if ($sibling['siblingRelation'] === 'elder_brother') echo 'selected'; ?>>Elder Brother</option>
                                    <option value="elder_sister" <?php if ($sibling['siblingRelation'] === 'elder_sister') echo 'selected'; ?>>Elder Sister</option>
                                    <option value="younger_brother" <?php if ($sibling['siblingRelation'] === 'younger_brother') echo 'selected'; ?>>Younger Brother</option>
                                    <option value="younger_sister" <?php if ($sibling['siblingRelation'] === 'younger_sister') echo 'selected'; ?>>Younger Sister</option>
                                </select><br>

                                <label for="siblingGender">Gender:</label>
                                <select name="siblingGender[]" required>
                                    <option value="male" <?php if ($sibling['siblingGender'] == 'male') echo 'selected'; ?>>Male</option>
                                    <option value="female" <?php if ($sibling['siblingGender'] == 'female') echo 'selected'; ?>>Female</option>
                                    <option value="other" <?php if ($sibling['siblingGender'] == 'other') echo 'selected'; ?>>Other</option>
                                </select><br>
                            </div>
                    <?php
                        }
                    }
                    ?>

                    <input type="submit" value="Update Details">
                </form>
    <?php
            }
        } else {
            echo "No details found for the provided name and date of birth.";
        }
    }

    $conn->close();
    ?>
</body>

</html>