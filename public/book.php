<?php
include 'components/connect.php';

if (isset($_COOKIE['user_id'])) {
   $user_id = $_COOKIE['user_id'];
} else {
   setcookie('user_id', create_unique_id(), time() + 60 * 60 * 24 * 30, '/');
   header('location:index.php');
}

if (isset($_POST['cancel'])) {
   $booking_id = $_POST['booking_id'];
   $booking_id = filter_var($booking_id, FILTER_SANITIZE_STRING);

   $verify_booking = $conn->prepare("SELECT * FROM `bookings` WHERE booking_id = ?");
   $verify_booking->execute([$booking_id]);

   if ($verify_booking->rowCount() > 0) {
      $delete_booking = $conn->prepare("DELETE FROM `bookings` WHERE booking_id = ?");
      $delete_booking->execute([$booking_id]);
      $success_msg[] = 'Booking cancelled successfully!';
   } else {
      $warning_msg[] = 'Booking already cancelled!';
   }
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
   </head>
   <body>
      <?php include 'components/user_header.php'; ?>
      </header>
      <section class="bookings">
         <h1 class="heading">My Bookings</h1>
         <div class="box-container">
            <?php
            $select_bookings = $conn->prepare("SELECT * FROM `bookings` WHERE user_id = ?");
            $select_bookings->execute([$user_id]);
            if ($select_bookings->rowCount() > 0) {
               while ($fetch_booking = $select_bookings->fetch(PDO::FETCH_ASSOC)) {
                  $price = $fetch_booking['price']; // Add this line to fetch the price column

            ?>
            <div class="box">
               <p>name: <span><?= $fetch_booking['name']; ?></span></p>
               <p>email: <span><?= $fetch_booking['email']; ?></span></p>
               <p>number: <span><?= $fetch_booking['number']; ?></span></p>
               <p>check in: <span><?= $fetch_booking['check_in']; ?></span></p>
               <p>check out: <span><?= $fetch_booking['check_out']; ?></span></p>
               <p>rooms: <span><?= $fetch_booking['rooms']; ?></span></p>
               <p>room type: <span><?= $fetch_booking['room_type']; ?></span></p>
               <p>adults: <span><?= $fetch_booking['adults']; ?></span></p>
               <p>childs: <span><?= $fetch_booking['childs']; ?></span></p>
               <p>booking id: <span><?= $fetch_booking['booking_id']; ?></span></p>
                <p>price: <span><?= $fetch_booking['price'];; ?></span></p>
               <form action="" method="POST">
                  <input type="hidden" name="booking_id" value="<?= $fetch_booking['booking_id']; ?>">
                  <input type="submit" value="Cancel Booking" name="cancel" class="btn" onclick="return confirm('Cancel this booking?')">
                  <a href="payment.php" class="btn hidden-btn">Pay Now</a>
               </form>
            </div>
            <?php
               }
            } else {
            ?>
            <div class="box" style="text-align: center;">
               <p style="padding-bottom: .5rem; text-transform: capitalize;">No bookings found!</p>
               <a href="index.php#reservation" class="btn">Book New</a>
               
            </div>
            <?php
               }
            ?>
         </div>
      </section>
   </body>
</html>
