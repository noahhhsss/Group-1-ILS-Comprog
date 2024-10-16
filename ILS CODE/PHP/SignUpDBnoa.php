<?php
// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "matsurikadbtest");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get form data
        $fullName = $_POST['fullName'] ?? "";
        $email = $_POST['email'] ?? "";
        $phoneNumber = $_POST['phoneNumber'] ?? "";
        $password = $_POST['password'] ?? "";

        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO signup (fullName, email, phoneNumber, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssis", $fullName, $email, $phoneNumber, $password);

        if ($stmt->execute()) {
            // Redirect to another page after successful insertion
            header("Location: ../HTML/LogInPage.html");
            exit;
        } else {
            // Show error message
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }

    // Close the database connection
    $conn->close();
?>