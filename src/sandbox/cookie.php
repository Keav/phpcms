<?php
  // Remeber: Setting cookies must be before *any* HTML output
  //          unless output buffering is turned on.
  $name = "test";
  $value = 45;
  $expire = time() + (60*60*24*7); // add seconds
  setcookie($name, $value, $expire);
  // To clear a cookie
  // setcookie($name, null, time() - 3600);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Cookies!</title>
</head>
<body>

<?php

  $test = isset($_COOKIE["test"]) ? $_COOKIE["test"] : "";
  echo $test;

?>

</body>
</html>
