<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <title>Costant, la plateforme collaborative des étudiants EPSI/WIS</title>


    <link rel="stylesheet" href="css/style.css">


</head>

<body>


 <?php               
        include_once("header.php");        
        include_once("menu.php"); 
          
      if($id == 0){
            include_once("connexion.php");
        }
        var_dump($id);
     ?>


<div class="logo">
    <img src="img/logocostant13.png" alt="Logo">
</div>

<div class="plainpage">

    <div class="titre">
        <h1><a href="drive/drive_hub.php">Projets</a></h1>
    </div>

    <div class="titre2"> <h1><a href="BDE/loisirs.php">Loisirs</a></h1>
    </div>

    <!-- <form method="post">
        <p>
            <label id="pseudo">Votre pseudo</label> : <input type="text" name="pseudo" />
        </p>

        <p>
            <label>Votre mdp </label> : <input type="text" name="mdp" />
        </p>
        <input type="button"  value="send">
    </form> -->
   
    <div class="keys">Utilisez gauche et droite pour naviguer</div>

</div>

</body>
</html>
