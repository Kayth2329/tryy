<?php
$servername = "localhost";
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$dbname = "airtravel";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$destination = $_POST['destination'];
$flightTime = $_POST['flightTime'];
$address = $_POST['address'];
$flightDate = $_POST['flightDate'];

// Check if there are already 5 passengers for the selected flight
$sql = "SELECT COUNT(*) AS passenger_count FROM bookings WHERE destination='$destination' AND flight_time='$flightTime' AND flight_date='$flightDate'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
if ($row['passenger_count'] >= 5) {
    echo "Sorry, this flight is already full. Please choose another time.";
} else {
    // Insert booking data into the database
    $sql = "INSERT INTO bookings (name, phone, email, destination, flight_time, address, flight_date) 
            VALUES ('$name', '$phone', '$email', '$destination', '$flightTime', '$address', '$flightDate')";

    if ($conn->query($sql) === TRUE) {
        echo "Booking successfully submitted!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>
