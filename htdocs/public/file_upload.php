<?php

require_once "../dbconnect.php";


$file = $_FILES['img'];
$filename = basename($file['name']);
$tmp_path = $file['tmp_name'];
$file_err = $file['error'];
$filesize = $file['size'];
$upload_dir = '../images/';
$save_filename = date('YmdHis') . $filename;
$err_msgs = array();
$save_path = $upload_dir . $save_filename;

$caption = filter_input(INPUT_POST, 'caption', FILTER_SANITIZE_SPECIAL_CHARS);

if (empty($caption)) {
  array_push($err_msgs, 'キャプションを入力してください。');
}
if (strlen($caption) > 140) {
  array_push($err_msgs, 'キャプションは140文字以内で入力してください。');
}

if ($filesize > 1048576 || $file_err == 2) {
  array_push($err_msgs, 'ファイルサイズは1MB未満にしてください。');
}
$allow_ext = array('jpg', 'jpeg', 'png');
$file_ext = pathinfo($filename, PATHINFO_EXTENSION);

if (!in_array(strtolower($file_ext), $allow_ext)) {
  array_push($err_msgs, '画像ファイルを添付してください。');
}

if (count($err_msgs) === 0) {
  if (is_uploaded_file($tmp_path)) {
    if (move_uploaded_file($tmp_path, $save_path)) {
      echo $filename . 'をアップしました。';
      echo '<br>';
      $result = fileSave($filename, $save_path, $caption);

      if ($result) {
        echo 'データベースに保存しました。';
        echo '<br>';
      } else {
        echo 'データベースへの保存が失敗しました。';
        echo '<br>';
      }
    } else {
      echo 'ファイルが保存できませんでした。';
      echo '<br>';
    }
  } else {
    echo 'ファイルが選択されていません。';
    echo '<br>';
  }
} else {
  foreach ($err_msgs as $msg) {
    echo $msg;
    echo '<br>';
  }
}
?>
<a href="./mypage.php">マイページへ</a>
<link rel="stylesheet" href="../css/style.css">
