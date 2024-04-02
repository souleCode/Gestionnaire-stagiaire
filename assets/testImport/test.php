<?php

$annee = date('Y'); 
$mois = date('m');  
// Formater le numéro séquentiel avec des zéros à gauche pour qu'il fasse toujours 3 caractères
$numero_sequence_formate = sprintf("%03d", $numero_sequence);
$identifiant = $annee . $mois . '-' . $numero_sequence_formate;

echo "Identifiant généré : " . $identifiant;
?>