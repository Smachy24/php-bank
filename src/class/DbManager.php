<?php 

require_once __DIR__ . '/DbObject.php';

/**
 * La classe DbManager doit pouvoir gérer n'importe quelle table de votre base de donnée
 * 
 * Complétez les fonctions suivantes pour les faires fonctionner
 */

class DbManager {
    private $db;

    function __construct(PDO $db) {
        $this->db = $db;
    }

    // return l'id inseré
    function insert(string $sql, array $data) {
        $sth = $this->db->prepare($sql);
        $sth->execute($data);
        return $this->db->lastInsertId();
    }

    function insert_advanced(DbObject $dbObj) {
        $class = get_class($dbObj);
        switch($class){
            case "ContactForm":
                $table = "contact_forms";
                break;
            case "User":
                $table = "users";
                break;
            default:
                die();
        }
    $attributs = get_object_vars($dbObj);
    unset($attributs["id"]);
    unset($attributs["created_at"]);
    $sql = "INSERT INTO $table ( ";

    foreach($attributs as $name=>$value){
        $sql.=$name .",";
    }
    $sql = substr($sql, 0, -1);
    $sql.=") VALUES (";
    foreach($attributs as $name=>$value){
        $sql.=":".$name.",";
    }
    $sql = substr($sql, 0, -1);
    $sql.=")";

    $sth = $this->db->prepare($sql);
    $sth->execute($attributs);
    
    }

    function select(string $sql, array $data, string $className) {

        // data = ["id"=>valeur, "fullname"=>valeur...]

        if($data){
            $sql .= " WHERE ";
            foreach($data as $column=>$value){
                
                if(is_numeric($value)){
                    $sql.= $column ." = " . $value ." AND ";
                } else{
                    $sql.= $column ." = \"" . $value ."\" AND ";
                }
            }
            $sql = substr($sql, 0, -4);
        }
        $sth = $this->db->prepare($sql);
        $sth->execute();
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $res = $sth-> fetchAll();

        $list = [];

        foreach($res as $item){
            $object = new $className();
            foreach($item as $key=>$value){
                $object -> $key = $value;
            }
            array_push($list, $object);
        }
        return $list;
    }

    function getById(string $tableName, $id, string $className) {
        $sql = "SELECT * FROM $tableName WHERE id = $id";
        $sth = $this->db->prepare($sql);
        $sth->execute();
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $res = $sth-> fetch();

        $object = new $className();
        foreach($res as $key=>$value){
                $object -> $key = $value;
            }
        return $object;
    }

    function getById_advanced($id, string $className) {
        
    }

    function getBy(string $tableName, string $column, $value, string $className) {
        
    }

    function getBy_advanced(string $column, $value, string $className) {
        
    }

    function removeById(string $tableName, $id) {
        $sql = "DELETE FROM $tableName WHERE id = $id";
        $sth = $this->db->prepare($sql);
        $sth->execute();
    }

    function update(string $tableName, array $data) {
        
    }

    function update_advanced(DbObject $dbObj) {
        $class = get_class($dbObj);
        switch($class){
            case "ContactForm":
                $table = "contact_forms";
                break;
            case "User":
                $table = "users";
                break;
            default:
                die();
        }

        $sql = "UPDATE $table SET ";
        $attributs = get_object_vars($dbObj);
        

        foreach($attributs as $name=>$value){
            if(is_numeric($value)&& $name!="phone"){
                $sql.= $name . " = " . $value . " ,";
            } else{
                $sql.=  $name . " = \"" . $value . "\" ,";
            }
        }
        
        $sql = substr($sql, 0, -1);

        $sql.= "WHERE id = $dbObj->id";
        $sth = $this->db->prepare($sql);
        $sth->execute($attributs);
    }
}