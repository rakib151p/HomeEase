<?php 
session_start();
include '../config.php';

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
                <a href="Order_Manage.php" class="flex items-center px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-md">
                    <span class="material-icons mr-3">Order Manage</span>
                </a>
                <a href="order_history.php" class="flex items-center px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-md">
                    <span class="material-icons mr-3">History</span>
                </a>
                <a href="Myreviews.php" class="flex items-center px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-md">
                    <span class="material-icons mr-3">My reviews</span>
                </a>
                <a href="Notification.php" class="flex items-center px-4 py-2 text-blue-600 bg-blue-100 rounded-md">
                    <span class="material-icons mr-3">Notifications</span>
                </a>
                <a href="../logout.php" class="flex items-center px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-md">
                    <span class="material-icons mr-3">Log Out</span>
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6">
            <!-- Main Content Area -->

            <div class="main-content p-4 flex-1">

                <!-- Static Notification Example -->
                <div class="bg-blue-100 border border-blue-400 text-green-700 my-5 px-4 py-3 rounded relative" role="alert">
                    <h4 class="font-bold text-lg">New Update Available!</h4>
                    <p class="mt-2">The latest version of the app is now available. Please update to enjoy new features.</p>
                    <p class="mb-0">Admin, RadientHub BD</p>
                    <span id="current-time" class="absolute bottom-0 right-0 mb-2 mr-2 text-sm text-gray-500">2025-01-16 10:00 AM</span>
                </div>
                <!-- Another Static Notification Example -->
                <div class="bg-blue-100 border border-blue-400 text-green-700 my-5 px-4 py-3 rounded relative" role="alert">
                    <h4 class="font-bold text-lg">Maintenance Notice</h4>
                    <p class="mt-2">Scheduled maintenance will occur on January 20, 2025, from 2:00 AM to 4:00 AM.</p>
                    <p class="mb-0">Admin, RadientHub BD</p>
                    <span id="current-time" class="absolute bottom-0 right-0 mb-2 mr-2 text-sm text-gray-500">2025-01-14 08:00 PM</span>
                </div>
            </div>


        </main>
    </div>

</body>

</html>