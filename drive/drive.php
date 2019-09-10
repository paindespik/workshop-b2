<!DOCTYPE html>
<html>
<head>
<title>Votre projet</title>
</head>

<body>

<h1>DEPOT DE FICHIERS</h1>

<!-- envoie de la photo au fichier d'enregistrement -->
<form action="addFile.php" method="post" enctype="multipart/form-data" class="form-inline">
	<div class="form-group">
		<label for="nomFichier">choisissez le fichier : </label>label>
		<input type="file" class="form-control" name="nomFichier" id="nomFichier" placeholder="Entrer le fichier" value=""/>
	</div>
	<input type="hidden" name="file_id" id="file_id" value="<?php echo $photo_id ?>" />
	<input type="submit" value="Ajouter" class="btn btn-default" />
</form>

<h1> Publications: <h1>



</body>    