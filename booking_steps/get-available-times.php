<?php

include '../config.php'; // Ensure this file establishes a database connection

header('Content-Type: application/json');
$date = $_GET['date'] ?? null; // Get the date from the query string or default to null
$tasker_id = $_GET['tasker_id'] ?? null; // Get the tasker_id from the query string or default to null

$arr = [];
$bookingDate = $date ?? '2025-01-01'; // Use the provided date or default to '2025-01-01'
$times = ['08:00 AM', '12:00 AM', '04:00 PM']; // Time slots to check
// $date = "2025-01-01";
// Prepare SQL query to fetch booked times
$sql = "SELECT time_slot 
        FROM (SELECT '08:00 AM' AS time_slot
            UNION ALL
            SELECT '12:00 AM'
            UNION ALL
            SELECT '04:00 PM') AS all_times
        WHERE time_slot NOT IN (
            SELECT booking_time 
            FROM booking 
            WHERE booking_date = ? AND provider_id=?
        )";
$stmt = $con->prepare($sql);
// $arr[] = 'Failed to prepare SQL statement';
if (!$stmt) {
    $arr[] = 'Failed to prepare SQL statement';
    echo json_encode($arr);
    exit;
}

// Bind the bookingDate parameter and execute the query
$stmt->bind_param("si", $date,$tasker_id);
$stmt->execute();
$result = $stmt->get_result();

// Fetch the booked times
$bookedTimes = ["12,"];
while ($row = $result->fetch_assoc()) {
    $arr[] = $row['time_slot'];
}
// $arr[]=$date;
// Find available times by excluding booked ones
// $availableTimes = array_diff($times, $bookedTimes);

// Output the JSON response
echo json_encode($date ? array_merge($arr) : ["11:00"]);
