<?php
        session_start();
        require_once('db.php');
        include('fonctions.php');
        if($_SESSION['user']){
            // A ne pas oublier une fonction secure pour securiser les sorties.
            $nomf =strtoupper(isset($_POST['nomF']) ? $_POST['nomF'] :'');
            $niveau= strtoupper( isset($_POST['niveau']) ? $_POST['niveau'] :'i');

            $nomf = secure($nomf);
            $niveau = secure($niveau);    

            if(!empty($nomf) && !empty($niveau)){
                $query= 'INSERT INTO filiere(nomFiliere,niveau) VALUES(?,?)';
                $params = array($nomf,$niveau);
                $result = $pdo->prepare($query);
                $result->execute($params);
                header('Location: filieres.php');
            }else{
                $error= "Données invalides";
                header("Location: alerte.php?message=$error");
            }
        }else{
            header("Location: login.php");
        }

        

?>