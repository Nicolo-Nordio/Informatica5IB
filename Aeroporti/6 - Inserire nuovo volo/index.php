<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Inserisci Nuovo Volo</title>
</head>
<body>
    <h2>Inserisci Nuovo Volo</h2>
    <form action="inserisci_volo.php" method="post">
        <label for="codice_volo">Codice Volo:</label>
        <input type="text" id="codice_volo" name="codice_volo" required>
        <br>
        <label for="data">Data:</label>
        <input type="date" id="data" name="data" required>
        <br>
        <label for="ora_partenza">Ora di Partenza:</label>
        <input type="time" id="ora_partenza" name="ora_partenza" required>
        <br>
        <label for="ora_arrivo">Ora di Arrivo:</label>
        <input type="time" id="ora_arrivo" name="ora_arrivo" required>
        <br>
        <label for="id_aereo">ID Aereo:</label>
        <input type="number" id="id_aereo" name="id_aereo" required>
        <br>
        <label for="id_aeroporto_partenza">ID Aeroporto Partenza:</label>
        <input type="number" id="id_aeroporto_partenza" name="id_aeroporto_partenza" required>
        <br>
        <label for="id_aeroporto_arrivo">ID Aeroporto Arrivo:</label>
        <input type="number" id="id_aeroporto_arrivo" name="id_aeroporto_arrivo" required>
        <br>
        <input type="submit" value="Inserisci Volo">
    </form>
</body>
</html>
