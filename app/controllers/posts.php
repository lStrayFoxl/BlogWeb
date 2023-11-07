<?php
    include(SITE_ROOT . "/app/database/db.php");
    if (!$_SESSION) {
        header('location: ' . BASE_URL . 'log.php');
    }

    $errMsg = [];
    $id = '';
    $title = '';
    $content = '';
    $img = '';
    $topic = '';
    $topics = selectAll('topics');
    $posts = selectAll('posts');
    $postsADM = selectAllFromPostsWithUsers('posts', 'users');


    // Код создания записи
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnAddPost'])) {

        include("../../app/helps/validationImage.php");

        $title = trim($_POST["title"]);
        $content = trim($_POST["content"]);
        $topic = trim($_POST["topic"]);

        if (isset($_POST["publish"])) {
            $publish = 1;
        }else {
            $publish = 0;
        }
    
        if ($title === '' || $content === '' || $topic === "") {
            array_push($errMsg, "Не все поля заполнены!");

        }elseif(mb_strlen($title, 'UTF8') <= 7) {
            array_push($errMsg, "Название должно быть больше 7-ми символов.");
        }else {
            $post = [
                "id_user" => $_SESSION['id'],
                "title" => $title,
                "content" => $content,
                "img" => $_POST['img'],
                "status" => $publish,
                "id_topic" => $topic
            ];

            $id = insert("posts", $post);
            $topic = selectOne("posts", ['id' => $id]);
            header('location: ' . BASE_URL . '/admin/posts/index.php');
        }

    }else {
        $id = '';
        $title = '';
        $content = '';
        $publish = '';
        $topic = '';
    }

    // Редактирование статьи
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
        $id = $_GET['id'];
        $post = selectOne("posts", ['id' => $id]);
        
        $id = $post['id'];
        $title = $post['title'];
        $content = $post['content'];
        $topic = $post['id_topic'];
        $publish = $post['status'];
    }

     // Код обновления поста
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnEditPost'])) {
        $id = trim($_POST["id"]);
        $title = trim($_POST["title"]);
        $content = trim($_POST["content"]);
        $topic = trim($_POST["topic"]);

        if (isset($_POST["publish"])) {
            $publish = 1;
        }else {
            $publish = 0;
        }

        include("../../app/helps/validationImage.php");
    
        if ($title === '' || $content === '' || $topic === "") {
            array_push($errMsg, "Не все поля заполнены!");
        }elseif(mb_strlen($title, 'UTF8') <= 7) {
            array_push($errMsg, "Название должно быть больше 7-ми символов.");
        }else {
            $post = [
                "id_user" => $_SESSION['id'],
                "title" => $title,
                "content" => $content,
                "img" => $_POST['img'],
                "status" => $publish,
                "id_topic" => $topic
            ];

            $id = update("posts", $id, $post);
            header('location: ' . BASE_URL . '/admin/posts/index.php');
        }
    
    }

    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['publish_id'])) {
        $id = $_GET['publish_id'];
        $publish = $_GET['publish'];
        
        $postId = update('posts', $id, ['status' => $publish]);

        header('location: ' . BASE_URL . '/admin/posts/index.php');
        exit();
    }
    
    // Удаление статьи
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete_id'])) {
        $id = $_GET['delete_id'];
        delete('posts', $id);
        header('location: ' . BASE_URL . '/admin/posts/index.php');
    }