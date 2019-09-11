
    <?php
    echo (!empty($titre))?'<title>'.$titre.'</title>':'<title> Forum </title>';
    ?>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <link rel="stylesheet" media="screen" type="text/css" title="Design" href="design.css" />
    <link href="css/style.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet">
    
    </head>
    <?php
    
    $lvl=(isset($_SESSION['level']))?(int) $_SESSION['level']:1;
    $id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
    $pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';
    
    
    include_once("function.php");
    include_once("constant.php");
    

?>