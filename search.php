<?php include("path.php"); 
      include(SITE_ROOT . "/app/database/db.php"); 

      if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search-term'])) {
        $posts = searchInTitleAndContent($_POST['search-term'], 'posts', 'users');
      }
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

    <?php include("app/include/header.php"); ?>

    <!-- Block main -->
    <div class="container">
      <div class="content row">
        <!-- Main Content -->
        <div class="main-content col-12">
          <h2>Результаты поиска</h2>

          <?php if ($posts == null):?>
            
            <h3>Ничего не найдено. Попробуйте поискать снова...</h3>
            <!-- Sidebar Content -->
            <div class="sidebar col-12">

              <div class="section search">
                <h3>Поиск</h3>
                <form action="search.php" method="post">
                  <input type="text" name="search-term" class="text-input" placeholder="Введите искомое слово...">
                </form>
              </div>

            </div>
          <?php else: ?>

            <?php foreach ($posts as $post): ?>
              <div class="post row">
                  <div class="img col-12 col-md-4">
                    <img src="<?=BASE_URL . '/assets/images/posts/' . $post['img']; ?>" alt="<?=$post['title'];?>" class="img-thumbnail">
                  </div>
                  <div class="post_text col-12 col-md-8">
                    <h3>
                      <a href="<?=BASE_URL . '/single.php?post=' . $post['id'];?>">
                        <?php if (strlen($post['title']) < 120): ?>
                          <?=$post['title'];?>
                        <?php else: ?>
                          <?=mb_substr($post['title'], 0, 120, 'UTF-8') . "...";?>
                        <?php endif; ?>
                      </a>
                    </h3>
                    <i class="far fa-user"> <?=$post['username'];?></i>
                    <i class="far fa-calendar"> <?=$post['created_date'];?></i>
                    <p class="preview-text">
                      <?php if (strlen($post['content']) < 150): ?>
                        <?=$post['content'];?>
                      <?php else: ?>
                        <?=mb_substr($post['content'], 0, 150, 'UTF-8') . "...";?>
                      <?php endif; ?>
                    </p>
                  </div>
              </div>
            <?php endforeach; ?>

          <?php endif; ?>

        </div>

      </div>
    </div>

    <!-- Footer -->
    <?php include("app/include/footer.php"); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>
