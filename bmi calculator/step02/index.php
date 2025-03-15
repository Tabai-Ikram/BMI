
<?php
$result = ""; // متغير لتخزين نتيجة حساب الـ BMI

// التحقق من أن النموذج تم إرساله باستخدام طريقة POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // تنظيف البيانات المدخلة لتجنب هجمات XSS
    $name = htmlspecialchars($_POST['name']);
    $weight = floatval($_POST['weight']); // تحويل الوزن إلى رقم عشري
    $height = floatval($_POST['height']); // تحويل الطول إلى رقم عشري

    // التحقق من أن القيم المدخلة صحيحة (أكبر من الصفر)
    if ($weight > 0 && $height > 0) {
        // حساب مؤشر كتلة الجسم (BMI)
        $bmi = $weight / ($height * $height);

        // تحديد التفسير بناءً على قيمة الـ BMI
        if ($bmi < 18.5) {
            $interpretation = "Underweight"; // نقص الوزن
        } elseif ($bmi < 25) {
            $interpretation = "Normal weight"; // وزن طبيعي
        } elseif ($bmi < 30) {
            $interpretation = "Overweight"; // زيادة الوزن
        } else {
            $interpretation = "Obesity"; // سمنة
        }

        // تخزين النتيجة في المتغير $result
        $result = "Hello, $name. Your BMI is " . number_format($bmi, 2) . " ($interpretation).";
    } else {
        $result = "Invalid input values."; // إذا كانت القيم غير صحيحة
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>BMI Calculator</title>
    <link rel="stylesheet" href="style.css"> <!-- رابط لملف CSS -->
    <script src="script.js"></script> <!-- رابط لملف JavaScript -->
</head>
<body>
    <h1>BMI Calculator</h1>

    <?php if ($result != "") { echo "<p>$result</p>"; } ?> <!-- عرض النتيجة إذا كانت موجودة -->

    <form action="" method="post" onsubmit="return validateForm();">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br> <!-- حقل إدخال الاسم -->

        <label for="weight">Weight (kg):</label>
        <input type="number" id="weight" name="weight" required><br> <!-- حقل إدخال الوزن -->

        <label for="height">Height (m):</label>
        <input type="number" id="height" name="height" required><br> <!-- حقل إدخال الطول -->

        <input type="submit" value="Calculate"> <!-- زر لإرسال النموذج -->
    </form>
</body>
</html>