<?php
session_start();
require_once('db.php');
include('fonctions.php');
if($_SERVER['REQUEST_METHOD']=='POST'){
    $nom = secure($_POST['nom']);
    $prenom = secure($_POST['prenom']);
    $genre = secure($_POST['genre']);
    $birthday = secure($_POST['birthday']);
    $number = secure($_POST['numero']);
    $email = secure($_POST['email']);
    $niveauE = secure($_POST['niveau']);
    $identifiant = secure($_POST['ide']);
    $pwd = secure($_POST['pwd']);
    $pwd_conf = secure($_POST['pwd_conf']);
    $etat=0;

    $validationErrors = array();
    if(isset($nom)){
        $filterLogin =filter_var($nom, FILTER_SANITIZE_STRING);
    if(strlen($filterLogin)<2 ){
            $validationErrors[] = "Erreur!!! Le login doit contenir au moins 02 caracteres";
        }
    }

    if(isset($pwd)&& isset($pwd_conf)){
        $filterLogin =filter_var($login, FILTER_SANITIZE_STRING);
    if(empty($pwd )){
            $validationErrors[] = "Erreur!!! Le mot de passe doit pas etre vide";
        }
    }

    if(md5($pwd)!==md5($pwd_conf)){
        $validationErrors[] = "Erreur!!! Les deux mots de passe doivent etre identiques";
    }

    if(isset($email)){
        $filterEmail =filter_var($email, FILTER_SANITIZE_EMAIL);
        if($filterEmail!=true) {
            $validationErrors[] = "Erreur!!! email invalides";
        }
 }
 if(empty($validationErrors)){
    if(search_using_email($email)==0){
        $query= $pdo->prepare("INSERT INTO eleve(nom,prenom,genre,birthday,number,identifiantE,email,niveauE,pwd,etat) 
        VALUES(:pnom,:pprenom,:pgenre,:pbirthday,:pnumber,:pidentifiant,:pemail,:pniveauE,:ppwd,:petat)");
        $query->execute(array('pnom'=>$nom,
                                'pprenom'=>$prenom,
                                'pgenre'=>$genre,
                                'pbirthday'=>$birthday,
                                'pnumber'=>$number,
                                'pidentifiant'=>$identifiant,
                                'petat'=>$etat
                            ,'pemail'=>$email
                            ,'pniveauE'=>$niveauE
                            ,'ppwd'=>md5($pwd)     
                        ));
        $_SESSION['felicitation'] ="Félicitations!!! Votre compte est crée,mais temporairement inactif. Un administreur va l'activer le plus vite possible"; 
        header("Location:login.php?");               
    }else{
        $validationErrors[] = "Désolé un compte existe déjà avec cet email";
    }
 }
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creation d'un nouveau compte élève</title>
   
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/monstyle.css">
    
</head>
<body>

<div class="container col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-3">
        <div class="panel panel-primary margetop60">
            <div class="panel-heading text-center">Nouveau compte pour élève</div>
            <div class="panel-body">

            <form method="POST" class="form" action ="newCompte.php">
                <div class="form-group">
                    <label for="login">Nom </label>
                    <input type="text" name="nom" 
                                placeholder="Nom"
                                class="form-control" 
                                required="required" 
                                minlength="2"
                                autocomplet="off"
                                title="Le nom doit contneir au moins 4 lettres" />
                </div>

                <div class="form-group">
                    <label for="prenom">Prenom </label>
                    <input type="text" name="prenom" 
                                placeholder="prenom"
                                class="form-control" 
                                required="required" 
                                minlength="2"
                                autocomplet="off"
                                />

                                <div class="form-group">
                        <label for="genre">Genre:</label>
                        <div class="radio">
                               <label><input type="radio" name="genre"  value="F" checked />F</label> <br>
                                <label><input type="radio" name="genre" value="M"/>M</label>
                        </div>        
                    </div>


                <div class="form-group">
                    <label for="prenom">Date de naissance </label>
                    <input type="date" name="birthday" 
                                placeholder="Votre date de naissance"
                                class="form-control" 
                                required="required" 
                                
                                autocomplet="off"
                                />
                </div>


                <div class="form-group">
                    <label for="prenom">Numero de telephone</label>
                    <input type="number" name="numero" 
                                placeholder="Votre date de naissance"
                                class="form-control" 
                                required="required" 
                               
                                autocomplet="off"
                                />
                </div>

                <div class="form-group">
                    <label for="prenom">Entrez l'identifiant secret</label>
                    <input type="text" name="ide" 
                                placeholder="Votre code secret delivré par l'administration"
                                class="form-control" 
                                required="required" 
                                autocomplet="off"
                                />
                </div>



                <div class="form-group">
                    <label for="email">Email </label>
                    <input type="email" name="email"
                                required="required" 
                                autocomplet="off" 
                                placeholder="Votre adresse email"
                                class="form-control"/>
                </div>

                <div class="form-group">
                        <label for="niveau">Niveau:</label>
                            <select name="niveau" class="form-control " id="niveau">
                                <option value="tleA" >TleA</option>
                                <option value="tleD"  >TleD</option>
                                <option value="1A"  >1ereA</option>
                                <option value="1D"  >1ereD</option>
                                <option value="2C" selected  >2ndC</option>
                                <option value="2A" selected  >2ndA</option>
                                <option value="3e" selected  >3eme</option>
                                <option value="4e" selected  >4eme</option>
                                <option value="5e" selected  >5eme</option>
                                <option value="6e" selected  >6eme</option>
                            </select>
                    </div>

                    <div class="form-group">
                        <label for="pwd">Mot de passe</label>
                        <input type="password" name="pwd" 
                                   placeholder="votre mot de passe"
                                   class="form-control"
                                   required="required"/>
                    </div>

                    <div class="form-group">
                        <label for="pwd_conf">Confirmation</label>
                        <input type="password" name="pwd_conf" 
                                   placeholder="Confirmation du mot de passe"
                                   class="form-control"
                                   required="required" />
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success">
                        <span class="glyphicon glyphicon-save"></span>
                        Enregistrer
                        </button>
                    </div>

                    <?php
                    if(isset($validationErrors) && !empty($validationErrors)){
                        foreach($validationErrors as $error){
                            echo '<div class="alert-danger"/>' . $error .'<br/>' ;
                            
                        }
                    }
                       
                    
                    ?>
                </form>

            </div>
        </div>
</div>
</body>
</html>
