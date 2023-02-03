<?php

require_once __DIR__ . '/../../src/init.php';


//Verification du formulaire
if(!isset($_POST["currency"]) || !isset($_POST["amount"]) ||!isset($_POST["new_currency"]) || !isset($_POST["password"])){
    set_errors("⚠️Formulaire non existant", '/../index.php?page=convertion');
}

if(empty($_POST["currency"])){
    set_errors("⚠️Monnaie invalide", '/../index.php?page=convertion');
}

if(empty($_POST["amount"])){
    set_errors("⚠️Monnaie invalide", '/../index.php?page=convertion');
}

if(empty($_POST["new_currency"])){
    set_errors("⚠️Nouvelle monnaie invalide", '/../index.php?page=convertion');
}

if(empty($_POST["password"])){
    set_errors("⚠️Mot de passe invalide", '/../index.php?page=convertion');
}

if($_POST["currency"]==$_POST["new_currency"]){
    set_errors("⚠️Vous ne pouvez pas convertir les memes monnaies", '/../index.php?page=convertion');
}


$_POST['currency'] = htmlentities($_POST['currency'],  ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5);
$_POST['new_currency'] = htmlentities($_POST['new_currency'],  ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5);


//----------Verifier si c'est le bon password

$password = hash('sha256', $_POST['password']);

$user = $dbManager->select('SELECT * FROM user WHERE user_id = ?',[$_SESSION['user_id']]);

// regarde si le password correspond

if ($user[0]['password'] !== $password) {
	set_errors("⚠️Mot de passe incorrect", '/../index.php?page=convertion');

}


if(!is_numeric($_POST['amount'])){
    set_errors("⚠️Quantité n'est pas une valeur valide", '/../index.php?page=convertion');
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
        $currency_value = $array["value"];
    }
    if($array["name"]==$_POST['new_currency']){
        $new_currency_is_good = true;
        $new_currency_id = $array["currency_id"];
        $new_currency_value = $array["value"];
    }
}

if(!$currency_is_good || !$new_currency_is_good){
    set_errors("⚠️Monnaie inexistante", '/../index.php?page=convertion');
}

//--Verifier si dans le premier compte (celui où on va retirer l'argent), on a plus d'argent que l'input saisi

$sql = "SELECT account_id,amount FROM account WHERE id_currency = ? AND id_user = ?";
$first_account = $dbManager->select($sql,[$currency_id, $_SESSION['user_id']]);

if(!$first_account){
    echo "Vous n'avez pas de compte avec cette devise";
}

if($first_account[0]["amount"]<$_POST["amount"]){
    set_errors("⚠️Vous n'avez pas assez d'argent", '/../index.php?page=convertion');
}

$amount = $_POST["amount"];

//-- Verifier si le deuxieme compte avec la monnaie du 2eme input currency existe

$sql = "SELECT account_id,amount FROM account WHERE id_currency = ? AND id_user = ?";
$second_account = $dbManager->select($sql,[$new_currency_id, $_SESSION['user_id']]);

if(!$second_account){
    echo "Vous n'avez pas de compte avec cette devise";
}

//-- Faire une premiere transaction de retrait

$sql = "INSERT INTO transaction (id_receiver, id_sender, id_manager, id_currency, type, amount)
VALUES (?,?,?,?,?,?)";
$data = [$_SESSION['user_id'],$_SESSION['user_id'],-1, $currency_id, "withdrawal", $amount];

$dbManager -> insert($sql, $data);

//-- Faire une deuxieme transaction de depos

$sql = "INSERT INTO transaction (id_receiver, id_sender, id_manager, id_currency, type, amount)
VALUES (?,?,?,?,?,?)";
$data = [$_SESSION['user_id'],$_SESSION['user_id'],-1, $new_currency_id, "deposit", $amount * $new_currency_value ];

$dbManager -> insert($sql, $data);

//-- Faire une requete qui diminue l'argent

$sql = "UPDATE Account
SET amount = ?
WHERE account_id = ?";

$data = [$first_account[0]["amount"] - $amount  ,$first_account[0]["account_id"]];

$dbManager->update($sql, $data);

// Faire une requete qui ajoute de l'argent

$sql = "UPDATE Account
SET amount = ?
WHERE account_id = ?";


$data = [$second_account[0]["amount"] + $amount * $new_currency_value /$currency_value ,$second_account[0]["account_id"]];

$dbManager->update($sql, $data);

set_errors("Convertion terminée", '/../index.php?page=convertion');

?>