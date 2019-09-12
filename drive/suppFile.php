<!DOCTYPE html>
<html>
<head>
<title>Votre projet</title>
</head>

<body> 
    <a href="../index.php">Retour</a>


<?php

//suppression bdd
session_start();
    include("../header.php");
    include("../menu.php");
    include("../getbdd.php");


    if(isset($_GET['id'])){

    	
    	$id=htmlspecialchars($_GET['id']);
    	//var_dump($id);


    	$stmt = $bdd->prepare ("SELECT chemin FROM depot WHERE id_depot=:pId");
    	$stmt->bindParam(':pId', $id);
    	$stmt->execute();
    	$filePath = $stmt->fetch();
    	//var_dump($filePath[0]);


    	
    	$nbDelete = 0;
    	$stmt = $bdd->prepare ("DELETE FROM depot WHERE id_depot=:pId");
    	$stmt->bindParam(':pId', $id);
    	$stmt->execute();
    	echo ("well played");
    	var_dump($id);
	
//suppression fichier server


    	
	$serverDirectory = __DIR__;

	$index = strrpos($serverDirectory, DIRECTORY_SEPARATOR);
	$serverDirectory = substr($serverDirectory, 0, $index+1);
	$serverDirectory .= $filePath[0];
	

	if (file_exists($serverDirectory)){
		var_dump($serverDirectory);
		unlink($serverDirectory);
	}


}

?>



</body>