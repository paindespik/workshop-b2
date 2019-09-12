<?php
session_start();
$titre="Poster";
include_once("getbdd.php");
include_once("début.php");

$action = (isset($_GET['action']))?htmlspecialchars($_GET['action']):'';

if ($id==0) erreur(ERR_IS_CO);

switch($action)
{
    case "nouveautopic":
        $message = $_POST['message'];
        $mess = $_POST['mess'];

        $titre = $_POST['titre'];

        $forum = (int) $_GET['f'];
        $temps = time();

        if (empty($message) || empty($titre))
        {
            echo'<p>Votre message ou votre titre est vide, 
            cliquez <a href="poster.php?action=nouveautopic&amp;f='.$forum.'">ici</a> pour recommencer</p>';
        }
        else 
        {
            $query=$bdd->prepare('INSERT INTO forum_topic
            (forum_id, topic_titre, topic_createur, topic_vu, topic_time, topic_genre)
            VALUES(:forum, :titre, :id, 1, :temps, :mess)');
            $query->bindValue(':forum', $forum, PDO::PARAM_INT);
            $query->bindValue(':titre', $titre, PDO::PARAM_STR);
            $query->bindValue(':id', $id, PDO::PARAM_INT);
            $query->bindValue(':temps', $temps, PDO::PARAM_INT);
            $query->bindValue(':mess', $mess, PDO::PARAM_STR);
            $query->execute();


            $nouveautopic = $bdd->lastInsertId();
            $query->CloseCursor(); 

            $query=$bdd->prepare('INSERT INTO forum_post
            (post_createur, post_texte, post_time, topic_id, post_forum_id)
            VALUES (:id, :mess, :temps, :nouveautopic, :forum)');
            $query->bindValue(':id', $id, PDO::PARAM_INT);
            $query->bindValue(':mess', $message, PDO::PARAM_STR);
            $query->bindValue(':temps', $temps,PDO::PARAM_INT);
            $query->bindValue(':nouveautopic', (int) $nouveautopic, PDO::PARAM_INT);
            $query->bindValue(':forum', $forum, PDO::PARAM_INT);
            $query->execute();


            $nouveaupost = $bdd->lastInsertId();
            $query->CloseCursor(); 


            $query=$bdd->prepare('UPDATE forum_topic
            SET topic_last_post = :nouveaupost,
            topic_first_post = :nouveaupost
            WHERE topic_id = :nouveautopic');
            $query->bindValue(':nouveaupost', (int) $nouveaupost, PDO::PARAM_INT);    
            $query->bindValue(':nouveautopic', (int) $nouveautopic, PDO::PARAM_INT);
            $query->execute();
            $query->CloseCursor();

            $query=$bdd->prepare('UPDATE forum_forum SET forum_post = forum_post + 1 ,forum_topic = forum_topic + 1, 
            forum_last_post_id = :nouveaupost
            WHERE forum_id = :forum');
            $query->bindValue(':nouveaupost', (int) $nouveaupost, PDO::PARAM_INT);    
            $query->bindValue(':forum', (int) $forum, PDO::PARAM_INT);
            $query->execute();
            $query->CloseCursor();
        
            $query=$bdd->prepare('UPDATE forum_membres SET membre_post = membre_post + 1 WHERE membre_id = :id');
            $query->bindValue(':id', $id, PDO::PARAM_INT);    
            $query->execute();
            $query->CloseCursor();

            echo'<p>Votre message a bien été ajouté!<br /><br />Cliquez <a href="./index.php">ici</a> pour revenir à l index du forum<br />
            Cliquez <a href="voirtopic.php?t='.$nouveautopic.'">ici</a> pour le voir</p>';
        }
    break; 

    case "repondre":
        $message = $_POST['message'];

        $topic = (int) $_GET['t'];
        $temps = time();

        if (empty($message))
        {
            echo'<p>Votre message est vide, cliquez <a href="poster.php?action=repondre&amp;t='.$topic.'">ici</a> pour recommencer</p>';
        }
        else 
        {

            
            $query=$bdd->prepare('SELECT forum_id, topic_post FROM forum_topic WHERE topic_id = :topic');
            $query->bindValue(':topic', $topic, PDO::PARAM_INT);    
            $query->execute();
            $data=$query->fetch();
            $forum = $data['forum_id'];

            $query=$bdd->prepare('INSERT INTO forum_post
            (post_createur, post_texte, post_time, topic_id, post_forum_id)
            VALUES(:id,:mess,:temps,:topic,:forum)');
            $query->bindValue(':id', $id, PDO::PARAM_INT);   
            $query->bindValue(':mess', $message, PDO::PARAM_STR);  
            $query->bindValue(':temps', $temps, PDO::PARAM_INT);  
            $query->bindValue(':topic', $topic, PDO::PARAM_INT);   
            $query->bindValue(':forum', $forum, PDO::PARAM_INT); 
            $query->execute();

            $nouveaupost = $bdd->lastInsertId();
            $query->CloseCursor(); 

            
            $query=$bdd->prepare('UPDATE forum_topic SET topic_post = topic_post + 1, topic_last_post = :nouveaupost WHERE topic_id =:topic');
            $query->bindValue(':nouveaupost', (int) $nouveaupost, PDO::PARAM_INT);   
            $query->bindValue(':topic', (int) $topic, PDO::PARAM_INT); 
            $query->execute();
            $query->CloseCursor(); 

            $query=$bdd->prepare('UPDATE forum_forum SET forum_post = forum_post + 1 , forum_last_post_id = :nouveaupost WHERE forum_id = :forum');
            $query->bindValue(':nouveaupost', (int) $nouveaupost, PDO::PARAM_INT);   
            $query->bindValue(':forum', (int) $forum, PDO::PARAM_INT); 
            $query->execute();
            $query->CloseCursor(); 

            $query=$bdd->prepare('UPDATE forum_membres SET membre_post = membre_post + 1 WHERE membre_id = :id');
            $query->bindValue(':id', $id, PDO::PARAM_INT); 
            $query->execute();
            $query->CloseCursor(); 


            $nombreDeMessagesParPage = 15;
            $nbr_post = $data['topic_post']+1;
            $page = ceil($nbr_post / $nombreDeMessagesParPage);
            echo'<p>Votre message a bien été ajouté!<br /><br />
            Cliquez <a href="index.php">ici</a> pour revenir à l index du forum<br />
            Cliquez <a href="voirtopic.php?t='.$topic.'&amp;page='.$page.'#p_'.$nouveaupost.'">ici</a> pour le voir</p>';
        }//Fin du else
    break;

    case "edit": //Si on veut éditer le post
        //On récupère la valeur de p
        $post = (int) $_GET['p'];
    
        //On récupère le message
        $message = $_POST['message'];

        //Ensuite on vérifie que le membre a le droit d'être ici (soit le créateur soit un modo/admin)
        $query=$bdd->prepare('SELECT post_createur, post_texte, post_time, topic_id
        FROM forum_post
        LEFT JOIN forum_forum ON forum_post.post_forum_id = forum_forum.forum_id
        WHERE post_id=:post');
        $query->bindValue(':post',$post,PDO::PARAM_INT);
        $query->execute();
        $data1 = $query->fetch();
        $topic = $data1['topic_id'];

        //On récupère la place du message dans le topic (pour le lien)
        $query = $bdd->prepare('SELECT COUNT(*) AS nbr FROM forum_post 
        WHERE topic_id = :topic AND post_time < '.$data1['post_time']);
        $query->bindValue(':topic',$topic,PDO::PARAM_INT);
        $query->execute();
        $data2=$query->fetch();

            $query=$bdd->prepare('UPDATE forum_post SET post_texte =  :message WHERE post_id = :post');
            $query->bindValue(':message',$message,PDO::PARAM_STR);
            $query->bindValue(':post',$post,PDO::PARAM_INT);
            $query->execute();
            $nombreDeMessagesParPage = 15;
            $nbr_post = $data2['nbr']+1;
            $page = ceil($nbr_post / $nombreDeMessagesParPage);
            echo'<p>Votre message a bien été édité!<br /><br />
            Cliquez <a href="./index.php">ici</a> pour revenir à l index du forum<br />
            Cliquez <a href="./voirtopic.php?t='.$topic.'&amp;page='.$page.'#p_'.$post.'">ici</a> pour le voir</p>';
            $query->CloseCursor();
        
    break;

case "delete": //Si on veut supprimer le post
    //On récupère la valeur de p
    $post = (int) $_GET['p'];
    $query=$bdd->prepare('SELECT post_createur, post_texte, forum_id, topic_id
    FROM forum_post
    LEFT JOIN forum_forum ON forum_post.post_forum_id = forum_forum.forum_id
    WHERE post_id=:post');
    $query->bindValue(':post',$post,PDO::PARAM_INT);
    $query->execute();
    $data = $query->fetch();
    $topic = $data['topic_id'];
    $forum = $data['forum_id'];
	$poster = $data['post_createur'];

   
    
        $query = $bdd->prepare('SELECT topic_first_post, topic_last_post FROM forum_topic
        WHERE topic_id = :topic');
        $query->bindValue(':topic',$topic,PDO::PARAM_INT);
        $query->execute();
        $data_post=$query->fetch();
               
               
               
        //On distingue maintenant les cas
        if ($data_post['topic_first_post']==$post) //Si le message est le premier
        {
 
            echo'<p>Vous avez choisi de supprimer un post.
            Cependant ce post est le premier du topic. Voulez vous supprimer le topic ? <br />
            <a href="./postok.php?action=delete_topic&amp;t='.$topic.'">oui</a> - <a href="./voirtopic.php?t='.$topic.'">non</a>
            </p>';
            $query->CloseCursor();                     
        }
        elseif ($data_post['topic_last_post']==$post)  //Si le message est le dernier
        {
 
            //On supprime le post
            $query=$bdd->prepare('DELETE FROM forum_post WHERE post_id = :post');
            $query->bindValue(':post',$post,PDO::PARAM_INT);
            $query->execute();
            $query->CloseCursor();
           
            //On modifie la valeur de topic_last_post pour cela on
            //récupère l'id du plus récent message de ce topic
            $query=$bdd->prepare('SELECT post_id FROM forum_post WHERE topic_id = :topic 
            ORDER BY post_id DESC LIMIT 0,1');
            $query->bindValue(':topic',$topic,PDO::PARAM_INT);
            $query->execute();
            $data=$query->fetch();             
            $last_post_topic=$data['post_id'];
            $query->CloseCursor();

            //On fait de même pour forum_last_post_id
            $query=$bdd->prepare('SELECT post_id FROM forum_post WHERE post_forum_id = :forum
            ORDER BY post_id DESC LIMIT 0,1');
            $query->bindValue(':forum',$forum,PDO::PARAM_INT);
            $query->execute();
            $data=$query->fetch();             
            $last_post_forum=$data['post_id'];
            $query->CloseCursor();   
                   
            //On met à jour la valeur de topic_last_post
			
            $query=$bdd->prepare('UPDATE forum_topic SET topic_last_post = :last
            WHERE topic_last_post = :post');
            $query->bindValue(':last',$last_post_topic,PDO::PARAM_INT);
            $query->bindValue(':post',$post,PDO::PARAM_INT);
            $query->execute();
            $query->CloseCursor();
 
            //On enlève 1 au nombre de messages du forum et on met à       
            //jour forum_last_post
            $query=$bdd->prepare('UPDATE forum_forum SET forum_post = forum_post - 1, forum_last_post_id = :last
            WHERE forum_id = :forum');
            $query->bindValue(':last',$last_post_forum,PDO::PARAM_INT);
            $query->bindValue(':forum',$forum,PDO::PARAM_INT);
            $query->execute();
            $query->CloseCursor(); 
                        
            //On enlève 1 au nombre de messages du topic
            $query=$bdd->prepare('UPDATE forum_topic SET  topic_post = topic_post - 1
            WHERE topic_id = :topic');
            $query->bindValue(':topic',$topic,PDO::PARAM_INT);
            $query->execute();
            $query->CloseCursor(); 
                       
            //On enlève 1 au nombre de messages du membre
            $query=$bdd->prepare('UPDATE forum_membres SET  membre_post = membre_post - 1
            WHERE membre_id = :id');
            $query->bindValue(':id',$poster,PDO::PARAM_INT);
            $query->execute();
            $query->CloseCursor();  
                        
            //Enfin le message
            echo'<p>Le message a bien été supprimé !<br />
            Cliquez <a href="./voirtopic.php?t='.$topic.'">ici</a> pour retourner au topic<br />
            Cliquez <a href="./index.php">ici</a> pour revenir à l index du forum</p>';
 
        }
        else // Si c'est un post classique
        {
 
            //On supprime le post
            $query=$bdd->prepare('DELETE FROM forum_post WHERE post_id = :post');
            $query->bindValue(':post',$post,PDO::PARAM_INT);
            $query->execute();
            $query->CloseCursor();
                       
            //On enlève 1 au nombre de messages du forum
            $query=$bdd->prepare('UPDATE forum_forum SET forum_post = forum_post - 1  WHERE forum_id = :forum');
            $query->bindValue(':forum',$forum,PDO::PARAM_INT);
            $query->execute();
            $query->CloseCursor(); 
                        
            //On enlève 1 au nombre de messages du topic
            $query=$bdd->prepare('UPDATE forum_topic SET  topic_post = topic_post - 1
            WHERE topic_id = :topic');
            $query->bindValue(':topic',$topic,PDO::PARAM_INT);
            $query->execute();
            $query->CloseCursor(); 
                       
            //On enlève 1 au nombre de messages du membre
            $query=$bdd->prepare('UPDATE forum_membres SET  membre_post = membre_post - 1
            WHERE membre_id = :id');
            $query->bindValue(':id',$data['post_createur'],PDO::PARAM_INT);
            $query->execute();
            $query->CloseCursor();  
                        
            //Enfin le message
            echo'<p>Le message a bien été supprimé !<br />
            Cliquez <a href="./voirtopic.php?t='.$topic.'">ici</a> pour retourner au topic<br />
            Cliquez <a href="./index.php">ici</a> pour revenir à l index du forum</p>';
        }
break;

default:
    echo'<p>Cette action est impossible</p>';
} 
?>
</div>
</body>
</html>

