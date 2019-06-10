<?php
include("config.php");

// Now we check if the data was submitted, isset() function will check if the data exists.
if (!isset($_POST['userName'], $_POST['userPassword'], $_POST['userEmail'])) {
    // Could not get the data that should have been sent.
    die ('Please complete the registration form!' );
}
// Make sure the submitted registration values are not empty.
if (empty($_POST['userName']) || empty($_POST['userPassword']) || empty($_POST['userEmail'])) {
	// One or more values are empty.
   die ('Please complete the registration form');
}

// We need to check if the account with that username exists.
if ($stmt = $con->prepare('SELECT id, password FROM users WHERE username = ?')) {
    if (!filter_var($_POST['userEmail'], FILTER_VALIDATE_EMAIL)) {
        die ('Email is not valid!');
    }
    if (preg_match('/[A-Za-z0-9]+/', $_POST['userName']) == 0) {
        die ('Username is not valid!');
    }
    if (strlen($_POST['userPassword']) > 20 || strlen($_POST['userPassword']) < 5) {
        die ('Password must be between 5 and 20 characters long!');
    }
	// Bind parameters (s = string, i = int, b = blob, etc), hash the password using the PHP password_hash function.
	$stmt->bind_param('s', $_POST['userName']);
	$stmt->execute();
	$stmt->store_result();
	// Store the result so we can check if the account exists in the database.
	if ($stmt->num_rows > 0) {
        // Username already exists
        header("Location: ../signup.php?message=Username exists, please choose another!");
	} else {
        // Username doesnt exists, insert new account
    if ($stmt = $con->prepare('INSERT INTO users (username, password, email) VALUES (?, ?, ?)')) {
	      // We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in.
          $password = md5($_POST['userPassword']);
	      $stmt->bind_param('sss', $_POST['userName'], $password, $_POST['userEmail']);
          $stmt->execute();
          header("Location: ../login.php?message=You have successfully registered, you can now login");
      } else {
	     // Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
	     echo 'Could not prepare statement!';
       }

	}
	$stmt->close();
} else {
	// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
	echo 'Could not prepare statement!';
}
$con->close();
?>