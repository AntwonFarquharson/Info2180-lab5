<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

if (isset($_GET['country'])) { $country = $_GET['country']; } else { $country = ""; }
if (isset($_GET['lookup']) && $_GET['lookup'] == 'cities') { $lookup = 'cities'; } else { $lookup = 'countries'; }

if ($lookup == 'cities') {
    $sql = "SELECT cities.name AS city_name, cities.district, cities.population 
            FROM cities 
            JOIN countries ON cities.country_code = countries.code 
            WHERE countries.name LIKE '%$country%'";
} else {
    $sql = "SELECT name, continent, independence_year, head_of_state 
            FROM countries 
            WHERE name LIKE '%$country%'";
}

$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    echo "<table>";
    if ($lookup == 'cities') {
        echo "<tr><th>Name</th><th>District</th><th>Population</th></tr>";
    } else {
        echo "<tr><th>Country Name</th><th>Continent</th><th>Independence Year</th><th>Head of State</th></tr>";
    }
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        if ($lookup == 'cities') {
            echo "<td>" . htmlspecialchars($row['city_name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['district']) . "</td>";
            echo "<td>" . htmlspecialchars($row['population']) . "</td>";
        } else {
            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['continent']) . "</td>";
            echo "<td>" . htmlspecialchars($row['independence_year']) . "</td>";
            echo "<td>" . htmlspecialchars($row['head_of_state']) . "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p>No results found.</p>";
}
$conn->close();
?>