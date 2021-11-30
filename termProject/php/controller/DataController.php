<?php
//includes
include './DBController.php';
$salt = "m1n1Cl0ud$";
$return;
//This is used to route requests to login.php to the correct function.
//If no function found then a redirect to a function ot found page is performed
if (function_exists($_POST['func'])) {
    $_POST['func']();
    echo json_encode($return);
    return 0;
} else {
    //return 404 not found;
    echo "function not found " . $_POST['func'];
    return 1;
}

function getLandingPage()
{
    global $return;
    $playlistCarousel = "";
    $randArtistsCarousel = "";
    $randSongsCarousel = "";

    if (!empty($_COOKIE['user_id'])) {
        $user_id = $_COOKIE['user_id'];
        $conn = dbconnect();
        $playlist_sql = "SELECT * FROM dwekesa1.Playlist WHERE user_id = " . $user_id;
        $results = mysqli_query($conn, $playlist_sql);
        if ($results->num_rows > 0) {
            $playlistCarousel = buildCarousel($results, "playlist");
        }
        $return['playlist'] = $playlistCarousel;
        $return['playlist_count'] = $results->num_rows;
        $rand_songs_sql = "SELECT * FROM dwekesa1.Song ORDER BY RAND() LIMIT 12";
        $results = mysqli_query($conn, $rand_songs_sql);
        if ($results->num_rows > 0) {
            $randSongsCarousel = buildCarousel($results, "songs");
        }
        $return['recSongs'] = $randSongsCarousel;
        $return['rec_songs_count'] = $results->num_rows;
        $rand_artists_sql = "SELECT * FROM dwekesa1.Artist ORDER BY RAND() LIMIT 12";
        $results = mysqli_query($conn, $rand_artists_sql);
        if ($results->num_rows > 0) {
            $randArtistsCarousel = buildCarousel($results, "artists");
        }
        $return['recArtists'] = $randArtistsCarousel;
        $return['rec_artists_count'] = $results->num_rows;
    }
}

function buildCarousel($arr, $type)
{
    $count = 0;
    $carousel = '<div class="carousel-item active">';
    $carousel .= '<div class="cards-wrapper">';
    while ($row = $arr->fetch_assoc()) {
        if ($count % 7 == 6) {
            $carousel .= '</div>';
            $carousel .= '</div>';
            $carousel .= '<div class="carousel-item">';
            $carousel .= '<div class="cards-wrapper">';
        }
        if ($type == "songs") {
            $carousel .= '<div class="card" onclick="location.href=\'../html/album.php?song_id=' . $row['song_id'] . '\'">';
        } else if ($type == "playlist") {
            $carousel .= '<div class="card" onclick="location.href=\'../html/playlist.php?play_list=' . $row['playlist_id'] . '\'">';
        } else {
            $carousel .= '<div class="card" onclick="location.href=\'../html/artist.php?artist_id=' . $row['artist_id'] . '\'">';
        }
        $carousel .= '<img src="../img/music-note-list.svg" class="card-img-top" alt="' .
            $row['name'] . '">';
        $carousel .= '<div class="card-body">';
        $carousel .= '<h5 class="card-title">' . $row['name'] . '</h5>';
        $carousel .= '</div>';
        $carousel .= '</div>';
        $count++;
    }
    $carousel .= "</div>";

    return $carousel;
}

