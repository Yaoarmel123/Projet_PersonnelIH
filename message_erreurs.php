<?php
// Désactiver l'affichage les erreurs à l'écran
ini_set('display_errors', 0);
// Enregistrer les erreurs dans un fichier de log
ini_set('log_errors', 1);
// Nom du fichier qui enregistre les logs
ini_set('error_log', dirname(__file__) . '/log_error_php.txt');
?>