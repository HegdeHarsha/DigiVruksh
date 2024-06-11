<?php
session_start();
include("connection.php");
include("functions.php");

$user_data = check_login($con);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" type="text/css" href="form.css" />
  <title>Enter Details</title>
  <script>
    function validatePhoneNumber(input) {
    var phoneError = document.getElementById("phoneError");
    var inputValue = input.value.trim(); // Get the trimmed value (remove leading/trailing spaces)

    // Validate if the input consists only of digits
    if (!/^\d+$/.test(inputValue)) {
      phoneError.textContent = "Please enter numbers only";
    } else {
      phoneError.textContent = ""; // Clear error message if input is valid
    }
  }
    // JavaScript function to generate sibling input fields dynamically
    function generateSiblingFields() {
      // Get the number of siblings selected from the dropdown
      var numSiblings = document.getElementById("numSiblings").value;
      var siblingsContainer = document.getElementById("siblingsContainer");

      // Clear any previously generated fields
      siblingsContainer.innerHTML = "";

      // Generate input fields based on the number of siblings
      for (var i = 1; i <= numSiblings; i++) {
        // Create a div element to hold the sibling information
        var siblingDiv = document.createElement("div");

        // Create input fields for sibling's name, relation, and gender
        siblingDiv.innerHTML = `
                    <h3>Sibling ${i}</h3>
                    <label for="siblingName${i}">Name:</label>
                    <input type="text" id="siblingName${i}" name="siblingName${i}" required=""><br>
                    <label for="siblingRelation${i}">Relation:</label>
                    <select id="siblingRelation${i}" name="siblingRelation${i}" required="">
                        <option value="elder_brother">Elder Brother</option>
                        <option value="elder_sister">Elder Sister</option>
                        <option value="older_sister">Older Sister</option>
                        <option value="older_brother">Older Brother</option>
                    </select><br>
                    <label for="siblingGender${i}">Gender:</label>
                    <input type="radio" id="siblingGender${i}_male" name="siblingGender${i}[]" value="male"> Male
                    <input type="radio" id="siblingGender${i}_female" name="siblingGender${i}[]" value="female"> Female
                    <input type="radio" id="siblingGender${i}_other" name="siblingGender${i}[]" value="other"> Other
                `;

        // Append the siblingDiv to the siblingsContainer
        siblingsContainer.appendChild(siblingDiv);
      }
    }

    // JavaScript function to reload the page after form submission
  </script>
</head>

<body>
  <form id="detailsForm" action="process_form.php" method="post" class="form" onsubmit="handleSubmit(event)">
    <p class="title">Enter Details</p>
    <p class="message">Please enter proper details below</p>
    <div class="flex">
      <label for="firstname">
        <input name="firstname" id="fistname" required="" placeholder="" type="text" class="input" />
        <span>Firstname</span>
      </label>

      <label for="lastname">
        <input name="lastname" id="lastname" required="" placeholder="" type="text" class="input" />
        <span>Lastname</span>
      </label>
    </div>

    <label for="email">
      <input name="email" id="email" required="" placeholder="" type="email" class="input" />
      <span>Email</span>
    </label>

    <label for="phone">
  <input name="phone" id="phone" placeholder="" type="text" class="input" maxlength="10" oninput="validatePhoneNumber(this)" />
  <span>Phone</span>
  <span id="phoneError" class="error"></span>
</label>


    <label for="dob">
      <input name="dob" id="dob" required="" type="date" class="input" />
      <!-- <span>DOB</span> -->
    </label>

    <label for="kula">
      <input name="kula" id="kula" required="" placeholder="" type="text" class="input" />
      <span>Kula</span>
    </label>

    <label for="gotra">
      <input name="gotra" id="gotra" required="" placeholder="" type="text" class="input" />
      <span>Gotra</span>
    </label>

    <label for="kuladevatha">
      <input name="kuladevatha" id="kuladevatha" required="" placeholder="" type="text" class="input" />
      <span>Kula Devatha</span>
    </label>

    <label for="fathername">
      <input name="fathername" id="fathername" required="" placeholder="" type="text" class="input" />
      <span>Father name</span>
    </label>

    <label for="mothername">
      <input name="mothername" id="mothername" required="" placeholder="" type="text" class="input" />
      <span>Mother Name</span>
    </label>

    <label for="native">
      <input name="native" id="native" required="" placeholder="" type="text" class="input" />
      <span>Native</span>
    </label>

    <label for="currentaddress">
      <input name="currentaddress" id="currentaddress" required="" placeholder="" type="text" class="input" />
      <span>Current Address</span>
    </label>

    <label for="numSiblings">Number of Siblings:</label>
    <select id="numSiblings" name="numSiblings" onchange="generateSiblingFields()">
      <option value="">Select</option>
      <?php
      for ($i = 1; $i <= 12; $i++) {
        echo "<option value='$i'>$i</option>";
      }
      ?>
    </select><br />

    <div id="siblingsContainer"></div>

    <input type="submit" value="Submit" />
  </form>
</body>

</html>