<?php
  require_once("../includes/session.php");
  require_once("../includes/db_connection.php");
  require_once("../includes/functions.php");
  require_once("../includes/validation_functions.php");
  confirm_logged_in();

  $admin = find_admin_by_id($_GET["id"]);

  if (!$admin) {
    // admin ID was missing or invalid or admin couldn't be found in the database
    redirect_to("manage_admins.php");
  }

  if (isset($_POST['submit'])) {
    // Process the form

    // Validations
    $required_fields = array("username", "password");
    validate_presences($required_fields);

    $fields_with_max_lengths = array("username" => 30);
    validate_max_lengths($fields_with_max_lengths);

    if (empty($errors)) {
      // Perfom Create

      $id = $admin["id"];
      $username = mysql_prep($_POST["username"]);
      // $hashed_password = password_encrypt($_POST["password"]);
      $hashed_password = password_hash($_POST["password"], PASSWORD_BCRYPT, ['cost' => 11]);

      $query = "UPDATE admins SET username = '{$username}', hashed_password = '{$hashed_password}' WHERE id = {$id} LIMIT 1";
      $result = mysqli_query($connection, $query);

      if ($result && mysqli_affected_rows($connection) == 1) {
        // Success
        $_SESSION["message"] = "Admin Updated.";
        redirect_to("manage_admins.php");
      } else {
        // Failure
        $_SESSION["message"] = "Admin update failed.";
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

    <h2>Edit Admin</h2>
    <form action="edit_admin.php?id=<?php echo urlencode($admin["id"]); ?>" method="post">
      <p>Username:
        <input type="text" name="username" value="<?php echo htmlentities($admin["username"]); ?>" />
      </p>
      <p>Password:
        <input type="password" name="password" value="" />
      </p>
      <input type="submit" name="submit" value="Edit Admin" />
    </form>
    <br />
    <a href="manage_admins.php">Cancel</a>
  </div>
</div>

<?php include("../includes/layouts/footer.php"); ?>
