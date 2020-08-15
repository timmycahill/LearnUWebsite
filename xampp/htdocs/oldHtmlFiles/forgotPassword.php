<?php
  session_start();
 ?>
<!DOCTYPE html>
<html>
	<head>
		<title>Learn U | Forgot Password</title>
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
			<form id="loginform">
				<h1>Reset your password</h1>

				<p><strong>Enter the email associated with your account below and a password reset link will be sent to you.</strong></p>
				<br>
				<section>
					<div class="username-password">
						<p> E-mail: </p>
						<p>
							<label for="email" id="email-label">
								<input type="email" id="email" required>
							</label>
						</p>
					</div>

					<button type="submit">Send Link</button>
				</section>
			</form>
		</main>
	</body>
</html>