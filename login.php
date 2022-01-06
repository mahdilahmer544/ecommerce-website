<?php
session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="css/style login.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 	
<title>Document sans titre</title>
</head>

<body>
<br><br><br><br>
<div class="global">

<div class="container"> 
<?php
	include("connexion.php");
	//  PDO   & mysqli 
	if (!empty($_GET["erreur"])){
	if($_GET["erreur"]=="oui") 
	{
		echo "Login ou mot de passe est incorrecte" ; 
	}
}
if(empty($_POST["connexion"]))
{

?>	
	
<form method="post" action="login.php">
<fieldset >
<legend> connexion </legend>
<input type="texte"	 name="login" ><br>
<input type="password" name="password"> <br>
<input type="submit" value="connexion" name="connexion"  class="connexion">

<button type="button"  name="inscription"  class="inscription" 
onclick="window.location.href = 'inscription.php';"> inscription </button>
</fieldset>
</form><?php
}
	else{
		
		$login = $_POST["login"] ;
		$password  = $_POST["password"] ;
		//   '".."'   '".."'
		$resultats=$connexion->query("select * from client where login='".$login."' and password='".md5($password)."' ");
		$resultats->setFetchMode(PDO::FETCH_OBJ);
		$resultats2=$connexion->query("select * from admin where login='".$login."' and password='".md5($password)."' ");
		$resultats2->setFetchMode(PDO::FETCH_OBJ);
		if($resultats->rowCount()==1 ) 
		{
			$resultat = $resultats->fetch();
			$_SESSION["nom"] = $resultat->nom ; 
			$_SESSION["id"] = $resultat->id_utilisateur ; 
			$_SESSION["tel"]  = $resultat->tel ; 
			$_SESSION["adresse"]  = $resultat->adresse ;
			$_SESSION['etat']= true ;  
			header("Location: index.php");
		}
		elseif($resultats2->rowCount()==1 ) 
		{
			$resultat = $resultats->fetch();
			$_SESSION["admin"]  = true ;
			header("Location: index_admin.php");
		}
		else
		{
			 header("Location: login.php?erreur=oui");
		}
		
		
		
		
		
		
		
		
	
		
	}
	
	
	     ?>
	
	
	
</div>
</div>	     
</body>
</html>