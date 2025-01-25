<?php
include '../config.php';

$searchEmail = isset($_GET['email']) ? $_GET['email'] : '';

$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$limit = 50;  // Maximum records per page
$offset = ($page - 1) * $limit;  // Calculate offset

// Prepare SQL query to search by email (using LIKE) in the user table
$sql = "SELECT * FROM `user` WHERE `user_email` LIKE '%$searchEmail%' LIMIT $limit OFFSET $offset";
$result = mysqli_query($con, $sql);

// Count total records for pagination
$total_sql = "SELECT COUNT(*) FROM `user` WHERE `user_email` LIKE '%$searchEmail%'";
$total_result = mysqli_query($con, $total_sql);
$total_records = mysqli_fetch_array($total_result)[0];
$total_pages = ceil($total_records / $limit);

// Update user status
if (isset($_GET['user_id']) && isset($_GET['status'])) {
    $id = $_GET['user_id'];
    $status = $_GET['status'] == 1 ? 0 : 1;

    $update_sql = "UPDATE user SET u_status='$status' WHERE user_id=$id";
    $update_result = mysqli_query($con, $update_sql);

    if ($update_result) {
        header('Location: manage_user.php');
        exit();
    } else {
        echo "Error updating user status!";
    }
}

// Handling notification posting
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['submit'])) {
        // Get the form values
        $to = mysqli_real_escape_string($con, $_POST['to']);
        $subject = mysqli_real_escape_string($con, $_POST['subject']);
        $message = mysqli_real_escape_string($con, $_POST['message']);

        // Insert notification into the notifications table
        $legal_sql = "INSERT INTO notifications_by_admin (user_id, message, date_time, subject) 
                      VALUES ('$to', '$message', NOW(), '$subject')";

        // Execute the query
        if (mysqli_query($con, $legal_sql)) {
            echo "Notification inserted successfully!";
        } else {
            echo "Error: " . mysqli_error($con); // Output the error if any
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upstats Dashboard</title>
    <!-- <link rel="stylesheet" href="manage_customer.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            background-color: #00014E;
            width: 250px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .logo {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .logo img {
            width: 40px;
            height: 40px;
            margin-right: 10px;
        }

        .logo h1 {
            font-size: 20px;
            font-weight: bold;
            margin: 0;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar li {
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }

        .sidebar li img {
            width: 20px;
            height: 20px;
            margin-right: 10px;
        }

        .sidebar li a {
            text-decoration: none;
            /* color: #333; */
            font-weight: bold;
        }

        .main-content {
            flex: 1;
            /* padding: 20px; */
        }

        .header {
            display: flex;
            background-color: #00E081;
            color: white;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            width: 1625px;
            box-shadow: 1px 1px 5px 3px rgba(0, 0, 0, 0.1);
            /* border:1px solid black; */
            height: 100px;
        }

        .header h2 {
            font-size: 24px;
            font-weight: bold;
            margin: 0;
        }

        .pagination a {
            padding: 5px 10px;
            background-color: #ddd;
            margin: 0 5px;
            border-radius: 5px;
            text-decoration: none;
        }

        .pagination a.active {
            background-color: #00E081;
            color: white;
        }

        .modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 1;
            /* Sit on top */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            background-color: rgba(0, 0, 0, 0.7);
            /* Black background with opacity */
            overflow: auto;
        }

        /* Modal Content/Box */
        .modal-content {
            background-color: white;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 60%;
            /* Could be more or less, depending on screen size */
            border-radius: 8px;
        }

        .search-form input {
            padding: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .search-form button {
            padding: 5px 10px;
            background-color: #00E081;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        /* Close button */
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: #fff;
            margin: 15% auto;
            padding: 20px;
            border-radius: 8px;
            width: 300px;
            text-align: center;
        }

        .modal-header,
        .modal-footer {
            margin-bottom: 10px;
        }

        .modal-footer {
            display: flex;
            justify-content: space-between;
        }

        * {
            font-family: cursive;
        }

        #legal_notice {
            display: none;
            position: fixed;
            top: 50%;
            left: 35%;
            transform: translate(-50%, -50%);
            z-index: 1000;
            /* Ensures it's on top of other elements */
            background-color: white;
            padding: 20px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.5);
            border-radius: 8px;
        }

        #legal_notice-overlay {
            display: none;
            /* Initially hidden */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            /* Darken background when modal is open */
            z-index: 999;
            /* Ensure it's behind the modal */
        }
    </style>
</head>

<body>
    <div class="container flex">
        <div class="sidebar bg-white p-4 shadow-md">
            <div class="logo flex items-center mb-4">
                <!-- <img src="logo.png" alt="Upstats Logo" class="w-10 h-10 mr-2"> -->
                <h1 style="color:rgb(211, 106, 124);font-size:38px;"><a href="../home.php"> HOMEEASE</a></h1>
            </div>
            <ul class="list-none p-5">
                <div class="hover:bg-pink-500 p-3 transition-colors duration-300 rounded-lg"><a href="index.php"
                        style="color:white;font-size:20px;">Dashboard</a></div>
                <div class="hover:bg-pink-500 p-3 transition-colors duration-300 rounded-lg"><a href="manage_shops.php"
                        style="color:white;font-size:20px;">Manage shops</a></div>
                <div class="hover:bg-pink-500 p-3 transition-colors duration-300 rounded-lg"><a href="manage_customer.php"
                        style="color:white;font-size:20px;">Manage customer</a> </div>
                <div class="hover:bg-pink-500 p-3 transition-colors duration-300 rounded-lg"><a href="check_Report.php"
                        style="color:white;font-size:20px;">Check Reports</a></div>
                <div class="hover:bg-pink-500 p-3 transition-colors duration-300 rounded-lg"><a href="Managed_legal_notice.php"
                        style="color:white;font-size:20px;">Managed legal notice</a></div>

            </ul>
        </div>
        <div class="main-content p-4 flex-1">
            <div class="header flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold" style="margin:0 0 0 40px;">Manage Customer</h2>
                <div class="notification flex items-center" style="margin-right:40px;">
                    <img src="1-change1.jpg" alt="Notification Icon" class="w-8 h-8 rounded-full mr-2">
                    <span class="text-gray-500 mr-2">HomeEase</span>
                    <h3 class="text-base font-bold">Admin</h3>
                </div>
            </div>


            <!-- Search Form -->
            <form class="search-form mb-4" method="GET" action="">
                <input type="text" name="email" placeholder="Search by email or Shop ID"
                    value="<?php echo htmlspecialchars($searchEmail); ?>">
                <button type="submit">Search</button>
            </form>
            <!-- Start Shop Details Table -->




            <!-- Modal Structure   for Shop details -->
            <!-- Modal Structure for Shop details -->
            <div id="userModal" class="modal" style="display: none;"> <!-- Changed ID to userModal -->
                <div class="modal-content">
                    <span class="close" style="cursor: pointer;">&times;</span> <!-- Ensure this has the class 'close' -->
                    <h2 style="text-align:center;font-size:30px;font-weight:900;">User Details</h2>
                    <div class="user-info-container">
                        <!-- User Information -->
                        <div class="user-info">
                            <p><strong>User Name:</strong> <span id="user_name"></span></p>
                            <p><strong>Gender:</strong> <span id="user_gender"></span></p>
                            <p><strong>Phone Number:</strong> <span id="user_phone"></span></p>
                            <p><strong>Status:</strong> <span id="u_status"></span></p>
                        </div>
                        <!-- Contact Information -->
                        <div class="contact-info">
                            <p><strong>Email:</strong> <span id="user_email"></span></p>
                            <p><strong>Password:</strong> <span id="user_password"></span></p> <!-- Optionally hide or encrypt -->
                        </div>
                        <!-- Address Information -->
                        <div class="address-info">
                            <p><strong>Address:</strong> <span id="user_address"></span></p>
                            <p><strong>District:</strong> <span id="user_district"></span></p>
                            <p><strong>Upazila:</strong> <span id="user_upazila"></span></p>
                            <p><strong>Area:</strong> <span id="user_area"></span></p>
                            <p><strong>Street Address:</strong> <span id="user_street_address"></span></p>
                            <p><strong>Unit/Apt:</strong> <span id="user_unit_apt"></span></p>
                        </div>
                        <!-- Registration and Profile -->
                        <div class="registration-info">
                            <p><strong>Registration Date:</strong> <span id="user_registration_date"></span></p>
                        </div>
                    </div>
                </div>
            </div>



            <table class="table-auto w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border border-gray-300 p-2">User ID</th>
                        <th class="border border-gray-300 p-2">User Name</th>
                        <th class="border border-gray-300 p-2">Email</th>
                        <th class="border border-gray-300 p-2">Phone Number</th>
                        <th class="border border-gray-300 p-2">Gender</th>
                        <th class="border border-gray-300 p-2">District</th>
                        <th class="border border-gray-300 p-2">Status</th>
                        <th colspan="5" class="border border-red-300 p-2 bg-blue-500">Take actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td class='border border-gray-300 p-2'>{$row['user_id']}</td>";
                            echo "<td class='border border-gray-300 p-2'>{$row['user_name']}</td>";
                            echo "<td class='border border-gray-300 p-2'>{$row['user_email']}</td>";
                            echo "<td class='border border-gray-300 p-2'>{$row['user_phone']}</td>";
                            echo "<td class='border border-gray-300 p-2'>{$row['user_gender']}</td>";
                            echo "<td class='border border-gray-300 p-2'>{$row['user_district']}</td>";
                            echo "<td class='border border-gray-300 p-2'>";
                            if ($row['u_status'] == 1) {
                                // For 'Active' status, green button
                                echo "<button class='bg-green-500 text-white font-bold py-1 px-3 rounded'>Active</button>";
                            } else {
                                // For 'Inactive' status, red button
                                echo "<button class='bg-red-500 text-white font-bold py-1 px-3 rounded'>Inactive</button>";
                            }
                            echo "</td>";

                            // View button with data attributes
                            echo "<td class='border border-gray-300 p-2'>
                    <button class='view-btn bg-blue-900 text-white font-bold py-1 px-3 rounded' 
                        data-id='{$row['user_id']}' 
                        data-name='{$row['user_name']}' 
                        data-email='{$row['user_email']}' 
                        data-phone='{$row['user_phone']}' 
                        data-gender='{$row['user_gender']}' 
                        data-registrationdate='{$row['user_registration_date']}' 
                        data-district='{$row['user_district']}' 
                        data-upazilla='{$row['user_upazila']}' 
                        data-area='{$row['user_area']}'>View</button>
                    </td>";

                            // Legal notice button
                            echo "<td class='border border-gray-300 p-2'>
                    <button class='legal-notice-btn bg-blue-500 text-white font-bold py-1 px-3 rounded' 
                            onclick='showLegalNotice({$row['user_id']})'>
                        Legal Notice
                    </button>
                </td>";

                            // Terminate/Reactive link with proper PHP echo
                            echo "<td class='border border-gray-300 p-2'>
                    <a href='#' 
                       onclick='confirmTermination({$row['user_id']}, {$row['u_status']})'
                       class='" . ($row['u_status'] == 1 ? "bg-green-500" : "bg-red-500") . " text-white font-bold py-1 px-3 rounded'>
                       " . ($row['u_status'] == 1 ? 'Terminate' : 'Reactive') . "
                    </a>
                </td>";

                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='11' class='border border-gray-300 p-2 text-center'>No users found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>





            <!-- Legal Notice Form -->
            <!-- Dark Overlay -->
            <div id="overlay" class="fixed inset-0 bg-black opacity-50 z-40 hidden"></div>

            <!-- Legal Notice Form -->
            <div id="legal_notice" class="max-w-md mx-auto bg-white p-4 shadow-md z-50 fixed inset-0 m-auto hidden" style="width: 50%; height: fit-content;">
                <h2 class="text-xl font-semibold mb-4">Legal Notice</h2>
                <form action="manage_customer.php" method="POST">
                    <div class="mb-4">
                        <label for="to" class="block text-sm font-medium">To:</label>
                        <input type="text" id="to" name="To" required class="border border-gray-300 p-2 w-full"
                            disabled>
                        <input type="hidden" id="To" name="to">
                    </div>
                    <div class="mb-4">
                        <label for="subject" class="block text-sm font-medium">Subject:</label>
                        <input type="text" id="subject" name="subject" required class="border border-gray-300 p-2 w-full">
                    </div>
                    <div class="mb-4">
                        <label for="message" class="block text-sm font-medium">Message:</label>
                        <textarea id="message" name="message" rows="5" required class="border border-gray-300 p-2 w-full"></textarea>
                    </div>
                    <div class="flex justify-between">
                        <button type="submit" class="bg-blue-500 text-white p-2 rounded" name="submit">Send</button>
                        <button type="button" class="bg-red-500 text-white p-2 rounded" onclick="cancelEmail()">Cancel</button>
                    </div>
                </form>
            </div>

            <script>
                function cancelEmail() {
                    if (confirm('Are you sure you want to cancel the email?')) {
                        // Clear the input fields
                        document.getElementById('to').value = '';
                        document.getElementById('subject').value = '';
                        document.getElementById('message').value = '';

                        // Hide the form and overlay after cancellation
                        document.getElementById('legal_notice').style.display = 'none';
                        document.getElementById('overlay').classList.add('hidden');
                    }
                }

                // Function to show the legal notice form and overlay
                function showLegalNotice(user_id) {
                    document.getElementById('to').value = 'customer ID: ' + user_id;;
                    document.getElementById('To').value = user_id;;
                    document.getElementById('legal_notice').style.display = 'block';
                    document.getElementById('overlay').classList.remove('hidden');
                }

                // Function to hide the legal notice form and overlay when clicking outside
                window.onclick = function(event) {
                    var legalNoticeDiv = document.getElementById('legal_notice');
                    var overlayDiv = document.getElementById('overlay');
                    if (event.target == overlayDiv) {
                        legalNoticeDiv.style.display = 'none';
                        overlayDiv.classList.add('hidden');
                    }
                }
            </script>








            <!-- End Shop Details Table -->
            <div id="confirmationModal" class="modal">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 id="modalTitle" style="font-weight:900; font-family:cursive;">Cancellation Not Allowed</h3>
                        <p id="modalMessage">Since the remaining time is not more than 24 hours, you cannot cancel now.</p>
                    </div>
                    <div class="modal-footer">
                        <button onclick="closeModal()" style="color:red">Cancel</button>
                        <button id="confirmBtn" onclick="confirmAction()" style="color:red;">OK</button>
                    </div>
                </div>

            </div>

            <script>
                let customerId;
                let actionStatus;

                function confirmTermination(id, status) {
                    customerId = user_id;
                    actionStatus = u_status;

                    // Show modal
                    document.getElementById('confirmationModal').style.display = 'block';

                    // Customize modal content based on status (terminate/reactivate)
                    if (status == 1) {
                        document.getElementById('modalTitle').textContent = 'Termination Confirmation';
                        document.getElementById('modalMessage').textContent = 'Are you sure you want to terminate this Customer?';
                    } else {
                        document.getElementById('modalTitle').textContent = 'Reactivation Confirmation';
                        document.getElementById('modalMessage').textContent = 'Are you sure you want to reactivate this Customer?';
                    }
                }

                function closeModal() {
                    document.getElementById('confirmationModal').style.display = 'none';
                }

                function confirmAction() {
                    // Perform AJAX request or form submission
                    window.location.href = `manage_customer.php?user_id=${customerId}&status=${actionStatus}`;
                }
            </script>



            <script>
                function openUserModal(userData) {
                    document.getElementById('user_name').innerText = userData.user_name;
                    document.getElementById('user_email').innerText = userData.user_email;
                    document.getElementById('user_phone').innerText = userData.user_phone;
                    document.getElementById('user_gender').innerText = userData.user_gender;
                    document.getElementById('user_district').innerText = userData.user_district;
                    document.getElementById('user_status').innerText = userData.u_status === 1 ? 'Active' : 'Inactive';
                    document.getElementById('user_registration_date').innerText = userData.user_registration_date;
                    document.getElementById('user_upazila').innerText = userData.user_upazila;
                    document.getElementById('user_area').innerText = userData.user_area;

                    // Show the modal
                    document.getElementById('userModal').style.display = 'block';
                }

                // Close modal functionality
                document.querySelector('.close').addEventListener('click', function() {
                    document.getElementById('userModal').style.display = 'none';
                });
            </script>

            <!-- Pagination Links -->
            <div class="pagination mt-4">
                <?php if ($page > 1): ?>
                    <a href="?page=<?php echo $page - 1; ?>&email=<?php echo $searchEmail; ?>">&laquo; Previous</a>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <a href="?page=<?php echo $i; ?>&email=<?php echo $searchEmail; ?>"
                        class="<?php echo $i == $page ? 'active' : ''; ?>">
                        <?php echo $i; ?>
                    </a>
                <?php endfor; ?>

                <?php if ($page < $total_pages): ?>
                    <a href="?page=<?php echo $page + 1; ?>&email=<?php echo $searchEmail; ?>">Next &raquo;</a>
                <?php endif; ?>
            </div>

        </div>


    </div>

</body>

</html>