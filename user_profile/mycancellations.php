<?php
session_start();

require '../config.php';
// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cancel_booking'])) {
    $booking_id = intval($_POST['booking_id']);

    // Update booking status to -1 (Canceled)
    $update_query = "UPDATE booking SET booking_status = '-1' WHERE booking_id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("i", $booking_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "<script>alert('Service has been canceled successfully!');</script>";
    } else {
        echo "<script>alert('Failed to cancel the service.');</script>";
    }

    $stmt->close();
}

// Fetch canceled services
$query = "
    SELECT b.booking_id, b.booking_time, b.booking_date, b.task_details, s.service_name, s.service_details, s.service_picture
    FROM booking b
    JOIN service s ON b.item_id = s.service_id
    WHERE b.booking_status = '-1'
";
$result = $con->query($query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My cancellations</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
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
            width: 1300px;
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

        footer {
            background-color: #2D3748;
            color: #F7FAFC;
            padding: 20px;
            width: 100vw;
        }

        footer a {
            color: #E2E8F0;
            transition: color 0.3s;
        }

        footer a:hover {
            color: #00008B;
        }

        footer .grid div {
            margin-bottom: 20px;
        }

        footer .grid div h3 {
            font-size: 1.25rem;
            margin-bottom: 10px;
        }

        footer .grid div p {
            color: #A0AEC0;
        }

        footer .grid div ul li a {
            color: #A0AEC0;
        }

        /* button {
            height: 15px;
            text-align: center;
        } */

        #B {
            font-size: larger;
            font-weight: bolder;
        }

        #name {
            margin: 0 0 0 670px;
        }

        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .container {
            margin-top: 50px;
        }

        .card {
            margin-bottom: 20px;
        }

        .card-img-top {
            height: 200px;
            object-fit: cover;
        }
    </style>
</head>

<body class="bg-gradient-to-bl from-blue-50 via-white via-blue-50 to-slate-300 h-screen">

    <?php
    include 'header.php';
    ?>
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
                echo '<a href="../logout.php" class="text-gray-700 hover:text-blue-600 " style="font-size:30px;margin:10px 0 0 20px; line-height:50px;">Logout</a>';
            }
            ?>
        </div>
        <div class="container">
        <h1 class="text-left mb-4" style="
    font-size: 2.5rem;
    font-weight: bold;
    color: #3a1c71;
    text-shadow: 2px 2px 4px rgba(58, 28, 113, 0.3);
    border-left: 8px solid #d76d77;
    padding-left: 15px;
    background: linear-gradient(to right, #ffaf7b, #d76d77, #3a1c71);
    -webkit-background-clip: text;
    color: transparent; /* Fallback color */
    background-clip: text;
">
    Canceled Services
</h1>


            <!-- Display canceled services -->
            <?php if ($result->num_rows > 0): ?>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered" style="border-collapse: separate; border-spacing: 0; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); border-radius: 10px; overflow: hidden;">
                        <thead style="background: linear-gradient(to right, #3a1c71, #d76d77, #ffaf7b); color: white; text-transform: uppercase;">
                            <tr>
                                <th style="text-align: center; padding: 15px;">#</th>
                                <th style="text-align: left; padding: 15px;">Service Name</th>
                                <th style="text-align: left; padding: 15px;">Service Details</th>
                                <th style="text-align: center; padding: 15px;">Booking Date</th>
                                <th style="text-align: center; padding: 15px;">Booking Time</th>
                                <th style="text-align: left; padding: 15px;">Task Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $index = 1; // Row numbering
                            while ($row = $result->fetch_assoc()):
                            ?>
                                <tr style="background: <?= $index % 2 == 0 ? '#f3f4f6' : '#ffffff'; ?>;">
                                    <td style="text-align: center; font-weight: bold; padding: 15px;"><?= $index++ ?></td>
                                    <td style="text-align: left; padding: 15px;"><?= htmlspecialchars($row['service_name']) ?></td>
                                    <td style="text-align: left; padding: 15px;"><?= htmlspecialchars($row['service_details']) ?></td>
                                    <td style="text-align: center; padding: 15px;"><?= htmlspecialchars($row['booking_date']) ?></td>
                                    <td style="text-align: center; padding: 15px;"><?= htmlspecialchars($row['booking_time']) ?></td>
                                    <td style="text-align: left; padding: 15px;"><?= htmlspecialchars($row['task_details']) ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="alert alert-info text-center" style="margin-top: 20px;">
                    No canceled services found.
                </div>
            <?php endif; ?>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>

