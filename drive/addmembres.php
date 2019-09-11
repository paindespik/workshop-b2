<?php
session_start();
include("../header.php");
include("../menu.php");

$addId =$_POST['addId'];
echo $addId;

$id_projet = $_SERVER['REQUEST_URI'];
$id_projet = substr($id_projet, -2);

$stmt = $bdd->prepare("INSERT INTO membres_projets VALUES (".$addId.",".$id_projet.")");                                
$stmt->execute();
header("Location: ../index.php");

?>