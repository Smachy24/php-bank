<?php

require_once __DIR__ . '/../../src/init.php';


// Voir si les champs sont remplis

if (!isset($_POST['email'], $_POST['password'])) {
	// set_errors('⚠️ Formulaire incomplet', '/login.php');
    echo "error";
}

// Verifie si l'email est valide

if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
	// set_errors('⚠️ Email invalide', '/login.php');
    echo "error";
}

// hash le mdp

$password = hash('sha256', $_POST['password']);


// regarde si il existe

$query = $db->prepare('SELECT * FROM user WHERE email = ?');
$query->execute([$_POST['email']]);
$query->setFetchMode(PDO::FETCH_ASSOC);
$user = $query->fetch();

// regarde si le password correspond

if ($user['password'] !== $password) {
	//set_errors('⚠️ Le mot de passe est incorrect', '/login.php');
    echo "error";
}


header('Location: /index.html');