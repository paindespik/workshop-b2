<?php session_start(); ?>
<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <title>Costant, la plateforme collaborative des étudiants EPSI/WIS</title>


    <link rel="stylesheet" href="css/style.css">


</head>

<body>

 <?php                       
        
             include_once("header.php");        

      if($id == 0){
        ?><form method="post" action="#">
        <fieldset>
        <legend>Connexion</legend>
        <p>
        <label for="nom">Nom :</label><input name="nom"  type="text" id="nom" required/><br />
        <label for="prenom">prenom :</label><input name="prenom"  type="text" id="prenom" required/><br />
        <label for="password">Mot de Passe :</label><input type="password"  name="password" id="password" required/>
        </p>
        </fieldset>
        <p><input type="submit" value="Connexion" /></p></form>
        <a href="enregistrer.php">Pas encore inscrit ?</a>
        <?php
        }
     ?>
     <?php
if (!empty($_POST)){
		$message='';
        $query=$bdd->prepare('SELECT *
        FROM users WHERE nom = :nom');
        $query->bindValue(':nom',$_POST['nom'], PDO::PARAM_STR);
        $query->execute();
		$data=$query->fetch();

	
	if ($data['mdp'] == md5($_POST['password']) && $data['prenom'] == $_POST['prenom'])
	{
		$_SESSION['nom'] = $data['nom'];
		$_SESSION['prenom'] = $data['prenom'];
		$_SESSION['id'] = $data['id_user'];
	}
	else 
	{
	    $message = '<p>Une erreur s\'est produite 
	    pendant votre identification.<br /> Le mot de passe ou le nom ou le prénom
            entré n\'est pas correcte.</p><p>Cliquez <a href="index.php">ici</a> 
	    pour revenir à la page précédente
		<br /></p>';
	}
    $query->CloseCursor();
    echo $message.'</div></body></html>';
}	    
        include_once("menu.php"); 
?>


<div class="logo">
    <img src="img/logocostant13.png" alt="Logo">
</div>

<div class="plainpage">

    <div class="titre">
        <h1><a href="drive/drive_hub.php">Projets</a></h1>
    </div>

    <div class="titre2"> <h1><a href="BDE/loisirs.php">Loisirs</a></h1>
    </div>

    <!-- <form method="post">
        <p>
            <label id="pseudo">Votre pseudo</label> : <input type="text" name="pseudo" />
        </p>

        <p>
            <label>Votre mdp </label> : <input type="text" name="mdp" />
        </p>
        <input type="button"  value="send">
    </form> -->
   
    <div class="keys">Utilisez gauche et droite pour naviguer</div>

</div>

</body>
</html>
