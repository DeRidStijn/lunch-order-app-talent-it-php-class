<?php

$broodjesRepo = __DIR__ . '/broodjes.csv';

$broodjesData = [];
if ($fp = fopen($broodjesRepo, 'r')) {
    while (!feof($fp)) {
        list($category, $topping, $priceSmall, $priceBig, $description) = fgetcsv($fp, 1024, ';');
        $broodjesData[] = [
            'categorie' => $category,
            'naam' => $topping,
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

$categoryStmt = $pdo->prepare('INSERT INTO `categorie` (`categorie`) VALUES (?)');
$belegStmt = $pdo->prepare('INSERT INTO `beleg` (`prijs_klein`, `prijs_groot`, `naam`, `omschrijving`, `categorie_id`) VALUES (?, ?, ?, ?, ?)');

$categories = [];
foreach (array_slice($broodjesData, 1) as $broodje) {

    if (!array_key_exists($broodje['categorie'], $categories)) {
        $categoryStmt->bindValue(1, $broodje['categorie'], PDO::PARAM_STR);
        $categoryStmt->execute();
        $categoryId = $pdo->lastInsertId();
        $categories[$broodje['categorie']] = (int) $categoryId;   
    } 
    $belegStmt->bindValue(1, $broodje['prijs_klein']);
    $belegStmt->bindValue(2, $broodje['prijs_groot']);
    $belegStmt->bindValue(3, $broodje['naam'], PDO::PARAM_STR);
    $belegStmt->bindValue(4, $broodje['omschrijving'], PDO::PARAM_STR);
    $belegStmt->bindValue(5, $categories[$broodje['categorie']], PDO::PARAM_INT);
    $belegStmt->execute();

}

$supplementenlijst  = ['smos_groot', 'smos_klein', 'tabasco', 'chilly'];
$suppPrijs =  [0.8, 0.5, 0.2, 0.2];
$suppCount = 0;
foreach ($supplementenlijst as $supplement)
{
    $supplementStmt = $pdo->prepare('INSERT INTO `supplement`(`supplement`, `prijs`) VALUES (?, ?)');
    $supplementStmt->bindvalue(1, $supplement, PDO::PARAM_STR);
    $supplementStmt->bindvalue(2, $suppPrijs[$suppCount]);
    $supplementStmt->execute();
    $suppCount ++;
}


$soepenlijst = ['Tomatensoep met balletjes', 'Witloofsoep', 'Heldere kippensoep', 'Pompoensoep', 'Kervelsoep', 'Niet beschikbaar', 'Niet beschikbaar'];

foreach ($soepenlijst as $soep) {
    $soepStmt = $pdo->prepare('INSERT INTO `soep` (`soep`) VALUES (?)');
    $soepStmt->bindValue(1, $soep, PDO::PARAM_STR);
    $soepStmt->execute();
}

$password = password_hash('finesse', PASSWORD_DEFAULT);

$adminStmt = $pdo->prepare('INSERT INTO `user` (`naam`, `voornaam`, `password`, `email`, `potje`, `is_admin`) VALUES (?, ?, ?, ?, ?, ?)');
$adminStmt->bindValue(1, 'Doe', PDO::PARAM_STR);
$adminStmt->bindValue(2, 'John', PDO::PARAM_STR);
$adminStmt->bindValue(3, $password);
$adminStmt->bindValue(4, 'johndoe@talent.it', PDO::PARAM_STR);
$adminStmt->bindValue(5, 0);
$adminStmt->bindValue(6, 1, PDO::PARAM_BOOL);
if (false === $adminStmt->execute()) {
    var_dump($adminStmt->errorInfo());
}