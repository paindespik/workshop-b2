<?php
session_start();
include("../header.php");
include("../menu.php");

$id_membre = $_GET['id'];
$id_projet = $_GET['projet'];
$nom_projet = "?".$_GET['nom_projet'];


$stmt = $bdd->prepare('DELETE FROM membres_projets WHERE id_membre='.$id_membre.' AND id_projet ='.$id_projet.'');                                
$stmt->execute();
header("Location: drive.php".$nom_projet);   
    ?>