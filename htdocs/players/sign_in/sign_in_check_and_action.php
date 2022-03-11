<?php
  session_start();
  session_regenerate_id(TRUE);

  require_once('../../common/define.php');
  require_once('../../common/sql_players.php');

  //$_SESSION リセット
  if (isset($_SESSION['err']) && $_SESSION['err'])  unset($_SESSION['err']);
  if (isset($_SESSION['signIn']) && $_SESSION['signIn'])  unset($_SESSION['signIn']);

  $_SESSION['signIn'] = sanitize($_POST);

  /** validity check
   * 氏名またはニックネーム
   * password
   */
  $validity = TRUE;

  if (!$_SESSION['signIn']['name'])
  {
    $validity = FALSE;
    $_SESSION['err']['signIn']['name'] = '氏名またはニックネームが入力されていません';
  }

  if (!$_SESSION['signIn']['pass'])
  {
    $validity = FALSE;
    $_SESSION['err']['signIn']['pass'] = 'パスワードが入力されていません';
  }  elseif (!preg_match('/^[a-zA-Z0-9]{8,16}+$/', $_SESSION['signIn']['pass']))
  {
    $validity = false;
    $_SESSION['err']['signIn']['pass'] = 'パスワードが間違っています';
  }

  if ($validity == FALSE)
  {
    header('Location: sign_in.php');
    exit();
  }

/** sing in
 * 
 */
  try
  {
    $player = new playersModel();
    $signIn = $player->signInCheck($_SESSION["signIn"]['name'], $_SESSION["signIn"]['pass']);
    if ($signIn == 0)
    {
      
      $_SESSION['err']['login']['incorrect'] = 'ユーザー名とパスワードが一致しません';
      header('Location: sign_in.php');
    }
  } catch(Exception $e)
  {
    var_dump($e);
    exit();
    header('Location: ../../index.php');

  }

  $player = NULL;

  if(isset($_SESSION["err"])) unset($_SESSION["err"]);
  
  $_SESSION["signIn"]['is_signIn'] = $signIn;
  header('Location: ../../index.php');
?>
