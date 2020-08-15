<?php
	session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Learn U | Coding Tutorials</title>
		<link href="stylesheets/style.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css">
        <link href="stylesheets/lesson.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css">
	</head>
    
<?php
    include 'header.php';
?>




<?php
if(!isset($_SESSION['username'])) {
    echo 'You must sign in to view this page.';
}
else {
    require 'scripts/dbh.php';

    $sql = "SELECT * FROM videos WHERE videoId=?;";
    $statement = mysqli_stmt_init($connection);
    if (!mysqli_stmt_prepare($statement, $sql)) {
        echo "<p>Oops! Something went wrong accessing the database! Check back soon, we are working on a solution!</p>";
        exit();
    }
    else {
        mysqli_stmt_bind_param($statement, "i", $_GET['videoId']);
        mysqli_stmt_execute($statement);
        $result = mysqli_stmt_get_result($statement);

        if ($row = mysqli_fetch_assoc($result)) {
            $purchased = false;
            if (!$_GET['free']) {
                foreach($_SESSION['purchasedCourses'] as $value) {
                    if($_GET['courseId'] == $value) {
                        $purchased = true;
                    }
                }
            }
            else {
                $purchased = true;
            }

            if (!$purchased) {
                echo '  <div id="notPurchased"><p>You must purchase this course to watch this video.</p><br>';
                $inCart = false;
                foreach($_SESSION['shoppingCart'] as $value) {
                    if ($value == $_GET['courseId']) {
                        $inCart = true;
                        break;
                    }
                }
                if ($inCart) {
                    echo '  <a href="scripts/removeFromCart.php?courseId='.$_GET['courseId'].'">
                            <button>Remove from cart</button>
                            </a></div>';
                }
                else {
                    echo '  <a href="scripts/addToCart.php?courseId='.$_GET['courseId'].'">
                            <button>Add to cart</button>
                            </a></div>';
                }
            }
            else {
                echo    '
                <h1>'.$row['videoName'].'</h1>
                        
                <section>
                    <div id="video-description">
                        <div id="video">
                            <video src="'.$row['videoAddress'].'" autoplay controls>
                            </video>
                        </div>
                
                        <div id="description">
                            <p>'.$row['videoDescription'].'</p>
                        </div>
                    </div>
                    <div id="watch-next">
                    <h2>Watch next:</h2>';
                
                $courseName = $row['courseName'];
                $videoNumber = $row['videoNumber'];
                mysqli_stmt_close($statement);

                for ($i = 0; $i < 3; $i++) {
                    $sql = "SELECT * FROM videos WHERE videoNumber=? AND courseName=?;";
                    $statement = mysqli_stmt_init($connection);
                    if (!mysqli_stmt_prepare($statement, $sql)) {
                        echo "<p>Oops! Something went wrong accessing the database! Check back soon, we are working on a solution!</p>";
                        exit();
                    }
                    else {
                        $videoNumber++;
                        mysqli_stmt_bind_param($statement, "is", $videoNumber, $courseName);
                        mysqli_stmt_execute($statement);
                        $result = mysqli_stmt_get_result($statement);

                        if (!$row = mysqli_fetch_assoc($result)) {
                            if ($i = 0) {
                                echo '<p>There are no more videos</p>';
                            }
                            break;
                        }
                        else {
                            echo    '
                                <a href="lesson.php?videoId='.$row['videoId'].'&courseId='.$_GET['courseId'].'&free='.$_GET['free'].'">
                                    <h3>'.$row['videoName'].'</h3>
                                    <video src="'.$row['videoAddress'].'" height="200" width="200">
                                    
                                </a>';
                        }
                    }
                }
            }
        }
        else {
            echo "<p>Oops! Something went wrong! Check back soon, we are working on a solution!</p>";
        }
    }
}
?>

<?php
    include 'footer.php';
?>

