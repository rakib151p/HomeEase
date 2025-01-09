<?php
session_start();
include 'config.php';
$email = "";
$name = "";
$errors = array();
// $errors['login-error']='';
if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $check_email = "SELECT * FROM service_provider WHERE provider_email = '$email'";
    $check_email_user = "SELECT * FROM user WHERE user_email = '$email'";
    $res1 = mysqli_query($con, $check_email);
    $res2 = mysqli_query($con, $check_email_user);
    if (mysqli_num_rows($res1) > 0) {
        $fetch = mysqli_fetch_assoc($res1);
        $fetch_pass = $fetch['provider_password'];
        if (password_verify($password, $fetch_pass)) {
            $_SESSION['email'] = $email;
            $status = $fetch['provider_status'];
            if ($status == 'verified') {
                $_SESSION['email'] = $email;
                header('location: home.php');
                exit();
            } else {
                $info = "It looks like you haven't verified your email - $email";
                $_SESSION['info'] = $info;
                header('location: service_provider/provider-otp.php');
            }
        } else {
            $errors['login-error'] = "Incorrect email or password!";
        }
    } else if(mysqli_num_rows($res2) > 0){
        $fetch = mysqli_fetch_assoc($res2);
        $fetch_pass = $fetch['user_password'];
        if (password_verify($password, $fetch_pass)) {
            $_SESSION['email'] = $email;
            $status = $fetch['user_status'];
            if ($status == 'verified') {
                $_SESSION['email'] = $email;
                header('location: home.php');
                exit();
                // echo 'You are logged in';
            } else {
                $info = "It looks like you haven't verified your email - $email";
                $_SESSION['info'] = $info;
                header('location: user_signup_login/user-otp.php');
            }
        } else {
            $errors['login-error'] = "Incorrect email or password!";
        }    
    }else{
        $errors['login-error'] = "You are not yet a member! Click the signup link below.";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-bl from-blue-200  via-slate-100 via-blue-200 to-slate-300 font-sans">
    <div class="flex items-center justify-center min-h-screen">
        <div
            class="bg-white p-8 rounded-lg shadow-xl w-full max-w-sm bg-gradient-to-bl from-blue-100 via-slate-100 via-slate-100 to-blue-100 border-2 border-blue-200">
            <form action="login.php" method="POST" autocomplete="">
                <div class="flex gap-2">
                    <div>
                        <button
                            class="bg-white text-center h-10 w-10 rounded-2xl  relative right-4  text-black text-xl font-semibold group"
                            type="button">
                            <a href="home.php">
                                <div
                                    class="bg-blue-400 rounded-xl h-10 w-10 flex items-center justify-center absolute  top-[4px] ">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1024 1024" height="25px"
                                        width="25px">
                                        <path d="M224 480h640a32 32 0 1 1 0 64H224a32 32 0 0 1 0-64z" fill="#000000">
                                        </path>
                                        <path
                                            d="m237.248 512 265.408 265.344a32 32 0 0 1-45.312 45.312l-288-288a32 32 0 0 1 0-45.312l288-288a32 32 0 1 1 45.312 45.312L237.248 512z"
                                            fill="#000000"></path>
                                    </svg>
                                </div>
                            </a>
                        </button>
                    </div>
                    <div>
                        <h2 class="text-center text-3xl font-bold text-gray-800 mb-2">Login Form</h2>
                        <p class="text-center text-sm text-gray-600 mb-6">Login with your email and password.</p>
                    </div>

                </div>
                <?php if (count($errors) > 0): ?>
                    <div class="bg-red-100 text-red-700 p-3 rounded mb-4 text-center">
                        <?php foreach ($errors as $showerror): ?>
                            <p><?php echo $showerror; ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <div class="mb-4">
                    <input
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        type="email" name="email" placeholder="Email Address" required value="<?php echo $email; ?>">
                </div>
                <div class="mb-4">
                    <input
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        type="password" name="password" placeholder="Password" required>
                </div>
                <div class="text-left mb-4">
                    <a href="forgot-password.php" class="text-sm text-indigo-600 hover:underline">Forgot password?</a>
                </div>
                <div class="mb-4">
                    <button
                        class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition duration-200"
                        type="submit" name="login">
                        Login
                    </button>
                </div>
                <div class="text-center text-sm text-gray-600">
                    Not yet a member?
                    <a href="signup.php" class="text-indigo-600 hover:underline">Signup now</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>