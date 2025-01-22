<?php
session_start();
include 'config.php';


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Services</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-blue-50 text-center font-sans">
    <?php
    include 'header.php';
    ?>
    <h1 class="text-2xl font-bold text-blue-500 my-5">All <span class="text-blue-600">services</span></h1>

    <div id="services" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 max-w-6xl mx-auto p-5">
        <?php
        // Query to fetch services
        $query = "SELECT `service_id`, `service_name`, `service_picture` FROM `service` WHERE 1";
        // Execute the query
        $result = mysqli_query($con, $query);
        // Check if there are results
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                // Generate service item
                echo "
                        <div id='{$row['service_name']}' onclick=\"showSubServices('{$row['service_name']}')\" class=\"service-card bg-white rounded-lg shadow-md p-4 hover:shadow-lg transform transition-transform duration-300 cursor-pointer\">
                            <img src='photo/Services/" . $row['service_name'] . ".png' alt='" . htmlspecialchars($row['service_name']) . "' class=\"w-12 h-12\">
                            <span class=\"mt-2 text-base sm:text-lg font-medium\">" . htmlspecialchars($row['service_name']) . "</span>
                        </div>";
            }
        } else {
            echo "<p>No services available.</p>";
        }

        ?>
    </div>

    <div id="sub-services-container" class="mt-10 max-w-6xl mx-auto hidden">
        <h2 class="text-xl font-bold text-gray-700 mb-5">Sub Services for <span id="service-title" class="text-blue-600"></span></h2>
        <!-- <a href=""> -->
            <div id="sub-services" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <!-- Sub-services will be dynamically populated here -->
            </div>
        <!-- </a> -->
    </div>

    <script>
        function showSubServices(serviceName) {
            const subServices = {
                'Cleaning Service': ['Home Cleaning', 'Office Cleaning', 'Window Cleaning'],
                'Plumbing Service': ['Leak Repair', 'Pipe Installation', 'Drain Cleaning'],
                'Painting Service': ['Interior Painting', 'Exterior Painting', 'Wall Texturing'],
                'Filter Service': ['Water Filter Installation', 'Air Filter Maintenance'],
                'Door Service': ['Door Installation', 'Lock Repair', 'Door Painting'],
                'Electricity Service': ['Wiring', 'Appliance Repair', 'Lighting Installation'],
                'Kitchen Service': ['Cabinet Repair', 'Sink Installation'],
                'Furniture Service': ['Assembly', 'Repair', 'Polishing'],
                'E-Waste Service': ['Electronics Disposal', 'Recycling'],
                'Gadget Service': ['Device Repair', 'Software Installation'],
                'Design Service': ['Interior Design', 'Graphic Design']
            };

            const subServiceContainer = document.querySelector('#sub-services');
            const serviceTitle = document.getElementById('service-title');

            serviceTitle.textContent = serviceName;
            subServiceContainer.innerHTML = '';

            subServices[serviceName]?.forEach(sub => {
                const div = document.createElement('div');
                div.className = 'bg-white rounded-lg shadow p-4 text-gray-700 cursor-pointer';
                div.textContent = sub;

                // Add the onclick event to call the goToLink function
                div.onclick = () => goToLink(sub);

                subServiceContainer.appendChild(div);
            });

            document.getElementById('sub-services-container').classList.remove('hidden');

            function goToLink(name) {
                window.location.href = `service_details.php?name=${name}`;
            }
        }
    </script>
</body>

</html>