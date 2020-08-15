<?php
  session_start();
 ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Learn U | Sign Up</title>
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
                    $connection = mysql_connect('localhost', 'root', '');
                    if (!$connection) {
                        die("Unable to connect: " . mysql_error());
                    }
                    
                    mysql_select_db('learnu', $connection) or die("Unable to select database: " . mysql_error());
                
                    $email = $_POST['email'];
                    $password = $_POST['password1'];
                    
                    $query = "INSERT INTO user_data (email, password) VALUES ('$email', '$password');";
                
                    mysql_query($query) or die('Error querying database');
                    echo 'Account created. Please log in to access your account.';
                
                    mysql_close($connection);
                ?>
            </article>
		</main>
	</body>
</html>