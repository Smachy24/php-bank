<?php

require_once __DIR__ . '/../../src/init.php';

if(!isset($_POST["currency"]) || !isset($_POST["amount"])){
    echo "Formulaire non reçu";
}

if(empty($_POST["currency"])){
    echo "Monnaie invalide";
}

if(empty($_POST["amount"])){
    echo "Quantite invalide";
}

$_POST['currency'] = htmlentities($_POST['currency'],  ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5);

if(!is_numeric($_POST['amount'])){
    echo "Quantite n'est pas une valeur valide";
}

$sql = "SELECT name FROM Currency";
$data = $dbManager -> select($sql, []);
var_dump($data);



$currency_is_good = false;

foreach($data as $array){
    if($array["name"]==$_POST['currency']){
        $currency_is_good = true;
    }
}

if(!$currency_is_good){
    echo "Monnaie inexistante";
}

//Verifier que l'utilisateur a assez d'argent

$sql = "SELECT amount FROM Account JOIN Currency on Account.id_currency = 
Currency.currency_id WHERE Currency.name = \" ? \"";
$res = $dbManager->select($sql,$_POST["currency"]);
var_dump($res);


?>