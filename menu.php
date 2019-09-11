<?php
echo ' <div>';

if ($id == 0) {
    echo "Actuellement non connecté. </div> ";
}else{
    echo 'Bonjour '.$nom.' '.$prenom.' | id='.$id;
?><br>
    <a href="deconnexion.php">Se déconnecter <br></a>
<?php
}

echo '</div>';
