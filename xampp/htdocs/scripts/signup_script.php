<?php

if (isset($_POST['signup-submit'])) {

    require 'dbh.php';

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    if (empty($username) || empty($email) || empty($password) || empty($password2)) {
        header("Location: ../signup.php?error=emptyfields&username=" . $username . "&email=" . $email);
        exit();
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../signup.php?error=invalidemailusername");
        exit();
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../signup.php?error=invalidemail&username=" . $username);
        exit();
    }
    else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../signup.php?error=invalidusername&email=" . $email);
        exit();
    }
    else if ($password !== $password2) {
        header("Location: ../signup.php?error=passwordcheck&username=" . $username . "&email=" . $email);
        exit();
    }
    else {
        $sql = "SELECT username FROM users WHERE username=?";
        $statement = mysqli_stmt_init($connection);
        if (!mysqli_stmt_prepare($statement, $sql)) {
            header("Location: ../signup.php?error=sqlerror");
            exit();
        }
        else {
            mysqli_stmt_bind_param($statement, "s", $username);
            mysqli_stmt_execute($statement);
            mysqli_stmt_store_result($statement);
            $resultCheck = mysqli_stmt_num_rows($statement);
            if ($resultCheck > 0) {
                header("Location: ../signup.php?error=usernametaken&email=" . $email);
                exit();
            }
            else {
                $sql = "INSERT INTO users (username, email, password, purchasedCourses) VALUES (?, ?, ?, ?)";
                $statement = mysqli_stmt_init($connection);
                if (!mysqli_stmt_prepare($statement, $sql)) {
                    header("Location: ../signup.php?error=sqlerror");
                    exit();
                }
                else {
                    $purchasedCourses = "";
                    mysqli_stmt_bind_param($statement, "ssss", $username, $email, $password, $purchasedCourses);
                    mysqli_stmt_execute($statement);
                    header("Location: ../signup.php?signup=success");
                    exit();
                }
            }
        }
    }
    mysqli_stmt_close($statement);
    mysqli_close($connection);
}
else {
    header("Location: ../signup.php");
    exit();
}

?>