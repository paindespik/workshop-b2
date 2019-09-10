
<?php

session_start();
$titre="Connexion";
include_once("getbdd.php");
if ($bdd){
if (!isset($_POST['nom'])) 
{
	echo '<form method="post" action="connexion.php">
	<fieldset>
	<legend>Connexion</legend>
	<p>
	<label for="nom">Nom :</label><input name="nom" type="text" id="nom" /><br />
	<label for="prenom">prenom :</label><input name="prenom" type="text" id="prenom" /><br />
	<label for="password">Mot de Passe :</label><input type="password" name="password" id="password" />
	</p>
	</fieldset>
	<p><input type="submit" value="Connexion" /></p></form>
	<a href="enregistrer.php">Pas encore inscrit ?</a>
	 
	</div>
	</body>
	</html>';
}
else
{
    $message='';
    if (empty($_POST['nom']) || empty($_POST['password'] || empty($_POST['prenom'])) ) 
    {
        $message = '<p>une erreur s\'est produite pendant votre identification.
	Vous devez remplir tous les champs</p>
	<p>Cliquez <a href="connexion.php">ici</a> pour revenir</p>';
    }
    else 
    {
        $query=$bdd->prepare('SELECT *
        FROM users WHERE nom = :nom');
        $query->bindValue(':nom',$_POST['nom'], PDO::PARAM_STR);
        $query->execute();
		$data=$query->fetch();

	
	if ($data['mdp'] == md5($_POST['password']) || $data['prenom'] == $_POST['prenom'])
	{
	    $_SESSION['nom'] = $data['nom'];
	    $_SESSION['id'] = $data['id_user'];
	    $message = '<p>Bienvenue '.$data['nom'].', 
			vous êtes maintenant connecté!</p>
			<p>Cliquez <a href="../accueil.php">ici</a> 
			pour revenir à la page d accueil</p>'; 
	}
	else 
	{
	    $message = '<p>Une erreur s\'est produite 
	    pendant votre identification.<br /> Le mot de passe ou le nom ou le prénom
            entré n\'est pas correcte.</p><p>Cliquez <a href="connexion.php">ici</a> 
	    pour revenir à la page précédente
		<br /><br />Cliquez <a href="drive/drive.php">ici</a> 
	    pour revenir à la page d accueil</p>';
	}
    $query->CloseCursor();
    }
    echo $message.'</div></body></html>';

}
}
?>

