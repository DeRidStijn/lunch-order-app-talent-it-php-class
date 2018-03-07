<?php

session_start();

require_once('User.php');
require_once __DIR__ . '/config.php';

$pdo = new PDO($config['dsn'], $config['username'], $config['password'], $config['options']);

if([] !== $_POST) {

	$email = $_POST['email'];
	$password = $_POST['password'];

	$qryLogin = $pdo->prepare('SELECT * FROM `user` WHERE email = ?');
	$qryLogin->bindValue(1, $email, PDO::PARAM_STR);
	
	if(false === $qryLogin->execute()) {
		$_SESSION['error'] = 'De combinatie email en/of paswoord is niet gevonden in onze database.';
		$_SESSION['loggedin'] = false;
		Header('Location: login.php');
	}

	$loginArray = $qryLogin->fetchAll();

	$hash = $loginArray['password'];

	if (password_verify($password, $hash)) {
		$_SESSION['loggedin'] = true;
		$myUser = New User($loginArray['naam'], $loginArray['voornaam'], $loginArray['is_admin'], $loginArray['potje'], $loginArray['email']);
		$_SESSION['user'] = $myUser;
		Header('Location: index.php');
	} else {
		$_SESSION['error'] = 'De combinatie email en/of paswoord is niet gevonden in onze database.';
		$_SESSION['loggedin'] = false;
		Header('Location: login.php');
	}
}

?>