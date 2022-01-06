<?php
session_start();
if(!$_SESSION["admin"])
{
	header("Location: index.php");
} 

include( "connexion.php" );
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> site e-commerce </title>
  <link rel="stylesheet" href="style_admin.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css" />
</head>
<body>
<script>
if(ongelt_fermé){
$.ajax({
        url: 'deconnecter.php',
        type: 'POST',
        data: {action: 'deconnecter', id: id_de_la_personne_a_adeconnecter},
    })
}
</script>
<?php 
if (!empty($_GET["modifier"])){
if($_GET["modifier"]=="oui") 
{
    echo "produit modifier avec succes " ; 
}
elseif ($_GET["modifier"]=="non"){
    echo"produit non modifier";
} }
elseif (!empty($_GET["supprimer"])){
if ($_GET["supprimer"]=="oui"){
    echo"produit supprimer";
}
elseif ($_GET["supprimer"]=="non"){
    echo"produit non supprimer";
}}
elseif (!empty($_GET["ajouter"])){
if ($_GET["ajouter"]=="oui"){
    echo"produit ajouter";
}
elseif ($_GET["ajouter"]=="non"){
    echo"produit non ajouter";
}}
?>
  <!-- Barre de navigation -->
  <nav>
    <h1>E-commerce</h1>
    <div class="onglets">
    
    <p class="link"><a href="nouveautés.php">Nouveautés</a></p>
      <p class="link"><a href="homme.php">Homme</a></p>
      <p class="link"><a href="femme.php">Femme</a></p>
      <p class="link"><a href="enfant.php">Enfant</a></p>
      <p class="link"><a href="cadeaux.php">Cadeaux</a></p>
      <p class="link"><a href="deconnexion.php">deconnecter</a></p>
      
      
      <p><i class="far fa-heart"></i></p>
      <p><i class="fas fa-shopping-cart"></i></p>
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
        /* $res = $connexion->query( "SELECT id_produit from produit where prix between 39 and 50" );
        $res->setFetchMode( PDO::FETCH_OBJ );
        $table=0 ;
        while ($res_1=$res->fetch()){
        $table=$table.','.$res_1->id_produit ;
         }
        
        $resultats = $connexion->query( "SELECT * from produit where id_produit in ($table)   " );
        $resultats->setFetchMode( PDO::FETCH_OBJ ); */
        $resultats = $connexion->query( "SELECT * from lesproduits  " );
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
          <div class="liens">
                    <div class="lien"><a href="ajouter.php">ajouter</a></div>
                    <div class="lien"><a href="modifier.php?id=<?php  echo  $resultat->id_produit; ?>">modifier</a></div>
                    <div class="lien"><a onclick="javascript:return confirm('Are you sure you want to delete this comment?')"href="supprimer.php?id=<?php  echo  $resultat->id_produit; ?>">supprimer</a></div>
          </div>
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
