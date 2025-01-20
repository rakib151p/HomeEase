<?php
session_start();
$previousPage = $_SERVER['HTTP_REFERER'] ?? 'javascript:history.back()';;
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    echo $_POST['item_id'] . $_POST['user_street_address'] . $_POST['user_unit_apt'];
    $item_id = $_POST['item_id'];
    $user_street_address = $_POST['user_street_address'];
    $user_unit_apt = $_POST['user_unit_apt'];
}else if(isset($_GET['item_id'])){
    $item_id = $_GET['item_id'];
    $user_street_address = $_GET['user_street_address'];
    $user_unit_apt = $_GET['user_unit_apt'];
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
    <?php
    include 'header.php';
    ?>
    <div align="center">
        <h1 class="text-2xl font-bold mb-8">Task Progress</h1>

        <!-- Progress Bar -->
        <div class="w-3/4 flex items-center">
            <!-- Circle 1 -->
            <a href="<?php echo "bookingstep1.php?item_id=".$item_id; ?>">
                <div class="relative flex flex-col items-center">
                    <div id="circle1" class="w-8 h-8 rounded-full flex items-center justify-center border-4 border-blue-600  text-blue-700 text-black font-semibold">
                        1
                    </div>
                    <span class="text-xs mt-2 text-blue-700">Location</span>
                </div>
            </a>
            <!-- Line 1 -->
            <div id="line1" class="flex-1 h-1 bg-blue-600"></div>

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

    <!-- Step 2: Task Options -->
    <div id="task-options"
        class="max-w-4xl mx-auto mt-10 p-6 bg-white shadow rounded-lg bg-gradient-to-bl from-blue-100 via-white to-blue-50 shadow-xl">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">Task Options</h3>
        <p class="text-gray-600 text-sm mb-6">How big is your task?</p>

        <form action="bookingstep3.php" class="space-y-4" method="POST">
            <div class="space-y-2">
                <label class="flex items-center">
                    <input type="radio" name="task-size" value="Small"
                        class="h-4 w-4 text-blue-600 border-gray-300 focus:ring-blue-500" required>
                    <span class="ml-2 text-gray-700">Small - Est. 1-2 hr</span>
                </label>
                <label class="flex items-center">
                    <input type="radio" name="task-size" value="Medium"
                        class="h-4 w-4 text-blue-600 border-gray-300 focus:ring-blue-500" required>
                    <span class="ml-2 text-gray-700">Medium - Est. 2-3 hrs</span>
                </label>
                <label class="flex items-center">
                    <input type="radio" name="task-size" value="Large"
                        class="h-4 w-4 text-blue-600 border-gray-300 focus:ring-blue-500" required>
                    <span class="ml-2 text-gray-700">Large - Est. 3-4+ hrs</span>
                </label>
                <input type="hidden" name="item_id" value="<?php echo htmlspecialchars($item_id); ?>">
                <input type="hidden" name="user_street_address" value="<?php echo htmlspecialchars($user_street_address); ?>">
                <input type="hidden" name="user_unit_apt" value="<?php echo htmlspecialchars($user_unit_apt); ?>">
            </div>
            <button type="submit"
                class="w-full py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Continue</button>
        </form>
    </div>
    <?php
    include '../footer.php';

    ?>
</body>

</html>