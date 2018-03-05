<?php 
/*
    sessie voor bestelde broodjes + gegevens persoon
*/
session_start();
if (isset($_POST['persoon']))
{
    $_SESSION['persoon']['naam'] = htmlspecialchars ($_POST['persoon']['naam']);
    $_SESSION['persoon']['voornaam'] = htmlspecialchars ($_POST['persoon']['voornaam']);
    header('index.php');
}
if (isset($_POST["bestelling"]))
{
    $_SESSION['bestelling']['isSmos'] = htmlspecialchars ($_POST['bestelling']['isSmos']);
    $_SESSION['bestelling']['isFitness'] = htmlspecialchars ($_POST['bestelling']['isFitness']);
    $_SESSION['bestelling']['typeBeleg'] = htmlspecialchars ($_POST['bestelling']['typeBeleg']);
    $_SESSION['bestelling']['isBaguette'] = htmlspecialchars ($_POST['bestelling']['isBaguette']);
    header('index.php');
}