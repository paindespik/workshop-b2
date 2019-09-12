

<?php

//suppression bdd
session_start();
    include("../header.php");
    include("../menu.php");
    include("../getbdd.php");

	$nom_projet = "?".$_GET['nom_projet'];


    if(isset($_GET['id'])){

    	
    	$id=htmlspecialchars($_GET['id']);


    	$stmt = $bdd->prepare ("SELECT chemin FROM depot WHERE id_depot=:pId");
    	$stmt->bindParam(':pId', $id);
    	$stmt->execute();
    	$filePath = $stmt->fetch();


    	
    	$nbDelete = 0;
    	$stmt = $bdd->prepare ("DELETE FROM depot WHERE id_depot=:pId");
    	$stmt->bindParam(':pId', $id);
    	$stmt->execute();
    	
    	
	
//suppression fichier server


    	
	$serverDirectory = __DIR__;

	// $index = strrpos($serverDirectory, DIRECTORY_SEPARATOR);
	// $serverDirectory = substr($serverDirectory, 0, $index+1);
	$serverDirectory .= $filePath[0];
	
	if (file_exists($serverDirectory)){
	
		unlink($serverDirectory);
	}


}
header("Location: drive.php".$nom_projet);   
?>

