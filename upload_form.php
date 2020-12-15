<?php
require_once('dbc.php');

$files =getAllfile();
?>
<!-- ①フォームの説明 -->
<!-- ②$_FILEの確認 -->
<!-- ③バリデーション -->
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>アップロードフォーム</title>
    <link rel="stylesheet" href="style.css">
  </head>
  
  <body>
    <form enctype="multipart/form-data" action="./file_upload.php" method="POST">
      <div class="file-up">
        <input type="hidden" name="MAX_FILE_SIZE" value="9999999999999" />
        <input name="img" type="file" accept="image/*" />
      </div>
      <div>
        <textarea
          name="caption"
          placeholder="キャプション（140文字以下）"
          id="caption"
        ></textarea>
      </div>
      <div class="submit">
        <input type="submit" value="送信" class="btn" />
      </div>
    </form>
    <div>
      <?php foreach($files as $file):?>
        
      <img src="<?php echo h($file['file_path']);?>" alt="">
      <p><?php echo h($file['description']);?></p>
      <?php endforeach;?>
    </div>
  </body>
</html>
