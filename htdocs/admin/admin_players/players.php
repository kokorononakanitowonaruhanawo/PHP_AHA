<?php
    // セッションをスタートする。
    session_start();
    // セッションIDをリクエストのたびに更新する。
    session_regenerate_id();

  require_once('../../common/define.php');
  require_once('../../common/sql_players.php');

  //$_SESSION リセット
  if (isset($_SESSION['err']))  unset($_SESSION['err']);
  if (isset($_SESSION['signUp']))  unset($_SESSION['signUp']);

  try
  {
    $player = new playersModel();
    $players = [];
    $players = $player -> getAllPlayers();
  } catch (Exception $e)
  {
    var_dump($e);
    exit();
    header('Location: ../../index.php');
  }

?>


<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>player管理</title>

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
    <div class="container mt-5" >
        <ul class="nav justify-content-end">
            <li class="nav-item">
                <a class="nav-link" href="../../index.php">TOP</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../../players/players_page.php">playerの管理ページ</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../admin_page.php">管理者ページ</a>
            </li>
        </ul>
    </div>

    <!-- main -->
    <div class="container mt-5">
        <table class="table table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">氏名またはニックネーム</th>
                    <th scope="col">action</th>
                </tr>
            </thead>

            <?php $i=1?>
            <?php foreach($players as $player):?>
                <tr>
                    <td class="align-center">
                        <?= $i?>
                    </td>
                
                    <td class="align-left">
                        <?= $player['player']?>
                    </td>
                    <td>
                        <form action="../../players/withdraw/withdraw.php" method="post">
                            <input type="hidden" name="ID" value="<?= $player['ID']?>">
                            <input type="hidden" name="name" value="<?=$player['player']?>">
                            <input type="submit" value="削除">
                        </form>
                    </td>
                </tr>
                <?php $i++?>
            <?php endforeach?>
        </table>
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