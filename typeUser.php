<?php
if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $check_email = "SELECT * FROM service_provider WHERE provider_email = '$email'";
    $check_email_user = "SELECT * FROM user WHERE user_email = '$email'";
    $res1 = mysqli_query($con, $check_email);
    $res2 = mysqli_query($con, $check_email_user);
    if (mysqli_num_rows($res) > 0) {
        $fetch = mysqli_fetch_assoc($res);
        $fetch_pass = $fetch['provider_password'];
        if (password_verify($password, $fetch_pass)) {
            $_SESSION['email'] = $email;
            $status = $fetch['provider_status'];
            if ($status == 'verified') {
                $_SESSION['email'] = $email;
                header('location: home.php');
            } else {
                $info = "It looks like you haven't verified your email - $email";
                $_SESSION['info'] = $info;
                header('location: service_provider/provider-otp.php');
            }
        } else {
            $errors['login-error'] = "Incorrect email or password!";
        }
    } else if(mysqli_num_rows($res2) > 0){
        $fetch = mysqli_fetch_assoc($res);
        $fetch_pass = $fetch['user_password'];
        if (password_verify($password, $fetch_pass)) {
            $_SESSION['email'] = $email;
            $status = $fetch['user_status'];
            if ($status == 'verified') {
                $_SESSION['email'] = $email;
                header('location: home.php');
            } else {
                $info = "It looks like you haven't verified your email - $email";
                $_SESSION['info'] = $info;
                header('location: user_signup_login/provider-otp.php');
            }
        } else {
            $errors['login-error'] = "Incorrect email or password!";
        }    
    }else{
        $errors['login-error'] = "You are not yet a member! Click the signup link below.";
    }
}
?>
