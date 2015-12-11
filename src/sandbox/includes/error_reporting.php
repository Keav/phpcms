<?php
  // Add the following to your .htaccess file
  // php_flag  display_errors        on
  // php_value error_reporting       2039

  echo "<h2>Error reporting is on</h2>";

  ini_set('display_errors', 'On');

  // E_SCRIPT added in PHP 5
  // but not in E_ALL until PHP 5.4
  error_reporting(E_ALL | E_STRICT);

  // Use ~ for "omit"
  error_reporting(E_ALL & ~E_DEPRECATED);

  // return the current level
  echo error_reporting();

  echo "<br />";

?>
