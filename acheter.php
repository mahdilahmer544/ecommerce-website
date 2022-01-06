<?php
session_start();
if($_SESSION["admin"])
{
	header("Location: index_admin.php");
} 
elseif(!$_SESSION["etat"])
{ 
    $id=$_GET["id"];
	header("Location: inscription.php ");
} 
include( "connexion.php" );
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> site e-commerce </title>
  <link rel="stylesheet" href="style_acheter.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css" />
</head>
<body>
  <!-- Barre de navigation -->
  <nav>
    <h1>E-commerce </h1>
    
    <div class="onglets">
      <p class="link">Nouveautés</p>
      <p class="link">Homme</p>
      <p class="link">Femme</p>
      <p class="link">Enfant</p>
      <p class="link">Cadeaux</p>
      <p class="link"> <?php
session_start();
if(!$_SESSION["nom"])
{
	echo "<a href='login.php'>Se connecter</a>";
} 
else echo"<a href='deconnexion.php'>deconnecter</a>";
?></p>
      <form>
        <input type="search" placeholder="Rechercher">
      </form>
      
      <p><i class="far fa-heart"></i></p>
      <p><i class="fas fa-shopping-cart"></i></p>
    </div>
  </nav>
  <!-- Fin de la barre de navigation -->
  
  <!-- Header -->
   <header>
     <h3>livraison à domicile sur toute la tunisie</h3>
     
   </header>
  <!-- Fin du header -->
  
  <!-- Section principale -->
  <section class="main">
  <div class="cards">
    <!-- Toutes les cartes -->
    <?php
       $resultats = $connexion->query( "SELECT * from lesproduits where id_produit='".$_GET["id"]."'" );
       $resultats->setFetchMode( PDO::FETCH_OBJ );
       $resultat = $resultats->fetch() ;
       
       
    ?>
    
      
      <div class="card"> 
      <?php
      
      if(!$_POST["acheter"])
      {
      
      ?>
      <form action="acheter.php" method="post">
      <img src="upload/<?php if($resultat->photo==""){echo "image.jpg";} else {echo  $resultat->photo; }?>" >
        <div class="card-header">
         <h4 class="title" > <?php   echo  $resultat->nom; ?></h4>
         <h4 class="price" ><?php  echo  $resultat->prix;  ?>dt</h4> 
        <input type="hidden" name="id_produit" value="<?php  echo  $_GET["id"] ?>">  
        
        </div>
        <div class="card-body">
          <p ><?php  echo  $resultat->détails; ?></p> 
          <div class="achat">
               <p>
                   choisissez la quantité 
                    <select name="quant" id="quant" >

                    <option value="1"> 1 </option><option value="2"> 2 </option>
                     <option value="3"> 3 </option><option value="4"> 4 </option>
                     <option value="5"> 5 </option><option value="6"> 6 </option>
                    <option value="7"> 7 </option><option value="8"> 8 </option>
                    <option value="9"> 9 </option><option value="10"> 10 </option>
                    <option value="11"> 11  </option><option value="12"> 12 </option>
                    <option value="13"> 13 </option><option value="14"> 14 </option>
                    <option value="15"> 15  </option><option value="16"> 16 </option>
                    <option value="17"> 17  </option><option value="18"> 18 </option>
                    <option value="19"> 19 </option><option value="20"> 20 </option>
                    </select>

               </p>
          
               <input type="submit" name="acheter" value="acheter" class="acheter">
          </div>
        </div>
      
    
      
      
     
      
     </div>
     
</form>
<?php
	}
	elseif ($_POST["acheter"])
	{
    $resultats = $connexion->query( "SELECT * from lesproduits where id_produit='".$_POST["id_produit"]."'" );
    $resultats->setFetchMode( PDO::FETCH_OBJ );
    $resultat = $resultats->fetch() ;
   
    
          $query="INSERT INTO commande (nom_produit, prix,quantite,nom_client,tel,adresse) 
          VALUES ('".$resultat->nom."','".$resultat->prix."','".$_POST["quant"]."','".$_SESSION["nom"]."','".$_SESSION["tel"] ."','".$_SESSION["adresse"]."')  ";
          
          if ( $resultat =$connexion->query($query )) 
          {
              
            header("Location: sms/sendSms.php");
          }
          
          else
              {
                  header("Location: index.php?acheter=non");
          }
    }
    
?> 

</div>
    <!-- Fin de toutes les cartes -->
    
   
  </section>
  <!-- Fin de la section principale -->
  
  <!-- Pied de page -->
  <footer>
    <p>&copy; Contactez-nous au 55 305 405</p>
    <div class="social-media">
      <p><i class="fab fa-facebook-f"></i></p>
      <p><i class="fab fa-twitter"></i></p>
      <p><i class="fab fa-instagram"></i></p>
      <p><i class="fab fa-linkedin-in"></i></p>
    </div>
  </footer>
  <!-- Fin du pied de page -->
</body>
</html>
