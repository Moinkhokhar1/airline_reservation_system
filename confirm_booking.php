<?php 
// session_start();
include 'db.php';
include 'header.php'; 

?>
<!DOCTYPE html>
<html>
<head>
    <title>Confirm Booking</title>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <style>
        .container {
            max-width: 600px;
            margin: 100px auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            background-color: #fff;
            text-align: center;
        }
        .btn {
            background-color: #007bff;
            color: white;
            padding: 10px 25px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 20px;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .info {
            font-size: 18px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Confirm Your Booking</h2>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['selected_seats'])) {
              
        $flight_id = $_POST['flight_id'] ?? '';
        $fromLocation = $_POST['from_location'] ?? '';
        $toLocation = $_POST['to_location'] ?? '';
        $flightDate = $_POST['flight_date'] ?? '';
        $aadhar = $_POST['aadhar'] ?? '';

        $selectedSeats = htmlspecialchars($_POST['selected_seats']);
        $seatArray = explode(",", $selectedSeats);
        $seatCount = count($seatArray);

        // Simulating booking details
        $fromLocation = $_POST['from_location'];
        $toLocation = $_POST['to_location'];
        $flightDate = $_POST['flight_date'];
        
        $pricePerSeat = 2500; // INR
        $totalPrice = isset($_POST['total_amount']) ? (int) $_POST['total_amount'] : ($pricePerSeat * $seatCount);
        $amountInPaise = $totalPrice * 100;

        echo "<div class='info'><strong>From:</strong> $fromLocation</div>";
        echo "<div class='info'><strong>To:</strong> $toLocation</div>";
        echo "<div class='info'><strong>Flight Date:</strong> $flightDate</div>";
        echo "<div class='info'><strong>Seats Selected:</strong> " . implode(", ", $seatArray) . "</div>";
        echo "<div class='info'><strong>Total Amount:</strong> ₹$totalPrice</div>";
    ?>

    <button id="rzp-button" class="btn">Pay ₹<?= $totalPrice ?> with Razorpay</button>

    <form name="razorpay-form" id="razorpay-form" action="payment_success.php" method="POST">
        <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
        <input type="hidden" name="seat" value="<?= htmlspecialchars($selectedSeats) ?>">
        <input type="hidden" name="amount" value="<?= $totalPrice ?>">
        <input type="hidden" name="flight_date" value="<?= htmlspecialchars($flightDate) ?>">
    </form>

    <script>
    const options = {
    "key": "rzp_test_BVg6uXtRBSwMvF", // Your Razorpay Key
    "amount": "<?= $amountInPaise ?>",
    "currency": "INR",
    "name": "Flight Booking",
    "description": "Seats <?= htmlspecialchars($selectedSeats) ?> from <?= $fromLocation ?> to <?= $toLocation ?>",
    "handler": function (response){
        document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
        document.forms["razorpay-form"].submit(); // Auto-submit form after success
    },
    "prefill": {
        "name": "Test User",
        "email": "testuser@example.com",
        "contact": "9999999999"
    },
    "theme": {
        "color": "#007bff"
    }
};

const rzp = new Razorpay(options);
document.getElementById('rzp-button').onclick = function(e){
    rzp.open();
    e.preventDefault();
}

    </script>

    <?php } else {
        echo "<p>No seats selected. Please go back and choose seats.</p>";
    } ?>
</div>

</body>
</html>
