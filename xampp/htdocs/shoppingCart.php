<?php
	session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Learn U | Shopping Cart</title>
		<link href="stylesheets/style.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css">
		<link href="stylesheets/shoppingCart.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css">
	</head>

<?php
	include 'header.php';
?>

<h1>Shopping Cart</h1>
<br>

<?php
	if (!isset($_SESSION['username'])) {
		echo 'You must log in to view your shopping cart.';
	}
	else {
		if(count($_SESSION['shoppingCart']) == 0) {
			echo "<p> Shopping Cart is empty.</p>";
		}
		else {
			require 'scripts/dbh.php';

			$sql = "SELECT * FROM courses";
			$statement = mysqli_stmt_init($connection);
			if (!mysqli_stmt_prepare($statement, $sql)) {
				header("Location: ../shoppingCart.php?error=sqlerror");
				exit();
			}
			else {
				mysqli_stmt_execute($statement);
				$result = mysqli_stmt_get_result($statement);
				
				if ($row = mysqli_fetch_assoc($result)) {
					$subTotal = 0;
					
					while ($row) {
						foreach ($_SESSION['shoppingCart'] as $x => $val) {
							if ($row['courseId'] == $val) {
								echo '<div class="item">';
								echo '<div class="left">'.$row['courseName'].' : </div><div class="right"> $'.$row['price'];
								$subTotal += $row['price'];
								echo '	<a href="scripts/removeFromCart.php?courseId='.$val.'">
								<button>Remove</button>
							</a></div>';
							echo '</div>';
								break;
							}
						}
						$row = mysqli_fetch_assoc($result);
					}
					echo '<div class="item">';
					echo '<div class="left"></div>';
					echo '<div class="right">-------------</div>';
					echo '</div>';
					echo '<div class="item">';
					echo '<div class="left">Subtotal : </div>';
					echo '<div class="right"> $'.$subTotal.'</div>';
					echo '</div>';
					$tax = (int)($subTotal * 0.0625 * 100);
					$tax = (float)($tax / 100);
					echo '<div class="item">';
					echo '<div class="left">Tax : </div>';
					echo '<div class="right"> $'.$tax.'</div>';
					echo '</div>';
					$total = $subTotal + $tax;
					echo '<div class="item">';
					echo '<div class="left"></div>';
					echo '<div class="right">-------------</div>';
					echo '</div>';
					echo '<div class="item">';
					echo '<div class="left">Total : </div>';
					echo '<div class="right"> $'.$total.'</div>';
					echo '</div><br>';
					echo'	<a href="checkout.php">
								<button>Checkout</button>
							</a>';
				}
			}
			echo '</div>';
		}
	}
?>

<?php
	include 'footer.php';
?>