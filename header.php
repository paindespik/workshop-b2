<!DOCTYPE html>
<html>
<head>
    <?php
    echo (!empty($titre))?'<title>'.$titre.'</title>':'<title>  </title>';
    ?>
</head>
    <?php
    
    $id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
    $nom=(isset($_SESSION['nom']))?$_SESSION['nom']:'';
    
    
    include_once("getbdd.php");