<?php require_once "controllerUserData.php"; ?>
<?php
$email = $_SESSION['email'];
if ($email == false) {
    header('Location: login-user.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Code Verification</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-bl from-blue-200  via-slate-100 via-blue-200 to-slate-300 font-poppins h-screen">
    <div class="flex items-center justify-center h-full">
        <div class="bg-white p-8 rounded-md shadow-md w-full max-w-sm bg-gradient-to-bl from-blue-100 via-slate-100 via-slate-100 to-blue-100 border-2 border-blue-200">
            <form action="user-otp.php" method="POST" autocomplete="off">
                <div class="flex gap-2">

                    <div>
                        <a href="../login.php">
                            <button
                                class="bg-white text-center h-10 w-10 rounded-2xl  relative right-4 bottom-1 text-black text-xl font-semibold group"
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
                    </a>
                    <div>
                        <h2 class="text-2xl font-bold text-center text-gray-700 mb-6">Code Verification</h2>
                    </div>

                </div>


                <?php if (isset($_SESSION['info'])): ?>
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4 text-center">
                        <?php echo $_SESSION['info']; ?>
                    </div>
                <?php endif; ?>

                <?php if (count($errors) > 0): ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4 text-center">
                        <?php foreach ($errors as $showerror): ?>
                            <p><?php echo $showerror; ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <div class="mb-4">
                    <input
                        type="number"
                        name="otp"
                        placeholder="Enter verification code"
                        required
                        class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent">
                </div>
                <div>
                    <button
                        type="submit"
                        name="check"
                        class="w-full py-2 bg-indigo-600 text-white font-medium rounded hover:bg-indigo-700 transition duration-200">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>