<?php
session_start();
require "connection.php";
require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$email = "";
$name = "";
$errors = array();

// Function to send email using PHPMailer
function sendMail($to, $subject, $message) {
    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Use Gmail's SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'tarekrahamn01@gmail.com'; // Your Gmail address
        $mail->Password = 'frqgcdbfpamqjezr'; // Your Gmail password or app password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('tarekrahamn01@gmail.com', 'HomeEase');
        $mail->addAddress($to);

        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $message;

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

// If user signup button is clicked
if (isset($_POST['signup'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
    $phone_number =mysqli_real_escape_string($con, $_POST['phone_number']);


    if ($password !== $cpassword) {
        $errors['password'] = "Confirm password does not match!";
    }
    $email_check = "SELECT * FROM service_provider WHERE provider_email = '$email'";
    $res = mysqli_query($con, $email_check);
    if (mysqli_num_rows($res) > 0) {
        $errors['email'] = "The email you entered already exists!";
    }
    if (count($errors) === 0) {
        $encpass = password_hash($password, PASSWORD_BCRYPT);
        $code = rand(999999, 111111);
        $status = "notverified";
        $registration_date = date("Y-m-d H:i:s");
        $insert_data = "INSERT INTO service_provider (provider_name, provider_email, provider_phone, provider_password, provider_code, provider_status) 
                        VALUES ('$name', '$email', '$phone_number', '$encpass', '$code', '$status')";
        $data_check = mysqli_query($con, $insert_data);
        if ($data_check) {
            $subject = "Email Verification Code";
            $message = "Your verification code is $code";
            if (sendMail($email, $subject, $message)) {
                $info = "We've sent a verification code to your email - $email";
                $_SESSION['info'] = $info;
                $_SESSION['email'] = $email;
                header('location: service_provider/provider-otp.php');
                exit();
            } else {
                $errors['otp-error'] = "Failed while sending code!";
            }
        } else {
            $errors['db-error'] = "Failed to insert data into the database!";
        }
    }
}

// If provider click verification code submit button
if (isset($_POST['check'])) {
    $_SESSION['info'] = "";
    $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
    $check_code = "SELECT * FROM service_provider WHERE provider_code = $otp_code";
    $code_res = mysqli_query($con, $check_code);
    if (mysqli_num_rows($code_res) > 0) {
        $fetch_data = mysqli_fetch_assoc($code_res);
        $fetch_code = $fetch_data['provider_code'];
        $email = $fetch_data['provider_email'];
        $code = 0;
        $status = 'verified';
        $update_otp = "UPDATE service_provider SET provider_code = $code, provider_status = '$status' WHERE provider_code = $fetch_code";
        $update_res = mysqli_query($con, $update_otp);
        if ($update_res) {
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email;
            header('location: home.php');
            exit();
        } else {
            $errors['otp-error'] = "Failed while updating code!";
        }
    } else {
        $errors['otp-error'] = "You've entered incorrect code!";
    }
}

// If user click login button
if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $check_email = "SELECT * FROM service_provider WHERE provider_email = '$email'";
    $res = mysqli_query($con, $check_email);
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
    } else {
        $errors['login-error'] = "You are not yet a member! Click the signup link below.";
    }
}

// If user click continue button in forgot password form
if (isset($_POST['check-email'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $check_email = "SELECT * FROM service_provider WHERE provider_email='$email' union SELECT * FROM user WHERE user_email='$email'";
    $run_sql = mysqli_query($con, $check_email);
    if (mysqli_num_rows($run_sql) > 0) {
        $code = rand(999999, 111111);
        $insert_code = "UPDATE service_provider SET provider_code = $code WHERE provider_email = '$email'";
        $run_query = mysqli_query($con, $insert_code);
        if ($run_query) {
            $subject = "Password Reset Code";
            $message = "Your password reset code is $code";
            if (sendMail($email, $subject, $message)) {
                $info = "We've sent a password reset OTP to your email - $email";
                $_SESSION['info'] = $info;
                $_SESSION['email'] = $email;
                header('location: service_provider/reset-code.php');
                exit();
            } else {
                $errors['otp-error'] = "Failed while sending code!";
            }
        } else {
            $errors['db-error'] = "Something went wrong!";
        }
    } else {
        $errors['email'] = "This email address does not exist!";
    }
}

// If user click check reset otp button
if (isset($_POST['check-reset-otp'])) {
    $_SESSION['info'] = "";
    $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
    $check_code = "SELECT * FROM service_provider WHERE provider_code = $otp_code";
    $code_res = mysqli_query($con, $check_code);
    if (mysqli_num_rows($code_res) > 0) {
        $fetch_data = mysqli_fetch_assoc($code_res);
        $email = $fetch_data['provider_email'];
        $_SESSION['email'] = $email;
        $info = "Please create a new password that you don't use on any other site.";
        $_SESSION['info'] = $info;
        header('location: service_provider/new-password.php');
        exit();
    } else {
        $errors['otp-error'] = "You've entered incorrect code!";
    }
}

// If user click change password button
if (isset($_POST['change-password'])) {
    $_SESSION['info'] = "";
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
    if ($password !== $cpassword) {
        $errors['password'] = "Confirm password not matched!";
    } else {
        $code = 0;
        $email = $_SESSION['email']; // Getting this email using session
        $encpass = password_hash($password, PASSWORD_BCRYPT);
        $update_pass = "UPDATE service_provider SET provider_code = $code, provider_password = '$encpass' WHERE provider_email = '$email'";
        $run_query = mysqli_query($con, $update_pass);
        if ($run_query) {
            $info = "Your password changed. Now you can log in with your new password.";
            $_SESSION['info'] = $info;
            header('Location: service_provider/password-changed.php');
        } else {
            $errors['db-error'] = "Failed to change your password!";
        }
    }
}

// If login now button is clicked
if (isset($_POST['login-now'])) {
    header('Location: login.php');
}
?>
