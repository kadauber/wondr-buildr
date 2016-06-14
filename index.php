<!DOCTYPE html>
<html>
<head>
    <title>Wondr Buildr</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="wrapper">
    <h1>Wondr Buildr</h1>
    <p>Welcome to Wondr Buildr. Let's build some wonders.</p>
    <?php
        // MySQL server location and credentials
        $servername = "sql.mit.edu";
        $username = "kadauber";
        $password = "0012MOAIKate";

        // Connect to the MySQL Server.
        try {

            $conn = new PDO("mysql:host=$servername;dbname=kadauber+Wonders", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

    ?>

    <table>
	<tr>
	    <th>Name</th>
	    <th>Owner</th>
	    <th>Axiom</th>
	    <th>Rank</th>
	</tr>

    <?php

	// Get existing wonders from database
	$statement = $conn->prepare("select Name, Owner, Axiom, Rank from Wonders order by Owner");
	$statement->execute();
	$statement->setFetchMode(PDO::FETCH_NUM);
	$result = $statement->fetchAll();

        // Print every row with a wonder
        foreach ($result as $row) {
	    printWonderRow($row);
	}

        // Take a row of the table in FETCH_NUM mode and print it
        // as a table row
        function printWonderRow($row) {
            echo "<tr>";
            foreach ($row as $field) {
                echo "<td>" . dotParse($field) . "</td>";
            }
            echo "</tr>";
        }

        function dotParse($field){
          if(is_numeric($field)){
            $count = intval($field);
            $dots = '';
            for($i=0; $i<$count; $i++){
              $dots = $dots.'●';
            }
            return $dots;
          }else{
            return $field;
          }
        }

    ?>

    <form action="submit_wonder.php" method="post"><tr class="entry">
	<td><input type="text" name="name" placeholder="Name"></td>
	<td><input type="text" name="owner" placeholder="Owner"></td>
	<td>
	    <select name="Axiom">
		<option value="Apocalypsi">Apocalypsi</option>
		<option value="Automata">Automata</option>
		<option value="Epikrato">Epikrato</option>
		<option value="Exelixi">Exelixi</option>
		<option value="Katastrofi">Katastrofi</option>
		<option value="Metaptropi">Metaptropi</option>
		<option value="Prostasia">Prostasia</option>
		<option value="Skafoi">Skafoi</option>
	    </select>
	</td>
	<td>
	    <select name="Rank">
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
		<option value="5">5</option>
	    </select>
	</td>
    </tr></form>
    </table>
    <br>
    <p>And maybe, just maybe, you'll be able to add your own wonders to the list. You never know.</p>
  </div>
</body>
</html>
