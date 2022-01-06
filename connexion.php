<?php

try
{

/*$VALEUR_hote='localhost';
$VALEUR_port='3306';
$VALEUR_nom_bd='e-commerce';
$VALEUR_user='root';
$VALEUR_mot_de_passe=''; */
$VALEUR_hote='formatuformation.mysql.db';
$VALEUR_port='3306';
$VALEUR_nom_bd='formatuformation';
$VALEUR_user='formatuformation';
$VALEUR_mot_de_passe='Formatu00formation';

$connexion = new PDO('mysql:host='.$VALEUR_hote.';port='.$VALEUR_port.';dbname='.$VALEUR_nom_bd, $VALEUR_user, $VALEUR_mot_de_passe);
$connexion->exec("SET NAMES utf8");

}
catch (Exception $e)
{  

	      
    die('Erreur : ' . $e->getMessage());
}




?>
