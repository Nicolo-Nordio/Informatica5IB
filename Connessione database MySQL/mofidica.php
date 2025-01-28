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
            $name = $_POST['nome'];
            $countryCode = $_POST['countryCode'];
            $district = $_POST['district'];
            $population = $_POST['population'];

            $updateQuery = "UPDATE city 
                            SET Name = :name, CountryCode = :countryCode, District = :district, Population = :population 
                            WHERE ID = :id";

            $stmt = $conn->prepare($updateQuery);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':countryCode', $countryCode, PDO::PARAM_STR);
            $stmt->bindParam(':district', $district, PDO::PARAM_STR);
            $stmt->bindParam(':population', $population, PDO::PARAM_INT);
            $stmt->execute();

            echo "Voce modificata con successo!";
        } catch (PDOException $e) {
            echo "Errore: " . $e->getMessage();
        }
    }
?>