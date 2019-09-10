<!DOCTYPE html>
<html>
<head>
<title>Votre projet</title>
</head>

<body> 
    <a href="drive_hub.php">Retour</a>
<h1>
<?php 
    $projet = $_SERVER['REQUEST_URI'];
    $projet = substr($projet,36);    // retourne "ef"
    $projet = str_replace('%20',' ',$projet);

    echo($projet);
?>
</h1>
<h2> Dépot de fichier </h2>
<!-- envoie de la photo au fichier d'enregistrement -->
<form action="addFile.php" method="post" enctype="multipart/form-data" class="form-inline">
	<div class="form-group">
		<label for="nomFichier">choisissez le fichier : </label>label>
		<input type="file" class="form-control" name="nomFichier" id="nomFichier" placeholder="Entrer le fichier" value=""/>
	</div>
	<input type="hidden" name="file_id" id="file_id" value="<?php echo $photo_id ?>" />
	<input type="submit" value="Ajouter" class="btn btn-default" />
</form>

<h2> Publications: <h2>



</body>    