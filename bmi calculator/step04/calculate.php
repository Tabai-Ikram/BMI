<?php
// الاتصال بقاعدة البيانات
$servername = "localhost";
$username = "root"; 
$password = "";  
$dbname = "bmi";

$conn = new mysqli($servername, $username, $password, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// التحقق من وجود البيانات المطلوبة
if (isset($_POST['name'], $_POST['weight'], $_POST['height'])) {
    // تنظيف البيانات المدخلة
    $name = htmlspecialchars($_POST['name']);
    $weight = floatval($_POST['weight']);
    $height = floatval($_POST['height']);

    // تحويل الطول من السنتيمتر إلى المتر
    $height_m = $height / 100;

    // التحقق من صحة البيانات
    if ($weight <= 5 || $weight > 170 || $height_m<0.02 ||$height_m>270) {
        echo "المعلومات خاطئة اعد ادخال معلومات صحيحة ";
        exit;
    }

    if ($weight > 0 && $height > 0) {
        // حساب مؤشر كتلة الجسم (BMI)
        $bmi = $weight / ($height_m * $height_m);

        // تحديد التفسير بناءً على قيمة الـ BMI
        if ($bmi < 18.5) {
            $interpretation = "Underweight";
        } elseif ($bmi < 25) {
            $interpretation = "Normal weight";
        } elseif ($bmi < 30) {
            $interpretation = "Overweight";
        } else {
            $interpretation = "Obesity";
        }

        // إنشاء مصفوفة للنتيجة
        $result = [
            "name" => $name,
            "weight" => $weight,
            "height" => $height,
            "bmi" => number_format($bmi, 2),
            "interpretation" => $interpretation
        ];

        // قراءة الملف الحالي (إذا كان موجودًا)
        $data = [];
        if (file_exists("bmi_results.json")) {
            $data = json_decode(file_get_contents("bmi_results.json"), true);
        }
        $data[] = $result;    // إضافة النتيجة الجديدة

        // حفظ البيانات في ملف JSON
        file_put_contents("bmi_results.json", json_encode($data));
         echo"hello.$name.your BMI is:",number_format($bmi,2),"($interpretation).";
    } else {
        echo "Invalid input values.";
    }
} else {
    echo "Data not received.";
}
?>
