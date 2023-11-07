<?php
    // контроллер
    include_once(SITE_ROOT . "/app/database/db.php");

    $commentsForAdm = selectAll("comments");
    $page = isset($_GET['post']) ? $_GET['post'] : 0;
    $email = '';
    $comment = '';
    $errMsg = [];
    $status = 0;
    $comments = [];

    // Код создания комментария
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['goComment'])) {

        $email = trim($_POST["email"]);
        $comment = trim($_POST["comment"]);
    
        if ($email === '' || $comment === '') {
            array_push($errMsg, "Не все поля заполнены!");
        }elseif(mb_strlen($comment, 'UTF8') <= 50) {
            array_push($errMsg, "Комментарий должен быть длиннее 50-ти символов.");
        }else {

            $user = selectOne('users', ['email' => $email]);

            if($user['email'] == $email) {
                $status = 1;
            }

            $comment = [
                "status" => $status,
                "page" => $page,
                "email" => $email,
                "comment" => $comment,
            ];

            $comment = insert("comments", $comment);
            $comments = selectAll("comments", ['page' => $page, 'status' => 1]);
        }

    }else {
        $email = '';
        $comment = '';
        $comments = selectAll("comments", ['page' => $page, 'status' => 1]);
    }

    // Удаление комментария
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete_id'])) {
        $id = $_GET['delete_id'];
        delete('comments', $id);
        header('location: ' . BASE_URL . '/admin/comments/index.php');
    }

    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['publish_id'])) {
        $id = $_GET['publish_id'];
        $publish = $_GET['publish'];
        
        $postId = update('comments', $id, ['status' => $publish]);

        header('location: ' . BASE_URL . '/admin/comments/index.php');
        exit();
    }

    // Редактирование комментария
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
        $id = $_GET['id'];
        $comment = selectOne("comments", ['id' => $id]);
        
        $id = $comment['id'];
        $email = $comment['email'];
        $content = $comment['comment'];
        $publish = $comment['status'];
    }

     // Код обновления комментария
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnEditComment'])) {
        $id = trim($_POST["id"]);
        $content = trim($_POST["content"]);

        if (isset($_POST["publish"])) {
            $publish = 1;
        }else {
            $publish = 0;
        }
    
        if ($content === '') {
            array_push($errMsg, "Комментарий не имеет содержимого текста!");
        }elseif(mb_strlen($content, 'UTF8') <= 50) {
            array_push($errMsg, "Текст комментария должен быть больше 50-ти символов.");
        }else {
            $comment = [
                "comment" => $content,
                "status" => $publish
            ];

            $id = update("comments", $id, $comment);
            header('location: ' . BASE_URL . '/admin/comments/index.php');
        }
    
    }