  <div id="footer">Copyright &copy; <?php echo date("Y"); ?>, Widget Corp</div>

</body>
</html>
<?php
  // 5. Close database connection
  if (isset($connection)) {
    mysqli_close($connection);
  }
?>
