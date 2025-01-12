
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My bookings</title>
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
            color:#00008B;
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
        img {
            height: 100px;
            width: 140px;
            margin: 10px 0 0 60px;
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

    <!-- <h2 id="tittlemnm">My Booking</h2> -->
    <section id="undernavbar">
        <div id="sidebar">
            <a href="" id="mma">Manage My Account</a>
            <ul>
            <li><a href="My_profile.php">My Profile</a></li>
                <li><a href="addressofbooking.php">Address of Booking</a></li>
                <li><a href="myreviews.php">My Reviews</a></li>
                <li><a href="message.php" id="mymessage">My Messages</a></li>
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
                echo '<th class="px-2 py-1 text-left">Status</th>';
                echo '<th class="px-2 py-1 text-left" colspan="3">Action</th>';

                echo '</tr>';
                echo '</thead>';
                echo '<tbody class="text-gray-700">';
                while ($row = $result->fetch_assoc()) {

                    echo '<tr class="border-t">';
                    echo '<td class="px-2 py-1">' . htmlspecialchars($row['when_booked']) . '</td>';
                    //fetching shops
                    $shop_id = $row['shop_id'];
                    $sql_shop = "select shop_name, shop_state, shop_city, shop_area from barber_shop where shop_id='$shop_id'";
                    $result_shop = mysqli_query($conn, $sql_shop);
                    while ($row_shop = $result_shop->fetch_assoc()) {
                        echo '<td class="px-2 py-1">' . htmlspecialchars($row_shop['shop_name']) . '</td>';
                        echo '<td class="px-2 py-1">' . htmlspecialchars($row_shop['shop_state']) . ',' . htmlspecialchars($row_shop['shop_city']) . ',' . htmlspecialchars($row_shop['shop_area']) . '</td>';
                    }
                    //fetching items
                    $item_id = $row['item_id'];
                    $sql_item = "select item_name from item_table where item_id='$item_id'";
                    $result_item = mysqli_query($conn, $sql_item);
                    while ($row_item = $result_item->fetch_assoc()) {
                        echo '<td class="px-2 py-1">' . htmlspecialchars($row_item['item_name']) . '</td>';
                    }
                    // booking date and time
                    echo '<td class="px-2 py-1">' . htmlspecialchars($row['date']) . '</td>';
                    echo '<td class="px-2 py-1">' . htmlspecialchars($row['booking_time']) . '</td>';

                    // expert details 
                    $worker_id = $row['worker_id'];
                    $sql_worker = "select worker_name,mobile_number from shop_worker where worker_id='$worker_id'";
                    $result_worker = mysqli_query($conn, $sql_worker);
                    while ($row_worker = $result_worker->fetch_assoc()) {
                        echo '<td class="px-2 py-1">' . htmlspecialchars($row_worker['worker_name']) . '</td>';
                        echo '<td class="px-2 py-1">' . htmlspecialchars($row_worker['mobile_number']) . '</td>';
                    }
                    //status
                    echo '<td class="px-2 py-1">' . htmlspecialchars($row['status']) . '</td>';
                    // echo '<td class="px-4 py-2">' . htmlspecialchars($row['status']) . '</td>';
                    // echo '<td class="px-4 py-2">' . htmlspecialchars($row['status']) . '</td>';
                    echo '<td class="px-2 py-1">';
                    if ($row['status'] == "completed") {
                        echo '<button type="" name="confirm" class="text-blue-500">Confirmed</button>';
                    } else if ($row['customer_end'] == 1) {
                        echo '<button type="" name="confirm" class="text-blue-500">submitted</button>';
                    } else {
                        // echo '<form onsubmit="return confirm(this)" action="mybooking.php" method="POST">';
                        echo '<form onsubmit="return confirm_completed(this)" action="mybooking.php" method="POST">';
                        echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
                        echo '<button type="submit" name="confirm" class="text-red-500">Confirm?</button>';
                        echo '</form>';
                    }
                    echo '</td>';
                    //star
                    echo '<td class="px-2 py-1">' .
                        '<button type="submit" name="change" onclick="rating(\'' . $row['id'] . '\')" style="padding: 0; border: none; background: none;margin-right:30px;">' .
                        '<img src="../image/icon/star.png" alt="Submit" style="width: 40px; height: 40px; position:relative; right:56px;">' .
                        '</button>' .
                        '</td>';
                    echo '<form onsubmit="return confirm_cancel(this)" action="" method="POST">';
                    echo '<input type="hidden" name="booking_id" value="' . $row['id'] . '">';
                    echo '<td class="mr-5 px-0 py-1">' . '<button type="submit" name="cancel" style="padding: 0; border: none; background: none;"><img src="../image/icon/cancel.png" alt="Cancel" style="width: 40px; height: 40px;position:relative; right:60px;"></button>' . '</td>';
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
        window.onclick = function (event) {
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
        document.getElementById('ratingForm').addEventListener('submit', function (event) {
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