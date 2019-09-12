

<?php
session_start();
    include("header.php");
    include("menu.php");
    include("getbdd.php");

    	

     	//session_destroy();
     	$id=htmlspecialchars($_GET['id']);
     	$id=intval($id);
     	$stmt = $bdd->prepare ("DELETE FROM users WHERE id_user=:pId");
    	$stmt->bindParam(':pId', $id);
    	$stmt->execute();











header("Location: ../index.php");

?>