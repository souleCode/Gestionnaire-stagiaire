<?php
    require_once('db.php');
    include('fonctions.php');
    $idf =secure( isset($_GET['idF']) ? $_GET['idF']:0);
    $query= "SELECT * FROM filiere WHERE idFiliere=$idf";
    $result= $pdo->query($query);
    $filiere = $result->fetch();
    // var_dump($result);
    // die();
    $nomfiliere =  $filiere['nomFiliere'];
    $niveau = strtolower($filiere['niveau']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification d'une filière</title>
   
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/monstyle.css">
    
</head>
<body>
    <?php
    include ('menu.php');
    ?>

<div class="container">
        <div class="panel panel-primary margetop60">
            <div class="panel-heading text-center">Veuillez modifier la filière ici...</div>
            <div class="panel-body">

            <form method="POST" class="form" action ="updateFiliere.php">
                    <div class="form-group">
                        <label for="idF">ID de la filière:<?php echo $idf?></label>
                                <input type="hidden" name="idF" 
                                class="form-control"
                                value="<?php echo $idf?>"/>
                    </div>

                    <div class="form-group">
                        <label for="nomF">Nom de la filière</label>
                                <input type="text" name="nomF" 
                                class="form-control"
                                value="<?php echo $nomfiliere?>"/>
                    </div>


                    <div class="form-group">
                        <label for="niveau">Niveau:</label>
                            <select name="niveau" class="form-control " id="niveau">
                                <option value="all" <?php if($niveau=='all') echo 'selected' ?>  >Tous les niveaux</option>
                                <option value="ts"  <?php if($niveau=='ts') echo 'selected' ?>   >Technicien specialisé</option>
                                <option value="t"   <?php if($niveau=='t') echo 'selected' ?>    >Technicien</option>
                                <option value="l"   <?php if($niveau=='l') echo 'selected' ?>    >Licence</option>
                                <option value="m"   <?php if($niveau=='m') echo 'selected' ?>    >Master</option>
                                <option value="i"  <?php if($niveau=='i') echo 'selected' ?>     >Ingénieur</option>
                            </select>
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