<?php
session_start();
require_once "fonctions/bdd.php";
include_once "fonctions/blog.php";

$bdd = bdd();
$smodules = sous_module();

$titre=titre_module();
$docs=documentj();
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
    
<div class="container">
    
        <div class="row">
            <div class="col-xs-12">
                <h1 id="comm"> <?= $titre ?> </h1>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <table>
                    <?php 
                    foreach($smodules as $smodule):
                    ?>
                    <tr>
                        <td><?php echo ( '<span id="titre_tab">'.$smodule["titre_s_module"] ."</span> <br>". $smodule["contenu_s_module"] );?></td>
            
                    </tr>
                   <?php
                    endforeach;
                    ?>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <h1 id="comm"> Document à télécharger</h1>
                
            </div>
        </div>
           <div class="row">
            <div class="col-xs-12">
               <aside>
                <?php 
                    foreach($docs as $doc):
                ?>
                <p>  <a href="pdf/<?= $doc["document"] ?>"> <?= $doc["titre_document"] ?> <i class="fas fa-file-pdf"></i></a> </p>
                <?php
                endforeach;
                ?>
            </aside>
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