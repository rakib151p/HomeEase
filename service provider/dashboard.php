<?php
// Initialize session
session_start();
include '../config.php';
$provider_id =$_SESSION['provider_id'];
// Get the total number of columns in the table
$totalColumnsQuery = "SELECT COUNT(*) as total_columns 
                      FROM INFORMATION_SCHEMA.COLUMNS 
                      WHERE TABLE_NAME = 'service_provider'";
$totalColumnsResult = $con->query($totalColumnsQuery);
$totalColumns = $totalColumnsResult->fetch_assoc()['total_columns'];
$totalColumns=15;
// Count the non-NULL values for the given provider_id
$nonNullQuery = "SELECT 
    (provider_name IS NOT NULL) +
    (provider_email IS NOT NULL) +
    (provider_password IS NOT NULL) +
    (provider_district IS NOT NULL) +
    (provider_experience IS NOT NULL) +
    (provider_about IS NOT NULL) +
    (provider_phone IS NOT NULL) +
    (provider_gender IS NOT NULL) +
    (provider_profile_picture IS NOT NULL) +
    (provider_expertise IS NOT NULL) +
    (provider_availability IS NOT NULL) +
    (provider_availability_time_of_day IS NOT NULL) +
    (provider_upazila IS NOT NULL) +
    (provider_area IS NOT NULL) +
    (provider_street_address IS NOT NULL) AS non_null_count
FROM service_provider
WHERE provider_id = ?";
$stmt = $con->prepare($nonNullQuery);
$stmt->bind_param('i', $provider_id);
$stmt->execute();
$nonNullResult = $stmt->get_result();
$nonNullCount = $nonNullResult->fetch_assoc()['non_null_count'];
// echo 'non null count'.$nonNullCount;
// echo 'Total columns'.$totalColumns;

// Calculate the percentage
if ($totalColumns > 0) {
    $percentage = ($nonNullCount / $totalColumns) * 100;
    // echo "Percentage of variables set for provider_id $provider_id: " . round($percentage, 2) . "%";
} else {
    echo "Could not calculate the percentage because the total number of columns is 0.";
}

?>



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
    <?php
    include 'header.php';
    ?>
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-md flex flex-col p-4">
            <div class="flex flex-col items-center">
                <div class="bg-blue-200 rounded-full w-24 h-24 flex items-center justify-center overflow-hidden">
                    <img src="../photo/profile_pictures/<?php echo $_SESSION['provider_profile_picture']; ?>" alt="Profile Picture" class="w-full h-full object-cover">
                </div>
                <h2 class="mt-4 font-semibold text-lg">Team R3P innovators</h2>
                <p class="text-sm text-gray-500">Provider ID: 1023034</p>
            </div>

            <nav class="mt-8 space-y-4">
                <a href="dashboard.php" class="flex items-center px-4 py-2 text-blue-600 bg-blue-100 rounded-md">
                    <span class="material-icons mr-3">Dashboard</span>
                </a>
                <a href="profile.php" class="flex items-center px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-md">
                    <span class="material-icons mr-3">Profile</span>
                </a>
                <a href="Order_Manage.php" class="flex items-center px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-md">
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
                <a href="../logout.php" class="flex items-center px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-md">
                    <span class="material-icons mr-3">Log Out</span>
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6">
            <!-- Header Section -->
            <div class="bg-white shadow-md rounded-md p-6">
                <h1 class="text-xl font-semibold">Welcome to HomeEase</h1>
                <p class="text-gray-600 mt-2">We are so delighted about your arrival on our platform. This is your personalized dashboard for your HomeEase profile as a service provider.</p>
            </div>

            <!-- Info Section -->
            <div class="mt-6 grid grid-cols-12 gap-6">
                <!-- Notice Board -->
                <div class="col-span-12 md:col-span-8 bg-white shadow-md rounded-md p-6">
                    <h2 class="font-semibold text-lg">Notice Board</h2>
                    <p class="text-gray-600 mt-2">Dear service provider, to get the job of your choice, keep your profile 100% complete. So fill your profile information correctly from our "Edit Profile" section.</p>
                    <p class="text-sm text-gray-400 mt-4">06th December 2024</p>
                </div>

                <!-- Member Since -->
                <div class="col-span-12 md:col-span-4 bg-blue-100 shadow-md rounded-md p-6 flex flex-col items-center">
                    <h2 class="text-lg font-semibold">Member Since</h2>
                    <div class="bg-blue-200 rounded-full w-12 h-12 flex items-center justify-center mt-4">
                        <span class="material-icons text-blue-600">person</span>
                    </div>
                    <p class="text-gray-600 mt-4"><?php echo $_SESSION['provider_registration_date']; ?></p>
                </div>

                <!-- Profile Completion -->
                <div class="col-span-12 md:col-span-6 bg-white shadow-md rounded-md p-6 flex items-center justify-between bg-yellow-200">
                    <div>
                        <h2 class="text-3xl font-bold"><?php echo $percentage; ?>%</h2>
                        <p class="text-gray-600 mt-2">Complete & organized profile may help to get better response.</p>
                    </div>
                    <a href="profile.php" class="text-blue-600 font-semibold">Update Profile &rarr;</a>
                </div>

                <!-- Orders Completed -->
                <?php
                function getCompletedOrders($con)
                {
                    $query = "SELECT COUNT(*) AS completed_orders FROM booking WHERE booking_status = '2'";
                    $result = $con->query($query);
                    if (!$result) {
                        die("Query failed: " . $con->error); // Error handling
                    }
                    $row = $result->fetch_assoc();
                    return $row['completed_orders'] ?? 0;
                }
                $completedOrders = getCompletedOrders($con);
                ?>
                <div class="md:col-span-6 bg-blue-100 shadow-md rounded-md p-6 flex items-center justify-between">
                    <div>
                        <h2 class="text-3xl font-bold"><?php echo $completedOrders; ?></h2>
                        <p class="text-gray-600 mt-2">Orders you have completed till today</p>
                    </div>
                    <div class="bg-blue-100 p-4 rounded-full">
                        <span class="material-icons text-blue-600">check_circle</span>
                    </div>
                </div>
                <!-- Charts -->

                <?php
                // Fetch monthly income data
                $incomeQuery = "
