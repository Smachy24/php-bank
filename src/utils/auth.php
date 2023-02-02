<?php

function get_session_user() {
	if (isset($_SESSION['user_id'])) {
		return $_SESSION['user_id'];
	}
	return false;
}

function get_user_by_id($id) {
	global $db;
    //attention au nom de la table user sans s et le champs qui est user_id et non pas juste id 
	$query = $db->prepare('SELECT * FROM user WHERE user_id = ?');
	$query->execute([$id]);
	$query->setFetchMode(PDO::FETCH_ASSOC);
	$user = $query->fetch();
	return $user;
}