<?php

// توصيل قاعدة البيانات
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "customers";

$connection = new mysqli($servername, $username, $password, $dbname);

// التحقق من التوصيل
if ($connection->connect_error) {
    die("فشل الاتصال بقاعدة البيانات: " . $connection->connect_error);
}

// استخدام $connection للقيام بعمليات حذف البيانات والتحقق منها
// على سبيل المثال: استخدم $connection في إنشاء استعلام DELETE لحذف السجلات

// بعد الانتهاء من عمليات الحذف، قم بإغلاق الاتصال



// تحقق مما إذا كانت متغيرات POST موجودة
if(isset($_POST['id'])) {
    // قم بتنظيف البيانات المستلمة من المدخلات لتجنب هجمات الحقن SQL
    $id = mysqli_real_escape_string($connection, $_POST['id']);

    // قم بتنفيذ استعلام SQL لحذف السجل المحدد
    $sql = "DELETE FROM customers WHERE id = $id";

    if(mysqli_query($connection, $sql)) {
        // إذا نجحت عملية الحذف، أرسل استجابة ناجحة
        echo "success";
    } else {
        // إذا فشلت عملية الحذف، أرسل استجابة تشير إلى الخطأ
        echo "error";
    }
} else {
    // إذا لم يتم تمرير معرف السجل، أرسل استجابة بأن هناك بيانات مفقودة
    echo "missing_data";
}
// بعد الانتهاء من عمليات الحذف، قم بإغلاق الاتصال
$connection->close();
?>
