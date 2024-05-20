<?php
// تضمين ملف الاتصال بقاعدة البيانات
include './db.php';

// معلومات الاتصال بقاعدة البيانات
$servername = "localhost"; // اسم المضيف
$username = "root"; // اسم المستخدم
$password = ""; // كلمة المرور
$dbname = "customers"; // اسم قاعدة البيانات

// إنشاء الاتصال بقاعدة البيانات
$connect = mysqli_connect($servername, $username, $password, $dbname);

// التحقق من نجاح الاتصال
if (!$connect) {
    die("فشل الاتصال بقاعدة البيانات: " . mysqli_connect_error());
}

// استعلام للتحقق من وجود الجدول
$tableCheckQuery = "SHOW TABLES LIKE 'customers'";
$tableCheckResult = mysqli_query($connect, $tableCheckQuery);


if (isset($_POST['id']) && !empty($_POST['id']) && !empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['email'])) {
    $id = $_POST['id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'] ?? ''; // قد تكون خالية في بعض الحالات
    $address = $_POST['address'] ?? ''; // قد تكون خالية في بعض الحالات

    // تنفيذ SQL UPDATE statement لتحديث السجل في قاعدة البيانات
    $sql = "UPDATE customers SET first_name = '$first_name', last_name = '$last_name', email = '$email', phone = '$phone', address = '$address' WHERE id = $id";

    // تنفيذ الاستعلام
    $result = mysqli_query($connection, $sql);

    // التحقق من نجاح التحديث
    if ($result) {
        echo "success"; // إرسال استجابة ناجحة
    } else {
        echo "error"; // إرسال استجابة خطأ
    }
} else {
    // في حالة عدم استلام جميع البيانات المطلوبة من الطلب
    echo "error"; // إرسال استجابة خطأ
}

// إغلاق اتصال قاعدة البيانات
mysqli_close($connect);


?>
