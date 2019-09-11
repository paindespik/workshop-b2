<?php

include("../header.php");
include("../menu.php");

$id_projet = $_SERVER['REQUEST_URI'];
$id_projet = substr($id_projet, -2);
$stmt = $bdd->prepare('DELETE FROM projets WHERE id_projet='.$id_projet.'');                                
$stmt->execute();
header("Location: ../index.php");   
    ?>