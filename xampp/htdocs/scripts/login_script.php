<?php

if (isset($_POST['login-submit'])) {
    require 'dbh.php';

    $emailuser = $_POST['emailuser'];
    $password = $_POST['password'];

    if (empty($emailuser) || empty($password)) {
        header("Location: ".$_SERVER['HTTP_REFERER']);
        exit();
    }
    else {
        $sql = "SELECT * FROM users WHERE username=? OR email=?";
        $statement = mysqli_stmt_init($connection);
        if (!mysqli_stmt_prepare($statement, $sql)) {
            header("Location: ".$_SERVER['HTTP_REFERER']);
            exit();
        }
        else {
            mysqli_stmt_bind_param($statement, "ss", $emailuser, $emailuser);
            mysqli_stmt_execute($statement);
            $result = mysqli_stmt_get_result($statement);
            if ($row = mysqli_fetch_assoc($result)) {
                if ($password !== $row['password']) {
                    header("Location: ".$_SERVER['HTTP_REFERER']);
                    exit();
                }
                else {
                    session_start();
                    $_SESSION['userid'] = $row['userid'];
                    $_SESSION['username'] = $row['username'];
                    if ($row['shoppingCart'] == "") {
                        $_SESSION['shoppingCart'] = array();
                    }
                    else {
                        $_SESSION['shoppingCart'] = explode(',', $row['shoppingCart']);
                    }
                    if ($row['purchasedCourses'] == "") {
                        $_SESSION['purchasedCourses'] = array();
                    }
                    $_SESSION['purchasedCourses'] = explode(',', $row['purchasedCourses']);

                    header("Location: ".$_SERVER['HTTP_REFERER']);
                    exit();
                }
            }
            else {
                header("Location: ".$_SERVER['HTTP_REFERER']);;
                exit();
            }
        }
    }

}
else {
    header("Location: ".$_SERVER['HTTP_REFERER']);
    exit();
}

?>