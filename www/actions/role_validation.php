<?php
require_once __DIR__ . '/../../src/init.php';

//on change la valeur numérique du role en fonction de si c'est un ban ou une validation
$role_value;
if($_GET['verification_status'] == "ban" ){
    $role_value=0;
}
elseif ($_GET['verification_status'] == "verified" ){
    $role_value=10;
}
// On modifie le role de l'utilisateur
$sql = "UPDATE user SET role = ? WHERE user_id =  ?";
$dbManager->update($sql,[$role_value , $_GET['id_user_to_check']]);


header('Location: /../index.php?page=dashboard_manager');
?>