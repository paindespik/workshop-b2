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
include ("../getbdd.php");
if (isset ($_GET['nom'])){
    try
    {
        // Mise à jour dans la bd
        $stmt = $bdd->prepare ("INSERT INTO projets(id_admin, id_membres, titre, texte) VALUES(:cIdAdmin, :cIdMembres, :cTitre, :cTexte)");
        $stmt->bindParam(':cIdAdmin', $_SESSION['id']);
        $stmt->bindParam(':cIdMembres', $_SESSION['id']);
        $stmt->bindParam(':cTitre', $_GET['nom']);
        $stmt->bindParam(':cTexte', $_GET['texte']);
        $nbInsert = $stmt->execute();
    }
    catch (Exception $e)
    {
        $nbInsert = 0;
    }

    header("Location: drive.php?id=".$pub_id."&req=".$nbInsert); //, true, ($nbModifs == 0 ? 204 : 202));
}

?>
</body>

</html>