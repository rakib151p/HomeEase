<?php
include '../config.php';
session_start();
$bookingSuccess = false;
$confirmationDetails = [];
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve values from the POST request
    $selectedDate = $_POST['selected_date'] ?? '';
    $selectedTime = $_POST['selected_time'] ?? '';
    $selectedProvider = $_POST['selected_provider'] ?? '';
    $selectedItemId = $_POST['selected_item_id'] ?? '';
    $selectedItemName = $_POST['selected_item_name'] ?? '';
    $userStreetAddress = $_POST['street_address'] ?? '';
    $userUnitApt = $_POST['selected_user_unit_apt'] ?? '';
    $task_size = $_POST['task_size'] ?? ''; // Get the task size from the form or set to an empty string if not set

    // Assign numeric values based on task size
    if ($task_size === 'Small') {
        $task_size_value = 1;
    } elseif ($task_size === 'Medium') {
        $task_size_value = 2;
    } elseif ($task_size === 'Large') {
        $task_size_value = 3;
    } else {
        $task_size_value = ''; // or set a default value if needed
    }
    $taskSize = $task_size_value;
    $taskSummary = $_POST['task_summary'] ?? '';
    $userId = $_SESSION['user_id'];

    //payment slip

    $confirmationDetails = [
        "Booking Date" => htmlspecialchars($selectedDate),
        "Booking Time" => htmlspecialchars($selectedTime),
        "Provider ID" => htmlspecialchars($selectedProvider),
        "Item ID" => htmlspecialchars($selectedItemId),
        "Item Name" => htmlspecialchars($selectedItemName),
        "Street Address" => htmlspecialchars($userStreetAddress),
        "Unit/Apt" => htmlspecialchars($userUnitApt),
        "Task Size" => htmlspecialchars($taskSize),
        "Task Summary" => htmlspecialchars($taskSummary)
    ];
    //query part
    if (!empty($selectedDate) && !empty($selectedTime) && !empty($selectedProvider) && !empty($selectedItemId) && !empty($userId)) {
        // Prepare the SQL query
        $sql = "INSERT INTO booking (user_id, provider_id, booking_time, booking_date, item_id, task_length, task_details) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";

        // Prepare the statement
        $stmt = $con->prepare($sql);

        if ($stmt) {
            // Bind parameters
            $stmt->bind_param(
                "iisssis",
                $userId,
                $selectedProvider,
                $selectedTime,
                $selectedDate,
                $selectedItemId,
                $taskSize,
                $taskSummary
            );

            // Execute the statement
            if ($stmt->execute()) {
                // echo "Booking successfully created.";
                $bookingSuccess = true;
            } else {
                echo "Error: " . $stmt->error;
            }

            // Close the statement
            $stmt->close();
        } else {
            echo "Error: " . $con->error;
        }
    } else {
        echo "Please fill in all required fields.";
    }

    // Print the values
    // echo "<h2>Posted Values</h2>";
    // echo "<table border='1' cellpadding='5' cellspacing='0'>";
    // echo "<tr><th>Field</th><th>Value</th></tr>";
    // echo "<tr><td>Date</td><td>" . htmlspecialchars($selectedDate) . "</td></tr>";
    // echo "<tr><td>Time</td><td>" . htmlspecialchars($selectedTime) . "</td></tr>";
    // echo "<tr><td>Provider</td><td>" . htmlspecialchars($selectedProvider) . "</td></tr>";
    // echo "<tr><td>Item ID</td><td>" . htmlspecialchars($selectedItemId) . "</td></tr>";
    // echo "<tr><td>Item Name</td><td>" . htmlspecialchars($selectedItemName) . "</td></tr>";
    // echo "<tr><td>Street Address</td><td>" . htmlspecialchars($userStreetAddress) . "</td></tr>";
    // echo "<tr><td>Unit/Apt</td><td>" . htmlspecialchars($userUnitApt) . "</td></tr>";
    // echo "<tr><td>Task Size</td><td>" . htmlspecialchars($taskSize) . "</td></tr>";
    // echo "<tr><td>Task Summary</td><td>" . htmlspecialchars($taskSummary) . "</td></tr>";
    // echo "</table>";
} else {
    echo "No data was posted.";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="max-w-2xl w-full bg-white shadow-lg rounded-lg p-6">
        <?php if ($bookingSuccess): ?>
            <h1 class="text-2xl font-bold text-green-600 text-center">Booking Confirmed!</h1>
            <p class="text-gray-600 text-center mt-2">Your booking has been successfully placed. Below are the details:</p>
            <div class="mt-4 border-t border-gray-300 pt-4">
                <ul class="space-y-2">
                    <?php foreach ($confirmationDetails as $key => $value): ?>
                        <li class="flex justify-between">
                            <span class="font-medium text-gray-700"><?= $key; ?>:</span>
                            <span class="text-gray-600"><?= $value; ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php else: ?>
            <h1 class="text-2xl font-bold text-red-600 text-center">Booking Failed</h1>
            <p class="text-gray-600 text-center mt-2"><?= $errorMsg ?? "An unknown error occurred."; ?></p>
        <?php endif; ?>
        <div class="mt-6 text-center">
            <a href="../home.php" class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition">
                Go to Home
            </a>
        </div>
    </div>
</body>

</html>