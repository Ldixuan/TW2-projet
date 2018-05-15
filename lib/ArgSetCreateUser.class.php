<?php
class ArgSetCreateUser extends AbstractArgumentSet{

  protected function definitions() {
       $this->defineNonEmptyString('login');
       $this->defineNonEmptyString('password');
  }
}
?>
