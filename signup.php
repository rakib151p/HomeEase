<?php
include 'config.php';
$email = "";
$name = "";
$errors = array();
$temp = 0;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $temp++;
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $check_email = "SELECT provider_email FROM service_provider WHERE provider_email='$email' union SELECT user_email FROM user WHERE user_email='$email'";
    // $check_email1 = "SELECT * FROM user WHERE user_email='$email'";
    $run_sql = mysqli_query($con, $check_email);
    if (mysqli_num_rows($run_sql) === 0) {
        if (isset($_POST['user_type'])) {
            $userType = $_POST['user_type'];
            if ($userType === 'User') {
                require_once "user_signup_login/controllerUserData.php";
            } elseif ($userType === 'Service Provider') {
                require_once "service_provider/controllerProviderData.php";
                // require_once "user_signup_login/controllerUserData.php";
            }
        }
    }else{
        $errors['signup-error']="The email already exist";
    }
}
if ($temp === 0)
    require_once "user_signup_login/controllerUserData.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title class="">Signup Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-bl from-blue-200  via-slate-100 via-blue-200 to-slate-300 font-sans">
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white p-8 rounded-lg shadow-xl w-full max-w-sm bg-gradient-to-bl from-blue-100 via-slate-100 via-slate-100 to-blue-100 border-2 border-blue-200">
            <form action="signup.php" method="POST" autocomplete="">
                <div class="flex gap-5">
                    <div>
                        <button
                            class="bg-white text-center h-10 w-10 rounded-2xl  relative right-4 text-black text-xl font-semibold group"
                            type="button">
                            <a href="login.php">
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
                            </a>
                        </button>
                    </div>
                    <div>
                        <h2 class="text-center text-3xl font-bold text-gray-800 mb-2">Signup Form</h2>
                        <p class="text-center text-sm text-gray-600 mb-6">Get Started with HomeEase</p>
                    </div>

                </div>

                <?php if (count($errors) == 1): ?>
                    <div class="bg-red-100 text-red-700 p-2 rounded mb-4 text-center">
                        <?php foreach ($errors as $showerror): echo $showerror;
                        endforeach; ?>
                    </div>
                <?php elseif (count($errors) > 1): ?>
                    <div class="bg-red-100 text-red-700 p-2 rounded mb-4">
                        <ul class="list-disc pl-5">
                            <?php foreach ($errors as $showerror): ?>
                                <li><?php echo $showerror; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <div class="mb-4">
                    <input
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        type="text"
                        name="name"
                        placeholder="Full Name"
                        required
                        value="<?php echo $name; ?>">
                </div>
                <div class="mb-4">
                    <input
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        type="email"
                        name="email"
                        placeholder="Email Address"
                        required
                        value="<?php echo $email; ?>">
                </div>
                <div class="mb-4">
                    <input
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        type="password"
                        name="password"
                        placeholder="Password"
                        required>
                </div>
                <div class="mb-4">
                    <input
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        type="password"
                        name="cpassword"
                        placeholder="Confirm Password"
                        required>
                </div>
                <div class="mb-4 flex">
                    <div class="w-[80px] h-[45px]  rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500    border-2 border-blue-200">
                        +880
                    </div>
                    <input
                        class="w-[250px] ml-[10px] border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        type="text"
                        name="phone_number"
                        placeholder="Write Your Number"
                        required>
                </div>
                <div class="mb-4">
                    <?php
                    // require_once "config.php";
                    // if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    //     if (isset($_POST['user_type'])) {
                    //         $userType = $_POST['user_type'];
                    //         if ($userType === 'User') {
                    //             // header("Location: user_signup_login/signup-user.php");
                    //             // exit();
                    //             echo "check";
                    //         } elseif ($userType === 'Service Provider') {
                    //             // header("Location:service_provider/signup-service-provider.php");
                    //             // exit();
                    //             echo 'provider';
                    //         }
                    //     }
                    // }
                    ?>
                    <label class="block text-gray-700 font-medium mb-2">Select Your UserType:</label>
                    <div class="space-x-4 flex">
                        <input type="hidden" name="user_type" id="user_type" value="" required>
                        <div id="button1" class="cursor-pointer button h-[40px] w-[300px] border-2 border-blue-500 text-gray-800 py-1 rounded-lg text-center">
                            User
                        </div>
                        <div id="button2" class="cursor-pointer button h-[40px] w-[300px] border-2 border-blue-500 text-gray-800 py-1 rounded-lg text-center">
                            Service Provider
                        </div>
                    </div>

                    <script>
                        const buttons = document.querySelectorAll('.button');
                        const userTypeInput = document.getElementById('user_type');

                        buttons.forEach(button => {
                            button.addEventListener('click', () => {
                                // Reset all buttons to default styles
                                buttons.forEach(btn => {
                                    btn.classList.remove('bg-blue-200', 'border-blue-700');
                                    btn.classList.add('bg-white-100', 'border-black');
                                });

                                // Apply active styles to the clicked button
                                button.classList.add('bg-blue-200', 'border-blue-700');
                                button.classList.remove('bg-white-100', 'border-black');

                                // Set the hidden input value based on the selected button
                                userTypeInput.value = button.id === 'button1' ? 'User' : 'Service Provider';
                            });
                        });

                        // Validate user type selection on form submission
                        document.querySelector('form').addEventListener('submit', (event) => {
                            if (!userTypeInput.value) {
                                event.preventDefault();
                                alert('Please select a user type before submitting.');
                            }
                        });
                    </script>
                </div>
                <div class="mb-4">
                    <button
                        class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition duration-200"
                        type="submit"
                        name="signup">
                        Signup
                    </button>
                </div>
                <div class="text-center text-sm text-gray-600">
                    Already a member?
                    <a href="login.php" class="text-indigo-600 hover:underline">Login here</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>