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

function search()
{
    global $return;
    $return = array();
    $return['song_html'] = "";
    $return['album_html'] = "";
    $return['artist_html'] = "";
    $return['playlist_html'] = "";
    if (empty($_POST['search_string'])) {
        $return['code'] = 401;
        $return['message'] = "Invalid Data";
        return;
    }

    $search_string = $_POST['search_string'];
    $conn = dbconnect();
    $return['code'] = 200;
    $return['song_html'] = song_search($conn, $search_string);
    $return['album_html'] = album_search($conn, $search_string);
    $return['artist_html'] = artist_search($conn, $search_string);
    $return['playlist_html'] = playlist_search($conn, $search_string);

    return;
}

function song_search($conn, $search_string)
{
    $song_sql = "(SELECT 
                      song.song_id as song_id, song.name as song_name, artist.artist_id as artist_id, artist.name as artist_name, song.runtime as runtime
                  FROM
                      dwekesa1.Song AS song
                      JOIN dwekesa1.Artist AS artist ON song.artist_id = artist.artist_id
                  WHERE
                      song.name like '%" . $search_string . "%')
                  union
                  (SELECT 
                      song.song_id as song_id, song.name as song_name, artist.artist_id as artist_id, artist.name as artist_name, song.runtime as runtime
                  FROM
                      dwekesa1.Song AS song
                      join dwekesa1.Artist AS artist on song.artist_id = artist.artist_id
                  WHERE
                      song.genre like '%" . $search_string . "%');";
    $songResults = mysqli_query($conn, $song_sql);

    $song_html = '';
    $song_html .= '<table style="width: 90%;">';
    $song_html .= '<thead>';
    $song_html .= '<th>Name</th>';
    $song_html .= '<th>Artist</th>';
    $song_html .= '<th>Playtime</th>';
    $song_html .= '</thead>';
    $song_html .= '<tbody>';

    while($row = $songResults->fetch_assoc()) {
        $song_html .= '<tr>';
        $song_html .= '<td><a href="../html/album.php?song_id=' . $row['song_id'] . '">' . $row['song_name'] . '</a></td>';
        $song_html .= '<td><a href="../html/artist.php?artist_id=' . $row['artist_id'] . '">' . $row['artist_name'] . '</a></td>';
        $minutes = floor($row['runtime']);
        $seconds = sprintf('%02d', ceil(($row['runtime'] - $minutes) * 60));
        $song_html .= '<td>' . $minutes . ":" . $seconds . '</td>';
        $song_html .= '</tr>';
    }
    
    $song_html .= '</tbody>';
    $song_html .= '</table>';

    return $song_html;
}

function album_search($conn, $search_string)
{
    $album_sql = "SELECT 
                      album.album_id as album_id, album.album_name as album_name, artist.artist_id as artist_id, artist.name as artist_name
                  FROM
                      dwekesa1.Album AS album
                  JOIN dwekesa1.Artist AS artist ON album.artist_id = artist.artist_id
                  WHERE
                      album.album_name LIKE '%" . $search_string . "%';";

    $albumResults = mysqli_query($conn, $album_sql);
    $album_html = '';
    $album_html .= '<table style="width: 90%;">';
    $album_html .= '<thead>';
    $album_html .= '<th>Name</th>';
    $album_html .= '<th>Artist</th>';
    $album_html .= '</thead>';
    $album_html .= '<tbody>';
    while($row = $albumResults->fetch_assoc()) {
        $album_html .= '<tr>';
        $album_html .= '<td><a href="../html/album.php?album_id=' . $row['album_id'] . '">' . $row['album_name'] . '</a></td>';
        $album_html .= '<td><a href="../html/artist.php?artist_id=' . $row['artist_id'] . '">' . $row['artist_name'] . '</a></td>';
        $album_html .= '</tr>';
    }
    
    $album_html .= '</tbody>';
    $album_html .= '</table>';

    return $album_html;
}

function artist_search($conn, $search_string)
{
    $artist_sql = "SELECT 
                       artist.artist_id as artist_id, artist.name AS artist_name
                   FROM
                       dwekesa1.Artist AS artist
                   WHERE
                       artist.name LIKE '%" . $search_string . "%';";

    $artistResults = mysqli_query($conn, $artist_sql);
    $artist_html = '';
    $artist_html .= '<table style="width: 90%;">';
    $artist_html .= '<thead>';
    $artist_html .= '<th>Name</th>';
    $artist_html .= '</thead>';
    $artist_html .= '<tbody>';
    while($row = $artistResults->fetch_assoc()) {
        $artist_html .= '<tr>';
        $artist_html .= '<td><a href="../html/artist.php?artist_id=' . $row['artist_id'] . '">' . $row['artist_name'] . '</a></td>';
        $artist_html .= '</tr>';
    }

    $artist_html .= '</tbody>';
    $artist_html .= '</table>';

    return $artist_html;
}

function playlist_search($conn, $search_string)
{
    $playlist_sql = "SELECT 
                         playlist.playlist_id as playlist_id, playlist.name AS playlist_name, user.username as username
                     FROM
                         dwekesa1.Playlist AS playlist
                     join dwekesa1.Users As user on playlist.user_id = user.user_id
                     WHERE
                         playlist.name LIKE '%" . $search_string . "%';";

    $playlistResults = mysqli_query($conn, $playlist_sql);
    $playlist_html = '';
    $playlist_html .= '<table style="width: 90%;">';
    $playlist_html .= '<thead>';
    $playlist_html .= '<th>Name</th>';
    $playlist_html .= '</thead>';
    $playlist_html .= '<tbody>';
    while($row = $playlistResults->fetch_assoc()) {
        $playlist_html .= '<tr>';
        $playlist_html .= '<td><a href="../html/playlist.php?playlist_id=' . $row['playlist_id'] . '">' . $row['playlist_name'] . '</a></td>';
        $playlist_html .= '<td>' . $row['username'] . '</td>';
        $playlist_html .= '</tr>';
    }

    $playlist_html .= '</tbody>';
    $playlist_html .= '</table>';

    return $playlist_html;
}