
<?php
session_start();
require_once "fonctions/bdd.php";
include_once "fonctions/blog.php";

$bdd = bdd();
$module = module();
$nb_commentaire= nb_commentaire();
$comms= aff_comm();
if (!empty($_POST))
    $erreur= commenter();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>4INFOTIC - Module</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:400,300,700">
    <script src="https://kit.fontawesome.com/23bf24c504.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="styles.css"> 
</head>
<body>

    <?php include "header.php" ?>
    
   <div class="container article">
        <div class="row">
            <form method="post" action="index.php">
                <div class="col-sm-10">
                    <input type="text" name="query" placeholder="Rechercher un article ...">
                </div>
                <div class="col-sm-2">
                    <input type="submit" value="OK!">
                </div>
            </form>
        </div>
  
        <div class="row">
            <article>
                <div class="col-md-4 col-sm-6">
                    <img src="img/<?= $module["image"] ?>" alt="<?= $module["image"] ?>">
                </div>
                <div class="col-sm-7">
                    <p class="date">Posté le <time datetime="<?= $module["publication"] ?>"><?= formatage_date($module["publication"]) ?></time></p>
                    <h1><?= $module["titre"] ?></h1>
                    <p> <?= $module["contenu"] ?></p>
                    <?php 
                         if (isset($_SESSION["membre"])):
                    ?>
                     <a href="sous_module.php?id=<?= $module["id_module"] ?>" target="_blank">Voir le cours détaillé <i class="fas fa-rocket"></i></a>
                     <a href="evaluation.php?id=<?= $module["id_module"] ?>" target="_blank">Testez votre niveau <i class="fas fa-rocket"></i></a>
                    <?php
                    endif;
                     ?>
                </div>
            </article>
        </div>
    </div>
    <div class="container commentaires">
        <div class="row">
            <div class="col-xs-12">
                <h1>Commentaires (<?= $nb_commentaire ?>)</h1>
            </div>
        </div>
        <?php 
    foreach($comms as $comm) :
        ?>
        <div class="row commentaire">
            <div class="col-xs-12">
                <p class="date">Posté par  <?= $comm["nom_prenom"] ?>  <time datetime="<?= $comm["publication"] ?>"><?= formatage_date($comm["publication"]) ?></time> :</p>
                <p><?= $comm["commentaires"] ?> </p>
            </div>
        </div>
   <?php
     endforeach;
    if (isset($_SESSION["membre"])):
    ?>
     <div class="row">
            <div class="col-xs-12">
                <form method="post" action="">
                  <?php
         if (isset($erreur)):
        if ($erreur):
        
        ?>

            <div class="row">
                <div class="col-xs-12">
                    <div class="message erreur"><?= $erreur ?></div>
                </div>
            </div>
            <?php
          
            else:
            ?>
            <div class="row">
                <div class="col-xs-12">
                    <div class="message confirmation">Votre commentaire a bien été posté !</div>
                </div>
            </div>
            <?php
            endif;
            endif;
            ?>
                    <textarea name="commentaire" placeholder="Votre commentaire *"></textarea>
                    <input type="submit" value="Commenter">
                </form>
            </div>
        </div>
        <?php
        endif;
        ?>
        <footer>
            <div class="row">
                <div class="col-xs-12">
                    <a href="contact.php">Contact</a> - <a href="mentions.php">Mentions légales</a> - <a href="https://www.facebook.com/infoprog.tuto">Facebook</a>
                </div>
            </div>
        </footer>  
    </div>
</body>
</html>