<?php
session_start();

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/utils/errors.php';
require_once __DIR__ . '/utils/auth.php';
require_once __DIR__ . '/utils/gen_manager_table.php';  // a voir pour le mettre que dans pages manager


require_once __DIR__ . '/class/DbManager.php';

$dbManager = new DbManager($db);

$roles = [
    "admin"=>1000,
    "manager"=>200,
    "verified_user"=>10,
    "unverified_user"=>1,
    "banned_user"=>0
];



$user_id = get_session_user();
$user = false;
//si get_session_user nous a return $user
if ($user_id !== false) {
	$user = get_user_by_id($user_id);
}

?>