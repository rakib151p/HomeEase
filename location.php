<?php
session_start();
include 'config.php';


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dropdown with Sub-service Cards</title>
  <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-gradient-to-bl from-blue-100 via-white via-blue-100 to-slate-300 min-h-screen">

  <?php
  include 'header.php';
  ?>

  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const divisions = {
        Dhak: ["Dhaka", "Gazipur", "Narayanganj"],
        Dhaka: ["Dhaka", "Gazipur", "Narayanganj"],
        Chittagong: ["Chittagong", "Cox's Bazar", "Rangamati"],
        Rajshahi: ["Rajshahi", "Pabna", "Natore"],
      };

      const services = {
        Cleaning: ["Floor Cleaning", "Window Cleaning", "Carpet Cleaning"],
        Plumbing: ["Pipe Fixing", "Leakage Repair", "Installation"],
        Electrical: ["Wiring", "Appliance Repair", "Circuit Installation"],
      };

      const divisionDropdown = document.getElementById("division");
      const districtDropdown = document.getElementById("district");
      const serviceDropdown = document.getElementById("service");
      const subServiceContainer = document.getElementById("sub-service-container");

      // Update Districts
      divisionDropdown.addEventListener("change", () => {
        const selectedDivision = divisionDropdown.value;
        districtDropdown.innerHTML = '<option value="">Select District</option>';

        if (selectedDivision) {
          divisions[selectedDivision].forEach((district) => {
            const option = document.createElement("option");
            option.value = district;
            option.textContent = district;
            districtDropdown.appendChild(option);
          });
        }
      });

      // Update Sub-services
      serviceDropdown.addEventListener("change", () => {
        const selectedService = serviceDropdown.value;
        subServiceContainer.innerHTML = "";

        if (selectedService && services[selectedService]) {
          const subServices = services[selectedService];
          subServiceContainer.innerHTML = `
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Available Sub-services:</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
              ${subServices
                .map(
                  (subService) => `
                  <div class="bg-white border rounded-lg shadow-md p-4">
                    <h4 class="text-md font-bold text-indigo-600 mb-2">${subService}</h4>
                    <p class="text-gray-600">This is the description for ${subService}. Click below to know more.</p>
                    <button class="mt-3 px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">More Info</button>
                  </div>
                `
                )
                .join("")}
            </div>
          `;
        } else {
          subServiceContainer.innerHTML = `<p class="text-gray-600">No sub-services available. Please select a valid service.</p>`;
        }
      });
    });
  </script>
  <!-- Top Navigation Bar -->
  <nav class=" ">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between">
      <h1 class="text-xl font-bold text-indigo-600">Service Selector</h1>

      <div class="flex gap-4">
        <!-- Division Dropdown -->
        <select id="division" class="border-gray-300 h-[50px] w-[130px] rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
          <option class="ml-[10px] border-2 border-slate-900 value="">Select Division</option>
          <option value="Dhaka">Dhaka</option>
          <option value="Chittagong">Chittagong</option>
          <option value="Rajshahi">Rajshahi</option>
        </select>

        <!-- District Dropdown -->
        <select id="district" class="border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
          <option value="">Select District</option>
        </select>

        <!-- Service Dropdown -->
        <select id="service" class="border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
          <option value="">Select Service</option>
          <option value="Cleaning">Cleaning</option>
          <option value="Plumbing">Plumbing</option>
          <option value="Electrical">Electrical</option>
        </select>
      </div>
    </div>
  </nav>

  <!-- Main Content -->
  <main class="pt-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
      <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Welcome to the Service Selector</h2>
        <p class="text-gray-600">Select your division, district, and service from the dropdown menus at the top. Sub-services will appear below in card format.</p>
      </div>

      <!-- Sub-service Display -->
      <div id="sub-service-container" class="bg-white p-6 rounded-lg shadow-md mt-6">
        <p class="text-gray-600">Please select a service to view sub-services.</p>
      </div>
    </div>
  </main>
  <?php include 'footer.php'; ?>
</body>

</html>