<?php
	session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Learn U | Forgot Password</title>
		<link href="stylesheets/style.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css">
		<link href="stylesheets/login.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css">
	</head>

<?php
	include 'header.php';
?>

<form id="loginform">
    <h1>Reset your password</h1>
    <p><strong>Enter the email associated with your account below and a password reset link will be sent to you.</strong></p>
    <br>
    <section>
        <div class="username-password">
            <p> E-mail: </p>
            <p>
                <label for="email" id="email-label">
                    <input type="email" name="email" required>
                </label>
            </p>
        </div>

        <button type="submit">Send Link</button>
    </section>
</form>

<?php
	include 'footer.php';
?>