<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
  </head>
  <body>

    <form method='post' action='./changePassword.php'>
      <div class="mb-3">
        <label for="oldPassword" class="form-label">Old Password</label>
        <input type="password" class="form-control" id="oldPassword" name='oldPassword' required>
      </div>
      <div class="mb-3">
        <label for="newPassword" class="form-label">New Password</label>
        <input type="password" class="form-control" id="newPassword" name='newPassword' required>
      </div>
      <div class="mb-3">
        <label for="confirmedPassword" class="form-label">Confirmed Password</label>
        <input type="password" class="form-control" id="confirmedPassword" name='confirmedPassword' required>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <a class="btn btn-primary" href="./personalPage.php" role="button">Cancel</a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

  </body>
</html>
