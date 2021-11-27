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

function makePayment() {
    var params = window.location.search.substr(1);
    var type = params.split('=')[1];
    card_name = $("#card_name").val();
    card_number = $("#card_number").val();
    exp_date = $("#exp_date").val();
    cvv = $("#cvv").val();
    street_addr = $("#street_addr").val();
    city = $("#city").val();
    state = $("#state").val();
    zipcode = $("#zipcode").val();
    $.ajax({
        type: "POST",
        url: "https://codd.cs.gsu.edu/~lokoth1/php/controller/PaymentController.php",
        async: false,
        dataType: "json",
        data:{
            "func": "makePayment",
            "type": type,
            "card_name": card_name,
            "card_number": card_number,
            "exp_date": exp_date,
            "cvv": cvv,
            "street_addr": street_addr,
            "city": city,
            "state": state,
            "zipcode": zipcode
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

function logout() {
    $.ajax({
        type: "POST",
        url: "https://codd.cs.gsu.edu/~lokoth1/php/controller/UserController.php",
        async: false,
        dataType: "json",
        data:{
            "func": "logout"
        },
        success: function(resultData) {
            window.location.href = "https://codd.cs.gsu.edu/~lokoth1/html/login.php";
        },
        error: function(err) {
            alert("Error: " + err);
        }
    });
}

function populateLandingPage() {
    $.ajax({
        type: "POST",
        url: "https://codd.cs.gsu.edu/~lokoth1/php/controller/DataController.php",
        async: false,
        dataType: "json",
        data:{
            "func": "getLandingPage"
        },
        success: function(resultData) {
            $("#playlistCarousel").html(resultData.playlist);
            $("#recSongsCarousel").html(resultData.recSongs);
            $("#recArtistCarousel").html(resultData.recArtists);
        },
        error: function(err) {
            alert("Error: " + err);
        }
    });
}

function populateAlbumPage() {
    var params = window.location.search.substr(1);
    var keyValue = params.split('=');
    var key = keyValue[0];
    var value = keyValue[1];

    $.ajax({
        type: "POST",
        url: "https://codd.cs.gsu.edu/~lokoth1/php/controller/DataController.php",
        async: false,
        dataType: "json",
        data:{
            "func": "getAlbumInfo",
            "key": key,
            "id": value
        },
        success: function(resultData) {
            if(resultData.code == 200) {
                $("#album_section").html(resultData.album_html);
                if(resultData.songsByArtist != null) {
                    $("#songsByArtistCarousel").html(resultData.songsByArtist);
                    $("#artist").html(resultData.artist);
                } else {
                    $("#other_songs_section").html("");
                }
            } else {
                alert(resultData.message);
            }
        },
        error: function(err) {
            alert("Error: " + err);
        }
    });
}