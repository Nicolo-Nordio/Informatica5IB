<?php
// Connessione al database
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data_partenza = $_POST['data_partenza'];

    // Query per ottenere i voli della data specificata
    $query = "SELECT v.codice_volo, a1.citta AS partenza, a2.citta AS arrivo 
              FROM voli v
              JOIN aeroporti a1 ON v.id_aeroporto_partenza = a1.id_aeroporto
              JOIN aeroporti a2 ON v.id_aeroporto_arrivo = a2.id_aeroporto
              WHERE v.data = :data_partenza";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':data_partenza', $data_partenza, PDO::PARAM_STR);
    $stmt->execute();

    // Mostra i risultati
    $risultati = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($risultati) > 0) {
        echo "<h2>Voli del " . htmlspecialchars($data_partenza) . ":</h2>";
        echo "<ul>";
        foreach ($risultati as $volo) {
            echo "<li>" . htmlspecialchars($volo['codice_volo']) . " - Partenza: " . htmlspecialchars($volo['partenza']) . " - Arrivo: " . htmlspecialchars($volo['arrivo']) . "</li>";
        }
        echo "</ul>";
    } else {
        echo "Nessun volo trovato per la data selezionata.";
    }
}
?>
