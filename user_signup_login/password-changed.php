<?php require_once "controllerUserData.php"; ?>
<?php
if ($_SESSION['info'] == false) {
    header('Location: ../login.php');
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
            <div class="flex gap-2">
                <div>
                    <button
                        class="bg-white text-center h-10 w-10 rounded-2xl  relative right-4  text-black text-xl font-semibold group"
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
                    </button>
                </div>
            </div>



            <?php
            if (isset($_SESSION['info'])) {
            ?>
                <div class="bg-green-100 text-green-800 text-center p-3 rounded-md mb-4">
                    <?php echo $_SESSION['info']; ?>
                </div>
            <?php
            }
            ?>
            <form action="../login.php" method="POST">
                <div class="mb-4">

                   <a href="../login.php"><button class="w-full h-10 px-4 border border-gray-300 rounded-md text-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" type="submit" name="login-now" value="Login Now">Login now</button></a> 
                </div>
            </form>
        </div>
    </div>
</body>

</html>