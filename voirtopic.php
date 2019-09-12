<?php
session_start();
$titre="Voir un sujet";
include_once("getbdd.php");
include_once("début.php");
 

$topic = (int) $_GET['t'];
 

$query=$bdd->prepare('SELECT topic_titre, topic_post, forum_topic.forum_id, topic_last_post,
forum_name, auth_view, auth_topic, auth_post 
FROM forum_topic 
LEFT JOIN forum_forum ON forum_topic.forum_id = forum_forum.forum_id 
WHERE topic_id = :topic');
$query->bindValue(':topic',$topic,PDO::PARAM_INT);
$query->execute();
$data=$query->fetch();
$forum=$data['forum_id']; 
$totalDesMessages = $data['topic_post'] + 1;
$nombreDeMessagesParPage = 15;
$nombreDePages = ceil($totalDesMessages / $nombreDeMessagesParPage);

echo '<p><i>Vous êtes ici</i> : <a href="index.php">Index du forum</a> --> 
<a href="voirforum.php?f='.$forum.'">'.stripslashes(htmlspecialchars($data['forum_name'])).'</a>
 --> <a href="voirtopic.php?t='.$topic.'">'.stripslashes(htmlspecialchars($data['topic_titre'])).'</a>';
echo '<h1>'.stripslashes(htmlspecialchars($data['topic_titre'])).'</h1><br /><br />';
?>
<?php

$page = (isset($_GET['page']))?intval($_GET['page']):1;

echo '<p>Page : ';
for ($i = 1 ; $i <= $nombreDePages ; $i++)
{
    if ($i == $page) 
    {
    echo $i;
    }
    else
    {
    echo '<a href="voirtopic.php?t='.$topic.'&page='.$i.'">
    ' . $i . '</a> ';
    }   
}
echo'</p>';
 
$premierMessageAafficher = ($page - 1) * $nombreDeMessagesParPage;
 

echo'<a href="poster.php?action=repondre&amp;t='.$topic.'">
<img src="images/repondre.gif" alt="Répondre" title="Répondre à ce topic" /></a>';
 

echo'<a href="poster.php?action=nouveautopic&amp;f='.$data['forum_id'].'">
<img src="images/noueau.gif" alt="Nouveau topic" title="Poster un nouveau topic" /></a>';
$query->CloseCursor(); 
var_dump($premierMessageAafficher);
$query=$bdd->prepare('SELECT post_id , post_createur , post_texte , post_time ,
membre_id, membre_pseudo, membre_inscrit, membre_avatar, membre_localisation, membre_post, membre_signature
FROM forum_post
LEFT JOIN forum_membres ON forum_membres.membre_id = forum_post.post_createur
WHERE topic_id =:topic
ORDER BY post_id
LIMIT :premier, :nombre');
$query->bindValue(':topic',$topic,PDO::PARAM_INT);
$query->bindValue(':premier',(int) $premierMessageAafficher,PDO::PARAM_INT);
$query->bindValue(':nombre',(int) $nombreDeMessagesParPage,PDO::PARAM_INT);
$query->execute();
 

if ($query->rowCount()<1)
{
        echo'<p>Il n y a aucun post sur ce topic, vérifiez l url et reessayez</p>';
}
else
{
        ?><table>
        <tr>
        <th class="vt_auteur"><strong>Auteurs</strong></th>             
        <th class="vt_mess"><strong>Messages</strong></th>       
        </tr>
        <?php
        while ($data = $query->fetch())
        {
                     echo'<tr><td><strong>
                     <a href="voirprofil.php?m='.$data['membre_id'].'&amp;action=consulter">
                     '.stripslashes(htmlspecialchars($data['membre_pseudo'])).'</a></strong></td>'; 
               
                     if ($id == $data['post_createur']){
                        echo'<td id=p_'.$data['post_id'].'>Posté à '.date('H\hi \l\e d M y',$data['post_time']).'
                        <a href="poster.php?p='.$data['post_id'].'&amp;action=delete">
                        <img src="images/supprimr.gif" alt="Supprimer"
                        title="Supprimer ce message" /></a>   
                        <a href="poster.php?p='.$data['post_id'].'&amp;action=edit">
                        <img src="images/edter.gif" alt="Editer"
                        title="Editer ce message" /></a></td></tr>';
                     }
                     else{
                        echo'<td>
                        Posté à '.date('H\hi \l\e d M y',$data['post_time']).'
                        </td></tr>';
                     }
                     echo'<tr><td>
                     <img src="images/avatars/'.$data['membre_avatar'].'" alt="" />
                     <br />Membre inscrit le '.date('d/m/Y',$data['membre_inscrit']).'
                     <br />Messages : '.$data['membre_post'].'<br />
                     Localisation : '.stripslashes(htmlspecialchars($data['membre_localisation'])).'</td>';
                           
                     
                     echo'<td>'.stripslashes(htmlspecialchars($data['post_texte'])).'
                     <br /><hr />'.stripslashes(htmlspecialchars($data['membre_signature'])).'</td></tr>';
        } 
                     $query->CloseCursor();
            
                     ?>
            </table>
            <?php
        echo '<p>Page : ';
        for ($i = 1 ; $i <= $nombreDePages ; $i++)
        {
                if ($i == $page) 
                {
                        echo $i;
                }
                else
                {
                        echo '<a href="voirtopic.php?t='.$topic.'&amp;page='.$i.'">
                        ' . $i . '</a> ';
                }
        }
        echo'</p>';
       
        
        $query=$bdd->prepare('UPDATE forum_topic
        SET topic_vu = topic_vu + 1 WHERE topic_id = :topic');
        $query->bindValue(':topic',$topic,PDO::PARAM_INT);
        $query->execute();
        $query->CloseCursor();

} 
?>           
</div>
</body>
</html>

            