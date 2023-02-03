<?php
    require_once __DIR__ . '/../../src/init.php';
    
    
    //vérifier si user est un manager ou admin
    if ($user['role'] <= 200) {
        header('Location: /index.php?page=home');
        die();
    }

    $sql = "DELETE FROM " . $_GET['type_transaction'] . " WHERE ". $_GET['type_transaction'] ."_id=" . $_GET['id_transaction'];
    echo $sql;
    $req = $db->prepare($sql);
    $req->execute();

    header('Location: /../index.php?page=dashboard_manager');
?>
