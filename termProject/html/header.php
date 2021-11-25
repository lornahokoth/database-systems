<link href="../fontawesome-free-5.15.4-web/css/all.css" rel="stylesheet">
<header class="text-white bg-dark">
    <div class="header-row row align-items-center justify-content-between">
        <div class="col-4">
            <a href="../html/landing.php" class="
              d-flex
              align-items-center
              mb-3 mb-md-0
              me-md-auto
              text-white text-decoration-none
            ">
                <img class="header-logo" src="../img/wavelength.png" alt="Wavelength Logo">
                <span class="fs-4 span-logo"> Wavelength </span>
            </a>
        </div>
        <div class="col-4 text-end">
            <div class="row align-items-center">
                <div class="col-6 text-end">
                    <a href="../html/subscription.php">Subscriptions</a>
                </div>
                <div class="col text-end content-right">
                    <div id="login_div">
                        <button type="button" class="btn btn-outline-light me-2" onclick="location.href='../html/login.php';">
                            Login
                        </button>
                        <button type="button" class="btn btn-warning" onclick="location.href='../html/login.php';">Sign-up</button>
                    </div>
                    <div id="user_div" class="d-none d-flex align-items-center">
                        <i class="fas fa-user-circle fa-2x" onclick="location.href='../html/user.php';"></i>
                        <label class="user-padding" id="username_lbl" onclick="location.href='../html/user.php';"></label>
                        <button type="button" class="btn btn-warning" onclick="logout();">logout</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<script src="../js/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="../js/wavelength.js"></script>
<script>
    $(document).ready(function () {
        last_seg = window.location.pathname.split('/').pop();
        if(last_seg != "login.php") {
            $.ajax({
                type: "POST",
                url: "https://codd.cs.gsu.edu/~lokoth1/php/controller/UserController.php",
                async: false,
                dataType: "json",
                data: {
                    "func": "getUserInfo"
                },
                success: function(resultData) {
                    if (resultData.code == 200) {
                        $("#username_lbl").html(resultData.username);
                        $("#login_div").addClass("d-none");
                        $("#user_div").removeClass("d-none");
                    } else {
                        window.location.href = "https://codd.cs.gsu.edu/~lokoth1/html/login.php";
                    }
                },
                error: function(err) {
                    window.location.href = "https://codd.cs.gsu.edu/~lokoth1/html/login.php";
                }
            });
        }
    });
</script>