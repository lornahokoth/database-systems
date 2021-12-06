<link href="../css/mediacontrols.css" rel="stylesheet" />
<link href="../css/icono.min.css" rel="stylesheet" />

<footer class="text-white bg-dark">
    <div style="height: 100%;" class="d-flex justify-content-center">
        <div id="mediacontrols" class="audio-player align-self-center">
            <div class="timeline">
                <div class="progress"></div>
            </div>
            <div class="controls">
                <div class="play-container">
                    <div id="playbtn" class="toggle-play play">
                    </div>
                </div>
                <div class="time">
                    <div class="current">0:00</div>
                    <div class="divider">/</div>
                    <div class="length"></div>
                </div>
                <div id="song_name" class="name"></div>
                <!--     credit for icon to https://saeedalipoor.github.io/icono/ -->
                <div class="volume-container">
                    <div class="volume-button">
                        <div class="volume icono-volumeMedium"></div>
                    </div>

                    <div class="volume-slider">
                        <div class="volume-percentage"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="../js/player.js"></script>
<script>
    $(document).ready(function() {
        last_seg = window.location.pathname.split('/').pop();
        if (last_seg == 'login.php') {
            $('#mediacontrols').addClass('d-none');
        } else {
            $('#mediacontrols').removeClass('d-none');
        }
    });
</script>