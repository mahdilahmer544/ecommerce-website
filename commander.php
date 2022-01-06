<?php
session_start();
if(!$_SESSION["nom"])
{
	header("Location: login.php");
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
      
	if(!$_POST["send"])
	{
	$resultats = $connexion->query( "SELECT * from lesproduits where id_produit='".$_GET["id"]."'" );
        $resultats->setFetchMode( PDO::FETCH_OBJ );
        $resultat = $resultats->fetch() ;
	?>
        <form method="post" action="commander.php" enctype="multipart/form-data">
        
            <fieldset >
                 <legend> acheter </legend>
                  <input type="hidden" name="id"  value="<?php echo $resultat->id_produit; ?>"> <br>
                  nom de produit <input type="text" name="name"  value="<?php echo $resultat->nom; ?>" > <br>
                 prix<input type="text" name="prix"  value="<?php echo $resultat->prix; ?>" > <br>
                 détails<input type="text" name="détails"  value="<?php echo $resultat->détails; ?>" > <br>
                 quantité<input type="text" name="quantite"  value="1" required> <br>
                 <img src="upload/<?php if($resultat->photo==""){echo "image.jpg";} else {echo  $resultat->photo; }?>" width="350" height="350">
                 <input type="submit" value="commander" name="send" value=""  class="send">
                 
                 
            </fieldset>
            
             
      
        </form>
        <?php
	}
	else
	{
		
        
        //echo ""$nom $tel $adresse ;
        
		$query="INSERT INTO commande (nom_produit, prix,quantite,nom_client,tel,adresse) 
          VALUES ('".$_POST["name"]."','".$_POST["prix"]."','".$_POST["quantite"]."','".$_SESSION["nom"]."',
          '".$_SESSION["tel"]."','".$_SESSION["adresse"]."')  ";
          
         
	
          
		


			
		
		if ( $resultat =$connexion->query($query )) 
		{
			
			header("Location: index.php?acheter=oui");
		}
		
		else
			{
				header("Location: index.php?acheter=non");
		}
			
		
	}
		
		?>
  
</div>
</div>

</div>
</body>
</html>