SELECT 
    DATE_FORMAT(sp.provider_registration_date, '%Y-%m-%d') AS month,
    SUM(
        sp.provider_price * COALESCE(order_count, 0)
    ) AS total_income
FROM service_provider sp
LEFT JOIN (
    SELECT 
        provider_id,
        COUNT(*) AS order_count
    FROM booking
    WHERE booking_status = '2'
    GROUP BY provider_id
) b ON sp.provider_id = b.provider_id
GROUP BY month
ORDER BY month
";

                // Execute the query
                $result = $con->query($incomeQuery);

                if (!$result) {
                    die("Query failed: " . $con->error);
                }

                // Prepare income data for the chart
                $incomeData = [];
                while ($row = $result->fetch_assoc()) {
                    $incomeData[] = $row;
                }

                // Encode the data to JSON format for use in JavaScript
                $incomeJSON = json_encode($incomeData, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);






                $customerQuery = "
    SELECT 
        booking_date AS booking_day, 
        COUNT(*) AS customer_count 
    FROM booking 
    WHERE 
        provider_end = 1 AND 
        user_end = 1 AND 
        booking_status = '2'
    GROUP BY booking_date 
    ORDER BY booking_date ASC 
    LIMIT 30
";

                $result = $con->query($customerQuery);

                if (!$result) {
                    die("Query failed: " . $con->error);
                }

                // Prepare data for the customer chart
                $days = [];
                $counts = [];
                while ($row = $result->fetch_assoc()) {
                    $days[] = $row['booking_day'];
                    $counts[] = $row['customer_count'];
                }

                $con->close();
                ?>

                <div class="col-span-12 md:col-span-6 bg-white shadow-md rounded-md p-6">
                    <h2 class="font-semibold text-lg">Monthly Income</h2>
                    <canvas id="incomeChart" width="400" height="200"></canvas>
                </div>

                <div class="col-span-12 md:col-span-6 bg-white shadow-md rounded-md p-6">
                    <h2 class="font-semibold text-lg">Daywise Customer Count</h2>
                    <canvas id="customerChart" class="mt-4"></canvas>
                </div>

                <script>
                    // Get the income data from PHP
