<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbName = "world";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbName", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $id = $_POST['id'];

            $deleteQuery = "DELETE FROM city WHERE ID = :id";
            $stmt = $conn->prepare($deleteQuery);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                echo "Voce cancellata con successo!";
            } else {
                echo "Nessuna voce trovata con l'ID specificato.";
            }
        } catch (PDOException $e) {
            echo "Errore: " . $e->getMessage();
        }
    }