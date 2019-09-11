
<?php
    include_once("../header.php");
    include_once("../menu.php");

?>
<a href="../index.php">Retour à l'accueil </a>
<h1>PROJETS HUB</h1>
<p><a href="addproject.php">Créer projets<a></p>
<p>ici: mes projets</p>
<?php
// On récupère le titre des projets dont l'users est membre 
$reponse = $bdd->query('SELECT titre FROM projets, membres_projets WHERE id_membre ='.$id.'');
// On affiche chaque entrée une à une
while ($donnees = $reponse->fetch())
{
    ?><a href="drive.php?projet=<?php echo($donnees['titre']) ?> "><?php echo($donnees['titre']. '<br>');
}
$reponse->closeCursor(); // Termine le traitement de la requête
?>


