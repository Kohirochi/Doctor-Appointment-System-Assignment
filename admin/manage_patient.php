<?php
session_start();
include_once "../includes/dbh.php";
if (isset($_POST['update']) || (isset($_POST['add']))) {
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

    if (isset($_POST['update'])) {
        $id = $_SESSION['get_patient_id'];
        $sql_query = "UPDATE patient SET Email_address = '$email_address', Password = '$password', Full_name = '$full_name', Contact_number = '$contact_number', Address_line_1 = '$address_line_1', Address_line_2 = '$address_line_2', Zip_code = '$zip_code', City = '$city', State = '$state', Country = '$country' WHERE Patient_ID = '$id'";
        $result = mysqli_query($conn, $sql_query);
        if (mysqli_affected_rows($conn) >= 1) {
            $_SESSION['update'] = true;
            $_SESSION['message'] = "Record Updated Successfully";
        }
        if ($result == false) {
            $_SESSION['update'] = false;
            $_SESSION['message'] = "Failed to Update Record";
        }
        unset($_SESSION['get_patient_id']);
    }

    if (isset($_POST['add'])) {
        $sql_query = "INSERT INTO patient (Email_address, Password, Full_name, Contact_number, Address_line_1, Address_line_2, Zip_code, City, State, Country, Admin_ID) VALUES ('$email_address', '$password', '$full_name', '$contact_number', '$address_line_1', '$address_line_2', '$zip_code', '$city', '$state', '$country', 1)";
        $result = mysqli_query($conn, $sql_query);
        if (mysqli_affected_rows($conn) >= 1) {
            $_SESSION['add'] = true;
            $_SESSION['message'] = "Record Added Successfully";
        }
        if ($result == false) {
            $_SESSION['add'] = false;
            $_SESSION['message'] = "Failed to Add Record";
        }
    }

    mysqli_close($conn);

    header("Location: admin_patients.php");
}