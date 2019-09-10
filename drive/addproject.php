<!DOCTYPE html>
<html>
<head>
<title>Title of the document</title>
</head>

<body>
<form action="#" method="get">
  Nom du projet:<br>
  <input type="text" name="nom"><br>
  Texte:<br>
  <input type="text" name="texte">
  <input type ="submit">
</form>


<?php
session_start();
include ("../header.php");

if (isset ($_GET['nom'])){
    try
    {
        // Mise à jour dans la bd
        $stmt = $bdd->prepare ("INSERT INTO projets(id_admin,titre,texte) VALUES(:cIdAdmin, :cTitre, :cTexte)");
        $stmt->bindParam(':cIdAdmin', $id);
        $stmt->bindParam(':cTitre', $_GET['nom']);
        $stmt->bindParam(':cTexte', $_GET['texte']);
        $nbInsert = $stmt->execute();

        $projetId = $bdd->lastInsertId();
        $stmt = $bdd->prepare ("INSERT INTO membres_projets(id_membre, id_projet) VALUES(:cIdMembre, :cProjet)");
        $stmt->bindParam(':cIdMembre', $id);
        $stmt->bindParam(':cProjet', $projetId);
        $nbInsert = $stmt->execute();
    }
    catch (Exception $e)
    {
        $nbInsert = 0;
    }

    header("Location: drive_hub.php"); //, true, ($nbModifs == 0 ? 204 : 202));
}

?>
</body>

</html>