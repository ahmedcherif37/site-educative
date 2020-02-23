
<?php
session_start();
require_once "fonctions/bdd.php";
include_once "fonctions/blog.php";

$bdd = bdd();
$quess = question();

if (!empty($_POST))
{
    $x =  calculscore();
    $s=$x[0];
    $m=$x[1];
    
        
}

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
     <link rel="stylesheet" href="style.css">
</head>
<body>

    <?php include "header.php" ?>
    
   <div class="container article">
        <div class="row">
          <h1 id="comm"> Evaluation </h1>
        </div>
  
        <div class="row">
            <div class="col-xs-12">
                <p>cochez vrai si l'affirmation est correcte sinon cochez faux </p>
                <form method="post" action="">
                <table>
                    <tr>
                        <th> Num Question</th>
                        <th> Affirmation </th>
                        <th> Vrai </th>
                        <th> Faux</th>           
                    </tr>
                    <?php  
                       $i= 0;
                    foreach ($quess as $ques ):
                     
                    ?>
                    <tr>
                    <td> <?php $i=$i+1 ; echo $i; ?></td>
                    <td> <?= $ques["contenu_question"]?></td>
                    <td> <input id="form_radio" type="radio" name="rep<?= $i ?>" value="1"></td>
                    <td> <input id="form_radio" type="radio" name="rep<?= $i ?>" value="0"></td>
                    
                    </tr>
                    
                <?php
                endforeach;
                ?>
                 <tr>
                        <td> </td>
                        <td> <input type="submit" name="b1" value="résultat"> </td>
                        <td>  </td>
                        <td> </td>           
                    </tr>
                </table>
                </form>
            </div>
        </div>
       <div class="row">
            <div class="col-xs-12">
                <?php
                if (!empty($_POST)):
                ?>
                  <p> votre score est : <?= $s ?> % <?= $m ?>  </p>  
                <?php
                endif
                ?>
           </div>
       </div>
    </div>

        <footer>
            <div class="row">
                <div class="col-xs-12">
                    <a href="contact.php">Contact</a> - <a href="mentions.php">Mentions légales</a> - <a href="https://www.facebook.com/infoprog.tuto">Facebook</a>
                </div>
            </div>
        </footer>  
  
</body>
</html>