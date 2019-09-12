<?php 
echo ' <div>';

if ($id==0) {
    echo "déco </div> ";
}else{
$query=$bdd->prepare('SELECT * From forum_membres WHERE membre_id = :id');
$query->bindvalue(':id',$id, PDO::PARAM_INT);
$query->execute();

?>
        <?php
        while ($data = $query->fetch())
        {
            if( $data['membre_id'] == $id){
            
    echo'
    '.stripslashes(htmlspecialchars($data['membre_pseudo'])).'</a></strong></td>; 
               
    <img src="images/avatars/'.$data['membre_avatar'].'" alt="" />
    <br />Membre inscrit le '.date('d/m/Y',$data['membre_inscrit']).'
    <br />Messages : '.$data['membre_post'].'<br />
    Localisation : '.stripslashes(htmlspecialchars($data['membre_localisation']));
          
    echo '
    <br /><hr />'.stripslashes(htmlspecialchars($data['membre_signature'])).'</td></tr>';
            }
    }
    $query->CloseCursor();
}



 echo '</div>';



?>