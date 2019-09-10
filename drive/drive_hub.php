<!DOCTYPE html>
<html>
<head>
<title>Projets pro</title>
</head>

<body>

<?php
    // include_once("../header.php");
    include("../getbdd.php");
?>
<h1>PROJETS HUB</h1>
<p><a href="addproject.php">Créer projets<a></p>
<p>ici: mes projets</p>
<?php
$_SESSION['id']=1;
// On récupère le titre des projets dont l'users est membre 
$reponse = $bdd->query('SELECT titre FROM projets WHERE id_membres ='.$_SESSION['id'].'');
// On affiche chaque entrée une à une
while ($donnees = $reponse->fetch())
{
    ?><br> <a href="drive_hub.php?projet= <?php echo $donnees['titre'] ?> "><?php echo $donnees['titre'];
}

$reponse->closeCursor(); // Termine le traitement de la requête



?>
</body>

