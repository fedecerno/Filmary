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

    $id_book = $_POST['query_book'];
    $id_review = $_POST['query_review'];

    $query_book = pg_query($conn, "SELECT * FROM books WHERE id_book=$id_book");
    $query_review = pg_query($conn, "SELECT * FROM reviews WHERE id_review=$id_review");

    $book = pg_fetch_row($query_book);
    $review = pg_fetch_row($query_review);
    ?>

    <?php
    echo'
    <form method="post" action="./book-modify-logic.php">
      <div class="mb-3">
        <label for="oldPassword" class="form-label">Title</label>
        <input type="text" class="form-control" id="Title" name="Title" value="'.$book[0].'" required>
        <input type="hidden" class="form-control" id="id_book" name="id_book" value="'.$book[3].'">
      </div>
      <button type="submit" class="btn btn-primary">Modify</button>
    </form>';
    ?>

    <a class="btn btn-primary" href="./personalPage.php" role="button">Cancel</a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

  </body>
</html>
