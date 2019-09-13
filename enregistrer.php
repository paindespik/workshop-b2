<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd%22%3E
    <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >

<head>
    <style>
        form{
             max-width: 450px;
  background: #FAFAFA;
  padding: 30px;
  margin: 50px auto;
  box-shadow: 1px 1px 25px rgba(0, 0, 0, 0.35);
  border-radius: 10px;
  border: 6px solid #305A72;
        }
        body{
            background-color: #F76A19;
        }
        h1{
            text-align: center;
        }
    </style>
        </head>
<body>
<?php
session_start();
$titre="Enregistrement";
include_once("getbdd.php");
if($bdd){
    
    if (empty($_POST['nom'])) 
    {
        echo '<h1>Inscription </h1>';
        echo '<form method="post" action="enregistrer.php" enctype="multipart/form-data">
        <fieldset><legend>Identifiants</legend>
        <label for="nom">* nom :</label>  <input name="nom" type="text" id="nom" /> (le nom doit contenir entre 3 et 15 caractères)<br />
        <label for="prenom">* prenom :</label>  <input name="prenom" type="text" id="prenom" /> (le nom doit contenir entre 3 et 15 caractères)<br />
        <label for="password">* Mot de Passe :</label><input type="password" name="password" id="password" /><br />
        <label for="confirm">* Confirmer le mot de passe :</label><input type="password" name="confirm" id="confirm" />
        </fieldset>
        <fieldset><legend>Contacts</legend>
        <label for="mail">* Votre adresse Mail :</label><input type="text" name="mail" id="mail" /><br />

        <p>Les champs précédés d un * sont obligatoires</p>
        <p><input type="submit" value="S\'inscrire" /></p></form>
        </div>
        </body>
        </html>';
        
    } 
    
else 
{
    $nom_erreur1 = NULL;
    $prenom_erreur2 = NULL;
    $mdp_erreur = NULL;
    $mail_erreur1 = NULL;
    $mail_erreur2 = NULL;
?>

<?php

    
    $i = 0;
    $nom=$_POST['nom'];
    $prenom=$_POST['prenom'];
    $mail = $_POST['mail'];
    $pass = md5($_POST['password']);
    $confirm = md5($_POST['confirm']);
	
    
	$query=$bdd->prepare('SELECT COUNT(*) AS nbr FROM users WHERE nom =:nom');
    $query->bindValue(':nom',$nom, PDO::PARAM_STR);
    $query->execute();
    $nom_free=($query->fetchColumn()==0)?1:0;
    $prenom_free=($query->fetchColumn()==0)?1:0;
    $query->CloseCursor();
    if(!$nom_free)
    {
        $nom_erreur1 = "Votre nom est déjà utilisé par un membre";
        $i++;
    }

    if (strlen($nom) < 3 || strlen($nom) > 15)
    {
        $nom_erreur2 = "Votre nom est soit trop grand, soit trop petit";
        $i++;
    }
    if(!$prenom_free)
    {
        $prenom_erreur1 = "Votre prenom est déjà utilisé par un membre";
        $i++;
    }

    if (strlen($prenom) < 3 || strlen($prenom) > 15)
    {
        $prenom_erreur2 = "Votre prenom est soit trop grand, soit trop petit";
        $i++;
    }
    
    if ($pass != $confirm || empty($confirm) || empty($pass))
    {
        $mdp_erreur = "Votre mot de passe et votre confirmation diffèrent, ou sont vides";
        $i++;
	}
	
?>
<?php
$query=$bdd->prepare('SELECT COUNT(*) AS nbr FROM users WHERE nom =:nom');
$query->bindValue(':nom',$nom, PDO::PARAM_STR);
$query->execute();
$nom_free=($query->fetchColumn()==0)?1:0;
?>
<?php
    

    
    $query=$bdd->prepare('SELECT COUNT(*) AS nbr FROM users WHERE mail =:mail');
    $query->bindValue(':mail',$mail, PDO::PARAM_STR);
    $query->execute();
    $mail_free=($query->fetchColumn()==0)?1:0;
    $query->CloseCursor();
    
    if(!$mail_free)
    {
        $mail_erreur1 = "Votre adresse mail est déjà utilisée par un membre";
        $i++;
    }
    
    if (!preg_match("#^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-z]{2,4}$#", $mail) || empty($mail))
    {
        $mail_erreur2 = "Votre adresse E-Mail n'a pas un format valide";
        $i++;
    }
    
?>
<?php
    
   if ($i==0)
   {
	echo'<h1>Inscription terminée</h1>';
        echo'<p>Bienvenue '.stripslashes(htmlspecialchars($_POST['nom'])).' vous êtes maintenant inscrit sur le forum</p>
	<p>Cliquez <a href="index.php">ici</a> pour revenir à la page d accueil</p>';

   
        $query=$bdd->prepare('INSERT INTO users (nom, prenom, mdp, mail)
        VALUES (:nom,:prenom, :pass, :mail)');
	$query->bindValue(':nom', $nom, PDO::PARAM_STR);
	$query->bindValue(':prenom', $prenom, PDO::PARAM_STR);
	$query->bindValue(':pass', $pass, PDO::PARAM_STR);
	$query->bindValue(':mail', $mail, PDO::PARAM_STR);
    $query->execute();


        $_SESSION['nom'] = $nom;
        $_SESSION['id'] = $bdd->lastInsertId(); ;
        $query->CloseCursor();
    }
    else
    {
        echo'<h1>Inscription interrompue</h1>';
        echo'<p>Une ou plusieurs erreurs se sont produites pendant l incription</p>';
        echo'<p>'.$i.' erreur(s)</p>';
        echo'<p>'.$nom_erreur1.'</p>';
        echo'<p>'.$prenom_erreur2.'</p>';
        echo'<p>'.$mdp_erreur.'</p>';
        echo'<p>'.$mail_erreur1.'</p>';
        echo'<p>'.$mail_erreur2.'</p>';
       
        echo'<p>Cliquez <a href="./enregistrer.php">ici</a> pour recommencer</p>';
    }
}
}
?>
</div>
</body>
</html>

