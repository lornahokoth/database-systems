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
    username = $('#signupUser').val();
    passwd = $('#signupPassword').val();
    confirmPasswd = $('#signupConfirmPassword').val();
    $.ajax({
        type: "POST",
        url: "https://codd.cs.gsu.edu/~lokoth1/php/controller/LoginController.php?func=signup",
        data:{"fname":fname, "lname":lname, "email":email, "username":username, "password":passwd, "confirmPasswd":confirmPasswd},
        dataType: "json",
        success: function(resultData) {
            alert(resultData);
        },
        error: function(err) {
            alert(err);
        }
    });
}

function signin() {
    email = $('#inputUser').val();
    passwd = $('#inputPassword').val();
    $.ajax({
        type: "POST",
        url: "https://codd.cs.gsu.edu/~lokoth1/php/controller/LoginController.php",
        async: false,
        data:{
            "func": "login",
            "email": email, 
            "password":passwd
        },
        dataType: "json",
        success: function(resultData) {
            if(resultData.code == 200) {
                window.location.href = "https://codd.cs.gsu.edu/~lokoth1/html/landing.php";
                return false;
            }
        },
        error: function(err) {
            alert("Error: " + err);
        }
    });
}