<?php
    session_start();
        require_once('db.php');
        include('fonctions.php');
        if($_SESSION['user']){
            $idu =isset($_POST['idU']) ? $_POST['idU'] :'';
            $login =  isset($_POST['login']) ? $_POST['login'] :'';
            $email =  isset($_POST['email']) ? $_POST['email'] :'';
            $role = secure(isset($_POST['role']) ? $_POST['role']:'VISITEUR');
    
            $idu= secure($idu);
            $login = secure($login);
            $email = secure($email);
            $role= secure($role);
    
            if(!empty($login)&&!empty($email)){
                $query= "UPDATE utilisateur set login=?,email=?,role=? WHERE iduser=?";
                $params = array($login,$email,$role,$idu);
                $result = $pdo->prepare($query);
                $result->execute($params);
                header('Location: utilisateurs.php');
            }else{
                $msg="Erreur: Données non valides";
                header("Location: alerte.php?message=$msg");
            }
        }else{
            header("Location: login.php");
        }

        
        

?>