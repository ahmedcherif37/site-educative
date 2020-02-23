<?php

require_once "../fonctions/bdd.php";
include_once "../fonctions/admin.php";
$bdd = bdd();
supprimer();

header("Location: posts.php");