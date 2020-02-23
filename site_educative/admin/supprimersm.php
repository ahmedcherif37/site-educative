<?php

require_once "../fonctions/bdd.php";
include_once "../fonctions/admin.php";
$bdd = bdd();
supprimer1();

header("Location: gestionsmodule.php");