<?php


class DbManager {
    private $db;

    function __construct(PDO $db) {
        $this->db = $db;
    }

    function insert(string $sql, array $data){
        $sth = $this->db->prepare($sql);
        $sth->execute($data);

    }

    function select($sql, $data){
        $sth = $this->db->prepare($sql);
        if($data){
            $sth->execute($data);
        }else{
            $sth->execute();
        }
        
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $res = $sth-> fetchAll();

        return $res;
    }

}

?>