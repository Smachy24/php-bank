<?php

require_once __DIR__ . '/../../src/init.php';


//Verification du formulaire
if(!isset($_POST["currency"]) || !isset($_POST["amount"]) ||!isset($_POST["new_currency"]) || !isset($_POST["password"])){
    echo "Formulaire non reçu";
}

if(empty($_POST["currency"])){
    echo "Monnaie invalide";
}

if(empty($_POST["amount"])){
    echo "Quantite invalide";
}

if(empty($_POST["new_currency"])){
    echo "Nouvelle monnaie invalide";
}

if(empty($_POST["password"])){
    echo "Mot de passe invalide";
}


$_POST['currency'] = htmlentities($_POST['currency'],  ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5);
$_POST['new_currency'] = htmlentities($_POST['new_currency'],  ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5);


//----------Verifier si c'est le bon password

$password = hash('sha256', $_POST['password']);

$user = $dbManager->select('SELECT * FROM user WHERE user_id = ?',[1]);
var_dump($user);

// regarde si le password correspond

if ($user[0]['password'] !== $password) {
	//set_errors('⚠️ Le mot de passe est incorrect', '/../index.php');

}


if(!is_numeric($_POST['amount'])){
    echo "Quantite n'est pas une valeur valide";
}


// Verifier si les deux devises existent (On va sélectionner les noms et l'id et value)

$_POST['currency'] = strtoupper($_POST['currency']);
$_POST['new_currency'] = strtoupper($_POST['new_currency']);

$sql = "SELECT * FROM currency";
$currency_data = $dbManager -> select($sql, []);

$currency_is_good = false;
$new_currency_is_good = false;

foreach($currency_data as $array){
    if($array["name"]==$_POST['currency']){
        $currency_is_good = true;
        $currency_id = $array["currency_id"];
    }
    if($array["name"]==$_POST['new_currency']){
        $new_currency_is_good = true;
        $new_currency_id = $array["currency_id"];
        $new_currency_value = $array["value"];
    }
}

if(!$currency_is_good || !$new_currency_is_good){
    echo "Monnaie inexistante";
}

//--Verifier si dans le premier compte (celui où on va retirer l'argent), on a plus d'argent que l'input saisi

$sql = "SELECT amount FROM account WHERE id_currency = ? AND id_user = 1";
$total_amount = $dbManager->select($sql,[$currency_id]);
var_dump($total_amount);

if(!$total_amount){
    echo "Vous n'avez pas de compte avec cette devise";
}

if($total_amount[0]["amount"]<$_POST["amount"]){
    echo "Vous n'avez pas assez d'argent";
}

$amount = $_POST["amount"];

//-- Verifier si le deuxieme compte avec la monnaie du 2eme input currency existe

$sql = "SELECT account_id,amount FROM account WHERE id_currency = ? AND id_user = 1";
$second_account = $dbManager->select($sql,[$new_currency_id]);

if(!$second_account){
    echo "Vous n'avez pas de compte avec cette devise";
}

//-- Faire une premiere transaction de depot

$sql = "INSERT INTO transaction (id_receiver, id_sender, id_manager, id_currency, type, amount)
VALUES (?,?,?,?,?,?)";
$data = [1,1,-1, $currency_id, "deposit", $amount];

$dbManager -> insert($sql, $data);

//-- Faire une deuxieme transaction de depos

$sql = "INSERT INTO transaction (id_receiver, id_sender, id_manager, id_currency, type, amount)
VALUES (?,?,?,?,?,?)";
$data = [1,1,-1, $new_currency_id, "withdrawal", $amount * $new_currency_value ];

$dbManager -> insert($sql, $data);

//-- Faire une requete qui diminue l'argent

$sql = "UPDATE Account
SET amount = ?
WHERE account_id = ?";

var_dump($second_account);

$data = [$total_amount[0]["amount"] - $amount ,$second_account[0]["account_id"]];

?>