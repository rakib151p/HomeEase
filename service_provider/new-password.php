<?php require_once "controllerProviderData.php";
 ?><?php 
$email = $_SESSION['email'];
if($email == false){
  header('Location: login-provider.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create a New Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-50 font-poppins h-screen">
    <div class="flex items-center justify-center h-full">
        <div class="bg-white p-8 rounded-md shadow-lg w-full max-w-sm">
            <form action="new-password.php" method="POST" autocomplete="off">
                <h2 class="text-2xl font-bold text-center text-gray-700 mb-6">New Password</h2>

                <?php if(isset($_SESSION['info'])): ?>
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4 text-center">
                        <?php echo $_SESSION['info']; ?>
                    </div>
                <?php endif; ?>
                
                <?php if(count($errors) > 0): ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4 text-center">
                        <?php foreach($errors as $showerror): ?>
                            <p><?php echo $showerror; ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <div class="mb-4">
                    <input 
                        type="password" 
                        name="password" 
                        placeholder="Create new password" 
                        required 
                        class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent"
                    >
                </div>
                <div class="mb-4">
                    <input 
                        type="password" 
                        name="cpassword" 
                        placeholder="Confirm your password" 
                        required 
                        class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent"
                    >
                </div>
                <div>
                    <button 
                        type="submit" 
                        name="change-password" 
                        class="w-full py-2 bg-indigo-600 text-white font-medium rounded hover:bg-indigo-700 transition duration-200"
                    >
                        Change
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
