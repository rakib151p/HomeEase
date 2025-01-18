<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tasker Filter & List</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>
</head>

<body class="bg-gradient-to-bl via-white to-blue-50  bg-gradient-to-bl from-blue-100 via-white to-blue-50 shadow-xl">
<?php 
include 'header.php';
?>

<div class="container mx-auto py-6 px-4 md:px-0">
        <!-- Main Container -->
        <div class="flex flex-col md:flex-row gap-6">
            <!-- Left Sidebar: Filters -->
            <div class="md:w-1/4 bg-white rounded-lg shadow p-6 flex flex-col">
                <h2 class="text-lg font-semibold mb-4">Date</h2>
                <div class="flex flex-wrap gap-2 mb-6">
                    <button
                        class="filter-button px-4 py-2 border border-gray-300 rounded-md text-sm bg-gray-100"
                        data-filter="Today">
                        Today
                    </button>
                    <button
                        class="filter-button px-4 py-2 border border-gray-300 rounded-md text-sm bg-gray-100"
                        data-filter="Within 3 Days">
                        Within 3 Days
                    </button>
                    <button
                        class="filter-button px-4 py-2 border border-gray-300 rounded-md text-sm bg-gray-100"
                        data-filter="Within A Week">
                        Within A Week
                    </button>
                    <button
                        class="filter-button px-4 py-2 border border-gray-300 rounded-md text-sm bg-gray-100"
                        data-filter="All">
                        Show All
                    </button>
                </div>

                <h2 class="text-lg font-semibold mb-4">Time of day</h2>
                <div class="space-y-2 mb-6">
                    <label class="flex items-center">
                        <input
                            type="radio"
                            name="timeOfDay"
                            value="Morning"
                            class="form-radio h-4 w-4 text-indigo-600 border-gray-300" />
                        <span class="ml-2 text-sm text-gray-700">Morning (8am - 12pm)</span>
                    </label>
                    <label class="flex items-center">
                        <input
                            type="radio"
                            name="timeOfDay"
                            value="Afternoon"
                            class="form-radio h-4 w-4 text-indigo-600 border-gray-300" />
                        <span class="ml-2 text-sm text-gray-700">Afternoon (12pm - 5pm)</span>
                    </label>
                    <label class="flex items-center">
                        <input
                            type="radio"
                            name="timeOfDay"
                            value="Evening"
                            class="form-radio h-4 w-4 text-indigo-600 border-gray-300" />
                        <span class="ml-2 text-sm text-gray-700">Evening (5pm - 9:30pm)</span>
                    </label>
                </div>

                <h2 class="text-lg font-semibold mb-4">Price</h2>
                <div class="space-y-2">
                    <input
                        type="range"
                        class="w-full"
                        min="10"
                        max="150"
                        value="150"
                        oninput="updatePriceLabel(this.value)" />
                    <p id="price-label" class="text-sm text-gray-600">
                        The average hourly rate is
                        <span class="font-medium">$150/hr</span>
                    </p>
                </div>

                <h2 class="text-lg font-semibold mt-6 mb-4">Tasker type</h2>
                <div class="space-y-2">
                    <label class="flex items-center">
                        <input
                            type="radio"
                            name="taskerType"
                            value="Elite Tasker"
                            class="form-radio h-4 w-4 text-indigo-600 border-gray-300" />
                        <span class="ml-2 text-sm text-gray-700">Elite Tasker</span>
                    </label>
                    <label class="flex items-center">
                        <input
                            type="radio"
                            name="taskerType"
                            value="Great Value"
                            class="form-radio h-4 w-4 text-indigo-600 border-gray-300" />
                        <span class="ml-2 text-sm text-gray-700">Great Value</span>
                    </label>
                </div>

                <div
                    class="mt-6 bg-blue-50 border border-blue-200 p-4 rounded-lg text-sm text-gray-700">
                    <p>
                        Always have peace of mind. All Taskers undergo ID and criminal
                        background checks.
                    </p>
                    <a href="#" class="text-indigo-600 underline">Learn More</a>
                </div>
            </div>

            <!-- Right Section: Taskers List -->
            <div class="md:w-3/4 space-y-6">
                <div class="flex justify-between items-center">
                    <!-- Sorting Buttons -->
                    <div class="space-x-2">
                        <button
                            class="sort-button px-4 py-2 border border-gray-300 rounded-md text-sm bg-gray-100"
                            data-sort="highest">
                            Highest Price
                        </button>
                        <button
                            class="sort-button px-4 py-2 border border-gray-300 rounded-md text-sm bg-gray-100"
                            data-sort="lowest">
                            Lowest Price
                        </button>
                    </div>
                </div>

                <div id="tasker-list" class="space-y-6">
                    <!-- Tasker Cards will be dynamically loaded here -->
                </div>

                <!-- Pagination Buttons -->
                <div id="pagination" class="flex justify-center gap-2 mt-4">
                    <!-- Pagination buttons will be dynamically added here -->
                </div>
            </div>
        </div>
    </div>




    <!-- Calender -->

    <div>
        <div
            id="overlay"
            class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded-lg shadow-lg w-auto relative">
                <button
                    id="closeBtn"
                    class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-xl">
                    &times;
                </button>
                <h2 class="text-2xl font-semibold mb-4">
                    Choose your task date <br />and start time:
                </h2>

                <div class="flex gap-4">
                    <!-- Calendar Section -->
                    <div>
                        <div class="flex justify-between items-center mb-4">
                            <button id="prevYear" class="px-2 py-1 bg-gray-200 rounded">
                                &laquo; Previous Year
                            </button>
                            <h3 id="currentYear" class="text-lg font-medium"></h3>
                            <button id="nextYear" class="px-2 py-1 bg-gray-200 rounded">
                                Next Year &raquo;
                            </button>
                        </div>

                        <div class="flex justify-between items-center mb-4">
                            <button id="prevMonth" class="px-2 py-1 bg-gray-200 rounded">
                                &laquo; Previous Month
                            </button>
                            <h3 id="currentMonth" class="text-lg font-medium"></h3>
                            <button id="nextMonth" class="px-2 py-1 bg-gray-200 rounded">
                                Next Month &raquo;
                            </button>
                        </div>

                        <div>
                            <!-- Days of the Week Header -->
                            <div class="grid grid-cols-7 gap-2 mb-2 text-center font-medium">
                                <span>Sat</span>
                                <span>Sun</span>
                                <span>Mon</span>
                                <span>Tue</span>
                                <span>Wed</span>
                                <span>Thu</span>
                                <span>Fri</span>
                            </div>

                            <!-- Dates Grid -->
                            <div class="grid grid-cols-7 gap-2" id="calendar">
                                <!-- Dates will be dynamically generated here -->
                            </div>
                        </div>
                    </div>

                    <!-- Time Selector and Confirmation -->
                    <div>
                        <div id="time-selector" class="mt-4 hidden">
                            <label for="time" class="block text-sm font-medium text-gray-700">
                                Available Times:
                            </label>
                            <select
                                id="time"
                                class="w-full mt-1 block px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <!-- Times will be dynamically populated here -->
                            </select>
                        </div>

                        <div id="confirm-section" class="mt-6 hidden">
                            <p id="selectedDetails" class="text-sm text-gray-600">
                                Request for:
                            </p>
                            <button
                                id="confirmBtn"
                                class="w-full mt-4 px-4 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-offset-2">
                                Select & Continue
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <!-- Overlay and Task Scheduler -->




    <script>
        const taskers = [];
        for (let i = 1; i <= 150; i++) {
            taskers.push({
                id: i,
                name: `Tasker ${i}`,
                tasks: `${Math.floor(Math.random() * 500)} Furniture Assembly tasks`,
                reviews: `⭐ ${(Math.random() * 1 + 4).toFixed(1)} (${Math.floor(
            Math.random() * 1000
          )} reviews)`,
                description: "Experienced in assembling various furniture types.",
                rate: Math.random() * 50 + 30,
                date: i % 3 === 0 ?
                    "Today" : i % 3 === 1 ?
                    "Within 3 Days" : "Within A Week",
                timeOfDay: i % 4 === 0 ? "Morning" : i % 4 === 1 ? "Afternoon" : "Evening",
                type: i % 5 === 0 ? "Elite Tasker" : "Great Value",
            });
        }

        const itemsPerPage = 50;
        let currentPage = 1;
        let filteredTaskers = taskers;

        function renderTaskers(page) {
            const taskerList = document.getElementById("tasker-list");
            taskerList.innerHTML = "";
            const start = (page - 1) * itemsPerPage;
            const end = start + itemsPerPage;
            const taskerSubset = filteredTaskers.slice(start, end);

            if (taskerSubset.length === 0) {
                taskerList.innerHTML = `<p class="text-center text-gray-500">No taskers match your criteria.</p>`;
                return;
            }

            taskerSubset.forEach((tasker) => {
                const taskerCard = `
    <div class="bg-white rounded-lg shadow p-6 flex flex-col md:flex-row items-start gap-4 bg-gradient-to-bl from-blue-100 via-white to-blue-50 shadow-xl border-2 border-blue-200">
      <img src="https://via.placeholder.com/100" alt="Tasker Profile" class="w-24 h-24 rounded-full">
      <div class="flex-1">
        <h3 class="text-lg font-semibold">${tasker.name}</h3>
        <p class="text-sm text-gray-600 mb-1">${tasker.tasks}</p>
        <p class="text-sm text-gray-600 mb-2">${tasker.reviews}</p>
        <p class="mt-2 text-sm text-gray-600">${tasker.description}</p>
        <div class="flex flex-wrap gap-2 mt-2">
          <span class="inline-block bg-blue-100 text-blue-600 text-xs font-medium px-2.5 py-1 rounded-md">Rate: $${tasker.rate.toFixed(
            2
          )}/hr</span>
          <span class="inline-block bg-green-100 text-green-600 text-xs font-medium px-2.5 py-1 rounded-md">Available: ${
            tasker.date
          }</span>
          <span class="inline-block bg-purple-100 text-purple-600 text-xs font-medium px-2.5 py-1 rounded-md">Time: ${
            tasker.timeOfDay
          }</span>
          <span class="inline-block bg-yellow-100 text-yellow-600 text-xs font-medium px-2.5 py-1 rounded-md">${
            tasker.type
          }</span>
        </div>
       <button id="mendaBtn" class="mt-4 bg-indigo-600 text-white py-2 px-4 rounded-lg text-sm hover:bg-indigo-700">
  Select & Continue
</button>
      </div>
    </div>
  `;
                taskerList.insertAdjacentHTML("beforeend", taskerCard);
            });
        }

        function renderPagination() {
            const pagination = document.getElementById("pagination");
            pagination.innerHTML = "";
            const totalPages = Math.ceil(filteredTaskers.length / itemsPerPage);

            for (let i = 1; i <= totalPages; i++) {
                const button = document.createElement("button");
                button.textContent = i;
                button.className = `px-4 py-2 border border-gray-300 rounded-md text-sm ${
            i === currentPage ? "bg-indigo-600 text-white" : "bg-gray-100"
          }`;
                button.addEventListener("click", () => {
                    currentPage = i;
                    renderTaskers(currentPage);
                    renderPagination();
                });
                pagination.appendChild(button);
            }
        }

        function filterTaskers(filter = null) {
            currentPage = 1;

            const selectedTimeOfDay = document.querySelector(
                'input[name="timeOfDay"]:checked'
            )?.value;
            const maxPrice = parseFloat(
                document.querySelector('input[type="range"]').value
            );
            const selectedTaskerType = document.querySelector(
                'input[name="taskerType"]:checked'
            )?.value;

            // Update active filter if provided
            const activeFilter = document.querySelector(".filter-button.active");
            if (activeFilter) activeFilter.classList.remove("active");
            if (filter) {
                const filterButton = document.querySelector(
                    `.filter-button[data-filter="${filter}"]`
                );
                if (filterButton) filterButton.classList.add("active");
            }

            filteredTaskers = taskers.filter((tasker) => {
                // Date filter
                if (filter && filter !== "All" && tasker.date !== filter)
                    return false;

                // Time of Day filter
                if (selectedTimeOfDay && tasker.timeOfDay !== selectedTimeOfDay)
                    return false;

                // Price filter
                if (tasker.rate > maxPrice) return false;

                // Tasker Type filter
                if (selectedTaskerType && tasker.type !== selectedTaskerType)
                    return false;

                return true;
            });

            renderTaskers(currentPage);
            renderPagination();
        }

        function sortTaskers(sortType) {
            if (sortType === "highest") {
                filteredTaskers.sort((a, b) => b.rate - a.rate);
            } else if (sortType === "lowest") {
                filteredTaskers.sort((a, b) => a.rate - b.rate);
            }
            renderTaskers(currentPage);
        }

        document.querySelectorAll(".filter-button").forEach((button) => {
            button.addEventListener("click", (e) => {
                const filter = e.target.getAttribute("data-filter");
                filterTaskers(filter);
            });
        });

        document
            .querySelectorAll('input[type="radio"], input[type="range"]')
            .forEach((input) => {
                input.addEventListener("change", () => {
                    const activeFilter = document
                        .querySelector(".filter-button.active")
                        ?.getAttribute("data-filter");
                    filterTaskers(activeFilter || "All");
                });
            });

        document.querySelectorAll(".sort-button").forEach((button) => {
            button.addEventListener("click", (e) => {
                const sortType = e.target.getAttribute("data-sort");
                sortTaskers(sortType);
            });
        });

        function updatePriceLabel(value) {
            const priceLabel = document.getElementById("price-label");
            priceLabel.innerHTML = `The average hourly rate is <span class="font-medium">$${value}/hr</span>`;
        }

        renderTaskers(currentPage);
        renderPagination();
    </script>



    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const mendaBtn = document.getElementById("mendaBtn");
            const overlay = document.getElementById("overlay");
            const closeBtn = document.getElementById("closeBtn");
            const calendarElement = document.getElementById("calendar");
            const timeSelector = document.getElementById("time-selector");
            const timeDropdown = document.getElementById("time");
            const confirmSection = document.getElementById("confirm-section");
            const confirmBtn = document.getElementById("confirmBtn");
            const selectedDetails = document.getElementById("selectedDetails");
            const currentMonthElement = document.getElementById("currentMonth");
            const currentYearElement = document.getElementById("currentYear");

            const months = [
                "January", "February", "March", "April", "May", "June",
                "July", "August", "September", "October", "November", "December"
            ];

            let currentYear = new Date().getFullYear();
            let currentMonth = new Date().getMonth();
            let selectedDate = null;

            const availableDates = {
                "2025-1-7": ["4:00 PM", "5:00 PM", "6:00 PM"],
                "2025-1-8": ["3:00 PM", "4:30 PM"],
                "2025-1-9": ["2:00 PM", "3:00 PM", "5:00 PM"],
                "2025-2-3": ["10:00 AM", "1:00 PM"],
                "2025-2-4": ["9:00 AM", "11:30 AM"],
            };

            function renderCalendar() {
                calendarElement.innerHTML = "";
                currentMonthElement.textContent = months[currentMonth];
                currentYearElement.textContent = currentYear;

                const firstDay = new Date(currentYear, currentMonth, 1).getDay();
                const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();

                for (let i = 0; i < firstDay; i++) {
                    const blank = document.createElement("div");
                    calendarElement.appendChild(blank);
                }

                for (let day = 1; day <= daysInMonth; day++) {
                    const button = document.createElement("button");
                    button.textContent = day;

                    const dateKey = `${currentYear}-${currentMonth + 1}-${day}`;
                    if (availableDates[dateKey]) {
                        button.classList.add("bg-gray-200");
                        button.addEventListener("click", () => selectDate(dateKey, button));
                    } else {
                        button.classList.add("bg-gray-100", "cursor-not-allowed");
                        button.disabled = true;
                    }

                    calendarElement.appendChild(button);
                }
            }

            function selectDate(dateKey, button) {
                selectedDate = dateKey;
                document.querySelectorAll("#calendar button").forEach(btn => btn.classList.remove("bg-indigo-500"));
                button.classList.add("bg-indigo-500");
                populateTimes(availableDates[dateKey]);
                selectedDetails.textContent = `Request for: ${months[currentMonth]} ${new Date(dateKey).getDate()}, ${currentYear}`;
                confirmSection.classList.remove("hidden");
            }

            function populateTimes(times) {
                timeDropdown.innerHTML = "";
                times.forEach(time => {
                    const option = document.createElement("option");
                    option.value = time;
                    option.textContent = time;
                    timeDropdown.appendChild(option);
                });
                timeSelector.classList.remove("hidden");
            }

            confirmBtn.addEventListener("click", () => {
                if (!selectedDate) {
                    alert("Please select a date.");
                    return;
                }
                const selectedTime = timeDropdown.value;
                alert(`Request for: ${selectedDate} at ${selectedTime}`);
            });

            mendaBtn.addEventListener("click", () => overlay.classList.remove("hidden"));
            closeBtn.addEventListener("click", () => overlay.classList.add("hidden"));

            document.getElementById("prevMonth").addEventListener("click", () => {
                currentMonth = (currentMonth - 1 + 12) % 12;
                if (currentMonth === 11) currentYear--;
                renderCalendar();
            });

            document.getElementById("nextMonth").addEventListener("click", () => {
                currentMonth = (currentMonth + 1) % 12;
                if (currentMonth === 0) currentYear++;
                renderCalendar();
            });

            document.getElementById("prevYear").addEventListener("click", () => {
                currentYear--;
                renderCalendar();
            });

            document.getElementById("nextYear").addEventListener("click", () => {
                currentYear++;
                renderCalendar();
            });

            renderCalendar();
        });
    </script>

<?php 
include '../footer.php';

?>
</body>

</html>