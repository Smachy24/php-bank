<?php

require_once __DIR__ . '/../../src/init.php';


// Voir si les champs sont remplis

if (!isset($_POST['email'], $_POST['password'])) {
	set_errors('⚠️ Formulaire incomplet', '/../index.php?page=login');

}

// Verifie si l'email est valide

if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
	set_errors('⚠️ Email invalide', '/../index.php?page=login');

}

// hash le mdp

$password = hash('sha256', $_POST['password']);


// regarde si il existe

$user = $dbManager->select('SELECT * FROM user WHERE email = ?',[$_POST['email']]);
var_dump($user);


// regarde si le password correspond

if ($user[0]['password'] !== $password) {
	set_errors('⚠️ Le mot de passe est incorrect', '/../index.php?page=login');

}



header('Location: /index.php?page=home');