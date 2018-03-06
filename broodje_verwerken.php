<?php

session_start();

require_once('Brood.php');
require_once('Order.php');
require_once('Validatie.php');
require_once('file_handler.php');
require_once __DIR__ . './config.php';

$pdo = new PDO($config['dsn'], $config['username'], $config['password'], $config['options']);

		

if([] !== $_POST) {

	$soepvdag = false;

	if('on' === $_POST['soepvdag']) {
		$soepvdag = true;
	}

	$aantalbroodjes = $_POST['aantalbroodjes'];

	$broodjes = [];

	for($x = 1; $x <= $aantalbroodjes; $x++) {

		// Per broodje een object van klasse brood instantieren

		$myBrood = New Brood($_POST['smos_'.$x], $_POST['fitness_'.$x], $_POST['type_'.$x], $_POST['grootte_'.$x], $_POST['aantal_'.$x]);
		$broodjes[] = $myBrood;

	}

	// Een order aanmaken met oa naam, soep en een array van het object broodjes

	$myOrder = New Order($_POST['naam'], $soepvdag, $broodjes);

	$_SESSION['order'] = $myOrder;

	// validator

	$orderValidator = new orderValidator($myOrder);
	$errors = [];

	if ($orderValidator->isValid()) {
		foreach ($broodjes as $broodje) {
			$broodValidator = New broodValidator($broodje);
			if(!$broodValidator->isValid()) {
				$errors[] = $broodValidator->getErrors();
			}
		}
    } else {
        $errors[] = $orderValidator->getErrors();
    }

    if([] === $errors) {

		//$naam = $_POST['naam'];

		$queryOrder = 'INSERT INTO order ("user_id","datum", "soep", "soepbrood_wit") VALUES (?, ?, ?, ?)';
		$queryBroodje = 'INSERT INTO broodje ("is_groot", "beleg_id", "supplement_id", "is_wit", "opmerking") VALUES (?, ?, ?, ?, ?)';
		$queryOrderBroodje ='INSERT INTO order_broodje("order_id", "broodje_id", "aantal") VALUES (?, ?, ?)';




    	//$myFileHandler = New FileHandler($myOrder);

		//$myFileHandler->create();

		$_SESSION['success'] = 'De broodjes zijn succesvol bestelt.';
		Header('Location: index.php');
	} else {
		$_SESSION['errors'] = $errors;
        Header('Location: index.php');
	}
}
?>