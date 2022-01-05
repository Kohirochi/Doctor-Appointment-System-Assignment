<?php
session_start();
include_once "../includes/dbh.php";
if (isset($_POST['update']) || (isset($_POST['add']))) {
    $full_name = $_POST['full-name'];
    $gender = $_POST['gender'];
    $contact_number = $_POST['contact-number'];
    $email_address = $_POST['email-address'];
    $password = $_POST['password'];
    $address_line_1 = $_POST['address-line-1'];
    $address_line_2 = $_POST['address-line-2'];
    $zip_code = $_POST['zip-code'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $country = $_POST['country'];
    $qualification = $_POST['qualification'];
    $specialty = $_POST['specialty'];
    $languages = $_POST['languages'];

    if (isset($_POST['update'])) {
        $id = $_SESSION['doctor_id'];
        if (empty($_FILES['image']['tmp_name']) || !is_uploaded_file($_FILES['image']['tmp_name'])) {
            $sql_query = "UPDATE doctor SET Email_address = '$email_address', Password = '$password', Full_name = '$full_name', Contact_number = '$contact_number', Gender = '$gender', Address_line_1 = '$address_line_1', Address_line_2 = '$address_line_2', Zip_code = '$zip_code', City = '$city', State = '$state', Country = '$country', Qualification = '$qualification', Specialty = '$specialty', Languages = '$languages' WHERE Doctor_ID = $id";
        } else {
            $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
            $sql_query = "UPDATE doctor SET Email_address = '$email_address', Password = '$password', Full_name = '$full_name', Contact_number = '$contact_number', Gender = '$gender', Address_line_1 = '$address_line_1', Address_line_2 = '$address_line_2', Zip_code = '$zip_code', City = '$city', State = '$state', Country = '$country', Qualification = '$qualification', Specialty = '$specialty', Languages = '$languages', Image = '$image' WHERE Doctor_ID = $id";
        }

        $result = mysqli_query($conn, $sql_query);
        if (mysqli_affected_rows($conn) >= 1) {
            $_SESSION['update'] = true;
            $_SESSION['message'] = "Record Updated Successfully";
        }
        if ($result == false) {
            $_SESSION['update'] = false;
            $_SESSION['message'] = "Failed to Update Record";
        }

        unset($_SESSION['doctor_id']);
    }

    if (isset($_POST['add'])) {
        $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
        $sql_query = "INSERT INTO doctor (Email_address, Password, Full_name, Gender, Contact_number, Address_line_1, Address_line_2, Zip_code, City, State, Country, Qualification, Specialty, Languages, Image, Admin_ID) VALUES ('$email_address', '$password', '$full_name', '$gender', '$contact_number', '$address_line_1', '$address_line_2', '$zip_code', '$city', '$state', '$country', '$qualification', '$specialty', '$languages', '$image', 1);";
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

    header("Location: admin_doctors.php");
}