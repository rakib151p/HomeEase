<?php
include 'config.php';
if (isset($_GET['item_id'])) {
    $item_id = $_GET['item_id'];
    // Use this item_id to fetch subservice details from the database
    // Example: Query to get subservice details
    $query = "SELECT * FROM item WHERE item_id = '$item_id'";
    $result = $con->query($query);
    if ($result->num_rows > 0) {
        $item = $result->fetch_assoc();
        // You can now use $item['item_name'], $item['item_details'], etc.
        echo $item_id." ".$item['item_name']." ".$item['item_details'];
    } else {
        echo "Subservice not found.";
    }
} else {
    echo "No item selected.";
}
?>