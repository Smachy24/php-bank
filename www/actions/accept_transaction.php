<!-- <h1>transaction </h1> -->


<?php //var_dump($_GET)?>
<?php 

require_once __DIR__ . '/../../src/init.php';
$myTable = $_GET['type_transaction'];
$type_transaction = $_GET['type_transaction'];
$id_transaction = $_GET['id_transaction'];
$id_manager = $_SESSION['user_id'];
echo "<br>";

echo $myTable;
echo "<br>";



$sql = "SELECT id_user, id_currency , amount
             FROM ".$myTable."
             WHERE " .$myTable."_id = " . $_GET['id_transaction'];
echo $sql;
echo "<br>";


        $req = $db->prepare($sql);
        $req->execute();
        $result = $req->fetch();


$id_user = $result['id_user'];
$id_currency = $result['id_currency'];
$amount = $result["amount"];
    


//TODO effectué un update sur le compte du id_user

//On récupère l'argent du compte de l'user
$sql = "SELECT amount FROM account WHERE id_currency =  ?  AND id_user = ?";
$user_money = $dbManager->select($sql,[$result['id_currency'], $result['id_user'] ]);
var_dump($user_money);
echo "<br>";
var_dump($result["amount"]);
echo "<br>";

echo $user_money[0]["amount"];
echo "<br>";

echo $result["amount"];
echo "<br>";

if ($myTable == "deposit")
{
    $new_money = $user_money[0]["amount"] + $result["amount"];
}
elseif ($myTable == "withdrawal")
{
    $new_money = $user_money[0]["amount"] - $result["amount"];
}

echo $new_money;
echo $result['id_currency'];

// On modifie l'argent de l'utilisateur
$sql = "UPDATE account SET amount = ? WHERE id_currency =  ?  AND id_user = ?";
$dbManager->update($sql,[$new_money ,$result['id_currency'], $result['id_user'] ]);



//TODO généré une transaction avec toutes ces donné

//-- Faire une premiere transaction de depot
$sql = "INSERT INTO transaction (id_receiver, id_sender, id_manager, id_currency, type, amount)
VALUES (?,?,?,?,?,?)";
$data = [$result['id_user'],$result['id_user'],$id_manager, $result['id_currency'], $_GET['type_transaction'] , $result["amount"]];
$dbManager -> insert($sql, $data);



//on repasse en parametre d'url id et type pour que supr puisse a son tour les utilisé 
header('Location: /actions/delete_transaction.php?id_transaction='. $_GET['id_transaction'] .'&type_transaction='. $myTable. '')
?>