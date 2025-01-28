<!DOCTYPE html>
<html>
    <body>
        <h3>First php page</h3>
        <p>Any html command can be contained in a php file</p>
        <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbName = "world";

            try {
                $conn = new PDO("mysql:host=$servername;dbname=$dbName", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = 'SELECT name, population FROM city WHERE CountryCode="ITA"';
                $result_table = $conn->query($sql);

                echo '<table>';
                foreach ($result_table as $row) {
                    echo '<tr>';
                    echo '<td>' . $row['name'] . '</td>';
                    echo '<td>' . $row['population'] . '</td>';
                    echo '</tr>';
                }
                echo '</table>';

                $conn = null;
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
        ?>
    </body>
</html>
