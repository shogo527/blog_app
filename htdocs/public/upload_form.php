<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>新規投稿</title>
  <link rel="stylesheet" href="../css/style.css">
</head>

<body>
  <h2>新規投稿フォーム</h2>
  <form enctype="multipart/form-data" action="./file_upload.php" method="POST">
    <div class="file-up">
      <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
      <input type="file" name="img" accept="image/*" />
    </div>
    <div>
      <textarea name="caption" id="caption" placeholder="キャプション"></textarea>
    </div>
    <div class="submit">
      <input type="submit" value=送信 />　
    </div>
  </form>
  <a href="./mypage.php">戻る</a>
</body>

</html>
