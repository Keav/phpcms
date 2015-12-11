<?php
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
  }
?>

<?php
  // Often these are form values in $_POST
  $id = 4;
  $menu_name = "Delete Me";
  $position = 4;
  $visible = 1;

  // 2. Perform database query
  $query = "UPDATE subjects SET menu_name = '{$menu_name}', position = {$position}, visible = {$visible} WHERE id = {$id}";

  $result = mysqli_query($connection, $query);


  // Test if there was a query error
  if ($result && mysqli_affected_rows($connection) == 1) {
    // Success
    // redirect_to("somepage.php");
    echo "Success";
  } else {
    // Failure
    // $message = "Subject creation failed."
    die("Database query failed.<br /><br />" . mysqli_error($connection));
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Database Stuff</title>
</head>
<body>

</body>
</html>

<?php
  // 5. Close database connection
  mysqli_close($connection);
?>
