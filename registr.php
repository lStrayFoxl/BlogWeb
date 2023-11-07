<?php 
  include("path.php"); 
  include("app/controllers/users.php");
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/89dd47beb4.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="assets/css/style.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  </head>
  <body>

    <!-- Header -->
    <?php include("app/include/header.php"); ?>

    <!-- Form registration -->
    <div class="container registr_form">
      <form class="row justify-content-md-center" method="post" action="registr.php">
        <h2>Форма регистрации</h2>
        <!-- TODO: Устарел вывод надо будет поменять, как будет время -->
        <!-- <div class="mb-3 col-12 col-md-4 err">
          <p><?=$errMsg?></p>
        </div> -->
        <div class="w100"></div>
        <div class="mb-3 col-12 col-md-4">
          <label for="formGroupExampleInput" class="form-label">Ваш логин</label>
          <input type="text" class="form-control" value="<?=$login?>" id="formGroupExampleInput" placeholder="введите ваш логин..." name="login">
        </div>
        <div class="w100"></div>
        <div class="mb-3 col-12 col-md-4">
          <label for="exampleInputEmail1" class="form-label">Email</label>
          <input type="email" class="form-control" value="<?=$email?>" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="введите ваш email..." name="email">
          <div id="emailHelp" class="form-text">Ваш email адрес не будет использован для спама!</div>
        </div>
        <div class="w100"></div>
        <div class="mb-3 col-12 col-md-4">
          <label for="exampleInputPassword1" class="form-label">Пароль</label>
          <input type="password" class="form-control" id="exampleInputPassword1" placeholder="введите ваш пароль..." name="passwordFirst">
        </div>
        <div class="w100"></div>
        <div class="mb-3 col-12 col-md-4">
          <label for="exampleInputPassword2" class="form-label">Повторите пароль</label>
          <input type="password" class="form-control" id="exampleInputPassword2" placeholder="повторите ваш пароль..." name="passwordSecond">
        </div>
        <div class="w100"></div>
        <div class="mb-3 col-12 col-md-4">
          <button type="submit" class="btn btn-secondary" name="btnReg">Регистрация</button>
          <a href="log.php">Войти</a>
        </div>
      </form>
    </div>

    <!-- Footer -->
    <?php include("app/include/footer.php"); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>
