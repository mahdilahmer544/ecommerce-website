<?php
		session_start();
		include('connexion.php') ; 
  if( ($_GET['id']) AND ($_GET['cle']) ){
  $id=$_GET['id'];
  $cle=$_GET['cle'];
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
		?>