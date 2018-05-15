<?php
class user {
  public $login;
  public function __construct($login)
  {
    $this->login = $login;
  }
  public function getLogin(){
    return $this->login;
  }
}
?>
