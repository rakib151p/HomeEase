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




</body>

</html>