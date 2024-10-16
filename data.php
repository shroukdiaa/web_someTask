<?php

require_once("conn.php");

$query = "SELECT * FROM country ;";
$stmt = $pdo->query($query);


// Fetch all rows as an associative array
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>country</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
<div>
    <h2 style="text-align:center;">country</h2>
</div>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Continent</th>
                <th>Region</th>
                <th>SurfaceArea</th>
                <th>Link</th>
            </tr>
        </thead>
        <tbody>
            <!-- Generate 20 rows -->
            <?php
            foreach ($rows as $index => $row) { ?>
                <tr>
                    <td><?php echo $index + 1; ?></td>
                    <td><?php echo htmlspecialchars($row["Name"]); ?></td>
                    <td><?php echo htmlspecialchars($row["Continent"]); ?></td>
                    <td><?php echo htmlspecialchars($row["Region"]); ?></td>
                    <td><?php echo htmlspecialchars($row["SurfaceArea"]); ?></td>
                    <td><a href="cities.php?q=<?php echo htmlspecialchars($row["Code"]); ?>"> View Cities </a></td>

                </tr>
            <?php } ?>
        </tbody>
    </table>

</body>
</html>
