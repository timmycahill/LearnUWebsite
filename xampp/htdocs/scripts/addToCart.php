<?php
    session_start();
    foreach ($_SESSION['shoppingCart'] as $x => $val) {
        if ($_GET['courseId'] == $val) {
            header("Location: ".$_SERVER['HTTP_REFERER']);
            exit();
        }
    }
    array_push($_SESSION['shoppingCart'], $_GET['courseId']);
    
    require 'dbh.php';

    $shoppingCart = implode(',', $_SESSION['shoppingCart']);
    $sql = $sql = "UPDATE users SET shoppingCart=? WHERE username=?;";
    $statement = mysqli_stmt_init($connection);
    if (!mysqli_stmt_prepare($statement, $sql)) {
        header("Location: ../index.php?error=sqlerror");
        exit();
    }
    else {
        mysqli_stmt_bind_param($statement, "ss", $shoppingCart, $_SESSION['username']);
        mysqli_stmt_execute($statement);
        mysqli_stmt_close($statement);
        mysqli_close($connection);
    }

    header("Location: ".$_SERVER['HTTP_REFERER']);
?>