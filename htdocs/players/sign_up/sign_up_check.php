<?php
  session_start();
  session_regenerate_id(TRUE);

  require_once('../../common/define.php');
  require_once('../../common/sql_players.php');

  //$_SESSION リセット
  if (isset($_SESSION['err']))  unset($_SESSION['err']);
  if (isset($_SESSION['signUp']))  unset($_SESSION['signUp']);

  $_SESSION['signUp'] = sanitize($_POST);

  /** validity check
   * 氏名またはニックネーム
   * password
   */
  $validity = TRUE;
  // 氏名またはニックネーム
  if (!isset($_SESSION['signUp']['name']) || ($_SESSION['signUp']['name']==""))
  {
    $validity = FALSE;
    $_SESSION['err']['signUp']['name'] = '氏名またはニックネームが入力されていません';
  } elseif (ctype_space($_SESSION['signUp']['name']) == true)
  {
    $validity = FALSE;
    $_SESSION['err']['signUp']['name'] = '空白文字は使えません';
  }
  // パスワード
  if ($_SESSION['signUp']['pass1'] != $_SESSION['signUp']['pass2'])
  {
    $validity = FALSE;
    $_SESSION['err']['signUp']['pass'] = 'パスワードが一致しません';
  }  elseif (!preg_match('/^[a-zA-Z0-9]{8,16}+$/', $_SESSION['signUp']['pass1']))
  {
    $validity = false;
    $_SESSION['err']['signUp']['pass'] = '半角英数8文字以上16文字以内で設定して下さい';
  }

  if ($validity == FALSE)
  {
    header('Location: sign_up.php');
    exit();
  }


?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up Check</title>
  <!-- CSSを読み込む -->
  <link rel="stylesheet" href="stylesheet.css">
  <!-- jQueryのライブラリを読み込む -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!-- bootstrapのライブラリーを読み込む -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
  <div class="container mt-5">
  <form action="#" method="POST">
    <h2>sign up 確認</h2>
    <p>以下の内容で登録しますか？</p>
    <div class="container mt-4">
      <!-- 氏名またはニックネーム -->
      <div class="form-group row">
        <label for="name" class="col-sm-3 col-form-label">氏名またはニックネーム</label>
        <div class="col-sm-9">
          <input type="text" readonly class="form-control" id="user" value="<?=$_SESSION['signUp']['name']?>">
        </div>
      </div>
      <!-- パスワード -->
      <div class="form-group row">
        <label for="pass" class="col-sm-3 col-form-label">パスワード</label>
        <div class="col-sm-9">
          <input type="text" readonly class="form-control" id="pass" value="入力されたパスワード">
        </div>
      </div>
      <!-- ボタン -->
      <div class="form-group row">
        <div class="col-sm-3">
          <button type="cancel" class="btn btn-secondary" formaction="sign_up.php">キャンセル</button>
        </div>
        <div class="col-sm-3">
          <button type="submit" class="btn btn-primary" formaction="sign_up_action.php">登録</button>
        </div>
      </div>
    </div>
  </form>
</body>
</html>