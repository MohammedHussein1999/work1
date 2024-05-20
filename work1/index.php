<?php
include "messages.php";

// افتح الاتصال بقاعدة البيانات
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "customers";

$connection = new mysqli($servername, $username, $password, $dbname);

// التحقق من التوصيل
if ($connection->connect_error) {
    die("فشل الاتصال بقاعدة البيانات: " . $connection->connect_error);
}

// تعريف متغيرات لتخزين بيانات العميل
$first_name = $last_name = $phone = $address = $email = "";

// التحقق من إرسال البيانات من النموذج
if(isset($_POST['phone'])) {
    $phone = $_POST['phone'];

    // استعلام SQL للبحث عن الرقم في قاعدة البيانات
    $sql = "SELECT * FROM customers WHERE phone = '$phone'";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        // إذا تم العثور على الرقم، استخراج البيانات وتخزينها في متغيرات PHP
        $row = $result->fetch_assoc();
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $phone = $row['phone'];
        $address = $row['address'];
        $email = $row['email'];
        
        // تخزين البيانات في localStorage
        echo "<script>
                localStorage.setItem('first_name', '" . $first_name . "');
                localStorage.setItem('last_name', '" . $last_name . "');
                localStorage.setItem('phone', '" . $phone . "');
                localStorage.setItem('address', '" . $address . "');
                localStorage.setItem('email', '" . $email . "');
              </script>";
              
        // التوجيه إلى الصفحة "mmmm" بعد التحقق من البيانات
        echo "<script>window.location.href = './OneMinuteParking/html.html';</script>";
    } else {
        // إذا لم يتم العثور على الرقم، عرض رسالة الخطأ
        $errorMessage = "الرقم غير مسجل في قاعدة البيانات";
    }
}

// إغلاق اتصال قاعدة البيانات
$connection->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
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

        .form-container {
            background-color: #444;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
        }

        .form-container h2 {
            margin-bottom: 20px;
        }

        .form-container input[type="text"] {
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
        }

        .reg {
            text-align: center;
        }

        .reg a {
            text-decoration: auto;
            color: white;
        }

        .form-container button:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>
<div class="reg">
    <a href="./Register.php">Register</a>
</div>
<div class="container">
    <form id="loginForm" class="form-container" method="post" action="">
        <h2>Login</h2>
        <input type="text" id="phone" placeholder="Phone number" name="phone" required>
        <input type="hidden" name="id" value="<?php echo $id; ?>"> <!-- حقل خفي لنقل معرف العميل -->
        <button type="submit" class="login-btn">Login</button>
        <?php
        // إذا كانت هناك رسالة خطأ، عرضها بتنسيق صحيح
        if (isset($errorMessage) && !empty($errorMessage)) {
            echo "<div style=color:red;>$errorMessage</div>";
        }
        ?>
    </form>
</div>
<!-- إضافة السكريبت لتحديث localStorage هنا -->
<script>
    var firstNameValue = localStorage.getItem("first_name");
    if (firstNameValue !== null) {
        document.getElementById("first_name").value = firstNameValue;
    }

    var lastNameValue = localStorage.getItem("last_name");
    if (lastNameValue !== null) {
        document.getElementById("last_name").value = lastNameValue;
    }

    var phoneValue = localStorage.getItem("phone");
    if (phoneValue !== null) {
        document.getElementById("phone").value = phoneValue;
    }

    var addressValue = localStorage.getItem("address");
    if (addressValue !== null) {
        document.getElementById("address").value = addressValue;
    }

    var emailValue = localStorage.getItem("email");
    if (emailValue !== null) {
        document.getElementById("email").value = emailValue;
    }
</script>
</body>
</html>
