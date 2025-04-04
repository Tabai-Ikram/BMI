$(document).ready(function() {
    $('#bmiForm').submit(function(e) {
        e.preventDefault();
        
        var name = $('#name').val().trim();
        var weight = parseFloat($('#weight').val());
        var height = parseFloat($('#height').val());

        if (name === "" || weight <= 0 || height <= 0) {
            $('#result').html('<div class="alert alert-danger">Please fill in all fields correctly.</div>');
            return;
        }

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
        
        $('#result').html('<div class="alert alert-success">Hello, ' + name + '. Your BMI is ' + bmi.toFixed(2) + ' (' + interpretation + ')</div>');
        
        // إرسال البيانات إلى الخادم لحفظها
        $.post('calculate.php', {
            name: name,
            weight: weight,
            height: height
        }, function(response) {
            console.log(response);
        });
    });
});
