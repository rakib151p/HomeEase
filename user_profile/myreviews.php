<!-- <?php
require '../mysql_connection.php';
session_start();
// if (isset($_POST['change'])) {
//     echo 'change';
//     echo $_POST['booking_id'];
// }
if (isset($_POST['cancel'])) {
    $review_id = $_POST['review_id'];
    // echo $review_id;
    // Delete review from the database
    $sql_review = "DELETE FROM review_shop WHERE review_id='$review_id'";
    $result_review = mysqli_query($conn, $sql_review);
    if ($result_review) {
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>' . "<script>
        Swal.fire({
            icon: 'success',
            title: 'Deleted successfully.'
        });
        </script>";
    } else {
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>' . "<script>
        Swal.fire({
            icon: 'warning',
            title: 'Error deleting review.',
            text: 'Something went wrong.',
            confirmButtonText: 'OK'
        });
        </script>";
    }
}
// Fetching customer ID from the session
$customer_id = $_SESSION['customer_id'];

// Fetching the bookings of the logged-in customer
$query = "SELECT * FROM review_shop WHERE customer_id = ? ORDER BY date_and_time";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $customer_id);
$stmt->execute();
$result = $stmt->get_result();

?> -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Reviews</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        body {
            background-color: #F4F4F4;
            font-family: 'Inter', sans-serif;
        }

        .text-gray-700 {
            font-weight: bolder;
        }

        * {
            font-family: cursive;
        }

        .t {
            /* font-family: 'Times New Roman', Times, serif; */
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
            color:#00008B;
            margin-right: 40px;
        }



        #undernavbar {
            display: flex;
            border-radius: 20px;
            margin-bottom: 80px;
            margin-top: 50px;
            /* Increased margin-bottom for more space */
        }



        img {
            height: 100px;
            width: 140px;
            margin: 10px 0 0 60px;
        }

        #profile_edit {
            margin-left: 20px;
            margin-top: 2px;
            padding: 10px 0 0 8px;
            height: 300px;
            width: 300px;
            border-radius: 10px;
        }

        #tittlemnm {
            font-size: x-large;
            color:#00008B;
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
            color:#00008B;
            font-weight: 900;
            position: relative;
            bottom: 20px;
        }

        .tables {
            height: 400px;
            width: 1300px;
            position: relative;
            top: 30px;
            right: 100px;
            border-radius: 20px;
        }

        #name {
            margin: 0 0 0 670px;
        }



        .arrow {
            position: absolute;
            right: 100px;
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
            color:#00008B;
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
    </style>
</head>

<body class="bg-gradient-to-bl from-blue-50 via-white via-blue-50 to-slate-300 h-screen">

    <nav class="  h-20 w-full py-6 flex justify-between items-center top-0 left-0 z-20 px-6 md:px-16 lg:px-24 border-b-2 border-slate-300">
      <div class="text-2xl md:text-4xl font-bold flex items-center text-black">
        <a href="#" class="flex items-center gap-1">
          <span>HOME</span>
          <span class="text-blue-600">EASE</span>
        </a>
      </div>
   
      <div class="flex">
        <img src="photo\Home\add-user.png" class="h-6 mt-2">
        <a href="typeUser.php" class="text-base md:text-lg font-semibold px-2 py-2 hover:border-b-2 hover:border-blue-600 transition ease-in-out duration-500">
          Signup/Login
        </a>
      </div>
    </nav>

    <!-- <h2 id="tittlemnm">My Booking</h2> -->
    <section id="undernavbar">
        <div id="sidebar">
            <a href="" id="mma">Manage My Account</a>
            <ul>
            <li><a href="My_profile.php">My Profile</a></li>
                <li><a href="addressofbooking.php">Address of Booking</a></li>
                <li><a href="myreviews.php">My Reviews</a></li>
                <li><a href="message.php" id="mymessage">My Messages<?php if ($_SESSION['unseen'] > 0): ?>
                            <span class="unseen-count" style="color: red;">(<?php echo $_SESSION['unseen']; ?>)</span>
                        <?php endif; ?></a></li>
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
        <div id="box1">
            <h2 class="text-3xl font-bold text-pink-700 mb-6" style="color:#00008B;margin:10px 0 0 0;">My Reviews</h2>
            <?php
            if ($result->num_rows > 0) {
                echo '<div class="overflow-x-auto tables">';
                echo '<table class="min-w-full bg-white border border-gray-200 rounded-lg">';
                echo '<thead class="bg-blue-500 text-white">';
                echo '<tr>';
                echo '<th class="px-4 py-2 text-left">Serial</th>';
                echo '<th class="px-4 py-2 text-left">Service Provider</th>';
                echo '<th class="px-4 py-2 text-left">Provider Address</th>';
                echo '<th class="px-4 py-2 text-left">Review</th>';
                echo '<th class="px-4 py-2 text-left">Rating</th>';
                echo '<th class="px-4 py-2 text-left">Date & Time</th>';
                echo '<th class="px-4 py-2 text-center" colspan="2">Action</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody class="text-gray-700">';
                $cnt = 1;
                while ($row = $result->fetch_assoc()) {
                    echo '<tr class="border-t">';
                    echo '<td class="px-4 py-2">' . $cnt++ . '</td>';
                    // Fetching shop details
                    $shop_id = $row['shop_id'];
                    $sql_shop = "SELECT shop_name, shop_state, shop_city, shop_area FROM barber_shop WHERE shop_id='$shop_id'";
                    $result_shop = mysqli_query($conn, $sql_shop);
                    while ($row_shop = $result_shop->fetch_assoc()) {
                        echo '<td class="px-4 py-2">' . htmlspecialchars($row_shop['shop_name']) . '</td>';
                        echo '<td class="px-4 py-2">' . htmlspecialchars($row_shop['shop_state']) . ', ' . htmlspecialchars($row_shop['shop_city']) . ', ' . htmlspecialchars($row_shop['shop_area']) . '</td>';
                    }
                    echo '<td class="px-4 py-2">' . htmlspecialchars($row['review']) . '</td>';
                    echo '<td class="px-4 py-2">' . htmlspecialchars($row['star']) . '</td>';
                    echo '<td class="px-4 py-2">' . htmlspecialchars($row['date_and_time']) . '</td>';
                    // Action buttons
                    // Change button in a separate 
                    // echo '<td class="px-2 py-1">';
                    // echo '<button type="submit" name="change" class="text-blue-500">Change</button>';
                    // echo '</td>';
                    // Delete button in a separate form
                    echo '<td class="px-2 py-1">';
                    echo '<form onsubmit="confirmDelete(this)" action="myreviews.php" method="POST">';
                    echo '<input type="hidden" name="review_id" value="' . $row['review_id'] . '">';
                    echo '<button type="submit" name="cancel" class="text-red-500">Delete</button>';
                    echo '</form>';
                    echo '</td>';

                    echo '</tr>';
                }
                echo '</tbody>';
                echo '</table>';
                echo '</div>';
            } else {
                echo '<p class="text-gray-500">No reviews found.</p>';
            }
            ?>
        </div>

    </section>

    <script>
        function confirmDelete(form) {
            event.preventDefault(); // Prevent the form from submitting immediately

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    const hiddenInput = document.createElement("input");
                    hiddenInput.setAttribute("type", "hidden");
                    hiddenInput.setAttribute("name", "cancel");
                    hiddenInput.setAttribute("value", "Delete");
                    form.appendChild(hiddenInput);

                    form.submit(); // Submit the form if confirmed
                }
            });
        }
    </script>
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