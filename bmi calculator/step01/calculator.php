<?php
// التحقق من وجود جميع القيم المطلوبة في البيانات المرسلة عبر POST
if(isset($_POST['name'], $_POST['weight'], $_POST['height'])) {
    
    // تنظيف وحماية قيمة الاسم من الهجمات XSS باستخدام htmlspecialchars
    $name = htmlspecialchars($_POST['name']);
    
    // تحويل الوزن إلى قيمة عشرية (float) للتأكد من أنها رقم
    $weight = floatval($_POST['weight']);
    
    // تحويل الطول إلى قيمة عشرية (float) للتأكد من أنها رقم
    $height = floatval($_POST['height']);
    
    // التحقق من أن الوزن والطول قيم صحيحة (أكبر من الصفر)
    if($weight <= 0 || $height <= 0) {
        echo "Invalid input values."; // إخراج رسالة خطأ إذا كانت القيم غير صحيحة
        exit; // إنهاء تنفيذ البرنامج
    }
    
    // حساب مؤشر كتلة الجسم (BMI) باستخدام الصيغة: الوزن / (الطول * الطول)
    $bmi = $weight / ($height * $height);
    
    // تحديد التفسير بناءً على قيمة مؤشر كتلة الجسم
    if($bmi < 18.5) {
        $interpretation = "Underweight"; // نقص الوزن
    } elseif($bmi < 25) {
        $interpretation = "Normal weight"; // وزن طبيعي
    } elseif($bmi < 30) {
        $interpretation = "Overweight"; // زيادة الوزن
    } else {
        $interpretation = "Obesity"; // سمنة
    }
    
    // إخراج النتيجة مع اسم المستخدم وقيمة مؤشر كتلة الجسم مكونة من رقمين عشريين
    echo "Hello, $name. Your BMI is " . number_format($bmi, 2) . " ($interpretation).";
    
} else {
    // إخراج رسالة إذا لم يتم استلام البيانات المطلوبة
    echo "Data not received.";
}
?>