<script>//
function bbcode(bbdebut, bbfin)
{
var input = window.document.formulaire.message;
input.focus();
if(typeof document.selection != 'undefined')
{
var range = document.selection.createRange();
var insText = range.text;
range.text = bbdebut + insText + bbfin;
range = document.selection.createRange();
if (insText.length == 0)
{
range.move('character', -bbfin.length);
}
else
{
range.moveStart('character', bbdebut.length + insText.length + bbfin.length);
}
range.select();
}
else if(typeof input.selectionStart != 'undefined')
{
var start = input.selectionStart;
var end = input.selectionEnd;
var insText = input.value.substring(start, end);
input.value = input.value.substr(0, start) + bbdebut + insText + bbfin + input.value.substr(end);
var pos;
if (insText.length == 0)
{
pos = start + bbdebut.length;
}
else
{
pos = start + bbdebut.length + insText.length + bbfin.length;
}
input.selectionStart = pos;
input.selectionEnd = pos;
}
 
else
{
var pos;
var re = new RegExp('^[0-9]{0,3}$');
while(!re.test(pos))
{
pos = prompt("insertion (0.." + input.value.length + "):", "0");
}
if(pos > input.value.length)
{
pos = input.value.length;
}
var insText = prompt("Veuillez taper le texte");
input.value = input.value.substr(0, pos) + bbdebut + insText + bbfin + input.value.substr(pos);
}
}
function smilies(img)
{
window.document.formulaire.message.value += '' + img + '';
}
</script>



<?php
session_start();
$titre="Poster";
$balises = true;
include_once("identifiants.php");
include_once("début.php");
include_once("menu.php");
?>
<?php

$action = (isset($_GET['action']))?htmlspecialchars($_GET['action']):'';

if ($id==0) erreur(ERR_IS_CO);

