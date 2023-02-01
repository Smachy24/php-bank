<?php

require_once __DIR__ . '/../../src/init.php';

// Voir si les champs sont remplis

if (!isset($_POST['email'], $_POST['fullname'], $_POST['password'], $_POST['cpassword'])) {
	set_errors('⚠️ Formulaire incomplet', '/register.php');

}

// Voir si l'email est valide 

if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
	set_errors('⚠️ Email invalide', '/register.php');
}
// Voir si l'email est déjà utilisé ou pas

$recupEmail = $db->prepare('SELECT * FROM User WHERE email = ?');
$recupEmail->execute(array($_POST['email']));

var_dump($recupEmail);

if($recupEmail->rowCount()>0) {
	$_POST['email'] = $recupEmail;
	set_errors('⚠️ Un compte est déjà associé avec cette adresse email', '/register.php');
}

// Voir si le nom est renseigné, et ne dépasse pas 100 caractères

if (empty($_POST['fullname']) || strlen($_POST['fullname']) > 100) {
	set_errors('⚠️ Nom Complet non renseigné', '/register.php');
}

// Voir si les deux mots de passes correspondent

if (empty($_POST['password']) || ($_POST['password'] !== $_POST['cpassword'])) {
	set_errors('⚠️ Le mots de passe ne correspondent pas', '/register.php');
}

// Sécurise pour psa mettre de script, + hash le password

$_POST['fullname'] = htmlentities($_POST['fullname'],  ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5);
$_POST['password'] = hash('sha256', $_POST['password']);

// Role = 1 = user non verifié

$_POST['role'] = 1;


// On enleve la confirmation du password
unset($_POST['cpassword']);

$query = $db->prepare('INSERT INTO user (role, fullname, email, password) VALUES(:role, :fullname, :email, :password)');
$query->execute($_POST);

header('Location: /login.php');