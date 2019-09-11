<?php
session_start();
include("../header.php");
include("../menu.php");

$addId =$_POST['addId'];

$id_projet = $_SERVER['REQUEST_URI'];
$id_projet = substr($id_projet, -2);
$id_projet = intval($id_projet);
$projetId =null; //afaire

$query =   "SELECT id_user 
            FROM users,membres_projets
            WHERE id_membre = id_user 
            AND membres_projets.id_membre=users.id_user
            AND membres_projets.id_projet=$id_projet";
	$stmt = $bdd->prepare($query);
    $stmt->execute();

    $file = $stmt->fetch();   
	if($file) {
        $i=0;
        while($file) { 

            $file['id_user'] = intval($file['id_user']);
            
            if($file['id_user']==$addId){
                        $i++;
            }
            else{
            }
            $file = $stmt->fetch();
        }
        if($i==0){        
            echo"yes";

          $stmt = $bdd->prepare("INSERT INTO membres_projets VALUES (".$addId.",".$id_projet.")");                                
          $stmt->execute();               
          header("Location: ../index.php");  
        }
    }
    

    






?>