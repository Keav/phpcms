<?php
  $numbers = array(4,8,15,16,24,23,42);

  $numbers_short = [1,5,11,19,35,50];

// ZERO INDEXED! 0, 1, 2, 3.
$mixed = [6, "fox", "dog", ["x", "y", "z"]];

// echo $mixed[2] . "<br><br>";

// echo $mixed[3]; // Error. Array to string conversion.
// echo $mixed[3][1] . "<br><br>";

// Add Item to array
// Don't forget, arrays are zero (0) indexed! so [4] IS after the array above -->
$mixed[4] = "cat";

// To just add to the end
$mixed[] = "horse";

echo "<pre>";
print_r($mixed);
echo "</pre>";

echo "<br>";

// =======================
// Associative Arrays
//
// Not integer indexed as a standard array but object indexed collection of objects
// =======================

$assoc = ["first_name" => "Chris", "last_name" => "Keavey"];

echo $assoc["first_name"] . "<br>";
echo $assoc["first_name"] . " " . $assoc["last_name"] . "<br>";

$assoc["first_name"] = "Larry";
echo $assoc["first_name"] . " " . $assoc["last_name"] . "<br>";

echo "<br>";

// =====================
// Array Functions
// =====================

echo "Count: " . count($numbers) . "<br>";
echo "Max Value: " . max($numbers) . "<br>";
echo "Min Value: " . min($numbers) . "<br>";
?>

<br>

<!-- The following sorts are 'destructive'. They permenantly change the array, not just sort the output -->

Sort:
  <pre>
    <?php sort($numbers_short); print_r($numbers_short); ?>
  </pre>

Reverse Sort:
  <pre>
    <?php rsort($numbers_short); print_r($numbers_short); ?>
  </pre>

<br>

<!-- Puts an array into a string with the * character as a divider between the values -->
Implode: <?php echo $num_string = implode(" * ", $numbers); ?><br>

<!-- Puts the array back together (back into an array) by reading the string and looking for
the * as the divider. Useful for importing a , (comma) sorted list. -->
Explode: <?php print_r(explode(" * ", $num_string)); ?><br>

<br>

15 in array?: <?php echo in_array(15, $numbers); // Returns true or false. True represented by a 1 ?><br>
19 in array?: <?php echo in_array(19, $numbers); // Returns true or false. False represented by nothing. ?><br>
<!-- The above true or false are booleans. PHP outputs true as a string '1'. False is a boolean reasult but will not output anything. -->

<br>

<?php
// =====================
// Array Foreach
// =====================

$ages = [4,8,15,16,23,42];

foreach($ages as $age) {
  echo "Age: {$age}<br>";
}

echo "<br>";

$person = [
  "first_name" => "Bob",
  "last_name" => "Hope",
  "address" => "123 Village Street",
  "city" => "London",
  "county" => "Londonshire",
  "post_code" => "SW1"
];

// foreach (actual_array_name as whatever => whatever )
// foreach ($array as $key => $value)
foreach($person as $attribute => $data) {
  $attr_nice = ucwords(str_replace("_", " ", $attribute));
  echo "{$attr_nice}: {$data}<br>";
}

echo "<br>";

$prices = [
  "Brand new computer" => 2000,
  "1 month of Lynda.com" => 25,
  "Learning PHP" => null
];

foreach($prices as $item => $price) {
  echo "{$item}: ";
  if(is_int($price)) {
    echo "$" . $price;
  } else {
    echo "Priceless";
  }
  echo "<br>";
}

?>

<br>

<?php
// =====================
// Array Pointers
// =====================

  $ages = [4,8,15,16,23,42];

  // current pointer 'VALUE'
  echo "1: " . current($ages) . "<br>";

  // move the pointer forward
  // similar to using 'continue' inside a loop
  next($ages);
  echo "2: " . current($ages) . "<br>";

  next($ages);
  next($ages);
  echo "3: " . current($ages) . "<br>";

  prev($ages);
  echo "4: " . current($ages) . "<br>";

  reset($ages);
  echo "5: " . current($ages) . "<br>";

  end($ages);
  echo "6: " . current($ages) . "<br>";

  next($ages);
  echo "7: " . current($ages) . "<br>";

  reset($ages);

  // while loop that moves the array pointer
  // similar to foreach
  while($age = current($ages)) {
    echo $age . ", ";
    next($ages);
  }
?>
