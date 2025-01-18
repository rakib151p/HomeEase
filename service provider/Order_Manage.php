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
                <a href="" class="flex items-center px-4 py-2 text-blue-600 bg-blue-100 rounded-md">
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
                <a href="#" class="flex items-center px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-md">
                    <span class="material-icons mr-3">Log Out</span>
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6">
            <div class="box1">

                <div class="overflow-x-auto tables">
                    <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-l border-2 border-blue-100">
                        <thead class="bg-blue-500 text-white">
                            <tr>
                                <th class="px-2 py-1 text-left">Booking Date</th>
                                <th class="px-2 py-1 text-left">Customer</th>
                                <th class="px-2 py-1 text-left">Customer address</th>
                                <th class="px-2 py-1 text-left">Service Item</th>
                                <th class="px-2 py-1 text-left">Appointment date</th>
                                <th class="px-2 py-1 text-left">Time</th>
                                <th class="px-2 py-1 text-left">Status</th>
                                <th class="px-2 py-1 text-left" colspan="3">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700">
                            <!-- Example Static Data Row -->
                            <tr class="border-t">
                                <td class="px-2 py-1">2025-01-16</td>
                                <td class="px-2 py-1">Sample Shop</td>
                                <td class="px-2 py-1">New York, NY, Broadway</td>
                                <td class="px-2 py-1">Haircut</td>
                                <td class="px-2 py-1">2025-01-18</td>
                                <td class="px-2 py-1">10:00 AM</td>
                                <td class="px-2 py-1">Pending</td>
                                <td class="px-2 py-1">
                                    <button type="button" class="text-blue-500">Confirm?</button>
                                </td>
                                <td class="px-2 py-1">
                                    <button type="submit" name="change" onclick="rating('123')" style="padding: 0; border: none; background: none;margin-right:30px;">
                                        <img src="../image/icon/star.png" alt="Submit" style="width: 40px; height: 40px; position:relative; right:56px;">
                                    </button>
                                </td>
                                <form action="" method="POST">
                                    <input type="hidden" name="booking_id" value="123">
                                    <td class="mr-5 px-0 py-1">
                                        <button type="submit" name="cancel" style="padding: 0; border: none; background: none;">
                                            <img src="../image/icon/cancel.png" alt="Cancel" style="width: 40px; height: 40px; position:relative; right:60px;">
                                        </button>
                                    </td>
                                </form>
                            </tr>
                            <!-- Repeat similar rows for more bookings -->
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>

</body>

</html>