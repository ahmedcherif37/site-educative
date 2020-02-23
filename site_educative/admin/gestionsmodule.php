<?php

require_once "../fonctions/bdd.php";
include_once "../fonctions/admin.php";
$bdd = bdd();

$affs = afficher();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>4SITIC Admin - Posts</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:400,300,700">
    <link rel="stylesheet" href="../mains.css">
</head>
<body>
<?php include_once "header_admin.php" ?>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1>Anciens sous titre !</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <table>
                    <?php
                    foreach($affs as $aff):
                    ?>
                    <tr>
                        <td><?= $aff["titre_s_module"] ?></td>
                        <td><?= $aff["titre"] ?></td>
                        <td><a href="modifiersm.php?id=<?= $aff["id_s_module"] ?>"   class="glyphicon glyphicon-pencil"></a></td>
                        <td><a href="supprimersm.php?id=<?= $aff["id_s_module"] ?>"  class="glyphicon glyphicon-remove"></a></td>
                    </tr>
                   <?php
                    endforeach;
                    ?>
                </table>
            </div>
        </div>
        <footer>
            <div class="row">
                <div class="col-xs-12">
                    <a href="contact.html">Contact</a> - <a href="mentions.html">Mentions légales</a> - <a href="https://www.facebook.com/infoprog.tuto">Facebook</a>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>