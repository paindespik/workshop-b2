<?php 	
    include_once("bdd.php"); 

	if(isset($_POST["password"]) && isset($_POST["email"]))  {
		
		$mail = $_POST['email'];
		$password = $_POST['password'];
		$cpassword= /*sha1(*/$_POST["password"]/*)*/;

		$req = $epsi_sql->prepare("SELECT mail, password FROM clients WHERE mail = :mail AND password = '$cpassword'");
		$req->execute(array(':mail' => $mail, 'password' => $password ));
		$res = $req->fetch();

  
		if($res)
		{
			echo "<h5 style='color:black;'>Connecté en tant que client</h5>";
			$_SESSION['droit'] = 1;
		}
			else{ 
				if($cpassword=="password" && $mail =="root"){
					echo "<h5 style='color:black;'>Connecté en tant qu'administrateur</h5>";
					$_SESSION['droit']=2;
					

		}	
				else 	echo"<script language='javascript'>\nalert(\"Mail ou mot de passe incorrect !\");\n</script>";
		}

	}
	 if ($_SESSION['droit'] == 0){ echo "<h5 style='color:black;'>Connecté en tant que visiteur</h5>";}
	 
	 
	$_POST['chambre'];
	$typechambre = $_POST['chambre']; //recuperation type chambre selectionné
	

  $droit = $_SESSION['droit'];

if($_SESSION['droit']==2)
	{
	?>
		<button><a href = "paneladmin.php">Acceder au panel admin</a> </button>
		
?>
	<?php
}


if($_SESSION['droit'] == 1 || $_SESSION['droit'] == 2)
	{
	?>
    <form action="" method="post">
		<input type="submit" name="deco" value="Se déconnecter">
		</form>

		
	<?php
    $_SESSION['mail'] = $mail;
	
		$query = ("SELECT nom FROM clients WHERE mail='$mail'");
		$stmt = $epsi_sql -> prepare($query);
		$stmt -> execute();
		$nom = $stmt->fetch(PDO::FETCH_OBJ);
		$nom -> nom;	
	  $_SESSION['nom']=$nom -> nom; 

		$query2 = ("SELECT prenom FROM clients WHERE mail='$mail'");
		$stmt2 = $epsi_sql -> prepare($query2);
		$stmt2 -> execute();
		$prenom = $stmt2->fetch(PDO::FETCH_OBJ);
		$_SESSION['prenom']=$prenom -> prenom; 
		
		$query4 = ("SELECT id FROM clients WHERE mail='$mail'");
		$stmt4 = $epsi_sql -> prepare($query4);
		$stmt4 -> execute();
		$id = $stmt4->fetch(PDO::FETCH_OBJ);
		$_SESSION['id']=intval($id -> id);
		

		echo $mail. "<br>";
		echo $_SESSION['nom'] . "<br>";
		echo $_SESSION['prenom'];
		
}		

?>
}