<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $fullName = $_POST["fullName"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $city = $_POST["city"];
    $state = $_POST["state"];
    $zipCode = $_POST["zipCode"];

    // Process the payment and store the transaction information
    // ...

    // Redirect the user to the receipt page with the necessary data
    $receiptUrl = "receipt.php"; // Update the URL if needed
    header("Location: $receiptUrl?fullName=$fullName&email=$email&address=$address&city=$city&state=$state&zipCode=$zipCode");
    exit;
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Hotel Website</title>
	<!-- font awesome cdn link  -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
	<!-- swiper js cdn link -->
	<link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
	<!-- custom css link -->
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="payment.css">
</head>
<body>
	<header>
		<div class="container">
			<div class="left">
				<h3>BILLING ADDRESS</h3>
				<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
						Full name
						<input type="text" name="fullName" placeholder="Enter name" required>
						Email
						<input type="text" name="email" placeholder="Enter email" required>

						Address
						<input type="text" name="address" placeholder="Enter address" required>

						City
						<input type="text" name="city" placeholder="Enter City" required>
						<div id="zip">
						<label>
							State
							<select>
								<option>Choose State..</option>
								<option>Rajasthan</option>
								<option>Hariyana</option>
								<option>Uttar Pradesh</option>
								<option>Madhya Pradesh</option>
							</select>
						</label>
						<label>
							Zip code
							<input type="number" name="zipCode" placeholder="Zip code" required>
						</label>
					</div>
				</form>
			</div>
			<div class="right">
				<h3>PAYMENT</h3>
				<form>
					Accepted Card <br>
					<img src="images/card1.png" width="100">
					<img src="images/card2.png" width="50">
					<br><br>

					Credit card number
					<input type="text" name="" placeholder="Enter card number">

					Exp month
					<input type="text" name="" placeholder="Enter Month">
					<div id="zip">
						<label>
							Exp year
							<select>
								<option>Choose Year..</option>
								<option>2022</option>
								<option>2023</option>
								<option>2024</option>
								<option>2025</option>
							</select>
						</label>
						<label>
							CVV
							<input type="number" name="" placeholder="CVV">
						</label>
					</div>
				</form>
				<button type="submit" class="btn">Pay Now</button>
			</div>
		</div>
	</header>
</body>
</html>