<?php

include 'db.php';
include "header.php" ;

$sql = "SELECT * FROM payments ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Booked seatss</title>
    <style>
        table {
            width: 95%;
            margin: 30px auto;
            border-collapse: collapse;
        }
        th, td {
            padding: 12px;
            border: 1px solid #444;
            text-align: center;
        }
        h2 {
            text-align: center;
            margin-top: 30px;
        }
    </style>
</head>
<body>

<h2>All Booked seatss</h2>

<table>
    <tr>
        <th>ID</th>
        <th>seats</th>>
        <th>Amount (₹)</th>
        <th>Booked At</th>
    </tr>

    <?php
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['id']}</td>";
            echo "<td>{$row['seats']}</td>";
            echo "<td>{$row['amount']}</td>";
            echo "<td>{$row['created_at']}</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='7'>No bookings found.</td></tr>";
    }
    ?>

</table>

</body>
</html>
