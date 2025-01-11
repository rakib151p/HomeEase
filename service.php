<?php
include 'config.php';

if (isset($_GET['item_id'])) {
    $item_id = $_GET['item_id'];

    // Use this item_id to fetch subservice details from the database
    $query = "SELECT * FROM item WHERE item_id = '$item_id'";
    $result = $con->query($query);

    if ($result->num_rows > 0) {
        $item = $result->fetch_assoc();
        $item_name = $item['item_name'];
        $item_details = $item['item_details'];

        // Automatically create a form and submit it
        echo '
        <form id="bookingForm" action="booking_steps/bookingstep1.php" method="POST">
            <input type="hidden" name="item_id" value="' . htmlspecialchars($item_id) . '">
            <input type="hidden" name="item_name" value="' . htmlspecialchars($item_name) . '">
            <input type="hidden" name="item_details" value="' . htmlspecialchars($item_details) . '">
        </form>
        <script>
            document.getElementById("bookingForm").submit();
        </script>
        ';
    } else {
        echo "Subservice not found.";
    }
} else {
    echo "No item selected.";
}
?>
