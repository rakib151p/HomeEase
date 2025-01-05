<?php
require_once "config.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['user_type'])) {
        $userType = $_POST['user_type'];
        if ($userType === 'User') {
            header("Location: user_signup_login/signup-user.php");
            exit();
        } elseif ($userType === 'Service Provider') {
            header("Location:service_provider/signup-service-provider.php");
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Signup Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-bl from-blue-200 via-slate-100 via-blue-200 to-slate-300 font-sans">
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white p-8 rounded-lg shadow-xl w-full max-w-sm bg-gradient-to-bl from-blue-100 via-slate-100 via-slate-100 to-blue-100 border-2 border-blue-200">
            <form action="" method="POST">


                <div class="flex gap-5">
                    <div>
                        <a href="Lendingpage.php"> <button
                                class="bg-white text-center h-10 w-10 rounded-2xl  relative right-4 bottom-2 text-black text-xl font-semibold group"
                                type="button">
                                <div
                                    class="bg-blue-400 rounded-xl h-10 w-10 flex items-center justify-center absolute  top-[4px] ">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 1024 1024"
                                        height="25px"
                                        width="25px">
                                        <path
                                            d="M224 480h640a32 32 0 1 1 0 64H224a32 32 0 0 1 0-64z"
                                            fill="#000000"></path>
                                        <path
                                            d="m237.248 512 265.408 265.344a32 32 0 0 1-45.312 45.312l-288-288a32 32 0 0 1 0-45.312l288-288a32 32 0 1 1 45.312 45.312L237.248 512z"
                                            fill="#000000"></path>
                                    </svg>
                                </div>
                            </button></a>
                    </div>
                    <div>
                        <p align="center" class="mb-4 text-bold">Which type of User You Are?</p>
                    </div>

                </div>
                <!-- User Button -->
                <button type="submit" name="user_type" value="User"
                    class="w-full h-[45px] mb-4 shadow-xl rounded-lg px-3 py-2 text-center focus:outline-none focus:ring-2 focus:ring-indigo-500 border-2 border-blue-500">
                    User
                </button>

                <!-- Service Provider Button -->
                <button type="submit" name="user_type" value="Service Provider"
                    class="w-full h-[45px] shadow-xl rounded-lg px-3 py-2 text-center focus:outline-none focus:ring-2 focus:ring-indigo-500 border-2 border-blue-500">
                    Service Provider
                </button>
            </form>
        </div>
    </div>
</body>

</html>