<?php 
  session_start();
  
  include("../../path.php"); 
  include("../../app/controllers/users.php");
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/89dd47beb4.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../../assets/css/admin.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  </head>
  <body>

    <?php include("../../app/include/header-admin.php"); ?>

    <div class="container">
      <div class="row">
        <?php include("../../app/include/sidebar-admin.php"); ?>  
        
        <div class="posts col-9">
            <div class="button row">
                <a href="<?php echo BASE_URL . "/admin/users/create.php"; ?>" class="col-2 btn btn-success">Создать</a>
                <span class="col-1"></span>
                <a href="<?php echo BASE_URL . "/admin/users/index.php"; ?>" class="col-3 btn btn-warning">Управление</a>
            </div>

          <div class="row title-table">
            <h2>Редактировать пользователя</h2>
          </div>

          <div class="row add-post">
            <div class="mb-12 col-12 col-md-12 err">
              <!-- Вывод ошибок с массива -->
              <?php include("../../app/helps/errorInfo.php"); ?>  
            </div>
            <form action="edit.php" method="post">
                <input type="hidden" name="id" value="<?=$id; ?>">
                <div class="col">
                    <label for="formGroupExampleInput" class="form-label">Ваш логин</label>
                    <input type="text" class="form-control" value="<?=$username;?>" id="formGroupExampleInput" placeholder="введите ваш логин..." name="login">
                </div>
                <div class="col">
                    <label for="exampleInputEmail1" class="form-label">Email(Только просмотр)</label>
                    <input type="email" readonly class="form-control" value="<?=$email;?>" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="введите ваш email..." name="email">
                </div>
                <div class="col">
                    <label for="exampleInputPassword1" class="form-label">Сбросить пароль</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="введите ваш пароль..." name="passwordFirst">
                </div>
                <div class="col">
                    <label for="exampleInputPassword2" class="form-label">Повторите пароль</label>
                    <input type="password" class="form-control" id="exampleInputPassword2" placeholder="повторите ваш пароль..." name="passwordSecond">
                </div>
                <div class="form-check mb-2">
                  <?php if ($admin == 1): ?>
                    <input name="admin" class="form-check-input" type="checkbox" value="1" id="flexCheckChecked" checked>
                  <?php else: ?>
                    <input name="admin" class="form-check-input" type="checkbox" value="1" id="flexCheckChecked">
                  <?php endif; ?>
                  <label class="form-check-label" for="flexCheckChecked">
                    Admin
                  </label>
                </div>
                <div class="col">
                    <button name="btnUpdateUser" class="btn btn-primary" type="submit">Обновить</button>
                </div>
            </form>
          </div>
          
        </div>

      </div>
    </div>

    <!-- Footer -->
    <?php include("../../app/include/footer.php"); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>
