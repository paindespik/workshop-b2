<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<title>Votre projet</title>
</head>

<style>

body{
         background-color: #BD5D38;
        text-align: center;
        }
        h2{
            max-width: 450px;
  background: #FAFAFA;
  padding: 30px;
  margin: 50px auto;
  box-shadow: 1px 1px 25px rgba(0, 0, 0, 0.35);
  border-radius: 10px;
  border: 6px solid #305A72;
        }
        h1{
               max-width: 450px;
  background: #FAFAFA;
  padding: 30px;
  margin: 50px auto;
  box-shadow: 1px 1px 25px rgba(0, 0, 0, 0.35);
  border-radius: 10px;
  border: 6px solid #305A72;
        } 
        </style>


<body> 
    <a href="../index.php">Retour</a>
<?php 
    include("../header.php");
    include("../menu.php");

    $projet = $_SERVER['QUERY_STRING'];
    $nom_url = $_SERVER['QUERY_STRING'];
    $projet = substr($projet,7);
    $projet = str_replace('%20',' ',$projet);

    ?>
	<h1>
=======
<br>
<div><?php echo($projet); ?></div></h1>

    <?php

    $reponse = $bdd->query('SELECT id_projet FROM projets WHERE titre ="'.$projet.'"');
    // On affiche chaque entrée une à une
    while ($donnees = $reponse->fetch())
    {
         $projetId = $donnees;
    }

    $reponse->closeCursor(); // Termine le traitement de la requête

    $reponse = $bdd->query("SELECT id_projet FROM projets, users WHERE id_admin = id_user AND id_user=".$id."");

    // On affiche chaque entrée une à une
while ($donnees = $reponse->fetch())
{

    if ($donnees == $projetId){
        $admin = 1;
    }
}


$projetId = $projetId[0];
$reponse->closeCursor(); // Termine le traitement de la requête


if (isset($admin)){
    ?>
    <p>Vous êtes l'administrateur du groupe.</p>
    <a href="SupprGroupe.php?id=<?php echo $projetId;?>">Supprimer le groupe</a><br><br>
    
    <label>Ajouter un membre:</label>
    <form method="post" action="addmembres.php?id=<?php echo($projetId."&nom_projet=".$nom_url)?>" >
        <input type ="text" placeholder="Id du membre à ajouter" name ="addId" value="" required>
        <input type ="submit">    
    </form>
    <?php
}

// On récupère le nom des membres
$reponse = $bdd->query('SELECT id_user, nom, prenom FROM users, membres_projets, projets WHERE id_membre = id_user AND membres_projets.id_projet = projets.id_projet AND membres_projets.id_projet ='.$projetId.'');
// On affiche chaque entrée une à une
?><p>Membre(s) du groupe:</p>
<?php
while ($donnees = $reponse->fetch())
{
    ?><div><?php echo($donnees['nom']." ".$donnees['prenom']."<br>");?> </div> 
    <?php if (isset($admin)){ ?>
     <a href="supprMembre.php?id=<?php echo ($donnees['id_user']."&projet=".$projetId."&nom_projet=".$nom_url); ?>">

    Supprimer le membre</a> <br><br><?php }

}

$reponse->closeCursor(); // Termine le traitement de la requête

?>




</h1>
<h2> Dépot de fichier 
<!-- envoie de la photo au fichier d'enregistrement -->
<form action="addFile.php?&nom_projet=<?php echo $nom_url?>" method="post" enctype="multipart/form-data" class="form-inline">
	<div class="form-group">
		<label for="nomFichier">choisissez le fichier : </label>
		<input type="file" class="form-control" name="nomFichier" id="nomFichier" placeholder="Entrer le fichier" value=""/>

	</div>
	<input type="hidden" name="id_project" id="id_project" value="<?php echo $projetId ?>" />
	<input type="submit" value="Ajouter" class="btn btn-default" />
</form>
</h2>

<?php  
if($bdd){
	$query = "SELECT * FROM depot WHERE depot.id_projet = $projetId ";
	$stmt = $bdd->prepare($query);
	$stmt->bindParam('id_project',$id_project);
	$stmt->execute();

	$file = $stmt->fetch();
	if($file) {
		while($file) {
			
			$chemin_bis= "/workshop-b2/drive".$file["chemin"];
            $chemin_supp="/workshop-b2/drive/suppFile.php?id=".$file["id_depot"]."&nom_projet=".$nom_url;
			?>
			<div class="col-1g-1 col-md-2">
				<div class="panel panel-green">
					<div class="panel-heading">
						<div class="row">

							<p> <a href="<?php echo $chemin_bis;?>"><?php echo $file["titre"]?> </a>   <a href="<?php echo $chemin_supp; ?>">Supprimer</a></p>
						
						</div>
					</div>
				</div>
            </div>
           <?php
        $file = $stmt->fetch();
        }
	}
}

 ?>

<h2> Publications:

<form method="POST" action="send.php?id=<?php echo $projetId."&nom_projet=".$nom_url?>">
    <input type="text" name="post" placeholder="Envoyer un message" required>    
    <input type="submit" >
</form>
</h2>
<?php 

    $query = "SELECT chat.texte, nom, prenom
                FROM chat, users
                WHERE chat.id_projet = $projetId
                AND id_user = id_createur";   


	$stmt = $bdd->prepare($query);
    $stmt->execute();

    while($file = $stmt->fetch()) {    
        ?><div><?php echo ($file['texte']." (par ".$file['nom']." ".$file['prenom'].")<br>");?></div> <?php
    }
?>

</body>    