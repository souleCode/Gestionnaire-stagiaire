<?php
        session_start();
        require_once('db.php');
        include('fonctions.php');
        if($_SESSION['user']){
            // A ne pas oublier une fonction secure pour securiser les sorties.
            $nom =strtoupper(isset($_POST['nom']) ? $_POST['nom'] :'');
            $prenom =strtoupper(isset($_POST['prenom']) ? $_POST['prenom'] :'');
            $civilite =isset($_POST['civilite']) ? $_POST['civilite'] :'M';
            $idfiliere= isset($_POST['idfiliere']) ? $_POST['idfiliere'] :1;
            $photo= secure(isset($_FILES['photo']['name']) ? $_FILES['photo']['name'] :'');
            $photo_tem= secure($_FILES['photo']['tmp_name']);
            move_uploaded_file($photo_tem, "../images/".$photo);
            $nom = secure($nom);
            $prenom = secure($prenom);
            $idfiliere = secure($idfiliere);    

            if(!empty($nom) && !empty($idfiliere) && !empty($prenom) && !empty($civilite)){
                $query= 'INSERT INTO stagiaire(nom,prenom,civilite,idFiliere,photo) VALUES(?,?,?,?,?)';
                $params = array($nom,$prenom,$civilite,$idfiliere,$photo);
                $result = $pdo->prepare($query);
                $result->execute($params);
                header('Location: stagiaires.php');
            }else{
                $error= "Données invalides: Veuillez renseigner tous les champs";
                header("Location: alerte.php?message=$error");
            }
        }else{
            header('Location:login.php');
        }

        

?>