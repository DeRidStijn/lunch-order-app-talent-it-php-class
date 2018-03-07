<?php

$broodjesRepo = __DIR__ . '/broodjes.csv';

$broodjesData = [];
if ($fp = fopen($broodjesRepo, 'r')) {
    while (!feof($fp)) {
        list($category, $topping, $priceSmall, $priceBig, $description) = fgetcsv($fp, 1024, ';');
        $broodjesData[] = [
            'categorie' => $category,
            'beleg' => $topping,
            'prijs_klein' => (float) str_replace(',', '.', $priceSmall),
            'prijs_groot' => (float) str_replace(',', '.', $priceBig),
            'omschrijving' => $description,
        ];
    }
    fclose($fp);
}

$config = [
    'dsn' => 'mysql:host=localhost;dbname=broodjesapp;charset=utf8',
    'username' => 'broodjesapp',
    'password' => 'php123',
    'options' => [],
];
$pdo = new PDO($config['dsn'], $config['username'], $config['password'], $config['options']);

$categoryStmt = $pdo->prepare('INSERT INTO `category` (`category`) VALUES (?)');
$belegStmt = $pdo->prepare('INSERT INTO `beleg` (`prijs_klein`, `prijs_groot`, `beleg`, `omschrijving`) VALUES (?, ?, ?, ?)');

$categories = [];
foreach ($broodjesData as $broodje) {

    /**
     * @todo Create table for category of sandwiches
     *
    if (!array_key_exists($broodje['categorie'], $categories)) {
        $categoryStmt->bindValue(1, $broodje['categorie'], PDO::PARAM_STR);
        $categoryStmt->execute();
        $categoryId = $pdo->lastInsertId();
        $categories[$broodje['categorie']] = (int) $categoryId;
    }*/

    $belegStmt->bindValue(1, $broodje['prijs_klein']);
    $belegStmt->bindValue(2, $broodje['prijs_groot']);
    $belegStmt->bindValue(3, $broodje['beleg'], PDO::PARAM_STR);
    $belegStmt->bindValue(4, $broodje['omschrijving'], PDO::PARAM_STR);
//    $belegStmt->bindValue(5, $categories[$broodje['categorie']], PDO::PARAM_INT);
    $belegStmt->execute();
}

$soepenlijst = ['Tomatensoep met balletjes', 'Witloofsoep', 'Heldere kippensoep', 'Pompoensoep', 'Kervelsoep', 'Niet beschikbaar', 'Niet beschikbaar'];

foreach ($soepenlijst as $soep) {
    $soepStmt = $pdo->prepare('INSERT INTO `soep` (`soep`) VALUES (?)');
    $soepStmt->bindValue(1, $soep, PDO::PARAM_STR);
    $soepStmt->execute();
}

$password = password_hash("finesse", PASSWORD_DEFAULT);

$adminStmt = $pdo->prepare('INSERT INTO `user` (`naam`, `voornaam`, `password`, `email`, `potje`, `is_admin`) VALUES (?, ?, ?, ?, ?, ?)');
$adminStmt->bindValue(1, 'Doe', PDO::PARAM_STR);
$adminStmt->bindValue(2, 'John', PDO::PARAM_STR);
$adminStmt->bindValue(3, $password, PDO::PARAM_STR);
$adminStmt->bindValue(4, 'johndoe@talent.it', PDO::PARAM_STR);
$adminStmt->bindValue(5, 0);
$adminStmt->bindValue(6, 1, PDO::PARAM_BOOL);
if (false === $adminStmt->execute()) {
    var_dump($adminStmt->errorInfo());
}