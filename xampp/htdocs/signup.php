<?php
	session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Learn U | Sign Up</title>
		<link href="stylesheets/style.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css">
		<link href="stylesheets/login.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css">
		<script>
			function checkPassword() {
				p1 = document.signupform.password1.value;
				p2 = document.signupform.password2.value;

				if (p1 == "" || p2 == "") {
					alert("Please fill in both password fields.");
					return false;
				}
				else {
					if (p1 != p2) {
						alert("Passwords do not match");
						return false;
					}
					else {
						return true;
					}
				}
			}
		</script>
	</head>
    
<?php
    include 'header.php';
?>

<form name="signupform" action="scripts/signup_script.php" method="post" onsubmit="return checkPassword()">
    <h1>Sign Up</h1>

    <?php
        if (isset($_GET['signup']) && $_GET['signup'] == "success") {
            echo '<p>Account succesfully created!</p>';
        }
        else {
            if (isset($_GET['error'])) {
                if ($_GET['error'] == "emptyfields") {
                    echo '<p class="errorMessage">Fill in all fields</p>';
                }
                else if ($_GET['error'] == "invalidemailusername") {
                    echo '<p class="errorMessage">Invalid username and email</p>';
                }
                else if ($_GET['error'] == "invalidemail") {
                    echo '<p class="errorMessage">Invalid email</p>';
                }
                else if ($_GET['error'] == "invalidusername") {
                    echo '<p class="errorMessage">Invalid username</p>';
                }
                else if ($_GET['error'] == "passwordcheck") {
                    echo '<p class="errorMessage">Passwords do not match</p>';
                }
                else if ($_GET['error'] == "usernametaken") {
                    echo '<p class="errorMessage">Username is already taken</p>';
                }
            }
            echo '<section>
            <div class="username-password">
                <div class="left">
                    <p> Username: </p>
                </div>
    
                <div class="right">
                    <p>
                        <label for="username">
                            <input type="text" name="username" required>
                        </label>
                    </p>
                </div>
            </div>
    
            <div class="username-password">
                <div class="left">
                    <p> E-mail: </p>
                </div>
    
                <div class="right">
                    <p>
                        <label for="email">
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
                        <label for="password">
                            <input type="password" name="password" required>
                        </label>
                    </p>
                </div>
            </div>
    
            <div class="username-password">
                <div class="left">
                    <p> Re-enter Password: </p>
                </div>
    
                <div class="right">
                    <p>
                        <label for="confirmPassword">
                            <input type="password" name="password2" required>
                        </label>
                    </p>
                </div>
            </div>
        </section>
        
        <section>
            <button type="submit" name="signup-submit">Sign Up</button>
            <p>Already have an account? <a href="login.php">Log in</a></p>
        </section>';
        }
    ?>

    
</form>

<?php
    include 'footer.php';
?>