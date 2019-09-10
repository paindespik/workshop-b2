

<?php
$titre = "Equipe artistique";
include_once("Index.php");
?>
<link href="test.css" rel="stylesheet">


<!-- Team -->
<?php
if ($bdd)
{
  
  echo'
    <section id="team" class="pb-5">
        <div class="container">
            <h5 class="section-title h1">Equipe artistique</h5>';
            if(!empty($id)){
                echo'
            <a href="danseur_post.php?action=nouveau&amp;">
            <img src="images/noueau.gif" alt="Nouveau danseur" title="Poster un nouveau danseur" /></a>';
            }
            echo'
            <h3>choregraphe</h3>
            <div class="row">';
                $rang = "choregraphe";
                $query=$bdd->prepare('SELECT *
                FROM personne
                where rang = :rang');
                $query->bindValue(':rang',$rang,PDO::PARAM_STR);
                $query->execute();
                    
                while($data = $query->fetch())
                {
                    if($data['rang'] == "choregraphe")
                    {
                        ?>  <!-- Team member -->                              
                        <div class="col-xs-12 col-sm-6 col-md-12">
                            <div class="image-flip" ontouchstart="this.classList.toggle('hover');">
                                <div class="mainflip">
                                    <div class="frontside">
                                        <div class="card">
                                            <div class="card-body text-center">
                                                <p><img class=" img-fluid" src="img/<?php echo $data['image']?>" alt="card image"></p>
                                                <h4 class="card-title"><?php echo $data['nom']." ".$data['prenom'] ?></h4>
                                                <p class="card-text"><?php echo $data['Poste'] ?></p>
                                                <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="backside">
                                        <div class="card"style="height: 20vw;">
                                            <div class="card-body text-center mt-4" style="height: 100%;">
                                                <h4 class="card-title"><?php echo $data['nom']." ".$data['prenom'] ?></h4>
                                                <p class="card-text"style="height: 18vw;overflow-y: auto;"><?php echo $data['description'] ?></p><?php
                                                if(!empty($id)){
                                                    echo'<a href="danseur_post.php?p='.$data['id'].'&amp;action=edit">';?>
                                                    <img src="images/edter.gif" alt="Editer"
                                                 title="Editer ce message" /> <?php
                                                 echo'
                                                 <a href="danseur_post.php?p='.$data['id'].'&amp;action=delete">'; ?>
                                                    <img src="images/edter.gif" alt="Supprimer"
                                                 title="Supprimer ce message" /><?php
                                                } ?>
                                                <ul class="list-inline">
                                                    <li class="list-inline-item">
                                                        <a class="social-icon text-xs-center" target="_blank" href="#">
                                                            <i class="fa fa-facebook"></i>
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <a class="social-icon text-xs-center" target="_blank" href="#">
                                                            <i class="fa fa-twitter"></i>
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <a class="social-icon text-xs-center" target="_blank" href="#">
                                                            <i class="fa fa-skype"></i>
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <a class="social-icon text-xs-center" target="_blank" href="#">
                                                            <i class="fa fa-google"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                        <!-- ./Team member -->
                        <!-- ./Team member --><?php
                        }
                    }
                    $query->CloseCursor();
                    echo'</div>
                    <h3>Danseurs</h3> ';
                    $rang = "danseur";
                    $query=$bdd->prepare('SELECT *
                    FROM personne
                    where rang = :rang');
                    $query->bindValue(':rang',$rang,PDO::PARAM_STR);
                    $query->execute();
                
                while($data = $query->fetch())
                {

                    if($data['rang'] == "danseur")
                    {
                        ?>  <!-- Team member -->  
                        <div class="row">                           
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="image-flip" ontouchstart="this.classList.toggle('hover');">
                                <div class="mainflip">
                                    <div class="frontside">
                                        <div class="card">
                                            <div class="card-body text-center">
                                                <p><img class=" img-fluid" src="img/<?php echo $data['image']?>" alt="card image"></p>
                                                <h4 class="card-title"><?php echo $data['nom']." ".$data['prenom'] ?></h4>
                                                <p class="card-text"><?php echo $data['Poste'] ?></p>
                                                <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="backside">
                                        <div class="card">
                                            <div class="card-body text-center mt-4">
                                                <h4 class="card-title"><?php echo $data['nom']." ".$data['prenom'] ?></h4>
                                                <p class="card-text"><?php echo $data['description'] ?></p><?php
                                                if(!empty($id)){
                                                    echo'<a href="danseur_post.php?p='.$data['id'].'&amp;action=edit">';?>
                                                    <img src="images/edter.gif" alt="Editer"
                                                 title="Editer ce message" /> <?php
                                                 echo'
                                                 <a href="danseur_post.php?p='.$data['id'].'&amp;action=delete">'; ?>
                                                    <img src="images/edter.gif" alt="Supprimer"
                                                 title="Supprimer ce message" /><?php
                                                } ?>
                                                <ul class="list-inline">
                                                    <li class="list-inline-item">
                                                        <a class="social-icon text-xs-center" target="_blank" href="#">
                                                            <i class="fa fa-facebook"></i>
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <a class="social-icon text-xs-center" target="_blank" href="#">
                                                            <i class="fa fa-twitter"></i>
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <a class="social-icon text-xs-center" target="_blank" href="#">
                                                            <i class="fa fa-skype"></i>
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <a class="social-icon text-xs-center" target="_blank" href="#">
                                                            <i class="fa fa-google"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ./Team member -->
                        <!-- ./Team member --><?php
                    }
                    }
                    $query->CloseCursor();
                    echo'</div>
                    <h3>Equipe Technique</h3> ';
                    $rang = "equipe technique";
                    $query=$bdd->prepare('SELECT *
                    FROM personne
                    where rang = :rang');
                    $query->bindValue(':rang',$rang,PDO::PARAM_STR);
                    $query->execute();
                
                while($data = $query->fetch())
                {

                    if($data['rang'] == "equipe technique")
                    {
                        ?>  <!-- Team member -->  
                        <div class="row">                           
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="image-flip" ontouchstart="this.classList.toggle('hover');">
                                <div class="mainflip">
                                    <div class="frontside">
                                        <div class="card">
                                            <div class="card-body text-center">
                                                <p><img class=" img-fluid" src="img/<?php echo $data['image']?>" alt="card image"></p>
                                                <h4 class="card-title"><?php echo $data['nom']." ".$data['prenom'] ?></h4>
                                                <p class="card-text"><?php echo $data['Poste'] ?></p>
                                                <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="backside">
                                        <div class="card">
                                            <div class="card-body text-center mt-4">
                                                <h4 class="card-title"><?php echo $data['nom']." ".$data['prenom'] ?></h4>
                                                <p class="card-text"><?php echo $data['description'] ?></p><?php
                                                if(!empty($id)){
                                                    echo'<a href="danseur_post.php?p='.$data['id'].'&amp;action=edit">';?>
                                                    <img src="images/edter.gif" alt="Editer"
                                                 title="Editer ce message" /> <?php
                                                 echo'
                                                 <a href="danseur_post.php?p='.$data['id'].'&amp;action=delete">'; ?>
                                                    <img src="images/edter.gif" alt="Supprimer"
                                                 title="Supprimer ce message" /><?php
                                                } ?>
                                                <ul class="list-inline">
                                                    <li class="list-inline-item">
                                                        <a class="social-icon text-xs-center" target="_blank" href="#">
                                                            <i class="fa fa-facebook"></i>
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <a class="social-icon text-xs-center" target="_blank" href="#">
                                                            <i class="fa fa-twitter"></i>
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <a class="social-icon text-xs-center" target="_blank" href="#">
                                                            <i class="fa fa-skype"></i>
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <a class="social-icon text-xs-center" target="_blank" href="#">
                                                            <i class="fa fa-google"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ./Team member -->
                        <!-- ./Team member --><?php
                    }
                    }
                        $query->CloseCursor();
                        echo'</div>
                        <h3>Partenaire artistique</h3>';
                        $rang = "partenaire artistique";
                        $query=$bdd->prepare('SELECT *
                        FROM personne
                        where rang = :rang');
                        $query->bindValue(':rang',$rang,PDO::PARAM_STR);
                        $query->execute();
                    
                    while($data = $query->fetch())
                    {
                    if($data['rang'] == "partenaire artistique")
                    {
                        ?>  <!-- Team member -->  
                        <div class="row">                          
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="image-flip" ontouchstart="this.classList.toggle('hover');">
                                <div class="mainflip">
                                    <div class="frontside">
                                        <div class="card">
                                            <div class="card-body text-center">
                                                <p><img class=" img-fluid" src="img/<?php echo $data['image']?>" alt="card image"></p>
                                                <h4 class="card-title"><?php echo $data['nom']." ".$data['prenom'] ?></h4>
                                                <p class="card-text"><?php echo $data['Poste'] ?></p>
                                                <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="backside">
                                        <div class="card">
                                            <div class="card-body text-center mt-4">
                                                <h4 class="card-title"><?php echo $data['nom']." ".$data['prenom'] ?></h4>
                                                <p class="card-text"><?php echo $data['description'] ?></p><?php
                                                if(!empty($id)){
                                                    echo'<a href="danseur_post.php?p='.$data['id'].'&amp;action=edit">';?>
                                                    <img src="images/edter.gif" alt="Editer"
                                                 title="Editer ce message" /> <?php
                                                 echo'
                                                 <a href="danseur_post.php?p='.$data['id'].'&amp;action=delete">'; ?>
                                                    <img src="images/edter.gif" alt="Supprimer"
                                                 title="Supprimer ce message" /><?php
                                                }
                                                ?>
                                                
                                                <ul class="list-inline">
                                                    <li class="list-inline-item">
                                                        <a class="social-icon text-xs-center" target="_blank" href="#">
                                                            <i class="fa fa-facebook"></i>
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <a class="social-icon text-xs-center" target="_blank" href="#">
                                                            <i class="fa fa-twitter"></i>
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <a class="social-icon text-xs-center" target="_blank" href="#">
                                                            <i class="fa fa-skype"></i>
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <a class="social-icon text-xs-center" target="_blank" href="#">
                                                            <i class="fa fa-google"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                    <?php
                }
                }
                ?>

            
        </div>
    </section>
          <?php
}
$query->CloseCursor();
echo'</div>';
?>
</body>

<?php
  include_once('IndexF.php');
?>
</html>