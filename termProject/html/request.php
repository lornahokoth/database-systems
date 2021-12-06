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
        <div class="flex-column d-flex " style="width: 90%">

            <Form class="align-self-center request">
                <h2> Request Form </h2>
                <div class="form-group">
                    <span> Send a request to Wavelength for an Artist you want to add!</span>
                </div>
                <div class="form-group">
                    <label for="artistInput">Artist</label>
                    <input type="input" class="form-control" id="artistInput" placeholder="Artist Name">
                </div>
                <div class="form-group">
                    <label for="genreInput">Genre</label>
                    <input type="input" class="form-control" id="genreInput" placeholder="Genre Name">
                </div>
                <div class="form-group">
                    <label for="descInput">Reason/Description</label>
                    <textarea class="form-control" id="descInput" rows="3"></textarea>
                </div>
                <button type="button" class="btn btn-primary" onclick="requestArtist()">Submit</button>
            </Form>
        </div>
    </main>
    <?php include("./footer.php"); ?>
    <script src="../js/jquery-3.6.0.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/wavelength.js"></script>
</body>

</html>