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

    $id_book = $_POST['id_book'];
    $id_review = $_POST['id_review'];

    $conn = pg_connect("host=".DB_SERVER." port=5432 dbname=".DB_DATABASE." user=".DB_USERNAME." password=".DB_PASSWORD);

    if (!$conn) {
      echo "An error occurred.\n";
      exit;
    }

    $query_book = pg_query($conn, "SELECT * FROM books WHERE id_book=$id_book");
    $query_review = pg_query($conn, "SELECT * FROM reviews WHERE id_review=$id_review");
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

    <?php
    $book = pg_fetch_row($query_book);
    $review = pg_fetch_row($query_review);
    echo '<h1>Title: '.$book[0].'</h1><br>
          <h1>Authors: '.$book[4].'</h1>
          <h1>Stars: '.$review[2].'</h1><br>
          <br>';
    ?>

    <?php
    echo'
    <form method="post" action="./book-modify.php">
      <input type="hidden" name="query_book" value="'.$book[3].'">
      <input type="hidden" name="query_review" value="'.$review[0].'">
      <button type="submit" class="btn btn-primary">Modify</button>
    </form>';
    ?>

    <a class="btn btn-primary" href="./books.php" role="button">Back</a>
  </body>
</html>
