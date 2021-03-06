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

function populatePlaylistPage() {
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
            "func": "getPlaylistInfo",
            "key": key,
            "id": value
        },
        success: function(resultData) {
            if(resultData.code == 200) {
                $("#playlist_section").html(resultData.playlist_html);
                if(resultData.songsByArtist != null) {
                    $("#songsByArtistCarousel").html(resultData.songs_by_artists_html);
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

function populateArtistPage() {
    var params = window.location.search.substr(1);
    var keyValue = params.split('=');
    var artist_id = keyValue[1];
    
    $.ajax({
        type: "POST",
        url: "https://codd.cs.gsu.edu/~lokoth1/php/controller/DataController.php",
        async: false,
        dataType: "json",
        data:{
            "func": "getArtistInfo",
            "artist_id": artist_id
        },
        success: function(resultData) {
            if(resultData.code == 200) {
                $("#artist_section").html(resultData.artist_html);
                if(resultData.album_html != null) {
                    $("#albumsByArtistCarousel").html(resultData.album_html);
                    $("#albums").html(resultData.albums);
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

function search() {
    search_string = $("#search_input").val();
    $.ajax({
        type: "POST",
        url: "https://codd.cs.gsu.edu/~lokoth1/php/controller/SearchController.php",
        async: false,
        dataType: "json",
        data:{
            "func": "search",
            "search_string": search_string
        },
        success: function(resultData) {
            if(resultData.code == 200) {
                $("#song_html").html(resultData.song_html);
                $("#artist_html").html(resultData.artist_html);
                $("#album_html").html(resultData.album_html);
                $("#playlist_html").html(resultData.playlist_html);
            }
        },
        error: function(err) {
            alert("Error: " + err);
        }
    });
}

function playSong(song_id) {
    $.ajax({
        type: "POST",
        url: "https://codd.cs.gsu.edu/~lokoth1/php/controller/DataController.php",
        async: false,
        dataType: "json",
        data:{
            "func": "playSong",
            "song_id": song_id
        },
        success: function(resultData) {
            loadMusic("../img/Jingle Bells 3.mp3");
            $("#playbtn").trigger("click");
            $("#song_name").html(resultData.song_name);
        },
        error: function(err) {
            alert("Error: " + err);
        }
    });
}

function requestArtist() {
    artist_name = $("#artistInput").val();
    genre = $("#genreInput").val();
    desc = $("#descInput").val();
    $.ajax({
        type: "POST",
        url: "https://codd.cs.gsu.edu/~lokoth1/php/controller/DataController.php",
        async: false,
        dataType: "json",
        data:{
            "func": "requestArtist",
            "artist_name": artist_name,
            "genre": genre,
            "desc": desc
        },
        success: function(resultData) {
            if(resultData.code == 200) {
                alert(resultData.message)
            }
        },
        error: function(err) {
            alert("Error: " + err);
        }
    });
}