<?php

require_once __DIR__ . '/../../src/init.php';

//Test deposit

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

if(!is_numeric($_POST['amount']))
    echo "Quantite n'est pas une valeur valide";

echo $_POST['amount'];

$sql = "INSERT INTO Deposit(id_user,id_currency,amount) VALUES (?, ?, ?)";
$data = [1,1,999];

//$dbManager -> insert($sql, $data);




?>