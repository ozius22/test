<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        .receipt-info {
            background-color: #f2f2f2;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .receipt-info h2 {
            margin-top: 0;
            margin-bottom: 10px;
        }

        .receipt-info p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <h1>Receipt</h1>

    <div class="receipt-info">
        <h2>Billing Address</h2>
        <?php
        // Retrieve the necessary data from the server-side (e.g., from a database)
        $fullName = isset($_POST["fullName"]) ? $_POST["fullName"] : "";
        $email = isset($_POST["email"]) ? $_POST["email"] : "";
        $address = isset($_POST["address"]) ? $_POST["address"] : "";
        $city = isset($_POST["city"]) ? $_POST["city"] : "";
        $state = isset($_POST["state"]) ? $_POST["state"] : "";
        $zipCode = isset($_POST["zipCode"]) ? $_POST["zipCode"] : "";

        // Display the receipt information
        echo "<p><strong>Full Name:</strong> $fullName</p>";
        echo "<p><strong>Email:</strong> $email</p>";
        echo "<p><strong>Address:</strong> $address</p>";
        echo "<p><strong>City:</strong> $city</p>";
        echo "<p><strong>State:</strong> $state</p>";
        echo "<p><strong>Zip Code:</strong> $zipCode</p>";
        ?>
    </div>

    <!-- Additional receipt information goes here -->
</body>
</html>
