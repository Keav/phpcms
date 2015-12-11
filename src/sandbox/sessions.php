<?php

  session_start();

  // 1. Create a databse connection
  $dbhost = "localhost";
  $dbuser = "root";
  $dbpass = "&IV%3JXOfW6Z";
  $dbname = "phpcms";
  $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

  //Test if connection occurred
  if(mysqli_connect_errno()) {
    die("Database connection failed: " .
         mysqli_connect_error() .
         " (" . mysqli_connect_errno() . ")"
    );
  } else {
    echo "Connection succsesful.<br />";
  }
?>

<?php

  // 2. Perform database query
  $query = "SELECT * ";
  $query .= "FROM subjects ";
  $query .= "WHERE visible = 1 ";
  $query .= "ORDER BY position ASC";

  $result = mysqli_query($connection, $query);
  // Test if there was a query error
  if (!$result) {
    die("Database query failed.<br />");
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Sessions</title>
</head>
<body>

<h2>Database Stuff</h2>

<ul>
  <?php

    // 3. Use returned data (if any)
    // while($row = mysqli_fetch_row($result)) {
    while($subject = mysqli_fetch_assoc($result)) {
      // output data from each row
  ?>
      <li><?php echo $subject["menu_name"]; ?></li>

  <?php
    }
  ?>
</ul>

<?php
    // 4. Release returned data
    mysqli_free_result($result);
  ?>

<h2>Set and Display Session Variable</h2>
<?php

  // Set to null to clear
  $_SESSION["first_name"] = "Chris";
  $name = $_SESSION["first_name"];
  echo $name;

?>

</body>
</html>

<?php
  // 5. Close database connection
  mysqli_close($connection);
?>
