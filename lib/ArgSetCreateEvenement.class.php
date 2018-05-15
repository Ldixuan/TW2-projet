<?php
require_once("AbstractArgumentSet.class.php");
  class ArgSetCreateEvenement extends AbstractArgumentSet {
    protected function definitions() {
      $this->defineString('create_titre',['default'=>'']);
      $this->defineString('create_description',['default'=>'']);
      $this->defineString('create_category',['default'=>'']);
      $this->defineString('create_ou',['default'=>'']);
      $this->defineString('create_date',['default'=>'']);
    }
  }
 ?>
