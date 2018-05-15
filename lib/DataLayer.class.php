<?php
/**
 *
 */
class DataLayer{

  private $connexion;
// Question1: Créer une classe DataLayer et une méthode authentifier($login,$password)
  public function __construct(){
    $this->connexion = new PDO(
      DB_DSN,
      DB_USER,
      DB_PASSWORD,
      array(
        //Les attributs
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC//fetch associatif
      )
    );
  }

  public function authentifier($login, $password){
    $answer = $this->connexion->prepare("SELECT * FROM tab_users WHERE login=:login");
    $answer->bindValue(':login',$login);
    $answer->execute();
    if ($res = $answer->fetch()){
      if (crypt($password, $res['password']) == $res['password']){
        $login = $res['login'];
        $id = new user($login);
        return $id;
      }else{
        return NULL;
      }
    }else{
      return NULL;
    }
  }

  public function createUser($login, $password){
    try{
      $answer = $this->connexion->prepare("INSERT INTO tab_users (login,password) VALUES (:login,:password)");
      $answer->bindValue(':login',$login);
      $answer->bindValue(':password',password_hash($password,CRYPT_BLOWFISH));
      $answer->execute();
      return true;
    }
    catch (PDOException $ex){
      return false;
    }
  }

  public function findEvenement($category,$key=NULL,$date=NULL){
    $criteria = [];
    $sql = "select * from evenement where category=:category ";
    if(!is_null($key)){
      $sql.= "title like '%:key%' ";
      $criteria[key] = $key;
    }
    if(!is_null($date)){
      $sql.= "date > :date order by date";
      $criteria[date] = $date;
    }
    $stmt = $this->connexion->prepare($sql);
    $stmt->bindValue(':category',$category);
    foreach ($criteria as $v) {
      $stmt->bindValue('$v',$criteria[$v]);
    }
    $stmt->execute();
    $res = $stmt->fetch();
    require_once('evenement.class.php');
    while($evenement=$stmt->fetch()){
      $var=new evenement($evenement["category"],$evenement["key"],$evenement["date"]);
      array_push($res,$var);
    }
    return $res;
  }

  public function createEvenement($title,$autor,$category,$description,$ou,$quand){
    $sqlcount = "select count(*) from evenement";
    $tmp = $this->connexion->prepare($sql);
    $tmp->execute();
    $temp = $tmp->fetchAll();
    $id = ($temp["count"]*1) + 1;
	  $sql = "insert into \"evenement\"(id, autor,title,category,description,ou,quand) ".
	        "values(:id,:autor,:title,:category,:description,:ou,:quand)";
	  $stmt=$this->connexion->prepare($sql);
    $stmt->bindValue(':id',$id);
    $stmt->bindValue(':autor',$autor);
    $stmt->bindValue(':title',$title);
    $stmt->bindValue(':category',$category);
    $stmt->bindValue(':description',$description);
    $stmt->bindValue(':ou',$ou);
    $stmt->bindValue(':quand',$quand);
    $stmt->execute();
    return $stmt->rowCount() == 1;
	}
}
?>
