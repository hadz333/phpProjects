<!DOCTYPE html>
<html>
<head>
<style>
table {
    width: 100%;
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
    padding: 5px;
}

th {text-align: left;}
</style>
</head>
<body>

<?php
$servername = "localhost";
$dbname = "familyGuyDB";
$username = "root";
$password = "";

$q = intval($_GET['q']);
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("SELECT * FROM Characters WHERE id = '".$q."'");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    print_r($result[0]);
    echo "<table>
    <tr>
    <th>Firstname</th>
    <th>Lastname</th>
    <th>Age</th>
    <th>Hometown</th>
    <th>Job</th>
    </tr>";
    echo "<tr>";
    echo "<td>" . $result[0]['FirstName'] . "</td>";
    echo "<td>" . $result[0]['LastName'] . "</td>";
    echo "<td>" . $result[0]['Age'] . "</td>";
    echo "<td>" . $result[0]['Hometown'] . "</td>";
    echo "<td>" . $result[0]['Job'] . "</td>";
    echo "</tr>";
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
echo "</table>";
?>
</body>
</html>