<?php
session_start();
include_once "includes/dbh.php";

if (isset($_POST['update'])) {
    $id = $_SESSION['patient_id'];
    $full_name = $_POST['full-name'];
    $contact_number = $_POST['contact-number'];
    $email_address = $_POST['email-address'];
    $password = $_POST['password'];
    $address_line_1 = $_POST['address-line-1'];
    $address_line_2 = $_POST['address-line-2'];
    $zip_code = $_POST['zip-code'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $country = $_POST['country'];

    $update_sql_query = "UPDATE patient SET Email_address = '$email_address', Password = '$password', Full_name = '$full_name', Contact_number = '$contact_number', Address_line_1 = '$address_line_1', Address_line_2 = '$address_line_2', Zip_code = '$zip_code', City = '$city', State = '$state', Country = '$country' WHERE Patient_ID = '$id'";

    $update_result = mysqli_query($conn, $update_sql_query);
    if (mysqli_affected_rows($conn) >= 1) {
        $_SESSION['message'] = "Profile Updated Successfully";
        $_SESSION['update'] = true;
        $_SESSION['admin_email'] = $email_address;
    }
    if ($update_result == false) {
        $_SESSION['message'] = "Failed to Update Profile";
        $_SESSION['update'] = false;
    }
    header("Location: profile.php?update=success");
}