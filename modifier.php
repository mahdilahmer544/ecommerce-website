<?php
session_start();
if(!$_SESSION["admin"])
{
	header("Location: index.php");
} 
include( "connexion.php" );

?>
<!DOCTYPE html>
<html>
<head>
<title>inscription</title>
<meta charset="utf-8">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
    <br><br><br><br>
<div class="global">

<div class="container"> 
       <?php
      
	if(empty($_POST["send"]))
	{
	$resultats = $connexion->query( "SELECT * from lesproduits where id_produit='".$_GET["id"]."'" );
        $resultats->setFetchMode( PDO::FETCH_OBJ );
        $resultat = $resultats->fetch() ;
	?>
        <form method="post" action="modifier.php" enctype="multipart/form-data">
        
            <fieldset >
                 <legend> modification </legend>
                  <input type="hidden" name="id"  value="<?php echo $resultat->id_produit; ?>"> <br>
                 <input type="text" name="name"  value="<?php echo $resultat->nom; ?>" required> <br>
                 <input type="text" name="prix"  value="<?php echo $resultat->prix; ?>" required> <br>
                 <input type="text" name="détails"  value="<?php echo $resultat->détails; ?>" required> <br>
			  <input type="file" name="avatar" >
                 <input type="submit" value="send" name="send" value=""  class="send">
                 
                 
            </fieldset>
            
             
      
        </form>
        <?php
	}
	else
	{
		
			
		$query = "update lesproduits set  `nom`='".$_POST["name"]."', `prix`='".$_POST["prix"]."', `détails`='".$_POST["détails"]."' where `id_produit`='".$_POST["id"]."'";
		
		if($_FILES["avatar"])
		{
			
$fichier = strtr($fichier,
     'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
     'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy'); 
//On remplace les lettres accentutées par les non accentuées dans $fichier.
//Et on récupère le résultat dans fichier
 
//En dessous, il y a l'expression régulière qui remplace tout ce qui n'est pas une lettre non accentuées ou un chiffre
//dans $fichier par un tiret "-" et qui place le résultat dans $fichier.
$fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
?>
Voilà, c'est tout pour la sécurité fondamentale. ;o)

3-3. Le code final▲
Voici en exclusivité, le code d'upload !

Code final de l'uploadSélectionnez
<?php
$dossier = 'upload/';
$fichier = basename($_FILES['avatar']['name']);
$taille_maxi = 100000;
$taille = filesize($_FILES['avatar']['tmp_name']);
$extensions = array('.png', '.gif', '.jpg', '.jpeg');
$extension = strrchr($_FILES['avatar']['name'], '.'); 
//Début des vérifications de sécurité...
if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
{
     $erreur = 'Vous devez uploader un fichier de type png, gif, jpg, jpeg, txt ou doc...';
}
if($taille>$taille_maxi)
{
     $erreur = 'Le fichier est trop gros...';
}
if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
{
     //On formate le nom du fichier ici...
     $fichier = strtr($fichier, 
          'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
          'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
     $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
     if(move_uploaded_file($_FILES['avatar']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
     {
          $query = "update lesproduits set  `nom`='".$_POST["name"]."', `prix`='".$_POST["prix"]."', `détails`='".$_POST["détails"]."', `photo`='".$fichier."' where `id_produit`='".$_POST["id"]."'";
     }
     else //Sinon (la fonction renvoie FALSE).
     {
          echo 'Echec de l\'upload !';
     }
}
else
{
     echo $erreur;
}} 


			
		
		//echo $query  ; 
		//exit() ; 
		if ( $resultat =$connexion->query($query )) 
		{
			
			header("Location: index_admin.php?modifier=oui");
		}
		
		else
			{
				header("Location: index_admin.php?modifier=non");
		}
			
		
	}
		
		?>
  
</div>
</div>

</div>
</body>
</html>