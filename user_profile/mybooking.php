<?php
session_start();
include '../config.php';


// Fetching customer ID from the session
$customer_id = $_SESSION['user_id'];
//button functionality
if (isset($_POST['confirm'])) {
    // echo 'Put the star';
    $booking_id = $_POST['booking_id'];
    $sql_booking = "SELECT * FROM booking WHERE booking_id='$booking_id' AND STR_TO_DATE(CONCAT(booking_date, ' ', booking_time), '%Y-%m-%d %h:%i %p') < NOW();";
    $result_booking = mysqli_query($con, $sql_booking);
    if ($row_booking = $result_booking->fetch_assoc()) {
        // echo 'check';
        // Prepare the statement
        $stmt = $con->prepare("UPDATE `booking` SET `user_end` = 1 , `booking_status`=1 WHERE `booking_id` = ?");
        // Bind the parameter (assuming booking_id is an integer)
        $stmt->bind_param("i", $booking_id);
        // Execute the statement
        if ($stmt->execute()) {
            // echo "Booking updated successfully.";
            $sql_again = "SELECT* FROM booking WHERE user_end=1 AND provider_end=1 AND booking_id='$booking_id'";
            $result_again = mysqli_query($con, $sql_again);
            if ($row_again = $result_again->fetch_assoc()) {
                $stmt_again = $con->prepare("UPDATE `booking` SET `booking_status` = 2 WHERE `booking_id` = ?");
                // Bind the parameter (assuming booking_id is an integer)
                $stmt_again->bind_param("i", $booking_id);
                $stmt_again->execute();
            }
            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>"' . "<script>
        Swal.fire({
            icon: 'success',
            title: 'Successed',
            text: 'You have successfully confirmed the order.',
            confirmButtonText: 'OK'
        });
    </script>";
        } else {
            echo "Error updating booking: " . $stmt->error;
        }
        // Close the statement
        $stmt->close();
    } else {
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>"' . "<script>
        Swal.fire({
            icon: 'warning',
            title: 'Confirmation Not Allowed',
            text: 'Since the order time is not over, you cannot confirm now.',
            confirmButtonText: 'OK'
        });
    </script>";
    }
    // echo $_POST['booking_id'];
}
// echo "<br><br><br><br><br><br><br><br>";
if (isset($_POST['cancel'])) {
    $date = $time = '';
    // echo $_POST['booking_id'];
    $booking_id = $_POST['booking_id'];

    // Fetch the booking details from the database
    $sql_booking = "SELECT * 
                    FROM booking 
                    WHERE booking_id='$booking_id' AND booking_status=0 
                    AND STR_TO_DATE(CONCAT(booking_date, ' ', booking_time), '%Y-%m-%d %h:%i %p') > NOW()
                    ";
    $result_booking = mysqli_query($con, $sql_booking);
    // echo 'check';
    if ($row_booking = $result_booking->fetch_assoc()) {
        $date_string = $row_booking['booking_date']; // e.g., '2025-01-01'
        $time_string = $row_booking['booking_time']; // e.g., '12:00 PM'

        // Parse the date
        $date = DateTime::createFromFormat('Y-m-d', $date_string);
        if ($date) {
            // echo "Date: " . $date->format('Y-m-d') . "\n"; // Output: '2025-01-01'
        } else {
            echo "Invalid date format.\n";
        }

        // Parse the time
        $time = DateTime::createFromFormat('h:i A', $time_string);
        if ($time) {
            // echo "Time: " . $time->format('H:i:s') . "\n"; // Output: '12:00:00'
        } else {
            echo "Invalid time format.\n";
        }
        // $date = $row_booking['booking_date'];  // Date in 'Y-m-d' format
        // $time = $row_booking['booking_time'];  // Time in 'H:i:s' format

        // Combine date and time into a DateTime object
        // echo 'check';
        $booking_datetime = new DateTime("$date_string $time_string");
        // echo $booking_datetime->format('Y-m-d H:i:s');
        // echo $booking_datetime->format('Y-m-d H:i:s') . ' ';
        // Get the current date and time
        $current_datetime = new DateTime();
        // $current_datetime->setTimezone(new DateTimeZone('Asia/Dhaka'));
        // echo $current_datetime->format('Y-m-d H:i:s');

        // Calculate the difference between the booking time and the current time
        $interval = $current_datetime->diff($booking_datetime);
        // echo 'Difference: ' . $interval->format('%R%a days, %H hours, %I minutes');
        // Convert the interval to total hours
        // $hours_difference = ($interval->days * 24) + $interval->h;
        // echo $hours_difference;
        // Check if the booking is more than 24 hours away
        // echo 'interval: days: '.$interval->days.'hour:'.$interval->h.'<br>';
        // echo ($interval->days ==1&&$interval->h > 4);
        if ($interval->days > 1||($interval->days==1&&$interval->h > 4)) {
            // echo 'yes';
            // Allow cancellation if more than 24 hours ahead
            $sql_delete = "UPDATE booking set `booking_status`=-1 WHERE booking_id='$booking_id'";
            if (mysqli_query($con, $sql_delete)) {
                // echo "Booking successfully cancelled.";
                echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>"' . "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Successed',
                            text: 'You have successfully cancelled the order.',
                            confirmButtonText: 'OK'
                        });
                    </script>";
            } else {
                echo "Error cancelling the booking.";
            }
        } else {
            echo 'check';
            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>"' . "<script>
                    Swal.fire({
                        icon: 'warning',
                        title: 'Cancellation Not Allowed',
                        text: 'Since the remaining time is not more than 24 hours, you cannot cancel now.',
                        confirmButtonText: 'OK'
                    });
                    </script>";
        }
    } else {
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>"';
        echo "<script>
        Swal.fire({
            icon: 'warning',
            title: 'Cancellation Not Allowed',
            text: 'Since the remaining time is not more than 24 hours, you cannot cancel now.',
            confirmButtonText: 'OK'
        });
    </script>";
    }
}


