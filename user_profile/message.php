
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Inbox</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #F4F4F4;
            font-family: 'Inter', sans-serif;
        }


        .text-gray-700 {
            font-weight: bolder;
        }

        .t {
            font-family: 'Times New Roman', Times, serif;
            font-size: 50px;
            color:#00008B;
        }

        #tittlemnm {
            font-size: x-large;
            color:#00008B;
            margin: 50px 0 0 340px;
        }

        #undernavbar {
            display: flex;
            border-radius: 20px;
            margin-bottom: 80px;
            margin-top: 50px;
            /* Increased margin-bottom for more space */
        }

        #box1 {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            /* margin-bottom: 10px; */
            margin-top: 78px;
            margin-left: 80px;
            height: 360px;
            width: 55%;
        }



        #profileImage {
            margin: 0 20px 0 0;
            height: 200px;
            width: 200px;
        }

        #sidebar {
            flex-direction: column;
            justify-content: center;
            margin: 20px 0 0 30px;
            width: 300px;
        }

        #sidebar ul li a {
            text-decoration: none;
            line-height: 35px;
            font-size: larger;
            margin-left: 20px;
            margin-top: 40px;
            color: #4A5568;
            transition: color 0.3s;
        }

        #sidebar ul li a:hover {
            color: #00008B;
        }

        #sidebar ul li {
            text-decoration: none;
            list-style-type: none;
        }

        #mma {
            font-size: 27.9px;
            text-decoration: none;
            color:#00008B;
        }

        #whiteboard {
            width: 700px;
            margin: 30px 0 40px 100px;
            border-radius: 20px;
            box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;
        }

        #profile_edit {
            margin-left: 20px;
            margin-top: 2px;
            padding: 10px 0 0 8px;
            height: auto;
            width: 100%;
            border-radius: 10px;
        }


        #left {
            /* background-color: #C71585; */
            height: 500px;
            width: 45%;
            float: left;
        }

        #right {

            height: 500px;
            width: 55%;
            position: relative;
            bottom: 10px;
            float: right;
        }

        #btn {
            position: relative;
            right: 340px;
        }

        #name {
            margin: 0 0 0 670px;
        }



        .arrow {
            position: absolute;
            right: 100px;
        }

        .navs {
            background-color: #FFFFFF;
            width: 100vw;
            height: 65px;
            box-shadow: 1px 1px 1px 1px rgba(0, 0, 0, 0.1);
            display: flex;

        }

        .radiant {
            font-size: 42px;
            font-weight: 900;
            margin-left: 90px;
            color: #C71585;
        }

        .login_name {
            font-weight: 900;
        }

        .relation {

            margin-top: 2px;
            padding-left: 10px;

        }

        .together {
            display: flex;
            margin-top: 20px;
            margin-left: 600px;
        }

        li {
            font-size: 21px;
        }

       

        .gri {
            position: relative;
            bottom: 70px;

        }

        #btn {
            position: relative;
            bottom: 70px;
            height: 45px;
        }

        .box_title {
            position: absolute;
            left: 410px;
            font-size: 2rem;
            color: #00008B;
            font-weight: 900;
        }

        #cust_mes {

            height: auto;
            width: 400px;
        }

        #shop_mes {

            height: auto;
            width: 400px;
            margin-left: 630px;

        }

        #box1 {
            height: 900px;
            width: 1100px;
            overflow-y: scroll;
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        #box1::-webkit-scrollbar {
            display: none;
        }
    </style>
</head>

