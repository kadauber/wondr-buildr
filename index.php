<!DOCTYPE html>
<html>
<head>
    <title>Wondr Buildr</title>
</head>
<body style="font-family:Courier New">
    <h1>Wondr Buildr</h1>
    <p>Welcome to Wondr Buildr. Go build some wonders.</p>
    <?php
        echo "<p>You might even be able to see your wonders here someday, if I try hard and believe in myself.</p>";
        
        $servername = "sql.mit.edu";
        $username = "kadauber";
        $password = "0012MOAIKate";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=kadauber+Wonders", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "<p>Connected to the Wonders database.</p>";

            $statement = $conn->prepare("select * from Wonders");
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_NUM);
            $result = $statement->fetchAll();
            foreach ($result as $row) { 
                echo "<p>";
                foreach ($row as $field) {
                    echo $field . " ";
                }
                echo "</p>";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    ?>
</body>
</html>