if (isset($_GET['f']))
{
    $forum = (int) $_GET['f'];
    $query= $bdd->prepare('SELECT forum_name, forum_id, auth_view, auth_post, auth_topic, auth_annonce, auth_modo
    FROM forum_forum WHERE forum_id =:forum');
    $query->bindValue(':forum',$forum,PDO::PARAM_INT);
    $query->execute();
    $data=$query->fetch();
    echo '<p><i>Vous êtes ici</i> : <a href="index.php">Index du forum</a> --> 
    <a href="voirforum.php?f='.$data['forum_id'].'">'.stripslashes(htmlspecialchars($data['forum_name'])).'</a>
    --> Nouveau topic</p>';

 
}
else if (isset($_GET['t']))
{
    $topic = (int) $_GET['t'];
    $query=$bdd->prepare('SELECT topic_titre, forum_topic.forum_id,
    forum_name, auth_view, auth_post, auth_topic, auth_annonce, auth_modo
    FROM forum_topic
    LEFT JOIN forum_forum ON forum_forum.forum_id = forum_topic.forum_id
    WHERE topic_id =:topic');
    $query->bindValue(':topic',$topic,PDO::PARAM_INT);
    $query->execute();
    $data=$query->fetch();
    $forum = $data['forum_id'];  

    echo '<p><i>Vous êtes ici</i> : <a href="index.php">Index du forum</a> --> 
    <a href="voirforum.php?f='.$data['forum_id'].'">'.stripslashes(htmlspecialchars($data['forum_name'])).'</a>
    --> <a href="voirtopic.php?t='.$topic.'">'.stripslashes(htmlspecialchars($data['topic_titre'])).'</a>
    --> Répondre</p>';
}
else if (isset ($_GET['p']))
{
    $post = (int) $_GET['p'];
    $query=$bdd->prepare('SELECT post_createur, forum_post.topic_id, topic_titre, forum_topic.forum_id,
    forum_name, auth_view, auth_post, auth_topic, auth_annonce, auth_modo
    FROM forum_post
    LEFT JOIN forum_topic ON forum_topic.topic_id = forum_post.topic_id
    LEFT JOIN forum_forum ON forum_forum.forum_id = forum_topic.forum_id
    WHERE forum_post.post_id =:post');
    $query->bindValue(':post',$post,PDO::PARAM_INT);
    $query->execute();
    $data=$query->fetch();

    $topic = $data['topic_id'];
    $forum = $data['forum_id'];
 
    echo '<p><i>Vous êtes ici</i> : <a href="index.php">Index du forum</a> --> 
    <a href="voirforum.php?f='.$data['forum_id'].'">'.stripslashes(htmlspecialchars($data['forum_name'])).'</a>
    --> <a href="voirtopic.php?t='.$topic.'">'.stripslashes(htmlspecialchars($data['topic_titre'])).'</a>
    --> Modérer un message</p>';
}
$query->CloseCursor();  
?>
<?php
switch($action)
    {
    case "repondre": 
        ?>
        <h1>Poster une réponse</h1>
        
        <form method="post" action="postok.php?action=repondre&amp;t=<?php echo $topic ?>" name="formulaire">
        
        
        <fieldset><legend>Message</legend>
        <textarea cols="80" rows="8" id="message" name="message"></textarea></fieldset>
        
        <input type="submit" name="submit" value="Envoyer" />
        <input type="reset" name = "Effacer" value = "Effacer"/>
        </p></form>
        <?php
    break;
    
    case "nouveautopic":
    ?>
        <h1>Nouveau topic</h1>
        <form method="post" action="postok.php?action=nouveautopic&amp;f=<?php echo $forum ?>" name="formulaire">
        
        <fieldset><legend>Titre</legend>
        <input type="text" size="80" id="titre" name="titre" /></fieldset>

        
        <fieldset><legend>Message</legend>
        <textarea cols="80" rows="8" id="message" name="message"></textarea>
        <label><input type="radio" name="mess" value="Annonce" />Annonce</label>
        <label><input type="radio" name="mess" value="Message" checked="checked" />Topic</label>
        </fieldset>
        <p>
        <input type="submit" name="submit" value="Envoyer" />
        <input type="reset" name = "Effacer" value = "Effacer" /></p>
        </form>
        <?php
    break;
    // futur editer ou supprimer 
    
    case "edit": //Si on veut éditer le post
        //On récupère la valeur de p
        $post = (int) $_GET['p'];
        echo'<h1>Edition</h1>';
    
        //On lance enfin notre requête
    
        $query=$bdd->prepare('SELECT post_createur, post_texte, auth_modo FROM forum_post
        LEFT JOIN forum_forum ON forum_post.post_forum_id = forum_forum.forum_id
        WHERE post_id=:post');
        $query->bindValue(':post',$post,PDO::PARAM_INT);
        $query->execute();
        $data=$query->fetch();

        $text_edit = $data['post_texte']; //On récupère le message

            //Le formulaire de postage
            ?>
            <form method="post" action="postok.php?action=edit&amp;p=<?php echo $post ?>" name="formulaire">
            <fieldset><legend>Message</legend><textarea cols="80" rows="8" id="message" name="message"><?php echo $text_edit ?>
            </textarea>
            </fieldset>
            <p>
            <input type="submit" name="submit" value="Editer !" />
            <input type="reset" name = "Effacer" value = "Effacer"/></p>
            </form>
            <?php
        
    break; //Fin de ce cas :o
    
    case "delete": //Si on veut supprimer le post
        //On récupère la valeur de p
        $post = (int) $_GET['p'];
        //Ensuite on vérifie que le membre a le droit d'être ici
        echo'<h1>Suppression</h1>';

        echo'<p>Êtes vous certains de vouloir supprimer ce post ?</p>';
        echo'<p><a href="./postok.php?action=delete&amp;p='.$post.'">Oui</a> ou <a href="./index.php">Non</a></p>';

    break;
    

    default: 
        echo'<p>Cette action est impossible</p>';
    }

?>
</div>
</body>
</html>
