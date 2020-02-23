<?php
session_start();
require_once "fonctions/bdd.php";
include_once "fonctions/blog.php";

$bdd = bdd();

if (!empty($_POST))
$modules = recherche();
else   
$modules = modules();

1
?>
<!DOCTYPE HTML>
<html lang ="fr">
<head>
   
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15" />
    <meta name="description" content="je m'appelle Ahmed cherif et je suis formateur / developpeur web freelance. Découvrez mes derniers travaux dans mon portfolio">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> programmation web </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:400,300,700">
    <link href="/your-path-to-fontawesome/css/all.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/23bf24c504.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="styles.css">   
</head>
<body>
   <?php include "header.php" ?>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h1> Apprendre la programmation web </h1>
                    <p>Ce site est destiné aux eleves de 4 science de l'informatique. vous allez apprendre à travers cet outil les notions de base de la programmation web à savoir le HTML , javascript et php </p>
                </div>
            </div>
        </div> 
    </section>
    
    <div class="container article">
        <div class="row">
            <form method="post" action="index.php">
                <div class="col-sm-10">
                    <input type="text" name="query" placeholder="Rechercher un module ..." value="<?php if (isset($_POST["query"])) echo $_POST["query"] ?>">
                </div>
                <div class="col-sm-2">
                    <input type="submit" value="OK!">
                </div>
            </form>
        </div>
      <?php 
        if (isset($_POST["query"])) :     
        ?>    
        <div class="row">
       
            <div class="col-xs-12">
            <h1>Résultat de votre recherche avec "<?= $_POST["query"] ?>" </h1>
                
            </div>
        
        </div>
        <?php
        endif;
         ?>
        <div class="row">
     
           <?php 
            foreach ($modules as $module):
            ?>
            <div class="col-md-4 col-sm-6">
                <article>
                    <img src="img/<?= $module["image"] ?>" alt="<?= $module["image"] ?>">
                    <p class ="date">Posté le <time datetime="<?= $module["publication"] ?>"><?= formatage_date($module["publication"] )?></time></p>
                    <h1> <?= $module["titre"] ?></h1>
                    <p> <?= $module["accroche"] ?></p>
                    <a href="module.php?id=<?= $module["id_module"] ?>" target="_blank">Voir le cours <i class="fas fa-rocket"></i></a>
                </article>
            </div>
                <?php
            endforeach;
             ?>
                 
            
        </div>
    </div>

</body>

</html>