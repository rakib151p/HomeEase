<?php require_once "controllerProviderData.php";
 ?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-bl from-blue-200  via-slate-100 via-blue-200 to-slate-300 font-sans">
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white p-8 rounded-lg shadow-xl w-full max-w-sm bg-gradient-to-bl from-blue-100 via-slate-100 via-slate-100 to-blue-100 border-2 border-blue-200">
            <form action="forgot-password.php" method="POST" autocomplete="">
                <h2 class="text-center text-2xl font-bold text-gray-800">Forgot Password</h2>
                <p class="text-center text-sm text-gray-600 mb-4">Enter your email address</p>
                <?php if (count($errors) > 0): ?>
                    <div class="bg-red-100 text-red-700 p-3 rounded mb-4 text-center">
                        <?php foreach ($errors as $error): ?>
                            <p><?php echo $error; ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <div class="mb-4">
                    <input
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        type="email"
                        name="email"
                        placeholder="Enter email address"
                        required
                        value="<?php echo $email; ?>">
                </div>
                <div>
                    <button
                        class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition duration-200"
                        type="submit"
                        name="check-email">
                        Continue
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>