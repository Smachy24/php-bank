<?php

require_once __DIR__ . '/../../src/init.php';


if(!isset($_POST["currency"]) || !isset($_POST["amount"])){
    set_errors("⚠️Formulaire non reçu", '/../index.php?page=deposit');
}

if(empty($_POST["currency"])){
    set_errors("⚠️Monnaie invalide", '/../index.php?page=deposit');
}

if(empty($_POST["amount"])){
    set_errors("⚠️Quantite invalide", '/../index.php?page=deposit');
}

$_POST['currency'] = htmlentities($_POST['currency'],  ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5);

if(!is_numeric($_POST['amount'])){
    set_errors("⚠️Quantite n'est pas une valeur valide", '/../index.php?page=deposit');
}

//On vérifie si la monnaie saisie par l'user existe
//On récupère l'id aussi pour la suite

$_POST['currency'] = strtoupper($_POST['currency']);

$sql = "SELECT currency_id, name FROM currency";
$data = $dbManager -> select($sql, []);

$currency_is_good = false;
foreach($data as $array){
    if($array["name"]==$_POST['currency']){
        $currency_is_good = true;
        $currency_id = $array["currency_id"];
        break;
    }
}
if(!$currency_is_good){
    set_errors("⚠️Monnaie inexistante", '/../index.php?page=deposit');
}

$amount = $_POST['amount'];

// On insère une nouvelle ligne dans la table Deposit
$sql = "INSERT INTO deposit(id_user,id_currency,amount) VALUES (?, ?, ?)";
$data = [$_SESSION['user_id'],$currency_id,$amount];
$dbManager -> insert($sql, $data);



set_errors("Depot bien envoye", '/../index.php?page=deposit');





?>