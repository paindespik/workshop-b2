<!DOCTYPE html>
<html>
<head>
<title>Votre projet</title>
</head>

<body> 
    <a href="../index.php">Retour</a>


<?php
session_start();
    include("../header.php");
    include("../menu.php");
    include("../getbdd.php");


    if(isset($_GET['id'])){

    	
    	$id=htmlspecialchars($_GET['id']);



    	$bdd = getDataBase();
    	$nbDelete = 0;

    	try{
    		
    		
    		
    		$stmt = $bdd->prepare ("SELECT chemin FROM depot WHERE id_depot=:pId");
    		$stmt->bindParam(':pId', $id);
    		$stmt->execute();
    		$pathLine = $stmt->fetch();
    		if ($pathLine) {
    			$filePathName = $pathLine["path"];
    			$stmt = $bdd->prepare ("DELETE FROM depot WHERE id_depot=:pId");
    			$stmt->bindParam(':pId', $id);
    			$nbDelete = $stmt->execute();
    		}

    	}

    	catch (Exception $e){
    		$nbDelete = 0;
    	}


    }






?>



</body>