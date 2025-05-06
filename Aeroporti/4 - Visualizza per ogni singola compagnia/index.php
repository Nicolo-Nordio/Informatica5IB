<?php
// Connessione al database
include 'db.php';

// Query per ottenere il numero di voli per ogni compagnia
$query = "SELECT c.nome AS compagnia, COUNT(v.id_volo) AS num_voli
          FROM compagnie c
          LEFT JOIN aerei a ON c.id_compagnia = a.id_compagnia
          LEFT JOIN voli v ON a.id_aereo = v.id_aereo
          GROUP BY c.id_compagnia";
$stmt = $pdo->prepare($query);
$stmt->execute();

// Mostra i risultati
$risultati = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "<h2>Numero di voli per compagnia:</h2>";
echo "<ul>";
foreach ($risultati as $compagnia) {
    echo "<li>" . htmlspecialchars($compagnia['compagnia']) . ": " . htmlspecialchars($compagnia['num_voli']) . " voli</li>";
}
echo "</ul>";
?>
