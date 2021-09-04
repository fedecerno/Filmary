<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
  </head>
  <body>
    <?php

    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);

    session_start();
    $id_user = $_SESSION['id_user'];

    ?>

    <form method='post' action='./add-book-logic.php'>
      <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name='title' required>
      </div>
      <div class="mb-3">
        <label for="authors" class="form-label">Authors</label>
        <input type="text" class="form-control" id="authors" name='authors' value="" aria-describedby="authorslHelp">
        <div id="authorslHelp" class="form-text">Put a comma after each authors.</div>
      </div>
      <div class="mb-3">
        <label for="characters" class="form-label">Characters</label>
        <input type="text" class="form-control" id="characters" name='characters' value="" aria-describedby="characterslHelp">
        <div id="charactersHelp" class="form-text">Put a comma after each character.</div>
      </div>
      <div class="mb-3">
        <label for="publishing-house" class="form-label">Publishing House</label>
        <input type="publishing-house" class="form-control" id="publishing-house" value="" name='publishing-house'>
      </div>
      <div class="mb-3">
        <label for="year" class="form-label">Year</label>
        <input type="number" class="form-control" id="year" name='year'>
      </div>
      <div class="mb-3">
        <label for="genres" class="form-label">Genres</label>
        <input type="text" class="form-control" id="genres" name='genres' value="" aria-describedby="genresHelp">
        <div id="genresHelp" class="form-text">Put a comma after each genres.</div>
      </div>
      <div class="mb-3">
        <label for="stars" class="form-label">Stars</label>
        <input type="range" class="form-range" id="stars" name='stars' aria-describedby="starsHelp" min="1" max="5" step="1" required>
        <div id="starssHelp" class="form-text">From 1 to 5.</div>
      </div>
      <div class="mb-3">
        <label for="review" class="form-label">Review</label>
        <textarea class="form-control" id="review" rows="3" value=""></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Add Book</button>
    </form>

    <a class="btn btn-primary" href="./personalPage.php" role="button">Cancel</a>

  </body>
</html>
