
<?php

session_start();
// $titre="Connexion";
include_once("header.php");

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
header("Refresh:0");
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
header("Location: index.php");

?>

