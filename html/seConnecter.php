<?php
session_start();
    require_once('db.php');
    include('fonctions.php');

    $identifiant =secure(isset($_POST['identifiant']) ? $_POST['identifiant']:'');
    $pwd =secure(isset($_POST['pwd']) ? $_POST['pwd']:'');
    
    if(!empty($identifiant)&&!empty($pwd)){
        $query= "SELECT eleve_id,nom,prenom,email,etat,niveau_id
                FROM eleves WHERE identifiant='$identifiant' 
                AND pwd=MD5('$pwd')";  
        $result= $pdo->query($query);
    
        if($user=$result->fetch()){
                if($user['etat']==1){
                    $_SESSION['user']=$user;
                    header("Location:../index.php");
                }else{
                    $_SESSION['erreurLogin']="<strong>Erreur!!!:</strong> Votre comptre est desactivé.<br> Veuillez contacer l'administaration";
                    header("Location:login.php");
                }
        }else{
                $_SESSION['erreurLogin']="<strong>Erreur!!!:</strong> login ou mot de passe incorrects";
                header("Location:login.php");
        }
    }

   
    
?>