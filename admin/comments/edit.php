<?php 
  include("../../path.php");
  include("../../app/controllers/commentaries.php");
?>

<!doctype html>
<html lang="ru ">
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

          <div class="row title-table">
            <h2>Редактирование комментария</h2>
          </div>

          <div class="row add-post">
            <div class="mb-12 col-12 col-md-12 err">
              <!-- Вывод ошибок с массива -->
              <?php include("../../app/helps/errorInfo.php"); ?>  
            </div>
            <form action="edit.php" method="post">
                <input type="hidden" name="id" value="<?=$id; ?>">
                <div class="col mb-4">
                    <input value="<?=$email; ?>" name="email" type="text" class="form-control" placeholder="Email" aria-label="Email пользователя" disabled>
                </div>
                <div class="col">
                    <label for="editor" class="form-label">Комментарий</label>
                    <textarea name="content" class="form-control" id="editor" rows="6"><?=$content; ?></textarea>
                </div>

                <div class="form-check mb-2">
                    <?php if (empty($publish) && $publish == 0): ?>
                        <input name="publish" class="form-check-input" type="checkbox" id="flexCheckChecked">
                        <label class="form-check-label" for="flexCheckChecked">
                            Publish
                        </label>
                    <?php else: ?>
                        <input name="publish" class="form-check-input" type="checkbox" id="flexCheckChecked" checked>
                        <label class="form-check-label" for="flexCheckChecked">
                            Publish
                        </label>
                    <?php endif; ?>
                </div>

                <div class="col col-6">
                    <button name="btnEditComment" class="btn btn-primary" type="submit">Сохранить запись</button>
                </div>
            </form>
          </div>
          
        </div>

      </div>
    </div>

    <!-- Footer -->
    <?php include("../../app/include/footer.php"); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <!-- Добавление визуального редактора к текстовому полю админки -->
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
    <script src="../../assets/js/scripts.js"></script>
  </body>
</html>
