<?php
 require_once("AbstractArgumentSet.class.php");
  class ArgSetFindEvenement extends AbstractArgumentSet {
    protected function definitions() {
      $this->defineString('category',['default'=>'']);
      $this->defineString('key',['default'=>'']);
      $this->defineString('date',['default'=>'']);
    }
  }
 ?>
