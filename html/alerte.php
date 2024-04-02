<?php
    $message= isset($_GET['message']) ? $_GET['message'] :'Erreur';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alerte</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/monstyle.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
    
</head>
<body>
    <?php
    include ('menu.php');
    ?>

<div class="container">
        <div class="panel panel-danger margetop60">
            <div class="panel-heading text-center">
                <h4>Erreur</h4>
            </div>
            <div class="panel-body">
                <h3><?php echo $message ?></h3>
                <!-- Pour recuper la page precedente on utlise // echo $_SERVER['HTTP_REFERER'] ?> -->
                <h4><a class="text-center" href="<?php echo $_SERVER['HTTP_REFERER'] ?>">Retour >>></a></h4>
            </div>
        </div>
    </div>
</body>
</html>