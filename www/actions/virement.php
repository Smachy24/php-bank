<?php

require_once __DIR__ . '/../../src/init.php';


// verifie si le form est complet
if (!isset($_POST['device'], $_POST['amount'], $_POST['iban'])) {
    set_errors('⚠️ Formulaire incomplet', '/../index.php?page=virement');
}

// verifie si la devise est reseigner
if (empty($_POST['device'])) {
    set_errors('⚠️ Devise non renseigné', '/../index.php?page=transfer');
}
// verifie si la devise est reseigner
if (empty($_POST['amount'])) {
    set_errors('⚠️ amount non renseigné', '/../index.php?page=transfer');
}
// verifie si la devise est reseigner
if (empty($_POST['iban'])) {
    set_errors('⚠️ iban non renseigné', '/../index.php?page=transfer');
}

$_POST['device'] = strtoupper($_POST['device']);

//verifie si devise existe
//$recupDevice = $dbManager->select('SELECT * FROM currency WHERE name = ?',[$_POST['device']]);


$sql = "SELECT currency_id,name FROM currency";
$data = $dbManager -> select($sql, []);

$currency_is_good = false;

foreach($data as $array){
    if($array["name"]==$_POST['device']){
        $currency_is_good = true;
        $currency_id = $array["currency_id"];
        break;
    }
    
}

if(!$currency_is_good){
    set_errors("⚠️Cette devise n'existe pas", '/../index.php?page=transfer');
}


if(!is_numeric($_POST['amount'])){
    set_errors("⚠️Quantite n'est pas une valeur valide", '/../index.php?page=transfer');
}


// verifie si l'iban existe
$recupIban = $dbManager->select('SELECT * FROM account WHERE iban = ?',[$_POST['iban']]);

// si iban existe pas erreur
if(!$recupIban) {
    set_errors('⚠️ Cette iban est indisponible', '/../index.php?page=transfer');
}



//Verifier que l'utilisateur a assez d'argent

$sql = "SELECT amount FROM account WHERE id_currency = ? AND id_user = ?";

$total_amount = $dbManager->select($sql,[$currency_id, $_SESSION['user_id']]);
// var_dump($amount);

if(!$total_amount){
    echo "Vous n'avez pas de compte avec cette devise";
}

if($total_amount[0]["amount"]<$_POST["amount"]){
    set_errors("⚠️Vous n'avez pas assez d'argent", '/../index.php?page=transfer');
}


$amount = $_POST["amount"];

$sql = "SELECT account_id FROM account WHERE iban = ? ";
$data = [$_POST["iban"]];
$data_user = $dbManager->select($sql, $data);

var_dump($data_user);

$receiver_id = $data_user[0]["account_id"];


//-- Faire une premiere transaction de retrait

$sql = "INSERT INTO transaction (id_receiver, id_sender, id_manager, id_currency, type, amount)
VALUES (?,?,?,?,?,?)";
$data = [$receiver_id,$_SESSION['user_id'],-1, $currency_id, "withdrawal", $amount];

$dbManager -> insert($sql, $data);

//-- Faire une deuxieme transaction de depos

$sql = "INSERT INTO transaction (id_receiver, id_sender, id_manager, id_currency, type, amount)
VALUES (?,?,?,?,?,?)";
$data = [$_SESSION['user_id'],$receiver_id,-1, $currency_id, "deposit", $amount];

$dbManager -> insert($sql, $data);


//On récupère l'argent du receiver

$sql = "SELECT amount FROM account WHERE account_id = ?";
$data = [$receiver_id];
$receiver_money = $dbManager->select($sql, $data);


// On modifie l'argent de l'utilisateur du receiver

var_dump($receiver_money);
var_dump($amount);
var_dump($currency_id);
var_dump($receiver_id);

$receiver_money = $receiver_money[0]["amount"];
$total_amount = $total_amount[0]["amount"];

$sql = "UPDATE account SET amount = ? WHERE id_currency =  ?  AND account_id = ?";
$dbManager->update($sql,[($receiver_money + $amount) ,$currency_id, $receiver_id ]);



// On modifie l'argent du sender
$sql = "UPDATE account SET amount = ? WHERE id_currency =  ?  AND id_user = ?";
$dbManager->update($sql,[$total_amount - $amount ,$currency_id, $_SESSION['user_id'] ]);




?>