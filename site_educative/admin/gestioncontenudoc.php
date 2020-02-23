<?php

require_once "../fonctions/bdd.php";
include_once "../fonctions/admin.php";

$bdd = bdd();
if (!empty($_POST))
    $erreurs = affiche_page();

$modules = posts();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>4SITIC  Admin - Accueil</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:400,300,700">
    <link rel="stylesheet" href="../mains.css">
</head>
<body>
<?php include_once "header_admin.php" ?>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1>Donner vos choix pour la modification !</h1>
            </div>
        </div>
        <form method="post" action="" enctype="multipart/form-data">
         <?php
         if (isset($erreurs)):
        foreach($erreurs as $erreur):
        ?>

            <div class="row">
                <div class="col-xs-12">
                    <div class="message erreur"><?= $erreur ?></div>
                </div>
            </div>
            <?php
            endforeach;
            endif;
  
            ?>
            <div class="row">
                <div class="col-sm-6">
                    <select name="titre_module" size="1">
                       <?php foreach($modules as $module): ?>
                        <option value='<?= $module["id_module"] ?>'><?= $module["titre"] ?> </option>
                        <?php 
                        endforeach;
                        ?>
                    </select>
                </div>
            
       
                <div class="col-sm-6">
                    <input type="radio" name="choix" value="sous_module"> sous module
                    <input type="radio" name="choix" value="document_joints"> document joints
                </div>
         
            </div>
            
            <div class="row">
                <div class="col-xs-12">
                    <input type="submit" value="valider!">
                </div>
            </div>
        </form>
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