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
    <main>
        <?php include("./sidebar.php"); ?>
        <div class="container-fluid scroll-div">
            <div class="row">
                <h2>Playlists</h2>
            </div>
            <div class="row carousel-row">
                <div id="playlist" class="carousel slide" data-ride="carousel">
                    <div id="playlistCarousel" class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="cards-wrapper">
                                <div class="card">
                                    <img src="../img/spinning-loading.gif" class="card-img-top" alt="loading" />
                                    <div class="card-body">
                                        <h5 class="card-title"></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#playlist" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#playlist" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <div class="row">
                <h3>Recommended Songs</h3>
            </div>
            <div class="row carousel-row">
                <div id="recSongs" class="carousel slide" data-ride="carousel">
                    <div id="recSongsCarousel" class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="cards-wrapper">
                                <div class="card">
                                    <img src="../img/spinning-loading.gif" class="card-img-top" alt="loading" />
                                    <div class="card-body">
                                        <h5 class="card-title"></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#recSongs" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#recSongs" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <div class="row">
                <h3>Recommended Artists</h3>
            </div>
            <div class="row carousel-row">
                <div id="recArtists" class="carousel slide" data-ride="carousel">
                    <div id="recArtistCarousel" class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="cards-wrapper">
                                <div class="card">
                                    <img src="../img/spinning-loading.gif" class="card-img-top" alt="loading" />
                                    <div class="card-body">
                                        <h5 class="card-title"></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#recArtists" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#recArtists" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </main>
    <?php include("./footer.php"); ?>
    <script src="../js/jquery-3.6.0.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".carousel").carousel({
                interval: false,
            });
            populateLandingPage();
        });
    </script>
</body>

</html>