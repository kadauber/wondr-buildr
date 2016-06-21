<?php
// Allow a user to login with their username and password by checking it against
// accounts in the database $conn connects to. DO NOT save a users password.
function login($username, $password, $conn) {
    // Using prepared statements protects against SQL injection.
    if ($statement = $conn->prepare("select ID, Password from Users where Username = :username limit 1")) {
        // Bind the username argument to the username in the query
        $statement->bindParam(':username', $username, PDO::PARAM_STR);
        $statement->execute();

        $statement->setFetchMethod(PDO::FETCH_BOUND); // Map fetched data to bound variables
        $statement->bindColumn('ID', $user_id);
        $statement->bindColumn('Password', $db_password);
        $statement->fetch();

        if ($statement->rowCount() == 1) { // Check if this username was in the database

            // Check if the password in the database matches the password
            // submitted. Use password_verify to avoid timing attacks.
            if (password_verify($password, $db_password)) {
                // The password was correct

                // Get the user's user-agent string
                $user_browser = $_SERVER['HTTP_USER_AGENT'];

		// Something about XSS protection when printing?
		$user_id = preg_replace("/[^0-9]+/", "", $user_id);
		$_SESSION['user_id'] = $user_id;

		// More XSS protection
		$username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $username);
		$_SESSION['username'] = $username;
		// We can use this later for verification that a user is logged in
		$_SESSION['login_string'] = hash('sha512', $db_password . $user_browser);

		// The login was successful
		return true;

            } else {
                // The password was not correct
                return false;
            }

        } else { // There was no user with this username
            return false;
        }
    }
}

// Check whether a user is logged in by checking the user_id and login_string of SESSION
function login_check($conn) {

    // Check that session variables are set
    if (isset($_SESSION['user_id'], $_SESSION['username'], $_SESSION['login_string'])) {
	$user_id = $_SESSION['user_id'];
	$login_string = $_SESSION['login_string'];
	$username = $_SESSION['username'];

	// Try to create a statement connected to the database
        if ($statement->prepare("select Password from Users where ID = :user_id limit 1")) {

	    // Bind the id of the allegedly logged in user to the query
	    $statement->bindParam(':user_id', $user_id);
	    $statement->execute();

	    // Check that there is a user with that user_id
	    if ($statement->rowCount() == 1) {

		// Get the password hash of the user with that user id
		$statement->setFetchMethod(PDO::FETCH_BOUND);
		$statement->bindColumn('Password', $password);
		$statement->fetch();
		// Recreate the hash of the password hash and browser information
		$login_check = hash('sha512', $password . $user_browser);

		// Check that the session and recalculated hashes are the same
		if (hash_equals($login_check, $login_string)) {
		    // This user is logged in
		    return true;
		} else { // This user isn't logged in
		    return false;
		}

	    } else { // session parameters not set
		return false;
            }
        } else { // statement could not be prepared
            return false;
        }
    } else { // session variables were  not set
        return false;
    }
}
?>
