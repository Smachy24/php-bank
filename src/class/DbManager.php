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

    function select($sql){
        $sth = $this->db->prepare($sql);
        $sth->execute();
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $res = $sth-> fetchAll();
        return $res;
    }

    function update(string $sql, array $data){
        $sth = $this->db->prepare($sql);
        $sth->execute($data);
    }
}

?>