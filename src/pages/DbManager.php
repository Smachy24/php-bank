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

}

?>