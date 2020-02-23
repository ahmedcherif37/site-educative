<?php
session_start();
require_once "fonctions/bdd.php";
include_once "fonctions/contact.php";

$bdd = bdd();
if (!empty($_POST))
    $erreurs = contact();

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
    <div class="container">
        <div class="row">
            <div  class="col-xs-12">
                <h1 id="comm">Contactez-moi !</h1>
            </div>
        </div>
    <form method="post" action="">
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
                    <div class="message confirmation">Votre message a bien été envoyé !</div>
                </div>
            </div>
            <?php
            endif;
            endif;
            ?>
            <div class="row">
                <div class="col-sm-6">
                    <input type="text" name="nom" placeholder="Votre nom *" value="<?php if (isset($_POST["nom"])) echo $_POST["nom"] ?>">
                </div>
            </div>
             <div class="row">
                <div class="col-sm-6">
                    <input type="text" name="email" placeholder="Votre adresse email *" value="<?php if (isset($_POST["email"])) echo $_POST["email"] ?>">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                      <textarea name="texte" placeholder="En quoi puis-je vous aider ? *"><?php if (isset($_POST["texte"])) echo $_POST["texte"] ?></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <input type="submit" value="Envoyer!">
                </div>
            </div>
        </form>
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