<?php
function contact()
{
    global $bdd;
    extract ($_POST).
        $validation = true;
        $erreur =[];
    
    if ( empty($nom) || empty($email) || empty($texte))
    {
        $validation = false;
        $erreur[]="Tous les champs sont obligatoires !!!";
    
    
    }
    if (! filter_var($email,FILTER_VALIDATE_EMAIL))
    {
        $validation =false;
        $erreur[]= "L'adresse e-mail n'est pas valide !";
    }
    if ($validation)
    {
        $to ="ahmedcherif3232@gmail.com";
        $sujet ='Nouveau message de ' .$nom;
        $message = '
        <h1> Nouveau message de  ' .$nom .'</h1>
        <h2> Adresse e-mail : '.$email .'</h2>
        <p> ' .nl2br($texte) .'</p>   
        ';
        $headers= 'From: '.$nom .' <'.$email.'>'. "\r\n";
        $headers .= 'MIME-Version: 1.0'. "\r\n";
        $headers.= 'Content-type: text/html; charset=utf-8'. "\r\n";
        
        mail($to, $sujet, $message, $headers);
        
        unset($_POST["$nom"]);
         unset($_POST["$email"]);
         unset($_POST["$texte"]);
        
    }
    return $erreur;
}


?>