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

        <div class="flex-column" style="width: 90%">
            <div id="playlist_section" style="height: 66%">
                
            </div>
            <div id="other_songs_section" style="height:25%">
                <div class="row">
                    <h2>Songs by artists found on this playlist</h2>
                </div>
                <div class="row carousel-row">
                    <div id="songsByArtist" class="carousel slide" data-ride="carousel">
                        <div id="songsByArtistCarousel" class="carousel-inner">
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
                        <button class="carousel-control-prev" type="button" data-bs-target="#songsByArtist" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#songsByArtist" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include("./footer.php"); ?>
    <script src="../js/jquery-3.6.0.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>

<script>
    $(document).ready(function() {
        populatePlaylistPage();
        $(".carousel").carousel({
            interval: false,
        });
    });
</script>

</html>