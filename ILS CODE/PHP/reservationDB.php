<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "matsurikadbtest";

    //DATABASE CONNECTION
    $conn = new mysqli($host, $user, $pass, $db);
    if ($conn->connect_error) {
        echo"Error! Failed to connect to database :(". $conn->connect_error;
    }

    if (isset($_POST["submitdb"])) {
        $firstName = $_POST["firstName"];
        $lastName = $_POST["lastName"];
        $email = $_POST["email"];
        $phoneNumber = $_POST["phoneNumber"];
        $numGuest = $_POST["numGuest"];
        $dateTime = $_POST["dateTime"];
        $reservation = $_POST["dining"];

        $checkEmail = "SELECT * From signup where email = '$email'";
        $result = $conn -> query($checkEmail);
        $errorMessage = "";
        $showPop = true;
        if ($result -> num_rows > 0) {
            $insertQuery = "INSERT INTO reservationdb(firstName, lastName, email, phoneNumber, numGuest, dateTime, reservation)
                            VALUES ('$firstName', '$lastName', '$email', '$phoneNumber', '$numGuest', '$dateTime', '$reservation')";
                if ($conn -> query($insertQuery) == TRUE) {
                    header("location: ../HTML/RamenMatsurikaFrontPage.html");
                }else {
                    echo "Error: did not find location". $conn -> error;
                }
        }else {
            header("Location: ../HTML/RamenMatsurikaReservation.html");
            exit;
        }
    }
?>