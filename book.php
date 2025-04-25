<?php
session_start();
include "db.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $q = "SELECT * FROM flights WHERE id = $id";
    $data = mysqli_query($conn, $q);
    $num = mysqli_fetch_array($data);
} else {
    echo "ID not found in URL!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Flight Booking</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet"/>
  <style>
  * {
    box-sizing: border-box;
  }

  body {
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
    background: url('https://images.unsplash.com/photo-1504199367641-aba8151af7c4?ixlib=rb-4.0.3&auto=format&fit=crop&w=1470&q=80') no-repeat center center/cover;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    backdrop-filter: blur(5px);
  }

  .glass-form {
    background: rgba(255, 255, 255, 0.25);
    border-radius: 20px;
    padding: 30px 40px;
    box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.18);
    width: 350px;
    color: #222;
  }

  .glass-form h2 {
    text-align: center;
    margin-bottom: 25px;
    font-weight: 600;
    color: #111;
  }

  label {
    font-weight: 500;
    margin-bottom: 5px;
    display: block;
    color: #111;
  }

  input {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: none;
    border-radius: 10px;
    outline: none;
    background: rgba(255, 255, 255, 0.8);
    color: #222;
    font-weight: 500;
  }

  input:read-only {
    background: rgba(230, 230, 230, 0.7);
    color: #333;
  }

  input::placeholder {
    color: #555;
  }

  button {
    width: 100%;
    padding: 12px;
    border: none;
    background: #00c6ff;
    color: white;
    font-weight: 600;
    border-radius: 10px;
    cursor: pointer;
    transition: 0.3s ease;
  }

  button:hover {
    background: #0072ff;
  }
</style>

</head>
<body>

  <div class="glass-form">
    <h2>Book Your Flight</h2>
    <form action="select_seats.php" method="POST" onsubmit="return aadharcheck()">
      <input type="hidden" name="id" value="<?php echo $id; ?>">

      <label for="from_location">From</label>
      <input type="text" id="from_location" name="from_location" value="<?php echo $num['from_location']; ?>" readonly>

      <label for="to_location">To</label>
      <input type="text" id="to_location" name="to_location" value="<?php echo $num['to_location']; ?>" readonly>

      <label for="flight_date">Date</label>
      <input type="date" id="flight_date" name="flight_date" value="<?php echo $num['flight_date']; ?>" readonly>

      <label for="aadhar">Aadhar Number</label>
      <input type="text" id="aadhar" name="aadhar" placeholder="Enter 12-digit Aadhar" required>

      <button type="submit">Select Seats</button>
    </form>
  </div>

  <script>
    function aadharcheck() {
      const aadharinput = document.getElementById("aadhar");
      const aadhar = aadharinput.value.trim();
      const aadharpattern = /^[2-9][0-9]{11}$/;
      if (aadharpattern.test(aadhar)) {
        return true;
      } else {
        alert("Invalid Aadhar number. Please enter a valid 12-digit Aadhar.");
        aadharinput.value = '';
        return false;
      }
    }
  </script>
</body>
</html>
