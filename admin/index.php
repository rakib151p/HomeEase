<?php
include "../config.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upstats Dashboard</title>
    <!-- <link rel="stylesheet"href="index_style.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <style>
        body {
            font-family: cursive;
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            background-color: #00014E;
            width: 250px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .logo {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .logo img {
            width: 40px;
            height: 40px;
            margin-right: 10px;
        }

        .logo h1 {
            font-size: 20px;
            font-weight: bold;
            margin: 0;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar li {
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }

        .sidebar li img {
            width: 20px;
            height: 20px;
            margin-right: 10px;
        }

        .sidebar li a {
            text-decoration: none;
            /* color: #333; */
            font-weight: bold;
        }

        .main-content {
            flex: 1;
            /* padding: 20px; */
        }

        .header {
            display: flex;
            background-color: #00E081;
            color: white;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            width: 1625px;
            box-shadow: 1px 1px 5px 3px rgba(0, 0, 0, 0.1);
            /* border:1px solid black; */
            height: 100px;
        }

        .header h2 {
            font-size: 24px;
            font-weight: bold;
            margin: 0;
        }

        .search-bar {
            position: relative;
            width: 300px;
            height: 40px;
            border-radius: 20px;
            background-color: white;
            padding: 10px 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .search-bar input {
            width: 100%;
            height: 100%;
            border: none;
            outline: none;
            font-size: 16px;
            padding: 0 10px;
        }

        .search-bar img {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            width: 20px;
            height: 20px;
        }

        .notification {
            display: flex;
            align-items: center;
        }

        .notification img {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .notification span {
            font-size: 14px;
            color: #555;
            margin-right: 10px;
        }

        .notification h3 {
            font-size: 16px;
            font-weight: bold;
            margin: 0;
        }

        .dashboard-content {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .card {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            width: calc(50% - 10px);
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .card h3 {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .chart-container {
            width: 100%;
            height: 400px;
        }

        .chart-options {
            display: flex;
            justify-content: flex-end;
            margin-top: 10px;
        }

        .chart-options button {
            background-color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            margin-left: 5px;
            cursor: pointer;
        }

        .chart-options button.active {
            background-color: #007bff;
            color: white;
        }

        .card-content {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .card-content .number {
            font-size: 40px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .card-content span {
            font-size: 14px;
            color: #555;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .metrics {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 10px;
            width: calc(33.33% - 10px);
            margin-bottom: 10px;
        }

        .metrics h3 {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .metrics .rating {
            font-size: 24px;
            font-weight: bold;
        }

        .metrics .number {
            font-size: 20px;
            font-weight: bold;
        }

        /* Carousel Container */
        .carousel-container {
            position: relative;
            max-width: 300px;
            margin: auto;
            overflow: hidden;
        }

        /* Carousel Inner Wrapper */
        .carousel-inner {
            display: flex;
            transition: transform 0.5s ease-in-out;
            width: 300%;
        }

        /* Card Style */
        .cards {
            background-color: #71C383;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 10px;
            text-align: center;
            width: 300px;
            /* Each card takes up a third of the width */
            height: 200px;
            box-sizing: border-box;
        }

        /* Name, Rating, and Feedback */
        .cards h3 {
            font-size: 1.5em;
            color: #333;
        }

        .cards .rating {
            color: #FFD700;
            /* Gold star color */
            font-size: 1.2em;
            margin: 10px 0;
        }

        .cards p {
            color: #666;
            font-size: 1em;
            margin-bottom: 15px;
        }

        /* View More Button */
        .view-more {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .view-more:hover {
            background-color: #0056b3;
        }

        /* Navigation Buttons */
        .prev-btn,
        .next-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 50%;
            font-size: 10px;
        }

        .prev-btn {
            left: 10px;
        }

        .next-btn {
            right: 10px;
        }

        .prev-btn:hover,
        .next-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container flex">
        <div class="sidebar bg-white p-4 shadow-md">
            <div class="logo flex items-center mb-4">
                <!-- <img src="logo.png" alt="Upstats Logo" class="w-10 h-10 mr-2"> -->
                <h1 style="color:rgb(211, 106, 124);font-size:38px;"><a href="../home.php"> HOMEEASE</a></h1>
            </div>
            <ul class="list-none p-5">
                <div class="hover:bg-pink-500 p-3 transition-colors duration-300 rounded-lg"><a href="#"
                        style="color:white;font-size:20px;">Dashboard</a></div>
                <div class="hover:bg-pink-500 p-3 transition-colors duration-300 rounded-lg"><a href="manage_shops.php"
                        style="color:white;font-size:20px;">Manage shops</a></div>
                <div class="hover:bg-pink-500 p-3 transition-colors duration-300 rounded-lg"><a href="manage_customer.php"
                        style="color:white;font-size:20px;">Manage customer</a> </div>
                <div class="hover:bg-pink-500 p-3 transition-colors duration-300 rounded-lg"><a href="check_Report.php"
                        style="color:white;font-size:20px;">Check Reports</a></div>
                <div class="hover:bg-pink-500 p-3 transition-colors duration-300 rounded-lg"><a href="Managed_legal_notice.php"
                        style="color:white;font-size:20px;">Managed legal notice</a></div>
                <div class="hover:bg-pink-500 p-3 transition-colors duration-300 rounded-lg"><a href="../login.php"
                        style="color:white;font-size:20px;">Logout</a></div>
            </ul>
        </div>



        <div class="main-content p-4 flex-1">
            <div class="header flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold" style="margin:0 0 0 40px;">Welcome to Admin Panel</h2>
                <div class="notification flex items-center" style="margin-right:40px;">
                    <img src="1-change1.jpg" alt="Notification Icon" class="w-8 h-8 rounded-full mr-2">
                    <span class="text-gray-500 mr-2">HomeEase</span>
                    <h3 class="text-base font-bold">Admin</h3>
                </div>
            </div>

            <?php

            // Get the current date
            $current_date = date('Y-m-d');

            // Calculate the start and end date for the current week (25th to 31st of the current month)
            $current_month = date('m');
            $current_year = date('Y');

            // Check if current date is before or after 25th of the month
            if (date('d') < 25) {
                // If before 25th, the current week is from 25th to end of the previous month
                $current_week_start = date('Y-m-25', strtotime("first day of this month", strtotime($current_date)));
                $current_week_end = date('Y-m-t', strtotime($current_date));  // last day of the month
            } else {
                // If it's after the 25th, the current week is from 25th to 31st of the current month
                $current_week_start = date('Y-m-25', strtotime($current_date));
                $current_week_end = date('Y-m-31', strtotime($current_date));
            }

            // Calculate the last week range (18th to 24th)
            $last_week_start = date('Y-m-18', strtotime($current_date));
            $last_week_end = date('Y-m-24', strtotime($current_date));

            // Debugging to check dynamic ranges
            echo "Current Week Start: $current_week_start, Current Week End: $current_week_end<br>";
            echo "Last Week Start: $last_week_start, Last Week End: $last_week_end<br>";

            // Fetch responses for users in the current week (25th to 31st or the last 7 days)
            $user_query_current_week = "SELECT DATE(user_registration_date) AS date, COUNT(*) AS user_responses
                FROM user
                WHERE user_registration_date BETWEEN '$current_week_start' AND '$current_week_end'
                GROUP BY DATE(user_registration_date)
                ORDER BY DATE(user_registration_date)";
            $user_result_current_week = $con->query($user_query_current_week);

            $user_responses_current_week = [];
            while ($row = $user_result_current_week->fetch_assoc()) {
                $user_responses_current_week[$row['date']] = (int)$row['user_responses'];
            }

            // Fetch responses for users in the last week (18th to 24th)
            $user_query_last_week = "SELECT DATE(user_registration_date) AS date, COUNT(*) AS user_responses
             FROM user
             WHERE user_registration_date BETWEEN '$last_week_start' AND '$last_week_end'
             GROUP BY DATE(user_registration_date)
             ORDER BY DATE(user_registration_date)";
            $user_result_last_week = $con->query($user_query_last_week);

            $user_responses_last_week = [];
            while ($row = $user_result_last_week->fetch_assoc()) {
                $user_responses_last_week[$row['date']] = (int)$row['user_responses'];
            }

            // Fetch data for service providers in the current week (25th to 31st or the last 7 days)
            $provider_query_current_week = "SELECT DATE(provider_registration_date) AS date, COUNT(*) AS provider_responses
                    FROM service_provider
                    WHERE provider_registration_date BETWEEN '$current_week_start' AND '$current_week_end'
                    GROUP BY DATE(provider_registration_date)
                    ORDER BY DATE(provider_registration_date)";
            $provider_result_current_week = $con->query($provider_query_current_week);

            $provider_responses_current_week = [];
            while ($row = $provider_result_current_week->fetch_assoc()) {
                $provider_responses_current_week[$row['date']] = (int)$row['provider_responses'];
            }

            // Fetch data for service providers in the last week (18th to 24th)
            $provider_query_last_week = "SELECT DATE(provider_registration_date) AS date, COUNT(*) AS provider_responses
                 FROM service_provider
                 WHERE provider_registration_date BETWEEN '$last_week_start' AND '$last_week_end'
                 GROUP BY DATE(provider_registration_date)
                 ORDER BY DATE(provider_registration_date)";
            $provider_result_last_week = $con->query($provider_query_last_week);

            $provider_responses_last_week = [];
            while ($row = $provider_result_last_week->fetch_assoc()) {
                $provider_responses_last_week[$row['date']] = (int)$row['provider_responses'];
            }

            // Merge the data for current week and last week
            $merged_data = [];
            $dates = [];

            // Current week (dynamically calculated range)
            for ($i = strtotime($current_week_start); $i <= strtotime($current_week_end); $i = strtotime("+1 day", $i)) {
                $date = date('Y-m-d', $i);
                $dates[] = date('D', $i); // Get day of the week (Sun, Mon, etc.)
                $merged_data[$date] = [
                    'user_responses_current_week' => isset($user_responses_current_week[$date]) ? $user_responses_current_week[$date] : 0,
                    'provider_responses_current_week' => isset($provider_responses_current_week[$date]) ? $provider_responses_current_week[$date] : 0,
                ];
            }

            // Last week (dynamically calculated range)
            for ($i = strtotime($last_week_start); $i <= strtotime($last_week_end); $i = strtotime("+1 day", $i)) {
                $date = date('Y-m-d', $i);
                if (!isset($merged_data[$date])) {
                    $merged_data[$date] = [];
                }
                $merged_data[$date]['user_responses_last_week'] = isset($user_responses_last_week[$date]) ? $user_responses_last_week[$date] : 0;
                $merged_data[$date]['provider_responses_last_week'] = isset($provider_responses_last_week[$date]) ? $provider_responses_last_week[$date] : 0;
            }

            ?>


            <div class="dashboard-content flex flex-wrap justify-between">
                <div class="card bg-white rounded-lg p-4 w-full mb-4 shadow-md">
                    <h3 class="text-xl font-bold mb-2">Response of Last 7 Days</h3>
                    <div class="chart-container" style="width: 100%; height: 400px;">
                        <canvas id="responseChart"></canvas>
                    </div>
                </div>
                <script>
                    // Prepare data for the chart from PHP
                    const responseChartData = {
                        labels: <?php echo json_encode($dates); ?>, // Labels (Days of the week)
                        datasets: [{
                                label: 'User Responses (Current Week)',
                                data: <?php echo json_encode(array_column($merged_data, 'user_responses_current_week')); ?>,
                                borderColor: '#28a745',
                                borderWidth: 2,
                                fill: false
                            },
                            {
                                label: 'Service Provider Responses (Current Week)',
                                data: <?php echo json_encode(array_column($merged_data, 'provider_responses_current_week')); ?>,
                                borderColor: '#007bff',
                                borderWidth: 2,
                                fill: false
                            },
                            {
                                label: 'User Responses (Last Week)',
                                data: <?php echo json_encode(array_column($merged_data, 'user_responses_last_week')); ?>,
                                borderColor: '#ff5733',
                                borderWidth: 2,
                                fill: false,
                                borderDash: [5, 5] // Dotted line for last week data
                            },
                            {
                                label: 'Service Provider Responses (Last Week)',
                                data: <?php echo json_encode(array_column($merged_data, 'provider_responses_last_week')); ?>,
                                borderColor: '#00bfff',
                                borderWidth: 2,
                                fill: false,
                                borderDash: [5, 5] // Dotted line for last week data
                            }
                        ]
                    };

                    // Create the chart using Chart.js
                    const ctx = document.getElementById('responseChart').getContext('2d');
                    const responseChart = new Chart(ctx, {
                        type: 'line',
                        data: responseChartData,
                        pointBorderWidth: 1,

                        options: {
                            responsive: true,
                            scales: {
                                x: {
                                    title: {
                                        display: true,
                                        text: 'Date'
                                    },
                                    ticks: {
                                        // Optional: Add settings for ticks such as rotation or formatting
                                        autoSkip: true,
                                        maxRotation: 90,
                                        minRotation: 45
                                    }
                                },
                                y: {
                                    title: {
                                        display: true,
                                        text: 'Responses'
                                    },
                                    ticks: {
                                        // Optional: Set max and min for the y-axis
                                        beginAtZero: true
                                    }
                                }
                            }
                        }
                    });
                </script>
                <?php

                // Assuming you have a connection $conn to your MySQL database

                // Fetch the number of guests visiting for each month
                $guest_query = "SELECT 
                  DATE(user_registration_date) AS day, 
                  MONTH(user_registration_date) AS month, 
                  COUNT(*) AS guest_count 
                FROM user 
                WHERE user_status = 'notverified' 
                GROUP BY DATE(user_registration_date), MONTH(user_registration_date) 
                ORDER BY MONTH(user_registration_date), DATE(user_registration_date)";

                $guest_result = mysqli_query($con, $guest_query);

                $guest_data = array_fill(0, 12, 0);  // Initialize an array for 12 months

                while ($row = mysqli_fetch_assoc($guest_result)) {
                    $month = $row['month'] - 1;  // Adjust to 0-based index
                    $guest_data[$month] = $row['guest_count'];
                }

                // Fetch the number of reviews for each month
                $review_query = "SELECT MONTH(review_date) AS month, COUNT(*) AS review_count FROM review_platform GROUP BY MONTH(review_date) ORDER BY MONTH(review_date)";
                $review_result = mysqli_query($con, $review_query);

                $review_data = array_fill(0, 12, 0);  // Initialize an array for 12 months

                while ($row = mysqli_fetch_assoc($review_result)) {
                    $month = $row['month'] - 1;  // Adjust to 0-based index
                    $review_data[$month] = $row['review_count'];
                }

                // Encode the data to pass to JavaScript
                $guest_data_json = json_encode($guest_data);
                $review_data_json = json_encode($review_data);
                //echo json_encode($guest_data);
                //echo json_encode($review_data);

                ?>

                <div class="card bg-white rounded-lg p-4 w-full mb-4 shadow-md">
                    <h3 class="text-xl font-bold mb-2">Guest and Feedbacks Recieveing</h3>
                    <div class="chart-container" style="width: 80%; height: 300px;">
                        <canvas id="guestReviewChart"></canvas>
                    </div>
                </div>





                <script>
                    // Guest and Review Chart
                    const guestReviewChartData = {
                        labels: ["Jan", "Feb", "Mar", "Apr", "May", "June", "July", "Aug", "Sept", "Oct", "Nov", "Dec"],
                        datasets: [{
                                label: 'Number of Guests',
                                data: <?php echo $guest_data_json; ?>,
                                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                borderColor: 'rgba(255, 99, 132, 1)',
                                borderWidth: 1
                            },
                            {
                                label: 'Number of Reviews',
                                data: <?php echo $review_data_json; ?>,
                                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                borderColor: 'rgba(54, 162, 235, 1)',
                                borderWidth: 1
                            }
                        ]
                    };

                    const ctx2 = document.getElementById('guestReviewChart').getContext('2d');
                    new Chart(ctx2, {
                        type: 'bar',
                        data: guestReviewChartData,
                        options: {
                            responsive: true,
                            scales: {
                                x: {
                                    title: {
                                        display: true,
                                        text: 'Month'
                                    }
                                },
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                </script>



                <?php
                // Assuming you have a database connection established as $conn

                $query = "SELECT COUNT(*) AS total_services FROM `service`";
                $result = mysqli_query($con, $query);
                $row = mysqli_fetch_assoc($result);
                $total_services = $row['total_services'];
                ?>

                <div class="card rounded-lg p-4 w-1/2 mb-4 shadow-md" style="background-color:#963FF0;color:white;">
                    <h3 class="text-xl font-bold mb-2">Existing shops</h3>
                    <div class="card-content flex flex-col items-center">
                        <div class="number text-4xl font-bold mb-2"><?php echo $total_services; ?></div>
                        <span class="text-gray-500" style="color:white;">+22 than last week</span>
                    </div>
                </div>




                <?php
                $current_date = date('Y-m-d');

                // Calculate the start and end date for the current week (25th to 31st of the current month)
                if (date('d') < 25) {
                    // If before 25th, the current week is from 25th to end of the previous month
                    $current_week_start = date('Y-m-25', strtotime("first day of this month", strtotime($current_date)));
                    $current_week_end = date('Y-m-t', strtotime($current_date)); // last day of the month
                } else {
                    // If it's after the 25th, the current week is from 25th to 31st of the current month
                    $current_week_start = date('Y-m-25', strtotime($current_date));
                    $current_week_end = date('Y-m-31', strtotime($current_date));
                }

                // Calculate the last week range (18th to 24th)
                $last_week_start = date('Y-m-18', strtotime($current_date));
                $last_week_end = date('Y-m-24', strtotime($current_date));

                // Query to count users for the current week
                $query_current_week = "SELECT COUNT(*) AS current_week_users 
    FROM `user` 
    WHERE `user_registration_date` BETWEEN '$current_week_start' AND '$current_week_end'";
                $result_current_week = mysqli_query($con, $query_current_week);
                $row_current_week = mysqli_fetch_assoc($result_current_week);
                $current_week_users = $row_current_week['current_week_users'];

                // Query to count users for the last week
                $query_last_week = "SELECT COUNT(*) AS last_week_users 
    FROM `user` 
    WHERE `user_registration_date` BETWEEN '$last_week_start' AND '$last_week_end'";
                $result_last_week = mysqli_query($con, $query_last_week);
                $row_last_week = mysqli_fetch_assoc($result_last_week);
                $last_week_users = $row_last_week['last_week_users'];

                // Debugging to check dynamic ranges
                // echo "Current Week Start: $current_week_start, Current Week End: $current_week_end<br>";
                //  echo "Last Week Start: $last_week_start, Last Week End: $last_week_end<br>";
                ?>

                <div class="card rounded-lg p-4 w-1/2 mb-4 shadow-md" style="background-color:#48CEEE;color:white;">
                    <h3 class="text-xl font-bold mb-2">Customers</h3>
                    <div class="card-content flex flex-col items-center">
                        <div class="number text-4xl font-bold mb-2"><?php echo $current_week_users; ?></div>
                        <span class="text-gray-500" style="color:white;">+<?php echo $last_week_users; ?> than last week</span>
                    </div>
                </div>



                <?php
                $query = "SELECT 
SUM(CASE WHEN booking_status = 2 THEN 1 ELSE 0 END) AS completed,
SUM(CASE WHEN booking_status = 1 THEN 1 ELSE 0 END) AS canceled,
SUM(CASE WHEN booking_status = 0 THEN 1 ELSE 0 END) AS pending

FROM booking";

                $result = $con->query($query);
                $data = $result->fetch_assoc();
                ?>
                <style>
                    .summary {
                        width: 35%;
                        background: #f9f9f9;
                        padding: 20px;
                        border-radius: 10px;
                        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                        right: 50px;
                        top: 50px;
                    }


                    .completed {
                        color: #4CAF50;
                    }

                    .canceled {
                        color: #F44336;
                    }

                    .pending {
                        color: #FFC107;
                    }
                </style>
                <div class="card bg-white rounded-lg p-4 w-1/2 mb-4 shadow-md">
                    <h3 class="text-xl font-bold mb-2">How Many Order Complete and Cancel</h3>
                    <div class="chart-container">
                        <canvas id="memberChart" style="width:100%; height:500px;"></canvas>
                    </div>
                    <div class="summary">
                        <h4>Booking Summary</h4>
                        <p class="completed">✔ Completed: <?php echo $data['completed']; ?></p>
                        <p class="canceled">✘ Canceled: <?php echo $data['canceled']; ?></p>
                        <p class="pending">⌛ Pending: <?php echo $data['pending']; ?></p>
                    </div>
                </div>

                <script>
                    function fetchChartData(period) {
                        // Chart data for completed and canceled orders
                        const data = {
                            labels: ['Completed', 'Canceled', 'Pending'],
                            datasets: [{
                                data: [<?php echo $data['completed']; ?>, <?php echo $data['canceled']; ?>, <?php echo $data['pending']; ?>],
                                backgroundColor: ['#4CAF50', '#F44336', '#FFC107']
                            }]
                        };

                        const ctx = document.getElementById('memberChart').getContext('2d');
                        new Chart(ctx, {
                            type: 'pie',
                            data: data,
                            options: {
                                responsive: true,
                                plugins: {
                                    legend: {
                                        position: 'top'
                                    }
                                }
                            }
                        });
                    }

                    window.onload = function() {
                        fetchChartData('yearly');
                    };
                </script>



                <?php

                $monthly_data_query = "
    SELECT DATE_FORMAT(provider_registration_date, '%Y-%m') AS month, 
           COUNT(*) AS provider_count 
    FROM service_provider 
    GROUP BY month 
    ORDER BY month";

                $result = $con->query($monthly_data_query);

                if (!$result) {
                    die("Query Error: " . $con->error);
                }

                $months = [];
                $counts = [];

                // Fetch results into arrays
                while ($row = $result->fetch_assoc()) {
                    $months[] = $row['month'];
                    $counts[] = $row['provider_count'];
                }
                ?>

                <div class="card bg-white rounded-lg p-4 w-1/2 mb-4 shadow-md">
                    <h3 class="text-xl font-bold mb-2">Workers</h3>
                    <div class="chart-container">
                        <canvas id="monthlyChart"></canvas>
                    </div>

                </div>

                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script>
                    document.addEventListener('DOMContentLoaded', () => {
                        const ctx = document.getElementById('monthlyChart').getContext('2d');
                        const monthlyChart = new Chart(ctx, {
                            type: 'radar',
                            data: {
                                labels: ["Jan", "Feb", "Mar", "Apr", "May", "June", "July", "Aug", "Sept", "Oct", "Nov", "Dec"],
                                datasets: [{
                                    label: 'New Providers',
                                    data: <?= json_encode($counts) ?>,
                                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                                    borderColor: 'rgba(54, 162, 235, 1)',
                                    borderWidth: 2,
                                    fill: true
                                }]
                            },
                            options: {
                                responsive: true,
                                plugins: {
                                    legend: {
                                        position: 'top'
                                    }
                                },
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    });
                </script>

                <?php
                $sql_reviews = "SELECT r.review_rating, r.review_text, u.user_name
                FROM review_platform r
                JOIN user u ON r.user_id = u.user_id
                ORDER BY r.review_date DESC"; // Fetch reviews in descending order of date

                $result_reviews = $con->query($sql_reviews);

                if ($result_reviews->num_rows > 0) {
                    // Fetch all reviews into the $reviews array
                    while ($row = $result_reviews->fetch_assoc()) {
                        $reviews[] = $row;
                    }
                } else {
                    echo "No reviews found.";
                }
                ?>

                <p style="font-size:20px;font-weight:700;">Review:</p>
                <div class="carousel-container">
                    <div class="carousel-inner">
                        <?php
                        // Check if there are reviews to display
                        if (!empty($reviews)) {
                            foreach ($reviews as $review) {
                                // Extract review details
                                $user_name = $review['user_name'];
                                $review_rating = $review['review_rating'];
                                $review_text = $review['review_text'];

                                // Generate rating stars
                                $rating_stars = str_repeat('★', $review_rating) . str_repeat('☆', 5 - $review_rating);
                        ?>

                                <div class="cards">
                                    <h3 style="color:white"><?php echo $user_name; ?></h3>
                                    <div class="rating"><?php echo $rating_stars; ?></div>
                                    <p style="color:white"><?php echo $review_text; ?></p>
                                </div>

                            <?php } ?>
                        <?php } else { ?>
                            <p style="color:white">No reviews available at the moment.</p>
                        <?php } ?>
                    </div>

                    <!-- Navigation Buttons -->
                    <button class="prev-btn">❮</button>
                    <button class="next-btn">❯</button>
                </div>

                <style>
                    .carousel-container {
                        position: relative;
                        width: 100%;
                        max-width: 400px;

                    }

                    .carousel-inner {
                        transition: transform 0.5s ease-in-out;
                        width: 100%;
                    }

                    .cards {
                        min-width: 100%;
                        box-sizing: border-box;
                        padding: 20px;
                        background-color: green;
                        border-radius: 10px;
                        text-align: center;
                    }

                    .rating {
                        font-size: 24px;
                        margin: 10px 0;
                    }

                    .prev-btn,
                    .next-btn {
                        position: absolute;
                        top: 50%;
                        transform: translateY(-50%);
                        background-color: rgba(0, 0, 0, 0.5);
                        color: white;
                        cursor: pointer;
                        border-radius: 50%;
                    }

                    .prev-btn {
                        left: 10px;
                    }

                    .next-btn {
                        right: 10px;
                    }

                    .prev-btn:hover,
                    .next-btn:hover {
                        background-color: rgba(0, 0, 0, 0.8);
                    }
                </style>

                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        const carouselInner = document.querySelector(".carousel-inner");
                        const cards = document.querySelectorAll(".cards");
                        let currentIndex = 0;

                        function updateCarousel() {
                            const offset = currentIndex * -100;
                            carouselInner.style.transform = `translateX(${offset}%)`;
                        }

                        document.querySelector(".prev-btn").addEventListener("click", () => {
                            if (currentIndex > 0) {
                                currentIndex--;
                                updateCarousel();
                            }
                        });

                        document.querySelector(".next-btn").addEventListener("click", () => {
                            if (currentIndex < cards.length - 1) {
                                currentIndex++;
                                updateCarousel();
                            }
                        });
                    });
                </script>


                <?php

                // Fetch average rating
                $avg_rating_query = "SELECT ROUND(SUM(review_rating) / COUNT(*), 1) AS average_rating FROM review_platform";
                $avg_rating_result = $con->query($avg_rating_query);
                $avg_rating = ($avg_rating_result->num_rows > 0) ? $avg_rating_result->fetch_assoc()['average_rating'] : 'N/A';

                // Fetch happy customers
                $happy_customers_query = "SELECT COUNT(*) AS happy_customers FROM review_platform WHERE review_rating > 3.5";
                $happy_customers_result = $con->query($happy_customers_query);
                $happy_customers = ($happy_customers_result->num_rows > 0) ? $happy_customers_result->fetch_assoc()['happy_customers'] : '0';

                // Fetch unhappy customers
                $unhappy_customers_query = "SELECT COUNT(*) AS unhappy_customers FROM review_platform WHERE review_rating <= 3.5";
                $unhappy_customers_result = $con->query($unhappy_customers_query);
                $unhappy_customers = ($unhappy_customers_result->num_rows > 0) ? $unhappy_customers_result->fetch_assoc()['unhappy_customers'] : '0';

                ?>

                <div class="card bg-white rounded-lg p-4 w-full mb-4 shadow-md flex justify-between">
                    <div class="metrics flex flex-col items-center justify-center p-4 border border-gray-300 rounded-lg w-1/3 mr-2"
                        style="background-color:#F95B77;color:white;">
                        <h3 class="text-sm font-bold mb-2">Average Ratings</h3>
                        <div class="rating text-xl font-bold"><?php echo $avg_rating; ?></div>
                    </div>
                    <div class="metrics flex flex-col items-center justify-center p-4 border border-gray-300 rounded-lg w-1/3 mr-2"
                        style="background-color:#48CEEE;color:white;">
                        <h3 class="text-sm font-bold mb-2">Happy Customers</h3>
                        <div class="number text-lg font-bold"><?php echo $happy_customers; ?></div>
                    </div>
                    <div class="metrics flex flex-col items-center justify-center p-4 border border-gray-300 rounded-lg w-1/3"
                        style="background-color:#963FF0;color:white;">
                        <h3 class="text-sm font-bold mb-2">Unhappy Customers</h3>
                        <div class="number text-lg font-bold"><?php echo $unhappy_customers; ?></div>
                    </div>
                </div>



            </div>
        </div>
    </div>
    </div>



</body>

</html>