<?php include("path.php"); 
      include("app/controllers/topics.php");
      $post = selectPostFromPostsWithUsersOnSingle('posts', 'users', $_GET['post']);

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SinglePage</title>
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
        <div class="main-content col-md-9 col-12">
          <h2><?=$post['title']; ?></h2>

          <div class="single_post row">
              <div class="img col-12">
                <img src="<?=BASE_URL . '/assets/images/posts/' . $post['img']; ?>" alt="<?=$post['title'];?>" class="img-thumbnail">
              </div>
              <div class="info">
                <i class="far fa-user"> <?=$post['username'];?></i>
                <i class="far fa-calendar"> <?=$post['created_date'];?></i>
              </div>
              <div class="single_post_text col-12">
                <?=$post['content']; ?>
              </div>

              <!-- Подключение комментариев -->
              <?php include("app/include/comments.php"); ?>
          </div>

        </div>

        <!-- Sidebar Content -->
        <div class="sidebar col-md-3 col-12">

          <div class="section search">
            <h3>Поиск</h3>
            <form action="/" method="post">
              <input type="text" name="search-term" class="text-input" placeholder="Введите искомое слово...">
            </form>
          </div>

          <div class="section topics">
            <h3>Категории</h3>
            <ul>
              <?php foreach ($topics as $key => $topic): ?>
                <li><a href="<?=BASE_URL . '/category.php?id=' . $topic['id'];?>"><?=$topic['name'];?></a></li>
              <?php endforeach; ?>
            </ul>
          </div>

        </div>
      </div>
    </div>

    <!-- Footer -->
    <?php include("app/include/footer.php"); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>
