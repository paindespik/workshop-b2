<?php

include("../header.php");
include("../menu.php");

$id_membre = $_SERVER['QUERY_STRING'];
$id_membre = substr($id_membre,3);
var_dump($id_membre);
$stmt = $bdd->prepare('DELETE FROM membres_projets WHERE id_membre='.$id_membre.'');                                
$stmt->execute();
header("Location: ../index.php");   
    ?>