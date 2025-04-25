<?php
// session_start();
include 'header.php';
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $flight_id = $id;
    $from_location = $_POST['from_location'];
    $to_location = $_POST['to_location'];
    $flight_date = $_POST['flight_date'];
    $aadhar = $_POST['aadhar'];

    // Print them (for testing purposes)
    echo "<h3 style='text-align:center;'>Flight Info</h3>";
    echo "<p style='text-align:center;'>From: $from_location</p>";
    echo "<p style='text-align:center;'>To: $to_location</p>";
    echo "<p style='text-align:center;'>Date: $flight_date</p>";
    echo "<p style='text-align:center;'>Aadhar: $aadhar</p>";
} else {
    echo "Invalid access.";
    exit();
}

$rows = 10;  // Number of rows in the flight
$cols = 5;  // Number of columns in the flight

// Fetch all seats for the flight
$query = "SELECT seat_code, status, row, col FROM seats WHERE flight_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $flight_id);
$stmt->execute();
$result = $stmt->get_result();

$seats = [];
while ($row = $result->fetch_assoc()) {
    $seats[] = $row;
}

$conn->close();
?>


<!DOCTYPE html>
<html>
<head>
    <title>Select Your Seat</title>
    <style>
        .seat {
            width: 40px;
            height: 40px;
            /*  */
            border: 1px solid #999;
            border-radius: 5px;
            margin: 5px;
            text-align: center;
            line-height: 40px;
            cursor: pointer;
            user-select: none;
            transition: 0.3s;
        }

        .seat.selected {
            background-color: green;
            color: white;
        }

        .seat.occupied {
            background-color : #ccc;
            cursor: not-allowed;
        }

        .seat-row {
            display: flex;
            justify-content: center;
        }

        .screen {
            width: 80%;
            margin: 20px auto;
            padding: 10px;
            background: #eee;
            text-align: center;
            border-radius: 5px;
            font-weight: bold;
        }

        .seat-map {
            width: 60%;
            margin: auto;
        }

        .btn {
            margin-top: 20px;
            display: block;
            text-align: center;
        }

        button {
            padding: 10px 20px;
            font-size: 16px;
            background: #28a745;
            border: none;
            color: white;
            cursor: pointer;
            margin: 0 auto ;
        }

        .seat-row {
            display: flex;
            justify-content: center;
            margin-bottom: 10px;
        }
        .custom-button {
            background: linear-gradient(to right, #00c6ff, #0072ff);
            border: none;
            border-radius: 50px;
            padding: 12px 30px;
            font-size: 18px;
            font-weight: bold;
            color: white;
            box-shadow: 0 4px 15px rgba(0, 114, 255, 0.4);
            transition: all 0.3s ease;
        }

        .custom-button:hover {
            background: linear-gradient(to right, #0072ff, #00c6ff);
            transform: scale(1.05);
            box-shadow: 0 6px 20px rgba(0, 114, 255, 0.6);
        }
        </style>
</head>
<body>
    <br>
<h2 style="text-align:center;">Select Your Seat</h2><br>    
<div class="seat-map">

<?php
// Generate seat matrix from the database data
for ($r = 1; $r <= $rows; $r++) {
    echo "<div class='seat-row'>";
    $seat_in_row = 0;

    foreach ($seats as $seat) {
        if ($seat['row'] == $r) {
            $seat_in_row++;
            $seat_code = $seat['seat_code'];
            $status = $seat['status'];
            $class = $status === 'booked' ? 'occupied' : 'available';

            echo "<div class='seat $class' data-seat='$seat_code'>$seat_code</div>";

            // Add a single gap after 2 seats only once
            if ($seat_in_row == 2) {
                echo "<div style='width: 40px;'></div>"; // Aisle gap
            }
        }
    }
    echo "</div>";
}
?>

</div>

<div class="btn">
    <p id="totalDisplay" style="font-size: 18px;">Total: ₹0</p>
    <form method="post" action="confirm_booking.php">
    <input type="hidden" name="selected_seats" id="selected_seats">
    <input type="hidden" name="total_amount" id="total_amount">

    <!-- ADD THESE: -->
    <input type="hidden" name="flight_id" value="<?= htmlspecialchars($flight_id) ?>">
    <input type="hidden" name="from_location" value="<?= htmlspecialchars($from_location) ?>">
    <input type="hidden" name="to_location" value="<?= htmlspecialchars($to_location) ?>">
    <input type="hidden" name="flight_date" value="<?= htmlspecialchars($flight_date) ?>">
    <input type="hidden" name="aadhar" value="<?= htmlspecialchars($aadhar) ?>">

    <button type="submit" class="btn btn-primary custom-button mt-3">Confirm Selection</button>
</form>

</div>

<script>
    const seats = document.querySelectorAll('.seat');
    const seatInput = document.getElementById('selected_seats');
    const totalAmountInput = document.getElementById('total_amount');
    const totalDisplay = document.getElementById('totalDisplay');
    const pricePerSeat = 2500;  // You can adjust the price
    let selectedSeats = [];

    function updateTotal() {
        seatInput.value = selectedSeats.join(',');
        const total = selectedSeats.length * pricePerSeat;
        totalAmountInput.value = total;
        totalDisplay.textContent = `Total: ₹${total}`;
    }

    seats.forEach(seat => {
        seat.addEventListener('click', function () {
            if (seat.classList.contains('occupied')) return;  // Prevent selecting already booked seats

            const seatId = seat.getAttribute('data-seat');

            if (seat.classList.contains('selected')) {
                seat.classList.remove('selected');
                selectedSeats = selectedSeats.filter(s => s !== seatId);
            } else {
                seat.classList.add('selected');
                selectedSeats.push(seatId);
            }

            updateTotal();
        });
    });
</script>

</body>
</html>
    