<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Modifica Volo</title>
</head>
<body>
    <h1>Modifica Giorno di Partenza del Volo</h1>
    <form action="modifica_volo.php" method="post">
        <label for="codice_volo">Codice Volo:</label>
        <input type="text" id="codice_volo" name="codice_volo" required>
        <label for="data">Nuova Data di Partenza:</label>
        <input type="date" id="data" name="data" required>
        <button type="submit">Modifica</button>
    </form>
</body>
</html>
