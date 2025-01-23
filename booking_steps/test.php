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
                <div class="bg-blue-200 rounded-full w-24 h-24 flex items-center justify-center">
                    <span class="text-blue-600 text-3xl font-bold">P</span>
                </div>
                <h2 class="mt-4 font-semibold text-lg">Team R3P innovators</h2>
                <p class="text-sm text-gray-500">Provider ID: 1023034</p>
            </div>

            <nav class="mt-8 space-y-4">
                <a href="dashboard.php" class="flex items-center px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-md">
                    <span class="material-icons mr-3">Dashboard</span>
                </a>
                <a href="profile.php" class="flex items-center px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-md">
                    <span class="material-icons mr-3">Profile</span>
                </a>
                <a href="" class="flex items-center px-4 py-2 text-blue-600 bg-blue-100 rounded-md">
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
                <a href="#" class="flex items-center px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-md">
                    <span class="material-icons mr-3">Log Out</span>
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6">
            <div class="flex justify-end gap-2">
                <input id="dateFilter" type="date" class="border rounded-lg p-2 text-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Select Date" />
                <button id="searchButton" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition duration-200">Search</button>
            </div>

            <span class="text-4xl ml-[470px]"><span class="text-blue-700 font-bold text-4xl">Ordered Manage By</span> Service provider</span>
            <!-- Main Content -->
            <main class="flex-1 w-full p-6 flex flex-col items-center justify-center mt-16">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8" id="bookingCards">
                    <!-- Card 1 -->
                    <div>
                        <div class="text-2xl text-center font-bold bg-gradient-to-br from-blue-50 via-white to-blue-100 border-2 border-slate-300  shadow-lg rounded-lg p-6 flex flex-col justify-between transform hover:scale-105 transition duration-300">
                            Slot-1
                        </div>
                        <div class=" border-2 border-slate-300 mt-4 bg-gradient-to-br from-blue-50 via-white to-blue-100 h-[430px] w-[390px] shadow-2xl rounded-2xl p-6 flex flex-col justify-between transform hover:scale-105 transition duration-300 hover:shadow-blue-300">
                            <div class="grid gap-4">
                                <!-- Title Section -->
                                <div class="flex items-center gap-2">
                                    <div class="h-10 w-10 bg-blue-500 text-white rounded-full flex items-center justify-center">
                                        <span class="text-xl font-bold">B</span>
                                    </div>
                                    <h2 class="text-3xl font-bold text-gray-700">Booking Details</h2>
                                </div>

                                <!-- Booking Info -->
                                <div class="space-y-2">
                                    <p class="text-lg text-gray-700 flex items-center">
                                        <span class="font-bold w-32">Booking Date:</span>
                                        <span class="booking-date text-gray-600">2025-01-23</span>
                                    </p>
                                    <p class="text-lg text-gray-700 flex items-center">
                                        <span class="font-bold w-32">Customer:</span>
                                        <span class="text-gray-600">John Doe</span>
                                    </p>
                                    <p class="text-lg text-gray-700 flex items-center">
                                        <span class="font-bold w-32">Address:</span>
                                        <span class="text-gray-600">123 Main Street, City, road</span>
                                    </p>
                                    <p class="text-lg text-gray-700 flex items-center">
                                        <span class="font-bold w-32">Service Item:</span>
                                        <span class="text-gray-600">Haircut</span>
                                    </p>
                                    <p class="text-lg text-gray-700 flex items-center">
                                        <span class="font-bold w-32">Appointment:</span>
                                        <span class="text-gray-600">Jan 24, 2025</span>
                                    </p>
                                    <p class="text-lg text-gray-700 flex items-center">
                                        <span class="font-bold w-32">Time:</span>
                                        <span class="text-gray-600">10:30 AM</span>
                                    </p>
                                    <p class="text-lg text-gray-700 flex items-center">
                                        <span class="font-bold w-32">Status:</span>
                                        <span class="text-yellow-500 font-semibold">Pending</span>
                                    </p>
                                </div>
                            </div>

                            <!-- Buttons Section -->
                            <div class="mt-6 flex justify-between">
                                <button class="bg-green-500 hover:bg-green-600 text-white py-2 px-6 rounded-xl shadow-lg transition transform hover:scale-105">
                                    Confirm
                                </button>
                                <button class="bg-red-500 hover:bg-red-600 text-white py-2 px-6 rounded-xl shadow-lg transition transform hover:scale-105">
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="text-2xl text-center font-bold bg-gradient-to-br from-blue-50 via-white to-blue-100 border-2 border-slate-300  shadow-lg rounded-lg p-6 flex flex-col justify-between transform hover:scale-105 transition duration-300">
                            Slot-1
                        </div>
                        <div class=" border-2 border-slate-300 mt-4 bg-gradient-to-br from-blue-50 via-white to-blue-100 h-[430px] w-[390px] shadow-2xl rounded-2xl p-6 flex flex-col justify-between transform hover:scale-105 transition duration-300 hover:shadow-blue-300">
                            <div class="grid gap-4">
                                <!-- Title Section -->
                                <div class="flex items-center gap-2">
                                    <div class="h-10 w-10 bg-blue-500 text-white rounded-full flex items-center justify-center">
                                        <span class="text-xl font-bold">B</span>
                                    </div>
                                    <h2 class="text-3xl font-bold text-gray-700">Booking Details</h2>
                                </div>

                                <!-- Booking Info -->
                                <div class="space-y-2">
                                    <p class="text-lg text-gray-700 flex items-center">
                                        <span class="font-bold w-32">Booking Date:</span>
                                        <span class="booking-date text-gray-600">2025-01-23</span>
                                    </p>
                                    <p class="text-lg text-gray-700 flex items-center">
                                        <span class="font-bold w-32">Customer:</span>
                                        <span class="text-gray-600">John Doe</span>
                                    </p>
                                    <p class="text-lg text-gray-700 flex items-center">
                                        <span class="font-bold w-32">Address:</span>
                                        <span class="text-gray-600">123 Main Street, City, road</span>
                                    </p>
                                    <p class="text-lg text-gray-700 flex items-center">
                                        <span class="font-bold w-32">Service Item:</span>
                                        <span class="text-gray-600">Haircut</span>
                                    </p>
                                    <p class="text-lg text-gray-700 flex items-center">
                                        <span class="font-bold w-32">Appointment:</span>
                                        <span class="text-gray-600">Jan 24, 2025</span>
                                    </p>
                                    <p class="text-lg text-gray-700 flex items-center">
                                        <span class="font-bold w-32">Time:</span>
                                        <span class="text-gray-600">10:30 AM</span>
                                    </p>
                                    <p class="text-lg text-gray-700 flex items-center">
                                        <span class="font-bold w-32">Status:</span>
                                        <span class="text-yellow-500 font-semibold">Pending</span>
                                    </p>
                                </div>
                            </div>

                            <!-- Buttons Section -->
                            <div class="mt-6 flex justify-between">
                                <button class="bg-green-500 hover:bg-green-600 text-white py-2 px-6 rounded-xl shadow-lg transition transform hover:scale-105">
                                    Confirm
                                </button>
                                <button class="bg-red-500 hover:bg-red-600 text-white py-2 px-6 rounded-xl shadow-lg transition transform hover:scale-105">
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="text-2xl text-center font-bold bg-gradient-to-br from-blue-50 via-white to-blue-100 border-2 border-slate-300  shadow-lg rounded-lg p-6 flex flex-col justify-between transform hover:scale-105 transition duration-300">
                            Slot-1
                        </div>
                        <div class=" border-2 border-slate-300 mt-4 bg-gradient-to-br from-blue-50 via-white to-blue-100 h-[430px] w-[390px] shadow-2xl rounded-2xl p-6 flex flex-col justify-between transform hover:scale-105 transition duration-300 hover:shadow-blue-300">
                            <div class="grid gap-4">
                                <!-- Title Section -->
                                <div class="flex items-center gap-2">
                                    <div class="h-10 w-10 bg-blue-500 text-white rounded-full flex items-center justify-center">
                                        <span class="text-xl font-bold">B</span>
                                    </div>
                                    <h2 class="text-3xl font-bold text-gray-700">Booking Details</h2>
                                </div>

                                <!-- Booking Info -->
                                <div class="space-y-2">
                                    <p class="text-lg text-gray-700 flex items-center">
                                        <span class="font-bold w-32">Booking Date:</span>
                                        <span class="booking-date text-gray-600">2025-01-23</span>
                                    </p>
                                    <p class="text-lg text-gray-700 flex items-center">
                                        <span class="font-bold w-32">Customer:</span>
                                        <span class="text-gray-600">John Doe</span>
                                    </p>
                                    <p class="text-lg text-gray-700 flex items-center">
                                        <span class="font-bold w-32">Address:</span>
                                        <span class="text-gray-600">123 Main Street, City, road</span>
                                    </p>
                                    <p class="text-lg text-gray-700 flex items-center">
                                        <span class="font-bold w-32">Service Item:</span>
                                        <span class="text-gray-600">Haircut</span>
                                    </p>
                                    <p class="text-lg text-gray-700 flex items-center">
                                        <span class="font-bold w-32">Appointment:</span>
                                        <span class="text-gray-600">Jan 24, 2025</span>
                                    </p>
                                    <p class="text-lg text-gray-700 flex items-center">
                                        <span class="font-bold w-32">Time:</span>
                                        <span class="text-gray-600">10:30 AM</span>
                                    </p>
                                    <p class="text-lg text-gray-700 flex items-center">
                                        <span class="font-bold w-32">Status:</span>
                                        <span class="text-yellow-500 font-semibold">Pending</span>
                                    </p>
                                </div>
                            </div>

                            <!-- Buttons Section -->
                            <div class="mt-6 flex justify-between">
                                <button class="bg-green-500 hover:bg-green-600 text-white py-2 px-6 rounded-xl shadow-lg transition transform hover:scale-105">
                                    Confirm
                                </button>
                                <button class="bg-red-500 hover:bg-red-600 text-white py-2 px-6 rounded-xl shadow-lg transition transform hover:scale-105">
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="text-2xl text-center font-bold bg-gradient-to-br from-blue-50 via-white to-blue-100 border-2 border-slate-300  shadow-lg rounded-lg p-6 flex flex-col justify-between transform hover:scale-105 transition duration-300">
                            Slot-1
                        </div>
                        <div class=" border-2 border-slate-300 mt-4 bg-gradient-to-br from-blue-50 via-white to-blue-100 h-[430px] w-[390px] shadow-2xl rounded-2xl p-6 flex flex-col justify-between transform hover:scale-105 transition duration-300 hover:shadow-blue-300">
                            <div class="grid gap-4">
                                <!-- Title Section -->
                                <div class="flex items-center gap-2">
                                    <div class="h-10 w-10 bg-blue-500 text-white rounded-full flex items-center justify-center">
                                        <span class="text-xl font-bold">B</span>
                                    </div>
                                    <h2 class="text-3xl font-bold text-gray-700">Booking Details</h2>
                                </div>

                                <!-- Booking Info -->
                                <div class="space-y-2">
                                    <p class="text-lg text-gray-700 flex items-center">
                                        <span class="font-bold w-32">Booking Date:</span>
                                        <span class="booking-date text-gray-600">2025-01-23</span>
                                    </p>
                                    <p class="text-lg text-gray-700 flex items-center">
                                        <span class="font-bold w-32">Customer:</span>
                                        <span class="text-gray-600">John Doe</span>
                                    </p>
                                    <p class="text-lg text-gray-700 flex items-center">
                                        <span class="font-bold w-32">Address:</span>
                                        <span class="text-gray-600">123 Main Street, City, road</span>
                                    </p>
                                    <p class="text-lg text-gray-700 flex items-center">
                                        <span class="font-bold w-32">Service Item:</span>
                                        <span class="text-gray-600">Haircut</span>
                                    </p>
                                    <p class="text-lg text-gray-700 flex items-center">
                                        <span class="font-bold w-32">Appointment:</span>
                                        <span class="text-gray-600">Jan 24, 2025</span>
                                    </p>
                                    <p class="text-lg text-gray-700 flex items-center">
                                        <span class="font-bold w-32">Time:</span>
                                        <span class="text-gray-600">10:30 AM</span>
                                    </p>
                                    <p class="text-lg text-gray-700 flex items-center">
                                        <span class="font-bold w-32">Status:</span>
                                        <span class="text-yellow-500 font-semibold">Pending</span>
                                    </p>
                                </div>
                            </div>

                            <!-- Buttons Section -->
                            <div class="mt-6 flex justify-between">
                                <button class="bg-green-500 hover:bg-green-600 text-white py-2 px-6 rounded-xl shadow-lg transition transform hover:scale-105">
                                    Confirm
                                </button>
                                <button class="bg-red-500 hover:bg-red-600 text-white py-2 px-6 rounded-xl shadow-lg transition transform hover:scale-105">
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </div>



                    <!-- Card 2 -->

                    <div>
                        <div class="text-2xl text-center font-bold bg-gradient-to-br from-blue-50 via-white to-blue-100 border-2 border-slate-300  shadow-lg rounded-lg p-6 flex flex-col justify-between transform hover:scale-105 transition duration-300">
                            Slot-2
                        </div>
                        <div class=" border-2 border-slate-300 mt-4 bg-gradient-to-br from-blue-50 via-white to-blue-100 h-[430px] w-[390px] shadow-2xl rounded-2xl p-6 flex flex-col justify-between transform hover:scale-105 transition duration-300 hover:shadow-blue-300">
                            <div class="grid gap-4">
                                <!-- Title Section -->
                                <div class="flex items-center gap-2">
                                    <div class="h-10 w-10 bg-blue-500 text-white rounded-full flex items-center justify-center">
                                        <span class="text-xl font-bold">B</span>
                                    </div>
                                    <h2 class="text-3xl font-bold text-gray-700">Booking Details</h2>
                                </div>

                                <!-- Booking Info -->
                                <div class="space-y-2">
                                    <p class="text-lg text-gray-700 flex items-center">
                                        <span class="font-bold w-32">Booking Date:</span>
                                        <span class="booking-date text-gray-600">2025-01-23</span>
                                    </p>
                                    <p class="text-lg text-gray-700 flex items-center">
                                        <span class="font-bold w-32">Customer:</span>
                                        <span class="text-gray-600">John Doe</span>
                                    </p>
                                    <p class="text-lg text-gray-700 flex items-center">
                                        <span class="font-bold w-32">Address:</span>
                                        <span class="text-gray-600">123 Main Street, City, road</span>
                                    </p>
                                    <p class="text-lg text-gray-700 flex items-center">
                                        <span class="font-bold w-32">Service Item:</span>
                                        <span class="text-gray-600">Haircut</span>
                                    </p>
                                    <p class="text-lg text-gray-700 flex items-center">
                                        <span class="font-bold w-32">Appointment:</span>
                                        <span class="text-gray-600">Jan 24, 2025</span>
                                    </p>
                                    <p class="text-lg text-gray-700 flex items-center">
                                        <span class="font-bold w-32">Time:</span>
                                        <span class="text-gray-600">10:30 AM</span>
                                    </p>
                                    <p class="text-lg text-gray-700 flex items-center">
                                        <span class="font-bold w-32">Status:</span>
                                        <span class="text-yellow-500 font-semibold">Pending</span>
                                    </p>
                                </div>
                            </div>

                            <!-- Buttons Section -->
                            <div class="mt-6 flex justify-between">
                                <button class="bg-green-500 hover:bg-green-600 text-white py-2 px-6 rounded-xl shadow-lg transition transform hover:scale-105">
                                    Confirm
                                </button>
                                <button class="bg-red-500 hover:bg-red-600 text-white py-2 px-6 rounded-xl shadow-lg transition transform hover:scale-105">
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </div>


                    <!-- card-3 -->

                    <div>
                        <div class="text-2xl text-center font-bold bg-gradient-to-br from-blue-50 via-white to-blue-100 border-2 border-slate-300  shadow-lg rounded-lg p-6 flex flex-col justify-between transform hover:scale-105 transition duration-300">
                            Slot-2
                        </div>
                        <div class=" border-2 border-slate-300 mt-4 bg-gradient-to-br from-blue-50 via-white to-blue-100 h-[430px] w-[390px] shadow-2xl rounded-2xl p-6 flex flex-col justify-between transform hover:scale-105 transition duration-300 hover:shadow-blue-300">
                            <div class="grid gap-4">
                                <!-- Title Section -->
                                <div class="flex items-center gap-2">
                                    <div class="h-10 w-10 bg-blue-500 text-white rounded-full flex items-center justify-center">
                                        <span class="text-xl font-bold">B</span>
                                    </div>
                                    <h2 class="text-3xl font-bold text-gray-700">Booking Details</h2>
                                </div>

                                <!-- Booking Info -->
                                <div class="space-y-2">
                                    <p class="text-lg text-gray-700 flex items-center">
                                        <span class="font-bold w-32">Booking Date:</span>
                                        <span class="booking-date text-gray-600">2025-01-23</span>
                                    </p>
                                    <p class="text-lg text-gray-700 flex items-center">
                                        <span class="font-bold w-32">Customer:</span>
                                        <span class="text-gray-600">John Doe</span>
                                    </p>
                                    <p class="text-lg text-gray-700 flex items-center">
                                        <span class="font-bold w-32">Address:</span>
                                        <span class="text-gray-600">123 Main Street, City, road</span>
                                    </p>
                                    <p class="text-lg text-gray-700 flex items-center">
                                        <span class="font-bold w-32">Service Item:</span>
                                        <span class="text-gray-600">Haircut</span>
                                    </p>
                                    <p class="text-lg text-gray-700 flex items-center">
                                        <span class="font-bold w-32">Appointment:</span>
                                        <span class="text-gray-600">Jan 24, 2025</span>
                                    </p>
                                    <p class="text-lg text-gray-700 flex items-center">
                                        <span class="font-bold w-32">Time:</span>
                                        <span class="text-gray-600">10:30 AM</span>
                                    </p>
                                    <p class="text-lg text-gray-700 flex items-center">
                                        <span class="font-bold w-32">Status:</span>
                                        <span class="text-yellow-500 font-semibold">Pending</span>
                                    </p>
                                </div>
                            </div>

                            <!-- Buttons Section -->
                            <div class="mt-6 flex justify-between">
                                <button class="bg-green-500 hover:bg-green-600 text-white py-2 px-6 rounded-xl shadow-lg transition transform hover:scale-105">
                                    Confirm
                                </button>
                                <button class="bg-red-500 hover:bg-red-600 text-white py-2 px-6 rounded-xl shadow-lg transition transform hover:scale-105">
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </div>





                </div>
            </main>

            <script>
                document.getElementById("searchButton").addEventListener("click", function() {
                    const selectedDate = document.getElementById("dateFilter").value;
                    const cards = document.querySelectorAll("#bookingCards > div");
                    cards.forEach(card => {
                        const cardDate = card.querySelector(".booking-date").textContent;
                        card.style.display = cardDate === selectedDate ? "block" : "none";
                    });
                });
            </script>
    </div>

    </main>
    </div>

</body>

</html>