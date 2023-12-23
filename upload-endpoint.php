<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $description = $_POST["description"];
    $uploadedURL = $_POST["uploadedURL"];
    // Check for required parameters
    if (empty($title) || empty($description) || empty($uploadedURL)) {
        echo "Error: Missing required parameters." . $uploadedURL;
        exit();
    }
    $db_host = "bvbmnjawn8p5szgiq78e-mysql.services.clever-cloud.com";
    $db_name = "bvbmnjawn8p5szgiq78e";
    $db_user = "us2zhojyh8zuitju";
    $db_password = "6yx4YEmGCLgN7ldfiTic@";

    // Create a connection
    $conn = new mysqli($db_host, $db_user, $db_password, $db_name);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        $currentDate = date("Y-m-d");

        // Use prepared statements to prevent SQL injection
        $query = "INSERT INTO material (title, description, postedBy, postedOn, imageLink) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);

        // Bind parameters
        $postedBy = "Elias Alemayehu"; // Assuming this is a fixed value
        $stmt->bind_param("sssss", $title, $description, $postedBy, $currentDate, $uploadedURL);

        if ($stmt->execute()) {
            header("Location: material.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }
} else {
    echo "Error: No POST data received.";
}
?>
