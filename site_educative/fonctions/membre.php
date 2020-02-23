<?php
function inscription()
{
    global $bdd;
    extract ($_POST).
        $validation = true;
        $erreur =[];
    
    if ( empty($nomp) || empty($pseudo) || empty($email) || empty($emailconf) || empty($password) || empty($passwordconf))
    {
        $validation = false;
        $erreur[]="Tous les champs sont obligatoires !!!";
    
    
    }
    if ( existe($pseudo))
    {
        $validation=false;
        $erreur[]="votre pseudo est déjà pris";
    }
    if (! filter_var($email,FILTER_VALIDATE_EMAIL))
    {
        $validation =false;
        $erreur[]= "L'adresse e-mail n'est pas valide !";
    }
    elseif($emailconf != $email)
         {
        $validation =false;
        $erreur[]= "L'adresse e-mail de confirmation est incorrecte !";
    }   
    if($passwordconf != $password)
         {
        $validation =false;
        $erreur[]= "Le mot de passe  de confirmation est incorrecte !";
    } 
    
    if ($validation)
    {
        
        $ins =$bdd ->prepare("insert into membre(nom_prenom,pseudo,email,password) values(:nomp,:pseudo,:email,:password) ");
        $ins->execute([
            "nomp" => htmlentities($nomp),
            "pseudo" => htmlentities($pseudo),
            "email" => htmlentities($email),
            "password" => password_hash($password, PASSWORD_DEFAULT)
        ]);
       
        
        unset($_POST["$nomp"]);
        unset($_POST["$pseudo"]);
         unset($_POST["$email"]);
         unset($_POST["$emailconf"]);
        
    }
    return $erreur;
}
function existe ($pseudo)
{
 
    global $bdd;
    
    $resultat = $bdd->prepare("select count(*) from membre where pseudo=?");
    $resultat->execute([$pseudo]);
    $resultat = $resultat->fetch()[0];
    return $resultat;  
}
function connexion()
{
    global $bdd;
    extract ($_POST);
    $erreur ="Les identifiants sont erronés";
    
        $connexion = $bdd->prepare("select id_membre , password from membre where pseudo=?");
        $connexion->execute([$pseudo]);
        $connexion= $connexion ->fetch();
    
    if (password_verify($password, $connexion["password"]))
    {
        $_SESSION["membre"]=$connexion["id_membre"];
        header("Location: compte.php");
    }
    else 
        return $erreur;
}
function deconnexion()
{
  unset($_SESSION["membre"]) ;
  session_destroy();
header("Location: connexion.php");
  
}

function infos()
{
    global $bdd;
    
    $membre= $bdd->prepare("select nom_prenom, pseudo, email from membre where id_membre=?");
    $membre->execute([$_SESSION["membre"]]);
    $membre=$membre->fetch();
    return $membre;
}




?>