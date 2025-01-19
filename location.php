<?php
include "header.php"; // Include header outside the HTML block
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HomeEase</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .hidden-section {
      display: none;
    }

    .visible-section {
      display: block;
    }

    .division-row {
      display: flex;
      gap: 16px;
      overflow-x: auto;
      padding: 8px;
    }

    .division-card {
      min-width: 150px;
      min-height: 150px;
    }

    /* #district-list {
      max-height: auto;
      overflow-y: auto;
    } */
  </style>
</head>

<body>
  <!-- Main Section -->
  <main class="container mx-auto my-10">
    <!-- Available Locations -->
    <h2 class="text-center text-2xl font-semibold text-gray-700 mb-8">Available Locations</h2>
    <div class="division-row">
      <!-- Location Cards -->
      <?php
      $divisions = [
        "dhaka" => "Dhaka",
        "khulna" => "Khulna",
        "sylhet" => "Sylhet",
        "chattogram" => "Chattogram",
        "mymensingh" => "Mymensingh",
        "rajshahi" => "Rajshahi",
        "rangpur" => "Rangpur",
        "barishal" => "Barishal",
      ];
      foreach ($divisions as $key => $name) {
        echo <<<HTML
        <button class="division-card bg-white shadow-md rounded-lg p-4 text-center ml-6" onclick="showDetails('$key')">
          <img src="path-to-$key.jpg" alt="$name" class="rounded-md mb-4">
          <p class="font-medium text-gray-700">$name</p>
        </button>
HTML;
      }
      ?>
    </div>

    <!-- Hidden Section -->
    <div id="details" class="hidden-section mt-10">
      <button class="bg-blue-600 text-white px-4 py-2 rounded mb-6" onclick="hideDetails()">Back</button>
      <h3 id="location-title" class="text-xl font-semibold text-blue-600 text-center mb-4"></h3>
      <!-- <div class="bg-white shadow-md p-6 rounded-lg border border-blue-200"> -->
        <h4 class="text-center text-lg font-semibold text-blue-500 mb-4" id="service-title"></h4>
        <div id="district-list" class="grid grid-cols-4 gap-4 bg-blue-100 rounded-lg  h-48">
          <!-- Districts will be dynamically populated here -->
        </div>
      <!-- </div> -->
    </div>
  </main>

  <!-- JavaScript -->
  <script>
    const divisions = {
      dhaka: [
        "Dhaka", "Faridpur", "Gazipur", "Gopalganj", "Kishoreganj",
        "Madaripur", "Manikganj", "Munshiganj", "Narayanganj",
        "Narsingdi", "Rajbari", "Shariatpur", "Tangail"
      ],
      khulna: [
        "Khulna", "Bagerhat", "Chuadanga", "Jashore", "Jhenaidah",
        "Kushtia", "Magura", "Meherpur", "Narail", "Satkhira"
      ],
      sylhet: ["Sylhet", "Habiganj", "Moulvibazar", "Sunamganj"],
      chattogram: [
        "Chattogram", "Bandarban", "Brahmanbaria", "Chandpur",
        "Cox's Bazar", "Cumilla", "Feni", "Khagrachari", "Lakshmipur",
        "Noakhali", "Rangamati"
      ],
      mymensingh: ["Mymensingh", "Jamalpur", "Netrokona", "Sherpur"],
      rajshahi: [
        "Rajshahi", "Bogura", "Chapainawabganj", "Joypurhat",
        "Naogaon", "Natore", "Pabna", "Sirajganj"
      ],
      rangpur: [
        "Rangpur", "Dinajpur", "Gaibandha", "Kurigram",
        "Lalmonirhat", "Nilphamari", "Panchagarh", "Thakurgaon"
      ],
      barishal: ["Barishal", "Barguna", "Bhola", "Jhalokati", "Patuakhali", "Pirojpur"],
    };

    function showDetails(location) {
      const detailsSection = document.getElementById("details");
      detailsSection.classList.remove("hidden-section");
      detailsSection.classList.add("visible-section");

      const locationTitle = document.getElementById("location-title");
      const serviceTitle = document.getElementById("service-title");
      locationTitle.innerText = `Service Available in ${capitalize(location)}`;
      serviceTitle.innerText = `Available Districts in ${capitalize(location)}`;

      const districtList = document.getElementById("district-list");
      districtList.innerHTML = "";
      divisions[location]?.forEach(district => {
        const button = document.createElement("button");
        button.innerText = district;
        button.className = "bg-white h-[150px] w-[50]px-3 py-2 rounded shadow-md";
        button.onclick = () => fetchUsers(district);
        districtList.appendChild(button);
      });
    }

    function hideDetails() {
      const detailsSection = document.getElementById("details");
      detailsSection.classList.add("hidden-section");
      detailsSection.classList.remove("visible-section");
    }

    function capitalize(word) {
      return word.charAt(0).toUpperCase() + word.slice(1);
    }

    function fetchUsers(district) {
      alert(`Fetching users for ${district}`); // Replace with actual fetch logic
    }
  </script>

<?php include "footer.php"; ?>

</body>

</html>
