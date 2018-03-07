<?php

require_once __DIR__ . '/config.php';

session_start();

$pdo = new PDO($config['dsn'], $config['username'], $config['password'], $config['options']);

if([] !== $_POST) {
	
	/*
	@TODO: Soep input nog valideren
	*/

	/*
	UPDATE table_name
	SET column1=value, column2=value2,...
	WHERE some_column=some_value 
	*/

	$qrySoep = $pdo->prepare('SELECT * FROM `soep`');
	$qrySoep->execute();

	$errors = [];

	$soepteller = 0;
	while($row = $qrySoep->fetch()) {
		++$soepteller;
		if($row['soep'] != $_POST['soep'.$soepteller]) {
			$qryUpdateSoep = $pdo->prepare('UPDATE `soep` SET soep = ? WHERE id = ?');
			$qryUpdateSoep->bindValue(1, $_POST['soep'.$soepteller], PDO::PARAM_STR);
    		$qryUpdateSoep->bindValue(2, $soepteller, PDO::PARAM_INT);
			 if(!$qryUpdateSoep->execute()) {
			 	$errors[] = 'Er ging iets fout met het verwerken van de soep: ' . $_POST['soep'.$soepteller];
			 }
		}
	}

	if([] !== $errors) {
		$_SESSION['errors'] = $errors;
	} else {
		$_SESSION['success'] = 'De soepen zijn succesvol aangepast.';
	}

	Header('Location: dashboard.php?page=soepvdag');
}

?>