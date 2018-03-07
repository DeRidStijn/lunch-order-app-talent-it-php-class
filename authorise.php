<?php

require_once __DIR__ . './config.php';

session_start();

$pdo = new PDO($config['dsn'], $config['username'], $config['password'], $config['options']);

if([] !== $_POST) {

	$email = $_POST['email'];
	$password = $_POST['password'];

	$qryLogin = $pdo->prepare('SELECT id, password FROM `user` WHERE email = ?');
	$qryLogin->bindValue(1, $email, PDO::PARAM_STR);
	$qryLogin->execute();

	$loginArray = $qryLogin->fetchAll();

	$hash = $loginArray['password'];

	if (password_verify($password, $hash)) {
		$_SESSION['success'] = 'ingelogd';
		$_SESSION['loggedin'] = true;
		Header('Location: login.php');
	} else {
		$_SESSION['error'] = 'De combinatie email en/of paswoord is niet gevonden in onze database.';
		$_SESSION['loggedin'] = false;
		Header('Location: login.php');
	}


	if($loginArray['password'])
}

?>