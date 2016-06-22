<?php
require_once 'resources/config.php'; // include this line during development
// include_once '~/web_scripts_config/config.php'; // include this line during production

// Return a connection to the MySQL Server kadauber+Wonders database.
function connect_to_database() {
    try {
	$data_source_name = "mysql:host=" . DATABASE_HOST . ";dbname=" . DATABASE;
	$conn = new PDO($data_source_name, USERNAME, PASSWORD);
	// set the PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	return $conn;

    } catch (PDOException $e) {
	echo "Error: " . $e->getMessage();
    }
}

?>
