<div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 10%">
    <hr />

    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a id="browse" href="../html/landing.php" class="nav-link text-white" aria-current="page">
                <img src="../img/house-door.svg" class="icon-color" alt="Browse">
                Browse
            </a>
        </li>
        <li>
            <a id="search" href="../html/search.php" class="nav-link text-white">
                <img src="../img/search.svg" class="icon-color" alt="Search">
                Search
            </a>
        </li>
        <li>
            <a href="#" class="nav-link text-white">
                <img src="../img/mic.svg" class="icon-color" alt="Podcast">
                Podcast
            </a>
        </li>
        <li>
            <a href="#" class="nav-link text-white">
                <img src="../img/music-note-list.svg" class="icon-color" alt="Playlist">
                Playlist
            </a>
        </li>
    </ul>
</div>

<script src="../js/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        last_seg = window.location.pathname.split('/').pop();
        if (last_seg == 'landing.php') {
            $('#browse').addClass('active');
        } else if (last_seg == 'search.php') {
            $('#search').addClass('active');
        }
    });
</script>