<?php
        session_start();
        require_once('db.php');
        include('fonctions.php');
        if($_SESSION['user']){
                // A ne pas oublier une fonction Secure pour securiser les sorties.
                $ids =isset($_POST['idS']) ? $_POST['idS'] :'';
                $nom = strtoupper( isset($_POST['nom']) ? $_POST['nom'] :'');
                $prenom = strtoupper( isset($_POST['prenom']) ? $_POST['prenom'] :'');
                $civilite= strtoupper( isset($_POST['civilite']) ? $_POST['civilite'] :'');
                $idfiliere= strtoupper( isset($_POST['idfiliere']) ? $_POST['idfiliere'] :1);


                $photo= isset($_FILES['photo']['name']) ? $_FILES['photo']['name'] :'';
                $photo_tem= $_FILES['photo']['tmp_name'];
                // var_dump($photo);
                // var_dump($photo_tem);
                // die();
                 move_uploaded_file($photo_tem, "../images/".$photo);
                //  echo $photo;
                //  die(); il faut forcement attribut enctype=multipart/form-data 
                //dans le formulaire pour pouvoir envoyer les donnees de type FILES
                //securite des donnees
                //la ligne 14 permet de deplacer la photo qui au debut etait stocker temporairement sur le sever vers un depotoirs(dossier images)
                        //physique. un var_dump($photo_tem) vous montrera le depotoirs virtuel sur notre server;
                $ids= secure($ids);
                $nom = secure($nom);
                $prenom = secure($prenom);
                $civilite = secure($civilite);
                $idfiliere = secure($idfiliere);
                $photo = secure($photo);
                //requete prepare: Never trust on users inputs....
                if(!empty($nom)&&!empty($prenom)&&!empty($photo)){
                        $query= "UPDATE stagiaire set nom=?,prenom=?,civilite=?,idFiliere=?,photo=? WHERE idStagiaire=?";
                        $params = array($nom,$prenom,$civilite,$idfiliere,$photo,$ids);
                        $result = $pdo->prepare($query);
                        $result->execute($params);
                        header('Location: stagiaires.php');
                }else{
                        $msg= "Erreur: Données invalides.";
                        header("Location: alerte.php?message=$msg");
                }
        }else{
                header("Location:login.php");
        }
       
?>