<?php
  function test($options=array()) {
    echo "Item 1<br>";
    if ($options['visible']) {
      echo "Item 2<br>";
    }
    echo "Item 3<br>";
  }
?>

<?php
  $options = array(
    'visible' => true,
    'order' => 'ascending',
    'color' => 'red'
  );
?>


<?php
  test($options);
?>
