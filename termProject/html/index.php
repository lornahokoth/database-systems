<!DOCTYPE html>
<html>
  <head>
    <title>Wavelength - Because you know...sound waves</title>
    <!-- CSS only -->
    <link href="../css/bootstrap.min.css" rel="stylesheet" />
    <link href="../css/style.css" rel="stylesheet" />
  </head>
  <body>
    <header class="text-white bg-dark">
      <div class="header-row row align-items-center justify-content-between">
        <div class="col-4">
          <a
            href="/"
            class="
              d-flex
              align-items-center
              mb-3 mb-md-0
              me-md-auto
              text-white text-decoration-none
            "
          >
            <svg class="bi me-2" width="40" height="32">
              <use xlink:href="#bootstrap:"></use>
            </svg>
            <span class="fs-4">Wavelength</span>
          </a>
        </div>
        <div class="col-4 text-end">
          <button type="button" class="btn btn-outline-light me-2">
            Login
          </button>
          <button type="button" class="btn btn-warning">Sign-up</button>
        </div>
      </div>
    </header>
    <main>
      <div
        class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark"
        style="width: 10%"
      >
        <hr />

        <ul class="nav nav-pills flex-column mb-auto">
          <li class="nav-item">
            <a href="#" class="nav-link active" aria-current="page">
              <svg class="bi me-2" width="16" height="16">
                <use xlink:href="#home"></use>
              </svg>
              Browse
            </a>
          </li>
          <li>
            <a href="#" class="nav-link text-white">
              <svg class="bi me-2" width="16" height="16">
                <!-- <use xlink:href="#home"></use> -->
              </svg>
              Search
            </a>
          </li>
          <li>
            <a href="#" class="nav-link text-white">
              <svg class="bi me-2" width="16" height="16">
                <!-- <use xlink:href="#home"></use> -->
              </svg>
              Podcast
            </a>
          </li>
          <li>
            <a href="#" class="nav-link text-white">
              <svg class="bi me-2" width="16" height="16">
                <!-- <use xlink:href="#home"></use> -->
              </svg>
              Playlist
            </a>
          </li>
        </ul>
      </div>
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
    <footer class="text-white bg-dark"></footer>
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
