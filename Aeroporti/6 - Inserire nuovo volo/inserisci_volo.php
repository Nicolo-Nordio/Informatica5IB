<?php
// Connessione al database
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $codice_volo = $_POST['codice_volo'];
    $data = $_POST['data'];
    $ora_partenza = $_POST['ora_partenza'];
    $ora_arrivo = $_POST['ora_arrivo'];
    $id_aereo = $_POST['id_aereo'];
    $id_aeroporto_partenza = $_POST['id_aeroporto_partenza'];
    $id_aeroporto_arrivo = $_POST['id_aeroporto_arrivo'];

    // Query per inserire il nuovo volo
    $query = "INSERT INTO voli (codice_volo, data, ora_partenza, ora_arrivo, id_aereo, id_aeroporto_partenza, id_aeroporto_arrivo)
              VALUES (:codice_volo, :data, :ora_partenza, :ora_arrivo, :id_aereo, :id_aeroporto_partenza, :id_aeroporto_arrivo)";
    $stmt = $pdo->prepare($query);
    
    $stmt->bindParam(':codice_volo', $codice_volo);
    $stmt->bindParam(':data', $data);
    $stmt->bindParam(':ora_partenza', $ora_partenza);
    $stmt->bindParam(':ora_arrivo', $ora_arrivo);
    $stmt->bindParam(':id_aereo', $id_aereo);
    $stmt->bindParam(':id_aeroporto_partenza', $id_aeroporto_partenza);
    $stmt->bindParam(':id_aeroporto_arrivo', $id_aeroporto_arrivo);

    if ($stmt->execute()) {
        echo "Volo inserito con successo!";
    } else {
        echo "Errore nell'inserimento del volo.";
    }
}
?>
