<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Co'stant la plateforme des étudiants">
  <meta name="author" content="">

  <title>Co'stant la plateforme des étudiants</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="https://fonts.googleapis.com/css?family=Saira+Extra+Condensed:500,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Muli:400,400i,800,800i" rel="stylesheet">
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/resume.min.css" rel="stylesheet">
  <link href="css/resume.css" rel="stylesheet">
  <script src="gulpfile.js"></script>

</head>

<body id="page-top">

  <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top" id="sideNav">
    <a class="navbar-brand js-scroll-trigger" href="#page-top">
      <span class="d-block d-lg-none">Co'stant</span>
      <span class="d-none d-lg-block">
        <img class="img-fluid img-profile rounded-circle mx-auto mb-2" src="img/2Logo2.png" alt="">
      </span>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="#about">Accueil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="#experience">Projets</a>
        </li>
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="#education">Hobbies</a>
        </li>
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="#skills">À propos</a>
        </li>

      </ul>
    </div>
  </nav>

  <div class="container-fluid p-0">

    <section class="resume-section p-3 p-lg-5 d-flex align-items-center" id="about">
      <div class="w-100">
        <h1 class="mb-0">Co'
          <span class="text-primary">Stant</span>
        </h1>
        <div class="subheading mb-5">437 avenue des Apothicaires · 0467 042 001 ·
          <a href="mailto:name@email.com">Costant@gmail.com</a>
        </div>
        <p class="lead mb-5">Bienvenue sur Co'stant, la plateforme faite par des étudiants POUR les étudiants. Utilisez Co'Stant pour partager vos passions et vos envies
          créer vos projets et partagez-les à l'intérieur de nos différents groupe qui sauront répondre à vos envies.</p>

        <div class="formulaire" id="test">

        <?php 
        include_once("header.php"); 
        include_once("menu.php"); 

        if($id == 0){ ?>
        <form method="post"  class="form-style-9" action="#">
          <fieldset>
          <legend>Connexion</legend>
          <p>
          <label for="nom">Nom :</label><input name="nom"  type="text" class="field-style field-full align-none" id="nom" required/><br />
          <label for="prenom">prenom :</label><input name="prenom"  type="text" class="field-style field-full align-none" id="prenom" required/><br />
          <label for="password">Mot de Passe :</label><input type="password" class="field-style field-full align-none" name="password" id="password" required/>
          </p>
          </fieldset>
          <p>
            <input type="submit" value="Connexion" /></p>
            <a href="enregistrer.php">Pas encore inscrit ?</a>
        </form>
        
        <?php
        }
     ?>
     <?php
