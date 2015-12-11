<?php
  ob_start(); // Output buffering is required for page redirect to work
  require_once('included_functions.php');

  $errors = array();
  $message = "";

  // ====================
  // Error validation re-usable functions
  // ====================

  // * presence
  // use trim() so empty spaces don't count
  // use === to avoid false positives
  // empty() would consider "0" to be empty
  function has_presence($value) {
    return isset($value) && $value !== "";
  }

  // * string length
  // min length
  function has_min_length($value, $min) {
    return strlen($value) >= $min;
  }

  // max length
  function has_max_length($value, $max) {
    return strlen($value) <= $max;
  }

  // * inclusion in a set
  function has_inclusion_in($value, $set) {
    return in_array($value, $set);
  }

  // ===================
  // Check if form submitted
  // Run validations
  // If all ok, attempt to log in
  // ===================

  if (isset($_POST['submit'])) {
    // form was submitted
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    // * Validations
    // Check that username or password aren't blank
    $fields_required = array("username", "password");
    foreach($fields_required as $field) {
      $value = trim($_POST[$field]);

      if (!has_presence($value)) {
        $errors[$field] = ucfirst($field) . " can't be blank.<br />";
      }
    }

    // Set max lengths for username and password
    $fields_with_max_lengths = array("username" => 30, "password" => 8);

    // Check max lengths of username and password, as set above
    function validate_max_lengths($fields_with_max_lengths) {
      global $errors;

      // Using an assoc. array
      foreach($fields_with_max_lengths as $field => $max) {
        $value = trim($_POST[$field]);
        if (!has_max_length($value, $max)) {
          $errors[$field] =  ucfirst($field) . " is too long.<br />";
        }
      }
    }

    // Run the above function (Should be in a functions include)
    validate_max_lengths($fields_with_max_lengths);

    // If errors, ask user to fix errors and return error details display
    function form_errors($errors=array()) {
      $output = "";
      if (!empty($errors)) {
        $output .= "<div class=\"error\">";
        $output .= "Please fix the following errors:";
        $output .= "<ul>";
        foreach ($errors as $key => $error) {
          $output .= "<li>{$error}</li>";
        }
        $output .= "</ul>";
        $output .= "</div>";
      }
      return $output;
    }

    // If no errors, attempt log in
    if (empty($errors)) {
      // Try to log in
      if ($username == "Chris" && $password == "secret") {
        // Successful login
        redirect_to("basic.html");
      } else {
        $message = "Username and Password don't match.";
      }
    }
  } else {
    $username = "";
    $message = "Please log in.";
  }
?>

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

<?php include('includes/error_reporting.php'); ?>

<!-- ======================
=
======================= -->

<h2>Debugging</h2>

<pre>
<?php

  $number = 99;
  $string = "Bug?";
  $array = array(1 => "Homepage", 2 => "About", 3 => "Services");

  var_dump($number);
  var_dump($string);
  var_dump($array);

?>
</pre>

<!-- ======================
=
======================= -->

<h2>URL Links and Encoding</h2>

<?php
    $link_name = "Second Page";
    $link_url = "second_page.php?page=2";
    $company = "J & J";
?>
<!-- rawurlencode the PATH, urlencode the query string. i.e. before and after the '?' -->
<a href="<?php echo $link_url; ?>&company=<?php echo urlencode($company); ?>"><?php echo $link_name; ?></a><br />

<?php
  $url_page = "php/created/page/url.php";
  $param1 = "This is a string with < >";
  $param2 = "&#?*$[]+ are bad characters";
  $linktext = "<Click> to learn more";

  $url = "http://localhost/";
  $url .= rawurlencode($url_page);
  $url .= "?" . "param1=" . urlencode($param1);
  $url .= "&" . "param2=" . urlencode($param2);
?>

<!-- Could also use htmlentities to catch more than the core 4 problem chars  -->
<a href="<?php echo htmlspecialchars($url); ?>">
  <?php echo htmlspecialchars($linktext); ?>
</a>

<!-- ======================
=
======================= -->

<h2>Global Variables and Functions</h2>

<?php
  $bar = "outside"; // Global Scope

  function foo() {
    global $bar;
    if (isset($bar)) {
      echo "foo: " . $bar . "<br />";
    }
    $bar ="inside"; // Local Scope
  }

  echo "1: " . $bar . "<br />";
  foo();
  echo "2: " . $bar . "<br />";
?>

<!-- ======================
=
======================= -->

<h2>Default Function Values</h2>

<?php
  function paint($room="office",$color="red") {
    return "The color of the {$room} is {$color}.<br />";
  }

  echo paint();
  echo paint("bedroom", "blue");
  echo paint("bedroom", null);
  echo paint("lounge")
?>

<!-- ======================
=
======================= -->

<!-- <h2>Form Processing</h2>

  <form action="form_processing.php" method="post">
    Username: <input type="text" name="username" value="" /><br />
    Password: <input type="password" name="password" value=""><br />
    <br />
    <input type="submit" name="submit" value="Submit" />
  </form> -->

  <!-- ======================
=
======================= -->

<h2>Form Single Page</h2>

<?php echo $message; ?><br /> <!-- Please log in / Please fix errors -->
<?php echo form_errors($errors); ?> <!-- Error details -->

  <form action="index.php" method="post">
    Username: <input type="text" name="username" value="<?php echo htmlspecialchars($username) ?>" /><br />
    Password: <input type="password" name="password" value=""><br />
    <br />
    <input type="submit" name="submit" value="Submit" />
  </form>

  <!-- ======================
=
======================= -->

</body>
</html>