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
    echo "Monnaie inexistante";
}

$amount = $_POST['amount'];
//On récupère l'argent du compte de l'user

// $sql = "SELECT amount FROM Account WHERE id_currency =  ?  AND id_user = ?";
// $user_money = $dbManager->select($sql,[$currency_id, 1]);


// On modifie l'argent de l'utilisateur

// $sql = "UPDATE Account SET amount = ? WHERE id_currency =  ?  AND id_user = ?";
// $dbManager->update($sql,[$user_money+$_POST['amount'],$currency_id, 1]);




// On insère une nouvelle ligne dans la table Deposit
$sql = "INSERT INTO deposit(id_user,id_currency,amount) VALUES (?, ?, ?)";
$data = [$_SESSION['user_id'],$currency_id,$amount];
$dbManager -> insert($sql, $data);



header('Location: /../index.php?page=deposit');





?>