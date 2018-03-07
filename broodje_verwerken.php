<?php

session_start();

require_once('Brood.php');
require_once('Order.php');
require_once('Validatie.php');
require_once('file_handler.php');
require_once __DIR__ . './config.php';
require_once('User.php');

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

		/*
		@TODO: Onderstaande query nakijken met database en Order class
		*/

		$queryOrder = $pdo->prepare('INSERT INTO order ("user_id","datum", "soep", "soepbrood_wit") VALUES (?, ?, ?, ?)');
		$queryOrder->bindValue(1, 1, PDO::PARAM_INT);
		$queryOrder->bindValue(2, date("Y-m-d H:i:s"), PDO::PARAM_STR);
		$queryOrder->bindValue(3, $myOrder->getSoep(), PDO::PARAM_BOOL);
		$queryOrder->bindValue(4, $myOrder->getSoepBroodWit(), PDO::PARAM_BOOL);
		$queryOrder->execute();

		$orderId = $pdo->lastInsertId();
		

		foreach($broodjes as $broodje) {

			$queryBroodje = $pdo->prepare('INSERT INTO broodje ("is_groot", "beleg_id", "supplement_id", "is_wit", "opmerking") VALUES (?, ?, ?, ?, ?)');
			$queryBroodje->bindValue(1, $broodje->getBaguette(), PDO::PARAM_BOOL);
			$queryBroodje->bindValue(2, $broodje->getTypeBeleg(), PDO::PARAM_INT);
			$queryBroodje->bindValue(3, $broodje->getSupplement(), PDO::PARAM_INT); // waar haal ik dit uit
			$queryBroodje->bindValue(4, $broodje->getFitness(), PDO::PARAM_BOOL);
			$queryBroodje->bindValue(5, $broodje->getOpmerking(), PARAM::PARAM_STR);
			$queryBroodje->execute();

			$broodjeId = $pdo->lastInsertId();

			$queryOrderBroodje = $pdo->prepare('INSERT INTO order_broodje("order_id", "broodje_id", "aantal") VALUES (?, ?, ?)');
			$queryOrderBroodje->bindValue(1, $orderId, PDO::PARAM_INT);
			$queryOrderBroodje->bindValue(2, $broodjeId, PDO::PARAM_INT);
			$queryOrderBroodje->bindValue(3,$broodje->getAantalBroodjes, PDO::PARAM_INT);
			$queryOrderBroodje->execute();

		}

		// connectie sluiten ?
		




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