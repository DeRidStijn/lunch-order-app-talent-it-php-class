<?php

if([] !== $_POST) {

	// Basisinformatie

	$naam     = $_POST['naam'];
	$soepvdag = false;

	if('on' === $_POST['soepvdag']) {
		$soepvdag = true;
	}

	$aantalbroodjes = $_POST['aantalbroodjes'];

	$broodjes = [];

	for($x = 1; $x <= $aantalbroodjes; $x++) {

		$broodjes[$x-1]['aantal'] = $_POST['aantal_'.$x];
		$broodjes[$x-1]['grootte'] = $_POST['grootte_'.$x];
		$broodjes[$x-1]['smos'] = $_POST['smos_'.$x];
		$broodjes[$x-1]['type'] = $_POST['type_'.$x];
		$broodjes[$x-1]['fitness'] = $_POST['fitness_'.$x];

	}

	echo 'Naam: ' . $naam . '<br />';
	echo 'Soep van de dag: ' . $soepvdag . '<br />';

	echo 'Bestelde broodjes:<br /><ul>';

	foreach ($broodjes as $broodje) {
		echo '<li>'.$broodje['aantal'].'x ';
		if($broodje['grootte']) {
			echo 'groot ';
		} else {
			echo 'klein ';
		}
		if($broodje['smos']) {
			echo 'smos ';
		}
		if($broodje['fitness']) {
			echo 'bruin ';
		} else {
			echo 'wit ';
		}
		echo $broodje['type'] . '</li>';
	}

	echo '</ul>';
}
?>