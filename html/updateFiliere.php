<?php
     session_start();
        require_once('db.php');
        include('fonctions.php');
        if ($_SESSION['user']){
                // A ne pas oublier une fonction Secure pour securiser les sorties.
                $idf =isset($_POST['idF']) ? $_POST['idF'] :'';
                $nomf = strtoupper( isset($_POST['nomF']) ? $_POST['nomF'] :'');
                $niveau= strtoupper( isset($_POST['niveau']) ? $_POST['niveau'] :'');

                $idf = secure($idf);
                $nomf = secure($nomf);
                $niveau = secure($niveau);
                if(!empty($nomf)&&!empty($niveau)){
                        $query= "UPDATE filiere set nomFiliere=?,niveau=? WHERE idFiliere=?";
                        $params = array($nomf,$niveau,$idf);
                        $result = $pdo->prepare($query);
                        $result->execute($params);
                        header('Location: filieres.php');
                }else{
                        $msg= "Erreur: Données invalides.";
                        header("Location: alerte.php?message=$msg");
                }
       

        }else{
                header("Location: login.php");
        }
        
?>