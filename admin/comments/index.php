<?php
  include("../../path.php"); 
  include("../../app/controllers/commentaries.php");
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

          <div class="row title-table">
            <h2>Управление комментариями</h2>
            <div class="col-1">ID</div>
            <div class="col-5">Текст</div>
            <div class="col-2">Автор</div>
            <div class="col-4">Управление</div>
          </div>

          <?php foreach ($commentsForAdm as $key => $comment): ?>
            <div class="row post">
              <div class="id col-1"><?= $comment['id']; ?></div>
              <div class="title col-5">
                <?php if (strlen($comment['comment']) < 20): ?>
                  <?=$comment['comment'];?>
                <?php else: ?>
                  <?=mb_substr($comment['comment'], 0, 20, 'UTF-8') . "...";?>
                <?php endif; ?>
              </div>

              <?php
                $user = $comment['email'];
                $user = explode('@', $user);
                $user = $user[0];
              ?>
              <div class="author col-2"><?= $user . "@"; ?></div>
              <div class="red col-1"><a href="edit.php?id=<?=$comment['id']; ?>">edit</a></div>
              <div class="del col-1"><a href="edit.php?delete_id=<?=$comment['id']; ?>">delete</a></div>

              <?php if ($comment['status']): ?>
                <div class="status col-2"><a href="edit.php?publish=0&publish_id=<?=$comment['id']; ?>">unpublich</a></div>
              <?php else: ?>
                <div class="status col-2"><a href="edit.php?publish=1&publish_id=<?=$comment['id']; ?>">publish</a></div>
              <?php endif; ?>

            </div>
          <?php endforeach; ?>

        </div>
      </div>
    </div>

    <!-- Footer -->
    <?php include("../../app/include/footer.php"); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>
