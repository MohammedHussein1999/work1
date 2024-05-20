<!DOCTYPE HTML> 
<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "customers";

// Establishing database connection
$connection = new mysqli($servername, $username, $password, $dbname);
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Query to select all messages
$sql = "SELECT * FROM messages";
$result = $connection->query($sql);
?>

<html>
<head>
    <style>
        .err {color: red;}
    </style>
</head>
<body>  

<?php
// Define variables and initialize them
$fnameErr = $lnameErr = $emailErr = $subjectErr = "";
$fname = $lname = $email = $subject = $message = "";

// Form validation
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate first name
    if (empty($_POST["fname"])) {
        $fnameErr = "First name is required";
    } else {
        $fname = test_input($_POST["fname"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/",$fname)) {
            $fnameErr = "Only letters and space allowed";
        }
    }

    // Validate last name
    if (empty($_POST["lname"])) {
        $lnameErr = "Last name is required";
    } else {
        $lname = test_input($_POST["lname"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/",$lname)) {
            $lnameErr = "Only letters and space allowed";
        }
    }

    // Validate email
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Enter a valid email ";
        }
    }

    // Validate subject
    if (empty($_POST["subject"])) {
        $subjectErr = "Subject is required";
    } else {
        $subject = test_input($_POST["subject"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/",$subject)) {
            $subjectErr = "Only letters and space allowed";
        }
    }

    // Validate message
    if (empty($_POST["message"])) {
        $message = "";
    } else {
        $message = test_input($_POST["message"]);
    }
}

// Function to sanitize input data
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<h2>Update Message Form</h2>
<p><span class="err">* required </span></p>

<?php 
// Display form for each message
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $fname = $row['fname'];
        $lname = $row['lname'];
        $email = $row['email'];
        $subject = $row['subject'];
        $message = $row['message'];
?>
        <form method="post" action="editMessage.php">  
            First Name: <input type="text" name="fname" value="<?php echo $fname;?>">
            <span class="err">* <?php echo $fnameErr;?></span>
            <br><br>
            Last Name: <input type="text" name="lname" value="<?php echo $lname;?>">
            <span class="err">* <?php echo $lnameErr;?></span>
            <br><br>
            Email: <input type="text" name="email" value="<?php echo $email;?>">
            <span class="err">* <?php echo $emailErr;?></span>
            <br><br>
            Subject: <input type="text" name="subject" value="<?php echo $subject;?>">
            <span class="err">* <?php echo $subjectErr;?></span>
            <br><br>
            Message: <textarea name="message" rows="4" cols="42"><?php echo $message;?></textarea>
            <br><br>
            <input type="submit" name="edit" value="Edit">
            <input type="submit" name="delete" value="Delete"> 
        </form>
<?php
    }
} else {
    echo "No messages added, please enter new message ";
}
?>

</body>
</html>