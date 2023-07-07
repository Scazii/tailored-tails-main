<?php
session_start();

// Establish the database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tailoredtailsusers";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process the login form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $loginUsername = $_POST["login_username"];
    $loginPassword = $_POST["login_password"];
    $rememberMe = isset($_POST["remember_me"]);

    // Retrieve the user details from the database based on the provided username
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $loginUsername);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $storedPassword = $row["password"];

        // Verify the entered password with the stored password
        if (password_verify($loginPassword, $storedPassword)) {
            // Login successful

            // Assign user_id to session variable
            $_SESSION['user_id'] = $row['user_id'];

            // Set session or cookie based on "Remember Me" option
            if ($rememberMe) {
                // Set a cookie with username and hashed password
                setcookie("username", $loginUsername, time() + (86400 * 30), "/"); // 30 days
                setcookie("password", $storedPassword, time() + (86400 * 30), "/"); // 30 days
            }
            // Redirect to homepage.html
            header("Location: http://localhost/tailored-tails-main/UI/homepage.html");
            exit();
        } else {
            // Incorrect password, redirect back to the login page
            header("Location: http://localhost/tailored-tails-main/Login-Logout/loginpage.html");
            echo "Incorrect password";
            exit();
        }
    } else {
        // Username not found, redirect back to the login page
        header("Location: http://localhost/tailored-tails-main/Login-Logout/loginpage.html");
        echo "Incorrect username";
        exit();
    }
}

// Close the database connection
$conn->close();
?>