function getAlbumInfo()
{
    global $return;
    $return = array();
    $return['album_html'] = "";
    $return['songsByArtist'] = "";
    $return['artist'] = "";
    if (empty($_POST['song_id']) && (empty($_POST['key']) || empty($_POST['id']))) {
        $return['code'] = 401;
        $return['message'] = "Invalid Data";
        return;
    }

    $key = $_POST['key'];
    $id = $_POST['id'];
    $conn = dbconnect();

    if ($key == "song_id") {
        $song_query = "SELECT * FROM dwekesa1.Song WHERE song_id = " . $id;
        $results = mysqli_query($conn, $song_query);
        if ($results->num_rows == 0) {
            $return['code'] = 401;
            $return['message'] = "Could not find song";
            return;
        }
        $song_info = $results->fetch_assoc();
        $album_id = $song_info['album_id'];
    } else {
        $album_id = $id;
    }

    $album_query = "SELECT * FROM dwekesa1.Album JOIN dwekesa1.Artist ON dwekesa1.Album.artist_id = dwekesa1.Artist.artist_id WHERE album_id = " . $album_id;
    $albumResults = mysqli_query($conn, $album_query);
    if ($albumResults->num_rows == 0) {
        $return['code'] = 401;
        $return['message'] = "Could not find album";
        return;
    }

    $album_query = "SELECT * FROM dwekesa1.Song WHERE album_id = " . $album_id;
    $songResults = mysqli_query($conn, $album_query);
    if ($songResults->num_rows == 0) {
        $return['code'] = 401;
        $return['message'] = "Could not find album";
        return;
    }
    $album_info = $albumResults->fetch_assoc();
    $album_html = buildAlbumHtml($songResults, $album_info);

    $songs_by_artist_sql = "SELECT * FROM dwekesa1.Song WHERE artist_id = " . $album_info['artist_id'] . ' AND album_id != ' . $album_info['album_id'];
    $results = mysqli_query($conn, $songs_by_artist_sql);
    if ($results->num_rows > 0) {
        $songs_by_artist_html = buildSongsByArtistsHtml($results);
    }

    $return['code'] = 200;
    $return['album_html'] = $album_html;
    $return['songsByArtist'] = $songs_by_artist_html;
    $return['artist'] = 'Other songs by ' . $album_info['name'];

    return;
}

function getArtistInfo()
{
    global $return;
    $return = array();
    if (empty($_POST['username']) || empty($_POST['password'])) {
    }
}

function buildAlbumHtml($songResults, $album_info)
{
    $runtime = 0;
    $count = 0;

    $tablehtml = '<div class="row table-wrapper-scroll-y my-custom-scrollbar" style="height: 79%; width: 80%;">';
    $tablehtml .= '<table>';
    $tablehtml .= '<thead>';
    $tablehtml .= '<th>#</th>';
    $tablehtml .= '<th>Title</th>';
    $tablehtml .= '<th style="width: 25px;">Playtime</th>';
    $tablehtml .= '<th style="width: 25px;"></th>';
    $tablehtml .= '</thead>';
    $tablehtml .= '<tbody>';
    while ($row = $songResults->fetch_assoc()) {
        $count++;
        if ($row != NULL) {
            $runtime += $row['runtime'];
            $tablehtml .= '<tr>';
            $tablehtml .= '<td>' . $count . '</td>';
            $tablehtml .= '<td>';
            $tablehtml .= '<div class="row song-title">';
            $tablehtml .= $row['name'];
            $tablehtml .= '</div>';
            $tablehtml .= '<div class="row album-name">';
            $tablehtml .= $album_info['name'];
            $tablehtml .= '</div>';
            $tablehtml .= '</td>';
            $minutes = floor($row['runtime']);
            $seconds = sprintf('%02d', ceil(($row['runtime'] - $minutes) * 60));
            $tablehtml .= '<td>' . $minutes . ":" . $seconds . '</td>';
            $tablehtml .= '<td style="cursor:pointer;" onclick="playSong(' . $row['song_id'] . ')"><i class="fas fa-play"></i></td>';
            $tablehtml .= '</tr>';
        }
    }

    while ($count < 9) {
        $tablehtml .= '<tr>';
        $tablehtml .= '<td></td>';
        $tablehtml .= '<td>';
        $tablehtml .= '<div class="row song-title">';
        $tablehtml .= '&nbsp;';
        $tablehtml .= '</div>';
        $tablehtml .= '<div class="row album-name">';
        $tablehtml .= '&nbsp;';
        $tablehtml .= '</div>';
        $tablehtml .= '</td>';
        $tablehtml .= '<td></td>';
        $tablehtml .= '<td></td>';
        $tablehtml .= '</tr>';
        $count++;
    }
    $tablehtml .= '</table>';
    $tablehtml .= '</div>';

    $album_html = "";
    $album_html .= '<div class="row" style="height: 20%">';
    $album_html .= '<div class="col-2 d-flex">';
    $album_html .= '<img src="../img/music-note-list.svg" alt="You\'re Welcome" style="height: 100%" />';
    $album_html .= '</div>';
    $album_html .= '<div class="col">';
    $album_html .= '<div class="row">';
    $album_html .= '<label>Album</label>';
    $album_html .= '</div>';
    $album_html .= '<div class="row header-song-title">';
    $album_html .= '<h1>' . $album_info['album_name'] . '</h1>';
    $album_html .= '</div>';
    $album_html .= '<div class="row">';
    $album_html .= '<div class="col">';
    $album_html .= $album_info['name'];
    $album_html .= '</div>';
    $album_html .= '<div class="col">';
    $album_html .= $album_info['released'];
    $album_html .= '</div>';
    $album_html .= '<div class="col">';
    $minutes = floor($runtime);
    $seconds = sprintf('%02d', ceil(($runtime - $minutes) * 60));
    $album_html .= $songResults->num_rows . " Songs, " . $minutes . ":" . $seconds;
    $album_html .= '</div>';
    $album_html .= '<div class="col-8">';
    $album_html .= '</div>';
    $album_html .= '</div>';
    $album_html .= '</div>';
    $album_html .= '</div>';
    $album_html .= $tablehtml;

    return $album_html;
}

