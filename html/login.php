<?php
session_start();
 if(isset($_SESSION['erreurLogin'])){
    $erreurLogin = $_SESSION['erreurLogin'];
 }else{
    $erreurLogin="";
 }
 if(isset($_SESSION['msg'])){
    $msg = $_SESSION['msg'];
 }else{
    $msg="";
 }
 if(isset($_SESSION['felicitation'])){
    $msg = $_SESSION['felicitation'];
 }else{
    $msg="";
}
 session_destroy();
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Se Connecter</title>
   
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/monstyle.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/maicons.css">
    
</head>
<body>

<div class="container col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-3">
        <div class="panel panel-primary margetop60">
            <div class="panel-heading text-center">Se connecter</div>
            <div class="panel-body">

            <form method="POST" class="form" action ="seConnecter.php">
                <?php if(!empty($erreurLogin)){?>
                    <div class="alert alert-danger">
                        <?php echo $erreurLogin?> 
                    </div>
                <?php } ?>
                <?php if(!empty($msg)){?>
                    <div class="alert alert-warning">
                        <?php echo $msg?> 
                    </div>
                <?php } ?>
                <div class="form-group">
                    <label for="identifiant">Identifiant secret</label>
                    <input type="text" name="identifiant" 
                                placeholder="Vote identifiant secret"
                                class="form-control"/>
                </div>

                    <div class="form-group input-container">
                        <label for="pwd">Mot de passe</label>
                        <input type="password" name="pwd" 
                                   placeholder="votre mot de passe"
                                   class="form-control newpwd"/>
                                   <span class="mai mai-eye show-new-pwd clickable"></span>
                    </div>


                    <div class="form-group">
                        <button type="submit" class="btn btn-success">
                        <span class="glyphicon glyphicon-log-in"></span>
                        Se connecter
                        
                        </button> <br> <br>

                        <div class="text-center"><a href="initializepwd.php">Mot de passe oublié?</a> </div>
                        <hr>

                        <div class="text-center">Etes-vous un élève?<a href="newCompte.php">Creer un compte </a> </div> <hr>
                        <div class="text-center">Etes-vous un enseignant?<a href="newCompteProf.php">Creer un compte</a> </div>
                    </div>
                </form>

            </div>
        </div>
</div>
</body>

<script src="../assets/js/jquery-3.3.1.js"></script>
<script src="../assets/js/monjs.js"></script>
</html>