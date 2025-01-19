<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_SESSION['email'])) {
    $item_id = $_POST['item_id'];
    $item_name = $_POST['item_name'];
    $item_details = $_POST['item_details'];
} else {
    header("Location: ../login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Form</title>
    <style>
        body {
            padding: 0;
            margin: 0;
        }
    </style>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>
</head>

<body class="bg-gradient-to-bl from-blue-100 via-white to-blue-50 font-sans h-screen">

    <?php include 'header.php'; ?>

    <div align="center">
        <h1 class="text-2xl font-bold mb-8">Task Progress</h1>

        <!-- Progress Bar -->
        <div class="w-3/4 flex items-center">
            <!-- Circle 1 -->
            <div class="relative flex flex-col items-center">
                <div id="circle1" class="w-8 h-8 rounded-full flex items-center justify-center border-4 border-gray-300 bg-white text-gray-700 text-black font-semibold">
                    1
                </div>
                <span class="text-xs mt-2 text-gray-700">Location</span>
            </div>
            <!-- Line 1 -->
            <div id="line1" class="flex-1 h-1 bg-gray-300"></div>

            <div class="relative flex flex-col items-center">
                <div id="circle2" class="w-8 h-8 rounded-full flex items-center justify-center border-4 border-gray-300 bg-white text-gray-700 font-semibold">
                    2
                </div>
                <span class="text-xs mt-2 text-gray-700">Browse</span>
            </div>
            <!-- Line 2 -->
            <div id="line2" class="flex-1 h-1 bg-gray-300"></div>

            <!-- Circle 3 -->
            <div class="relative flex flex-col items-center">
                <div id="circle3" class="w-8 h-8 rounded-full flex items-center justify-center border-4 border-gray-300 bg-white text-gray-700 font-semibold">
                    3
                </div>
                <span class="text-xs mt-2 text-gray-700">Confirm</span>
            </div>
            <!-- Line 3 -->
            <div id="line3" class="flex-1 h-1 bg-gray-300"></div>

            <!-- Circle 4 -->
            <div class="relative flex flex-col items-center">
                <div id="circle4" class="w-8 h-8 rounded-full flex items-center justify-center border-4 border-gray-300 bg-white text-gray-700 font-semibold">
                    4
                </div>
                <span class="text-xs mt-2 text-gray-700">Complete</span>
            </div>
        </div>


    </div>









    <div id="location-form" class="max-w-4xl mx-auto mt-10 p-6 bg-white shadow rounded-lg bg-gradient-to-bl from-blue-100 via-white to-blue-50 shadow-xl">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4"><?php echo $item_name; ?></h2>
        <h5 class="text-2xl font-semibold text-gray-800 mb-4">
            Item details:<?php echo $item_details; ?>
        </h5>
        <p class="text-gray-600 text-sm mb-6">
            Tell us about your task. We use these details to show Taskers in your area who fit your needs.
        </p>

        <form action="bookingstep2.php" class="space-y-4">
            <div>
                <label for="street" class="block text-sm font-medium text-gray-700">Your task location</label>
                <input type="text" id="street" placeholder="Street address" class="w-full mt-1 p-3 border border-gray-300 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-600" required>
            </div>
            <div>
                <input type="text" id="apartment" placeholder="Unit or apt #" class="w-full mt-1 p-3 border border-gray-300 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-600" required>
            </div>
            <button type="submit" class="w-full py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Continue</button>
        </form>
    </div>


    <?php
    include '../footer.php';
    ?>

</body>

</html>