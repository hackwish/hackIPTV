<?php
$servername = "localhost";
$username = "root";
$password = "korpkorp";
$dbname = "canales";

$playlist = "canales_test.m3u";
// $fo = fopen($playlist, 'w') or die("can't open file");

// Cabecera Playlist
echo "#EXTM3U <br>";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT 
    c.idgrupo, g.descgrupo, c.nomcanal, c.logocanal, c.radio, c.url
FROM
    canales.canal c
INNER JOIN canales.grupo g
ON c.idgrupo=g.idgrupo
WHERE
    c.activo = '1'
ORDER BY c.idgrupo , c.idcanal , c.nomcanal DESC;";
$result = $conn->query($sql); // or die('Query failed: ' . mysql_error());

    while($row = $result->fetch_assoc()) {
        echo "#EXTINF:0, radio='" . $row['radio']. "' group-title='" . $row['descgrupo']. "' tvg-logo='" . $row['logocanal']. "', " . $row['nomcanal']. "<br>" . $row['url']. "<br>";
//      $lista ="#EXTINF:0, group-title='" . $row['grupocanal']. "', " . $row['nomcanal']. "<br>" . $row['url']. "<br>";

// fwrite($fo, $playlist);
// fclose($fo);
        }

$conn->close();
?>