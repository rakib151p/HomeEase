<?php 
include 'config.php';
session_start();
$item_name='';
$item_id='';
if(isset($_GET['name'])){
    echo $_GET['name'];
    $item_name = $_GET['name'];

    // Use this item_id to fetch subservice details from the database
    $query = "SELECT * FROM item WHERE item_name = '$item_name'";
    $result = $con->query($query);

    if ($result->num_rows > 0) {
        $item = $result->fetch_assoc();
        $item_id = $item['item_id'];
    }

}else{
    
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>service details</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .scrollbar-hidden::-webkit-scrollbar {
      display: none;
    }

    .scrollbar-hidden {
      -ms-overflow-style: none;
      scrollbar-width: none;
    }

    #Addpicture {
      background-image: url("photo/sample.jpg");
   

    }
  </style>
</head>

<body class="bg-gradient-to-bl from-blue-100 via-white via-blue-100 to-slate-300">
  <!-- Sidebar -->

  <?php
  include 'header.php';
  ?>

  <!-- Header -->
  <div id="Addpicture" class=" w-full flex flex-wrap  text-white bg-slate-900">
    <!-- Left Section -->
    <div class="w-full lg:w-2/3 p-10">
      <div class="breadcrumb text-sm text-gray-300 mb-4">
        <span>Home</span> &bull; <span>Cleaning Solution</span> &bull; <span class="text-white"><?php echo $item_name; ?></span>
      </div>
      <h1 class="text-5xl font-bold mb-4"><?php echo $item_name; ?></h1>
      <div class="flex items-center gap-2 mb-4">
        <div class="bg-green-600 text-white px-3 py-1 rounded-lg text-lg font-semibold flex items-center gap-1">
          <span class="text-xl">&#9733;</span> 4.67 <span class="text-sm">out of 5</span>
        </div>
        <span class="text-gray-300 text-sm">(11363 ratings on 9 services)</span>
      </div>
      <ul class="space-y-2">
        <li class="flex items-center gap-2">
          <span class="text-green-400">&#10003;</span> On Time Work Completion
        </li>
        <li class="flex items-center gap-2">
          <span class="text-green-400">&#10003;</span> Trusted and Experienced Cleaner
        </li>
        <li class="flex items-center gap-2">
          <span class="text-green-400">&#10003;</span> Best Quality Cleaning Accessories
        </li>
      </ul>
    </div>

  </div>




  <div class="h-screen flex overflow-hidden bg-gradient-to-bl from-blue-100 via-white via-blue-100 to-slate-100">
    <div
      class="w-1/4 border-2 bg-gradient-to-bl from-blue-100 via-white via-blue-100 to-slate-100 p-4 overflow-y-auto scrollbar-hidden">

      <ul class=" space-y-2 ml-48">
        <li class="text-2xl font-bold rounded-lg text-gray-700 hover:bg-blue-200 hover:text-black h-14 flex items-center px-4 rounded cursor-pointer" onclick="scrollToSection('service')">
          Service Overview
        </li>
        <li class="text-lg rounded-lg text-gray-700 hover:bg-blue-200 hover:text-black h-14 flex items-center px-4 rounded cursor-pointer" onclick="scrollToSection('faq')">
          FaQ
        </li>
        <li class="text-lg rounded-lg text-gray-700 hover:bg-blue-200 hover:text-black h-14 flex items-center px-4 rounded cursor-pointer" onclick="scrollToSection('reviews')">
          Reviews
        </li>
        <li class="text-lg rounded-lg text-gray-700 hover:bg-blue-200 hover:text-black h-14 flex items-center px-4 rounded cursor-pointer" onclick="scrollToSection('details')">
          Details
        </li>

      </ul>
    </div>

    <!-- Content -->
    <div class="w-3/4 p-4 ml-6 overflow-y-auto">
      <!-- Appliance Repair Section -->
      <div id="service " class="flex flex-col mt-4 mt-12">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Overview of <?php echo $item_name; ?></h1>


        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Note to Customers:</h2>
        <ul class="list-disc pl-6 space-y-2 text-gray-700">
          <li>If there is a delay caused by the customer exceeding <strong class="text-red-600">30 minutes</strong>, an extra charge will be added to the service price.</li>
          <li>Customers must <strong class="text-blue-600">cross-check</strong> the service quality before the service person leaves. After that, <strong class="text-red-600">no complaints</strong> will be entertained.</li>
          <li>Ensure that all <strong class="text-blue-600">expensive belongings</strong> are stored in a safe and secure place.</li>
          <li>Customers are required to provide <strong class="text-blue-600">fresh water</strong> and <strong class="text-blue-600">electricity</strong> to assist the service personnel during their work.</li>
          <li>Service prices are subject to change if the <strong class="text-red-600">working area</strong> is in very poor condition.</li>
          <li>If the <strong class="text-red-600">work area</strong> increases, additional charges will be applied.</li>
          <li>Ensure that <strong class="text-blue-600">no other work</strong> is ongoing during the cleaning service delivery to maintain efficiency and quality.</li>
        </ul>


        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Payment Method:</h2>
        <ul class="list-disc pl-6 space-y-2 text-gray-700">
          <li>Customers must pay the bill <strong class="text-blue-600">immediately</strong> after the service is delivered.</li>
          <li>Accepted payment methods:
            <ol class="list-decimal pl-6 space-y-1">
              <li><strong class="text-green-600">Cash on Delivery (COD)</strong></li>
              <li><strong class="text-green-600">Digital Payment</strong> (Nagad, Bkash, or online bank transfer)</li>
            </ol>
          </li>
        </ul>

        <!-- Booking -->
        <div class="bg-white shadow-md rounded-lg p-6 mt-8 w-[800px] bg-gradient-to-bl from-blue-100 via-white via-blue-100 to-blue-100 border-2 border-blue-100">
          <spand class="text-2xl font-semibold text-gray-800 mt-6">Do You Want to book this Service ? Then Click Here</spand>
          <button onclick="searchBar(<?php echo $item_id; ?>)" class="bg-green-600 text-white h-[50px] w-[100px] rounded-lg mt-6 hover:bg-green-900 ml-[10px]">Book Here</button>
        </div>


      </div>
      <div id="faq" class="mt-12">
        <!-- FAQ Section -->

        <h2 class="text-3xl font-bold text-gray-800 mb-6">FAQ</h2>
        <div class="space-y-4">
          <div>
            <h3 class="flex items-center text-lg font-medium text-gray-900">
              <span class="text-pink-500 font-bold mr-2">•</span> Does the price include cleaning material and equipment charge?
            </h3>
            <p class="text-gray-600 mt-1">Yes. All kinds of material cost for cleaning services is included in the price declared.</p>
          </div>
          <div>
            <h3 class="flex items-center text-lg font-medium text-gray-900">
              <span class="text-pink-500 font-bold mr-2">•</span> What if something goes wrong after availing a service from Sheba?
            </h3>
          </div>
          <div>
            <h3 class="flex items-center text-lg font-medium text-gray-900">
              <span class="text-pink-500 font-bold mr-2">•</span> Is the price Subjected to Fluctuation depending on work scope?
            </h3>
          </div>
        </div>


        <!-- How to Order Section -->

        <h2 class="text-3xl font-bold text-gray-800 mb-6">How to order</h2>
        <div class="space-y-4">
          <div class="flex items-center">
            <div class="flex items-center justify-center h-8 w-8 bg-blue-500 text-white rounded-full font-bold mr-4">1</div>
            <div>
              <h4 class="text-lg font-medium text-gray-900">Select service</h4>
              <p class="text-gray-600">From the category, select the service you are looking for.</p>
            </div>
          </div>
          <div class="flex items-center">
            <div class="flex items-center justify-center h-8 w-8 bg-blue-500 text-white rounded-full font-bold mr-4">2</div>
            <div>
              <h4 class="text-lg font-medium text-gray-900">Book your schedule</h4>
              <p class="text-gray-600">Select your convenient time slot.</p>
            </div>
          </div>
          <div class="flex items-center">
            <div class="flex items-center justify-center h-8 w-8 bg-blue-500 text-white rounded-full font-bold mr-4">3</div>
            <div>
              <h4 class="text-lg font-medium text-gray-900">Place order</h4>
              <p class="text-gray-600">Confirm your order by clicking ‘Place order’.</p>
            </div>
          </div>
        </div>


        <!-- Preparations against COVID-19 -->

        <h2 class="text-3xl font-bold text-gray-800 mb-6">Preparations against COVID-19</h2>
        <div class="flex items-center mb-4">
          <div class="bg-green-500 text-white font-bold px-4 py-2 rounded-full flex items-center">
            <span>&#10003;</span>
            <span class="ml-2">SAFETY ENSURED</span>
          </div>
        </div>
        <p class="text-gray-600 mb-4">
          We are well-equipped and well-prepared to protect your health and hygiene while we serve you. Our preparations include:
        </p>
        <ul class="list-disc pl-6 text-gray-600 space-y-2">
          <li>Checked Health condition of service specialist</li>
          <li>Ensuring use of masks, hand sanitizers, gloves, etc</li>
          <li>Disinfecting equipments before and after the work</li>
          <li>Maintaining social distancing</li>
        </ul>




      </div>
      <div id="reviews" class="mt-12">



        <div class="space-y-6">
          <!-- Review Card 1 -->
          <div class="bg-white p-4 border rounded-lg shadow-lg">
            <div class="flex justify-between items-center mb-2">
              <div class="font-semibold">Ishmam Chowdhury</div>
              <div class="text-sm text-gray-500">Taken on 17 January, 2025</div>
            </div>
            <div class="text-yellow-500">&#9733; &#9733; &#9733; &#9733; &#9733;</div>
            <div class="mt-2">EXTREMELY GOOD SERVICE!!! I WOULD RECOMMEND.</div>
          </div>

          <!-- Review Card 2 -->
          <div class="bg-white p-4 border rounded-lg shadow-lg">
            <div class="flex justify-between items-center mb-2">
              <div class="font-semibold">Toukir Hossain</div>
              <div class="text-sm text-gray-500">Taken on 28 December, 2024</div>
            </div>
            <div class="text-yellow-500">&#9733; &#9733; &#9733; &#9733; &#9733;</div>
            <div class="mt-2">Excellent service, highly recommended</div>
          </div>

          <!-- Review Card 3 -->
          <div class="bg-white p-4 border rounded-lg shadow-lg">
            <div class="flex justify-between items-center mb-2">
              <div class="font-semibold">Mamunur Rashid Shawon</div>
              <div class="text-sm text-gray-500">Taken on 22 December, 2024</div>
            </div>
            <div class="text-yellow-500">&#9733; &#9733; &#9733; &#9733; &#9733;</div>
            <div class="mt-2">Truly good Service. Thanks.</div>
          </div>

          <!-- Review Card 4 -->
          <div class="bg-white p-4 border rounded-lg shadow-lg">
            <div class="flex justify-between items-center mb-2">
              <div class="font-semibold">Shahrin Jannat Nuhash</div>
              <div class="text-sm text-gray-500">Taken on 20 December, 2024</div>
            </div>
            <div class="text-yellow-500">&#9733; &#9733; &#9733; &#9733; &#9733;</div>
            <div class="mt-2">The service was very good and supportive. Well mannered. Good service.</div>
          </div>

          <!-- Review Card 5 -->
          <div class="bg-white p-4 border rounded-lg shadow-lg">
            <div class="flex justify-between items-center mb-2">
              <div class="font-semibold">Mr. Rabi</div>
              <div class="text-sm text-gray-500">Taken on 9 December, 2024</div>
            </div>
            <div class="text-yellow-500">&#9733; &#9733; &#9733; &#9733; &#9733;</div>
            <div class="mt-2">Excellent service and well mannered. Highly recommend them!</div>
          </div>

          <!-- Review Card 6 -->
          <div class="bg-white p-4 border rounded-lg shadow-lg">
            <div class="flex justify-between items-center mb-2">
              <div class="font-semibold">Fayaz Ahmed</div>
              <div class="text-sm text-gray-500">Taken on 5 December, 2024</div>
            </div>
            <div class="text-yellow-500">&#9733; &#9733; &#9733; &#9733; &#9733;</div>
            <div class="mt-2">Excellent service, thanks!</div>
          </div>

          <!-- Review Card 7 -->
          <div class="bg-white p-4 border rounded-lg shadow-lg">
            <div class="flex justify-between items-center mb-2">
              <div class="font-semibold">Saiduzzaman Evan</div>
              <div class="text-sm text-gray-500">Taken on 30 November, 2024</div>
            </div>
            <div class="text-yellow-500">&#9733; &#9733; &#9733; &#9733; &#9733;</div>
            <div class="mt-2">Very well mannered and professional service. Thanks a lot.</div>
          </div>

          <!-- Review Card 8 -->
          <div class="bg-white p-4 border rounded-lg shadow-lg">
            <div class="flex justify-between items-center mb-2">
              <div class="font-semibold">Nurun Nahar</div>
              <div class="text-sm text-gray-500">Taken on 22 November, 2024</div>
            </div>
            <div class="text-yellow-500">&#9733; &#9733; &#9733; &#9733; &#9733;</div>
            <div class="mt-2">Very polite and hardworking person. Gladly recommending him.</div>
          </div>

          <!-- Review Card 9 -->
          <div class="bg-white p-4 border rounded-lg shadow-lg">
            <div class="flex justify-between items-center mb-2">
              <div class="font-semibold">Ruqaiya Farzana</div>
              <div class="text-sm text-gray-500">Taken on 14 November, 2024</div>
            </div>
            <div class="text-yellow-500">&#9733; &#9733; &#9733; &#9733; &#9733;</div>
            <div class="mt-2">2nd time took his service. He is excellent in cleaning.</div>
          </div>

          <!-- Review Card 10 -->
          <div class="bg-white p-4 border rounded-lg shadow-lg">
            <div class="flex justify-between items-center mb-2">
              <div class="font-semibold">Asif Iqbal</div>
              <div class="text-sm text-gray-500">Taken on 21 September, 2024</div>
            </div>
            <div class="text-yellow-500">&#9733; &#9733; &#9733; &#9733; &#9733;</div>
            <div class="mt-2">Thank you for your wonderful service with patience and well behaviour... anticipating for more service... see you...</div>
          </div>
        </div>
      </div>

      <div id="details" class="mt-12">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Details</h2>
        <p class="mb-4 text-gray-700">This service will help you to clean your home and also help to remove deep stains. Our Service provider will use effective chemicals that will wash your home smoothly and neatly.</p>

        <h3 class="text-lg font-semibold text-indigo-500 mb-2">Our <?php echo $item_name; ?> services:</h3>
        <ul class="list-disc list-inside mb-4 text-gray-700">
          <li>Bathroom Deep Cleaning</li>
          <li>Kitchen Cleaning (Without inside cabinet clean, Kitchen Hood, Exhaust Fan)</li>
          <li>Floor Deep Cleaning</li>
          <li>Home Deep Cleaning</li>
          <li>Common Space Cleaning (If Need price will be shared accordingly)</li>
        </ul>

        <h3 class="text-lg font-semibold text-indigo-500 mb-2">Terms & Pricing</h3>
        <ul class="list-disc list-inside mb-4 text-gray-700">
          <li>Pricing policy: Price mentioned are based on the minimum quantity stated; extra charge will be added if the work scope increases.</li>
          <li>Payment: After service completion – respective customers will pay online or COD. After payment, please make sure you have received the SMS containing the money receipt.</li>
        </ul>

        <h3 class="text-lg font-semibold text-indigo-500 mb-2">Note To Customer:</h3>
        <ul class="list-disc list-inside mb-4 text-gray-700">
          <li>If Any Delay Happens By Customer (30 Mints +) Then There Will Be An Extra Charge Add With The Service Price</li>
          <li>After Delivering The Service, The Customer Must Cross Check The Service Before The Service Person Leaves The Place. After That No Complaint Will Be Accepted</li>
          <li>Make Sure To Keep The Expensive Belongings In A Safe Place</li>
          <li>Customer Need To Provide Fresh Water And Electricity To Support The Service Person</li>
          <li>The Service price might be change, if the working area is in very poor Condition.</li>
          <li>If The Work Area Increases Then Extra Price Will Be Added</li>
          <li>Make Sure No Other Work Is Going On When The Cleaning Service Is Being Delivered.</li>
        </ul>

        <h3 class="text-lg font-semibold text-indigo-500 mb-2">Payment Method:</h3>
        <ul class="list-disc list-inside text-gray-700">
          <li>After Delivering The Service Customer Need To Pay The Bill Instantly.</li>
          <li>Two Types Of Payment Are Acceptable- 1. Cod (Cash On Delivery), Digital Payment (Nagad, Bkash, Online Bank Payment)</li>
        </ul>
      </div>


    </div>
  </div>
  <!-- <div class="mt-24"></div>
  </div> -->
  <?php 
    include 'footer.php';
  ?>
  <script>
    function scrollToSection(id) {
      document.getElementById(id).scrollIntoView({
        behavior: 'smooth'
      });
    }
    function searchBar(item_id) {
            const redirectUrl = `service.php?item_id=${item_id}`;
            window.location.href = redirectUrl; // Redirect to the new page
          }
  </script>

</body>

</html>