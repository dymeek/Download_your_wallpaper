<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel administratora - wgraj plik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
<link rel="stylesheet" href="../css/style.css">
</head>
<body>

    <div class="container">
        <h2 class="text-center">Dodaj nową tapetę</h2>
        <form action="upload.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
            <label class="form-label">Kategoria:</label>
            <input class="form-control" type="text" name="fileCategory" id="fileCategory">
            </div>
            <div class="mb-3">
            <label class="form-label">Nazwa:</label>
            <input class="form-control" type="text" name="fileName" id="fileName">
            </div>
            <div class="mb-3">
            <labelclass="form-label">Rozdzielczość:</label>
            <input class="form-control" type="text" name="fileResolution" id="fileResolution">
            </div>
            <div class="mb-3">
            <labelclass="form-label">Waga zdjęcia:</label>
            <input class="form-control" type="text" name="fileWeight" id="fileWeight">
            </div>
            <div>
            <labelclass="form-label">Data dodania:</label>
            <input class="form-control" type="date" value="uploadDate" id="uploadDate">
            </div>
            <div>
            <labelclass="form-label">Opis:</label>
            <textarea class="form-control form-control-lg" id="formFileLg" type="file"></textarea>
            </div>
            <div>
            <label class="form-label">Wybierz plik do dodania:</label>
            <input class="form-control" type="file" name="fileToUpload" id="fileToUpload">
            <input class="btn btn-primary" type="submit" value="Dodaj">
            </div>
        </form>
    </div>
</body>
</html>