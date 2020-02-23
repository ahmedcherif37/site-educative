<?php
function bdd()
{try{
    $bdd= new PDO("mysql:dbname=bd_formation;host=localhost", "root", "");
    } catch (PDOException $e){
    echo 'connexion échouée : ' .$e->getMessage();
}
 return $bdd;
}
