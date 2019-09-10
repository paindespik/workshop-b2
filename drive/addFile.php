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
		$fileName="f".$id_projet.$newId.".".$extensionsUploaded;
		$fullPathName = DIRECTORY_SEPARATOR."fichiers".DIRECTORY_SEPARATOR.$fileName;
		$serverDirectory=__DIR__;
		$index =strrpos($serverDirectory, DIRECTORY_SEPARATOR);
		$serverDirectory = substr($serverDirectory, DIRECTORY_SEPARATOR);
		$serverDirectory = DIRECTORY_SEPARATOR;
		$fullPathName = DIRECTORY_SEPARATOR."fichiers".DIRECTORY_SEPARATOR.$fileName;
		$copied = move_uploaded_file($_FILES['nomFichier']), $fullPathName;
	}

/*
	if($copied) {
		try{
			$query = "INSERT INTO depot(id_projet, id_admin, chemin) VALUES (:pId, :pNum, :pFilePath)";
			$stmt = $bdd->prepare ($query);
			$stmt->bindParam(':pId', $id_projet);
			$stmt->bindParam(':pNum', $id_admin);
			$stmt->bindParam(':pFilePath', $chemin);
			$nbInsert = $stmt->execute();
		}
		catch (Exception $e) {
			$resultat = 0;
		}

	}
	else{
		$resultat = -4;
	}
*/
?>









