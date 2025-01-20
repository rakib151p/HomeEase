<?php
if (isset($_SESSION['email'])) {
    $email = mysqli_real_escape_string($con, $_SESSION['email']);

    $check_email = "SELECT * FROM service_provider WHERE provider_email = '$email'";
    $check_email_user = "SELECT * FROM user WHERE user_email = '$email'";
    $res1 = mysqli_query($con, $check_email);
    $res2 = mysqli_query($con, $check_email_user);
    $_SESSION['type'] = '';
    if (mysqli_num_rows($res1) > 0) {
        echo 'provider';
        $_SESSION['type'] = 'provider';
        $fetch = mysqli_fetch_assoc($res1);
        $_SESSION['provider_id'] = $fetch['provider_id'];
        $_SESSION['provider_name'] = $fetch['provider_name'];
        $_SESSION['provider_email'] = $fetch['provider_email'];
        $_SESSION['provider_password'] = $fetch['provider_password'];
        $_SESSION['provider_code'] = $fetch['provider_code'];
        $_SESSION['provider_status'] = $fetch['provider_status'];
        $_SESSION['provider_district'] = $fetch['provider_district'];
        $_SESSION['provider_upazila'] = $fetch['provider_upazila'];
        $_SESSION['provider_area'] = $fetch['provider_area'];
        $_SESSION['provider_street_address'] = $fetch['provider_street_address'];
        $_SESSION['provider_registration_date'] = $fetch['provider_registration_date'];
        $_SESSION['provider_experience'] = $fetch['provider_experience'];
        $_SESSION['provider_about'] = $fetch['provider_about'];
        $_SESSION['provider_rating'] = $fetch['provider_rating'];
        $_SESSION['provider_phone'] = $fetch['provider_phone'];
        $_SESSION['provider_gender'] = $fetch['provider_gender'];
        $_SESSION['provider_profile_picture'] = $fetch['provider_profile_picture'];
        $_SESSION['provider_verified'] = $fetch['provider_verified'];
        $_SESSION['provider_expertise'] = $fetch['provider_expertise'];
        $_SESSION['provider_servable'] = $fetch['provider_servable'];
        $_SESSION['provider_upazila'] = $fetch['provider_upazila'];
        $_SESSION['provider_area'] = $fetch['provider_area'];
        $_SESSION['provider_street_address'] = $fetch['provider_street_address'];
        $_SESSION['provider_availability']=$fetch['provider_availability'];
        $_SESSION['provider_availability_time_of_day']=$fetch['provider_availability_time_of_day'];
        $_SESSION['provider_price']=$fetch['provider_price'];
        
    } else if (mysqli_num_rows($res2) > 0) {
        echo 'user';
        $_SESSION['type'] = 'user';
        $fetch = mysqli_fetch_assoc($res2);
        $_SESSION['user_id'] = $fetch['user_id'];
        $_SESSION['user_name'] = $fetch['user_name'];
        $_SESSION['user_phone'] = $fetch['user_phone'];
        $_SESSION['user_email'] = $fetch['user_email'];
        $_SESSION['user_address'] = $fetch['user_address'];
        $_SESSION['user_gender'] = $fetch['user_gender'];
        $_SESSION['user_registration_date'] = $fetch['user_registration_date'];
        $_SESSION['user_district'] = $fetch['user_district'];
        $_SESSION['user_upazila'] = $fetch['user_upazila'];
        $_SESSION['user_area'] = $fetch['user_area'];
        $_SESSION['user_street_address'] = $fetch['user_street_address'];
        $_SESSION['user_unit_apt'] = $fetch['user_unit_apt'];
        // echo "<h2>User Session Details:</h2>";
        // echo "<p>User ID: " . $_SESSION['user_id'] . "</p>";
        // echo "<p>User Name: " . $_SESSION['user_name'] . "</p>";
        // echo "<p>User Phone: " . $_SESSION['user_phone'] . "</p>";
        // echo "<p>User Email: " . $_SESSION['user_email'] . "</p>";
        // echo "<p>User Address: " . $_SESSION['user_address'] . "</p>";
        // echo "<p>User Gender: " . $_SESSION['user_gender'] . "</p>";
        // echo "<p>Registration Date: " . $_SESSION['user_registration_date'] . "</p>";
        // echo "<p>User District: " . $_SESSION['user_district'] . "</p>";
        // echo "<p>User Upazila: " . $_SESSION['user_upazila'] . "</p>";
        // echo "<p>User Area: " . $_SESSION['user_area'] . "</p>";
    } else {
        $errors['login-error'] = "You are not yet a member! Click the signup link below.";
    }
}
