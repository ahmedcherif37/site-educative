<?php

require_once "../fonctions/bdd.php";
include_once "../fonctions/admin.php";

$bdd = bdd();
if (!empty($_POST))
    $erreurs = ajout_titre();

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
                <h1>Ajouter un contenu !</h1>
            </div>
        </div>
        <form method="post" action="" enctype="multipart/form-data">
         <?php
         if (isset($erreurs)):
        if ($erreurs):
        foreach($erreurs as $erreur):
        ?>

            <div class="row">
                <div class="col-xs-12">
                    <div class="message erreur"><?= $erreur ?></div>
                </div>
            </div>
            <?php
            endforeach;
            else:
            ?>
            <div class="row">
                <div class="col-xs-12">
                    <div class="message confirmation">Votre module a bien été posté !</div>
                </div>
            </div>
            <?php
            endif;
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
                    <input type="text" name="titre" placeholder="sous titre *" value="<?php if(isset($_POST["titre"]) )echo $_POST["titre"] ;  ?>">
                </div>
         
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <textarea name="contenu" placeholder=" Définir le titre *"><?php if(isset($_POST["contenu"])) echo $_POST["contenu"] ;  ?></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <input type="submit" value="Poster!">
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