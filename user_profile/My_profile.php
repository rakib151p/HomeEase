<?php
session_start();
include '../config.php';
// Check if form is submitted
if (isset($_POST['submit'])) {
    // Get form input values
    $user_id = $_SESSION['user_id']; // Fetch user_id from session
    $user_name = empty($_POST['user_name']) ? $_SESSION['user_name'] : $_POST['user_name'];
    $user_email = empty($_POST['user_email']) ? $_SESSION['user_email'] : $_POST['user_email'];
    $user_phone = empty($_POST['user_phone']) ? $_SESSION['user_phone'] : $_POST['user_phone'];
    $user_gender = empty($_POST['user_gender']) ? $_SESSION['user_gender'] : $_POST['user_gender'];
    if(!empty($_POST['user_password'])){$user_password= $_POST['user_password'];
        $user_password = password_hash($user_password, PASSWORD_DEFAULT); // Use hashing if password is provided
    }

    // Optional: Password encryption
    
    // Check if a file is uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        // Define the allowed file extensions
        $allowed_extensions = ['jpg', 'jpeg', 'png'];
        $file_name = $_FILES['image']['name'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        // Check if the file extension is allowed
        if (in_array($file_ext, $allowed_extensions)) {
            $upload_dir = 'photo/profile picture/';
            $new_file_name = $user_id . '.' . $file_ext; // Assign a unique file name (user_id)
            $target_file = $upload_dir . $new_file_name;

            // Move the uploaded file to the target directory
            if (move_uploaded_file($file_tmp, $target_file)) {
                $user_profile_picture = $new_file_name;
            } else {
                $user_profile_picture = ''; // If file upload fails
            }
        } else {
            // Handle invalid file extension
            echo "Invalid file extension!";
        }
    } else {
        $user_profile_picture = ''; // If no file is uploaded
    }

    // If all fields are validated, proceed to update the user data
    $user_district = $_SESSION['user_district']; // Add other fields as necessary
    $user_upazila = $_SESSION['user_upazila'];
    $user_area = $_SESSION['user_area'];
    if(!empty($_POST['user_password'])){
        $sql = "UPDATE `user` SET 
            `user_name` = '$user_name', 
            `user_email` = '$user_email', 
            `user_phone` = '$user_phone', 
            `user_password` = '$user_password', 
            `user_gender` = '$user_gender', 
            `user_profile_picture` = '$user_profile_picture', 
            `user_district` = '$user_district', 
            `user_upazila` = '$user_upazila', 
            `user_area` = '$user_area'
            WHERE `user_id` = '$user_id'";

    }
    else{// Prepare SQL to update user data
    $sql = "UPDATE `user` SET 
            `user_name` = '$user_name', 
            `user_email` = '$user_email', 
            `user_phone` = '$user_phone',
            `user_gender` = '$user_gender', 
            `user_profile_picture` = '$user_profile_picture', 
            `user_district` = '$user_district', 
            `user_upazila` = '$user_upazila', 
            `user_area` = '$user_area'
            WHERE `user_id` = '$user_id'";
}
    // Execute the query
    if ($con->query($sql) === TRUE) {
        echo "Profile updated successfully!";
        $_SESSION['user_name'] = $user_name;
        $_SESSION['user_email'] = $user_email;
        $_SESSION['user_phone'] = $user_phone;
        $_SESSION['user_gender'] = $user_gender;
    } else {
        echo "Error: " . $con->error;
    }
    // Close the database connection
    $con->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>
    <style>
        body {
            background-color: #F4F4F4;
            font-family: 'Inter', sans-serif;
        }

        .text-gray-700 {
            font-weight: bolder;
        }

        .t {
            font-family: 'Times New Roman', Times, serif;
            font-size: 50px;
            color: #00008B;
        }

        #tittlemnm {
            font-size: x-large;
            color: #00008B;
            margin: 50px 0 0 340px;
        }

        #undernavbar {
            display: flex;
            border-radius: 20px;
            margin-bottom: 80px;
            margin-top: 50px;
        }

        #box1 {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            margin-top: 78px;
            margin-left: 80px;
            height: 360px;
            width: 55%;
        }

        #profileImage {
            margin: 0 20px 0 0;
            height: 200px;
            width: 200px;
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
            margin-top: 40px;
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
        }

        #whiteboard {
            width: 700px;
            margin: 30px 0 40px 100px;
            border-radius: 20px;
            box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;
        }

        #profile_edit {
            margin-left: 20px;
            margin-top: 2px;
            padding: 10px 0 0 8px;
            height: auto;
            width: 100%;
            border-radius: 10px;
        }

        #left {
            height: 500px;
            width: 45%;
            float: left;
        }

        #right {
            height: 500px;
            width: 55%;
            position: relative;
            bottom: 10px;
            float: right;
        }

        #btn {
            position: relative;
            right: 340px;
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
            color: #00008B;
        }

        .login_name {
            font-weight: 900;
        }

        .relation {
            margin-top: 2px;
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



        .gri {
            position: relative;
            bottom: 70px;
        }

        #btn {
            position: relative;
            bottom: 70px;
            height: 45px;
        }

        .box_title {
            position: absolute;
            left: 410px;
            font-size: 2rem;
            color: #00008B;
            font-weight: 900;
        }
    </style>
