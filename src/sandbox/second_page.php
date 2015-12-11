<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimal-ui">

  <title>PHP CMS TESTING</title>

  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<h1>Second page</h1>

<a href="index.php">index.php</a>

<h2>Show Super Global Array</h2>

<pre>
  <?php
    print_r($_GET);
    $page = $_GET['page'];
    echo "<br />".$page;
    echo "<br />".$company;
  ?>
</pre>

<h2>URL Encoding</h2>

</body>
</html>