<?php
session_start();
require_once '../classes/UserLogic.php';
require_once '../dbconnect.php';

$result = UserLogic::checkLogin();

if (!$result) {
  $_SESSION['login_err'] = 'ユーザーを登録してログインしてください！';
  header('Location: signup_form.php');
  return;
}

$login_user = $_SESSION['login_user'];

$files = getAllFile();
?>



<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>マイページ</title>
  <link rel="stylesheet" href="../css/style.css">
</head>

<body>
  <h2>マイページ</h2>
  <p>ユーザー名：<?php echo $login_user['name'] ?></p>
  <a href="upload_form.php">新規投稿フォームへ</a>
  <div class="parent">
    <div class="file">
      <?php foreach ($files as $file) : ?>
        <img src="<?php echo "{$file['file_path']}"; ?>" alt="">
        <p><?php echo "{$file['description']}"; ?></p>
      <?php endforeach; ?>
    </div>
  </div>
  <form action="logout.php" method="POST">
    <input type="submit" name="logout" value="ログアウト">
  </form>
</body>

</html>
