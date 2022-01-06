<?php
session_start();
if(!empty ($_SESSION["admin"]))
{
	header("Location: index_admin.php");
} 

include( "connexion.php" );
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> site e-commerce </title>
  <link rel="stylesheet" href="style_index.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css" />
</head>
<body>
  <!-- Barre de navigation -->
  <nav>
    <h1>E-commerce </h1>
    
    <h2> <?php 
    if (!empty ($_GET["acheter"])){
if($_GET["acheter"]=="oui") 
{
    echo "produit acheter avec succes " ; 
}
elseif ($_GET["acheter"]=="non"){
    echo"produit non acheter";
} 
}
?></h2>
    <div class="onglets">
    <p> <form method="post" action="index_rech.php">
    <button type="submit" class="rech">
    <i class='fas fa-search'></i>
        </button>
        <input type="search" placeholder="rechercher" name="search"/>
        
      
        
        
        
      </form></p>
      <p class="link"><a href="nouveautés.php">Nouveautés</a></p>
      <p class="link"><a href="homme.php">Homme</a></p>
      <p class="link"><a href="femme.php">Femme</a></p>
      <p class="link"><a href="enfant.php">Enfant</a></p>
      <p class="link"><a href="cadeaux.php">Cadeaux</a></p>
      <p class="link"> <?php

if(empty($_SESSION["etat"]))
{
	echo "<a href='login.php'>Se connecter</a>";
} 
else echo"<a href='deconnexion.php'>deconnecter</a>";
?></p> <p><a href="panier.php" onclick="window.open(this.href, '', 
'toolbar=no, location=no, directories=no, status=yes, scrollbars=yes, resizable=yes, copyhistory=no, width=600, height=350'); return false;"><i class="fas fa-shopping-cart"></i> panier</a></div>
        
          
        </p>

      
     
     
      
    </div>
  </nav>
  <!-- Fin de la barre de navigation -->
  
  <!-- Header -->
   <header>
     <h1>C'est votre boutique, votre chez-vous.</h1>
     <button>Naviguer <i class="fas fa-paper-plane"></i></button>
   </header>
  <!-- Fin du header -->
  
  <!-- Section principale -->
  <section class="main">
  <div class="cards">
    <!-- Toutes les cartes -->
    <?php
        
        $resultats = $connexion->query( "SELECT * from lesproduits where genre='homme'" );
        $resultats->setFetchMode( PDO::FETCH_OBJ );
       
        if ( $resultats->rowCount() >= 1 ) {
        while ( $resultat = $resultats->fetch() ) {

    ?>
    
      
      <div class="card">
      <img src="upload/<?php if($resultat->photo==""){echo "image.jpg";} else {echo  $resultat->photo; }?>" >
        <div class="card-header">
          <h4 class="title" ><?php  echo  $resultat->nom; ?></h4>
          <h4 class="price" ><?php  echo  $resultat->prix; ?>dt</h4>
        </div>
        <div class="card-body">
          <p ><?php  echo  $resultat->détails; ?></p> 
          <div class="acheter"><a href="panier.php?action=ajout&amp;l=<?php  echo  $resultat->nom; ?>&amp;q=1&amp;p=<?php  echo  $resultat->prix; ?>" onclick="window.open(this.href, '', 
'toolbar=no, location=no, directories=no, status=yes, scrollbars=yes, resizable=yes, copyhistory=no, width=700, height=500'); return false;">Ajouter au panier</a></div>
         <!-- <div class="acheter"><a href="acheter.php?id=<?php  echo  $resultat->id_produit; ?> ">acheter</a></div> -->
          
        </div>
      
    
      
      
     
      
     </div>
     <?php
       }

          } else {
             echo 'le site est vide';
             }

?>
</div>
    <!-- Fin de toutes les cartes -->
    
    <!-- Video de presentation -->
    <div class="video">
      <iframe src="https://www.youtube.com/embed/2COSkxxOtXY" allowfullscreen></iframe>
    </div>
    <!-- Fin de la video de presentation -->
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
