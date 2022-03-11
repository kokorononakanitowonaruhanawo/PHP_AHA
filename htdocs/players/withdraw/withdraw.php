<?php
  session_start();
  session_regenerate_id(TRUE);

  require_once('../../common/define.php');
  require_once('../../common/sql_players.php');

  //$_SESSION リセット
  if (isset($_SESSION['err']))  unset($_SESSION['err']);
  if (isset($_SESSION['withdraw']))  unset($_SESSION['withdraw']);

  if (isset($_POST) && $_POST)
  {
    $_SESSION['withdraw'] = sanitize($_POST);
  } elseif (isset($_SESSION["signIn"]['is_signIn']) && ($_SESSION["signIn"]['is_signIn'] != 0))
  {
      $_SESSION['withdraw']['ID'] = $_SESSION["signIn"]['is_signIn'];
      $_SESSION['withdraw']['name'] = $_SESSION["signIn"]['name'];
  } else
  {
    header('Location: withdraw_err.php');
  }

  /** validity check
   * ID
   */
    if (!$_SESSION['withdraw']['ID'] || $_SESSION['withdraw']['ID'] == 0 )
    {
        header('Location: withdraw_err.php');
        exit();
    }
?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>player削除</title>

    <!-- CSSを読み込む -->
    <link rel="stylesheet" href="stylesheet.css">
    <!-- jQueryのライブラリを読み込む -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- bootstrapのライブラリーを読み込む -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>

<body>
    <!-- header -->

    <!-- nav -->
    <ul class="nav justify-content-end">
        <li class="nav-item">
            <a class="nav-link" href="../../index.php">TOP</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../players/players_page.php">playerの管理ページ</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../../admin/admin_page.php">管理者ページ</a>
        </li>
    </ul>

    <!-- main -->
    <div class="container">
        <p>退会確認</p>
        <form action="#" method="POST">
            <div class="container mt-4">
                <!-- 氏名またはニックネーム -->
                <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label">氏名またはニックネーム</label>
                    <div class="col-sm-9">
                        <input type="text" readonly class="form-control" id="user" value="<?=$_SESSION['withdraw']['name']?>">
                    </div>
                </div>
                <!-- ボタン -->
                <div class="form-group row">
                    <div class="col-sm-3">
                        <button type="cancel" class="btn btn-secondary"
                            <?PHP if(isset($_POST) && $_POST):?>
                                formaction="../../admin/admin_players/players.php"
                            <?PHP elseif(isset($_SESSION["signIn"]['is_signIn']) && ($_SESSION["signIn"]['is_signIn'] != 0)):?>
                                formaction="../players_page.php"
                            <?PHP else:?>
                                formaction="../../admin/admin_players/players.php"
                            <?PHP endif?>
                        >キャンセルし、トップページへ</button>
                    </div>
                    <div class="col-sm-3">
                        <button type="submit" class="btn btn-primary" formaction="withdraw_action.php">退会</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- footer -->
    <div id="footer-wrapper">
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>



    <script type="text/javascript" src="script.js"></script>
</body>
</html>