if (isset($_POST['rating'])) {
    // echo 'jisan likes sristy';
    // echo $_POST['rating'] . '<br>';
    // echo $_POST['to'];

    $booking_id = $_POST['to'];
    $rating = $_POST['rating'];
    $customer_id = $_SESSION['user_id'];
    $review = $_POST['review'];
    // echo $review;

    //query to fetch my booking details
    $sql_select_booking = "SELECT 
                            b.booking_id AS booking_id,
                            b.booking_date,
                            b.booking_time,
                            b.provider_id,
                            b.user_id,
                            sw.provider_name,
                            sw.provider_rating,
                            sw.provider_review
                        FROM 
                            booking b
                        JOIN 
                            service_provider sw ON b.provider_id = sw.provider_id
                        WHERE 
                            b.booking_id = '$booking_id'
                            AND STR_TO_DATE(CONCAT(booking_date, ' ', booking_time), '%Y-%m-%d %h:%i %p') < NOW()";

    // Execute the SELECT query
    $result = mysqli_query($con, $sql_select_booking);

    if ($result && mysqli_num_rows($result) > 0) {
        // Step 2: Fetch the worker details from the result
        $booking = mysqli_fetch_assoc($result);
        $worker_id = $booking['provider_id'];
        $current_rating = $booking['provider_rating'];
        $count_customer = $booking['provider_review'];

        // Step 3: Calculate the new rating
        $new_rating = (($current_rating * $count_customer) + $rating) / ($count_customer + 1);

        // Step 4: Execute the UPDATE query to update worker's rating
        $sql_update_worker = "UPDATE service_provider
                          SET 
                              provider_rating = '$new_rating', 
                              provider_review = provider_review + 1
                          WHERE provider_id = '$worker_id'";

        $update_result = mysqli_query($con, $sql_update_worker);

        if ($update_result) {
            // Step 5: Insert the review into the review table
            $sql_update_rating = "UPDATE service_provider_review
                          SET 
                              service_provider_id = '$worker_id', 
                              customer_id = '$customer_id',
                              review_text='$review',
                              review_rating='$rating'
                          WHERE service_provider_id = '$worker_id'";
            $update_rating = mysqli_query($con, $sql_update_rating);
            if ($update_rating) {
                echo "<script>alert('Successfully updated rating.');</script>";
            } else {
                echo "<script>alert('Failed to update service_provider rating.');</script>";
            }
        } else {
            echo "<script>alert('Failed to update worker rating.');</script>";
        }
    } else {
        echo "<script>alert('You can\'t rate now!');</script>";
    }
}
// Fetching the bookings of the logged-in customer
$query = "SELECT * FROM booking WHERE user_id = ? AND (booking_status=0 or booking_status=1 or booking_status=2) ORDER BY booking_date DESC";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $customer_id);
$stmt->execute();
$result = $stmt->get_result();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My bookings</title>
    <!-- <script src="https://unpkg.com/@tailwindcss/browser@4"></script> -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
     <style>
        body {
            background-color: #F4F4F4;
            font-family: 'Inter', sans-serif;
        }

        .text-gray-700 {
            font-weight: bolder;
        }

        .t {
            /* font-family: 'Times New Roman', Times, serif; */
            font-family: cursive;
            font-size: 50px;
            color: #00008B;
        }

        #sidebar {
            flex-direction: column;
            justify-content: center;
            margin: 20px 0 0 30px;
            width: 300px;
        }

        #sidebar ul li a {
            text-decoration: none;
            line-height: 35px;
            font-size: larger;
            margin-left: 20px;
            color: #4A5568;
            transition: color 0.3s;
        }

        #sidebar ul li a:hover {
            color: #00008B;
        }

        #sidebar ul li {
            text-decoration: none;
            list-style-type: none;
        }

        #mma {
            font-size: 27.9px;
            text-decoration: none;
            color: #00008B;
            margin-right: 40px;
        }

        #undernavbar {
            display: flex;
            border-radius: 20px;
            margin-bottom: 80px;
            margin-top: 50px;
            /* Increased margin-bottom for more space */
        }

        #box1 {
            /* background-color: #FFFFFF; */
            width: 61%;
            height: 500px;
            border-radius: 10px;
            margin-left: 180px;
            /* box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px; */

        }

        #box1 h1 {
            font-size: 2rem;
            color: #00008B;
            font-weight: 900;
            position: relative;
            bottom: 20px;
        }

        .tables {
            height: 700px;
            width: 1400px;
            margin-top: 40px;
            margin-left: 80px;
            border-radius: 20px;
        }

        #profile_edit {
            margin-left: 20px;
            margin-top: 2px;
            padding: 10px 0 0 8px;
            height: 300px;
            width: 300px;
            border-radius: 10px;
        }

        .navs {
            background-color: #FFFFFF;
            width: 100vw;
            height: 65px;
            box-shadow: 1px 1px 1px 1px rgba(0, 0, 0, 0.1);
            display: flex;

        }

        .radiant {
            font-size: 42px;
            font-weight: 900;
            margin-left: 90px;
            color: #00008B;
        }

        .login_name {
            font-weight: 900;
        }

        .relation {
            padding-top: 3px;
            padding-left: 10px;
        }

        .together {
            display: flex;
            margin-top: 20px;
            margin-left: 600px;
        }

        li {
            font-size: 21px;
        }

        .arrow {
            position: absolute;
            right: 100px;
        }

        #tittlemnm {
            font-size: x-large;
            color: #00008B;
            margin: 50px 0 0 340px;
        }


        #B {
            font-size: larger;
            font-weight: bolder;
        }

        #name {
            margin: 0 0 0 670px;
        }
    </style> 
