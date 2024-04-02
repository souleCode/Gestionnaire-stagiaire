<?php
require_once('db.php');
include('fonctions.php');
$email =isset($_POST['email']) ? $_POST['email'] :'';
$email = secure($email);
if(!empty($email)){
    $userEmail = $email;
}else{
    $userEmail="";
}
$user =search_using_email2($userEmail);
$pwd=createRandomPassword();
// var_dump($pwd);
// die();
if($user!=null){
    $id= $user['iduser'];
    $query="UPDATE utilisateur SET pwd=md5('$pwd') WHERE iduser=$id";
    $result=$pdo->prepare($query);
    $result->execute();

    // Envoyer un message a l'utlisateur
    $to =$userEmail;
    $objet ="Initialisation du mot de passe";
    $content ="Votre nouveau mot de passe est '$pwd' ,veuillez utiliser ceci a la prochaine ouverture de session";
    $from ="From: Application Gestionnaire des stagiaires"."\r\n" . "Cc: souleonetraore.940@gmail.com";
    mail($to,$objet,$content,$from);
    $msg="Un message vous sera envoyé dans votre adresse email. Verifiez votre boite email";
}else{
    $error ="Aucun compte n'existe avec ce email. Veuillez utiliser le bon email";
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de passe oublier</title>
   
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/monstyle.css">
    
</head>
<body>

<div class="container col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-3">
        <div class="panel panel-primary margetop60">
            <div class="panel-heading text-center">Iniatialiser votre mot de passe</div>
            <div class="panel-body">

            <form method="POST" class="form" action ="initializepwd.php">
                <div class="form-group">
                    <label for="email">Votre email de recupération </label>
                    <input type="text" name="email" 
                                placeholder="saisissez le mail utilisé pour créer votre compte"
                                class="form-control"
                                autocomplet="off"
                                required ="required"/>
                </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success">
                        <span class="glyphicon gl"></span>
                        Initialiser 
                        
                        </button> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <button class="btn ">
                                <span><a class="glyphicon glyphicon-log-in"
                                href="login.php">&nbsp;Connexion</a></span>
                        </button>
                        
                    </div>
                    <?php
                      if(!empty($msg)){
                        echo "<div class='alert alert-info'>. $msg. </div>";
                      }else{
                        echo "<div class='alert alert-danger'>. $error. </div>";
                      }
                    ?>
                </form>
            </div>
        </div>
</div>
</body>
</html>