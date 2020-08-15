<?php
	session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Learn U | Coding Tutorials</title>
		<link href="stylesheets/style.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css">
    </head>
    
<?php
    include 'header.php';
?>

<?php
	if (isset($_SESSION['username'])) {
		echo '<h1>Welcome back ' . $_SESSION['username'] . '!</h1>';
	}
	else {
		echo '<h1>Welcome to LearnU!</h1>';
	}
?>

<br>
<p>Feel free to browse our courses and learn you something!</p>

<?php
    include 'footer.php';
?>