</head>

<body class="bg-gradient-to-bl from-blue-100 via-white via-blue-100 to-slate-300 h-screen">

    <?php
    include 'header.php';
    ?>

    <!-- <h2 id=" tittlemnm">My Profile</h2> -->
    <section id="undernavbar">
        <div id="sidebar">
            <a href="#" id="mma">Manage My Account</a>
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
            if (isset($_SESSION['email'])) {
                echo '<a href="../logout.php" class="text-gray-700 hover:text-pink-600 " style="font-size:30px;margin:10px 0 0 20px; line-height:50px;">Logout</a>';
            }
            ?>
        </div>
        <h3 class="box_title">My Profile</h3>
        <div id="box1" class="shadow-l border-2 bg-blue-100">
            <div id="left">
                <div class="mb-6 flex justify-center">
                    <img id="profileImage" src="<?php echo "Profile_pic"; ?>" alt=""
                        class="w-400 h-400 rounded-full mx-auto mb-4">
                </div>

            </div>
            <div id="right">

                <div id="profile_edit">
                    <div class="grid grid-cols-1 md:grid-cols-1 gap-4 mb-6">
                        <div>
                            <p class="font-semibold">Full name</p>
                            <p id="profileName" class="text-gray-600 text-3">
                                <?php echo $_SESSION['user_name']; ?>
                            </p>
                        </div>
                        <div>
                            <p class="font-semibold">Email Address</p>
                            <p id="profileEmail" class="text-gray-600 text-2"><?php echo $_SESSION['user_email']; ?></p>
                        </div>
                        <div>
                            <p class="font-semibold">Gender</p>
                            <p id="profileGender" class="text-gray-600 text-2"><?php echo $_SESSION['user_gender'] === "" ? "Not set" : $_SESSION['user_gender']; ?></p>
                        </div>
                        <div>
                            <p class="font-semibold">Mobile</p>
                            <p id="profilePhone" class="text-gray-600 text-2"><?php echo $_SESSION['user_phone']; ?></p>
                        </div>
                        <div>
                            <p class="font-semibold">Registered:</p>
                            <p id="profilePhone" class="text-gray-600 text-2">
                                <?php
                                $dateTime = new DateTime('now', new DateTimeZone('Asia/Dhaka')); // Current time
                                $registrationDate = new DateTime($_SESSION['user_registration_date'], new DateTimeZone('Asia/Dhaka')); // Registration date

                                // Calculate the difference
                                $interval = $dateTime->diff($registrationDate);

                                // Output the difference in days
                                echo $interval->days . ' days';
                                ?>
                            </p>
                        </div>

                    </div>
                    <div class="flex space-x-4">
                        <button id="btn" class="bg-[#00008B] hover:bg-blue-900 text-white font-bold py-2 px-4 rounded"
                            onclick="openEditModal()">EDIT PROFILE</button>
                    </div>

                </div>
            </div>

        </div>

    </section>
    <div id="editModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
        <div class="bg-white rounded-lg shadow-md p-6 w-full max-w-md conatin">
            <h2 class="text-xl font-bold mb-4">Edit Profile</h2>
            <form action="" method="POST" enctype="multipart/form-data">
                <div>
                    <label for="editName" class="block text-gray-700">User name</label>
                    <input type="text" id="editName" name="user_name"
                        class="w-full p-2 border border-gray-300 rounded mt-1">
                </div>
                <!-- <div>
                    <label for="editName" class="block text-gray-700">Last name</label>
                    <input type="text" id="editName" name="last_name"
                        class="w-full p-2 border border-gray-300 rounded mt-1">
                </div> -->
                <div>
                    <label for="editEmail" class="block text-gray-700">Email Address</label>
                    <input type="email" id="editEmail" name="user_email"
                        class="w-full p-2 border border-gray-300 rounded mt-1">
                    <p id="emailError" style="color:red; display:none;">Please enter a valid email address.</p>
                </div>
                <div>
                    <label for="password" class="block text-gray-700">Password</label>
                    <input type="password" id="password" name="user_password"
                        class="w-full p-2 border border-gray-300 rounded mt-1" minlength="6">
                </div>
                <!-- <div>
                    <label for="retype_password" class="block text-gray-700">Re-type password</label>
                    <input type="password" id="retype_password" name="retype_password"
                        class="w-full p-2 border border-gray-300 rounded mt-1">
                </div> -->
                <div>
                    <label for="gender" class="block text-gray-700">Gender</label>
                    <div class="mt-1">
                        <label for="male" class="mr-4">
                            <input type="radio" id="male" name="user_gender" value="Male" class="mr-1">
                            Male
                        </label>
                        <label for="female" class="mr-4">
                            <input type="radio" id="female" name="user_gender" value="Female" class="mr-1">
                            Female
                        </label>
                    </div>
                </div>
                <div>
                    <label for="editPhone" class="block text-gray-700">Mobile</label>
                    <input type="text" id="editPhone" name="user_phone"
                        class="w-full p-2 border border-gray-300 rounded mt-1">
                </div>

                <div>
                    <label for="editImage" class="block text-gray-700">Profile Photo</label>
                    <input name="image" type="file" id="editImage"
                        class="w-full p-2 border border-gray-300 rounded mt-1" accept=".jpg"
                        onchange="previewImage(event)">
                </div>
                <div class="flex justify-end">
                    <button type="button"
                        class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded mr-2"
                        onclick="closeEditModal()">Cancel</button>
                    <button type="submit" name="submit"
                        class="bg-[#00008B] hover:bg-blue-900 text-white font-bold py-2 px-4 rounded"
                        onclick="saveProfile()">Save</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('retype_password').addEventListener('input', function() {
            const password = document.getElementById('password').value;
            const retypePassword = this.value;

            if (password !== retypePassword) {
                this.setCustomValidity('Passwords do not match');
            } else {
                this.setCustomValidity('');
            }
        });
        document.getElementById('password').addEventListener('input', function() {
            const password = this.value;
            const retypePassword = document.getElementById('retype_password').value;
            if (password !== retypePassword) {
                this.setCustomValidity('Passwords do not match');
            } else {
                this.setCustomValidity('');
            }
        });
        document.getElementById('editEmail').addEventListener('input', function() {
            var emailField = document.getElementById('editEmail');
            var emailError = document.getElementById('emailError');
            var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (emailField.value.match(emailPattern)) {
                emailError.style.display = 'none';
            } else {
                emailError.style.display = 'block';
            }
        });

        function openEditModal() {
            document.getElementById('editModal').classList.remove('hidden');
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }

        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const output = document.getElementById('profileImage');
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }

        function saveProfile() {
            const name = document.getElementById('editName').value;
            const email = document.getElementById('editEmail').value;
            const phone = document.getElementById('editPhone').value;
            const gender = document.getElementById('editGender').value;

            document.getElementById('profileName').innerText = name || "Please enter your name";
            document.getElementById('profileEmail').innerText = email || "Please enter your email";
            document.getElementById('profilePhone').innerText = phone || "Please enter your mobile";
            document.getElementById('profileGender').innerText = gender || "Please enter your gender";

            closeEditModal();
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