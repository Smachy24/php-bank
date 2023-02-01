<?php

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/db.php';

require_once __DIR__ . '/pages/DbManager.php';

$dbManager = new DbManager($db);

$roles = [
    "admin"=>1000,
    "manager"=>200,
    "verified_user"=>10,
    "unverified_user"=>1,
    "banned_user"=>0
];

?>