function getPlaylistInfo()
{
    global $return;
    $return = array();
    $return['album_html'] = "";
    $return['songsByArtist'] = "";
    $return['artist'] = "";
    if (empty($_POST['key']) || empty($_POST['id'])) {
        $return['code'] = 401;
        $return['message'] = "Invalid Data";
        return;
    }

    $id = $_POST['id'];
    $conn = dbconnect();

    $playlist_sql = "SELECT * FROM dwekesa1.Playlist JOIN dwekesa1.Users ON dwekesa1.Playlist.user_id = dwekesa1.Users.user_id WHERE dwekesa1.Playlist.playlist_id = " . $id;
    $playlistResults = mysqli_query($conn, $playlist_sql);
    if ($playlistResults->num_rows == 0) {
        $return['code'] = 401;
        $return['message'] = "Could not find playlist";
        return;
    }

    $song_sql = "SELECT song.name AS song_name, album.album_name AS album_name, artist.name AS artist_name, song.released as released, song.runtime as runtime FROM dwekesa1.P_Contains_S AS ps_join " .
        "JOIN dwekesa1.Song AS song ON song.song_id = ps_join.song_id " .
        "JOIN dwekesa1.Artist AS artist ON artist.artist_id = song.artist_id " .
        "JOIN dwekesa1.Album AS album ON album.album_id = song.album_id " .
        "WHERE ps_join.playlist_id = " . $id;
    $songResults = mysqli_query($conn, $song_sql);
    // $return['code'] = 401;
    // $return['message'] = $song_sql;
    // return;
    if ($songResults->num_rows == 0) {
        $return['code'] = 401;
        $return['message'] = "Could not find playlist details";
        return;
    }

    $playlistData = $playlistResults->fetch_assoc();
    $playlist_html = buildPlaylistHtml($songResults, $playlistData);

    $songs_sql = "SELECT * FROM dwekesa1.P_Contains_S as ps_join JOIN dwekesa1.Song as song ON ps_join.song_id = song.song_id " .
        "WHERE ps_join.playlist_id = " . $id;
    $songsResults = mysqli_query($conn, $songs_sql);
    $songs = array();
    $artists = array();
    while ($row = $songsResults->fetch_assoc()) {
        $songs[] = $row['song_id'];
        $artists[] = $row['artist_id'];
    }

    if (count($songs) > 0) {
        $songs = array_unique($songs);
        $artists = array_unique($artists);

        $songs_by_artists_sql = "SELECT * FROM dwekesa1.Song WHERE song_id NOT IN (" . implode(', ', $songs) .  ") AND artist_id IN (" . implode(", ", $artists) . ")";
        $songsByArtistsResults = mysqli_query($conn, $songs_by_artists_sql);
        $songs_by_artists_html = buildSongsByArtistsHtml($songsByArtistsResults);
    }


    $return['code'] = 200;
    $return['playlist_html'] = $playlist_html;
    $return['songs_by_artists_html'] = $songs_by_artists_html;

    return;
}

