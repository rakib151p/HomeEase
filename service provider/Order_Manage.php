<?php
session_start();
include '../config.php';
// Fetching customer ID from the session
$customer_id = $_SESSION['provider_id'];
//button functionality
if (isset($_POST['confirm'])) {
    // echo 'Put the star';
    $booking_id = $_POST['booking_id'];
    $sql_booking = "SELECT * FROM booking WHERE booking_id='$booking_id' AND STR_TO_DATE(CONCAT(booking_date, ' ', booking_time), '%Y-%m-%d %h:%i %p') < NOW();";
    $result_booking = mysqli_query($con, $sql_booking);
    if ($row_booking = $result_booking->fetch_assoc()) {
        // echo 'check';
        // Prepare the statement
        $stmt = $con->prepare("UPDATE `booking` SET `provider_end` = 1 , `booking_status`=1 WHERE `booking_id` = ?");
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
        if ($interval->days >= 1 && $interval->h >= 4) {
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

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomeEase Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-blue-50 font-sans">
    <?php
    include 'header.php';
    ?>
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-md flex flex-col p-4">
        <div class="flex flex-col items-center">
                <div class="bg-blue-200 rounded-full w-24 h-24 flex items-center justify-center overflow-hidden">
                    <img src="../photo/profile_pictures/<?php echo $_SESSION['provider_profile_picture']; ?>" alt="Profile Picture" class="w-full h-full object-cover">
                </div>
                <h2 class="mt-4 font-semibold text-lg"><?php echo $_SESSION['provider_name'];?></h2>
                <p class="text-sm text-gray-500">Provider ID: <?php echo $_SESSION['provider_id'];?></p>
            </div>

            <nav class="mt-8 space-y-4">
                <a href="dashboard.php" class="flex items-center px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-md">
                    <span class="material-icons mr-3">Dashboard</span>
                </a>
                <a href="profile.php" class="flex items-center px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-md">
                    <span class="material-icons mr-3">Profile</span>
                </a>
                <a href="" class="flex items-center px-4 py-2 text-blue-600 bg-blue-100 rounded-md">
                    <span class="material-icons mr-3">Order Manage</span>
                </a>
                <a href="order_history.php" class="flex items-center px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-md">
                    <span class="material-icons mr-3">History</span>
                </a>
                <a href="Myreviews.php" class="flex items-center px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-md">
                    <span class="material-icons mr-3">My reviews</span>
                </a>
                <a href="Notification.php" class="flex items-center px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-md">
                    <span class="material-icons mr-3">Notifications</span>
                </a>
                <a href="../logout.php" class="flex items-center px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-md">
                    <span class="material-icons mr-3">Log Out</span>
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6">
            <div class="flex justify-end gap-2">
                <input id="dateFilter" type="date" class="border rounded-lg p-2 text-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Select Date" />
                <button id="searchButton" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition duration-200">Search</button>
            </div>

            <span class="text-4xl ml-[470px]"><span class="text-blue-700 font-bold text-4xl">Ordered Manage By</span> Service provider</span>
            <!-- Main Content -->
            <main class="flex-1 w-full p-6 flex flex-col items-center justify-center mt-16">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8" id="bookingCards">
                    <!-- Card 1 -->

                    <!-- dynamic creation of cards  -->
                    <?php
                    // echo 'check';
                    $provider_id = $_SESSION['provider_id']; // Replace with dynamic provider_id if required
                    $query = "SELECT b.booking_id,b.booking_date, b.booking_time, b.task_details,b.task_length, b.booking_status, 
                                        u.user_name,u.user_district,u.user_upazila, u.user_area,u.user_street_address, u.user_unit_apt,
                                         s.item_name 
                                FROM booking b
                                JOIN user u ON b.user_id = u.user_id
                                JOIN item s ON b.item_id = s.item_id
                                WHERE b.provider_id = ?
                                ORDER BY b.booking_date";
                    $stmt = $con->prepare($query);
                    $stmt->bind_param('i', $provider_id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if ($result->num_rows > 0) {
                        while ($booking = $result->fetch_assoc()) {
                            $booking_id = $booking['booking_id'];
                            $booking_date = $booking['booking_date'];
                            $customer_name = $booking['user_name'];
                            $customer_address = $booking['user_district'] . ',' . $booking['user_upazila'] . ',' . $booking['user_area'] . ',' . $booking['user_street_address'] . ',' . $booking['user_unit_apt'];
                            $service_item = $booking['item_name'];
                            $task_details = $booking['task_details'];
                            $appointment_time = $booking['booking_time'];
                            $status = $booking['booking_status'];
                            $status_label = ($status == 0) ? 'Pending' : (($status == 1) ? 'Confirmed' : (($status == 2) ? 'Completed' : 'Cancelled'));

                            echo "<div>";
                            //divided the block based on appointment time
                            if ($appointment_time == '08:00 AM') {
                                echo '<div class="text-2xl text-center font-bold bg-gradient-to-br from-blue-50 via-white to-blue-100 border-2 border-slate-300  shadow-lg rounded-lg p-6 flex flex-col justify-between transform hover:scale-105 transition duration-300">
                                        Slot-1
                                      </div>';
                            } else if ($appointment_time == '12:00 AM') {
                                echo '<div class="text-2xl text-center font-bold bg-gradient-to-br from-blue-50 via-white to-blue-100 border-2 border-slate-300  shadow-lg rounded-lg p-6 flex flex-col justify-between transform hover:scale-105 transition duration-300">
                                        Slot-2
                                      </div>';
                            } else {
                                echo '<div class="text-2xl text-center font-bold bg-gradient-to-br from-blue-50 via-white to-blue-100 border-2 border-slate-300  shadow-lg rounded-lg p-6 flex flex-col justify-between transform hover:scale-105 transition duration-300">
                                        Slot-3
                                      </div>';
                            }
                            echo '<div class=" border-2 border-slate-300 mt-4 bg-gradient-to-br from-blue-50 via-white to-blue-100 h-[430px] w-[390px] shadow-2xl rounded-2xl p-6 flex flex-col justify-between transform hover:scale-105 transition duration-300 hover:shadow-blue-300">
                            <div class="grid gap-4">
                                <!-- Title Section -->
                                <div class="flex items-center gap-2">
                                    <div class="h-10 w-10 bg-blue-500 text-white rounded-full flex items-center justify-center">
                                        <span class="text-xl font-bold">B</span>
                                    </div>
                                    <h2 class="text-3xl font-bold text-gray-700">Booking Details</h2>
                                </div>

                                <!-- Booking Info -->
                                <div class="space-y-2">
                                    <p class="text-lg text-gray-700 flex items-center">
                                        <span class="font-bold w-32">Booking Date:</span>
                                        <span class="booking-date text-gray-600">' . date('Y-m-d', strtotime($booking['booking_date'])) . '</span>
                                    </p>
                                    <p class="text-lg text-gray-700 flex items-center">
                                        <span class="font-bold w-32">Customer:</span>
                                        <span class="text-gray-600">' . $customer_name . '</span>
                                    </p>
                                    <p class="text-lg text-gray-700 flex items-center">
                                        <span class="font-bold w-32">Address:</span>
                                        <span class="text-gray-600">' . $customer_address . '</span>
                                    </p>
                                    <p class="text-lg text-gray-700 flex items-center">
                                        <span class="font-bold w-32">Service Item:</span>
                                        <span class="text-gray-600">' . $service_item . '</span>
                                    </p>
                                    <p class="text-lg text-gray-700 flex items-center">
                                        <span class="font-bold w-32">Task details:</span>
                                        <span class="text-gray-600">' . $task_details . '</span>
                                    </p>
                                    <p class="text-lg text-gray-700 flex items-center">
                                        <span class="font-bold w-32">Time:</span>
                                        <span class="text-gray-600">' . $appointment_time . '</span>
                                    </p>
                                    <p class="text-lg text-gray-700 flex items-center">
                                        <span class="font-bold w-32">Status:</span>
                                        <span class="text-yellow-500 font-semibold">' . $status_label . '</span>
                                    </p>
                                </div>
                            </div>';

                            // <!-- Buttons Section -->
                            if ($status_label == "Completed") {
                                echo '<button class="bg-green-500 hover:bg-green-600 text-white py-2 px-6 rounded-xl shadow-lg transition transform hover:scale-105">
                                            Completed
                                        </button>';
                            } else if ($status_label == "Cancelled") {
                                echo '<button class="bg-green-500 hover:bg-green-600 text-white py-2 px-6 rounded-xl shadow-lg transition transform hover:scale-105">
                                            Cancelled
                                        </button>';
                            } else {
                                echo '<div class="mt-6 flex justify-between">
                               <form onsubmit="return confirm_completed(this)" action="" method="POST">
                                <input type="hidden" name="booking_id" value="' . $booking_id . '">
                                <button name="confirm" class="bg-green-500 hover:bg-green-600 text-white py-2 px-6 rounded-xl shadow-lg transition transform hover:scale-105">
                                    Confirm
                                </button>
                                </form>
                                <form onsubmit="return confirm_completed(this)" action="" method="POST">
                                <input type="hidden" name="booking_id" value="' . $booking_id . '">
                                <button name="cancel" class="bg-red-500 hover:bg-red-600 text-white py-2 px-6 rounded-xl shadow-lg transition transform hover:scale-105">
                                    Cancel
                                </button>
                                </form>
                                
                            </div>';
                            }
                            echo '</div>';
                            echo "</div>";
                        }
                    } else {
                        echo '<p class="text-center text-gray-500">No bookings found!</p>';
                    }
                    ?>
                </div>
            </main>

            <script>
                // document.getElementById("searchButton").addEventListener("click", function() {
                //     const selectedDate = document.getElementById("dateFilter").value;
                //     alert(selectedDate);
                //     const cards = document.querySelectorAll("#bookingCards > div");
                //     cards.forEach(card => {
                //         const cardDate = card.querySelector(".booking-date").textContent;
                //         alert(cardDate);
                //         card.style.display = cardDate === selectedDate ? "block" : "none";
                //     });
                // });
                // DOM
                document.addEventListener("DOMContentLoaded", function() {
                    const today = new Date().toISOString().split('T')[0];
                    document.getElementById("dateFilter").value = today;
                    filterBookings(today);
                });

                document.getElementById("searchButton").addEventListener("click", function() {
                    const selectedDate = document.getElementById("dateFilter").value;
                    filterBookings(selectedDate);
                });

                function filterBookings(date) {
                    const cards = document.querySelectorAll("#bookingCards > div");
                    cards.forEach(card => {
                        const cardDate = card.querySelector(".booking-date").textContent;
                        card.style.display = cardDate === date ? "block" : "none";
                    });
                }
            </script>
    </div>

    </main>
    </div>

</body>

</html>