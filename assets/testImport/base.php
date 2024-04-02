<?php
    $server ='localhost';
    $login ='root';
    $pass ='';
    try {
            $pdo =new PDO("mysql:host=$server;port=3345;dbname=student_test",$login,$pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
           //Pour que tout les erreurs soient lever
    }
    catch( Exception $e){
        die('Erreur de connexion à la base de données '. $e->getMessage());
    }
?>