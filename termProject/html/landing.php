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
      <div class="container-fluid">
        <div class="row">
          <div
            id="playlistCarousel"
            class="carousel slide"
            data-ride="carousel"
          >
            <div class="carousel-inner"></div>
            <button
              class="carousel-control-prev"
              type="button"
              data-bs-target="#playlistCarousel"
              data-bs-slide="prev"
            >
              <span
                class="carousel-control-prev-icon"
                aria-hidden="true"
              ></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button
              class="carousel-control-next"
              type="button"
              data-bs-target="#playlistCarousel"
              data-bs-slide="next"
            >
              <span
                class="carousel-control-next-icon"
                aria-hidden="true"
              ></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
        </div>
        <div class="row">
          <div id="podcastCarousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner"></div>
            <button
              class="carousel-control-prev"
              type="button"
              data-bs-target="#podcastCarousel"
              data-bs-slide="prev"
            >
              <span
                class="carousel-control-prev-icon"
                aria-hidden="true"
              ></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button
              class="carousel-control-next"
              type="button"
              data-bs-target="#podcastCarousel"
              data-bs-slide="next"
            >
              <span
                class="carousel-control-next-icon"
                aria-hidden="true"
              ></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
        </div>
        <div class="row">
          <div
            id="recArtistCarousel"
            class="carousel slide"
            data-ride="carousel"
          >
            <div class="carousel-inner"></div>
            <button
              class="carousel-control-prev"
              type="button"
              data-bs-target="#recArtistCarousel"
              data-bs-slide="prev"
            >
              <span
                class="carousel-control-prev-icon"
                aria-hidden="true"
              ></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button
              class="carousel-control-next"
              type="button"
              data-bs-target="#recArtistCarousel"
              data-bs-slide="next"
            >
              <span
                class="carousel-control-next-icon"
                aria-hidden="true"
              ></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
        </div>
      </div>
    </main>
    <?php include("./footer.php"); ?>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
      $(document).ready(function () {
        $(".carousel").carousel({
          interval: false,
        });
      });
    </script>
  </body>
</html>
