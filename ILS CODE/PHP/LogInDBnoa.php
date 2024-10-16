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

    if (isset($_POST["submitLogIn"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];

        $sql = "SELECT * FROM signup WHERE email = '$email' and password = '$password'";
        $result = $conn -> query($sql);
        if ($result -> num_rows > 0) {
            session_start();
            $row = $result -> fetch_assoc();
            $_SESSION["email"] = $row["email"];
            header("Location: ../HTML/RamenMatsurikaReservation.html");
            exit();
        }else {
            header("Location: ../HTML/LogInPage.html");
        }
    }
?>