function buildPlaylistHtml($songResults, $playlistData)
{
    $runtime = 0;
    $count = 0;

    $tablehtml = '<div class="row table-wrapper-scroll-y my-custom-scrollbar" style="height: 79%; width: 80%;">';
    $tablehtml .= '<table>';
    $tablehtml .= '<thead>';
    $tablehtml .= '<th>#</th>';
    $tablehtml .= '<th>Title</th>';
    $tablehtml .= '<th style="width: 25px;">Playtime</th>';
    $tablehtml .= '<th style="width: 25px;"></th>';
    $tablehtml .= '</thead>';
    $tablehtml .= '<tbody>';
    while ($row = $songResults->fetch_assoc()) {
        $count++;
        if ($row != NULL) {
            $runtime += $row['runtime'];
            $tablehtml .= '<tr>';
            $tablehtml .= '<td>' . $count . '</td>';
            $tablehtml .= '<td>';
            $tablehtml .= '<div class="row song-title">';
            $tablehtml .= $row['song_name'];
            $tablehtml .= '</div>';
            $tablehtml .= '<div class="row album-name">';
            $tablehtml .= $row['artist_name'] . ' - ' . $row['album_name'];
            $tablehtml .= '</div>';
            $tablehtml .= '</td>';
            $minutes = floor($row['runtime']);
            $seconds = sprintf('%02d', ceil(($row['runtime'] - $minutes) * 60));
            $tablehtml .= '<td>' . $minutes . ":" . $seconds . '</td>';
            $tablehtml .= '<td style="cursor:pointer;" onclick="playSong(' . $row['song_id'] . ')"><i class="fas fa-play"></i></td>';
            $tablehtml .= '</tr>';
        }
    }

    while ($count < 9) {
        $tablehtml .= '<tr>';
        $tablehtml .= '<td></td>';
        $tablehtml .= '<td>';
        $tablehtml .= '<div class="row song-title">';
        $tablehtml .= '&nbsp;';
        $tablehtml .= '</div>';
        $tablehtml .= '<div class="row album-name">';
        $tablehtml .= '&nbsp;';
        $tablehtml .= '</div>';
        $tablehtml .= '</td>';
        $tablehtml .= '<td></td>';
        $tablehtml .= '<td></td>';
        $tablehtml .= '</tr>';
        $count++;
    }
    $tablehtml .= '</table>';
    $tablehtml .= '</div>';

    $album_html = "";
    $album_html .= '<div class="row" style="height: 20%">';
    $album_html .= '<div class="col-2 d-flex">';
    $album_html .= '<img src="../img/music-note-list.svg" alt="You\'re Welcome" style="height: 100%" />';
    $album_html .= '</div>';
    $album_html .= '<div class="col">';
    $album_html .= '<div class="row">';
    $album_html .= '<label>Playlist</label>';
    $album_html .= '</div>';
    $album_html .= '<div class="row header-song-title">';
    $album_html .= '<h1>' . $playlistData['name'] . '</h1>';
    $album_html .= '</div>';
    $album_html .= '<div class="row">';
    $album_html .= '<div class="col">';
    $album_html .= $playlistData['username'];
    $album_html .= '</div>';
    $album_html .= '<div class="col">';
    $album_html .= $playlistData['time_stamp'];
    $album_html .= '</div>';
    $album_html .= '<div class="col">';
    $minutes = floor($runtime);
    $seconds = sprintf('%02d', ceil(($runtime - $minutes) * 60));
    $album_html .= $songResults->num_rows . " Songs, " . $minutes . ":" . $seconds;
    $album_html .= '</div>';
    $album_html .= '<div class="col-8">';
    $album_html .= '</div>';
    $album_html .= '</div>';
    $album_html .= '</div>';
    $album_html .= '</div>';
    $album_html .= $tablehtml;

    return $album_html;
}

function buildSongsByArtistsHtml($results)
{
    $count = 0;
    $carousel = '<div class="carousel-item active">';
    $carousel .= '<div class="cards-wrapper">';
    while ($row = $results->fetch_assoc()) {
        if ($count % 7 == 6) {
            $carousel .= '</div>';
            $carousel .= '</div>';
            $carousel .= '<div class="carousel-item">';
            $carousel .= '<div class="cards-wrapper">';
        }
        $carousel .= '<div class="card" onclick="location.href=\'../html/album.php?song_id=' . $row['song_id'] . '\'">';
        $carousel .= '<img src="../img/music-note-list.svg" class="card-img-top" alt="' .
            $row['name'] . '">';
        $carousel .= '<div class="card-body">';
        $carousel .= '<h5 class="card-title">' . $row['name'] . '</h5>';
        $carousel .= '</div>';
        $carousel .= '</div>';
        $count++;
    }
    $carousel .= "</div>";
    $carousel .= "</div>";

    return $carousel;
}

function buildArtistHtml($results)
{
}

function buildReArtistsHtml($results)
{
}