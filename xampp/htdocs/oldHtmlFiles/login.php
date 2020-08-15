<?php
  session_start();
 ?>
 <!DOCTYPE html>
 <html>
    <head>
        <title>Learn U | Log In</title>
        <link href="stylesheets/style.css" rel="stylesheet" type="text/css">
		<link href="stylesheets/login.css" rel="stylesheet" type="text/css">
    </head>
    
    <body>
		<header>
			<nav>
				<a href="index.html"><img id="logo" src="images/logo.png"></a>

				<div id="navLeft">
					<a class="nav-link" href="index.html">Home</a>
					<a class="nav-link" href="browse.html">Browse</a>
				</div>
				
				<div id="search-bar-container">
					<form id="search-bar" action="#">
						<input id="search-bar-input" type="text" placeholder="search">
						<button type="submit">Submit</button>
					</form>
				</div>

				<div id="navRight">
					<a class="nav-link" href="login.html">Login</a>
					<a class="nav-link" href="signup.html">Sign Up</a>
					<a class="nav-link" href="shoppingCart.html"><img id="shopping-cart-img" src="images/shoppingCart.png"></a>
				</div>
			</nav>
		</header>

		<main>
            <article>
				<?php
					$loginSuccessful = false;

                    $connection = mysql_connect('localhost', 'root', '');
                    if (!$connection) {
                        die("Unable to connect: " . mysql_error());
                    }
                    
                    mysql_select_db('learnu', $connection) or die("Unable to select database: " . mysql_error());
                
                    $given_email = $_POST['email'];
					$given_password = $_POST['password'];
					$stored_email = "";
					$stored_password = "";
                    
                    $query = "SELECT email, password FROM user_data WHERE email = '$given_email';";
                
                    $result = mysql_query($query);

					if (!$result) {
						echo "Error - the query could not be executed";
						$error = mysql_error();
						print "<p>" . $error . "</p>";
						exit;
					}

					$row = mysql_fetch_array($result);
					$stored_email = $row[0];
					$stored_password = $row[1];

					if ($stored_email != $given_email) {
						echo "Account does not exist.<br>";
					}
					else if ($stored_password != $given_password) {
						echo "Invalid password. Please refresh the page and try again.<br>";
					}
					else if ($given_password == $stored_password) {
						$loginSuccessful = true;
						echo "Login Successful!<br>";
					}
                
					mysql_close($connection);
					
					if ($loginSuccessful) {
						if ($rememberMe){
							setcookie("email", $email, time() + 60 * 60 * 24 * 5);
						}
						else {
							
						}
					}
					else {
						echo "Unable to login. Please refresh page and try again.";
					}
                ?>
            </article>
		</main>
	</body>
</html>