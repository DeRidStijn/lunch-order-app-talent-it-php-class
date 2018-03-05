<?php

session_start();

require_once('Brood.php');
require_once('Order.php');
require_once('Validatie.php');
require_once('file_handler.php');

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

	// validator

	$orderValidator = new orderValidator($myOrder);
	$errors = [];

	if ($orderValidator->isValid()) {
		foreach ($broodjes as $broodje) {
			$broodjeValidator = New broodValidator($broodje);
			if(!$broodValidator->isValid()) {
				$errors[] = $broodValidator->getErrors();
			}
		}
    } else {
        $errors[] = $orderValidator->getErrors();
    }

    if([] === $errors) {
		$fileHandler->create();
		Header('Location: index.php');
	} else {
		$_SESSION['errors'] = $errors;
        Header('Location: index.php');
	}
}
?>