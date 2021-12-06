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
            <div class="row">
                <div class="col">
                    <div class="p-1 bg-light rounded rounded-pill shadow-sm mb-4">
                        <div class="input-group">
                            <input id="search_input" type="search" placeholder="Searching..." aria-describedby="button-addon1" class="form-control border-0 bg-light">
                            <div class="input-group-append">
                                <button id="button-addon1" type="button" class="btn btn-link text-primary" onclick="search()"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-10"></div>
            </div>
            <div id="scroll_div" class="flex-column">
                <div class="row">
                    <div class="col">
                        <div class="row">
                            <h3>Songs</h3>
                        </div>
                        <div class="row">
                            <div id="song_html" class="col table-wrapper-scroll-y search-custom-scrollbar">

                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="row">
                            <h3>Artists</h3>
                        </div>
                        <div class="row">
                            <div id="artist_html" class="col table-wrapper-scroll-y search-custom-scrollbar">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="row">
                            <h3>Albums</h3>
                        </div>
                        <div class="row">
                            <div id="album_html" class="col table-wrapper-scroll-y search-custom-scrollbar">

                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="row">
                            <h3>Playlists</h3>
                        </div>
                        <div class="row">
                            <div id="playlist_html" class="col table-wrapper-scroll-y search-custom-scrollbar">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include("./footer.php"); ?>
    <script src="../js/jquery-3.6.0.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/wavelength.js"></script>
</body>

</html>