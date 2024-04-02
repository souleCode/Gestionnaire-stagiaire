<?php
        session_start();
        require_once('db.php');
        include('fonctions.php');
        if($_SESSION['user']){
            $idu = secure(isset($_GET['idU']) ? $_GET['idU'] :0);
            $etat=secure(isset($_GET['etat']) ? $_GET['etat'] :0);

            //requete pour email
            $requete="SELECT nom,email FROM eleve WHERE id=$idu";
                $res= $pdo->query($requete);
                $Email = $res->fetch();
                
                $userEmail=$Email['email'];
                $nom=$Email['nom'];
                $prenom=$Email['prenom'];
                
                
    
            if($etat==1){
                $etat=0;

                // Envoyer un message a l'utlisateur
                $to =$userEmail;
                $objet ="ACTIVATION DE COMPTE";
                $content ="Cher(e) $nom .' '.$prenom, votre nouveau mot compte est activée par les administrateur ,Vous pouvez utiliser le site maintenant comme vous le souhaitez";
                $from ="From: Application Gestionnaire des stagiaires"."\r\n" . "Cc: souleonetraore.940@gmail.com";
                mail($to,$objet,$content,$from);

              
            }else{
                $etat=1;

                 // Envoyer un message a l'utlisateur
                 $to =$userEmail;
                 $objet ="DESACTIVATION DE COMPTE";
                 $content ="Cher(e) $nom .' '.$prenom, votre nouveau mot compte est Desactivé par les administrateur ,Veuillez contacter les administrateurs pour plus d'information";
                 $from ="From: Application Gestionnaire des stagiaires"."\r\n" . "Cc: souleonetraore.940@gmail.com";
                 mail($to,$objet,$content,$from);
            }
           
                $query= "UPDATE eleve set etat=? WHERE id=?";
                $params = array($etat,$idu);
                $result = $pdo->prepare($query);
                $result->execute($params);

                $requete="SELECT email FROM eleve WHERE id=$idu";
                $res= $pdo->query($requete);
                $userEmail = $res->fetch();
                header('Location: utilisateurs.php');
           
            
        }else{
            header('Location: login.php');
        }

        

?>