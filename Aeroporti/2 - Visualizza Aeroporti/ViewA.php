<?php
// Connessione al database
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nazione = $_POST['nazione'];

    // Query per ottenere gli aeroporti della nazione specificata
    $query = "SELECT nome, citta FROM aeroporti WHERE nazione = :nazione";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':nazione', $nazione, PDO::PARAM_STR);
    $stmt->execute();

    // Mostra i risultati
    $risultati = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($risultati) > 0) {
        echo "<h2>Aeroporti in " . htmlspecialchars($nazione) . ":</h2>";
        echo "<ul>";
        foreach ($risultati as $aeroporto) {
            echo "<li>" . htmlspecialchars($aeroporto['nome']) . " - " . htmlspecialchars($aeroporto['citta']) . "</li>";
        }
        echo "</ul>";
    } else {
        echo "Nessun aeroporto trovato per la nazione selezionata.";
    }
}
?>
