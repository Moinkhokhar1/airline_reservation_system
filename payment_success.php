<?php include 'header.php'; 
include 'db.php'
?>

<!DOCTYPE html>
<html>
<head>
    <title>Payment Success</title>
    <style>
        .container {
            max-width: 600px;
            margin: 100px auto;
            padding: 30px;
            text-align: center;
            border-radius: 10px;
            background-color: #e6ffe6;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .success {
            color: green;
            font-size: 24px;
            margin-bottom: 20px;
        }
        .details {
            font-size: 18px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="success">✅ Payment Successful!</div>
    <div class="details">
        <?php
        if (isset($_POST['seat']) && isset($_POST['amount'])) {
            $seats = htmlspecialchars($_POST['seat']); // comma-separated
            $amount = htmlspecialchars($_POST['amount']);
        
            $seatList = explode(',', $seats);
            $seatDisplay = implode(', ', $seatList);
        
            echo "<p>Your seats <strong>$seatDisplay</strong> have been booked.</p>";
            echo "<p>Amount Paid: ₹<strong>$amount</strong></p>";

            // Insert data into `payments` table
            $stmt = $conn->prepare("INSERT INTO payments (seats, amount, created_at) VALUES (?, ?, NOW())");
            $stmt->bind_param("sd", $seats, $amount); // s = string, d = double
        
            if ($stmt->execute()) {
                // echo "Payment details inserted successfully.";
            } else {
                echo "<p style='color:red;'>Error inserting payment details: " . $stmt->error . "</p>";
            }
        
            $stmt->close();
            $conn->close();
        
        } else {
            echo "<p>Invalid access.</p>";
        }
        ?>
    </div>
    <div class="timer">
        Redirecting to your dashboard in <span id="countdown">10</span> seconds...
    </div>
</div>

<script>
    let seconds = 10;
    const countdown = document.getElementById('countdown');

    const interval = setInterval(() => {
        seconds--;
        countdown.textContent = seconds;
        if (seconds <= 0) {
            clearInterval(interval);
            window.location.href = 'index.html';
        }
    }, 1000);
</script>

</body>
</html>
