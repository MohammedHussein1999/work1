<?php


$fnameErr = $lnameErr = $phoneErr = $emailErr = $addressErr = ""; // تعريف المتغيرات وتهيئتها بقيم افتراضية
$fname = $lname = $email = $phone = $address = ""; // تهيئة المتغيرات الأخرى

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "customers";

// Create connection
$connection = new mysqli($servername, $username, $password, $dbname);
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
?>


<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <style rel="stylesheet">
    body {
        background-color: #333;
        color: #fff;
        font-family: Arial, sans-serif;
    }

    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }
    .log{
        text-align: center;

        a{
            text-decoration: auto;
            color: white;
        }
    }

    .form-container {
        background-color: #444;
        padding: 20px;
        border-radius: 8px;
        text-align: center;
    }

    .form-container h2 {
        margin-bottom: 20px;
    }

    .form-container input[type="text"],
    .form-container input[type="email"],
    .form-container input[type="password"] {
        width: 90%;
        padding: 10px;
        margin: 10px 0;
        border: none;
        border-radius: 4px;
    }

    .form-container button {
        width: 90%;
        padding: 10px;
        margin-top: 10px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        background-color: green;
        color: #fff;
        font-size: 16px;
    }

    .form-container button:hover {
        background-color: #0a850a;
    }
    .log {
    margin-top: 70px;
}
     form .log {
        border-style:none;
        color:#fff;
    }
    .err {color: red;}
    </style>
</head>
<body>

<?php
// Define variables and initialize them
$fnameErr = $lnameErr = $phoneErr = $carPlateErr = "";
$fname = $lname = $email = $phone = $address = "";

// Function to sanitize input data
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
<div class="log">
<a href="./index.php">LogIn</a>
</div>
    <div class="container">
        
        <form id="registerForm" class="form-container" method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <h2>Register User</h2>
            <p><span class="err">* required </span></p>
            
            <input type="text" placeholder="First name" name="fname" value="<?php echo $fname;?>" required>
            <span class="err">* <?php echo $fnameErr;?></span>
            
            <input type="text" placeholder="Last name" name="lname" value="<?php echo $lname;?>" required>
            <span class="err">* <?php echo $lnameErr;?></span>
            
            <input type="text" placeholder="Phone" name="phone" value="<?php echo $phone;?>" required>
            <span class="err">* <?php echo $phoneErr;?></span>
            
            <input type="text" placeholder="Email" name="email" value="<?php echo $email;?>" required>
            <span class="err">* <?php echo $emailErr;?></span>
            
            <input type="text" placeholder="Address" name="address" value="<?php echo $address;?>" required>
            <span class="err">* <?php echo $addressErr;?></span>
            
            <button type="submit" name="add">Register</button>
           
        </form>
    </div>
    
    
<?php
// Add data to database
if(isset($_POST['add'])){
    $fname = test_input($_POST['fname']);
    $lname = test_input($_POST['lname']);
    $phone = test_input($_POST['phone']);
    $email = test_input($_POST['email']);
    $address = test_input($_POST['address']);

    // Check if record already exists
    $result = mysqli_query($connection, 'SELECT * FROM customers WHERE first_name ="'.$fname.'" AND phone ="'.$phone.'" ');
    if (mysqli_num_rows($result) == 1){
       echo '<div style="position: fixed; top: 0; left: 0; width: 100%; background-color: #eee; color: red; padding: 6px; text-align: center;">Already Register</div>';
    } else {
        // Insert data if record does not exist
        $sql = "INSERT INTO customers (first_name, last_name, email, phone, address) VALUES ('$fname', '$lname', '$email', '$phone', '$address')";
        mysqli_query($connection, $sql);
        echo '<div style="position: fixed; top: 0; left: 0; width: 100%; background-color: #eee; color: green; padding: 6px; text-align: center;">Register Successfully</div>';
    }
}
?>

</body>
</html>
