<?php

require_once("conn.php");

if (!isset($_GET["q"])) {
    header("location:data.php");
    exit;
}

$q = $_GET["q"];

// Query to fetch the country name using a prepared statement
$query_country = "SELECT Name FROM country WHERE Code = :code";
$stmt_country = $pdo->prepare($query_country);
$stmt_country->execute(['code' => $q]);
$countryName = $stmt_country->fetch(PDO::FETCH_ASSOC);

if(!$countryName) {
    header("location:data.php");
    exit;
}

// Query to fetch cities of the given country using a prepared statement
$query_cities = "SELECT * FROM city WHERE CountryCode = :code";
$stmt_cities = $pdo->prepare($query_cities);
$stmt_cities->execute(['code' => $q]);

// Fetch all rows as an associative array
$rows_cities = $stmt_cities->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cities</title>
    <style>
        /* Global Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        
        /* Container for title and back link */
        .home {
            padding: 20px;
            text-align: center;
            color: white;
        }

        .home h2 {
            margin: 10px;
            padding: 10px;
            color: black;
        }

        .home a {
            text-decoration: none;
            color: brown;
            font-weight: bold;
            padding: 10px 20px;
            margin: 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .home a:hover {
            margin: 10px;
            padding: 10px;
        }

        /* Table Styles */
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 12px;
            text-align: center;
            background-color: white;
        }

        th {
            background-color: gray ;
            color: white;
        }

        /* tbody tr:nth-child(odd) {
            background-color: gray;
        }

        tbody tr:hover {
            background-color: #ddd;
        } */

        /* Error message styles */
        .error {
            text-align: center;
            margin-top: 20px;
            font-size: 18px;
            color: #ff6347;
            font-weight: bold;
        }

        /* Utility Classes */
        .table_border {
            border: 1px solid black;
        }

        .head_table {
            background-color: rgb(100, 30, blue);
            color: white;
        }

        /* .body_table tr:nth-child(odd) {
            background-color: gray;
        }

        .body_table tr:hover {
            background-color: gray;
        } */
    </style>
</head>
<body>
    <div class="home"> 
        <h2>Cities in <?php echo htmlspecialchars($countryName["Name"]); ?></h2>
        <a href="data.php">Return Back</a>
        <hr>
    </div>

    <?php if (count($rows_cities) > 0): ?>
        <table class="table_border">
            <thead class="head_table">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Population</th>
                </tr>
            </thead>
            <tbody class="body_table">
                <?php foreach ($rows_cities as $index => $row) { ?>
                    <tr>
                        <td><?php echo $index + 1; ?></td>
                        <td><?php echo htmlspecialchars($row["Name"]); ?></td>
                        <td><?php echo htmlspecialchars($row["Population"]); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="error">
            <p>There are no cities in this country.</p>
        </div>
    <?php endif; ?>

</body>
</html>
