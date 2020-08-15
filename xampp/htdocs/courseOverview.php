<?php
	session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Learn U | Course Overview</title>
		<link href="stylesheets/style.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css">
        <link href="stylesheets/courseOverview.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css">
	</head>

<?php
	include 'header.php';
?>

<?php

$free = false;

require 'scripts/dbh.php';

$sql = "SELECT * FROM courses WHERE courseId=?;";
$statement = mysqli_stmt_init($connection);
if (!mysqli_stmt_prepare($statement, $sql)) {
    echo "<p>Oops! Something went wrong accessing the database! Check back soon, we are working on a solution!</p>";
    exit();
}
else {
    mysqli_stmt_bind_param($statement, "i", $_GET['courseId']);
    mysqli_stmt_execute($statement);
    $result = mysqli_stmt_get_result($statement);

    if ($row = mysqli_fetch_assoc($result)) {
        $courseName = $row['courseName'];

        echo    '<h1>'.$courseName.'</h1>
                <h3>';
                if ($row['price'] == 0) {
                    echo 'Free';
                    $free = true;
                }
                else {
                    echo '$'.$row['price'];
                    $free = false;
                }
        echo        '</h3>
                <p id="description">'.$row['courseDescription'].'</p>';

        mysqli_stmt_close($statement);
        echo '<div id="content">';

        $sql = "SELECT * FROM videos WHERE courseName=? ORDER BY videoNumber;";
        $statement = mysqli_stmt_init($connection);
        
        if (!mysqli_stmt_prepare($statement, $sql)) {
            echo "<p>Oops! Something went wrong accessing the database hurrr! Check back soon, we are working on a solution!</p>";
            exit();
        }
        else {
            mysqli_stmt_bind_param($statement, "s", $row['courseName']);
            mysqli_stmt_execute($statement);
            $result = mysqli_stmt_get_result($statement);
            echo '<div id="content">';
            if ($row = mysqli_fetch_assoc($result)) {
                $count = 1;
                while ($row) {
                    echo '
                    <section>
                        <a href="lesson.php?videoId='.$row['videoId'].'&courseId='.$_GET['courseId'].'&free='.$free.'">
                            <video src="'.$row['videoAddress'].'" height="150" width="150">
                        </a>
                        <div>
                            <h2>'.$count.'. '.$row['videoName'].'</h2>
                            <p>'.$row['videoDescription'].'</p>
                        </div>
                    </section>';
                    $row = mysqli_fetch_assoc($result);
                    $count++;
                }
            }
            else {
                echo "<p>Oops! Something went wrong loading the videos! Check back soon, we are working on a solution!</p>";
            }
            echo '</div>';
        }
        echo '</div>';
    }
    else {
        echo "<p>Oops! Something went wrong! Check back soon, we are working on a solution!</p>";
    }
}
mysqli_stmt_close($statement);
mysqli_close($connection);

?>

<?php
	include 'footer.php';
?>