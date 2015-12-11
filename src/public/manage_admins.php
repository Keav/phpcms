<?php
  require_once("../includes/session.php");
  require_once("../includes/db_connection.php");
  require_once("../includes/functions.php");
  confirm_logged_in();

  $admin_set = find_all_admins();

  $layout_context = "admin";
  include("../includes/layouts/header.php");
?>

<div id="main">
  <div id="navigation">
    <br />
    <a href="admin.php">&laquo; Main Menu</a><br />
  </div>
  <div id="page">
    <?php echo message(); ?>
    <h2>Manage Admins</h2>
    <table>
      <tr>
        <th style="text-align: left; width: 200px;">Username</th>
        <th colspan="2" style="text-align:left;">Actions</th>
      </tr>

      <?php while($admin = mysqli_fetch_assoc($admin_set)) { ?>
        <tr>
          <td><?php echo htmlentities($admin["username"]); ?></td>
          <td><a href="edit_admin.php?id=<?php echo urlencode($admin["id"]); ?>">Edit</a></td>
          <td><a href="delete_admin.php?id=<?php echo urlencode($admin["id"]) ?>" onclick="return confirm('Are you sure?');">Delete</a></td>
        </tr>
      <?php } ?>
    </table>
    <br />
    <a href="new_admin.php">Add a new admin</a>

    <hr />

    <?php
      mysqli_data_seek($admin_set,0); // Reset pointer to start for second while loop
      while($admin = mysqli_fetch_assoc($admin_set)) {
        echo "<p>" . htmlentities($admin["username"]) . "</p>\r\n";
        echo "<p>" . $admin["hashed_password"] . "</p>\r\n";
      }
    ?>

  </div>
</div>

<?php include("../includes/layouts/footer.php"); ?>
