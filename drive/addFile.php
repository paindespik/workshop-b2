<?php

	$resultat=1;
	include("../getbdd.php");
	if ($_FILES['nomFichier']['error'] > 0) {
		$resultat = -1;
	}
	else if ( $_FILES['nomFichier']['size'] > 1000000){
		$resultat= -2;
	}

	$extensions_valides = array('jpg', 'jpeg', 'png', 'rar', 'zip', 'docx', 'txt', 'html', 'php');
	$extensionsUploaded = strtolower(substr(strrchr($_FILES['nomFichier']['name'],'.') , 1) );
	if (! in_array($extensionsUploaded,$extensions_valides)){
		$resultat = -3;
	}

	if ($resultat == 1){

		
		$fileName=$_FILES['nomFichier']['name'];
		$fullPathName = DIRECTORY_SEPARATOR."fichiers".DIRECTORY_SEPARATOR.$fileName;
		$serverDirectory=__DIR__;
		$index =strrpos($serverDirectory, DIRECTORY_SEPARATOR);
		$serverDirectory = substr($serverDirectory, 0, $index+1);
		//$serverDirectory .= DIRECTORY_SEPARATOR;
		$fullPathName = DIRECTORY_SEPARATOR."fichiers".DIRECTORY_SEPARATOR.$fileName;
		$fullPath=$serverDirectory."drive".$fullPathName;
		var_dump($fullPath);
		$file=$_FILES['nomFichier']['tmp_name'];
		var_dump($file);
		$copied = move_uploaded_file($file, $fullPath);
		var_dump($copied);
		
	}
$id_projet = $_POST['id_project'];
var_dump($id_projet);
var_dump($fullPathName);

	if($copied) {
		try{
			$query = "INSERT INTO depot(id_projet, chemin) VALUES (:pId, :pFilePath)";
			$stmt = $bdd->prepare ($query);
			$stmt->bindParam(':pId', $id_projet);
			$stmt->bindParam(':pFilePath', $fullPathName);
			$nbInsert = $stmt->execute();
		}
		catch (Exception $e) {
			$resultat = 0;
		}

	}
	else{
		$resultat = -4;
	}

?>









