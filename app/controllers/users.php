<?php

include(SITE_ROOT . "/app/database/db.php");

function AuthUser($array) {
    $_SESSION['id'] = $array['id'];
    $_SESSION['login'] = $array['username'];
    $_SESSION['admin'] = $array['admin'];

    if($_SESSION['admin']){
        header('location: ' . BASE_URL . '/admin/posts/index.php');
    }else {
        header('location: ' . BASE_URL);
    }
}

$errMsg = [];
$users = selectAll('users');

// Код формы регистрации
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnReg'])) {
    $admin = 0;
    $login = trim($_POST["login"]);
    $email = trim($_POST["email"]);
    $passwordF = trim($_POST["passwordFirst"]);
    $passwordS = trim($_POST["passwordSecond"]);

    if ($login === '' || $email === '' || $passwordF === '') {
        $errMsg = 'Не все поля заполнены!';
    }elseif(mb_strlen($login, 'UTF8') <= 2) {
        $errMsg = 'Логин должен быть больше 2-х символов.';
    }elseif($passwordF !== $passwordS) {
        $errMsg = 'Пароль в обоих полях должны соответствовать.';
    }else {
        $existence = selectOne('users', ['email' => $email]);
        
        if(!empty($existence['email']) && $existence['email'] === $email) {
            $errMsg = 'Пользователь с такой почтой уже зарегистрирован!';
        }else{
            $pass = password_hash($passwordF, PASSWORD_DEFAULT);

            $post = [
                "admin" => $admin,
                "username" => $login,
                "email" => $email,
                "password" => $pass
            ];
    
            $id = insert("users", $post);
            $user = selectOne("users", ['id' => $id]);

            AuthUser($user);
        }

    }
}else {
    $login = '';
    $email = '';
}

// Код формы авторизации
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnLog'])) {
    $email = trim($_POST["email"]);
    $pass = trim($_POST["password"]);


    if ($email === '' || $pass === '') {
        $errMsg = 'Не все поля заполнены!';
    }else{
        $existence = selectOne('users', ['email' => $email]);

        if($existence && password_verify($pass, $existence['password'])) {
            AuthUser($existence);
        }else {
            $errMsg = 'Почта или пароль введены не верно!';
        }

        // Проверка на вход с тем же логином
        // $_SESSION['emailRepit'] = $existence['email'];


        // if($email === $_SESSION['emailRepit']) {
        //     if (!isset($_SESSION['countEnter'])) {
                
        //         if($existence && password_verify($pass, $existence['password'])) {
        //             unset($_SESSION['emailRepit']);
        //             unset($_SESSION['countEnter']);
        //             unset($_SESSION['time']);
        //             $time = 0;
        //             AuthUser($existence);
        //         }else {
        //             $errMsg = 'Почта или пароль введены не верно!';
        //             $_SESSION['countEnter'] = 1;
        //         }
                
        //     }else{
        //         $time = time();
        //         if ($_SESSION['countEnter'] >= 3) {
        //             if (!isset($_SESSION['time'])) {
        //                 $_SESSION['time'] = time() + 15;
        //             }

        //             if($time < $_SESSION['time']) {
        //                 $errMsg = "Ввод данных временно заблокирован";
        //             }else {
        //                 if($existence && password_verify($pass, $existence['password'])) {
        //                     unset($_SESSION['emailRepit']);
        //                     unset($_SESSION['countEnter']);
        //                     unset($_SESSION['time']);
        //                     $time = 0;
        //                     AuthUser($existence);
        //                 }else {
        //                     $errMsg = 'Почта или пароль введены не верно!';
        //                     $_SESSION['countEnter'] = 1;
        //                 }
        //             }
        //         }else{
        //             $_SESSION['countEnter']++;
        //             if($existence && password_verify($pass, $existence['password'])) {
        //                 unset($_SESSION['emailRepit']);
        //                 unset($_SESSION['countEnter']);
        //                 unset($_SESSION['time']);
        //                 $time = 0;
        //                 AuthUser($existence);
        //             }else {
        //                 $errMsg = 'Почта или пароль введены не верно!';
        //             }
        //         }
        //     }
        // }
            
        
    }
}else{
    $email = '';
}


// Код формы добавления пользователя в админке
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnAddUser'])) {
    $admin = 0;
    $login = trim($_POST["login"]);
    $email = trim($_POST["email"]);
    $passwordF = trim($_POST["passwordFirst"]);
    $passwordS = trim($_POST["passwordSecond"]);

    if ($login === '' || $email === '' || $passwordF === '') {
        array_push($errMsg, "Не все поля заполнены!");
    }elseif(mb_strlen($login, 'UTF8') <= 2) {
        array_push($errMsg, "Логин должен быть больше 2-х символов.");
    }elseif($passwordF !== $passwordS) {
        array_push($errMsg, "Пароль в обоих полях должны соответствовать.");
    }else {
        $existence = selectOne('users', ['email' => $email]);
        
        if(!empty($existence['email']) && $existence['email'] === $email) {
            array_push($errMsg, "Пользователь с такой почтой уже зарегистрирован!");
        }else{
            $pass = password_hash($passwordF, PASSWORD_DEFAULT);
            if (isset($_POST['admin'])) $admin = 1;

            $user = [
                "admin" => $admin,
                "username" => $login,
                "email" => $email,
                "password" => $pass
            ];
    
            $id = insert("users", $user);
            $user = selectOne("users", ['id' => $id]);

            // AuthUser($user);
            header('location: ' . BASE_URL . '/admin/users/index.php');
        }

    }
}else {
    $login = '';
    $email = '';
}

// Удаление пользователя
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    delete('users', $id);
    header('location: ' . BASE_URL . '/admin/users/index.php');
}

// Редактирование пользователя
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['edit_id'])) {
    $id = $_GET['edit_id'];
    $user = selectOne("users", ['id' => $id]);
        
    $id = $user['id'];
    $admin = $user['admin'];
    $username = $user['username'];
    $email = $user['email'];
    $pass = $user['password'];
}

// Код обновления пользователя
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnUpdateUser'])) {

    $id = trim($_POST["id"]);
    $username = trim($_POST["login"]);
    $pass1 = trim($_POST["passwordFirst"]);
    $pass2 = trim($_POST["passwordSecond"]);

    if (isset($_POST["admin"])) {
        $admin = 1;
    }else {
        $admin = 0;
    }
    
    if ($username === '') {
        array_push($errMsg, "Не все поля заполнены!");
    }elseif(mb_strlen($username, 'UTF8') <= 2) {
        array_push($errMsg, "Имя пользователя должно быть более 2-х символов.");
    }elseif($pass1 === '' && $pass2 === '') {
        if (isset($_POST['admin'])) $admin = 1;

        $user = [
            "admin" => $admin,
            "username" => $username,
        ];
    

        $user = update("users", $id, $user);
        header('location: ' . BASE_URL . '/admin/users/index.php');
    }elseif($pass1 !== $pass2) {
        array_push($errMsg, "Пароль в обоих полях должны соответствовать.");
    }else {
        $pass1 = password_hash($pass1, PASSWORD_DEFAULT);
        if (isset($_POST['admin'])) $admin = 1;

        $user = [
            "admin" => $admin,
            "username" => $username,
            "password" => $pass1
        ];
    

        $user = update("users", $id, $user);
        header('location: ' . BASE_URL . '/admin/users/index.php');
    }
    
}