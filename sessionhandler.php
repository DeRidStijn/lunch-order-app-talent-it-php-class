<?php 
/*
    sessie voor bestelde broodjes + gegevens persoon
*/
session_start();
if (isset($_POST['persoon']))
{
    $_SESSION['persoon']['naam'] = $_POST['persoon']['naam'];
    $_SESSION['persoon']['voornaam'] = $_POST['persoon']['voornaam'];
    $_SESSION['persoon']['email'] = $_POST['persoon']['email'];
    header('index.php');
}
if (isset($_POST["bestelling"]))
{
    $_SESSION['bestelling']['isSmos'] = '';
    $_SESSION['bestelling']['isFitness'] = '';
    $_SESSION['bestelling']['typeBeleg'] = '';
    $_SESSION['bestelling']['isBaguette'] = '';
    header('index.php');
}