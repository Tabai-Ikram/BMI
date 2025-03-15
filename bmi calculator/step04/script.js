$(document).ready(function() {
    // عند إرسال النموذج
    $('#bmiForm').submit(function(e) {
        e.preventDefault(); // منع إرسال النموذج بشكل تقليدي

        // الحصول على القيم المدخلة من النموذج
        var name = $('#name').val().trim();
        var weight = parseFloat($('#weight').val());
        var height = parseFloat($('#height').val());

        // التحقق من صحة البيانات
        if (name === "" ||isNaN(weight)|| isNaN(height) || height <= 0|| weight <= 0) {
            // عرض رسالة خطأ باستخدام Bootstrap
            $('#result').html('<div class="alert alert-danger">Please fill in all fields correctly.</div>');
            return;
        }

        // إرسال البيانات باستخدام AJAX
        $.ajax({
            url: 'calculate.php', // الملف الذي سيتعامل مع البيانات
            type: 'POST', // طريقة الإرسال
            data: {
                name: name,
                weight: weight,
                height: height
            },
            success: function(response) {
                // عرض النتيجة التي تم إرجاعها من PHP
                $('#result').html('<div class="alert alert-success">' + response + '</div>');
            },
            error: function() {
                // عرض رسالة خطأ في حالة فشل الإرسال
                $('#result').html('<div class="alert alert-danger">An error occurred while processing your request.</div>');
            }
        });
    });
});