const incomeData = <?php echo $incomeJSON; ?> || [];

// Define months (January to December)
const months = [
    "January", "February", "March", "April", "May",
    "June", "July", "August", "September", "October",
    "November", "December"
];

// Initialize income values for each month (set to 0 by default)
const incomeValues = Array(12).fill(0);

// Populate incomeValues with actual data from PHP
incomeData.forEach(item => {
    const monthIndex = parseInt(item.month.split('-')[1], 10) - 1; // Convert month to 0-based index
    incomeValues[monthIndex] = parseFloat(item.total_income); // Store total income for the month
});

// Ensure chart rendering happens after DOM is loaded
document.addEventListener('DOMContentLoaded', function () {
    if (document.getElementById('incomeChart')) {
        const incomeChartCtx = document.getElementById('incomeChart').getContext('2d');

        // Create a gradient for the bars
        const gradient = incomeChartCtx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, '#3b82f6');
        gradient.addColorStop(1, '#93c5fd');

        new Chart(incomeChartCtx, {
            type: 'bar',
            data: {
                labels: months, // X-axis labels (January to December)
                datasets: [{
                    label: 'Monthly Income (BDT)',
                    data: incomeValues, // Y-axis values
                    backgroundColor: gradient, // Gradient fill
                    borderColor: '#1e3a8a',
                    borderWidth: 1,
                    hoverBackgroundColor: '#2563eb',
                    hoverBorderColor: '#1e40af'
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Monthly Income Overview (BDT)',
                        font: {
                            size: 18,
                            weight: 'bold'
                        },
                        padding: {
                            top: 10,
                            bottom: 20
                        }
                    },
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            font: {
                                size: 14
                            },
                            color: '#333'
                        }
                    },
                    tooltip: {
                        backgroundColor: '#1e3a8a',
                        titleColor: '#ffffff',
                        bodyColor: '#ffffff',
                        footerColor: '#ffffff',
                        borderWidth: 1,
                        borderColor: '#93c5fd',
                        callbacks: {
                            label: function (context) {
                                return `${context.dataset.label}: BDT ${context.raw.toLocaleString()}`;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#e5e7eb',
                            borderDash: [5, 5]
                        },
                        ticks: {
                            color: '#374151',
                            stepSize: 1000, // Fixed interval for Y-axis
                            callback: function (value) {
                                return `BDT ${value.toLocaleString()}`; // Format Y-axis values
                            }
                        },
                        title: {
                            display: true,
                            text: 'Income (in BDT)',
                            font: {
                                size: 14
                            },
                            color: '#111827'
                        }
                    },
                    x: {
                        grid: {
                            color: '#f3f4f6'
                        },
                        ticks: {
                            color: '#374151'
                        },
                        title: {
                            display: true,
                            text: 'Months',
                            font: {
                                size: 14
                            },
                            color: '#111827'
                        }
                    }
                }
            }
        });
    }
});


                    // Customer Chart
                    const days = <?php echo json_encode($days); ?>;
                    const counts = <?php echo json_encode($counts); ?>;

                    if (document.getElementById('customerChart')) {
                        const customerChartCtx = document.getElementById('customerChart').getContext('2d');
                        new Chart(customerChartCtx, {
                            type: 'line',
                            data: {
                                labels: days,
                                datasets: [{
                                    label: 'Customers',
                                    data: counts,
                                    borderColor: '#3b82f6',
                                    backgroundColor: 'rgba(59, 130, 246, 0.2)',
                                    borderWidth: 2,
                                    pointBackgroundColor: '#3b82f6',
                                    pointBorderColor: '#ffffff',
                                    pointBorderWidth: 1,
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        ticks: {
                                            stepSize: 1 // Force integer steps on the Y-axis
                                        }
                                    },
                                    x: {
                                        title: {
                                            display: true,
                                            text: 'Booking Date'
                                        }
                                    }
                                },
                                plugins: {
                                    legend: {
                                        display: true,
                                        position: 'top'
                                    },
                                    tooltip: {
                                        callbacks: {
                                            label: function(context) {
                                                return `${context.dataset.label}: ${context.raw}`;
                                            }
                                        }
                                    }
                                }
                            }
                        });
                    }
                </script>


</body>

</html>