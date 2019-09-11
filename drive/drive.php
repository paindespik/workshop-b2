<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<title>Votre projet</title>
</head>

<body> 
    <a href="../index.php">Retour</a>
<?php 
    include("../header.php");
    include("../menu.php");

    $projet = $_SERVER['QUERY_STRING'];
    $projet = substr($projet,7);
    $projet = str_replace('%20',' ',$projet);

    ?>
	<h1>
=======
<br>
<?php echo($projet); ?></h1>

    <?php

    $reponse = $bdd->query('SELECT id_projet FROM projets WHERE titre ="'.$projet.'"');
    // On affiche chaque entrée une à une
    while ($donnees = $reponse->fetch())
    {
         $projetId = $donnees;
    }

    $reponse->closeCursor(); // Termine le traitement de la requête



    $reponse = $bdd->query('SELECT id_projet FROM projets, users WHERE id_admin = id_user');
// On affiche chaque entrée une à une
while ($donnees = $reponse->fetch())
{
    if ($donnees == $projetId){
        $admin = 1;
    }
}



$projetId = $projetId[0];
$reponse->closeCursor(); // Termine le traitement de la requête


if ($admin){
    ?>
    <p>Vous êtes l'administrateur du groupe.</p>
    <a href="SupprGroupe.php?id=<?php echo $projetId;?>">Supprimer le groupe</a><br><br>
    
    <label>Ajouter un membre:</label>
    <form method="post" action="addmembres.php?id=<?php echo $projetId;?>">
        <input type ="text" placeholder="Id du membre à ajouter" name ="addId" value="" required>
        <input type ="submit">    
    </form>
    <?php
}

// On récupère le nom des membres 
$reponse = $bdd->query('SELECT nom, prenom FROM users, membres_projets, projets WHERE id_membre = id_user AND membres_projets.id_projet ='.$projetId.'');
// On affiche chaque entrée une à une
?><p>Membre(s) du groupe:</p>
<?php
while ($donnees = $reponse->fetch())
{
    echo($donnees['nom']." ".$donnees['prenom']."<br>");
}
$reponse->closeCursor(); // Termine le traitement de la requête
?>




</h1>
<h2> Dépot de fichier </h2>
<!-- envoie de la photo au fichier d'enregistrement -->
<form action="addFile.php" method="post" enctype="multipart/form-data" class="form-inline">
	<div class="form-group">
		<label for="nomFichier">choisissez le fichier : </label>
		<input type="file" class="form-control" name="nomFichier" id="nomFichier" placeholder="Entrer le fichier" value=""/>

	</div>
	<input type="hidden" name="id_project" id="id_project" value="<?php echo $projetId ?>" />
	<input type="submit" value="Ajouter" class="btn btn-default" />
</form>

<h2> Publications:<h2>
<?php  
if($bdd){
	$query = "SELECT * FROM depot WHERE id_depot";
	$stmt = $bdd->prepare($query);
	$stmt->bindParam('id_project',$id_project);
	$stmt->execute();

	$file = $stmt->fetch();
	if($file) {
		while($file) {
			
			$chemin_bis= "/drive".$file["chemin"];
			?>
			<div class="col-1g-1 col-md-2">
				<div class="panel panel-green">
					<div class="panel-heading">
						<div class="row">

							 
							<p> <a href="<?php echo $chemin_bis;?>"><?php echo $file["titre"] ?> </a></p>
						
						</div>
					</div>
				</div>
            </div>
           <?php
        $file = $stmt->fetch();
        }
	}
}

 ?>


</body>    