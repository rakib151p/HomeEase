<?php
include '../config.php';
session_start();
$serviceQuery = "SELECT service_id, service_name FROM service";
$serviceResult = $con->query($serviceQuery);
$domainItems = [];
// Fetch services and their associated items
if ($serviceResult->num_rows > 0) {
    while ($service = $serviceResult->fetch_assoc()) {
        $serviceId = $service['service_id'];
        $serviceName = $service['service_name'];
        // Query to fetch items for this service
        $itemQuery = "SELECT item_name FROM item WHERE service_id = '$serviceId'";
        $itemResult = $con->query($itemQuery);
        $items = [];
        if ($itemResult->num_rows > 0) {
            while ($item = $itemResult->fetch_assoc()) {
                $items[] = $item['item_name'];
            }
        }
        // Add service and its items to the array
        $domainItems[$serviceName] = $items;
    }
}

if (isset($_SESSION['provider_id'])) {

    // Handle the form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        echo 'check';
        // Fetch provider ID from session
        $provider_id = $_SESSION['provider_id'];
        $provider_name = isset($_POST['provider_name']) && $_POST['provider_name'] !== "Not set" ? $con->real_escape_string($_POST['provider_name']) : null;
        $provider_email = isset($_POST['provider_email']) && $_POST['provider_email'] !== "Not set" ? $con->real_escape_string($_POST['provider_email']) : null;
        $provider_password = isset($_POST['provider_password']) && $_POST['provider_password'] !== "Not set" ? password_hash($_POST['provider_password'], PASSWORD_BCRYPT) : null;
        $provider_code = isset($_POST['provider_code']) && $_POST['provider_code'] !== "Not set" ? $con->real_escape_string($_POST['provider_code']) : null;
        $provider_status = isset($_POST['provider_status']) && $_POST['provider_status'] !== "Not set" ? $con->real_escape_string($_POST['provider_status']) : null;
        $provider_district = isset($_POST['provider_district']) && $_POST['provider_district'] !== "Not set" ? $con->real_escape_string($_POST['provider_district']) : null;
        $provider_experience = isset($_POST['provider_experience']) && $_POST['provider_experience'] !== null ? $con->real_escape_string($_POST['provider_experience']) : null;
        $provider_about = isset($_POST['provider_about']) && $_POST['provider_about'] !== "Not set" ? $con->real_escape_string($_POST['provider_about']) : null;
        $provider_rating = isset($_POST['provider_rating']) && $_POST['provider_rating'] !== "Not set" ? $con->real_escape_string($_POST['provider_rating']) : null;
        $provider_phone = isset($_POST['provider_phone']) && $_POST['provider_phone'] !== "Not set" ? $con->real_escape_string($_POST['provider_phone']) : null;
        $provider_gender = isset($_POST['provider_gender']) && $_POST['provider_gender'] !== "Not set" ? $con->real_escape_string($_POST['provider_gender']) : null;
        $provider_verified = isset($_POST['provider_verified']) && $_POST['provider_verified'] !== "Not set" ? $con->real_escape_string($_POST['provider_verified']) : null;
        $provider_expertise = isset($_POST['selectedItems']) && $_POST['selectedItems'] !== "" ? $con->real_escape_string($_POST['selectedItems']) : null;
        $provider_servable = isset($_POST['provider_servable']) && $_POST['provider_servable'] !== "Not set" ? $con->real_escape_string($_POST['provider_servable']) : null;
        $provider_upazila = isset($_POST['provider_upazila']) && $_POST['provider_upazila'] !== "Not set" ? $con->real_escape_string($_POST['provider_upazila']) : null;
        $provider_area = isset($_POST['provider_area']) && $_POST['provider_area'] !== "Not set" ? $con->real_escape_string($_POST['provider_area']) : null;
        $provider_street_address = isset($_POST['provider_street_address']) && $_POST['provider_street_address'] !== "Not set" ? $con->real_escape_string($_POST['provider_street_address']) : null;
        $provider_availability = "";
        if (isset($_POST['provider_availability'])) $provider_availability = $_POST['provider_availability'];
        $provider_price = $_POST['provider_price'];
        $provider_availability_time_of_day = "";
        if (isset($_POST['provider_availability_time_of_day'])) {
            $provider_availability_time_of_day = implode(',', $_POST['provider_availability_time_of_day']);
            echo $provider_availability_time_of_day . " check";
        }
        echo $_POST['selectedItems'];
        // Handle profile picture upload
        $provider_profile_picture = null;
        if (isset($_FILES['provider_profile_picture']) && $_FILES['provider_profile_picture']['error'] === UPLOAD_ERR_OK) {
            $file_name = $_FILES['provider_profile_picture']['name'];
            $file_tmp_name = $_FILES['provider_profile_picture']['tmp_name'];
            $file_size = $_FILES['provider_profile_picture']['size'];
            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);

            // Validate file type (e.g., jpg, png)
            $allowed_extensions = ['jpg', 'jpeg', 'png'];
            if (in_array(strtolower($file_ext), $allowed_extensions)) {
                // Generate a unique file name to avoid conflicts
                $new_file_name = "profile_" . time() . "." . $file_ext;
                $upload_dir = "../photo/profile_pictures/"; // Path to save the uploaded files

                // Move file to the upload directory
                if (move_uploaded_file($file_tmp_name, $upload_dir . $new_file_name)) {
                    $provider_profile_picture = $new_file_name;
                } else {
                    die("Error uploading profile picture.");
                }
            } else {
                die("Invalid file type. Only JPG, JPEG, PNG are allowed.");
            }
        } else {
            // If no file was uploaded, check if it needs to be updated
            if (isset($_POST['provider_profile_picture']) && $_POST['provider_profile_picture'] !== "Not set") {
                $provider_profile_picture = $con->real_escape_string($_POST['provider_profile_picture']);
            }
        }

        // Build the SET part of the query dynamically
        $update_fields = [];
        if ($provider_name !== null) $update_fields[] = "`provider_name` = '$provider_name'";
        if ($provider_email !== null) $update_fields[] = "`provider_email` = '$provider_email'";
        if ($provider_password !== null) $update_fields[] = "`provider_password` = '$provider_password'";
        if ($provider_code !== null) $update_fields[] = "`provider_code` = '$provider_code'";
        // if ($provider_status !== null) $update_fields[] = "`provider_status` = '$provider_status'";
        if ($provider_district !== null) $update_fields[] = "`provider_district` = '$provider_district'";
        if ($provider_experience !== null) $update_fields[] = "`provider_experience` = '$provider_experience'";
        if ($provider_about !== null) $update_fields[] = "`provider_about` = '$provider_about'";
        if ($provider_rating !== null) $update_fields[] = "`provider_rating` = '$provider_rating'";
        if ($provider_phone !== null) $update_fields[] = "`provider_phone` = '$provider_phone'";
        if ($provider_gender !== null) $update_fields[] = "`provider_gender` = '$provider_gender'";
        if ($provider_verified !== null) $update_fields[] = "`provider_verified` = '$provider_verified'";
        if ($provider_expertise !== null) $update_fields[] = "`provider_expertise` = '$provider_expertise'";
        if ($provider_servable !== null) $update_fields[] = "`provider_servable` = '$provider_servable'";
        if ($provider_upazila !== null) $update_fields[] = "`provider_upazila` = '$provider_upazila'";
        if ($provider_area !== null) $update_fields[] = "`provider_area` = '$provider_area'";
        if ($provider_street_address !== null) $update_fields[] = "`provider_street_address` = '$provider_street_address'";
        if ($provider_profile_picture !== null) $update_fields[] = "`provider_profile_picture` = '$provider_profile_picture'";
        if ($provider_price != null) $update_fields[] = "`provider_price` = '$provider_price'";
        if ($provider_availability != "") $update_fields[] = "`provider_availability` = '$provider_availability'";
        if ($provider_availability_time_of_day != "") $update_fields[] = "`provider_availability_time_of_day` = '$provider_availability_time_of_day'";
        // Check if there are fields to update
        if (count($update_fields) > 0) {
            // Combine the update fields into one string
            $set_clause = implode(", ", $update_fields);

            // SQL UPDATE query
            $sql = "UPDATE `service_provider` SET $set_clause WHERE `provider_id` = '$provider_id'";

            // Execute the query
            if ($con->query($sql) === TRUE) {
                echo "Record updated successfully";
            } else {
                echo "Error updating record: " . $con->error;
            }
        } else {
            echo "No valid fields to update.";
        }
        include_once '../user_details.php';
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
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
                <div class="bg-blue-200 rounded-full w-24 h-24 flex items-center justify-center">
                    <span class="text-blue-600 text-3xl font-bold">P</span>
                </div>
                <h2 class="mt-4 font-semibold text-lg">Team R3P innovators</h2>
                <p class="text-sm text-gray-500">Provider ID: 1023034</p>
            </div>

            <nav class="mt-8 space-y-4">
                <a href="dashboard.php" class="flex items-center px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-md">
                    <span class="material-icons mr-3">Dashboard</span>
                </a>
                <a href="" class="flex items-center px-4 py-2 text-blue-600 bg-blue-100 rounded-md">
                    <span class="material-icons mr-3">Profile</span>
                </a>
                <a href="Order_Manage.php" class="flex items-center px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-md">
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
            <div class="container  w-screen ">
                <div class="bg-white shadow-xl rounded-xl p-8 max-w-scree mx-auto">
                    <!-- Header -->
                    <!-- Profile Form -->
                    <form id="providerForm" action="" method="POST" enctype="multipart/form-data">
                        <div class="flex justify-between items-center mb-8">
                            <h2 class="text-3xl font-bold text-gray-800">Provider Profile</h2>
                        </div>
                        <!-- Profile Picture Section -->
                        <div class="flex items-center mb-6">
                            <div class="relative">
                                <!-- Profile Picture Preview -->
                                <img
                                    id="profilePicturePreview"
                                    src="https://via.placeholder.com/100"
                                    alt="Profile Picture"
                                    class="w-24 h-24 rounded-full object-cover border-4 border-gray-300 shadow-lg">
                                <!-- Upload Label -->
                                <label
                                    for="provider_profile_picture"
                                    class="absolute bottom-0 right-0 bg-blue-600 text-white p-2 rounded-full shadow-lg cursor-pointer hover:bg-blue-700 transition">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="2"
                                        stroke="currentColor"
                                        class="w-5 h-5">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M15.232 5.232l3.536 3.536M9 11l5.268-5.268a2 2 0 112.828 2.828L11.828 15H9v-2.828zM3 3l18 18" />
                                    </svg>
                                </label>
                                <!-- File Input -->
                                <input
                                    type="file"
                                    id="provider_profile_picture"
                                    name="provider_profile_picture"
                                    class="hidden"
                                    accept="image/*">
                            </div>
                        </div>
                        <!-- print basic details here in center -->
                        <!-- Basic Details -->
                        <div class="grid grid-cols-2 gap-8 mb-8">
                            <div>
                                <label class="block text-gray-700 font-medium mb-2" for="provider_name">Name</label>
                                <input type="text" id="provider_name" name="provider_name"
                                    class="w-full border-gray-300 rounded-lg shadow-sm p-3 focus:ring-2 focus:ring-blue-400"
                                    placeholder="" value="<?php echo $_SESSION['provider_name']; ?>">
                            </div>
                            <div>
                                <label class="block text-gray-700 font-medium mb-2" for="provider_email">Email</label>
                                <input type="email" id="provider_email" name="provider_email"
                                    class="w-full border-gray-300 rounded-lg shadow-sm p-3 focus:ring-2 focus:ring-blue-400"
                                    placeholder="" value="<?php echo $_SESSION['provider_email']; ?>">
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-8 mb-8">
                            <div>
                                <label class="block text-gray-700 font-medium mb-2" for="provider_password">Password</label>
                                <input type="password" id="provider_password" name="provider_password"
                                    class="w-full border-gray-300 rounded-lg shadow-sm p-3 focus:ring-2 focus:ring-blue-400"
                                    placeholder="Enter your password" value="******">
                            </div>
                            <div>
                                <label class="block text-gray-700 font-medium mb-2" for="provider_status">Status</label>
                                <select id="provider_status" name="provider_status"
                                    class="w-full border-gray-300 rounded-lg shadow-sm p-3 focus:ring-2 focus:ring-blue-400">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-gray-700 font-medium mb-2" for="provider_phone">Phone</label>
                                <input type="text" id="provider_phone" name="provider_phone"
                                    class="w-full border-gray-300 rounded-lg shadow-sm p-3 focus:ring-2 focus:ring-blue-400"
                                    placeholder="Enter your phone number" value="<?php echo isset($_SESSION['provider_phone']) ? $_SESSION['provider_phone'] : "Not set"; ?>">
                            </div>
                            <div>
                                <label class="block text-gray-700 font-medium mb-2" for="provider_gender">Gender</label>
                                <select id="provider_gender" name="provider_gender"
                                    class="w-full border-gray-300 rounded-lg shadow-sm p-3 focus:ring-2 focus:ring-blue-400">
                                    <option value="" selected disabled><?php echo isset($_SESSION['provider_gender']) ? $_SESSION['provider_gender'] : "Not set"; ?></option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                        </div>
                        <!-- print here address in center  -->
                        <!-- Address and Registration Date -->
                        <div class="grid grid-cols-2 gap-8 mb-8">
                            <div>
                                <label for="district" class="font-semibold">District</label>
                                <!-- <input type="text" id="district" name="district" class="text-gray-600 w-full p-2 border rounded"
                            value="" required> -->
                                <select id="district" name="provider_district"
                                    class="border border-gray-300 p-2 rounded-lg w-full focus:outline-none focus:border-blue-600"
                                    required>
                                    <option disabled selected><?php echo empty($_SESSION['provider_district']) ? "Not set" : $_SESSION['provider_district']; ?></option>
                                    <option value="Bagerhat">Bagerhat</option>
                                    <option value="Bandarban">Bandarban</option>
                                    <option value="Barguna">Barguna</option>
                                    <option value="Barishal">Barishal</option>
                                    <option value="Bhola">Bhola</option>
                                    <option value="Bogura">Bogura</option>
                                    <option value="Brahmanbaria">Brahmanbaria</option>
                                    <option value="Chandpur">Chandpur</option>
                                    <option value="Chattogram">Chattogram</option>
                                    <option value="Chuadanga">Chuadanga</option>
                                    <option value="Cox's Bazar">Cox_s_Bazar</option>
                                    <option value="Cumilla">Cumilla</option>
                                    <option value="Dhaka">Dhaka</option>
                                    <option value="Dinajpur">Dinajpur</option>
                                    <option value="Faridpur">Faridpur</option>
                                    <option value="Feni">Feni</option>
                                    <option value="Gaibandha">Gaibandha</option>
                                    <option value="Gazipur">Gazipur</option>
                                    <option value="Gopalganj">Gopalganj</option>
                                    <option value="Habiganj">Habiganj</option>
                                    <option value="Jamalpur">Jamalpur</option>
                                    <option value="Jashore">Jashore</option>
                                    <option value="Jhalokathi">Jhalokathi</option>
                                    <option value="Jhenaidah">Jhenaidah</option>
                                    <option value="Khagrachhari">Khagrachhari</option>
                                    <option value="Khulna">Khulna</option>
                                    <option value="Kishoreganj">Kishoreganj</option>
                                    <option value="Kurigram">Kurigram</option>
                                    <option value="Kushtia">Kushtia</option>
                                    <option value="Lakshmipur">Lakshmipur</option>
                                    <option value="Lalmonirhat">Lalmonirhat</option>
                                    <option value="Madaripur">Madaripur</option>
                                    <option value="Magura">Magura</option>
                                    <option value="Manikganj">Manikganj</option>
                                    <option value="Meherpur">Meherpur</option>
                                    <option value="Moulvibazar">Moulvibazar</option>
                                    <option value="Munshiganj">Munshiganj</option>
                                    <option value="Mymensingh">Mymensingh</option>
                                    <option value="Naogaon">Naogaon</option>
                                    <option value="Narail">Narail</option>
                                    <option value="Narayanganj">Narayanganj</option>
                                    <option value="Narsingdi">Narsingdi</option>
                                    <option value="Natore">Natore</option>
                                    <option value="Netrokona">Netrokona</option>
                                    <option value="Nilphamari">Nilphamari</option>
                                    <option value="Noakhali">Noakhali</option>
                                    <option value="Pabna">Pabna</option>
                                    <option value="Panchagarh">Panchagarh</option>
                                    <option value="Patuakhali">Patuakhali</option>
                                    <option value="Pirojpur">Pirojpur</option>
                                    <option value="Rajbari">Rajbari</option>
                                    <option value="Rajshahi">Rajshahi</option>
                                    <option value="Rangamati">Rangamati</option>
                                    <option value="Rangpur">Rangpur</option>
                                    <option value="Satkhira">Satkhira</option>
                                    <option value="Shariatpur">Shariatpur</option>
                                    <option value="Sherpur">Sherpur</option>
                                    <option value="Sirajganj">Sirajganj</option>
                                    <option value="Sunamganj">Sunamganj</option>
                                    <option value="Sylhet">Sylhet</option>
                                    <option value="Tangail">Tangail</option>
                                    <option value="Thakurgaon">Thakurgaon</option>
                                </select>
                            </div>
                            <div>
                                <label for="upazilla" class="font-semibold">Upazilla</label>
                                <!-- <input type="text" id="upazilla" name="upazilla" class="text-gray-600 w-full p-2 border rounded"
                            value="" required> -->
                                <select id="upazilla" name="provider_upazila"
                                    class="border border-gray-300 p-2 rounded-lg w-full focus:outline-none focus:border-blue-600">
                                    <option value="" disabled selected><?php echo empty($_SESSION['provider_upazila']) ? "Not set" : $_SESSION['provider_upazila']; ?></option>
                                </select>
                            </div>
                            <div>
                                <label for="area" class="font-semibold">Area</label>
                                <input type="text" id="user_area" name="provider_area" class="text-gray-600 w-full p-2 border rounded"
                                    value="<?php echo empty($_SESSION['provider_area']) ? "Not set" : $_SESSION['provider_area']; ?>" required>
                            </div>
                            <div>
                                <label for="area" class="font-semibold">Shop street address/House No:</label>
                                <input type="text" id="user_address" name="provider_street_address" class="text-gray-600 w-full p-2 border rounded"
                                    value="<?php echo empty($_SESSION['provider_street_address']) ? "Not set" : $_SESSION['provider_street_address']; ?>" required>
                            </div>
                        </div>


                        <!-- Experience and About -->
                        <div class="grid grid-cols-2 gap-8 mb-8">
                            <div>
                                <label class="block text-gray-700 font-medium mb-2" for="provider_experience">Experience (Years)</label>
                                <input type="number" id="provider_experience" name="provider_experience"
                                    class="w-full border-gray-300 rounded-lg shadow-sm p-3 focus:ring-2 focus:ring-blue-400"
                                    placeholder="Years of experience" value="<?php echo $_SESSION['provider_experience']; ?>">
                            </div>
                            <div>
                                <label class="block text-gray-700 font-medium mb-2" for="provider_about">About</label>
                                <textarea id="provider_about" name="provider_about" rows="4"
                                    class="w-full border-gray-300 rounded-lg shadow-sm p-3 focus:ring-2 focus:ring-blue-400"
                                    placeholder="Tell us about yourself"
                                    ><?php echo $_SESSION['provider_about']; ?></textarea>
                            </div>
                        </div>

                        <!-- expertise -->
                        <div class="grid grid-cols-2 gap-8 mb-8">
                            <div>
                                <label for="previousSelection" class="block mb-2 text-sm font-medium text-gray-700">You're expert in:</label>
                                <input
                                    type="text"
                                    id="previousSelection"
                                    name="previousSelection"
                                    value="<?php echo isset($_SESSION['provider_expertise']) ? $_SESSION['provider_expertise'] : "Not set"; ?>"
                                    class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-gray-100 text-gray-700 cursor-not-allowed sm:text-sm"
                                    readonly>
                            </div>

                        </div>

                        <!-- new option selection  -->
                        <div class="grid grid-cols-2 gap-8 mb-8">
                            <!-- Domain Selection -->
                            <div>
                                <label for="domainSelect" class="block mb-2 text-sm font-medium text-gray-700">Choose Domains</label>

                                <select id="domainSelect" name="domains[]" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    <?php

                                    $serviceQuery = "SELECT service_id, service_name FROM service";
                                    $serviceResult = $con->query($serviceQuery);

                                    // Generate options dynamically
                                    if ($serviceResult->num_rows > 0) {
                                        while ($service = $serviceResult->fetch_assoc()) {
                                            echo '<option value="' . htmlspecialchars($service['service_name']) . '">' . htmlspecialchars($service['service_name']) . '</option>';
                                        }
                                    } else {
                                        echo '<option value="">No services available</option>';
                                    }
                                    ?>
                                </select>

                                <p class="mt-2 text-sm text-gray-500">You can choose multiple domain.</p>
                            </div>

                            <!-- Item Selection -->
                            <div>
                                <label for="itemSelect" class="block mb-2 text-sm font-medium text-gray-700">Choose Items</label>
                                <select id="itemSelect" name="items[]" multiple class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" disabled>
                                    <!-- Items will be populated dynamically -->
                                </select>
                                <p class="mt-2 text-sm text-gray-500">Select domains first to view available items.</p>
                            </div>

                            <!-- Selected Items Display -->
                            <div>
                                <label for="selectedItems" class="block mb-2 text-sm font-medium text-gray-700">Selected Items:</label>
                                <input
                                    type="text"
                                    id="selectedItems"
                                    name="selectedItems"
                                    value=""
                                    class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-gray-100 text-gray-700 cursor-not-allowed sm:text-sm"
                                    readonly>
                                <p class="mt-2 text-sm text-gray-500">Click items to remove them.</p>
                            </div>
                            <div>

                            </div>

                            <div>
                                <label class="block text-gray-700 font-medium mb-2" for="provider_price">Expected value (per hour)</label>
                                <input type="number" id="provider_price" name="provider_price"
                                    class="w-full border-gray-300 rounded-lg shadow-sm p-3 focus:ring-2 focus:ring-blue-400"
                                    placeholder="Valuation per hour" value="<?php echo $_SESSION['provider_price']; ?>">
                            </div>
                            <div>
                                <label class="block text-gray-700 font-medium mb-2">Your Availability</label>
                                <div class="space-y-2">
                                    <label class="flex items-center">
                                        <input type="radio" id="availability_today" name="provider_availability" value="today"
                                            class="form-radio text-blue-500 focus:ring-2 focus:ring-blue-400"
                                            <?php echo ($_SESSION['provider_availability'] === 'today') ? 'checked' : ''; ?>>
                                        <span class="ml-2">Today</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" id="availability_3days" name="provider_availability" value="within_3_days"
                                            class="form-radio text-blue-500 focus:ring-2 focus:ring-blue-400"
                                            <?php echo ($_SESSION['provider_availability'] === 'within_3_days') ? 'checked' : ''; ?>>
                                        <span class="ml-2">Within 3 Days</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" id="availability_1week" name="provider_availability" value="within_1_week"
                                            class="form-radio text-blue-500 focus:ring-2 focus:ring-blue-400"
                                            <?php echo ($_SESSION['provider_availability'] === 'within_1_week') ? 'checked' : ''; ?>>
                                        <span class="ml-2">Within One Week</span>
                                    </label>
                                </div>
                            </div>

                            <div>
                                <?php
                                $availability_array = explode(',', $_SESSION['provider_availability_time_of_day']);
                                // echo print_r($availability_array);
                                ?>
                                <label class="block text-gray-700 font-medium mb-2" for="provider_availability_segment">Your availability in segments of a day:</label>
                                <div class="space-y-2">
                                    <!-- Morning Checkbox -->
                                    <label class="flex items-center">
                                        <input type="checkbox" id="availability_morning" name="provider_availability_time_of_day[]" value="morning_8_12am"
                                            class="form-checkbox text-blue-500 focus:ring-2 focus:ring-blue-400"
                                            <?php echo (in_array('morning_8_12am', $availability_array)) ? 'checked' : ''; ?>>
                                        <span class="ml-2">Morning (8-12AM)</span>
                                    </label>

                                    <!-- Noon Checkbox -->
                                    <label class="flex items-center">
                                        <input type="checkbox" id="availability_noon" name="provider_availability_time_of_day[]" value="noon_12_4pm"
                                            class="form-checkbox text-blue-500 focus:ring-2 focus:ring-blue-400"
                                            <?php echo (in_array('noon_12_4pm', $availability_array)) ? 'checked' : ''; ?>>
                                        <span class="ml-2">Noon (12-4PM)</span>
                                    </label>

                                    <!-- Afternoon Checkbox -->
                                    <label class="flex items-center">
                                        <input type="checkbox" id="availability_afternoon" name="provider_availability_time_of_day[]" value="afternoon_4_8pm"
                                            class="form-checkbox text-blue-500 focus:ring-2 focus:ring-blue-400"
                                            <?php echo (in_array('afternoon_4_8pm', $availability_array)) ? 'checked' : ''; ?>>
                                        <span class="ml-2">Afternoon (4-8PM)</span>
                                    </label>
                                </div>
                            </div>


                        </div>

                        <script>
                            document.getElementById("selectedItems").addEventListener("click", function() {
                                const inputField = this;
                                const items = inputField.value.split(", ").map(item => item.trim()); // Split items by comma

                                // Show a prompt to let the user select an item to remove
                                const itemToRemove = prompt("Enter the name of the item to remove:", items.join(", "));

                                if (itemToRemove && items.includes(itemToRemove)) {
                                    // Remove the item and update the input value
                                    const updatedItems = items.filter(item => item !== itemToRemove);
                                    inputField.value = updatedItems.join(", ");
                                } else if (itemToRemove) {
                                    alert("Item not found in the list.");
                                }
                            });


                            const domainSelect = document.getElementById("domainSelect");
                            const itemSelect = document.getElementById("itemSelect");
                            const selectedItemsInput = document.getElementById("selectedItems");

                            let selectedItems = [];

                            // Update items dropdown based on selected domains
                            domainSelect.addEventListener("change", () => {
                                const domainItems = <?php echo json_encode($domainItems, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP); ?>;
                                const selectedDomains = Array.from(domainSelect.selectedOptions).map(opt => opt.value);

                                // Clear existing items
                                itemSelect.innerHTML = "";

                                if (selectedDomains.length > 0) {
                                    // Enable item dropdown
                                    itemSelect.disabled = false;

                                    // Populate items for selected domains
                                    selectedDomains.forEach(domain => {
                                        domainItems[domain]?.forEach(item => {
                                            const option = document.createElement("option");
                                            option.value = item;
                                            option.textContent = item;
                                            itemSelect.appendChild(option);
                                        });
                                    });
                                } else {
                                    // Disable item dropdown if no domains are selected
                                    itemSelect.disabled = true;
                                }
                            });

                            // Update non-editable textbox with selected items
                            itemSelect.addEventListener("change", () => {
                                const selected = Array.from(itemSelect.selectedOptions).map(opt => opt.value);

                                // Add newly selected items, avoiding duplicates
                                selected.forEach(item => {
                                    if (!selectedItems.includes(item)) {
                                        selectedItems.push(item);
                                    }
                                });

                                // Display selected items in the non-editable textbox
                                selectedItemsInput.value = selectedItems.join(", ");
                            });
                            // Preview the profile picture before uploading
                            document.getElementById('provider_profile_picture').addEventListener('change', function(event) {
                                const file = event.target.files[0];
                                const reader = new FileReader();

                                reader.onload = function(e) {
                                    document.getElementById('profilePicturePreview').src = e.target.result;
                                };

                                if (file) {
                                    reader.readAsDataURL(file);
                                }
                            });
                        </script>

                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <button type="submit" class="bg-green-500 text-white px-6 py-3 rounded-lg shadow hover:bg-green-600 transition duration-300"
                                id="saveButton">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </main>
    </div>

