<?php
    session_start();
        require_once('db.php');
        include('fonctions.php');
        if($_SESSION['user']){
            $id =isset($_POST['id']) ? $_POST['id'] :'';
            $login =  isset($_POST['login']) ? $_POST['login'] :'';
            $email =  isset($_POST['email']) ? $_POST['email'] :'';
            
    
            $id= secure($id);
            $login = secure($login);
            $email = secure($email);
            
    
            if(!empty($login)&&!empty($email)){
                $query= "UPDATE utilisateur set login=?,email=? WHERE iduser=?";
                $params = array($login,$email,$id);
                $result = $pdo->prepare($query);
                $result->execute($params);
                $_SESSION['msg']='Veuillez vous connectez en utilisant votre nouveau compte.Merci!';
                
                header('Location: login.php');
            }else{
                $msg="Erreur: Données non valides";
                header("Location: alerte.php?message=$msg");
            }
        }else{
            header("Location: login.php");
        }

        
        

?>