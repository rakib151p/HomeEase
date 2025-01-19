<nav class="  h-20 w-full py-6 flex justify-between items-center top-0 left-0 z-20 px-6 md:px-16 lg:px-24 border-b-2 border-slate-300">
  <div class="text-2xl md:text-4xl font-bold flex items-center text-black">
    <a href="home.php" class="flex items-center gap-1">
      <span>HOME</span>
      <span class="text-red-600">EASE</span>
    </a>
  </div>
  <div class="hidden md:flex items-center space-x-6">
    <div class="flex">
      <img src="photo\Home\locator.png" class="h-6 mt-2">
      <a href="location.php" class="text-base md:text-lg font-semibold px-4 py-2 hover:border-b-2 hover:border-blue-600 transition ease-in-out duration-500">
        Location
      </a>
    </div>
    <div class="flex">
      <img src="photo\Home\time.png" class="h-6 mt-2">
      <a href="#" class="text-base md:text-lg font-semibold px-2 py-2 hover:border-b-2 hover:border-blue-600 transition ease-in-out duration-500">
        All Services
      </a>

    </div>

    <div class="flex">
      <img src="photo\Home\phone.png" class="h-6 mt-2">
      <a href="#" class="text-base md:text-lg font-semibold px-2 py-2 hover:border-b-2 hover:border-blue-600 transition ease-in-out duration-500">
        About Us
      </a>
    </div>

  </div>
  <?php
  // session_start();
  if (isset($_SESSION['email'])) {

    echo '<div class="flex gap-4">
        <div class="text-base md:text-lg font-semibold mt-2">';
    if($_SESSION['type']=='user'){
      echo '<a href="user_profile/My_profile.php">'.$_SESSION['user_name'].'</a>';
    }else{
      echo '<a href="service provider/dashboard.php">'.$_SESSION['provider_name'].'</a>';
    }
        echo'</div>
        <div class="flex">
        <img src="photo\Home\add-user.png" class="h-6 mt-2">
        <a href="logout.php" class="text-base md:text-lg font-semibold px-2 py-2 hover:border-b-2 hover:border-blue-600 transition ease-in-out duration-500">
          Logout
        </a>
        </div>
        
      </div>';
  } else {
    echo '<div class="flex">
        <img src="photo\Home\add-user.png" class="h-6 mt-2">
        <a href="login.php" class="text-base md:text-lg font-semibold px-2 py-2 hover:border-b-2 hover:border-blue-600 transition ease-in-out duration-500">
          Signup/Login
        </a>
      </div>';
  }
  ?>

</nav>