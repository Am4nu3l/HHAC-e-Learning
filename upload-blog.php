<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $description = $_POST["body"];
    $db_host = "localhost";
    $db_name = "binipro";
    $db_user = "root";
    $db_password = "";
    $uploadedURL = $_POST["uploadedURL"];

    // Create a connection
    $conn = new mysqli($db_host, $db_user, $db_password, $db_name);
    // Sanitize and escape input values
    $title = mysqli_real_escape_string($conn, $title);
    $description = mysqli_real_escape_string($conn, $description);
    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        $currentDate = date("Y-m-d");
        // Use prepared statement
        $query = "INSERT INTO blog (title, body, postedBy, postedOn, imageLink) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        // Bind parameters without passing by reference
        $stmt->bind_param("sssss", $title, $description, $postedBy, $currentDate, $imageLink);

        // Set parameter values
        $postedBy = 'Biniyam Nega';
        $imageLink = $uploadedURL;

        if ($stmt->execute()) {
            header("Location: blog.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
        $conn->close();
    }
}
?>