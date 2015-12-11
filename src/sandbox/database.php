<?php
  // 1. Create a databse connection
  $dbhost = "localhost";
  $dbuser = "root";
  $dbpass = "";
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
  <title>Database Stuff</title>
</head>
<body>

  <h2>Database Stuff</h2>

  <ul>
    <?php
      // 3. Use returned data (if any)
      while($subject = mysqli_fetch_assoc($result)) {
        // output data from each row
    ?>
        <li><?php echo $subject["menu_name"] . " (" . $subject["id"] . ")"; ?></li>
    <?php
      }
    ?>
  </ul>

  <?php
      // 4. Release returned data
      mysqli_free_result($result);
    ?>

</body>
</html>

<?php
  // 5. Close database connection
  mysqli_close($connection);
?>
