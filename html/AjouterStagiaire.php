<?php
    include('session.php');
    require_once('db.php');
    $query= "SELECT * FROM filiere";
    $resultF= $pdo->query($query);


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau stagiaire</title>
   
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/monstyle.css">
    
</head>
<body>
    <?php
    include ('menu.php');
    ?>

<div class="container">
        <div class="panel panel-primary margetop60">
            <div class="panel-heading text-center">Veuillez saisir les informations du nouveau élève...</div>
            <div class="panel-body">

            <form method="POST" class="form" action ="insertStagiaire.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nomF">Nom de l'élève</label>
                        <input type="text" name="nom" 
                                   placeholder="Nom du stagiaire"
                                   class="form-control"/>
                    </div>

                    <div class="form-group">
                        <label for="nomF">Prenom de l'élève</label>
                        <input type="text" name="prenom" 
                                   placeholder="prenom du stagiaire"
                                   class="form-control"/>
                    </div>

                    <div class="form-group">
                        <label for="civilite">Civilite:</label>
                        <div class="radio">
                               <label><input type="radio" name="civilite"  value="F" checked />F</label> <br>
                                <label><input type="radio" name="civilite" value="M"/>M</label>
                        </div>        
                    </div>

                    <div class="form-group">
                        <label for="idfiliere">Matiere:</label>
                            <select name="idfiliere" class="form-control " id="idfiliere">
                                <option value=0>Toutes les matières</option>
                              <?php
                                    while($filiere= $resultF->fetch()) { ?>
                                    <option value="<?php echo $filiere['idFiliere'] ?>">
                                        <?php echo strtoupper($filiere['nomFiliere']) ?>
                                    </option>
                               <?php }?>  
                            </select>
                    </div>

                    <div class="form-group">
                        <label for="photo">Photo:</label>
                        <input type="file" name="photo"/>
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
</html>