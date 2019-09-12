<?php
session_start();

$message = $_POST['post'];
include("../header.php");
include("../menu.php");

$id_projet = $_GET['id'];
// $id_projet = substr($id_projet, -2);
$id_projet = intval($id_projet); 

$nom_projet = $_GET['nom_projet'];

var_dump($id_projet);
var_dump($id);
var_dump($nom_projet);

$stmt = $bdd->prepare('INSERT INTO chat(id_projet, id_createur, texte)
VALUES(:id_projet, :id, :texte)');                                
$stmt->bindValue(':id_projet', $id_projet,PDO::PARAM_INT);
$stmt->bindValue(':id', $id,PDO::PARAM_INT);
$stmt->bindValue(':texte', $message,PDO::PARAM_STR );
$stmt->execute();

header("Location: drive.php?".$nom_projet);
?>
