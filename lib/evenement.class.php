<?php
class evenement{
  public $category;
  public $key;
  public $date;
  public function __construct($category,$key,$date)
  {
    $this->category = $category;
    $this->key = $key;
    $this->date = $date;
  }
}
?>
