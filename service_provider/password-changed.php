<?php require_once "controllerProviderData.php";
 ?><?php
if ($_SESSION['info'] == false) {
    header('Location: login-user.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class=" bg-gradient-to-bl from-blue-200  via-slate-100 via-blue-200 to-slate-300 font-poppins">
    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
        <div class="bg-white p-8 rounded-lg shadow-lg w-96">
            <?php
            if (isset($_SESSION['info'])) {
            ?>
                <div class="bg-green-100 text-green-800 text-center p-3 rounded-md mb-4">
                    <?php echo $_SESSION['info']; ?>
                </div>
            <?php
            }
            ?>
            <form action="login-provider.php" method="POST">
                <div class="mb-4">
                    <input class="w-full h-10 px-4 border border-gray-300 rounded-md text-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" type="submit" name="login-now" value="Login Now">
                </div>
            </form>
        </div>
    </div>
</body>

</html>