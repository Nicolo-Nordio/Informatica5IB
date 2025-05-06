<?php
// Connessione al database
include 'db.php';

// Query per ottenere l'aeroporto con il maggior numero di partenze
$query = "SELECT a.nome, COUNT(v.id_volo) AS num_partenze
          FROM aeroporti a
          LEFT JOIN voli v ON a.id_aeroporto = v.id_aeroporto_partenza
          GROUP BY a.id_aeroporto
          ORDER BY num_partenze DESC LIMIT 1";
$stmt = $pdo->prepare($query);
$stmt->execute();

// Mostra i risultati
$risultato = $stmt->fetch(PDO::FETCH_ASSOC);

echo "<h2>Aeroporto con il maggior numero di partenze:</h2>";
echo "<p>" . htmlspecialchars($risultato['nome']) . " con " . htmlspecialchars($risultato['num_partenze']) . " partenze</p>";
?>
