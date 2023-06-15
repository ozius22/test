<?php
include 'components/connect.php';

if (isset($_COOKIE['user_id'])) {
   $user_id = $_COOKIE['user_id'];
} else {
   setcookie('user_id', create_unique_id(), time() + 60 * 60 * 24 * 30, '/');
   header('location:index.php');
   exit;
}

$warning_msg = array();
$success_msg = array();

if (isset($_POST['check'])) {

   $check_in = $_POST['check_in'];
   $check_in = filter_var($check_in, FILTER_SANITIZE_STRING);
   $room_type = $_POST['room_type'];
   $room_type = filter_var($room_type, FILTER_SANITIZE_STRING);

   $total_rooms = 0;

   $check_bookings = $conn->prepare("SELECT * FROM `bookings` WHERE check_in = ?");
   $check_bookings->execute([$check_in]);

   while ($fetch_bookings = $check_bookings->fetch(PDO::FETCH_ASSOC)) {
      $total_rooms += $fetch_bookings['rooms'];
   }

   // if the hotel has total 9 rooms
   if ($total_rooms >= 9) {
      $warning_msg[] = 'rooms are not available';
   } else {
      $success_msg[] = 'rooms are available';
   }

}

if (isset($_POST['book'])) {

   $booking_id = create_unique_id();
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $rooms = $_POST['rooms'];
   $rooms = filter_var($rooms, FILTER_SANITIZE_STRING);
   $check_in = $_POST['check_in'];
   $check_in = filter_var($check_in, FILTER_SANITIZE_STRING);
   $check_out = $_POST['check_out'];
   $check_out = filter_var($check_out, FILTER_SANITIZE_STRING);
   $adults = $_POST['adults'];
   $adults = filter_var($adults, FILTER_SANITIZE_STRING);
   $childs = $_POST['childs'];
   $childs = filter_var($childs, FILTER_SANITIZE_STRING);
   $room_type = $_POST['room_type'];
   $room_type = filter_var($room_type, FILTER_SANITIZE_STRING);
   $price = $_POST['price'];
   $price = filter_var($price, FILTER_SANITIZE_STRING);
   

   $total_rooms = 0;

   $check_bookings = $conn->prepare("SELECT * FROM `bookings` WHERE check_in = ?");
   $check_bookings->execute([$check_in]);

   while ($fetch_bookings = $check_bookings->fetch(PDO::FETCH_ASSOC)) {
      $total_rooms += $fetch_bookings['rooms'];
   }

   if ($total_rooms >= 10) {
      $warning_msg[] = 'rooms are not available';
   } else {

      $verify_bookings = $conn->prepare("SELECT * FROM `bookings` WHERE user_id = ? AND name = ? AND email = ? AND number = ? AND rooms = ? AND room_type = ? AND check_in = ? AND check_out = ? AND adults = ? AND childs = ? ");
      $verify_bookings->execute([$user_id, $name, $email, $number, $rooms, $room_type, $check_in, $check_out, $adults, $childs]);

      if ($verify_bookings->rowCount() > 0) {
         $warning_msg[] = 'room booked already!';
      } else {
         $book_room = $conn->prepare("INSERT INTO `bookings`(booking_id, user_id, name, email, number, rooms, room_type, check_in, check_out, adults, childs, price ) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)");
         $book_room->execute([$booking_id, $user_id, $name, $email, $number, $rooms, $room_type, $check_in, $check_out, $adults, $childs, $price]);
         $success_msg[] = 'room booked successfully!';

         header('location:book.php');
      exit;
      }

   }

}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Reservation</title>
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- swiper js cdn link -->
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
    <!-- custom css link -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
<script>
      function updatePrice() {
         var roomTypeSelect = document.querySelector('select[name="room_type"]');
         var priceDisplay = document.getElementById('price-display');
         var selectedOption = roomTypeSelect.options[roomTypeSelect.selectedIndex];
         var price = selectedOption.getAttribute('data-price');

         priceDisplay.innerHTML = 'Price: ₱' + price;
      }
   </script>
    <?php include 'components/user_header.php'; ?>



    <section class="reservation" id="reservation">



        <form action="" method="post">
            <h1 class="heading">Reservation Form</h1>
            <div class="container">
                <div class="box">
                    <p>your name <span>*</span></p>
                    <input type="text" name="name" maxlength="50" required placeholder="enter your name" class="input">
                </div>
                <div class="box">
                    <p>your email <span>*</span></p>
                    <input type="email" name="email" maxlength="50" required placeholder="enter your email" class="input">
                </div>
                <div class="box">
                    <p>your number <span>*</span></p>
                    <input type="number" name="number" maxlength="10" min="0" max="9999999999" required placeholder="enter your number" class="input">
                </div>
                <div class="box">
                    <p>rooms <span>*</span></p>
                    <select name="rooms" class="input" required>
                        <option value="1" selected>1 room</option>
                        <option value="2">2 rooms</option>
                        <option value="3">3 rooms</option>
                        <option value="4">4 rooms</option>
                        <option value="5">5 rooms</option>
                        <option value="6">6 rooms</option>
                    </select>
                </div>
                <div class="box">
                    <p>check in <span>*</span></p>
                    <input type="date" name="check_in" class="input" required>
                </div>
                <div class="box">
                    <p>check out <span>*</span></p>
                    <input type="date" name="check_out" class="input" required>
                </div>
                <div class="box">
                    <p>adults <span>*</span></p>
                    <select name="adults" class="input" required>
                        <option value="1" selected>1 adult</option>
                        <option value="2">2 adults</option>
                        <option value="3">3 adults</option>
                        <option value="4">4 adults</option>
                        <option value="5">5 adults</option>
                        <option value="6">6 adults</option>
                    </select>
                </div>
                <div class="box">
                    <p>childs <span>*</span></p>
                    <select name="childs" class="input" required>
                        <option value="0" selected>0 child</option>
                        <option value="1">1 child</option>
                        <option value="2">2 childs</option>
                        <option value="3">3 childs</option>
                        <option value="4">4 childs</option>
                        <option value="5">5 childs</option>
                        <option value="6">6 childs</option>
                    </select>
                </div>
                <div class="box">
                    <p>Room type <span>*</span></p>
                    <select name="room_type" class="input" onchange="updatePrice()" required>
                        <option value="1-Single Room" data-price="2,999">Single Room</option>
                        <option value="2-Double Room" data-price="3,999">Double Room</option>
                        <option value="3-Standard Room" data-price="4,999">Standard Room</option>
                        <option value="2-Honeymoon Suite" data-price="5,999">Honeymoon Suite</option>
                        <option value="5-Presidential Suite" data-price="20,000">Presidential Suite</option>
                        <option value="7-Family Room" data-price="6,000">Family Room</option>
                        <option value="6-Deluxe Room" data-price="11,000">Deluxe Room</option>
                        <option value="2-Executive Suite" data-price="7,000">Executive Suite</option>
                        <option value="4-Junior Suite" data-price="9,999">Junior Suite</option>
                    </select>
                </div>
                <div id="price-display"></div>
            </div>
            <input type="submit" value="book now" name="book" class="btn">
        </form>

    </section>

    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>


    <script src="script.js"></script>



    <?php include 'components/message.php'; ?>
</body>
</html>