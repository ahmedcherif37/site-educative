<?php
session_start();
    if (! isset($_SESSION["membre"]))
        header("Location: connexion.php");
require_once "fonctions/bdd.php";
include_once "fonctions/membre.php";
include_once "fonctions/blog.php";
$bdd = bdd();
$infos = infos();
$commentaires = commentaire_user();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Infoprog - Contact</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:400,300,700">
    <script src="https://kit.fontawesome.com/23bf24c504.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="styles.css">   
</head>
<body>
<?php include "header.php" ?>
    <div class="container commentaires">
        <div class="row">
            <div id="comm" class="col-xs-12">
                <h1>Bienvenue <?= $infos["nom_prenom"] ?></h1>
            </div>
        </div>
            <div class="row">
            <div id="comm" class="col-xs-12">
                <h2>Pseudo :  <?= $infos["pseudo"] ?></h2>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                
                <p>Adresse e-mail : <?= $infos["email"] ?></p>
            </div>
        </div>
        <div id="comm" class="row">
            <div class="col-xs-12">
                <h1>Derniers commentaires !</h1>
            </div>
        </div>
        <?php 
         foreach($commentaires as $commentaire):
         ?>
        <div class="row commentaire">
            <div class="col-xs-12">
                <p class="date">Posté sur le module <?= $commentaire["titre"] ?>  le <time datetime="<?= $commentaire["publication"] ?>"><?= formatage_date($commentaire["publication"]) ?></time> :</p>
                <p><?= $commentaire["commentaires"] ?></p>
            </div>
        </div>
        <?php
        endforeach;
        ?>
       
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