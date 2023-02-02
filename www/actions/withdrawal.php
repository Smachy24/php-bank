<?php

require_once __DIR__ . '/../../src/init.php';


//Verification du formulaire
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

//Verification si la monnaie existe

$_POST['currency'] = strtoupper($_POST['currency']);

$sql = "SELECT currency_id,name FROM Currency";
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
    echo "Monnaie inexistante";
}

//Verifier que l'utilisateur a assez d'argent

$sql = "SELECT amount FROM Account WHERE id_currency = ? AND id_user = 1";

$total_amount = $dbManager->select($sql,[$currency_id]);
// var_dump($amount);

if(!$total_amount){
    echo "Vous n'avez pas de compte avec cette devise";
}

if($total_amount[0]["amount"]<$_POST["amount"]){
    echo "Vous n'avez pas assez d'argent";
}

$amount = $_POST["amount"];

// On insère une nouvelle ligne dans la table Withdraw
$sql = "INSERT INTO Withdrawal(id_user,id_currency,amount) VALUES (?, ?, ?)";
$data = [1,$currency_id,$amount];

$dbManager -> insert($sql, $data);


?>