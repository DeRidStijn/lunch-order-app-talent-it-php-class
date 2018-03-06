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