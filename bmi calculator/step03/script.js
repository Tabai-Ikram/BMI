$(document).ready(function() {
    $('#bmiForm').submit(function(e) {
        e.preventDefault(); // منع إرسال النموذج بشكل تقليدي

        // التحقق من صحة البيانات باستخدام jQuery
        var name = $('#name').val().trim();
        var weight = parseFloat($('#weight').val());
        var height = parseFloat($('#height').val());

        if (name === "" ||isNaN(weight) || isNaN (height) ||weight<= 0 ||height<= 0 ) {
            // عرض رسالة خطأ باستخدام Bootstrap
            $('#result').html('<div class="alert alert-danger">Please fill in all fields correctly.</div>');
            return;
        }

        // حساب مؤشر كتلة الجسم (BMI)
        var bmi = weight / (height * height);
        var interpretation = "";

        if (bmi < 18.5) {
            interpretation = "Underweight";
        } else if (bmi < 25) {
            interpretation = "Normal weight";
        } else if (bmi < 30) {
            interpretation = "Overweight";
        } else {
            interpretation = "Obesity";
        }

        // عرض النتيجة باستخدام Bootstrap
        $('#result').html('<div class="alert alert-success">Hello, ' + name + '. Your BMI is ' + bmi.toFixed(2) + ' (' + interpretation + ').</div>');
    });
});