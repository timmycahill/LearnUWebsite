<?php
	session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Learn U | Checkout</title>
		<link href="stylesheets/style.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css">
		<link href="stylesheets/shoppingCart.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css">
	</head>

<?php
	include 'header.php';
?>

<h1>Checkout</h1>
<br>

<?php
    require 'scripts/dbh.php';

    echo '<div class="item"><p class="left">Thank you for your purchase! You are now able to enjoy the following courses:</p><div class="right">'; 
    foreach ($_SESSION['shoppingCart'] as $x => $val) {
        array_push($_SESSION['purchasedCourses'], $_SESSION['shoppingCart'][$x]);
        
        $sql = "SELECT courseName FROM courses WHERE courseId=?;";
        $statement = mysqli_stmt_init($connection);
        if (!mysqli_stmt_prepare($statement, $sql)) {
            header("Location: ../index.php?error=sqlerror1");
            exit();
        }
        else {
            mysqli_stmt_bind_param($statement, "i", $_SESSION['shoppingCart'][$x]);
            mysqli_stmt_execute($statement);
            $result = mysqli_stmt_get_result($statement);
            if ($row = mysqli_fetch_assoc($result)) {
                echo '<b>'.$row['courseName'].'</b><br>';
            }
            mysqli_stmt_close($statement);
        }
    }
    echo '</div></div><br><p>Enjoy your purchase and remember to Learn U!</p>';

    $purchasedCourses = implode(',', $_SESSION['purchasedCourses']);
    $sql = "UPDATE users SET purchasedCourses=? WHERE username=?;";
    $statement = mysqli_stmt_init($connection);
    if (!mysqli_stmt_prepare($statement, $sql)) {
        header("Location: ../index.php?error=sqlerror2");
        exit();
    }
    else {
        mysqli_stmt_bind_param($statement, "ss", $purchasedCourses, $_SESSION['username']);
        mysqli_stmt_execute($statement);
        mysqli_stmt_close($statement);
    }

    $_SESSION['shoppingCart'] = array();

    $sql = "UPDATE users SET shoppingCart=? WHERE username=?;";
    $statement = mysqli_stmt_init($connection);
    if (!mysqli_stmt_prepare($statement, $sql)) {
        header("Location: ../index.php?error=sqlerror3");
        exit();
    }
    else {
        mysqli_stmt_bind_param($statement, "ss", $shoppingCart, $_SESSION['username']);
        mysqli_stmt_execute($statement);
        mysqli_stmt_close($statement);
        mysqli_close($connection);
    }
?>

<?php
	include 'footer.php';
?>