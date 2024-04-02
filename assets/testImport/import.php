<?php
require_once('base.php');

if(isset($_POST["student_name"])) {
    
    $student_name = $_POST["student_name"];
    $student_phone = $_POST["student_phone"];

    // Utilisation de transactions pour assurer l'intégrité de la base de données
    $pdo->beginTransaction();

    try {
        $query = "INSERT INTO tbl_student(student_name, student_phone) VALUES (?, ?)";
        $statement = $pdo->prepare($query);
        for($count = 0; $count < count($student_name); $count++) {
            $statement->execute([$student_name[$count], $student_phone[$count]]);
        }

        //Valider la transaction si tout s'est bien passé
        $pdo->commit();
        echo "Données insérées avec succès";
    } catch (PDOException $e) {
        // En cas d'erreur, annuler la transaction et afficher l'erreur
        $pdo->rollBack();
        echo "Erreur lors de l'insertion des données : ". $e->getMessage();
    }
}
?>
