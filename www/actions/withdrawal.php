<?php

require_once __DIR__ . '/../../src/init.php';


//Verification du formulaire
if(!isset($_POST["currency"]) || !isset($_POST["amount"])){
    set_errors("⚠️Formulaire non reçu", '/../index.php?page=withdrawal');
}

if(empty($_POST["currency"])){
    set_errors("⚠️Monnaie invalide", '/../index.php?page=withdrawal');
}

if(empty($_POST["amount"])){
    set_errors("⚠️Quantite invalide", '/../index.php?page=withdrawal');
}


$_POST['currency'] = htmlentities($_POST['currency'],  ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5);

if(!is_numeric($_POST['amount'])){
    set_errors("⚠️Quantite n'est pas une valeur valide", '/../index.php?page=withdrawal');
}

//Verification si la monnaie existe

$_POST['currency'] = strtoupper($_POST['currency']);

$sql = "SELECT currency_id,name FROM currency";
$data = $dbManager -> select($sql, []);
// var_dump($data);

$currency_is_good = false;

foreach($data as $array){
    if($array["name"]==$_POST['currency']){
        $currency_is_good = true;
        $currency_id = $array["currency_id"];
        break;
    }
}
if(!$currency_is_good){
    set_errors("⚠️Monnaie inexistante", '/../index.php?page=withdrawal');
}

//Verifier que l'utilisateur a assez d'argent

$sql = "SELECT amount FROM account WHERE id_currency = ? AND id_user = ?";

$total_amount = $dbManager->select($sql,[$currency_id, $_SESSION['user_id']]);
// var_dump($amount);

if(!$total_amount){
    echo "Vous n'avez pas de compte avec cette devise";
}

if($total_amount[0]["amount"]<$_POST["amount"]){
    set_errors("⚠️Vous n'avez pas assez d'argent", '/../index.php?page=withdrawal');
}

$amount = $_POST["amount"];

// On insère une nouvelle ligne dans la table Withdraw
$sql = "INSERT INTO withdrawal(id_user,id_currency,amount) VALUES (?, ?, ?)";
$data = [$_SESSION['user_id'],$currency_id,$amount];

$dbManager -> insert($sql, $data);


set_errors("Transaction bien reçue", '/../index.php?page=withdrawal');
?>