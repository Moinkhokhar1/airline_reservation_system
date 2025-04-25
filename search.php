<?php
include 'db.php';
include 'header.php';

$from_location = "";
$to_location = "";
$flight_date = "";

if (isset($_GET['from_location']) || isset($_GET['to_location'])) {
    $from_location = $conn->real_escape_string($_GET['from_location']);
    $to_location = $conn->real_escape_string($_GET['to_location']);
    $flight_date = $conn->real_escape_string($_GET['flight_date']);

    $conditions = [];

    if (!empty($from_location)) {
        $conditions[] = "from_location LIKE '%$from_location%'";
    }

    if (!empty($to_location)) {
        $conditions[] = "to_location LIKE '%$to_location%'";
    }

    if (!empty($flight_date)) {
        $conditions[] = "flight_date LIKE '%$flight_date%'";
    }

    $sql = "SELECT * FROM flights";

    if (count($conditions) > 0) {
        $sql .= " WHERE " . implode(" AND ", $conditions);
    }
} else {
    $sql = "SELECT * FROM flights";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Flight Search</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #e0f7fa, #ffffff);
            margin: 0;
            padding: 0;
        }
        h2 {
            text-align: center;
            margin-top: 30px;
            color: #00796b;
        }
        form {
            text-align: center;
            margin: 30px auto;
            padding: 20px;
            max-width: 600px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        input[type="text"], input[type="date"] {
            padding: 10px;
            margin: 10px;
            width: 40%;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        button[type="submit"] {
            padding: 10px 20px;
            background-color: #00796b;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: 0.3s;
        }
        button[type="submit"]:hover {
            background-color: #004d40;
        }
        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            border-radius: 10px;
            overflow: hidden;
        }
        th, td {
            padding: 12px;
            border-bottom: 1px solid #e0e0e0;
            text-align: center;
        }
        th {
            background-color: #00796b;
            color: white;
        }
        button[type="button"] {
            padding: 6px 14px;
            background-color: #0288d1;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
        button[type="button"]:hover {
            background-color: #01579b;
        }
        tr:last-child td {
            border-bottom: none;
        }
    </style>
</head>
<body>

<h2>Search Flights</h2>

<form method="get" action="">
    <input type="text" name="from_location" placeholder="From Location">
    <input type="text" name="to_location" placeholder="To Location">
    <input type="date" name="flight_date" placeholder="Flight Date">
    <button type="submit">Search Flights</button>
</form>

<table>
    <tr>
        <th>ID</th>
        <th>From</th>
        <th>To</th>
        <th>Date</th>
        <th>Action</th>
    </tr>
    <tbody>
        <?php 
        if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
        ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['from_location'] ?></td>
                <td><?= $row['to_location'] ?></td>
                <td><?= $row['flight_date'] ?></td>
                <td>
                    <button type="button" onclick="Bookflight(<?= $row['id'] ?>)">Book</button>
                </td>
            </tr>
        <?php 
            } 
        } else {
            echo "<tr><td colspan='5'>No records found</td></tr>";
        }
        ?>
    </tbody>
</table>

<script>
    function Bookflight(id) {
        window.location.href = "book.php?id=" + id;
    }
</script>
</body>
</html>
