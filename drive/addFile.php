<?php
	session_start();
	include("../header.php");
    include("../menu.php");
	$resultat=1;


	include("../getbdd.php");

	$titre=$_FILES['nomFichier']['name'];
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
		$file=$_FILES['nomFichier']['tmp_name'];
		$copied = move_uploaded_file($file, $fullPath);
		
	}
$id_projet = $_POST['id_project'];
var_dump($bdd);


	if($copied) {
		try{
			$stmt = $bdd->prepare("INSERT INTO depot(id_projet, titre, id_createur, chemin) VALUES (:pId, :pTitre, :pIdCreateur, :pFilePath)");
			$stmt->bindParam(':pTitre', $titre);
			$stmt->bindParam(':pIdCreateur', $id);
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
	header("Location: drive_hub.php");
?>









