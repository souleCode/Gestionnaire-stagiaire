<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvelle Filière</title>
   
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/monstyle.css">
    
</head>
<body>
    <?php
    include ('menu.php');
    ?>

<div class="container">
        <div class="panel panel-primary margetop60">
            <div class="panel-heading text-center">Veuillez saisir les données de la nouvelle filière...</div>
            <div class="panel-body">

            <form method="POST" class="form" action ="insertFiliere.php">
                    <div class="form-group">
                        <label for="nomF">Nom de la filière</label>
                    <input type="text" name="nomF" 
                                   placeholder="Nom de la filière"
                                   class="form-control"/>
                    </div>

                    <div class="form-group">
                        <label for="niveau">Niveau:</label>
                            <select name="niveau" class="form-control " id="niveau">

                                <option value="all"  >Tous les niveaux</option>
                                <option value="ts" >Technicien specialisé</option>
                                <option value="t"  >Technicien</option>
                                <option value="l"  >Licence</option>
                                <option value="m"  >Master</option>
                                <option value="i" selected  >Ingénieur</option>
                            </select>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success">
                        <span class="glyphicon glyphicon-save"></span>
                        Enregistrer
                        </button> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <!-- <span> <a href="upload.php">Uploader un ficher csv</a></span> -->
                    </div>
                </form>

            </div>
        </div>
    </div>
</body>
</html>