<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tailoredtailsusers";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $address = $_POST["address"];
        $contactNumber = $_POST["contact_number"];
        $fullName = $_POST["full_name"];
        $paymentMethod = $_POST["payment_method"];

        // Validate form inputs (you can add more validation as needed)
        if (empty($address) || empty($contactNumber) || empty($fullName) || empty($paymentMethod)) {
            echo "Please fill in all the required fields.";
        } else {
            // Process the payment based on the selected payment method
            if ($paymentMethod === "cash_on_delivery") {
                // Cash on delivery
                echo "Thank you for your purchase! Your order will be delivered to the provided address.";
            } elseif ($paymentMethod === "gcash") {
                // GCash payment
                $amountPaid = $_POST["amount_paid"];
                
                // Validate the amount paid
                if (empty($amountPaid) || !is_numeric($amountPaid) || $amountPaid <= 0) {
                    echo "Invalid amount paid. Please enter a valid amount.";
                } else {
                    echo "Thank you for your purchase! Please proceed with the GCash payment of PHP " . $amountPaid . " to complete your order.";
                }
            } else {
                echo "Invalid payment method selected.";
            }
        }
    }

    // Display the checkout form
    echo "<h2>Checkout</h2>";
    echo "<form method='POST' action='" . $_SERVER['PHP_SELF'] . "'>";
    echo "<label for='address'>Address:</label>";
    echo "<input type='text' name='address' id='address' required><br>";

    echo "<label for='contact_number'>Contact Number:</label>";
    echo "<input type='text' name='contact_number' id='contact_number' required><br>";

    echo "<label for='full_name'>Full Name:</label>";
    echo "<input type='text' name='full_name' id='full_name' required><br>";

    echo "<label for='payment_method'>Payment Method:</label>";
    echo "<select name='payment_method' id='payment_method' required>";
    echo "<option value='' selected disabled>Select Payment Method</option>";
    echo "<option value='cash_on_delivery'>Cash on Delivery</option>";
    echo "<option value='gcash'>GCash</option>";
    echo "</select><br>";

    echo "<div id='gcash_amount' style='display:none;'>";
    echo "<label for='amount_paid'>Amount Paid:</label>";
    echo "<input type='number' name='amount_paid' id='amount_paid' step='0.01' min='0'><br>";
    echo "</div>";

    echo "<input type='submit' value='Place Order'>";
    echo "</form>";
} else {
    echo "Please log in to proceed with the checkout.";
}

$conn->close();
?>