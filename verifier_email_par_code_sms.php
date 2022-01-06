<?php
		session_start();
		include('connexion.php') ; 
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
<div class="global">

<div class="container"> 
       <?php
      
	  if($_GET["erreur"]==1) 
	{
		echo "code incorrecte " ; 
	}
	 
	if(!$_POST["send"])
	{
		
	?>
	    <br><br><br><br><br><br><br><br>
        <form method="post" action="" enctype="multipart/form-data">
        
            <fieldset >
                 <legend> code-confirmation </legend>
                 <p>nous avons vous envoyé un message de verification de compte, vérifier votre telephone  </p> <br>
                 <input type="text" name="code" placeholder="entrer le code ici " required> <br>
                 <input type="submit" value="confirmer" name="send"  class="send">
                 
                 
            </fieldset>
            
             
      
        </form>
    </div>
    </div>
    <?php 
    }
	else
	{   
	
  if( ($_GET['id'])  ){
  
  $id=$_GET['id'];
  $cle=$_POST['code'];
  $resultats=$connexion->query("select * from client where id_utilisateur='".$id."' and confirmkey='".$cle."'  ");
  $resultats->setFetchMode(PDO::FETCH_OBJ);
		     if($resultats->rowCount()>0 ) {
                $resultat = $resultats->fetch();
                if ($resultat->etat!=1){
                    $etat=1;
                    $query = "update client set  `etat`='".$etat."' where `id_utilisateur`='".$id."'";
                    $resultat_1 =$connexion->query($query );
                    $_SESSION['id']=$id;
                    $_SESSION ['etat']= true ;
                    header("Location: index.php");
                }
         }
      else {
      echo " cle ou id incorrecte";
      }
 }
else { echo "aucun utilisateur trouvé";}

    }
		?>
        </body>
</html>