</head>

<body class="bg-gradient-to-bl from-blue-50 via-white via-blue-50 to-slate-300 h-screen">
    <?php include 'header.php'; ?>
    <!-- <h2 id="tittlemnm">My Booking</h2> -->
    <section id="undernavbar">
        <div id="sidebar">
            <a href="" id="mma">Manage My Account</a>
            <ul>
                <li><a href="My_profile.php">My Profile</a></li>
                <li><a href="addressofbooking.php">Address of Booking</a></li>
                <li><a href="myreviews.php">My Reviews</a></li>
                <li><a href="mybooking.php" id="mma">My booking</a></li>
                <li><a href="mycancellations.php">My Cancellations</a></li>
                <li><a href="Notifications.php">My Notifications</a></li>
            </ul>
            <?php
            if (isset($_SESSION['type'])) {
                echo '<a href="../logout.php" class="text-gray-700 hover:text-pink-600 " style="font-size:30px;margin:10px 0 0 20px; line-height:50px;">Logout</a>';
            }
            ?>
        </div>
        <div class="box1 ">
            <h2 class="text-3xl font-bold text-blue-900 mb-6" style="position:relative;left:90px;top:10px;">My Bookings
            </h2>
            <?php

            if ($result->num_rows > 0) {
                echo '<div class="overflow-x-auto tables">';
                echo '<table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-l border-2 border-blue-100">';
                echo '<thead class="bg-blue-500 text-white">';
                echo '<tr>';
                echo '<th class="px-2 py-1 text-left">Booking Date</th>';
                echo '<th class="px-2 py-1 text-left">Service provider</th>';
                echo '<th class="px-2 py-1 text-left">Service provider address</th>';
                echo '<th class="px-2 py-1 text-left">service Item</th>';
                echo '<th class="px-2 py-1 text-left">Appointment date</th>';
                echo '<th class="px-2 py-1 text-left">Time</th>';
                // echo '<th class="px-2 py-1 text-left">Your address</th>';
                echo '<th class="px-2 py-1 text-left">Status</th>';
                echo '<th class="px-2 py-1 text-left" colspan="3">Action</th>';

                echo '</tr>';
                echo '</thead>';
                echo '<tbody class="text-gray-700">';
                while ($row = $result->fetch_assoc()) {

                    echo '<tr class="border-t">';
                    echo '<td class="px-2 py-1">' . htmlspecialchars($row['when_booked']) . '</td>';
                    //fetching shops
                    $provider_id = $row['provider_id'];
                    $sql_shop = "select provider_name, provider_district, provider_upazila, provider_area from service_provider where provider_id='$provider_id'";
                    $result_shop = mysqli_query($con, $sql_shop);
                    while ($row_shop = $result_shop->fetch_assoc()) {
                        echo '<td class="px-2 py-1">' . htmlspecialchars($row_shop['provider_name']) . '</td>';
                        echo '<td class="px-2 py-1">' . htmlspecialchars($row_shop['provider_district']) . ',' . htmlspecialchars($row_shop['provider_upazila']) . ',' . htmlspecialchars($row_shop['provider_area']) . '</td>';
                    }
                    //fetching items
                    $item_id = $row['item_id'];
                    $sql_item = "select item_name from item where item_id='$item_id'";
                    $result_item = mysqli_query($con, $sql_item);
                    while ($row_item = $result_item->fetch_assoc()) {
                        echo '<td class="px-2 py-1">' . htmlspecialchars($row_item['item_name']) . '</td>';
                    }
                    // booking date and time
                    echo '<td class="px-2 py-1">' . htmlspecialchars($row['booking_date']) . '</td>';
                    echo '<td class="px-2 py-1">' . htmlspecialchars($row['booking_time']) . '</td>';

                    // expert details 
                    // $worker_id = $row['worker_id'];
                    // $sql_worker = "select worker_name,mobile_number from shop_worker where worker_id='$worker_id'";
                    // $result_worker = mysqli_query($con, $sql_worker);
                    // while ($row_worker = $result_worker->fetch_assoc()) {
                    //     echo '<td class="px-2 py-1">' . htmlspecialchars($row_worker['worker_name']) . '</td>';
                    //     echo '<td class="px-2 py-1">' . htmlspecialchars($row_worker['mobile_number']) . '</td>';
                    // }
                    //status
                    echo '<td class="px-2 py-1">' . htmlspecialchars(
                        $row['booking_status'] == 0
                            ? "pending"
                            : ($row['booking_status'] == 1
                                ? "submitted"
                                : "completed"
                            )
                    ) . '</td>';
                    // echo '<td class="px-4 py-2">' . htmlspecialchars($row['status']) . '</td>';
                    // echo '<td class="px-4 py-2">' . htmlspecialchars($row['status']) . '</td>';
                    echo '<td class="px-2 py-1">';
                    if ($row['booking_status'] == 2) {
                        echo '<button type="" name="confirm" class="text-blue-500">Confirmed</button>';
                    } else if ($row['user_end'] == 1) {
                        echo '<button type="" name="confirm" class="text-blue-500">submitted</button>';
                    } else {
                        // echo '<form onsubmit="return confirm(this)" action="mybooking.php" method="POST">';
                        echo '<form onsubmit="return confirm_completed(this)" action="mybooking.php" method="POST">';
                        echo '<input type="hidden" name="booking_id" value="' . $row['booking_id'] . '">';
                        echo '<button type="submit" name="confirm" class="text-red-500">Confirm?</button>';
                        echo '</form>';
                    }
                    echo '</td>';
                    //star
                    if ($row['booking_status'] == 2)
                        echo '<td class="px-2 py-1">' .
                            '<button type="submit" name="change" onclick="rating(\'' . $row['booking_id'] . '\')" style="padding: 0; border: none; background: none;margin-right:30px;">' .
                            '<img src="../photo/star.png" alt="Submit" style="width: 40px; height: 40px;">' .
                            '</button>' .
                            '</td>';
                    echo '<form onsubmit="return confirm_cancel(this)" action="" method="POST">';
                    echo '<input type="hidden" name="booking_id" value="' . $row['booking_id'] . '">';
                    echo '<td class="mr-5 px-0 py-1">' . '<button type="submit" name="cancel" style="padding: 0; border: none; background: none;"><img src="../photo/cancel.png" alt="Cancel" style="width: 40px; height: 40px; margin-right:50px;"></button>' . '</td>';
                    echo '</form>';
                }
                echo '</tbody>';
                echo '</table>';
                echo '</div>';
            } else {
                echo '<p class="text-gray-500">No bookings found.</p>';
            }
            ?>
        </div>
    </section>


    <div id="overlay" class="hidden fixed inset-0 bg-black opacity-80 z-40"></div>

    <!-- Modal Structure -->
    <div id="legal_notice" class="max-w-md mx-auto bg-white p-4 shadow-md z-50 fixed inset-0 m-auto hidden"
        style="width: 50%; height: fit-content;">
        <h2 class="text-xl font-semibold mb-4">Rate the Expert:</h2>
        <form action="" method="POST" id="ratingForm">
            <div class="mb-4">
                <label for="to" class="block text-sm font-medium">To:</label>
                <input type="text" id="to" name="To" required class="border border-gray-300 p-2 w-full" disabled>
                <input type="hidden" id="To" name="to">
                <textarea
                    id="review"
                    name="review"
                    rows="4"
                    required
                    class="border border-gray-300 p-2 w-full rounded focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                    placeholder="Write your review here..."></textarea>
            </div>

            <!-- Star Rating System -->
            <div class="flex mb-4">
                <span class="star w-6 h-6 text-gray-400 cursor-pointer" data-value="1">&#9733;</span>
                <span class="star w-6 h-6 text-gray-400 cursor-pointer" data-value="2">&#9733;</span>
                <span class="star w-6 h-6 text-gray-400 cursor-pointer" data-value="3">&#9733;</span>
                <span class="star w-6 h-6 text-gray-400 cursor-pointer" data-value="4">&#9733;</span>
                <span class="star w-6 h-6 text-gray-400 cursor-pointer" data-value="5">&#9733;</span>
            </div>

            <!-- Hidden Rating Input -->
            <input type="hidden" id="rating" name="rating" value="" required>

            <div class="flex justify-between">
                <button type="submit" class="bg-blue-500 text-white p-2 rounded" name="submit">Send</button>
                <button type="button" class="bg-red-500 text-white p-2 rounded" id="cancelBtn">Cancel</button>
            </div>
        </form>
    </div>

    <!-- CSS to Style the Stars and Modal -->
    <style>
        .star {
            font-size: 24px;
            cursor: pointer;
        }

        .text-yellow-500 {
            color: #FFD700;
            /* Gold color */
        }

        /* Modal & Overlay */
        #overlay {
            background-color: rgba(0, 0, 0, 0.5);
            /* Adjust for desired darkness */
        }

        .hidden {
            display: none;
        }
    </style>
    <!-- JavaScript for Modal and Form Handling -->
    <script>
        // Function to show the rating form
        function rating(booking_id) {
            document.getElementById('to').value = 'booking ID: ' + booking_id; // Display Shop ID in the disabled field
            document.getElementById('To').value = booking_id; // Hidden field for actual shop ID
            document.getElementById('legal_notice').style.display = 'block'; // Show modal
            document.getElementById('overlay').classList.remove('hidden'); // Show overlay
        }

        // Function to handle the cancel button
        function cancelEmail() {
            if (confirm('Are you sure you want to cancel?')) {
                // Clear the form
                document.getElementById('to').value = '';
                document.getElementById('To').value = '';
                document.getElementById('rating').value = '';

                // Hide modal and overlay
                document.getElementById('legal_notice').style.display = 'none';
                document.getElementById('overlay').classList.add('hidden');
            }
        }

        // Function to handle clicks outside of the modal
        window.onclick = function(event) {
            var legalNoticeDiv = document.getElementById('legal_notice');
            var overlayDiv = document.getElementById('overlay');
            if (event.target == overlayDiv) {
                legalNoticeDiv.style.display = 'none'; // Hide modal
                overlayDiv.classList.add('hidden'); // Hide overlay
            }
        }

        // Handling stars for rating
        document.addEventListener('DOMContentLoaded', () => {
            const stars = document.querySelectorAll('.star');
            const ratingInput = document.getElementById('rating');

            // Set up click event listener for each star
            stars.forEach(star => {
                star.addEventListener('click', () => {
                    const selectedRating = parseInt(star.getAttribute('data-value'));

                    // Update hidden input value
                    ratingInput.value = selectedRating;

                    // Reset all stars to gray
                    stars.forEach(s => s.classList.remove('text-yellow-500'));

                    // Highlight all stars up to the selected one
                    for (let i = 0; i < selectedRating; i++) {
                        stars[i].classList.add('text-yellow-500');
                    }
                });
            });
        });

        // Cancel button listener
        document.getElementById('cancelBtn').addEventListener('click', cancelEmail);

        // Form submission handler
        document.getElementById('ratingForm').addEventListener('submit', function(event) {
            const rating = document.getElementById('rating').value;
            if (rating === '') {
                alert('Please select a rating before submitting.');
                event.preventDefault(); // Stop form from submitting
            }
        });
    </script>


    <script>
        function confirm_completed(form) {
            event.preventDefault(); // Prevent the form from submitting immediately

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, confirm it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    const hiddenInput = document.createElement("input");
                    hiddenInput.setAttribute("type", "hidden");
                    hiddenInput.setAttribute("name", "confirm");
                    hiddenInput.setAttribute("value", "confirm");
                    form.appendChild(hiddenInput);

                    form.submit(); // Submit the form if confirmed
                }
            });
        }

        function confirm_cancel(form) {
            event.preventDefault(); // Prevent the form from submitting immediately

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, cancel order!'
            }).then((result) => {
                if (result.isConfirmed) {
                    const hiddenInput = document.createElement("input");
                    hiddenInput.setAttribute("type", "hidden");
                    hiddenInput.setAttribute("name", "cancel");
                    hiddenInput.setAttribute("value", "cancel");
                    form.appendChild(hiddenInput);

                    form.submit(); // Submit the form if confirmed
                }
            });
        }
    </script>
    <?php
    include '../footer.php';
    ?>
</body>

</html>