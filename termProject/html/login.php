<!DOCTYPE html>
<html>

<head>
    <title>Wavelength - Because you know...sound waves</title>
    <!-- CSS only -->
    <link href="../css/bootstrap.min.css" rel="stylesheet" />
    <link href="../css/style.css" rel="stylesheet" />
</head>

<body>
    <?php include("./header.php"); ?>
    <main class="bg-light">
        <div class="container-fluid login-container">
            <div class="row login-row">
                <div class="col-md-6 login-col login-img">
                    <img src="../img/listening.jpg" alt="Group Listening to music" />
                </div>

                <div id="signin" name="signin" class="col-md-6 login-col">
                    <div class="login d-flex align-items-center py-5">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-10 col-xl-7 mx-auto">
                                    <h3 class="display-4 text-center">Wavelength</h3>
                                    <p class="text-muted mb-4 text-center">To continue, log in to Wavelength.</p>
                                    <div class="mb-3">
                                        <input id="inputUser" type="text" placeholder="Username" required="" autofocus="" class="form-control rounded-pill border-0 shadow-sm px-4">
                                    </div>
                                    <div class="mb-3">
                                        <input id="inputPassword" type="password" placeholder="Password" required="" class="form-control rounded-pill border-0 shadow-sm px-4 text-primary">
                                    </div>
                                    <div class="custom-control custom-checkbox mb-3">
                                        <input id="customCheck1" type="checkbox" checked class="custom-control-input">
                                        <label for="customCheck1" class="custom-control-label">Remember password</label>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary btn-block text-uppercase mb-2 rounded-pill shadow-sm" onclick="signin()">Sign in</button>
                                    </div>

                                <label class="hr-label">OR</label>
                                <div class="text-center bottom-button">
                                    <button type="button" class="btn btn-outline-primary btn-block text-uppercase mb-2 rounded-pill shadow-sm" onclick="goToSignUp()">Sign up for Wavelength</button>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="signup" name="signup" class="col-md-6 login-col d-none">
                    <div class="login d-flex align-items-center py-5">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-10 col-xl-7 mx-auto">
                                    <h3 class="display-4 text-center">Wavelength</h3>
                                    <p class="text-muted mb-4 text-center">To continue, log in to Wavelength.</p>
                                    <div class="mb-3">
                                        <input id="signupFirstName" type="text" placeholder="First Name" required="" autofocus="" class="form-control rounded-pill border-0 shadow-sm px-4">
                                    </div>
                                    <div class="mb-3">
                                        <input id="signupLastName" type="text" placeholder="Last Name" required="" autofocus="" class="form-control rounded-pill border-0 shadow-sm px-4">
                                    </div>
                                    <div class="mb-3">
                                        <input id="signupDOB" type="date" placeholder="Date of Birth" required="" autofocus="" class="form-control rounded-pill border-0 shadow-sm px-4">
                                    </div>
                                    <div class="mb-3">
                                        <input id="signupEmail" type="email" placeholder="Email address" required="" autofocus="" class="form-control rounded-pill border-0 shadow-sm px-4">
                                    </div>
                                    <div class="mb-3">
                                        <input id="signupUser" type="email" placeholder="Username" required="" autofocus="" class="form-control rounded-pill border-0 shadow-sm px-4">
                                    </div>
                                    <div class="mb-3">
                                        <input id="signupPassword" type="password" placeholder="Password" required="" class="form-control rounded-pill border-0 shadow-sm px-4 text-primary">
                                    </div>
                                    <div class="mb-3">
                                        <input id="signupConfirmPassword" type="password" placeholder="Confirm Password" required="" class="form-control rounded-pill border-0 shadow-sm px-4 text-primary">
                                    </div>
                                    <div class="text-center">
                                        <button type="button" class="btn btn-primary btn-block text-uppercase mb-2 rounded-pill shadow-sm" onclick="signup()">Sign Up</button>
                                    </div>

                                    <label class="hr-label">OR</label>
                                    <div class="text-center bottom-button">
                                        <button type="button" class="btn btn-outline-primary btn-block text-uppercase mb-2 rounded-pill shadow-sm" onclick="goToSignIn()">Already Have an Account</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include("./footer.php"); ?>
</body>
<script type="text/javascript" src="../js/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="../js/wavelength.js"></script>
</html>