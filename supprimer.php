<?php 

include ("connexion.php");
session_start();
if(empty($_SESSION["admin"]))
{
	header("Location: index.php");
} 


else {
    
    if ($resultats = $connexion->query( "delete from produit where id_produit='".$_GET["id"]."'" ) ) 
{
    header("Location: index_admin.php?supprimer=oui");
} 
else {
    header("Location: index_admin.php?supprimer=non");
}
}

?>