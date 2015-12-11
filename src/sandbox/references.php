<?php

  // Sets $a and $b to be the same as each other, no matther whether it is $a or $b that is changed/set.
  $b =& $a;

  $a = 1;

  echo "a: {$a} / b: {$b}<br><br>";

  $b = 2;

  echo "a: {$a} / b: {$b}<br><br>";

  $a = 3;

  echo "a: {$a} / b: {$b}<br><br>";

  $b = 4;

  echo "a: {$a} / b: {$b}<br><br>";

  // =======================================
  echo "<hr>";
  // =======================================

  // local and global variables demo
  function ref_test($var) {
    $var = $var * 2;
    echo $var . "<br>";
  }
  $a = 10;
  ref_test($a);
  echo $a . "<br>";
  // $a remains at 10 because the multiplication was local

  // =======================================
  echo "<hr>";
  // =======================================

  // reference variables in a function
  function ref_test2(&$var) {
    $var = $var * 2;
    echo $var . "<br>";
  }
  $a = 10;
  ref_test2($a);
  echo $a . "<br>";
  // $a is now set to 20 because $a and $var have been set to each other
  // Equivalent to using a global variable i.e. 'global $a;'
  // but allows you to use different variable names within the function

  // =======================================
  echo "<hr>";
  // =======================================

  function &ref_return() {
    global $a;
    $a = $a * 2;
    return $a;
  }
  $a = 10;
  // Ordinarily a return returns the actual value e.g. 20, NOT the varialbe e.g. $a
  // By using '&' in our function name AND in our assignment of the variable to the function
  // we ensure that the reference is returned and $b is linked to it.
  $b =& ref_return();

  echo "a: {$a} / b: {$b}<br>";
  $b = 30;
  echo "a: {$a} / b: {$b}<br>";

  // =======================================
  echo "<hr>";
  // =======================================

  function &increment() {
    static $var = 0;
    $var++;
    return $var;
  }
  $a =& increment(); // var increments
  increment(); // var increments
  $a++; // var increments
  increment(); // var increments
  echo "a: {$a}<br>"; // 4 ($a incremented with var)

 ?>