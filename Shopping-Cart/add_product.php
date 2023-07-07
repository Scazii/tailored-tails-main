<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tailoredtailsusers";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"];
    $description = $_POST["description"];
    $price = $_POST["price"];
    
    // Handle image upload
    $image = $_FILES['image_file'];
    $image_name = $image['name'];
    $image_tmp = $image['tmp_name'];
    $image_type = $image['type'];
    $image_size = $image['size'];

    // Check if the uploaded file is an image
    $allowed_extensions = array('jpg', 'jpeg', 'png');
    $file_extension = pathinfo($image_name, PATHINFO_EXTENSION);
    if (!in_array($file_extension, $allowed_extensions)) {
        echo "Only JPG, JPEG, and PNG images are allowed.";
        exit();
    }

    // Specify the destination directory to store the uploaded image
    $upload_directory = "images/";
    $image_path = $upload_directory . $image_name;

    // Move the uploaded image to the destination directory
    if (!move_uploaded_file($image_tmp, $image_path)) {
        echo "Error uploading image.";
        exit();
    }

    // Prepare the statement
    $stmt = $conn->prepare("INSERT INTO products (name, description, price, image_url) VALUES (?, ?, ?, ?)");

    // Bind the parameters
    $stmt->bind_param("ssds", $name, $description, $price, $image_path);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to add_product.php
        header("Location: add_product.php");
        exit(); // Make sure to exit after redirect
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

$conn->close();
?>
