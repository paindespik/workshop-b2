<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<title>Votre projet</title>
</head>

<body> 
    <a href="drive_hub.php">Retour</a>
<h1>

	<h1>DEPOT DE FICHIERS</h1>

=======
<?php 
    include("../header.php");
    include("../menu.php");

    $projet = $_SERVER['REQUEST_URI'];
    $projet = substr($projet,36);
    $projet = str_replace('%20',' ',$projet);
<<<<<<< HEAD
=======

<<<<<<< HEAD


=======
>>>>>>> ce524d37bc31b8dd106b3a79be6bfa4e8981b8e7
>>>>>>> 6e37ae5d4e4be2d847711c93801a5c646632d9ec
    echo($projet);

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

$reponse->closeCursor(); // Termine le traitement de la requête



if ($admin){
    ?>
    <p>Vous êtes l'administrateur du groupe.</p>
    <a href="SupprGroupe.php">Supprimer le groupe</a><br><br>
    <label>Ajouter un membre:</label>
    <form method="post" action="#">
        <input>    

    </form>
    <?php
}
?>






</h1>
<h2> Dépot de fichier </h2>
<!-- envoie de la photo au fichier d'enregistrement -->
<form action="addFile.php" method="post" enctype="multipart/form-data" class="form-inline">
	<div class="form-group">
		<label for="nomFichier">choisissez le fichier : </label>label>
		<input type="file" class="form-control" name="nomFichier" id="nomFichier" placeholder="Entrer le fichier" value=""/>
	</div>
	<!--<input type="hidden" name="id_project" id="id_project" value="<?php echo $id_project ?>" /> -->
	<input type="submit" value="Ajouter" class="btn btn-default" />
</form>

<h2> Publications: <h2>



</body>    