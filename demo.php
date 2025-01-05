
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>

  <title>Document</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      overflow-x: hidden;
      height: 100%;

    }


    /* Ensure grid and content layout fits viewport */
    .w-screen {
      width: 100vw;
    }

    #comments-container::-webkit-scrollbar {
      display: none;
      /* Hides the scrollbar */
    }

    #comments-container {
      -ms-overflow-style: none;
      /* Hides scrollbar for IE/Edge */
      scrollbar-width: none;
      /* Hides scrollbar for Firefox */
    }

    .text-gray-600.mt-2 {
      white-space: normal;
      /* Allows the text to wrap naturally */
      word-wrap: break-word;
      /* Break long words onto the next line */
      line-height: 1.5;
      /* Add some space between lines for better readability */
      overflow-wrap: break-word;
      /* Ensure long words break within the container */
      max-height: 200px;
      /* Optional: Limit height to keep the card layout intact */
      overflow: auto;
      /* Allow scrolling if the text exceeds the height */
    }
  </style>

</head>

<body>
  <!-- Navbar -->
  <section class="bg-gradient-to-bl from-blue-100 via-white via-blue-100 to-slate-300 ">
    <?php include 'header.php'; ?>
    


    <section id="bg" class="text-center pt-12 md:pt-24 w-screen h-auto relative overflow-hidden">
      <p class="text-3xl md:text-6xl font-bold">All In One Solution</p>
      <p class="text-lg md:text-2xl pt-4">One Platform, Every Service, Welcome to HomeEase</p>

      <!-- Background Images -->
      <img src="photo\Home\—Pngtree—blue wavy lines background cartoon_2177519.png" class="absolute hidden md:block top-12 left-0 w-[300px] md:w-[500px]">
      <img src="photo\Home\image (1).png" class="absolute hidden md:block right-0 top-12 w-[300px] md:w-[500px]">
      <!-- <img src="circumference.png" class="h-12  absolute top-[212px] left-[100px]">
   <img src="circumference.png" class="h-12  absolute top-[207px] left-[210px]">
   <img src="circumference.png" class="h-12  absolute top-[205px] left-[470px]"> -->


      <!-- Input Container -->
      <div class="relative rounded-full bg-white shadow-xl w-[90%] sm:w-[500px] mx-auto mt-10 overflow-hidden">
        <input
          class="input bg-transparent outline-none border-none pl-6 pr-10 py-5 w-full text-base sm:text-lg font-semibold"
          placeholder="Hover on Submit"
          name="text"
          type="text" />
        <div class="absolute right-2 top-2">
          <button class="w-12 h-12 md:w-14 md:h-14 rounded-full bg-violet-500 group shadow-xl flex items-center justify-center relative overflow-hidden">
            <svg class="relative z-10" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 64 64" height="40" width="40">
              <path fill-opacity="0.01" fill="white" d="M63.6689 29.0491L34.6198 63.6685L0.00043872 34.6194L29.0496 1.67708e-05L63.6689 29.0491Z"></path>
              <path stroke-linejoin="round" stroke-linecap="round" stroke-width="3.76603" stroke="white" d="M42.8496 18.7067L21.0628 44.6712"></path>
              <path stroke-linejoin="round" stroke-linecap="round" stroke-width="3.76603" stroke="white" d="M26.9329 20.0992L42.85 18.7067L44.2426 34.6238"></path>
            </svg>
            <div class="w-full h-full rotate-45 absolute left-[32%] top-[32%] bg-black group-hover:-left-[100%] group-hover:-top-[100%] duration-1000"></div>
            <div class="w-full h-full -rotate-45 absolute -left-[32%] -top-[32%] group-hover:left-[100%] group-hover:top-[100%] bg-black duration-1000"></div>
          </button>
        </div>
      </div>

      <!-- Service Grid -->
      <section id="services" class="w-screen h-auto pt-12 md:pt-24">
        <div class="relative w-[40%] lg:w-[40%] mx-auto overflow-hidden">
          <!-- Left Arrow -->
          <button id="prev-btn" class="absolute top-1/2 left-0 transform -translate-y-1/2 bg-gray-200 hover:bg-gray-300 rounded-full p-2 shadow-lg z-10">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M7.707 14.707a1 1 0 010-1.414L10.586 10 7.707 7.707a1 1 0 111.414-1.414l3.999 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
            </svg>
          </button>

          <!-- Services Slider -->
          <div id="slider" class="gap-4 flex transition-transform duration-500">
            <!-- Service 1: Assembly -->
            <div id="assembly" onclick="selectService('assembly')" class="service-item flex flex-col items-center justify-center p-4 border border-transparent rounded-lg bg-white shadow-md cursor-pointer hover:bg-gray-100 w-[200px] shrink-0">
              <img src="https://img.icons8.com/ios/50/assembly.png" alt="Assembly" class="w-12 h-12">
              <span class="mt-2 text-base sm:text-lg font-medium">Assembly</span>
            </div>

            <!-- Service 2: Mounting -->
            <div id="mounting" onclick="selectService('mounting')" class="service-item flex flex-col items-center justify-center p-4 border border-transparent rounded-lg bg-white shadow-md cursor-pointer hover:bg-gray-100 w-[200px] shrink-0">
              <img src="https://img.icons8.com/ios/50/mounting.png" alt="Mounting" class="w-12 h-12">
              <span class="mt-2 text-base sm:text-lg font-medium">Mounting</span>
            </div>

            <!-- Service 3: Moving -->
            <div id="moving" onclick="selectService('moving')" class="service-item flex flex-col items-center justify-center p-4 border border-transparent rounded-lg bg-white shadow-md cursor-pointer hover:bg-gray-100 w-[200px] shrink-0">
              <img src="https://img.icons8.com/ios/50/moving.png" alt="Moving" class="w-12 h-12">
              <span class="mt-2 text-base sm:text-lg font-medium">Moving</span>
            </div>

            <!-- Service 4: Another Moving -->
            <div id="movin" onclick="selectService('movin')" class="service-item flex flex-col items-center justify-center p-4 border border-transparent rounded-lg bg-white shadow-md cursor-pointer hover:bg-gray-100 w-[200px] shrink-0">
              <img src="https://img.icons8.com/ios/50/moving.png" alt="Moving" class="w-12 h-12">
              <span class="mt-2 text-base sm:text-lg font-medium">Moving</span>
            </div>
          </div>

          <!-- Right Arrow -->
          <button id="next-btn" class="absolute top-1/2 right-0 transform -translate-y-1/2 bg-gray-200 hover:bg-gray-300 rounded-full p-2 shadow-lg z-10">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 010 1.414L9.414 10l2.879 2.879a1 1 0 01-1.415 1.415l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.415 0z" clip-rule="evenodd" />
            </svg>
          </button>
        </div>
      </section>

      <script>
        const slider = document.getElementById("slider");
        const prevBtn = document.getElementById("prev-btn");
        const nextBtn = document.getElementById("next-btn");

        let currentPosition = 0;
        const slideWidth = 200; // Width of each service item (adjust based on your CSS)

        // Handle Next Button Click
        nextBtn.addEventListener("click", () => {
          const maxScroll = slider.scrollWidth - slider.clientWidth;
          if (currentPosition < maxScroll) {
            currentPosition += slideWidth;
            slider.style.transform = `translateX(-${currentPosition}px)`;
          }
        });

        // Handle Previous Button Click
        prevBtn.addEventListener("click", () => {
          if (currentPosition > 0) {
            currentPosition -= slideWidth;
            slider.style.transform = `translateX(-${currentPosition}px)`;
          }
        });
      </script>


      <!-- Subservice Container -->
      <div id="subservice-container" class="flex flex-wrap gap-4 justify-center mt-8"></div>

      <!-- Text and Image Container -->
      <div class="bg-[#D0DFEF] h-[700px] w-[1100px] mt-12 rounded-[120px] ml-[400px] relative flex items-center justify-center">
        <!-- White Card -->
        <div id="white-card" class="absolute top-1/4 left-16 bg-white rounded-3xl shadow-lg p-8 w-[300px] z-50">
          <h2 id="card-title" class="text-2xl font-bold mb-4">Mounting</h2>
          <ul id="card-list" class="space-y-2 text-gray-700">
            <li>✔ Securely mount your TV, shelves, art, mirrors, dressers, and more.</li>
            <li>✔ Now Trending: Gallery walls, art TVs, and wraparound bookcases.</li>
          </ul>
        </div>

        <!-- Image Section -->
        <img id="service-image" src="https://via.placeholder.com/600x300?text=Select+a+Service"
          alt="Service Image"
          class="z-0 rounded-[70px] shadow-md w-full max-w-[900px]">
      </div>

      <script>
        // Service data
        const services = {
          assembly: {
            subservices: ['General Furniture Assembly', 'IKEA Assembly', 'Crib Assembly', 'PAX Assembly', 'Bookshelf Assembly'],
            image: 'pexels-njeromin-29376558.jpg',
            text: 'Assembly: Set up furniture and other items efficiently and with care.',
            cardTitle: 'Assembly',
            cardContent: [
              '✔ Set up furniture and other items efficiently and with care.',
              '✔ Includes IKEA and custom furniture setups.',
            ]
          },
          mounting: {
            subservices: ['TV Mounting', 'Wall Shelf Mounting', 'Picture Hanging', 'Curtain Rod Installation'],
            image: 'pexels-shkrabaanthony-7345465.jpg',
            text: 'Mounting: Perfectly install items on walls, such as TVs and shelves.',
            cardTitle: 'Mounting',
            cardContent: [
              '✔ Securely mount your TV, shelves, art, mirrors, dressers, and more.',
              '✔ Now Trending: Gallery walls, art TVs, and wraparound bookcases.',
            ]
          },
          moving: {
            subservices: ['Small Moves', 'Packing and Unpacking', 'Heavy Lifting', 'Furniture Rearranging'],
            image: 'photo\Home\pexels-trimlack-2867761.jpg',
            text: 'Moving: Smoothly move and rearrange your belongings.',
            cardTitle: 'Moving',
            cardContent: [
              '✔ Small moves and heavy lifting made easy.',
              '✔ Includes packing, unpacking, and furniture rearranging.',
            ]
          }
        };
        // Default selection
        selectService('assembly');
      </script>
      <section class="bg-gradient-to-bl via-white to-blue-50">

        <section class="max-w-6xl mx-auto py-16 text-center">
          <h2 class="text-black font-bold text-2xl md:text-3xl mb-12">HOW IT WORKS</h2>

          <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Card 1 -->
            <div class="bg-gradient-to-br from-blue-100 via-white to-blue-50 shadow-lg rounded-lg p-8 hover:-translate-y-2 transition-transform duration-300 border border-gray-200">
              <div class="flex items-center justify-center w-16 h-16 border-2 border-blue-500 rounded-full text-xl font-bold text-blue-500 mx-auto">
                1
              </div>
              <img src="photo\Home\reservation-smartphone.png" alt="Book Online" class="w-16 h-16 mt-6 mx-auto">
              <h3 class="text-blue-500 font-semibold text-xl mt-4">Book Online</h3>
              <p class="text-gray-600 mt-4 text-sm">Pick a date and 2-hour appointment time when you want your service provider to arrive.</p>
            </div>

            <!-- Card 2 -->
            <div class="bg-gradient-to-br from-blue-100 via-white to-blue-50 shadow-lg rounded-lg p-8 hover:-translate-y-2 transition-transform duration-300 border border-gray-200">
              <div class="flex items-center justify-center w-16 h-16 border-2 border-blue-500 rounded-full text-xl font-bold text-blue-500 mx-auto">
                2
              </div>
              <img src="photo\Home\thumbs-up-trust.png" alt="Review On-Site Estimate" class="w-16 h-16 mt-6 mx-auto">
              <h3 class="text-blue-500 font-semibold text-xl mt-4">Review On-Site Estimate</h3>
              <p class="text-gray-600 mt-4 text-sm">Your service provider will prepare an estimate to complete the repair.</p>
            </div>

            <!-- Card 3 -->
            <div class="bg-gradient-to-br from-blue-100 via-white to-blue-50 shadow-lg rounded-lg p-8 hover:-translate-y-2 transition-transform duration-300 border border-gray-200">
              <div class="flex items-center justify-center w-16 h-16 border-2 border-blue-500 rounded-full text-xl font-bold text-blue-500 mx-auto">
                3
              </div>
              <img src="photo\Home\wallet-arrow.png" alt="Pay After Work Is Done" class="w-16 h-16 mt-6 mx-auto">
              <h3 class="text-blue-500 font-semibold text-xl mt-4">Pay After Work Is Done</h3>
              <p class="text-gray-600 mt-4 text-sm">When the work is complete, pay the final invoice and relax.</p>
            </div>
          </div>
        </section>

        <section class="mt-12  w-[1200px] ml-[450px]">
          <span class="font-bold text-3xl mt-12 pr-[200px]">Popular Services</span>
          <div class="grid grid-cols-3 gap-6 mt-12">

            <div class="w-60 h-80 bg-white-800 rounded-3xl  p-4 flex flex-col items-start justify-center gap-3 border border-blue-500 shadow-xl ">
              <div class="w-52 h-40 bg-sky-300 rounded-2xl"><img src="photo\Home\pexels-njeromin-29376558.jpg" class="rounded-2xl  h-40 w-52"></div>
              <div class="">
                <p class="font-extrabold text-black">Card title</p>
                <p class="text-black">4 popular types of cards in UI design.</p>
              </div>
              <button class="bg-sky-700 font-extrabold p-2 px-6 rounded-xl hover:bg-sky-500 transition-colors">See more</button>
            </div>

            <div class="w-60 h-80 bg-white-800 rounded-3xl  p-4 flex flex-col items-start justify-center gap-3 border border-blue-500 shadow-xl">
              <div class="w-52 h-40 bg-sky-300 rounded-2xl"><img src="photo\Home\pexels-njeromin-29376558.jpg" class="rounded-2xl  h-40 w-52"></div>
              <div class="">
                <p class="font-extrabold text-black">Card title</p>
                <p class="text-black">4 popular types of cards in UI design.</p>
              </div>
              <button class="bg-sky-700 font-extrabold p-2 px-6 rounded-xl hover:bg-sky-500 transition-colors">See more</button>
            </div>
            <div class="w-60 h-80 bg-white-800 rounded-3xl  p-4 flex flex-col items-start justify-center gap-3 border border-blue-500 shadow-xl">
              <div class="w-52 h-40 bg-sky-300 rounded-2xl"><img src="photo\Home\pexels-njeromin-29376558.jpg" class="rounded-2xl  h-40 w-52"></div>
              <div class="">
                <p class="font-extrabold text-black">Card title</p>
                <p class="text-black">4 popular types of cards in UI design.</p>
              </div>
              <button class="bg-sky-700 font-extrabold p-2 px-6 rounded-xl hover:bg-sky-500 transition-colors">See more</button>
            </div>



            <div class="w-60 h-80 bg-white-800 rounded-3xl  p-4 flex flex-col items-start justify-center gap-3 border border-blue-500 shadow-xl">
              <div class="w-52 h-40 bg-sky-300 rounded-2xl"><img src="photo\Home\pexels-njeromin-29376558.jpg" class="rounded-2xl  h-40 w-52"></div>
              <div class="">
                <p class="font-extrabold text-black">Card title</p>
                <p class="text-black">4 popular types of cards in UI design.</p>
              </div>
              <button class="bg-sky-700 font-extrabold p-2 px-6 rounded-xl hover:bg-sky-500 transition-colors">See more</button>
            </div>

          </div>

        </section>
        <section class="mx-auto py-16 text-center">
          <div class="max-w-6xl mx-auto py-16 text-center">
            <span class="text-3xl font-bold text-gray-800 mb-8 block">
              What Type of Homes We Provide Services
            </span>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-12">
              <!-- Apartment Card -->
              <div class="bg-gradient-to-br from-blue-100 via-white to-blue-50 relative bg-white shadow-lg rounded-lg overflow-hidden p-6 transition-transform transform hover:-translate-y-3 hover:shadow-2xl border border-gray-200">
                <img src="photo\Home\pexels-pixabay-271624.jpg" class="h-32 w-full object-cover rounded-t-lg" alt="Apartment">
                <div class="absolute top-4 left-4 bg-blue-500 text-white text-xs font-semibold px-3 py-1 rounded-full">
                  Popular
                </div>
                <p class="text-2xl text-blue-600 font-semibold mt-4 flex items-center justify-center">
                  🏢 Apartments
                </p>
                <p class="text-gray-500 mt-2 text-sm">
                  Experience the best apartment services for modern living.
                </p>
              </div>

              <!-- Independent Houses Card -->
              <div class="bg-gradient-to-br from-blue-100 via-white to-blue-50 relative bg-white shadow-lg rounded-lg overflow-hidden p-6 transition-transform transform hover:-translate-y-3 hover:shadow-2xl border border-gray-200">
                <img src="photo\Home\pexels-tomas-malik-793526-2581922.jpg" class="h-32 w-full object-cover rounded-t-lg" alt="Independent Houses">
                <p class="text-2xl text-blue-600 font-semibold mt-4 flex items-center justify-center">
                  🏠 Independent Houses
                </p>
                <p class="text-gray-500 mt-2 text-sm">
                  Tailored services for standalone houses, designed with care.
                </p>
              </div>
              <!-- Bungalows Card -->
              <div class=" bg-gradient-to-br from-blue-100 via-white to-blue-50 relative bg-white shadow-lg rounded-lg overflow-hidden p-6 transition-transform transform hover:-translate-y-3 hover:shadow-2xl border border-gray-200">
                <img src="photo\Home\pexels-grizzlybear-436381.jpg" class="h-32 w-full object-cover rounded-t-lg" alt="Bungalows">
                <div class="absolute top-4 right-4 bg-green-500 text-white text-xs font-semibold px-3 py-1 rounded-full">
                  Luxury
                </div>
                <p class="text-2xl text-blue-600 font-semibold mt-4 flex items-center justify-center">
                  🏡 Bungalows
                </p>
                <p class="text-gray-500 mt-2 text-sm">
                  Luxurious and spacious bungalow services for premium living.
                </p>
              </div>
            </div>
          </div>
        </section>
        <!-- //footer link -->
        <?php include 'footer.php'; ?>
</body>
</html>
