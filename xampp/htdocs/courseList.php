<?php
	session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Learn U | Course List</title>
		<link href="stylesheets/style.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css">
        <link href="stylesheets/courseList.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css">
	</head>
    
<?php
    include 'header.php';
?>

<?php
    if (isset($_GET['lang'])) {
        $lang = $_GET['lang'];
        if ($lang == "cpp") {
            echo '<h1>C++ Courses</h1>';
        }
        else if ($lang == "java") {
            echo '<h1>Java Courses</h1>';
        }
        else if ($lang == "python") {
            echo '<h1>Python Courses</h1>';
        }
        else if ($lang == "git") {
            echo '<h1>Git Courses</h1>';
        }
        else if ($lang == "html") {
            echo '<h1>HTML Courses</h1>';
        }
        else if ($lang == "css") {
            echo '<h1>CSS Courses</h1>';
        }
        else if ($lang == "javascript") {
            echo '<h1>JavaScript Courses</h1>';
        }
        else if ($lang == "php") {
            echo '<h1>PHP Courses</h1>';
        }
    }


?>

<?php

require 'scripts/dbh.php';

$sql = "SELECT * FROM courses WHERE lang=?";
$statement = mysqli_stmt_init($connection);
if (!mysqli_stmt_prepare($statement, $sql)) {
    header("Location: ../courseList.php?error=sqlerror");
    exit();
}
else {
    mysqli_stmt_bind_param($statement, "s", $_GET['lang']);
    mysqli_stmt_execute($statement);
    $result = mysqli_stmt_get_result($statement);

    if ($row = mysqli_fetch_assoc($result)) {
        while ($row) {
            echo    '
            <section>
                <a href="courseOverview.php?courseId='.$row['courseId'].'">
                    <img src="'.$row['thumbnailAddress'].'">
                </a>
                <div>
                    <h2>'.$row['courseName'].'</h2>
                    <h3>';
                    if ($row['price'] == 0) {
                        echo 'Free';
                        $free = true;
                    }
                    else {
                        $free = false;
                        $purchased = false;
                        if(isset($_SESSION['purchasedCourses'])) {
                            foreach ($_SESSION['purchasedCourses'] as $value) {
                                if ($value == $row['courseId']) {
                                    $purchased = true;
                                    break;
                                }
                            }
                        }
                        if ($purchased) {
                            echo 'Purchased';
                        }
                        else {
                            echo '$'.$row['price'];
                        }
                    }
            echo    '</h3>
                    <p>'.$row['courseDescription'].'</p>
                    <br>';
            
            if (isset($_SESSION['shoppingCart'])) {
                $inCart = false;
                foreach ($_SESSION['shoppingCart'] as $x => $val) {
                    if ($row['courseId'] == $val) {
                        $inCart = true;
                        break;
                    }
                }
                if (!$free) {
                    if (!$purchased) {
                        if ($inCart) {
                            echo    '<a href="scripts/removeFromCart.php?courseId='.$row['courseId'].'">
                                        <button>Remove from cart</button>
                                    </a>';
                        }
                        else {
                            echo    '<a href="scripts/addToCart.php?courseId='.$row['courseId'].'">
                                        <button>Add to cart</button>
                                    </a>';
                        }
                    }
                }
            }
            echo '</section>';
            $row = mysqli_fetch_assoc($result);
        }
    }
    else {
        echo "<p>Oops! It looks like we don't have any courses for that topic yet! Check back soon, we have more courses on the way!</p>";
    }
}
mysqli_stmt_close($statement);
mysqli_close($connection);

?>

<?php
    include 'footer.php';
?>