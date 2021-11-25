<!DOCTYPE html>
<html>

<head>
    <title>Wavelength - Because you know...sound waves</title>
    <!-- CSS only -->
    <link href="../css/bootstrap.min.css" rel="stylesheet" />
    <link href="../css/style.css" rel="stylesheet" />
</head>

<body>
    <?php include './header.php'; ?>
    <main class="bg-light">
        <div class="container">
            <div class="row sub-row align-items-start">
                <div class="col text-center card sub-card">
                    <h5 class="card-title sub-header"> Basic (Free) </h5>
                    <ul class="sub-ul text-start">
                        <li>10 Custom Playlists</li>
                        <li>Unlimited Listening</li>
                        <li>Ads every 30 min</li>
                    </ul>
                    <a href="../html/landing.php" class="btn btn-primary">Start Listening</a>
                </div>
                <div class="col text-center card sub-card">
                    <h5 class="card-title sub-header"> Plus ($4.99) </h5>
                    <ul class="sub-ul text-start">
                        <li>30 Custom Playlists</li>
                        <li>Unlimited Listening</li>
                        <li>Ad Free Listening</li>
                        <li>2 Active Listening Sessions</li>
                    </ul>
                    <a href="../html/payment.php?type=plus" class="btn btn-primary">Get Plus</a>
                </div>
                <div class="col text-center card sub-card">
                    <h5 class="card-title sub-header"> Premium ($9.99) </h5>
                    <ul class="sub-ul text-start">
                        <li>Unlimited Playlists</li>
                        <li>Unlimited Listening</li>
                        <li>Ad Free Listening</li>
                        <li>4 Active Listening Sessions</li>
                        <li>Play music offline</li>
                    </ul>
                    <a href="../html/payment.php?type=premium" class="btn btn-primary"> Get Premium </a>
                </div>
            </div>
    </main>
    <?php include './footer.php'; ?>
</body>

</html>