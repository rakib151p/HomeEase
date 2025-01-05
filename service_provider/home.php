<?php require_once "controllerProviderData.php";
 ?><?php 
$email = $_SESSION['email'];
$password = $_SESSION['password'];
if($email != false && $password != false){
    $sql = "SELECT * FROM usertable WHERE email = '$email'";
    $run_Sql = mysqli_query($con, $sql);
    if($run_Sql){
        $fetch_info = mysqli_fetch_assoc($run_Sql);
        $status = $fetch_info['status'];
        $code = $fetch_info['code'];
        if($status == "verified"){
            if($code != 0){
                header('Location: reset-code.php');
            }
        }else{
            header('Location: user-otp.php');
        }
    }
}else{
    header('Location: login-provider.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $fetch_info['name'] ?> | Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-poppins">
    <nav class="bg-indigo-600 px-24 py-4">
        <a class="text-white text-3xl font-medium" href="#">HomeEase</a>
        <button class="bg-white text-indigo-600 font-medium py-2 px-4 rounded ml-4 hover:bg-indigo-100">
            <a href="logout-user.php" class="no-underline">Logout</a>
        </button>
    </nav>

    <h1 class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-4xl font-bold text-indigo-600">
        Welcome <?php echo $fetch_info['name'] ?>
    </h1>
</body>
</html>
