<?php
$titre="Index du forum";
//include_once("identifiants.php");
include_once("début.php");
include_once("getbdd.php");
include_once("function.php");
include_once("constant.php");
echo '<p><i>Vous êtes ici</i> : <a href="index.php">Index du forum</a> --> <a href ="connexion.php">Connexion</a>';
?>
<?php
$totaldesmessages = 0;
$categorie = NULL;
if($bdd) {
    $query=$bdd->prepare('SELECT cat_id, cat_nom, 
    forum_forum.forum_id, forum_name, forum_desc, forum_post, forum_topic, auth_view, forum_topic.topic_id,  forum_topic.topic_post, post_id, post_time, post_createur, membre_pseudo, 
    membre_id 
    FROM forum_categorie
    LEFT JOIN forum_forum ON forum_categorie.cat_id = forum_forum.forum_cat_id
    LEFT JOIN forum_post ON forum_post.post_id = forum_forum.forum_last_post_id
    LEFT JOIN forum_topic ON forum_topic.topic_id = forum_post.topic_id
    LEFT JOIN forum_membres ON forum_membres.membre_id = forum_post.post_createur
    WHERE auth_view <= :lvl 
    ORDER BY cat_ordre, forum_ordre DESC');
    $query->bindValue(':lvl',$lvl,PDO::PARAM_INT);
    $query->execute();
    
    while($data = $query->fetch())
    {
        if( $categorie != $data['cat_id'] )
        {
        
            $categorie = $data['cat_id'];?>
            <h3><strong><?php echo stripslashes(htmlspecialchars($data['cat_nom'])); ?>
            </strong></h3>
            <?php
        }
        ?>
               
                    
               
                          <!-- Team member -->                              
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="image-flip" ontouchstart="this.classList.toggle('hover');">
                                <div class="mainflip">
                                    <div class="frontside">
                                        <div class="card">
                                            <div class="card-body text-center">
                                                <p><img class=" img-fluid" src="img/test2" alt="card image"></p>
                                                <h4 class="card-title"><?php echo' <strong>
                                                    <a href="voirforum.php?f='.$data['forum_id'].'">
                                                    '.stripslashes(htmlspecialchars($data['forum_name'])).'</a></strong></h4>
                                                    <a href="voirprofil.php?m='.stripslashes(htmlspecialchars($data['membre_id'])).'&amp;action=consulter">'.$data['membre_pseudo'];?>  </a>
                                                <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="backside">
                                        <div class="card"style="height: 20vw;">
                                            <div class="card-body text-center mt-4" style="height: 100%;">
                                                <h4 class="card-title"><?php echo' <strong>
                                                    <a href="voirforum.php?f='.$data['forum_id'].'">
                                                    '.stripslashes(htmlspecialchars($data['forum_name'])).'</a></strong></h4>';?>
                                                <p class="card-text"style="height: 18vw;overflow-y: auto;"><?php echo' '.nl2br(stripslashes(htmlspecialchars($data['forum_desc']))).'</p>';?>
                                                <!-- // if(!empty($id)){
                                                //     echo'<a href="danseur_post.php?p='.$data['id'].'&amp;action=edit">';
                                                //     <img src="images/edter.gif" alt="Editer"
                                                //  title="Editer ce message" /> 
                                                //  echo'
                                                //  <a href="danseur_post.php?p='.$data['id'].'&amp;action=delete">'; 
                                                //     <img src="images/edter.gif" alt="Supprimer"
                                                //  title="Supprimer ce message" />
                                                // }  -->
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
 //ici fin le test ?>
            </div>
