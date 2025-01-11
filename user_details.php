<?php
if (isset($_SESSION['email'])) {
    $email = mysqli_real_escape_string($con, $_SESSION['email']);
    
    $check_email = "SELECT * FROM service_provider WHERE provider_email = '$email'";
    $check_email_user = "SELECT * FROM user WHERE user_email = '$email'";
    $res1 = mysqli_query($con, $check_email);
    $res2 = mysqli_query($con, $check_email_user);
    $_SESSION['type'] = '';
    if (mysqli_num_rows($res1) > 0) {
        $_SESSION['type'] = 'provider';
        $fetch = mysqli_fetch_assoc($res1);
        $_SESSION['provider_id']=$fetch['provider_id'];
        $_SESSION['provider_name'] = $fetch['provider_name'];
        $_SESSION['provider_email'] = $fetch['provider_email'];
        $_SESSION['provider_password'] = $fetch['provider_password'];
        $_SESSION['provider_code'] = $fetch['provider_code'];
        $_SESSION['provider_status'] = $fetch['provider_status'];
        $_SESSION['provider_address'] = $fetch['provider_address'];
        $_SESSION['provider_registration_date'] = $fetch['provider_registration_date'];
        $_SESSION['provider_experience'] = $fetch['provider_experience'];
        $_SESSION['provider_about'] = $fetch['provider_about'];
        $_SESSION['provider_rating'] = $fetch['provider_rating'];
        $_SESSION['provider_phone'] = $fetch['provider_phone'];
        $_SESSION['provider_gender'] = $fetch['provider_gender'];
        $_SESSION['provider_profile_picture'] = $fetch['provider_profile_picture'];
        $_SESSION['provider_verified'] = $fetch['provider_verified'];
    } else if (mysqli_num_rows($res2) > 0) {
        $_SESSION['type'] = 'user';
        $fetch = mysqli_fetch_assoc($res2);
        $_SESSION['user_id']=$fetch['user_id'];
        $_SESSION['user_name'] = $fetch['user_name'];
        $_SESSION['user_phone'] = $fetch['user_phone'];
        $_SESSION['user_address'] = $fetch['user_address'];
        $_SESSION['user_gender'] = $fetch['user_gender'];
        $_SESSION['user_registration_date'] = $fetch['user_registration_date'];
        $_SESSION['user_district'] = $fetch['user_district'];
        $_SESSION['user_upazila'] = $fetch['user_upazila'];
        $_SESSION['user_area'] = $fetch['user_area'];
    } else {
        $errors['login-error'] = "You are not yet a member! Click the signup link below.";
    }
}