<body class="bg-gradient-to-bl from-blue-50 via-white via-blue-50 to-slate-300 h-screen">

   <nav class="  h-20 w-full py-6 flex justify-between items-center top-0 left-0 z-20 px-6 md:px-16 lg:px-24 border-b-2 border-slate-900">
      <div class="text-2xl md:text-4xl font-bold flex items-center text-black">
        <a href="#" class="flex items-center gap-1">
          <span>HOME</span>
          <span class="text-blue-600">EASE</span>
        </a>
      </div>
   
      <div class="flex">
        <img src="photo\Home\add-user.png" class="h-6 mt-2">
        <a href="typeUser.php" class="text-base md:text-lg font-semibold px-2 py-2 hover:border-b-2 hover:border-blue-600 transition ease-in-out duration-500">
          Signup/Login
        </a>
      </div>
    </nav>




    <!-- <h2 id=" tittlemnm">My Profile</h2> -->
    <section id="undernavbar">
        <div id="sidebar">
            <a href="#" id="mma">Manage My Account</a>
            <ul>
            <li><a href="My_profile.php">My Profile</a></li>
                <li><a href="addressofbooking.php">Address of Booking</a></li>
                <li><a href="myreviews.php">My Reviews</a></li>
                <li><a href="message.php" id="mymessage">My Messages<?php if ($_SESSION['unseen'] > 0): ?>
                            <span class="unseen-count" style="color: red;">(<?php echo $_SESSION['unseen']; ?>)</span>
                        <?php endif; ?></a></li>
                <li><a href="mybooking.php" id="mma">My booking</a></li>
                <li><a href="mycancellations.php">My Cancellations</a></li>
                <li><a href="Notifications.php">My Notifications</a></li>
            </ul>
            <?php
            if (isset($_SESSION['type'])) {
                echo '<a href="../logout.php" class="text-gray-700 hover:text-pink-600 " style="font-size:30px;margin:10px 0 0 20px; line-height:50px;">Logout</a>';
            }
            ?>
        </div>
        <h3 class="box_title">My Messages</h3>
        <div class=" shadow-l border-2 border-blue-100 main-content p-4 flex-1" id="box1">
            
        <?php
                // $shop_id = 121;
                //SQL query to fetch all the conversations among customer and shops
                $customer_id=$_SESSION['customer_id'];
                $sql_user = "SELECT 
                                m.message_id,
                                m.shop_id,
                                m.customer_id,
                                m.message,
                                m.date_and_time,
                                shop.shop_name,
                                shop.mobile_number,
                                shop.shop_email
                            FROM 
                                message_table m
                            JOIN 
                                barber_shop shop ON shop.shop_id = m.shop_id
                            WHERE 
                                m.date_and_time = (
                                    SELECT 
                                        MAX(mt.date_and_time)
                                    FROM 
                                        message_table mt
                                    WHERE 
                                        mt.shop_id = m.shop_id AND mt.customer_id = '$customer_id'
                                ) 
                                AND m.customer_id = '$customer_id'
                            ORDER BY 
                                m.date_and_time DESC";


                // $sql_notify = "SELECT * FROM notifications_by_admin WHERE shop_id='$shop_id' ORDER BY date_time desc";
                $result_notify = mysqli_query($conn, $sql_user);
                if ($result_notify->num_rows > 0) {
                    while ($row_notify = $result_notify->fetch_assoc()) {
                        echo '<a href="reply_message.php?shop_id='.$row_notify['shop_id'].'">';
                        echo '<div class="bg-blue-100 border border-blue-400 text-blue-700 my-5 px-4 py-3 rounded relative"
                        role="alert"><h4 class="font-bold text-lg">' . $row_notify['shop_name'] . '</h4>';
                        // echo '<p class="mt-2">' . $row_notify['message'] . '</p>';
                        echo '<p class="mb-0">' . $row_notify['message'] . '
                                    </p><span id="current-time" class="absolute bottom-0 right-0 mb-2 mr-2 text-sm text-gray-500">' . $row_notify['date_and_time'] . '</span></div></a>';
                    }
                }
                ?>

        </div>
    </section>


<footer class="bg-gray-800 text-white py-10 mt-12">
          <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-8 px-6">
            <!-- Logo and Description -->
            <div class="space-y-4">
              <div class="flex items-center space-x-2">
                <img src="https://img.icons8.com/external-flatart-icons-outline-flatarticons/64/external-logo-business-and-team-flatart-icons-outline-flatarticons.png"
                  alt="Logo" class="w-8 h-8">
                <span class="text-xl font-semibold">HomeEase</span>
              </div>
              <p class="text-gray-400 text-sm">
                Demandium is the best on-demand business solution that connects customers and service providers in a single
                platform. Purchase the Demandium source code and get started.
              </p>
              <!-- Social Icons -->
              <div class="flex space-x-4">
                <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-linkedin-in"></i></a>
                <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-twitter"></i></a>
                <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-youtube"></i></a>
              </div>
              <!-- Codecanyon Badge -->
              <div class="mt-4">
                <a href="#" class="bg-gray-700 text-white text-sm py-2 px-4 rounded-lg inline-flex items-center">
                  <img src="https://img.icons8.com/ios-filled/24/ffffff/code.png" class="mr-2" />
                  GET IT ON Codecanyon
                </a>
              </div>
            </div>

            <!-- Company Links -->
            <div>
              <h3 class="text-white font-semibold mb-4">Company</h3>
              <ul class="space-y-2 text-gray-400 text-sm">
                <li><a href="#" class="hover:text-white">About Us</a></li>
                <li><a href="#" class="hover:text-white">Contact Us</a></li>
                <li><a href="#" class="hover:text-white">Privacy Policy</a></li>
                <li><a href="#" class="hover:text-white">Service & Support Policy</a></li>
                <li><a href="#" class="hover:text-white">Cookies Policy</a></li>
                <li><a href="#" class="hover:text-white">Blog</a></li>
              </ul>
            </div>

            <!-- Quick Links -->
            <div>
              <h3 class="text-white font-semibold mb-4">Quick Links</h3>
              <ul class="space-y-2 text-gray-400 text-sm">
                <li><a href="#" class="hover:text-white">Demo</a></li>
                <li><a href="#" class="hover:text-white">Documentation</a></li>
                <li><a href="#" class="hover:text-white">Community</a></li>
                <li><a href="#" class="hover:text-white">Support</a></li>
                <li><a href="#" class="hover:text-white">FAQs</a></li>
              </ul>
            </div>

            <!-- Contact Information -->
            <div>
              <h3 class="text-white font-semibold mb-4">Contact Us</h3>
              <ul class="space-y-2 text-gray-400 text-sm">
                <li class="flex items-center space-x-2">
                  <span class="text-green-500"><i class="fas fa-phone"></i></span>
                  <span>+8801325887797</span>
                </li>
                <li class="flex items-center space-x-2">
                  <span class="text-blue-500"><i class="fas fa-envelope"></i></span>
                  <span>support@6amtech.com</span>
                </li>
              </ul>
              <div class="mt-4">
                <a href="#" class="inline-flex items-center bg-blue-600 text-white text-sm py-2 px-4 rounded-lg hover:bg-blue-700">
                  Support Ticket →
                </a>
              </div>
            </div>
          </div>
        </footer>





    

</body>

</html>

</html>