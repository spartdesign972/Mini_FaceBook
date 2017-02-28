<?php
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=WF3MiniFaceBook;charset=utf8', 'root', '');//Je cible ma base
}
catch (Exception $e) //s'il y a une erreur alors il l'affiche
{
        die('Erreur : ' . $e->getMessage());
}