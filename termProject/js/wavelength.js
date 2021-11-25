function loadCarousels() {
    
}

function goToSignIn() {
    $('#signin').removeClass("d-none");
    $('#signup').addClass("d-none");
}

function goToSignUp() {
    $('#signin').addClass("d-none");
    $('#signup').removeClass("d-none");
}

function signup() {
    fname = $('#signupFirstName').val();
    lname = $('#signupLastName').val();
    email = $('#signupEmail').val();
    dob = $('#signupDOB').val();
    username = $('#signupUser').val();
    passwd = $('#signupPassword').val();
    confirmPasswd = $('#signupConfirmPassword').val();
    $.ajax({
        type: "POST",
        url: "https://codd.cs.gsu.edu/~lokoth1/php/controller/LoginController.php",
        async: false,
        dataType: "json",
        data:{
            "func": "signup",
            "fname":fname,
            "lname":lname,
            "dob": dob,
            "email":email,
            "username":username,
            "password":passwd,
            "confirmPassword":confirmPasswd},
        success: function(resultData) {
            if(resultData.code == 200) {
                window.location.href = "https://codd.cs.gsu.edu/~lokoth1/html/subscription.php";
            } else {
                alert(resultData.message);
            }
        },
        error: function(err) {
            alert("Error" + err);
        }
    });
}

function signin() {
    username = $('#inputUser').val();
    passwd = $('#inputPassword').val();
    $.ajax({
        type: "POST",
        url: "https://codd.cs.gsu.edu/~lokoth1/php/controller/LoginController.php",
        async: false,
        dataType: "json",
        data:{
            "func": "login",
            "username": username, 
            "password":passwd
        },
        success: function(resultData) {
            if(resultData.code == 200) {
                window.location.href = "https://codd.cs.gsu.edu/~lokoth1/html/landing.php";
            } else {
                alert(resultData.message);
            }
        },
        error: function(err) {
            alert("Error: " + err);
        }
    });
}