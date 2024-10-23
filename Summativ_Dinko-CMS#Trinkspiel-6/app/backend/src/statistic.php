<?php
// Script für Statistik Anfrage
// Wegen Schwierigkeiten kein OOP
#error_reporting( E_ALL );
#ini_set( 'display_errors', '1' );
// Wenn Post empfangen wird
if (isset($_POST['btnValue']) && isset($_POST['questionId'])) {
    // Nur wenn Post ==
    if ($_POST['btnValue'] == 'positiv' || $_POST['btnValue'] == 'negativ') {
        // Getting the value of button
        // in $btnValue variable
        $btnValue = stripslashes(trim(htmlentities($_POST['btnValue'], ENT_QUOTES, "UTF-8")));
        $questionId = stripslashes(trim(htmlentities($_POST['questionId'], ENT_QUOTES, "UTF-8")));
        //Keine Fehler, wir können die Statistik Hinzufügen
        $pdo = new PDO('mysql:host=localhost;dbname=ineverdid', 'root', 'root');
        $statement = $pdo->prepare("SELECT * FROM statistic WHERE questionId = :questionId");
        $btnValue = $_POST['btnValue'];
        $questionId = $_POST['questionId'];
        $result = $statement->execute(array('questionId' => $questionId));
        $array = $statement->fetch();
        // Wenn Alles Inordnung ist, SQL erstellen und Update Database Row
        if ($array !== false) {
            if ($btnValue == 'positiv')
                $statement = $pdo->prepare("UPDATE statistic SET positiv = positiv +1 WHERE questionId = :questionId");
            if ($btnValue == 'negativ')
                $statement = $pdo->prepare("UPDATE statistic SET negativ = negativ +1 WHERE questionId = :questionId");
            $statement->execute(array('questionId' => $questionId));
            return false;
        } else {
            // Wenn Positiv bewertet wurde SQL..
            if ($btnValue == 'positiv')
                $statement = $pdo->prepare('INSERT INTO `statistic`(`questionId`, `positiv`) VALUES ( :questionId, 1 )');
            if ($btnValue == 'negativ')
                $statement = $pdo->prepare('INSERT INTO `statistic`(`questionId`, `negativ`) VALUES ( :questionId, 1 )');
            $result = $statement->execute(array('questionId' => $questionId));
            // Wenn result existiert. Rückgabe von True
            if ($result) {

                return true;
            } else {
                return false;
            }
        }
    }
}
