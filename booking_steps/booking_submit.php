<?php
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
    $taskSize = $_POST['task_size'] ?? '';
    $taskSummary = $_POST['task_summary'] ?? '';

    // Print the values
    echo "<h2>Posted Values</h2>";
    echo "<table border='1' cellpadding='5' cellspacing='0'>";
    echo "<tr><th>Field</th><th>Value</th></tr>";
    echo "<tr><td>Date</td><td>" . htmlspecialchars($selectedDate) . "</td></tr>";
    echo "<tr><td>Time</td><td>" . htmlspecialchars($selectedTime) . "</td></tr>";
    echo "<tr><td>Provider</td><td>" . htmlspecialchars($selectedProvider) . "</td></tr>";
    echo "<tr><td>Item ID</td><td>" . htmlspecialchars($selectedItemId) . "</td></tr>";
    echo "<tr><td>Item Name</td><td>" . htmlspecialchars($selectedItemName) . "</td></tr>";
    echo "<tr><td>Street Address</td><td>" . htmlspecialchars($userStreetAddress) . "</td></tr>";
    echo "<tr><td>Unit/Apt</td><td>" . htmlspecialchars($userUnitApt) . "</td></tr>";
    echo "<tr><td>Task Size</td><td>" . htmlspecialchars($taskSize) . "</td></tr>";
    echo "<tr><td>Task Summary</td><td>" . htmlspecialchars($taskSummary) . "</td></tr>";
    echo "</table>";
} else {
    echo "No data was posted.";
}
?>
