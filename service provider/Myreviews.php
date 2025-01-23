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
                <a href="#" class="flex items-center px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-md">
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
                                <th class="px-4 py-2 text-left">customer</th>
                                <th class="px-4 py-2 text-left">Customer Address</th>
                                <th class="px-4 py-2 text-left">Review</th>
                                <th class="px-4 py-2 text-left">Rating</th>
                                <th class="px-4 py-2 text-left">Date & Time</th>
                                <th class="px-4 py-2 text-center" colspan="2">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700">
                            <!-- Example Static Data Row -->
                            <tr class="border-t">
                                <td class="px-4 py-2">1</td>
                                <td class="px-4 py-2">Sample Shop</td>
                                <td class="px-4 py-2">New York, NY, Broadway</td>
                                <td class="px-4 py-2">Great service!</td>
                                <td class="px-4 py-2">5</td>
                                <td class="px-4 py-2">2025-01-16 10:00 AM</td>
                                <td class="px-2 py-1">
                                    <button type="submit" name="change" class="text-blue-500">Change</button>
                                </td>
                                <td class="px-2 py-1">
                                    <form action="myreviews.php" method="POST">
                                        <input type="hidden" name="review_id" value="123">
                                        <button type="submit" name="cancel" class="text-red-500">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            <!-- Repeat similar rows for more reviews -->
                        </tbody>
                    </table>
                </div>
            </div>




        </main>
    </div>

</body>

</html>