<?php
  require_once("../includes/session.php");
  require_once("../includes/db_connection.php");
  require_once("../includes/functions.php");
  require_once("../includes/validation_functions.php");
  confirm_logged_in();

  if (isset($_POST['submit'])) {
    // Process the form

    // Validations
    $required_fields = array("username", "password");
    validate_presences($required_fields);

    $fields_with_max_lengths = array("username" => 30);
    validate_max_lengths($fields_with_max_lengths);

    if (empty($errors)) {
      // Perfom Create

      $username = mysql_prep($_POST["username"]);
      // $hashed_password = password_encrypt($_POST["password"]);
      $hashed_password = password_hash($_POST["password"], PASSWORD_BCRYPT, ['cost' => 11]);

      $query = "INSERT INTO admins (username, hashed_password) VALUES ('{$username}', '{$hashed_password}')";
      $result = mysqli_query($connection, $query);

      // The following 3 lines use a Test function to visually show the password, crypt being used, the salt, hash etc.
      // It only outputs on the new_admin.php page so in order to see it you must 'break' this page
      // so that it does not redirect to manage_admin.php
      // A good way to 'break' this page is simply to insert a non-existant variable into the mysql INSERT query above.
      // $test = test_password_encrypt($_POST["password"]);
      // echo $_POST["password"] . "<br />";
      // echo $test;
      // END of Test Code

      if ($result) {
        // Success
        $_SESSION["message"] = "Admin Created.";
        redirect_to("manage_admins.php");
      } else {
        // Failure
        $_SESSION["message"] = "Admin creation failed.";
      }
    }
  } else {
    // This is probably a GET request
  } // end: if (isset($_POST['submit']))
?>

<?php
  $layout_context = "admin";
  include("../includes/layouts/header.php");
?>

<div id="main">
  <div id="navigation">
    &nbsp;
  </div>
  <div id="page">
    <?php echo message(); ?>
    <?php echo form_errors($errors); ?>

    <h2>Create Admin</h2>
    <form action="new_admin.php" method="post">
      <p>Username:
        <input type="text" name="username" autofocus="autofocus" value="" />
      </p>
      <p>Password:
        <input type="password" name="password" value="" />
      </p>
      <input type="submit" name="submit" value="Create Admin" />
    </form>
    <br />
    <a href="manage_admins.php">Cancel</a>
  </div>
</div>

<?php include("../includes/layouts/footer.php"); ?>
