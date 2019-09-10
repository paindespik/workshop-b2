<?php
echo ' <div>';

if (!isset($_SESSION)) {
    echo "déco </div> ";
}else{
    echo 'Bonjour '.$nom.' '.$prenom;
}
echo '</div>';
