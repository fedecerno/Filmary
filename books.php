<?php
include "../inc/dbinfo.inc";
?>
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

    $conn = pg_connect("host=".DB_SERVER." port=5432 dbname=".DB_DATABASE." user=".DB_USERNAME." password=".DB_PASSWORD);

    if (!$conn) {
      echo "An error occurred.\n";
      exit;
    }

    $books = pg_query($conn, "SELECT b.title, b.year, b.author, b.genre, b.id_book FROM books b, final f WHERE b.id_book=f.id_book AND f.id_user=$id_user ORDER BY b.id_book DESC LIMIT 5");
    $stars = pg_query($conn, "SELECT r.stars, r.id_review FROM reviews r, final f WHERE r.id_review=f.id_review AND f.id_user=$id_user ORDER BY r.id_review DESC LIMIT 5");
    ?>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="./index.php">Filmary</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="./about-us.php">About Us</a>
            </li>
          </ul>
        </div>
        <a class="btn btn-primary" href="./personal-area.php" role="button">Personal Area</a>
      </div>
    </nav>

    <form method='post' action='./books-search.php'>
      <input class="form-control" type="text" placeholder="E.g. Don Quixote" name="search" id="search" aria-label="default input example" required>
      <select class="form-select" aria-label="Default select example" name="filter" id="filter" required>
        <option value="title">Title</option>
        <option value="author">Authors</option>
        <option value="characters">Characters</option>
        <option value="publishing_house">Publishing House</option>
        <option value="year">Year</option>
        <option value="genre">Genres</option>
      </select>
      <button type="submit" class="btn btn-primary">Search</button>
    </form>

    <table class="table">
      <thead>
        <tr>
          <th scope="col">Title</th>
          <th scope="col">Authors</th>
          <th scope="col">Year</th>
          <th scope="col">Genre</th>
          <th scope="col">Stars</th>
          <th scope="col">Book's Page</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row_book = pg_fetch_row($books)) {
            $row_stars = pg_fetch_row($stars);
            echo '<tr>
                  <th scope="row">'.$row_book[0].'</th>
                  <td>'.$row_book[2].'</td>
                  <td>'.$row_book[1].'</td>
                  <td>'.$row_book[3].'</td>
                  <td>'.$row_stars[0].'</td>
                  <td><form method="post" action="./book-page.php">
                    <input type="hidden" name="id_book" value="'.$row_book[4].'">
                    <input type="hidden" name="id_review" value="'.$row_stars[1].'">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form></td>
                </tr>';
                } ?>
      </tbody>
    </table>

    <a class="btn btn-primary" href="./add-book.php" role="button">Add Book</a>
    <a class="btn btn-primary" href="./personalPage.php" role="button">Back</a>
  </body>
</html>
