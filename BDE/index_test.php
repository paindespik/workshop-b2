<?php session_start() ?>
<!DOCTYPE html>
<html>

<head>
<?php
  echo (!empty($titre))?'<title>'.$titre.'</title>':'<title> co stand </title>';
  ?>
</head>
<?php
 include_once("../getbdd.php");
 if($bdd) {
        $query=$bdd->prepare('SELECT * FROM users');
        $query->execute();
    ?>
    <body>
    <table>
    <?php
    while($data = $query->fetch())
    {
        ?>
        <tr>
        <th><?php echo $data['nom']; ?></th>
        <th><?php echo $data['mdp']; ?></th>
        <th>3eme</th>
        <th>4eme</th>
        </tr>
        <th>2.1</th>
        <th>2.2</th>
        <th>2.3</th>
        <th>2.3</th>
    </table>
    <?php
    }
 }
    ?>
</body>

</html>