</body>
<script>
    const citiesBydistrict = {
        Bagerhat: [
            "Bagerhat Sadar",
            "Chitalmari",
            "Fakirhat",
            "Kachua",
            "Mollahat",
            "Mongla",
            "Morrelganj",
            "Rampal",
            "Sarankhola",
        ],
        Bandarban: [
            "Bandarban Sadar",
            "Thanchi",
            "Ruma",
            "Rowangchhari",
            "Lama",
            "Ali Kadam",
            "Naikhongchhari",
        ],
        Barguna: [
            "Amtali",
            "Bamna",
            "Barguna Sadar",
            "Betagi",
            "Patharghata",
            "Taltali",
        ],
        Barishal: [
            "Agailjhara",
            "Babuganj",
            "Bakerganj",
            "Banaripara",
            "Gaurnadi",
            "Hizla",
            "Mehendiganj",
            "Muladi",
            "Wazirpur",
        ],
        Bhola: [
            "Bhola Sadar",
            "Burhanuddin",
            "Char Fasson",
            "Daulatkhan",
            "Lalmohan",
            "Manpura",
            "Tazumuddin",
        ],
        Bogura: [
            "Adamdighi",
            "Bogra Sadar",
            "Dhunat",
            "Dhupchanchia",
            "Gabtali",
            "Kahaloo",
            "Nandigram",
            "Sariakandi",
            "Shajahanpur",
            "Sherpur",
            "Shibganj",
            "Sonatala",
        ],
        Brahmanbaria: [
            "Akhaura",
            "Ashuganj",
            "Banchharampur",
            "Brahmanbaria Sadar",
            "Kasba",
            "Nabinagar",
            "Nasirnagar",
            "Sarail",
        ],
        Chandpur: [
            "Chandpur Sadar",
            "Faridganj",
            "Haimchar",
            "Haziganj",
            "Kachua",
            "Matlab Dakshin",
            "Matlab Uttar",
            "Shahrasti",
        ],
        Chattogram: [
            "Anwara",
            "Banshkhali",
            "Boalkhali",
            "Chandanaish",
            "Chattogram Sadar",
            "Fatikchhari",
            "Hathazari",
            "Lohagara",
            "Mirsharai",
            "Patiya",
            "Rangunia",
            "Raozan",
            "Sandwip",
            "Satkania",
            "Sitakunda",
        ],
        Chuadanga: ["Alamdanga", "Chuadanga Sadar", "Damurhuda", "Jibannagar"],
        Cox_S_Bazar: [
            "Chakaria",
            "CoxsBazarSadar",
            "Kutubdia",
            "Maheshkhali",
            "Pekua",
            "Ramu",
            "Teknaf",
            "Ukhiya",
        ],
        Cumilla: [
            "Barura",
            "Brahmanpara",
            "Burichong",
            "Chandina",
            "Chauddagram",
            "Daudkandi",
            "Debidwar",
            "Homna",
            "Laksam",
            "Monohorgonj",
            "Meghna",
            "Muradnagar",
            "Nangalkot",
            "Cumilla Sadar Dakshin",
            "Titas",
        ],
        Dhaka: ["Dhamrai", "Dohar", "Keraniganj", "Nawabganj", "Savar"],
        Dinajpur: [
            "Birampur",
            "Birganj",
            "Biral",
            "Bochaganj",
            "Chirirbandar",
            "Dinajpur Sadar",
            "Ghoraghat",
            "Hakimpur",
            "Kaharole",
            "Khansama",
            "Nawabganj",
            "Parbatipur",
        ],
        Faridpur: [
            "Alfadanga",
            "Bhanga",
            "Boalmari",
            "Charbhadrasan",
            "Faridpur Sadar",
            "Madhukhali",
            "Nagarkanda",
            "Sadarpur",
            "Saltha",
        ],
        Feni: [
            "Chhagalnaiya",
            "Daganbhuiyan",
            "Feni Sadar",
            "Parshuram",
            "Sonagazi",
            "Fulgazi",
        ],
        Gaibandha: [
            "Fulchhari",
            "Gaibandha Sadar",
            "Gobindaganj",
            "Palashbari",
            "Sadullapur",
            "Saghata",
            "Sundarganj",
        ],
        Gazipur: [
            "Gazipur Sadar",
            "Kaliakair",
            "Kaliganj",
            "Kapasia",
            "Sreepur",
        ],
        Gopalganj: [
            "Gopalganj Sadar",
            "Kashiani",
            "Kotalipara",
            "Muksudpur",
            "Tungipara",
        ],
        Habiganj: [
            "Ajmiriganj",
            "Bahubal",
            "Baniachong",
            "Chunarughat",
            "Habiganj Sadar",
            "Lakhai",
            "Madhabpur",
            "Nabiganj",
        ],
        Jamalpur: [
            "Baksiganj",
            "Dewanganj",
            "Islampur",
            "Jamalpur Sadar",
            "Madarganj",
            "Melandaha",
            "Sarishabari",
        ],
        Jashore: [
            "Abhaynagar",
            "Bagherpara",
            "Chaugachha",
            "Jashore Sadar",
            "Jhikargachha",
            "Keshabpur",
            "Manirampur",
            "Sharsha",
        ],
        Jhalokathi: ["Jhalokathi Sadar", "Kathalia", "Nalchity", "Rajapur"],
        Jhenaidah: [
            "Harinakunda",
            "Jhenaidah Sadar",
            "Kaliganj",
            "Kotchandpur",
            "Maheshpur",
            "Shailkupa",
        ],
        Khagrachhari: [
            "Dighinala",
            "Khagrachhari Sadar",
            "Lakshmichhari",
            "Mahalchhari",
            "Manikchhari",
            "Matiranga",
            "Panchhari",
            "Ramgarh",
        ],
        Khulna: [
            "Batiaghata",
            "Dacope",
            "Dumuria",
            "Dighalia",
            "Koyra",
            "Paikgachha",
            "Phultala",
            "Rupsha",
            "Terokhada",
        ],
        Kishoreganj: [
            "Austagram",
            "Bajitpur",
            "Bhairab",
            "Hossainpur",
            "Itna",
            "Karimganj",
            "Katiadi",
            "Kishoreganj Sadar",
            "Kuliarchar",
            "Mithamain",
            "Nikli",
            "Pakundia",
            "Tarail",
        ],
        Kurigram: [
            "Bhurungamari",
            "Char Rajibpur",
            "Chilmari",
            "Kurigram Sadar",
            "Nageshwari",
            "Phulbari",
            "Rajarhat",
            "Raomari",
            "Ulipur",
        ],
        Kushtia: [
            "Bheramara",
            "Daulatpur",
            "Khoksa",
            "Kumarkhali",
            "Kushtia Sadar",
            "Mirpur",
        ],
        Lakshmipur: [
            "Lakshmipur Sadar",
            "Raipur",
            "Ramganj",
            "Ramgati",
            "Kamalnagar",
        ],
        Lalmonirhat: [
            "Aditmari",
            "Hatibandha",
            "Kaliganj",
            "Lalmonirhat Sadar",
            "Patgram",
        ],
        Madaripur: ["Rajoir", "Madaripur Sadar", "Kalkini", "Shibchar"],
        Magura: ["Magura Sadar", "Mohammadpur", "Shalikha", "Sreepur"],
        Manikganj: [
            "Daulatpur",
            "Ghior",
            "Harirampur",
            "Manikganj Sadar",
            "Saturia",
            "Shivalaya",
            "Singair",
        ],
        Meherpur: ["Gangni", "Meherpur Sadar", "Mujibnagar"],
        Moulvibazar: [
            "Barlekha",
            "Juri",
            "Kamalganj",
            "Kulaura",
            "Moulvibazar Sadar",
            "Rajnagar",
            "Sreemangal",
        ],
        Munshiganj: [
            "Gazaria",
            "Lohajang",
            "Munshiganj Sadar",
            "Sirajdikhan",
            "Sreenagar",
            "Tongibari",
        ],
        Mymensingh: [
            "Bhaluka",
            "Dhobaura",
            "Fulbaria",
            "Gaffargaon",
            "Gauripur",
            "Haluaghat",
            "Ishwarganj",
            "Mymensingh Sadar",
            "Muktagachha",
            "Nandail",
            "Phulpur",
            "Trishal",
        ],
        Naogaon: [
            "Atrai",
            "Badalgachhi",
            "Dhamoirhat",
            "Manda",
            "Mohadevpur",
            "Naogaon Sadar",
            "Niamatpur",
            "Patnitala",
            "Porsha",
            "Raninagar",
            "Sapahar",
        ],
        Narail: ["Kalia", "Lohagara", "Narail Sadar"],
        Narayanganj: [
            "Araihazar",
            "Bandar",
            "Narayanganj Sadar",
            "Rupganj",
            "Sonargaon",
        ],
        Narsingdi: [
            "Belabo",
            "Monohardi",
            "Narsingdi Sadar",
            "Palash",
            "Raipura",
            "Shibpur",
        ],
        Natore: [
            "Bagatipara",
            "Baraigram",
            "Gurudaspur",
            "Lalpur",
            "Natore Sadar",
            "Singra",
        ],
        Netrokona: [
            "Atpara",
            "Barhatta",
            "Durgapur",
            "Khaliajuri",
            "Kalmakanda",
            "Kendua",
            "Madan",
            "Mohanganj",
            "Netrokona Sadar",
            "Purbadhala",
        ],
        Nilphamari: [
            "Dimla",
            "Domar",
            "Jaldhaka",
            "Kishoreganj",
            "Nilphamari Sadar",
            "Saidpur",
        ],
        Noakhali: [
            "Begumganj",
            "Chatkhil",
            "Companiganj",
            "Hatia",
            "Lakshmipur Sadar",
            "Noakhali Sadar",
            "Senbagh",
            "Subarnachar",
        ],
        Pabna: [
            "Atgharia",
            "Bera",
            "Bhangura",
            "Chatmohar",
            "Faridpur",
            "Ishwardi",
            "Pabna Sadar",
            "Santhia",
            "Sujanagar",
        ],
        Panchagarh: [
            "Atwari",
            "Boda",
            "Debiganj",
            "Panchagarh Sadar",
            "Tetulia",
        ],
        Patuakhali: [
            "Bauphal",
            "Dashmina",
            "Dumki",
            "Galachipa",
            "Kalapara",
            "Mirzaganj",
            "Patuakhali Sadar",
            "Rangabali",
        ],
        Pirojpur: [
            "Bhandaria",
            "Kawkhali",
            "Mathbaria",
            "Nazirpur",
            "Nesarabad (Swarupkathi)",
            "Pirojpur Sadar",
            "Zianagar",
        ],
        Rajbari: ["Baliakandi", "Goalandaghat", "Pangsha", "Rajbari Sadar"],
        Rajshahi: [
            "Bagha",
            "Bagmara",
            "Charghat",
            "Durgapur",
            "Godagari",
            "Mohanpur",
            "Paba",
            "Puthia",
            "Tanore",
        ],
        Rangamati: [
            "Baghaichhari",
            "Barkal",
            "Kawkhali (Betbunia)",
            "Belaichhari",
            "Juraichhari",
            "Kaptai",
            "Langadu",
            "Naniarchar",
            "Rajasthali",
            "Rangamati Sadar",
        ],
        Rangpur: [
            "Badarganj",
            "Gangachhara",
            "Kaunia",
            "Rangpur Sadar",
            "Mithapukur",
            "Pirgachha",
            "Pirganj",
            "Taraganj",
        ],
        Satkhira: [
            "Assasuni",
            "Debhata",
            "Kalaroa",
            "Kaliganj",
            "Satkhira Sadar",
            "Shyamnagar",
            "Tala",
        ],
        Shariatpur: [
            "Bhedarganj",
            "Damudya",
            "Gosairhat",
            "Naria",
            "Shariatpur Sadar",
            "Zajira",
        ],
        Sherpur: [
            "Jhenaigati",
            "Nakla",
            "Nalitabari",
            "Sherpur Sadar",
            "Sreebardi",
        ],
        Sirajganj: [
            "Belkuchi",
            "Chauhali",
            "Kamarkhanda",
            "Kazipur",
            "Raiganj",
            "Shahjadpur",
            "Sirajganj Sadar",
            "Tarash",
            "Ullahpara",
        ],
        Sunamganj: [
            "Bishwamvarpur",
            "Chhatak",
            "Dakshin Sunamganj",
            "Derai",
            "Dharampasha",
            "Dowarabazar",
            "Jagannathpur",
            "Jamalganj",
            "Sullah",
            "Sunamganj Sadar",
            "Tahirpur",
        ],
        Sylhet: [
            "Balaganj",
            "Beanibazar",
            "Bishwanath",
            "Companiganj",
            "Dakshin Surma",
            "Fenchuganj",
            "Golapganj",
            "Gowainghat",
            "Jaintiapur",
            "Kanaighat",
            "Sylhet Sadar",
            "Zakiganj",
        ],
        Tangail: [
            "Basail",
            "Bhuapur",
            "Delduar",
            "Dhanbari",
            "Ghatail",
            "Gopalpur",
            "Kalihati",
            "Madhupur",
            "Mirzapur",
            "Nagarpur",
            "Sakhipur",
            "Tangail Sadar",
        ],
        Thakurgaon: [
            "Baliadangi",
            "Haripur",
            "Pirganj",
            "Ranisankail",
            "Thakurgaon Sadar",
        ],
    };

    document
        .getElementById("district")
        .addEventListener("change", function() {
            const district = this.value;
            const upazillaSelect = document.getElementById("upazilla");
            upazillaSelect.innerHTML =
                '<option value="" disabled selected>Select upazilla</option>';

            if (district) {
                const cities = citiesBydistrict[district];
                cities.forEach((upazilla) => {
                    const option = document.createElement("option");
                    option.value = upazilla;
                    option.textContent = upazilla;
                    upazillaSelect.appendChild(option);
                });
            }
        });

    function getLocation() {
        // Check if Geolocation is supported
        if (navigator.geolocation) {
            // Get the current position
            navigator.geolocation.getCurrentPosition(showPosition, showError);
        } else {
            document.getElementById("location").innerHTML = "Geolocation is not supported by this browser.";
        }
    }

    function showPosition(position) {
        const latitude = position.coords.latitude;
        const longitude = position.coords.longitude;
        document.getElementById("latitude").value = latitude;
        document.getElementById("longitude").value = longitude;
    }

    function showError(error) {
        // Handle errors
        switch (error.code) {
            case error.PERMISSION_DENIED:
                document.getElementById("location").innerHTML = "User denied the request for Geolocation.";
                break;
            case error.POSITION_UNAVAILABLE:
                document.getElementById("location").innerHTML = "Location information is unavailable.";
                break;
            case error.TIMEOUT:
                document.getElementById("location").innerHTML = "The request to get user location timed out.";
                break;
            case error.UNKNOWN_ERROR:
                document.getElementById("location").innerHTML = "An unknown error occurred.";
                break;
        }
    }
</script>

</html>