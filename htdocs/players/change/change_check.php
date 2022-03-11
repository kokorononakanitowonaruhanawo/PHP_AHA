<?php
  session_start();
  session_regenerate_id(TRUE);

  require_once('../../common/define.php');
  require_once('../../common/sql_players.php');

  //$_SESSION リセット
  if (isset($_SESSION['err']))  unset($_SESSION['err']);
  if (isset($_SESSION['signUp']))  unset($_SESSION['signUp']);

  $_SESSION['change'] = sanitize($_POST);

  /** validity check
   * 氏名またはニックネーム
   * 現パスワード
   * 新規パスワード
   * 『氏名またはニックネーム』と『現パスワード』が合っているか？
   */
  $validity = TRUE;
  // 氏名またはニックネーム
  if (!isset($_SESSION['change']['name']) || ($_SESSION['change']['name']==""))
  {
    $validity = FALSE;
    $_SESSION['err']['change']['name'] = '氏名またはニックネームが入力されていません';
  } elseif (ctype_space($_SESSION['change']['name']) == true)
  {
    $validity = FALSE;
    $_SESSION['err']['change']['name'] = '空白文字は使えません';
  }
  // 現パスワード
  if (!isset($_SESSION['change']['passNow']) || ($_SESSION['change']['passNow']==""))
  {
    $validity = FALSE;
    $_SESSION['err']['change']['passNow'] = '現パスワードが入力されていません';
  }  elseif (!preg_match('/^[a-zA-Z0-9]{8,16}+$/', $_SESSION['change']['pass1']))
  {
    $validity = false;
    $_SESSION['err']['change']['passNow'] = '半角英数8文字以上16文字以内で入力して下さい';
  }
  // 新規パスワード
  if (!isset($_SESSION['change']['pass1']) || ($_SESSION['change']['pass1']==""))
  {
    $validity = FALSE;
    $_SESSION['err']['change']['pass'] = '新規パスワードが入力されていません';
  }  elseif ($_SESSION['change']['pass1'] != $_SESSION['change']['pass2'])
  {
    $validity = FALSE;
    $_SESSION['err']['change']['pass'] = 'パスワードが一致しません';
  }  elseif (!preg_match('/^[a-zA-Z0-9]{8,16}+$/', $_SESSION['change']['pass1']))
  {
    $validity = false;
    $_SESSION['err']['change']['pass'] = '半角英数8文字以上16文字以内で設定して下さい';
  }

  if ($validity == FALSE)
  {
    header('Location: change.php');
    exit();
  }

  try
  {
    $player = new playersModel();
    $player_id = $player->signInCheck($_SESSION["signIn"]['name'], $_SESSION["change"]['passNow']);
    if ( $player_id == 0)
    {
      $_SESSION['err']['change']['passNow'] = "現在の『パスワード』が間違っています";
      header('Location: change.php');
    }
  } catch(Exception $e)
  {
    var_dump($e);
    exit();
    header('Location: ../../index.php');
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
          <input type="text" readonly class="form-control" id="user" name="name" value="<?=$_SESSION['change']['name']?>">
        </div>
      </div>
      <!-- パスワード -->
      <div class="form-group row">
        <label for="pass" class="col-sm-3 col-form-label">パスワード</label>
        <div class="col-sm-9">
          <input type="text" readonly class="form-control" id="pass" value="入力されたパスワード">
          <input type="hidden" name="pass" value="<?=$_SESSION['change']['pass1']?>">
        </div>
      </div>
      <!-- id -->
      <input type="hidden" name="id" value="<?=$player_id?>">
      <!-- ボタン -->
      <div class="form-group row">
        <div class="col-sm-3">
          <button type="cancel" class="btn btn-secondary" formaction="../../index.php">キャンセル</button>
        </div>
        <div class="col-sm-3">
          <button type="submit" class="btn btn-primary" formaction="change_action.php">変更</button>
        </div>
      </div>
    </div>
  </form>
</body>
</html>