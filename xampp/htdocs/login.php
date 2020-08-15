<?php
	session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Learn U | Log In</title>
		<link href="stylesheets/style.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css">
		<link href="stylesheets/login.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css">
	</head>
    
<?php
    include 'header.php';
?>

<form name="loginform" action="scripts/login_script.php" method="post">
    <h1>Log In</h1>

    <section>
        <div class="username-password">
            <div class="left">
                <p> E-mail: </p>
            </div>

            <div class="right">
                <p>
                    <label for="email" id="email-label">
                        <input type="email" name="email" required>
                    </label>
                </p>
            </div>
        </div>

        <div class="username-password">
            <div class="left">
                <p> Password: </p>
            </div>

            <div class="right">
                <p>
                    <label for="password" id="password-label">
                        <input type="password" name="password" required>
                    </label>
                </p>
            </div>
        </div>
    </section>
    
    <section>
        <button type="submit">Log In</button>
        <p>Don't have an account? <a href="signup.php">Sign up</a></p>
        <p><a href="forgotPassword.php">Forgot password?</a></p>
    </section>
</form>

<?php
    include 'footer.php';
?>