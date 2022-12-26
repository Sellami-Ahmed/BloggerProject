<?php
class Category {
    private $name;
    public function __construct($name=null){
        if(!is_null($name)){
            $this->name = $name;
        }
    }
    public function __get($attr){
        if (!isset($this->attr))
        return "";
        else return ($this->attr);
    }
    public function __set($attr,$value) {
    $this->attr = $value;
    }
    public function save($db,$id=null){
        try{
            if($id==null){
                $sql="INSERT INTO category(name) VALUES (?)";
                $params=array($this->name);
                $resultat = $db->execute_query($sql, $params);
            }
            else{
                $sql="UPDATE category SET name=:name
                WHERE id=:id";
                $params=array('name'=>$this->name,'id'=>$id);
                $resultat = $db->execute_query($sql, $params);
            }

        }
        catch(PDOException $e){
            if ($e->getCode() == 2300){
                $message=$e->getMessage();
                }
                return false;
        }
        return true;
    }
    public static function getAll($db){
        $sql = "SELECT * from category";
        $resultat = $db->execute_query($sql);
        if(!$resultat) {
        $erreur=$db->errorInfo();
        echo "Lecture impossible, id", $db->errorCode(),$erreur[2];
        }
        else{
        return $resultat->fetchAll(PDO::FETCH_OBJ);
        }
        }
    public static function getbyid($db,$id){
        $sql = "SELECT * FROM category where id=?";
        $params = array($id);
        $resultat = $db->execute_query($sql,$params);
        if(!$resultat) {
        $erreur=$db->errorInfo();
        echo "Lecture impossible, code", $db->errorCode(),$erreur[2];
        }
        else{
        return $resultat->fetch(PDO::FETCH_OBJ);
        }
        }
    public static function delete($db, $id){
        try{
        $sql = "DELETE FROM category where id=?";
        $params = array($id);
        $resultat = $db->execute_query($sql,$params);
        }
        catch(PDOException $e ){
        return false;
        }
        return true;
        }
}
?>