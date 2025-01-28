<?php
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

    $checkQuery = "SELECT Code FROM country WHERE Code = :countryCode";
    $stmt = $conn->prepare($checkQuery);
    $stmt->bindParam(':countryCode', $countryCode, PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt->rowCount() === 0) {
        echo "Errore: Il codice paese ($countryCode) non esiste nella tabella 'country'.<br>";
    } else {
        $insertQuery = "INSERT INTO city (ID, Name, CountryCode, District, Population)
                        VALUES (:id, :name, :countryCode, :district, :population)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':countryCode', $countryCode, PDO::PARAM_STR);
        $stmt->bindParam(':district', $district, PDO::PARAM_STR);
        $stmt->bindParam(':population', $population, PDO::PARAM_INT);
        $stmt->execute();

        echo "Record inserito con successo!<br>";
    }

    $conn = null;
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
