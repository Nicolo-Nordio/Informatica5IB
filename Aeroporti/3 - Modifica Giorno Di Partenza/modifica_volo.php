<?php
// Connessione al database
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $codice_volo = $_POST['codice_volo'];
    $nuova_data = $_POST['nuova_data'];

    // Query per aggiornare la data di partenza del volo
    $query = "UPDATE voli SET data = :nuova_data WHERE codice_volo = :codice_volo";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':nuova_data', $nuova_data, PDO::PARAM_STR);
    $stmt->bindParam(':codice_volo', $codice_volo, PDO::PARAM_STR);
    
    if ($stmt->execute()) {
        echo "Data di partenza del volo $codice_volo aggiornata con successo!";
    } else {
        echo "Errore nell'aggiornamento della data del volo.";
    }
}
?>
