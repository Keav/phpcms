<?php

class Example {
  public $a = 1;
  protected $b = 2;
  private $c = 3;

  function show_abc() {
    echo $this->a;
    echo $this->b;
    echo $this->c;
  }
}

$example = new Example();

// echo "public a: {$example->a}<br />";

$example->show_abc();

  echo "<br />";

class smallExample extends Example {
  protected $b = 6;
}

  $example2 = new smallExample();

  $example2->show_abc();

?>