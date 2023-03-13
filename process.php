<?php
session_start();

// Checking if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate form inputs
    if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['password'])) {
        echo 'Please fill out all fields.';
        exit;
    }

    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        echo 'Please enter a valid email address.';
        exit;
    }

    // Save profile image to server
    $uploads_dir = './';
    $file_name = uniqid() . '-' . $_FILES['profile_pic']['name'];
    $file_tmp_name = $_FILES['profile_pic']['tmp_name'];
    move_uploaded_file($file_tmp_name, $uploads_dir . $file_name);

    // Save user details to CSV file
    $user_data = [$_POST['name'], $_POST['email'], $file_name];
    $file = fopen('users.csv', 'a');
    fputcsv($file, $user_data);
    fclose($file);

    // Set session and cookie
    $_SESSION['name'] = $_POST['name'];
    setcookie('name', $_POST['name'], time() + (86400 * 1), '/'); // cookie expires in 1 days

    // Redirect to Dashboard 
    header('Location: dashboard.php');
    exit;
}
