<?php
header('Location: /wondr-buildr/index.php');

// MySQL server location and credentials
$servername = "sql.mit.edu";
$username = "kadauber";
$password = "racetoillumination";

// Connect to the MySQL Server.
try {

    $conn = new PDO("mysql:host=$servername;dbname=kadauber+Wonders", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Try to submit a wonder to the database
if (isset($_POST['submit'])) {
    // Assign appropriate variables
    $name = $_POST['name'];
    $owner = $_POST['owner'];
    $axiom = $_POST['axiom'];
    $rank = $_POST['rank'];

    // Sanitize user inputs by escaping them (also adds appropriate single quotes)
    $name = $conn->quote($name);
    $owner = $conn->quote($owner);
    $axiom = $conn->quote($axiom);
    $rank = $conn->quote($rank);

    // Submit a wonder through the connection
    $statement = $conn->prepare("insert into Wonders (Name, Owner, Axiom, Rank) values ({$name},{$owner},{$axiom},{$rank})");
    $statement->execute();
}

exit;
?>
