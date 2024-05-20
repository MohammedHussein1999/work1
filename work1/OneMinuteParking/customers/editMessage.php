<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "customers";

// Establishing database connection
$connect = new mysqli($servername, $username, $password, $dbname);
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

// Handle edit operation
if(isset($_POST['edit'])){
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    
    // Check if the message with the given email exists
    $results = mysqli_query($connect, 'SELECT * FROM messages WHERE email ="'.$email.'"');
    if (mysqli_num_rows($results) == 1){
        // Update the message
        $sql = "UPDATE messages SET fname='$fname', lname='$lname', subject='$subject', message='$message' WHERE email ='$email'";
        mysqli_query($connect, $sql);
        echo '<p style="color:green">Updated successfully</p>';
        header('location:updateMessage.php');
    } else {
        echo '<p style="color:red">Not found</p>';
        header('location:updateMessage.php');
    }
}  

// Handle delete operation
if(isset($_POST['delete'])){
    $email = $_POST['email'];
    // Check if the message with the given email exists
    $results = mysqli_query($connect, 'SELECT * FROM messages WHERE email ="'.$email.'"');
    if (mysqli_num_rows($results) == 1){
        // Delete the message
        $sql = "DELETE FROM messages WHERE email = '$email' ";
        if ($connect->query($sql) === TRUE) {
            echo '<p style="color:green">Deleted successfully</p>';
            header('location:updateMessage.php');
        } else {
            echo "Error deleting record: " . $connect->error;
            header('location:updateMessage.php');
        }
    } else {
        echo '<p style="color:red">Not found</p>';
        header('location:updateMessage.php');
    }
}
?>
