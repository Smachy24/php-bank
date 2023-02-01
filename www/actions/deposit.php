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


//Verifier si post[currency] est dans la table currency

$sql = "SELECT name FROM Currency";
$data = $dbManager -> select($sql);
var_dump($data);


var_dump(in_array($_POST['currency'], $data));

$currency_is_good = false;

foreach($data as $array){
    if($array["name"]==$_POST['currency']){
        $currency_is_good = true;
    }
}

if(!$currency_is_good){
    echo "Monnaie inexistante";
}
echo $_POST['currency'];



$sql = "INSERT INTO Deposit(id_user,id_currency,amount) VALUES (?, ?, ?)";
$data = [1,1,999];

//$dbManager -> insert($sql, $data);




?>