<?php

include "../inc/dbinfo.inc";

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

session_start();
$id_user = $_SESSION['id_user'];

if (isset($_POST['title'])) {
  $conn = pg_connect("host=".DB_SERVER." port=5432 dbname=".DB_DATABASE." user=".DB_USERNAME." password=".DB_PASSWORD);

  if (!$conn) {
    echo "An error occurred.\n";
    exit;
  }

  $title = $_POST['title'];
  $authors = $_POST['authors'];
  $characters = $_POST['characters'];
  $publishing_house = $_POST['publishing_house'];
  $year = 0000;
  $genres = $_POST['genres'];
  $stars = $_POST['stars'];
  $review = $_POST['review'];

  $insert_book = pg_query($conn, "INSERT into books (title, author, characters, publishing_house, year, genre) VALUES ('$title', '$authors', '$characters', '$publishing_house', '$year', '$genres')");
  $insert_review = pg_query($conn, "INSERT into reviews (review, stars, when_date) VALUES ('$review', '$stars', CURRENT_TIMESTAMP(0))");
  $id_book_query = pg_query($conn, "SELECT id_book FROM books ORDER BY id_book DESC LIMIT 1");
  $id_review_query = pg_query($conn, "SELECT id_review FROM reviews ORDER BY id_review DESC LIMIT 1");
  $id_book = pg_fetch_row($id_book_query);
  $id_review = pg_fetch_row($id_review_query);
  $id_book = $id_book[0];
  $id_review = $id_review[0];
  $insert_final = pg_query($conn, "INSERT into final (id_user, id_book, id_review) VALUES ('$id_user', '$id_book', '$id_review')");

  header("Location: personalPage.php");
  exit;
}
else{
  echo "NOPE";
}
#$email = $_POST['email'];
#$password = $_POST['password'];

#$conn = pg_connect("host=".DB_SERVER." port=5432 dbname=".DB_DATABASE." user=".DB_USERNAME." password=".DB_PASSWORD);

#$query = pg_query($conn, "SELECT * FROM users WHERE email=$email");

#echo "$query['password']";
 ?>
