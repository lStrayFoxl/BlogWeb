<?php

if (!empty($_FILES['img']['name'])) {
    $imgName = time() . "_" .  $_FILES['img']['name'];
    $fileTmpName = $_FILES['img']['tmp_name'];
    $fileType = $_FILES['img']['type'];
    $destination = ROOT_PATH . "\assets\images\posts\\" . $imgName;
    
    if (strpos($fileType, 'image') === false) {
        array_push($errMsg, "Подгружаемый файл не является изображением!");
        // die("Можно загружать только картинки");

    }elseif($_FILES['img']['size'] > (1000 * 1024)){
        array_push($errMsg, "Размер загружаймого файла не может превышать 500КБ.");
        // die("Размер загружаймого файла не может превышать 500КБ");

    }elseif(getimagesize($fileTmpName)[0] > 1600 || getimagesize($fileTmpName)[1] > 650){
        array_push($errMsg, "Разрешение загружаймого изображения не может превышать 800*650.");
        // die("Разрешение загружаймого изображения не может превышать 800*450");

    }else{
        $result = move_uploaded_file($fileTmpName, $destination);

        if ($result) {
            $_POST['img'] = $imgName;
        }else{
            array_push($errMsg, "Ошибка загрузки изображения на сервер.");
            // $errMsg = 'Ошибка загрузки изображения на сервер.';
        }
    }

}else{
    array_push($errMsg, "Ошибка получения картинки.");
    // $errMsg = 'Ошибка получения картинки.';
}