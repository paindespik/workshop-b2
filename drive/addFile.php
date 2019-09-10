<?php

	include("../getbdd.php");
	if ($_FILES['nomFichier']['error'] > 0) {
		$resultat = -1;
	}
	else if ( $_FILES['nomFichier']['size'] > 1000000){
		$resultat= -2;
	}

	$extensions_valides = array('jpg', 'jpeg', 'png', 'rar', 'zip', 'docx', 'txt', 'html', 'php');
	
?>