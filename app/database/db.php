<?php
session_start();

require('connect.php');

function tt($value){
  echo '<pre>';
  print_r($value);
  echo '</pre>';
  exit();
}

//Проверка выполнения запроса к бд
function dbCheckError($query){
  $errInfo = $query->errorInfo();

  if ($errInfo[0] !== PDO::ERR_NONE) {
    echo $errInfo[2];
    exit();
  }
  return true;
}

//Запрос на получение данных с одной таблицы
function selectAll($table, $params = []){
  global $dbh;

  $sql = "SELECT * FROM $table";

  if (!empty($params)) {
    $i = 0;
    foreach ($params as $key => $value) {
      if (!is_numeric($value)) {
        $value = "'" . $value . "'";
      }

      if ($i === 0) {
        $sql = $sql . " WHERE $key = $value";
      }else {
        $sql = $sql . " AND $key = $value";
      }
      $i++;
    }
  }

  $query = $dbh->prepare($sql);
  $query->execute();

  dbCheckError($query);

  return $query->fetchAll();
}

//Запрос на получение одной строки с выбранной таблицы
function selectOne($table, $params = []){
  global $dbh;

  $sql = "SELECT * FROM $table";

  if (!empty($params)) {
    $i = 0;
    foreach ($params as $key => $value) {
      if (!is_numeric($value)) {
        $value = "'" . $value . "'";
      }

      if ($i === 0) {
        $sql = $sql . " WHERE $key = $value";
      }else {
        $sql = $sql . " AND $key = $value";
      }
      $i++;
    }
  }

  $query = $dbh->prepare($sql);
  $query->execute();

  dbCheckError($query);

  return $query->fetch();
}

//Запись в таблицу  бд
function insert($table, $params) {
  global $dbh;

  $i = 0;
  $coll = '';
  $mask = '';
  foreach ($params as $key => $value) {
    if ($i === 0) {
      $coll = $coll . "$key";
      $mask = $mask . "'" . "$value" . "'";
    }else {
      $coll = $coll . ", $key";
      $mask = $mask . ", '" . "$value" . "'";
    }

    $i++;
  }

  $sql = "INSERT INTO $table ($coll) VALUES ($mask)";
  $query = $dbh->prepare($sql);
  $query->execute();

  dbCheckError($query);
  return $dbh->lastInsertId();
}

//Обновление строки в таблице
function update($table, $id, $params) {
  global $dbh;

  $i = 0;
  $str = '';
  foreach ($params as $key => $value) {
    if ($i === 0) {
      $str = $str . $key . " = '" . $value . "'";
    }else {
      $str = $str . ", " . $key . " = '" . $value . "'";
    }

    $i++;
  }

  // UPDATE `users` SET `admin` = '1', `password` = '5555' WHERE `id` = '1'
  $sql = "UPDATE $table SET $str WHERE `id` = $id";
  $query = $dbh->prepare($sql);
  $query->execute();

  dbCheckError($query);
}

//Удаление строки в таблице
function delete($table, $id) {
  global $dbh;

  // DELETE FROM `users` WHERE 0
  $sql = "DELETE FROM $table WHERE `id` = $id";
  $query = $dbh->prepare($sql);
  $query->execute();

  dbCheckError($query);
}

// Выборка записей (posts) с авторм в админку
function selectAllFromPostsWithUsers($table1, $table2) {
  global $dbh;

  $sql = "SELECT t1.id, t1.title, t1.img, t1.content, t1.status, t1.id_topic, t1.created_date, t2.username FROM $table1 AS t1 JOIN $table2 AS t2 ON t1.id_user = t2.id";

  $query = $dbh->prepare($sql);
  $query->execute();

  dbCheckError($query);

  return $query->fetchAll();
}

// Выборка записей (posts) с авторм на главную
function selectAllFromPostsWithUsersOnIndex($table1, $table2, $limit, $offset) {
  global $dbh;

  $sql = "SELECT p.*, u.username FROM $table1 AS p JOIN $table2 AS u ON p.id_user = u.id WHERE p.status = 1 LIMIT $limit OFFSET $offset";

  $query = $dbh->prepare($sql);
  $query->execute();

  dbCheckError($query);

  return $query->fetchAll();
}

// Выборка записей (posts) с категорией top topics для сайдбара
function selectTopTopicFromPostsOnIndex($table1) {
  global $dbh;

  $sql = "SELECT * FROM $table1 WHERE id_topic = 6";

  $query = $dbh->prepare($sql);
  $query->execute();

  dbCheckError($query);

  return $query->fetchAll();
}

// Поиск по содержимаму и заголовку(простой)
function searchInTitleAndContent($term, $table1, $table2) {
  global $dbh;

  $text = trim(strip_tags(stripcslashes(htmlspecialchars($term))));

  $sql = "SELECT p.*, u.username FROM $table1 AS p JOIN $table2 AS u ON p.id_user = u.id 
          WHERE p.status = 1 AND p.title LIKE '%$text%' OR p.content LIKE '%$text%'";

  $query = $dbh->prepare($sql);
  $query->execute();

  dbCheckError($query);

  return $query->fetchAll();
}

// Выборка записей (posts) с авторм для сингл
function selectPostFromPostsWithUsersOnSingle($table1, $table2, $id) {
  global $dbh;

  $sql = "SELECT p.*, u.username FROM $table1 AS p JOIN $table2 AS u ON p.id_user = u.id WHERE p.id = $id";

  $query = $dbh->prepare($sql);
  $query->execute();

  dbCheckError($query);

  return $query->fetch();
}

//Получение записей с данной категорией
function selectAllPostsFromCategory($table1, $table2, $limit, $offset, $id){
  global $dbh;

  // $sql = "SELECT p.*, u.username FROM $table1 AS p JOIN $table2 AS u ON p.id_user = u.id LIMIT $limit OFFSET $offset";
  $sql = "SELECT p.*, u.username FROM $table1 AS p JOIN $table2 AS u ON p.id_user = u.id WHERE p.id_topic = $id AND p.status = 1 LIMIT $limit OFFSET $offset";

  // if (!empty($params)) {
  //   $i = 0;
  //   foreach ($params as $key => $value) {
  //     if (!is_numeric($value)) {
  //       $value = "'" . $value . "'";
  //     }

  //     if ($i === 0) {
  //       $sql = $sql . " WHERE p.$key = $value";
  //     }else {
  //       $sql = $sql . " AND p.$key = $value";
  //     }
  //     $i++;
  //   }
  // }

  $query = $dbh->prepare($sql);
  $query->execute();

  dbCheckError($query);

  return $query->fetchAll();
}

// Получение количества строк в таблице
function countRow($table) {
  global $dbh;

  $sql = "SELECT COUNT(*) FROM $table WHERE status = 1";

  $query = $dbh->prepare($sql);
  $query->execute();

  dbCheckError($query);

  return $query->fetchColumn();
}