if (!empty($_POST)){
		$message='';
        $query=$bdd->prepare('SELECT *
        FROM users WHERE nom = :nom');
        $query->bindValue(':nom',$_POST['nom'], PDO::PARAM_STR);
        $query->execute();
		$data=$query->fetch();

	
	if ($data['mdp'] == md5($_POST['password']) && $data['prenom'] == $_POST['prenom'])
	{
		$_SESSION['nom'] = $data['nom'];
		$_SESSION['prenom'] = $data['prenom'];
		$_SESSION['id'] = $data['id_user'];
	}
	else 
	{
	    $message = '<p>Une erreur s\'est produite 
	    pendant votre identification.<br /> Le mot de passe ou le nom ou le prénom
            entré n\'est pas correcte.</p><p>Cliquez <a href="index.php">ici</a> 
	    pour revenir à la page précédente
		<br /></p>';
	}
    $query->CloseCursor();
    echo $message.'</div></body></html>';
}	    
?>


        <div class="social-icons">
          <a href="#">
            <i class="fab fa-linkedin-in"></i>
          </a>
          <a href="#">
            <i class="fab fa-facebook-f"></i>
          </a>
        </div>
      </div>
    </section>

    <hr class="m-0">

    <section class="resume-section p-3 p-lg-5 d-flex justify-content-center" id="experience">
      <div class="w-100">
        <h2 class="mb-5">Projets</h2>

<!DOCTYPE html>
<html>
<head>
<title>Projets pro</title>
</head>

<body>

<?php

?>

<p>ici: mes projets</p>
<?php
// On récupère le titre des projets dont l'users est membre 
$reponse = $bdd->query('SELECT titre FROM projets, membres_projets WHERE id_membre ='.$id.'');
// On affiche chaque entrée une à une
while ($donnees = $reponse->fetch())
{
    ?><a href="drive/drive.php?projet=<?php echo($donnees['titre']) ?> "><?php echo($donnees['titre']. '<br>');
}
$reponse->closeCursor(); // Termine le traitement de la requête
?>
</body>



        <div class="resume-item d-flex flex-column flex-md-row justify-content-between mb-5">
          <div class="resume-content">
            <br>
            <h3 class="mb-0">Débuter un projet</h3>
          </div>
          <!-- <div class="resume-date text-md-right">
            <span class="text-primary">March 2013 - Present</span>
          </div> -->
        </div>
           <a href="drive/addproject.php">Créer projets<a>
             <!-- <br>
        <div class="resume-item d-flex flex-column flex-md-row justify-content-between mb-5">
          <div class="resume-content">
            <h3 class="mb-0">Rejoindre un projet</h3>
          </div> -->
          <!-- <div class="resume-date text-md-right">
            <span class="text-primary">December 2011 - March 2013</span>
          </div> -->
        </div>

        <!-- <div class="resume-item d-flex flex-column flex-md-row justify-content-between mb-5">
          <div class="resume-content">
            <h3 class="mb-0">Partager un projet</h3>
          </div> -->
          <!-- <div class="resume-date text-md-right">
            <span class="text-primary">July 2010 - December 2011</span>
          </div> -->
        </div>

      </div>

    </section>

    <hr class="m-0">

    <section class="resume-section p-3 p-lg-5 d-flex align-items-center" id="education">
      <div class="w-100">
        <h2 class="mb-5">Hobbies</h2>

        <div class="resume-item d-flex flex-column flex-md-row justify-content-between mb-5">
          <div class="resume-content">
            <h3 class="mb-0">Créer un club/groupe</h3>
          </div>
          <div class="resume-date text-md-right">
            <span class="text-primary">August 2006 - May 2010</span>
          </div>
        </div>

        <div class="resume-item d-flex flex-column flex-md-row justify-content-between">
          <div class="resume-content">
            <h3 class="mb-0">Rejoindre un club/groupe</h3>
          </div>
          <div class="resume-date text-md-right">
            <span class="text-primary">August 2002 - May 2006</span>
          </div>
        </div>

      </div>
    </section>

    <hr class="m-0">

    <section class="resume-section p-3 p-lg-5 d-flex align-items-center" id="skills">
      <div class="w-100">
        <h2 class="mb-5">À propos</h2>

        <div class="subheading mb-3"></div>

        <div class="subheading mb-3">Une plateforme collaborative faite par des étudiants pour des étudiants</div>
        <ul class="fa-ul mb-0">
          <p>Laissez-nous vous présenter l'équipe de Co'Stant.</p>
          <li>
            <i class="fa-li fa fa-check"></i>
            Mathieu  </li>
          <li>
            <i class="fa-li fa fa-check"></i>
            Arnaud </li>
          <li>
            <i class="fa-li fa fa-check"></i>
            Adrien</li>
          <li>
            <i class="fa-li fa fa-check"></i>
            Martin</li>
          <li>
            <i class="fa-li fa fa-check"></i>
            Sean</li>
          <li>
            <i class="fa-li fa fa-check"></i>
            Mélisande</li>
        </ul>
      </div>
    </section>


  </div>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for this template -->
  <script src="js/resume.min.js"></script>

</body>

</html>