</section>



<footer class="bg-gray-800 text-white py-10 mt-12">
    <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-8 px-6">
        <!-- Logo and Description -->
        <div class="space-y-4">
            <div class="flex items-center space-x-2">
                <img src="https://img.icons8.com/external-flatart-icons-outline-flatarticons/64/external-logo-business-and-team-flatart-icons-outline-flatarticons.png"
                    alt="Logo" class="w-8 h-8">
                <span class="text-xl font-semibold">HomeEase</span>
            </div>
            <p class="text-gray-400 text-sm">
                Demandium is the best on-demand business solution that connects customers and service providers in a single
                platform. Purchase the Demandium source code and get started.
            </p>
            <!-- Social Icons -->
            <div class="flex space-x-4">
                <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-linkedin-in"></i></a>
                <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-twitter"></i></a>
                <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-youtube"></i></a>
            </div>
            <!-- Codecanyon Badge -->
            <div class="mt-4">
                <a href="#" class="bg-gray-700 text-white text-sm py-2 px-4 rounded-lg inline-flex items-center">
                    <img src="https://img.icons8.com/ios-filled/24/ffffff/code.png" class="mr-2" />
                    GET IT ON Codecanyon
                </a>
            </div>
        </div>

        <!-- Company Links -->
        <div>
            <h3 class="text-white font-semibold mb-4">Company</h3>
            <ul class="space-y-2 text-gray-400 text-sm">
                <li><a href="#" class="hover:text-white">About Us</a></li>
                <li><a href="#" class="hover:text-white">Contact Us</a></li>
                <li><a href="#" class="hover:text-white">Privacy Policy</a></li>
                <li><a href="#" class="hover:text-white">Service & Support Policy</a></li>
                <li><a href="#" class="hover:text-white">Cookies Policy</a></li>
                <li><a href="#" class="hover:text-white">Blog</a></li>
            </ul>
        </div>

        <!-- Quick Links -->
        <div>
            <h3 class="text-white font-semibold mb-4">Quick Links</h3>
            <ul class="space-y-2 text-gray-400 text-sm">
                <li><a href="#" class="hover:text-white">Demo</a></li>
                <li><a href="#" class="hover:text-white">Documentation</a></li>
                <li><a href="#" class="hover:text-white">Community</a></li>
                <li><a href="#" class="hover:text-white">Support</a></li>
                <li><a href="#" class="hover:text-white">FAQs</a></li>
            </ul>
        </div>

        <!-- Contact Information -->
        <div>
            <h3 class="text-white font-semibold mb-4">Contact Us</h3>
            <ul class="space-y-2 text-gray-400 text-sm">
                <li class="flex items-center space-x-2">
                    <span class="text-green-500"><i class="fas fa-phone"></i></span>
                    <span>+8801325887797</span>
                </li>
                <li class="flex items-center space-x-2">
                    <span class="text-blue-500"><i class="fas fa-envelope"></i></span>
                    <span>support@6amtech.com</span>
                </li>
            </ul>
            <div class="mt-4">
                <a href="#" class="inline-flex items-center bg-blue-600 text-white text-sm py-2 px-4 rounded-lg hover:bg-blue-700">
                    Support Ticket →
                </a>
            </div>
        </div>
    </div>
</footer>





</body>

</html>