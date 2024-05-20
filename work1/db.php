<?php
// معلومات الاتصال بقاعدة البيانات
$servername = "localhost";
$username = "root";
$password = "";

// إنشاء الاتصال
$conn = new mysqli($servername, $username, $password);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}

// التحقق من وجود قاعدة البيانات
$sql = "SHOW DATABASES LIKE 'customers'";
$result = $conn->query($sql);

// إذا لم يتم العثور على قاعدة البيانات، قم بإنشائها
if ($result->num_rows == 0) {
    $createDBSQL = "CREATE DATABASE customers";
    if ($conn->query($createDBSQL) === TRUE) {
        echo "تم إنشاء قاعدة البيانات بنجاح";
    } else {
        echo "خطأ في إنشاء قاعدة البيانات: " . $conn->error;
    }
} else {
    echo "تم العثور على قاعدة البيانات مسبقًا";
}

// إغلاق الاتصال
$conn->close();
?>
