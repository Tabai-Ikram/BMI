function validateForm() {
    var name = document.getElementById('name').value; // الحصول على قيمة الاسم
    var weight = document.getElementById('weight').value; // الحصول على قيمة الوزن
    var height = document.getElementById('height').value; // الحصول على قيمة الطول

    if (name === "" || weight==="" || height === "") {
        alert("All fields are required!"); //  تحقق من أن جميع الحقول مملوءة ام لا
        return false;
    }

    if (isNaN(weight) || isNaN(height)) {    //  (not a number)تدل على ان المدخلات ليست ارقام isNaN 
        alert("Weight and height must be numbers."); //تحقق من أن الوزن والطول ارقام 
        return false;
    }
    return true; // إذا كانت البيانات صحيحة، يتم إرسال النموذج
}