<?php
function modules()
{
    global $bdd;
    
    $modules = $bdd->query("select * from modules");
    $modules= $modules->fetchAll();
    return $modules;
    
}

function module (){
    global $bdd;
    
    $id = (int)$_GET["id"];
    $module = $bdd->prepare("select * from modules where id_module =?");
    $module->execute([$id]);
    $module= $module->fetch();
    
    if (empty($module))
        header("Location: index.php");
    else
        return $module;
}


function formatage_date($publication){
    
    $publication= explode(" ",$publication);
    $date = explode("-",$publication[0] );
    $heure =explode(":", $publication[1]);
    
    $mois = ["", "janvier","février", "mars", "avril","mai","juin","juillet","août","septembre", "octobre","novembre","décembre"];
    
    $resultat = $date[2]. ' ' .$mois[(int)$date[1]]. ' '.$date[0].' à '.$heure[0]. 'h '.$heure[1] ;
    return $resultat;
}

function nb_commentaire(){
    global $bdd;
    $id_module =(int)$_GET["id"];
    
    $nb_commentaire = $bdd -> prepare('select count(*) from commentaire where id_module= ?');
    $nb_commentaire-> execute([$id_module]);
    $nb_commentaire = $nb_commentaire-> fetch()[0];
    return $nb_commentaire;
}

function aff_comm(){
   global $bdd;
    $id_module= (int)$_GET["id"];
    
    $comm= $bdd->prepare("select commentaire.* , membre.nom_prenom from commentaire inner join membre on commentaire.id_membre = membre.id_membre and commentaire.id_module =?");
    
    $comm->execute([$id_module]);
    $comm = $comm->fetchAll();
    return $comm;
    
        
}

function recherche()
{
   global $bdd; 
    
    extract($_POST);
    
    $recherche = $bdd->prepare("select * from modules where titre like :query or contenu like :query");
    $recherche ->execute([
        "query" => '%'.$query.'%'
    ]);
    
    $recherche= $recherche->fetchAll();
return $recherche;
}

function commentaire_user()
{
    global $bdd;
    
    $commentaire= $bdd->prepare("select commentaire.* , modules.titre from commentaire inner join modules on commentaire.id_module = modules.id_module and commentaire.id_membre=?");
    $commentaire->execute([$_SESSION["membre"]]);
    $commentaire=$commentaire->fetchAll();
    
    return $commentaire;
    
}

function commenter()
{
   if(isset($_SESSION["membre"]))
   {
    global $bdd;
    
    $erreur ="";
    extract($_POST);
    if (! empty($commentaire) )
    {
        $id_module= (int)$_GET["id"];
        $ins_com= $bdd->prepare("insert into commentaire (id_membre, id_module,commentaires) values (:id_membre,:id_module,:commentaires) ");
        $ins_com->execute([
            "id_membre" =>  $_SESSION["membre"],
            "id_module" => $id_module,
            "commentaires" => nl2br( htmlentities($commentaire) )  
        ]);
    }
       else
        $erreur .= "veuillez ecrire votre commentaire";
   }
    return $erreur;
    
}
function titre_module (){
    global $bdd;
    
    $id = (int)$_GET["id"];
    $titrem = $bdd->prepare("select titre from modules where id_module =?");
    $titrem->execute([$id]);
    $titrem= $titrem->fetch()[0];
    

        return $titrem;
}

function sous_module (){
    global $bdd;
    
    $id = (int)$_GET["id"];
    $smodule = $bdd->prepare("select * from sous_module where id_module =?");
    $smodule->execute([$id]);
    $smodule= $smodule->fetchAll();
    
    if (empty($smodule))
        header("Location: module.php");
    else
        return $smodule;
}

function documentj (){
    global $bdd;
    
    $id = (int)$_GET["id"];
    $doc = $bdd->prepare("select * from document_joints where id_module =?");
    $doc->execute([$id]);
    $doc= $doc->fetchAll();
  
        return $doc;
}

function question (){
    global $bdd;
    
    $id = (int)$_GET["id"];
    $ques = $bdd->prepare("select * from question where id_module =?");
    $ques->execute([$id]);
    $ques= $ques->fetchAll();
    return $ques;
    
}

function calculscore()
{
    
   global $bdd;
    
    $id = (int)$_GET["id"];
    extract($_POST);
    
    $ques = $bdd->prepare("select count(*) from question where id_module =?");
    $ques->execute([$id]);
    $num= $ques-> fetch()[0];
    
    $ques = $bdd->prepare("select * from question where id_module =?");
    $ques->execute([$id]);
    $ques= $ques->fetchAll();
    
    $i= 1;
    foreach ($ques as $que )
    {
     $rep[$i]= $que["reponse"];
    $i=$i+1;
    }
    $r = 0;
    for($j=1 ; $j<=$num ; $j++)
    {
      if (isset(${"rep".$j}))
        if (${"rep".$j}==$rep[$j])
         $r = $r+1;   
        
    }
    
    $score= ($r /$num )* 100 ;
    $ins_eval= $bdd->prepare("insert into evaluation (id_membre, id_module,date_test, score) values (:id_membre,:id_module,:date_test,:score) ");
    $ins_eval->execute([
            "id_membre" =>  $_SESSION["membre"],
            "id_module" => $id,
            "date_test" => date("Y-m-d H:i:s") ,
            "score" =>$score
    ]);
    
    if ($score >= 70)
        $msg="vous avez reussi votre examen";
        else
        $msg="vous avez perdu votre examen";
    return array ($score , $msg);
        
    }  





?>