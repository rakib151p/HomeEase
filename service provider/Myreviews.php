<?php 
session_start();
include '../config.php';

// Get reviews for the logged-in service provider
$provider_id = $_SESSION['provider_id'];
$query = "SELECT r.review_id, r.review_text, r.review_rating, r.review_time, u.user_name, u.user_address 
          FROM service_provider_review r
          JOIN user u ON r.customer_id = u.user_id
          WHERE r.service_provider_id = '$provider_id' 
          ORDER BY r.review_time DESC"; 

$result = mysqli_query($con, $query);
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
    <?php include 'header.php'; ?>
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
                <a href="" class="flex items-center px-4 py-2 text-blue-600 bg-blue-100 rounded-md">
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
            <div id="box1">
                <div class="overflow-x-auto tables">
                    <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                        <thead class="bg-blue-500 text-white">
                            <tr>
                                <th class="px-4 py-2 text-left">Serial</th>
                                <th class="px-4 py-2 text-left">Customer</th>
                                <th class="px-4 py-2 text-left">Customer Address</th>
                                <th class="px-4 py-2 text-left">Review</th>
                                <th class="px-4 py-2 text-left">Rating</th>
                                <th class="px-4 py-2 text-left">Date & Time</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700">
                            <?php 
                            if (mysqli_num_rows($result) > 0) {
                                $serial = 1;
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<tr class="border-t">
                                            <td class="px-4 py-2">'.$serial.'</td>
                                            <td class="px-4 py-2">'.$row['user_name'].'</td>
                                            <td class="px-4 py-2">'.$row['user_address'].'</td>
                                            <td class="px-4 py-2">'.$row['review_text'].'</td>
                                            <td class="px-4 py-2">'.$row['review_rating'].'</td>
                                            <td class="px-4 py-2">'.$row['review_time'].'</td>
                                          </tr>';
                                    $serial++;
                                }
                            } else {
                                echo '<tr><td colspan="6" class="px-4 py-2 text-center">No reviews available</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
    <?php include 'footer.php'; ?>

</body>
</html>
