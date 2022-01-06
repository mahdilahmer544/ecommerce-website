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
    <br><br><br><br>
<div class="global">

<div class="container"> 
       <?php
      if (!empty($_GET["erreur"])){
	  if($_GET["erreur"]==1) 
	{
		echo "Login deja existe " ; 
	}
	elseif ($_GET["erreur"]==2){
		echo"utilisateur non ajouter";
	} 
}
	if(empty($_POST["send"]))
	{
		
	?>
	  
        <form method="post" action="inscription.php" enctype="multipart/form-data">
        
            <fieldset >
                 <legend> inscription </legend>
                 <input type="text" name="name" placeholder="Name " required> <br>
                 <input type="email" name="email" placeholder="Email " required> <br>
                 <input type="password" name="password" placeholder="password " required> <br>
                 <input type="tel" name="phone" placeholder="Phone Number" required> <br>
				 <input type="text" name="adresse" placeholder="adresse" required> <br>
                 <input type="submit" value="send" name="send"  class="send">
                 
                 
            </fieldset>
            
             
      
        </form>
        <?php
	}
	else
	{   
		
		$resultats=$connexion->query("select * from client where login='".$_POST["email"]."'  ");
		$resultats->setFetchMode(PDO::FETCH_OBJ);
		if($resultats->rowCount()==1 ) 
		{
			header("Location: inscription.php?erreur=1");
		}
		else
		{
			$longueurkey = 7 ;
			$key="";
			for ($i=1;$i<$longueurkey;$i++){
				$key.=mt_rand(0,9);
			}
         
		$etat=0 ;
		if ( $resultat =$connexion->query("INSERT INTO client (nom, login, password, tel,adresse,confirmkey,etat) 
		                                   VALUES ('".$_POST["name"]."','".$_POST["email"]."','".md5($_POST["password"])."',
								 		   '".$_POST["phone"]."',
										   '".$_POST["adresse"]."','".$key."','".$etat."')  ") )
		
										  
										   
		{
			

		     $resultats=$connexion->query("select * from client where login='".$_POST["email"]."'  ");
		     $resultats->setFetchMode(PDO::FETCH_OBJ);
		     if($resultats->rowCount()>0 ) {
				$resultat = $resultats->fetch();
				 $_SESSION["id"] = $resultat->id_utilisateur ; } 
				 $email=$resultat->login ;
				    $id=$_SESSION['id'];
					$to   = $email;
                    $subject = 'email de confirmation de compte';
					$message = "<a href=verifier_email_par_lien.php?id=$id&cle=$key> cliquer sur ce lien pour confirmer votre compte E-commerce </a>";
					$headers= "From: mahdilahmer544@gmail.com";
					$headers .="MIME-Version: 1.0" . "\r\n";
                    $headers .="Content-type:text/html;charset=UTF-8"."\r\n";

                    mail($to,$subject,$message,$headers);
					

		          
				
			 $_SESSION["nom"] = $_POST["name"] ; 
			 $_SESSION["tel"]  = $_POST["phone"] ; 
			 $_SESSION["adresse"]  = $_POST["adresse"] ; 
			
			echo "nous avons vous envoyé un email de verification de compte, vérifier votre compte email ";
		}
		
		else
			{
				header("Location: inscription.php?erreur=2");
		}
     }
    
}

		
		
	
	
		?>
  
</div>
</div>

</div>
</body>
</html>