<?php
//vérifier si user est un manager
var_dump($_GET);
    if ($user) {
        header('Location: /index.php?page=login');
        die();
    }

    require_once __DIR__ . '/../../src/init.php';
    $sql = "DELETE FROM " . $_GET['type_transaction'] . " WHERE ". $_GET['type_transaction'] ."_id=" . $_GET['id_transaction'];
    echo $sql;
    $req = $db->prepare($sql);
    $req->execute();

    header('Location: /../index.php?page=dashboard_manager');
?>
