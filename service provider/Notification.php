<?php
session_start();
include '../config.php';

// Check if the provider is logged in
if (!isset($_SESSION['provider_id'])) {
    header('Location: ../login.php');
    exit();
}

$provider_id = $_SESSION['provider_id'];

// Fetch notifications for the provider
$sql = "SELECT * FROM notifications_by_admin WHERE provider_id = ? ORDER BY date_time DESC";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $provider_id);
$stmt->execute();
$result = $stmt->get_result();

$notifications = [];
while ($row = $result->fetch_assoc()) {
    $notifications[] = $row;
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
                <h2 class="mt-4 font-semibold text-lg"><?php echo $_SESSION['provider_name']; ?></h2>
                <p class="text-sm text-gray-500">Provider ID: <?php echo $_SESSION['provider_id']; ?></p>
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
            <div class="main-content p-4 flex-1">
                <h2 class="text-xl font-bold mb-4">Notifications</h2>
                <?php if (count($notifications) > 0): ?>
                    <?php foreach ($notifications as $notification): ?>
                        <div class="bg-blue-100 border border-blue-400 text-green-700 my-5 px-4 py-3 rounded relative" role="alert">
                            <h4 class="font-bold text-lg"><?php echo htmlspecialchars($notification['subject']); ?></h4>
                            <p class="mt-2"><?php echo htmlspecialchars($notification['message']); ?></p>
                            <span class="text-sm text-gray-500"><?php echo htmlspecialchars($notification['date_time']); ?></span>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-gray-600">You have no notifications.</p>
                <?php endif; ?>
            </div>
        </main>

    </div>

</body>

</html>