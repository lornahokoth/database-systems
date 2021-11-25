<!DOCTYPE html>
<html>

<head>
    <title>Wavelength - Because you know...sound waves</title>
    <!-- CSS only -->
    <link href="../css/bootstrap.min.css" rel="stylesheet" />
    <link href="../css/style.css" rel="stylesheet" />
    <link href="../css/payment.css" rel="stylesheet" />
    <link href="../fontawesome-free-5.15.4-web/css/all.css" rel="stylesheet">
</head>

<body>
    <?php include './header.php'; ?>
    <main class="bg-light">
        <div class="container mt-5 px-5">
            <div class="mb-4">
                <h2>Confirm order and pay</h2> <span>please make the payment, after that you can enjoy all the features and benefits.</span>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="card p-3">
                        <h6 class="text-uppercase">Payment details</h6>
                        <div class="inputbox mt-3"> <input type="text" id="card_name" class="form-control" required="required"> <span>Name on card</span> </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="inputbox mt-3 mr-2"> <input type="text" id="card_number" class="form-control" required="required"> <i class="fa fa-credit-card"></i> <span>Card Number</span> </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex flex-row">
                                    <div class="inputbox mt-3 mr-2"> <input type="text" id="exp_date" class="form-control" required="required"> <span>Expiry</span> </div>
                                    <div class="inputbox mt-3 mr-2"> <input type="text" id="cvv" class="form-control" required="required"> <span>CVV</span> </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 mb-4">
                            <h6 class="text-uppercase">Billing Address</h6>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="inputbox mt-3 mr-2"> <input type="text" id="street_addr" class="form-control" required="required"> <span>Street Address</span> </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="inputbox mt-3 mr-2"> <input type="text" id="city" class="form-control" required="required"> <span>City</span> </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <div class="inputbox mt-3 mr-2"> <input type="text" id="state" class="form-control" required="required"> <span>State/Province</span> </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="inputbox mt-3 mr-2"> <input type="text" id="zipcode" class="form-control" required="required"> <span>Zip code</span> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 mb-4 d-flex justify-content-between"> <span>Previous step</span> <button id="pay" class="btn btn-success px-3" onclick="makePayment()"></button> </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-blue p-3 text-white mb-3"> <span>You have to pay</span>
                        <div class="d-flex flex-row align-items-end mb-3">
                            <h1 id="dollar" class="mb-0 yellow"</h1> <span id="cents"></span>
                        </div> <span>Enjoy all the features and perk after you complete the payment</span> <a href="../html/subscription.php" target="_blank" class="yellow decoration">Know all the features</a>
                        <div class="hightlight"> <span id="next_payment"></span> </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include './footer.php'; ?>
</body>
<script type="text/javascript" src="../js/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="../js/wavelength.js"></script>
<script>
    $(document).ready(function() {
        var params = window.location.search.substr(1);
        var type = params.split('=')[1];
        var nextPayment;
        var lastDayOfMonth;

        var now = new Date();
        nextPayment = new Date(now.getFullYear(), now.getMonth() + 1, now.getDate());
        lastDayOfMonth = new Date(now.getFullYear(), now.getMonth() + 2, 0);
        var dateString = nextPayment.getFullYear() + "-" + (nextPayment.getMonth()+1) + "-" + nextPayment.getDate();
        $("#next_payment").html("This is a reoccuring payment.  Your next payment will be " + dateString);

        if(type == 'plus') {
            $("#dollar").html('$4');
            $("#cents").html(".99");
            $("#pay").html("Pay $4.99");
        } else if (type == 'premium') {
            $("#dollar").html('$9');
            $("#cents").html(".99");
            $("#pay").html("Pay $9.99");
        } else {
            window.location.href = "https://codd.cs.gsu.edu/~lokoth1/html/login.php";
        }
    });
</script>

</html>