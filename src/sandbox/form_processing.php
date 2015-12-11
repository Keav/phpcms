<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimal-ui">

  <title>PHP CMS TESTING</title>

  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<h1>Test CMS with PHP</h1>

<a href="index.php">index.php</a><br />

<?php include('includes/error_reporting.php'); ?>

<h2>Form Processing</h2>

<pre>
  <?php

    print_r($_POST);

  ?>
</pre>

<br />

<?php
  if (isset($_POST['submit'])) {
    echo "Form was submitted<br /><br />";

      // Set default values
      if (isset($_POST["username"])) {
        $username = $_POST["username"];
      } else {
        $username = "";
      }

      if (isset($_POST["password"])) {
        $password = $_POST["password"];
      } else {
        $password = "";
      }

      // Set default values using ternary operator
      //  boolean_test ? value_if_true : value_if_false
      $username = isset($_POST['username']) ? $_POST['username'] : "";
      $password = isset($_POST['password']) ? $_POST['password'] : "";

    } else {
      $username = "local";
      $password = "Reload";
    }
?>

<?php
  echo "{$username}: {$password}";
?>

</body>
</html>