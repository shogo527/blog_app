<?php


//ログインユーザーのデータベース
require_once 'env.php';
function connect()
{
  $host = DB_HOST;
  $db = DB_NAME;
  $user = DB_USER;
  $pass = DB_PASS;

  $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

  try {
    $pdo = new PDO($dsn, $user, $pass, [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
    return $pdo;
  } catch (PDOException $e) {
    echo '接続失敗' . $e->getMessage();
    exit();
  }
}

//画像ファイルのデータベース
function dbc()
{
  $host = "localhost";
  $db = "file_db";
  $user = "root";
  $pass = "root";

  $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

  try {
    $pdo = new PDO($dsn, $user, $pass, [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
    return $pdo;
  } catch (PDOException $e) {
    echo '接続失敗' . $e->getMessage();
    exit();
  }
}

dbc();


/**
 * ファイルデータを保存
 * @param string $filename　ファイル名
 * @param string $save_path　保存先のパス
 * @param string $caption 投稿の説明
 * @return bool $result
 */
function fileSave($filename, $save_path, $caption)
{
  $result = False;

  $sql = "INSERT INTO file_table(file_name, file_path, description) VALUE (?, ?, ?)";

  try {
    $stmt = dbc()->prepare($sql);
    $stmt->bindValue(1, $filename);
    $stmt->bindValue(2, $save_path);
    $stmt->bindValue(3, $caption);
    $result = $stmt->execute();
    return $result;
  } catch (\Exception $e) {
    echo $e->getMessage();
    return $result;
  }
}


/**
 * ファイルデータを取得
 * @return array $fileData
 */
function getAllFile()
{
  $sql = "SELECT * FROM file_table";

  $fileData = $stmt = dbc()->query($sql);

  return $fileData;
}
