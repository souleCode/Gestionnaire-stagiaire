<?php
    require_once('db.php');
    include('fonctions.php');
    include('session.php');
    $ids =isset($_GET['idS']) ? $_GET['idS']:0;
    $ids= secure($ids);
    $queryS= "SELECT * FROM stagiaire WHERE idStagiaire=$ids";
    $resultS= $pdo->query($queryS);
    $stagiaire = $resultS->fetch();
    // var_dump($stagiaire);
    // die();
    $nomstagiaire =  $stagiaire['nom'];
    $prenomstagiaire =  $stagiaire['prenom'];
    $idfiliere =  $stagiaire['idFiliere'];
    $civilite =  strtoupper($stagiaire['civilite']);
    $photo =  $stagiaire['photo'];

    $queryF= "SELECT * FROM filiere";
    $resultF= $pdo->query($queryF);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification d'un stagiaire</title>
   
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/monstyle.css">
    
</head>
<body>
    <?php
    include ('menu.php');
    ?>

<div class="container">
        <div class="panel panel-primary margetop60">
            <div class="panel-heading text-center">Veuillez modifier le stagiaire ici...</div>
            <div class="panel-body">

            <form method="POST" class="form" action ="updateStagiaire.php"enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="idS">ID du stagiaire:<?php echo $ids?></label>
                                <input type="hidden" name="idS" 
                                class="form-control"
                                value="<?php echo $ids?>"/>
                    </div>

                    

                    <div class="form-group">
                        <label for="nom">Nom du stagiaire</label>
                                <input type="text" name="nom" 
                                class="form-control"placeholder="Nom"
                                value="<?php echo $nomstagiaire?>"/>
                    </div>

                    <div class="form-group">
                        <label for="prenom">Prenom du stagiaire</label>
                                <input type="text" name="prenom" 
                                class="form-control" placeholder="Prenom"
                                value="<?php echo $prenomstagiaire?>"/>
                    </div>

                    <div class="form-group">
                        <label for="civilite">Civilite:</label>
                        <div class="radio">
                               <label><input type="radio" name="civilite"value="F"
                                   <?php if($civilite==='F') echo 'checked' ?>
                               />F</label> <br>
                                <label><input type="radio" name="civilite"value="M"
                                   <?php if($civilite==='M') echo 'checked' ?>
                                />M</label>
                        </div>        
                    </div>

                    <div class="form-group">
                        <label for="idfiliere">Filière:</label>
                            <select name="idfiliere" class="form-control " id="idfiliere">
                              <?php
                                    while($filiere= $resultF->fetch()) { ?>
                                    <option value="<?php echo $filiere['idFiliere'] ?>" <?php if($idfiliere===$filiere['idFiliere']) echo 'selected' ?>>
                                        <?php echo $filiere['nomFiliere'] ?>
                                    </option>
                               <?php }?>
                                
                            </select>
                    </div>

                    <div class="form-group">
                        <label for="photo">Photo:</label>
                        <input type="file" id="photoInput" name="photo"/>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success">
                        <span class="glyphicon glyphicon-save"></span>
                        Enregistrer
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</body>
<script src="../assets/js/monjs.js"></script>
</html>