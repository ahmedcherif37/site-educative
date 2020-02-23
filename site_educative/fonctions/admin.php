<?php
function poster()
{
    global $bdd;
    extract($_POST);
    
    $validation=true;
    $erreurs=[];
    
    if ( empty($titre)|| empty($contenu))
    {
        $validation = false;
        $erreurs[]= "tous les champs sont obligatoires ";
    }
    if (!isset($_FILES["file"]) OR $_FILES["file"]["error"]>0)
    {
        $validation=false;
        $erreurs[]= "Il faut indiquer un fichier ";
        
    }
    
    if($validation)
    {
        $image = basename($_FILES["file"]["name"]);     
        move_uploaded_file($_FILES["file"]["tmp_name"], '../img/'.$image);
        
        $poster = $bdd->prepare("insert into modules(titre, accroche ,contenu, image) values (:titre , :accroche ,:contenu, :image)");
        $poster->execute([
            "titre" => htmlentities($titre),
            "accroche" => substr(htmlentities($contenu),0,200),
            "contenu" => nl2br(htmlentities($contenu)),
            "image" => htmlentities($image)
        ]);
        
        
        unset($_POST["titre"]);
        unset($_POST["contenu"]);
            
        
    }
    return $erreurs;
}

function posts()
{
    global $bdd;
    
    $posts= $bdd->query("select id_module , titre from modules order by id_module desc ");
    $posts= $posts->fetchAll();
    return $posts;
    
}

function post()
{
    global $bdd;
     $id = (int)$_GET["id"];
    
    $post= $bdd->prepare("select titre, contenu  from modules where id_module=? ");
    $post->execute([$id]);
    $post= $post->fetch();
    
    return $post;
    
}


function supprimer()
{
    global $bdd;
    $id = (int)$_GET["id"];
    $image = $bdd->prepare("select image from modules where id_module =?");
    $image->execute([$id]);
    $image = $image->fetch()["image"];
    
    unlink('../img/'.$image);
    
     
    $supprimer = $bdd->prepare("delete from sous_module where id_module=? ");
    $supprimer->execute([$id]);
    
    $supprimer = $bdd->prepare("delete from document_joints where id_module=? ");
    $supprimer->execute([$id]);
    
    $supprimer = $bdd->prepare("delete from modules where id_module=? ");
    $supprimer->execute([$id]);

}


function modifier()
{
    global $bdd;
    
    $erreur="";
    extract($_POST);
    $id = (int)$_GET["id"];
    if (!empty($titre) and !empty($contenu))
    {
        $modifier =$bdd->prepare("update modules set titre= :titre, accroche= :accroche, contenu = :contenu where id_module= :id");
        $modifier-> execute([
            "titre" => htmlentities($titre),
            "accroche" => substr(htmlentities($contenu),0,200),
            "contenu" => nl2br(htmlentities($contenu)),
            "id" => $id
        ]);
        
    }
    else
        $erreur.=" les champs doivent contenir quelques choses";
    
    return $erreur;
}

function ajout_titre()
{
    global $bdd;
    extract($_POST);
    
    $validation=true;
    $erreurs=[];
    
    if ( empty($titre)|| empty($contenu) || empty($titre_module))
    {
        $validation = false;
        $erreurs[]= "tous les champs sont obligatoires ";
    }

    if($validation)
    {

        
        $poster = $bdd->prepare("insert into sous_module(titre_s_module, contenu_s_module ,id_module) values (:titre , :contenu, :id)");
        $poster->execute([
            "titre" => htmlentities($titre),
            "contenu" => nl2br(htmlentities($contenu)),
            "id" => $titre_module
        ]);
        
        
        unset($_POST["titre"]);
        unset($_POST["contenu"]);
            
        
    }
    return $erreurs;
}

function documents()
{
    global $bdd;
    extract($_POST);
    
    $validation=true;
    $erreurs=[];
    
    if ( empty($titre)|| empty($titre_module))
    {
        $validation = false;
        $erreurs[]= "tous les champs sont obligatoires ";
    }
    if (!isset($_FILES["file"]) OR $_FILES["file"]["error"]>0)
    {
        $validation=false;
        $erreurs[]= "Il faut indiquer un fichier ";
        
    }
    
    if($validation)
    {
        $pdf = basename($_FILES["file"]["name"]);     
        move_uploaded_file($_FILES["file"]["tmp_name"], '../pdf/'.$pdf);
        
        $poster = $bdd->prepare("insert into document_joints(titre_document, document ,id_module) values (:titre , :doc ,:id)");
        $poster->execute([
            "titre" => htmlentities($titre),
            "doc" => htmlentities($pdf),
            "id" => htmlentities($titre_module)   
        ]);
        
        
        unset($_POST["titre"]);
        
            
        
    }
    return $erreurs;
}

function affiche_page()
{
    global $bdd;
    extract($_POST);
    
  $validation=true;
    $erreurs=[];
    
    if ( empty($titre_module)|| empty($choix))

    {
        $validation = false;
        $erreurs[]= "tous les champs sont obligatoires ";
    }

    
    if($validation)
    {

        
header("Location: gestion.php");
            
        
    }
    return $erreurs;

}
function afficher()
{
    global $bdd;
    

    $aff= $bdd->query("select s.id_s_module , s.titre_s_module , m.titre from sous_module s , modules m where s.id_module = m.id_module order by m.titre");
   
    $aff= $aff->fetchAll();
    return $aff;
    
}

function afficher1()
{
    global $bdd;
     $id = (int)$_GET["id"];
    
    $post= $bdd->prepare("select s.titre_s_module, s.contenu_s_module, m.titre  from sous_module s , modules m where s.id_module = m.id_module and id_s_module=? ");
    $post->execute([$id]);
    $post= $post->fetch();
    
    return $post;
    
}


function modifiersm()
{
    global $bdd;
    
    $erreur="";
    extract($_POST);
    $id = (int)$_GET["id"];
    if (!empty($titre) and !empty($contenu))
    {
        $modifier =$bdd->prepare("update sous_module set titre_s_module= :titre, contenu_s_module = :contenu where id_s_module= :id");
        $modifier-> execute([
            "titre" => htmlentities($titre),
            "contenu" => nl2br(htmlentities($contenu)),
            "id" => $id
        ]);
        
    }
    else
        $erreur.=" les champs doivent contenir quelques choses";
    
    return $erreur;
}

function supprimer1()
{
    global $bdd;
    $id = (int)$_GET["id"];

    
     
    $supprimer = $bdd->prepare("delete from sous_module where id_s_module=? ");
    $supprimer->execute([$id]);
    
}


function ajout_question()
{
    global $bdd;
    extract($_POST);
    
    $validation=true;
    $erreurs=[];
    
    if ( empty($contenu) || empty($titre_module))
    {
        $validation = false;
        $erreurs[]= "tous les champs sont obligatoires ";
    }

    if($validation)
    {

        
        $poster = $bdd->prepare("insert into question(contenu_question, reponse ,id_module) values (:contenu , :reponse, :id)");
        $poster->execute([   
            "contenu" => nl2br(htmlentities($contenu)),
             "reponse" => $reponse,
            "id" => $titre_module
        ]);
        
        
     
        unset($_POST["contenu"]);
            
        
    }
    return $erreurs;
}




